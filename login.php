<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Usuário ou senha incorretos!";
        }
    } else {
        $error = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
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

        .custom-container {
            max-width: 900px; 
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-color {
            color: var(--Header-color);
        }

        .subheader-color {
            color: var(--Subheader-color);
        }

        .link-color, .link-color:hover, .link-color:focus {
            color: var(--link-color);
            text-decoration: underline;
        }

        .bt-background {
            background-color: var(--bt-background);
        }

        .font-padrao {
            font-family: var(--font-padrao);
        }

        .input-icon {
            position: relative;
        }

        .input-icon input {
            padding-left: 2.5rem;
        }

        .input-icon .fa {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6A6A6A;
        }
    </style>
    <title>Página de Login</title>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container custom-container">
        <div class="row">
            <!-- Left Container -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center bt-background text-white p-4 rounded-left">
                <img src="./img/INCM LOGO COMPONENT.png" alt="logo_incm" class="mb-3">
                <a href="cadastro.php" class="link-color font-padrao">Não tem uma conta? Cadastre-se</a>
                <img src="./img/component img login.png" alt="moca_incm" class="img-fluid mt-3">
            </div>

            <!-- Right Container -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-4 bg-white rounded-right">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger w-100"><?php echo $error; ?></div>
                <?php endif; ?>
                <form class="w-100" method="POST" action="login.php">
                    <h1 class="header-color mb-3 font-padrao">Login</h1>
                    <h2 class="subheader-color mb-3 font-padrao">Insira os seus dados abaixo!</h2>
                    <div class="input-icon mb-3">
                        <i class="fa fa-user"></i>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Insira o seu nome de usuário" required>
                    </div>
                    <div class="input-icon mb-3">
                        <i class="fa fa-lock"></i>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Insira sua Senha" required>
                    </div>
                    <input class="btn bt-background w-100 text-white font-padrao" type="submit" value="Entrar">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
