<?php
    require __DIR__ . '/../config.php';
    require __DIR__ . '/../components/navbar.php';

$ptipo = $_POST['tipo'];
$plocal = $_POST['local'];
$pdata = $_POST['data'];
$phora = $_POST['hora'];
$psemestre = $_POST['semestre'];
$ptitulo = $_POST['titulo'];

$query = "SELECT * FROM eventos WHERE $titulo LIKE titulo";
$stmt = $conexao->prepare($query);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
?>