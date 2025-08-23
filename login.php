<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); // Criptografa com MD5

    // Consulta direta com verificação de usuário e senha
    $stmt = $conn->prepare("SELECT id, username FROM usuarios WHERE username = ? AND senha = ?");
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $usuario);
        $stmt->fetch();

        // Login bem-sucedido
        //$_SESSION['id'] = $id;
        $_SESSION['id'] = $id;
        $_SESSION['usuario'] = $usuario;

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Usuário ou senha incorretos."]);
    }

    $stmt->close();
    $conn->close();
}
?>