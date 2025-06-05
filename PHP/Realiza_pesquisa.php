<?php
    require __DIR__ . '/../config.php';

/* recebe os dados da tela de pesquisa */
$ptipo = $_POST['tipo'];
$plocal = $_POST['local'];
$pdata = $_POST['data'];
$phora = $_POST['hora'];
$psemestre = $_POST['semestre'];
$ptitulo = $_POST['titulo'];

/* puxa os dados do banco de dados */

// query com o comando sql
$query = "SELECT * FROM eventos";
// $query = "SELECT * FROM `eventos`";

// executando o sql
 /* $stmt = $pdo->prepare($query);
$stmt->execute();

$array = $pdo->$query;*/

$array = $pdo->query($query)->fetchAll();

print_r($array);
// while ($array){
//     echo $array['id'];
// };

$_SESSION['idPesquisa'] = $array;
?>