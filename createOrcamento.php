<?php
include 'db.php';
header('Content-Type: application/json');

$name     = $_POST['name'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$idade    = $_POST['idade'] ?? null;
$sexo     = $_POST['sexo'] ?? null;
$veiculo  = $_POST['veiculo'] ?? null;

try {
    if (!$name || !$telefone || !$idade || !$sexo || !$veiculo) {
        echo json_encode(["success" => false, "message" => "Dados incompletos"]);
        exit;
    }
    $stmtCheck = $conn->prepare("SELECT u.id AS usuario_id
                                 FROM usuarios u 
                                 JOIN orcamento o ON u.id = o.idusuario 
                                 WHERE u.usuario = ? AND o.telefone = ?");
    $stmtCheck->bind_param("ss", $name, $telefone);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idUsuario = $row['usuario_id'];
    } else {
        $stmtUser = $conn->prepare("INSERT INTO usuarios (usuario) VALUES (?)");
        $stmtUser->bind_param("s", $name);
        if ($stmtUser->execute()) {
            $idUsuario = $conn->insert_id;
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao inserir usuário: " . $stmtUser->error]);
            exit;
        }
        $stmtUser->close();
    }
    $stmtCheck->close();

    $stmtOrc = $conn->prepare("INSERT INTO orcamento (idusuario, telefone, idade, sexo, veiculo) 
                               VALUES (?, ?, ?, ?, ?)");
    $stmtOrc->bind_param("isiss", $idUsuario, $telefone, $idade, $sexo, $veiculo);

    if ($stmtOrc->execute()) {
        echo json_encode(["success" => true, "message" => "Orçamento cadastrado com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao inserir orçamento: " . $stmtOrc->error]);
    }

    $stmtOrc->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Erro inesperado: " . $e->getMessage()]);
}
?>