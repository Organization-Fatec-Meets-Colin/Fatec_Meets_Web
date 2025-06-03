<?php
    require __DIR__ . '/../config.php';
    require __DIR__ . '/../components/navbar.php';

/* recebe os dados da tela de pesquisa */
$ptipo = $_POST['tipo'];
$plocal = $_POST['local'];
$pdata = $_POST['data'];
$phora = $_POST['hora'];
$psemestre = $_POST['semestre'];
$ptitulo = $_POST['titulo'];

/* puxa os dados do banco de dados */

// query com o comando sql
$query = "SELECT `id` FROM `eventos` WHERE titulo like 'teste';";

// executando o sql
$stmt = $conexao->prepare($query);
$stmt->execute();

$array = $conexao->$query;

print_r($array);

$_SESSION['idPesquisa'] = $array;
?>