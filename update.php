<?php
include 'db.php';
header('Content-Type: application/json');

$id = $_POST['id'];
$name = $_POST['name'];
$telefone = $_POST['telefone'];
$permissao = $_POST['permissao'];

if (!$id || !$name || !$permissao) {
    echo json_encode(["success" => false, "message" => "Dados incompletos"]);
    exit;
}

try { 
    $stmt1 = $conn->prepare("UPDATE usuarios SET usuario=?, permissao=? WHERE id=?");
    $stmt1->bind_param("ssi", $name, $permissao, $id);
    $stmt1->execute();

    $stmt2 = $conn->prepare("UPDATE orcamento SET telefone=? WHERE idusuario=?");
    $stmt2->bind_param("si", $telefone, $id);
    $stmt2->execute();

    echo json_encode(["success" => true, "message" => "Usuário, telefone e permissão alterados com sucesso."]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Ocorreu um erro ao alterar o usuário"]);
}
?>
