<?php
include 'db.php';
header('Content-Type: application/json');

$id = $_POST['id'];
$telefone = $_POST['telefone'] ?? null;
$idade = $_POST['idade'] ?? null;
$sexo = $_POST['sexo'] ?? null;
$veiculo = $_POST['veiculo'] ?? null;

if (!$id || !$telefone || !$idade || !$sexo || !$veiculo) {
    echo json_encode(["success" => false, "message" => "Dados incompletos"]);
    exit;
}

try {
    $stmt1 = $conn->prepare("UPDATE orcamento SET telefone = ?, idade = ?, sexo = ?, veiculo = ? WHERE id = ?");
    $stmt1->bind_param("sissi", $telefone, $idade, $sexo, $veiculo, $id);
    $stmt1->execute();

    echo json_encode(["success" => true, "message" => "Usuário, telefone e permissão alterados com sucesso."]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Ocorreu um erro ao alterar o usuário: " . $e->getMessage()]);
}
?>