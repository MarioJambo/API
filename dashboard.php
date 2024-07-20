<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --Header-color: #8C9FCA;
            --Subheader-color: #6A6A6A;
            --link-color: #6A6A6A;
            --bt-background: #8C9FCA;
            --font-padrao: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--font-padrao);
        }

        .sidebar {
            height: 100vh;
            background-color: var(--bt-background);
            color: white;
            padding-top: 20px;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: #6A6A6A;
        }

        .content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
            position: relative;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .pagination {
            justify-content: center;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-lg {
            max-width: 80%;
        }
    </style>
    <title>Dashboard - INCM</title>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar d-flex flex-column p-3">
            <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
                <img src="./img/INCM LOGO COMPONENT.png" alt="INCM Logo">
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" id="nav-documents" onclick="showPage('documents')">
                        <i class="fas fa-file-alt mr-2"></i> Documentos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="nav-users" onclick="showPage('users')">
                        <i class="fas fa-users mr-2"></i> Usuários
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="nav-settings" onclick="showPage('settings')">
                        <i class="fas fa-cog mr-2"></i> Configurações
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="nav-others" onclick="showPage('others')">
                        <i class="fas fa-ellipsis-h mr-2"></i> Outros
                    </a>
                </li>
            </ul>
        </div>
        <div class="content flex-grow-1">
            <div id="page-documents" class="table-container">
                <div class="header-container mb-4">
                    <h1 class="header-color">Documentos</h1>
                    <div>
                    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" id="fileInput" name="file" style="display: none;" />
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click();">
                                <i class="fa fa-upload mr-2"></i> Upload Novo Documento
                            </button>
                        </form>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tipo de Equipamento</th>
                            <th>Empresa</th>
                            <th>Data</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="documentTableBody">
                        <!-- Rows will be populated by JavaScript -->
                    </tbody>
                </table>
                <div class="footer">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#" onclick="prevPage()">Anterior</a></li>
                            <li class="page-item"><a class="page-link" href="#" onclick="nextPage()">Próximo</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div id="page-users" class="table-container d-none">
                <h1 class="header-color mb-4">Usuários</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Usuário A</td>
                            <td>usuarioa@email.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Usuário B</td>
                            <td>usuariob@email.com</td>
                        </tr>
                        <!-- Adicionar mais linhas conforme necessário -->
                    </tbody>
                </table>
            </div>
            <div id="page-settings" class="table-container d-none">
                <h1 class="header-color mb-4">Configurações</h1>
                <!-- Settings management content here -->
            </div>
            <div id="page-others" class="table-container d-none">
                <h1 class="header-color mb-4">Outros</h1>
                <!-- Other content here -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalLabel">Visualizar Documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="documentFrame" src="" width="100%" height="400px"></iframe>
                    <div class="form-group mt-3">
                        <label for="publicKey">Chave Pública</label>
                        <textarea class="form-control" id="publicKey" rows="3" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retroceder</button>
                    <button type="button" class="btn btn-primary" id="actionButton">Assinar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        class RSASignature {
            constructor() {
                this.privateKey = null;
                this.publicKey = null;
            }

            async generateKeys() {
                const keyPair = await window.crypto.subtle.generateKey(
                    {
                        name: "RSASSA-PKCS1-v1_5",
                        modulusLength: 2048,
                        publicExponent: new Uint8Array([1, 0, 1]),
                        hash: { name: "SHA-256" },
                    },
                    true,
                    ["sign", "verify"]
                );
                this.privateKey = keyPair.privateKey;
                this.publicKey = keyPair.publicKey;
            }

            async signDocument(documentText) {
                const encoder = new TextEncoder();
                const data = encoder.encode(documentText);
                const signature = await window.crypto.subtle.sign(
                    { name: "RSASSA-PKCS1-v1_5" },
                    this.privateKey,
                    data
                );
                return this.arrayBufferToBase64(signature);
            }

            async exportPublicKey() {
                const exported = await window.crypto.subtle.exportKey("spki", this.publicKey);
                return this.arrayBufferToBase64(exported);
            }

            async verifySignature(documentText, signature) {
                const encoder = new TextEncoder();
                const data = encoder.encode(documentText);
                const signatureArrayBuffer = this.base64ToArrayBuffer(signature);
                const result = await window.crypto.subtle.verify(
                    { name: "RSASSA-PKCS1-v1_5" },
                    this.publicKey,
                    signatureArrayBuffer,
                    data
                );
                return result;
            }

            arrayBufferToBase64(buffer) {
                const bytes = new Uint8Array(buffer);
                let binary = "";
                for (const byte of bytes) {
                    binary += String.fromCharCode(byte);
                }
                return window.btoa(binary);
            }

            base64ToArrayBuffer(base64) {
                const binaryString = window.atob(base64);
                const len = binaryString.length;
                const bytes = new Uint8Array(len);
                for (let i = 0; i < len; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }
                return bytes.buffer;
            }
        }

        const rsaSignature = new RSASignature();
        let selectedDocumentIndex = null;
        let publicKey = '';

        const documents = [
            { type: 'Laptop', company: 'Empresa A', date: '01/01/2024', status: 'Não Assinado', file: './exemplos/Certificado_de_Homologacao_1165.pdf', signature: '', publicKey: '' },
            { type: 'Modem', company: 'Empresa B', date: '02/02/2024', status: 'Não Assinado', file: './exemplos/Certificado_de_Homologacao_1165.pdf', signature: '', publicKey: '' },
            { type: 'macbook', company: 'Empresa C', date: '02/02/2024', status: 'Não Assinado', file: './exemplos/Certificado_de_Homologacao_1165.pdf', signature: '', publicKey: '' },
            { type: 'Torre', company: 'Empresa D', date: '02/02/2024', status: 'Não Assinado', file: './exemplos/Certificado_de_Homologacao_1165.pdf', signature: '', publicKey: '' },
            { type: 'Certificado de Teste', company: 'Empresa D', date: '02/02/2024', status: 'Não Assinado', file: './exemplos/Torre.pdf', signature: '', publicKey: '' },
        ];

        const pageSize = 5;
        let currentPage = 1;

        function showPage(page) {
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            document.querySelector(`#nav-${page}`).classList.add('active');
            
            document.querySelectorAll('.table-container').forEach(container => container.classList.add('d-none'));
            document.querySelector(`#page-${page}`).classList.remove('d-none');
        }

        function renderTable() {
            const tableBody = document.getElementById('documentTableBody');
            tableBody.innerHTML = '';

            const start = (currentPage - 1) * pageSize;
            const end = start + pageSize;
            const pageDocuments = documents.slice(start, end);

            pageDocuments.forEach((doc, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${doc.type}</td>
                    <td>${doc.company}</td>
                    <td>${doc.date}</td>
                    <td><span class="badge badge-${doc.status === 'Assinado' ? 'success' : 'danger'}">${doc.status}</span></td>
                `;
                row.addEventListener('click', () => openModal(start + index));
                tableBody.appendChild(row);
            });
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        }

        function nextPage() {
            if (currentPage * pageSize < documents.length) {
                currentPage++;
                renderTable();
            }
        }

        document.getElementById('fileInput').addEventListener('change', function(event) {
            document.getElementById('uploadForm').submit();
            const file = event.target.files[0];
            if (file) {
                const newDoc = {
                    type: 'Novo Documento',
                    company: 'Nova Empresa',
                    date: new Date().toLocaleDateString(),
                    status: 'Não Assinado',
                    file: URL.createObjectURL(file),
                    signature: '',
                    publicKey: ''
                };
                documents.push(newDoc);
                renderTable();

            }
        });

        async function openModal(index) {
            const doc = documents[index];
            selectedDocumentIndex = index;
            const modalLabel = document.getElementById('documentModalLabel');
            const documentFrame = document.getElementById('documentFrame');
            const actionButton = document.getElementById('actionButton');
            const publicKeyField = document.getElementById('publicKey');

            modalLabel.textContent = `Visualizar Documento - ${doc.type}`;
            documentFrame.src = doc.file;
            actionButton.textContent = doc.status === 'Assinado' ? 'Verificar' : 'Assinar';
            publicKeyField.value = doc.publicKey;

            if (doc.status === 'Assinado') {
                actionButton.classList.replace('btn-primary', 'btn-success');
            } else {
                actionButton.classList.replace('btn-success', 'btn-primary');
            }

            $('#documentModal').modal('show');
        }

        document.getElementById('actionButton').addEventListener('click', async function () {
            const doc = documents[selectedDocumentIndex];
            const actionButton = document.getElementById('actionButton');

            if (doc.status === 'Assinado') {
                const fileResponse = await fetch(doc.file);
                const fileBlob = await fileResponse.blob();
                const fileText = await fileBlob.text();
                const verified = await rsaSignature.verifySignature(fileText, doc.signature);

                if (verified) {
                    alert('O documento foi verificado com succeso!');
                } else {
                    alert('Falha na verificação da assinatura, este documento nao uma chave fidedigna!');
                }
            } else {
                const fileResponse = await fetch(doc.file);
                const fileBlob = await fileResponse.blob();
                const fileText = await fileBlob.text();
                const signature = await rsaSignature.signDocument(fileText);
                doc.signature = signature;
                doc.status = 'Assinado';
                doc.publicKey = publicKey;

                actionButton.textContent = 'Verificar';
                actionButton.classList.replace('btn-primary', 'btn-success');

                alert('Documento assinado com sucesso!');

                renderTable();
            }
        });

        // Show the documents page by default and render the table
        showPage('documents');
        renderTable();

        // Generate RSA keys on page load
        (async () => {
            await rsaSignature.generateKeys();
            publicKey = await rsaSignature.exportPublicKey();
            console.log('Public Key:', publicKey);
        })();
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
