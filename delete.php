<?php
include 'db.php';

$id = $_GET['id'];

try {
    $stmt1 = $conn->prepare("DELETE FROM orcamento WHERE idusuario=?");
    $stmt1->bind_param("i",$id);
    $stmt1->execute();

    $stmt2 = $conn->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt2->bind_param("i",$id);
    $stmt2->execute();    

    echo json_encode(["success" => true, "message" => "Usuário excluído com sucesso"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Ocorreu um erro ao excluir o usuario"]);
}
?>
