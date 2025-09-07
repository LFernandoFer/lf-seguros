<?php
include 'db.php';
header('Content-Type: application/json');

$name = $_POST['name'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$permissao = $_POST['permissao'] ?? null;

if (!$name || !$permissao) {
    echo json_encode(["success" => false, "message" => "Nome e permissão são obrigatórios."]);
    exit;
}

try {
    $stmt1 = $conn->prepare("INSERT INTO usuarios (usuario, permissao) VALUES (?, ?)");
    $stmt1->bind_param("ss", $name, $permissao);

    if ($stmt1->execute()) {
        $idUsuario = $conn->insert_id;

        $stmt2 = $conn->prepare("INSERT INTO orcamento (idusuario, telefone) VALUES (?, ?)");
        $stmt2->bind_param("is", $idUsuario, $telefone);

        if ($stmt2->execute()) {
            echo json_encode(["success" => true, "message" => "Usuário cadastrado com sucesso!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao inserir orçamento: " . $stmt2->error]);
        }

        $stmt2->close();
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao inserir usuário: " . $stmt1->error]);
    }

    $stmt1->close();
    $conn->close();
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Erro inesperado: " . $e->getMessage()]);
}
?>