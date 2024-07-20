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

        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
        }

        .toast-success .toast-header {
            background-color: #28a745;
            color: white;
        }

        .toast-error .toast-header {
            background-color: #dc3545;
            color: white;
        }
    </style>
    <title>Página de Cadastro</title>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container custom-container">
        <div class="row">
            <!-- Left Container -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center bt-background text-white p-4 rounded-left">
                <img src="./img/INCM LOGO COMPONENT.png" alt="logo_incm" class="mb-3">
                <a href="login.php" class="link-color font-padrao">Já tem uma conta? Faça Login</a>
                <img src="./img/component img login.png" alt="moca_incm" class="img-fluid mt-3">
            </div>

            <!-- Right Container -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-4 bg-white rounded-right">
                <form id="registerForm" class="w-100" method="POST" action="cadastro.php">
                    <h1 class="header-color mb-3 font-padrao">Cadastro</h1>
                    <h2 class="subheader-color mb-3 font-padrao">Preencha os dados abaixo!</h2>
                    <div class="input-icon mb-3">
                        <i class="fa fa-user"></i>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Insira o seu nome de usuário">
                    </div>
                    <div class="input-icon mb-3">
                        <i class="fa fa-envelope"></i>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Insira o seu E-mail">
                    </div>
                    <div class="input-icon mb-3">
                        <i class="fa fa-lock"></i>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Insira sua Senha">
                    </div>
                    <input class="btn bt-background w-100 text-white font-padrao" type="submit" value="Cadastrar">
                </form>
            </div>
        </div>
    </div>

    <div class="toast-container">
        <div id="successToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-check-circle mr-2"></i>
                <strong class="mr-auto">Success</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Cadastro realizado com sucesso!
            </div>
        </div>
        <div id="errorToast" class="toast toast-error" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-times-circle mr-2"></i>
                <strong class="mr-auto">Error</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Algo deu errado. Por favor, tente novamente.
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            echo "<script>$(document).ready(function() { $('#successToast').toast('show'); });</script>";
        } else {
            echo "<script>$(document).ready(function() { $('#errorToast').toast('show'); });</script>";
        }
        
        $stmt->close();
    }
    
    $mysqli->close();
}
?>
