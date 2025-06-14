<?php


require __DIR__ . 
'/../config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

// Dados do usuário logado
$usuario_id = $_SESSION['usuario']['id'];

try {
    // Buscar dados completos do usuário
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        throw new Exception("Usuário não encontrado");
    }

    // Definir foto de perfil (com fallback local)
    $foto = !empty($usuario['profile_image']) ? 
            BASE_URL . $usuario['profile_image'] : 
            BASE_URL . 'assets/default-profile.jpg';

    // Buscar estatísticas reais
    $stats = [
        'publicacoes' => 0,
        'seguidores' => 0,
        'seguindo' => 0
    ];

    // Contar eventos do usuário
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM eventos WHERE user_id = ?");
    $stmt->execute([$usuario_id]);
    $stats['publicacoes'] = $stmt->fetchColumn();

    // Contar seguidores (exemplo - implemente tabela followers depois)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM followers WHERE user_id = ?");
    $stmt->execute([$usuario_id]);
    $stats['seguidores'] = $stmt->fetchColumn() ?: 0;

    // Buscar eventos com informações completas
    $stmt = $pdo->prepare("
        SELECT e.*, 
               (SELECT COUNT(*) FROM likes WHERE event_id = e.event_id) as likes_count,
               (SELECT COUNT(*) FROM comments WHERE event_id = e.event_id) as comments_count
        FROM eventos e
        WHERE e.user_id = ?
        ORDER BY e.created_at DESC 
        LIMIT 6
    ");
    $stmt->execute([$usuario_id]);
    $eventos = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Erro no banco de dados: " . $e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}

// Inclui a navbar
require __DIR__ . '/../components/navbar.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($usuario['name'] ?? 'Perfil') ?> - Meets</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>view/css/estilo-perfil.css">
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
                <h1 class="profile-username"><?= htmlspecialchars($usuario['name']) ?></h1>
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
                    <span class="stat-count"><?= $stats['publicacoes'] ?></span>
                    <span class="stat-label">Eventos</span>
                </div>
                <div class="stat-item">
                    <span class="stat-count"><?= $stats['seguidores'] ?></span>
                    <span class="stat-label">Seguidores</span>
                </div>
                <div class="stat-item">
                    <span class="stat-count"><?= $stats['seguindo'] ?></span>
                    <span class="stat-label">Seguindo</span>
                </div>
            </div>

            <div class="profile-bio">
                <h2 class="bio-name"><?= htmlspecialchars($usuario['name']) ?></h2>
                <p class="bio-text">@<?= htmlspecialchars($usuario['nickmaname'] ?? '') ?></p>
                <p class="bio-text">✉️ <?= htmlspecialchars($usuario['email']) ?></p>
                <p class="bio-text">📞 <?= htmlspecialchars($usuario['numero'] ?? '') ?></p>
            </div>
        </div>
    </div>

    <div class="profile-tabs">
        <div class="tab active">
            <i class="fas fa-calendar-alt"></i>
            <span>Meus Eventos</span>
        </div>
        <div class="tab">
            <i class="far fa-bookmark"></i>
            <span>Eventos Salvos</span>
        </div>
        <div class="tab">
            <i class="fas fa-users"></i>
            <span>Participando</span>
        </div>
    </div>

    <div class="gallery">
        <?php foreach ($eventos as $evento): ?>
            <div class="photo">
                <img src="<?= !empty($evento['image_reference']) ? 
                          htmlspecialchars(BASE_URL . $evento['image_reference']) : 
                          BASE_URL . 'assets/default-event.jpg' ?>" 
                     alt="<?= htmlspecialchars($evento['title']) ?>">
                <div class="photo-overlay">
                    <span><i class="fas fa-heart"></i> <?= $evento['likes_count'] ?></span>
                    <span><i class="fas fa-comment"></i> <?= $evento['comments_count'] ?></span>
                </div>
                <div class="event-info">
                    <h3><?= htmlspecialchars($evento['title']) ?></h3>
                    <p><?= date('d/m/Y', strtotime($evento['event_date'])) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($eventos)): ?>
            <div class="no-eventos">
                <i class="fas fa-calendar-plus"></i>
                <p>Você ainda não criou nenhum evento</p>
                <a href="<?= BASE_URL ?>view/NovoEvento.php" class="btn-create-event">
                    Criar primeiro evento
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

</body>
</html>

