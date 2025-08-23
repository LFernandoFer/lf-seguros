<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lf seguros';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>