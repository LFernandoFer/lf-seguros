<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);

    $stmt = $conn->prepare("SELECT id, usuario, permissao FROM usuarios WHERE usuario = ? AND senha = ?");
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // salva dados na sessão
        $_SESSION['id'] = $row['id'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['permissao'] = $row['permissao'];

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Usuário ou senha incorretos"]);
    }
}
?>