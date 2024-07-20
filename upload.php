<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $targetDirectory = 'exemplos/';
    $targetFile = $targetDirectory . basename($_FILES['file']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar se o arquivo já existe
    if (file_exists($targetFile)) {
        echo "Desculpe, o arquivo já existe.";
        $uploadOk = 0;
    }

    // Verificar o tamanho do arquivo
    if ($_FILES['file']['size'] > 5000000) { // 5MB
        echo "Desculpe, o seu arquivo é muito grande.";
        $uploadOk = 0;
    }

    // Permitir certos formatos de arquivo
    $allowedTypes = array('pdf', 'doc', 'docx', 'jpg', 'png');
    if (!in_array($fileType, $allowedTypes)) {
        echo "Desculpe, apenas arquivos PDF, DOC, DOCX, JPG, PNG são permitidos.";
        $uploadOk = 0;
    }

    // Verificar se $uploadOk está definido como 0 por algum erro
    if ($uploadOk == 0) {
        echo "Desculpe, o seu arquivo não foi carregado.";
    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            echo "O arquivo " . htmlspecialchars(basename($_FILES['file']['name'])) . " foi carregado com sucesso.";
        } else {
            echo "Desculpe, houve um erro ao carregar o seu arquivo.";
        }
    }
}
?>
