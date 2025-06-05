<?php
// components/navbar.php

// Inclui apenas a configuração central, que já tem BASE_URL e session_start
require __DIR__ . '/../config.php';
?>

<link rel="stylesheet" href="<?= BASE_URL ?>components/navbar.css">

<nav class="navbar">
    <div class="navbar-container">
        <a href="<?= BASE_URL ?>index.php" class="navbar-logo">Fatec Meet</a>

        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>

            <!-- dark mode -->
        <div class="navbar-user-area">
        <!-- ✅ Botão interruptor -->
        <label for="dark-toggle" class="switch">
        <span class="slider"></span>
        </label>
        </div>

        <div class="navbar-links">
            <a href="<?= BASE_URL ?>index.php" class="navbar-item">Página inicial</a>
            <a href="<?= BASE_URL ?>view/Busca.php" class="navbar-item">Buscar</a>
            <a href="<?= BASE_URL ?>view/Postar.php" class="navbar-item">Postar</a>
            <a href="<?= BASE_URL ?>view/Perfil.php" class="navbar-item">Perfil</a>
        </div>

        <div class="navbar-user-area">
            <?php if (isset($_SESSION['usuario'])): ?>
                <img src="<?= htmlspecialchars($_SESSION['usuario']['foto']) ?>" class="profile-img-mini" alt="Perfil">
                <a href="<?= BASE_URL ?>PHP/logout.php"><button class="profile-btn">Logout</button></a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>view/Login.php"><button class="profile-btn">Login</button></a>
            <?php endif; ?>

                
        </div>
    </div>
</nav>
