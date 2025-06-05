<?php
// components/navbar.php

require __DIR__ . '/../config.php';
?>

<link rel="stylesheet" href="<?= BASE_URL ?>components/navbar.css">

<nav class="navbar">
    <div class="navbar-container">
        <a href="<?= BASE_URL ?>index.php" class="navbar-logo">Fatec Meet</a>

        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

        <div class="navbar-links">
            <a href="<?= BASE_URL ?>index.php" class="navbar-item">Página inicial</a>
            <a href="<?= BASE_URL ?>view/Busca.php" class="navbar-item">Buscar</a>
            <a href="<?= BASE_URL ?>view/Postar.php" class="navbar-item">Postar</a>
            <a href="<?= BASE_URL ?>view/Perfil.php" class="navbar-item">Perfil</a>
        </div>

        <div class="navbar-user-area">
            <?php if (isset($_SESSION['usuario'])): ?>
                <?php
                    $foto = $_SESSION['usuario']['foto'] ?? '';
                    $caminhoPadrao = BASE_URL . 'imagem/imgPadrao.png';

                    // Verifica se o caminho da imagem existe fisicamente
                    $caminhoFoto = $foto && file_exists(__DIR__ . '/../' . $foto)
                        ? BASE_URL . $foto
                        : $caminhoPadrao;
                ?>
                <img src="<?= htmlspecialchars($caminhoFoto) ?>" class="profile-img-mini" alt="Perfil">
                <a href="<?= BASE_URL ?>PHP/logout.php"><button class="profile-btn">Logout</button></a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>view/Login.php"><button class="profile-btn">Login</button></a>
            <?php endif; ?>
        </div>
    </div>
</nav>
