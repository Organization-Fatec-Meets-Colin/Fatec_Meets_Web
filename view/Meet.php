<?php 


// components/navbar.php
// Incluir o arquivo de configuração
require __DIR__ . '/config.php';

    session_start(); 
    include '../components/navbar.php'; 


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Evento - Fatec Meet</title>
    <link rel="stylesheet" href="css/estilo-feeds.css">

</head>
<body>

<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
    ?>

<div class="meet-container">
    <img src="imagens/post1.jpg" alt="Imagem do Evento" class="meet-image">

    <h1 class="meet-title">Reunião do Grupo de ADM</h1>

    <p class="meet-description">
        Nesta reunião discutiremos as metas e diretrizes do projeto integrador. 
        Tragam laptops, ideias e disposição! Participação vale pontos extras.
    </p>

    <div class="meet-buttons">
        <button onclick="confirmarPresenca()">Confirmar Presença</button>
        <button onclick="curtirPost()">Curtir ❤️</button>
    </div>
</div>

<script>
    function confirmarPresenca() {
        alert("Presença confirmada com sucesso!");
    }

    function curtirPost() {
        alert("Você curtiu este post!");
    }
</script>

</body>
</html>
