<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $usuario  = trim($_POST['usuario'] ?? '');
    $senha    = md5(trim($_POST['senha'] ?? ''));
    $telefone = trim($_POST['telefone'] ?? '');
    $idade    = intval($_POST['idade'] ?? 0);
    $sexo     = strtoupper(trim($_POST['sexo'] ?? ''));
    $veiculo  = trim($_POST['veiculo'] ?? '');

    // Validações back-end
    if (!$usuario || !$senha || !$sexo || !in_array($sexo, ['M','F'])) {
        echo json_encode(["success" => false, "message" => "Dados inválidos!"]);
        exit;
    }

    // Inserção USUARIOS
    $stmt1 = $conn->prepare("INSERT INTO USUARIOS (USUARIO, SENHA) VALUES (?, ?)");
    $stmt1->bind_param("ss", $usuario, $senha);

    if ($stmt1->execute()) {
        $idUsuario = $conn->insert_id;

        // Inserção ORCAMENTO
        $stmt2 = $conn->prepare("INSERT INTO ORCAMENTO (IDUSUARIO, TELEFONE, IDADE, SEXO, VEICULO) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("issss", $idUsuario, $telefone, $idade, $sexo, $veiculo);

        if ($stmt2->execute()) {
            echo json_encode(["success" => true, "message" => "Registro inserido com sucesso!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao inserir orçamento: " . $stmt2->error]);
        }
        $stmt2->close();
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao inserir usuário: " . $stmt1->error]);
    }

    $stmt1->close();
    $conn->close();
}