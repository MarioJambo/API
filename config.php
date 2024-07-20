<?php
$servername = "localhost";
$username = "root"; // ou o nome de usuário do seu banco de dados
$password = ""; // ou a senha do seu banco de dados
$dbname = "autenticacao"; // substitua pelo nome da sua base de dados

// Cria a conexão
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>
