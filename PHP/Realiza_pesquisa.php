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

// consulta no banco
$stmt = $pdo->query("SELECT e.*, u.nome, u.foto FROM eventos e
                     JOIN users u ON e.usuario_id = u.user_id 
                     WHERE e.titulo LIKE '%$ptitulo%' ORDER BY e.data_criacao DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>