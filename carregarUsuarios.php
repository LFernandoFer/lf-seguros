<?php
include 'db.php';

$sql = "
SELECT u.ID, u.USUARIO, u.PERMISSAO, o.TELEFONE
FROM USUARIOS u
LEFT JOIN ORCAMENTO o ON u.ID = o.IDUSUARIO
";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

header('Content-Type: application/json');
echo json_encode($users);
?>
