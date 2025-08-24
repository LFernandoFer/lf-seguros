<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $usuario  = $_POST['usuario'];
    $senha    = md5($_POST['senha']); 
    $telefone = $_POST['telefone'];
    $idade    = $_POST['idade'];
    $sexo     = $_POST['sexo'];
    $veiculo  = $_POST['veiculo'];

    
    $stmt = $conn->prepare("
        INSERT INTO orcamento (usuario, senha, telefone, idade, sexo, veiculo)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sssiss", $usuario, $senha, $telefone, $idade, $sexo, $veiculo);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registro inserido com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao inserir: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>