<?php
require __DIR__ . '/../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

// Dados do usuário logado
$usuario = $_SESSION['usuario'];
$foto = !empty($usuario['foto']) ? BASE_URL . $usuario['foto'] : 'https://i.pravatar.cc/150?img=32';

// Inclui a navbar
require __DIR__ . '/../components/navbar.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($usuario['nome']) ?> - Meets</title>
    <link rel="stylesheet" href="../view/css/estilo-perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<section class="profile-container">
    <div class="profile-header">
        <div class="profile-img-container">
            <img src="<?= htmlspecialchars($foto) ?>" alt="Foto de Perfil" class="profile-img">
        </div>

        <div class="profile-info">
            <div class="profile-actions">
                <h1 class="profile-username"><?= htmlspecialchars($usuario['nome']) ?></h1>
                <div class="action-buttons">
                    <a href="<?= BASE_URL ?>view/EditarPerfil.php" class="btn-edit">
                        <button class="edit-btn">Editar perfil</button>
                    </a>
                    <button class="settings-btn" aria-label="Configurações">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-count">45</span>
                    <span class="stat-label">publicações</span>
                </div>
                <div class="stat-item">
                    <span class="stat-count">1.2k</span>
                    <span class="stat-label">seguidores</span>
                </div>
                <div class="stat-item">
                    <span class="stat-count">876</span>
                    <span class="stat-label">seguindo</span>
                </div>
            </div>

            <div class="profile-bio">
                <h2 class="bio-name"><?= htmlspecialchars($usuario['nome']) ?></h2>
                <p class="bio-text">Desenvolvedor e amante de fotografia 📸</p>
                <a href="https://www.devmatheusmarinho.dev" target="_blank" class="bio-link">www.devmatheusmarinho.dev</a>
            </div>
        </div>
    </div>

    <div class="profile-tabs">
        <div class="tab active">
            <i class="fas fa-th"></i>
            <span>Publicações</span>
        </div>
        <div class="tab">
            <i class="far fa-bookmark"></i>
            <span>Salvos</span>
        </div>
        <div class="tab">
            <i class="far fa-user"></i>
            <span>Marcados</span>
        </div>
    </div>

    <div class="gallery">
        <div class="photo">
            <img src="imagens/post1.jpg" alt="Post 1">
            <div class="photo-overlay">
                <span><i class="fas fa-heart"></i> 245</span>
                <span><i class="fas fa-comment"></i> 32</span>
            </div>
        </div>
        <div class="photo">
            <img src="imagens/post2.jpg" alt="Post 2">
            <div class="photo-overlay">
                <span><i class="fas fa-heart"></i> 189</span>
                <span><i class="fas fa-comment"></i> 14</span>
            </div>
        </div>
        <div class="photo">
            <img src="imagens/post3.jpg" alt="Post 3">
            <div class="photo-overlay">
                <span><i class="fas fa-heart"></i> 312</span>
                <span><i class="fas fa-comment"></i> 45</span>
            </div>
        </div>
        <div class="photo">
            <img src="imagens/post1.jpg" alt="Post 4">
            <div class="photo-overlay">
                <span><i class="fas fa-heart"></i> 112</span>
                <span><i class="fas fa-comment"></i> 8</span>
            </div>
        </div>
        <div class="photo">
            <img src="imagens/post2.jpg" alt="Post 5">
            <div class="photo-overlay">
                <span><i class="fas fa-heart"></i> 276</span>
                <span><i class="fas fa-comment"></i> 23</span>
            </div>
        </div>
        <div class="photo">
            <img src="imagens/post3.jpg" alt="Post 6">
            <div class="photo-overlay">
                <span><i class="fas fa-heart"></i> 198</span>
                <span><i class="fas fa-comment"></i> 19</span>
            </div>
        </div>
    </div>
</section>

</body>
</html>