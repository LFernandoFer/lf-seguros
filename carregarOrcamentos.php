<?php
include 'db.php';

$sql = "
SELECT u.ID, u.USUARIO, o.TELEFONE,
o.IDADE, o.SEXO, o.VEICULO FROM ORCAMENTO o
LEFT JOIN USUARIOS u ON u.ID = o.IDUSUARIO
";
$result = $conn->query($sql);

$orcs = [];
while ($row = $result->fetch_assoc()) {
    $orcs[] = $row;
}

header('Content-Type: application/json');
echo json_encode($orcs);
?>