<?php
session_start();

// Exibir erros para debug (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
require __DIR__ . '/../config.php'; 

// Verifica se o email está na sessão
if (!isset($_SESSION['usuario'])) {
    echo "Usuário não autenticado.";
    exit;
}

// Obtém email do usuário autenticado
$email = $_SESSION['usuario']['email'];

// Buscar dados do usuário pelo e-mail
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmtUser->execute([$email]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

<<<<<<< Updated upstream
    if (!$usuario) {
        throw new Exception("Usuário não encontrado");
    }

// CORREÇÃO NO CÓDIGO PHP (parte superior)
$foto = !empty($usuario['profile_image']) ? 
        BASE_URL . 'uploads/' . $usuario['profile_image'] : 
        BASE_URL . 'uploads/imgPadrao.png';

// Verifique o nome real do campo no banco:
//print_r($usuario); // Descomente para debug

    // Buscar estatísticas reais
    $stats = [
        'publicacoes' => 0,
        'seguidores' => 0,
        'seguindo' => 0
    ];

    // Contar eventos do usuário
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM eventos WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    $stats['publicacoes'] = $stmt->fetchColumn();


    // Buscar eventos com informações completas
    $stmt = $pdo->prepare("
        SELECT e.*, 
               (SELECT COUNT(*) FROM likes WHERE id = e.id) as likes_count,
               (SELECT COUNT(*) FROM comentarios WHERE id = e.id) as comments_count
        FROM eventos e
        WHERE e.usuario_id = ?
        ORDER BY e.data_criacao DESC 
        LIMIT 6
    ");
    $stmt->execute([$usuario_id]);
    $eventos = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Erro no banco de dados: " . $e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
=======
if (!$user) {
    echo "Usuário não encontrado.";
    exit;
>>>>>>> Stashed changes
}

$userId = $user['user_id']; // ID necessário para buscar eventos

// Buscar eventos criados pelo usuário com dados agregados
$stmtEventos = $pdo->prepare("
    SELECT 
        e.*, 
        (SELECT COUNT(*) FROM likes l WHERE l.id = e.id) AS total_likes,
        (SELECT COUNT(*) FROM comments c WHERE c.id = e.id) AS total_comments,
        (SELECT COUNT(*) FROM attendees a WHERE a.id = e.id AND a.status = 'confirmado') AS total_presencas
    FROM eventos e
    WHERE e.user_id = ?
    ORDER BY e.created_at DESC
");
$stmtEventos->execute([$userId]);
$eventos = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<<<<<<< Updated upstream
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <titulo><?= htmlspecialchars($usuario['nome'] ?? 'Perfil') ?> - Meets</titulo>
    <link rel="stylesheet" href="<?= BASE_URL ?>view/css/estilo-perfil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<section class="profile-container">
    <div class="profile-header">
        <div class="profile-img-container">
            <pre><?= $foto ?></pre>

                <img src="<?= htmlspecialchars($foto) ?>" 
     alt="Foto de Perfil" 
     class="profile-img"
     onerror="this.onerror=null; this.src='<?= BASE_URL ?>uploads/imgPadrao.png'">
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
                <h2 class="bio-name"><?= htmlspecialchars($usuario['nome']) ?></h2>
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
                <img src="<?= !empty($evento['imagem']) ? 
                          htmlspecialchars(BASE_URL . $evento['imagem']) : 
                          BASE_URL . 'assets/default-event.jpg' ?>" 
                     alt="<?= htmlspecialchars($evento['titulo']) ?>">
                <div class="photo-overlay">
                    <span><i class="fas fa-heart"></i> <?= $evento['likes_count'] ?></span>
                    <span><i class="fas fa-comment"></i> <?= $evento['comments_count'] ?></span>
                </div>
                <div class="event-info">
                    <h3><?= htmlspecialchars($evento['titulo']) ?></h3>
                    <p><?= date('d/m/Y', strtotime($evento['data_evento'])) ?></p>
=======
    <title>Perfil de <?= htmlspecialchars($user['name']) ?></title>
    <style>
        body { font-family: Arial; background-color: #f5f5f5; margin: 20px; }
        .perfil { background: white; padding: 20px; border-radius: 10px; max-width: 800px; margin: auto; }
        .perfil img { width: 150px; border-radius: 50%; }
        .eventos { margin-top: 30px; }
        .evento { border-bottom: 1px solid #ccc; padding: 15px 0; }
        .evento img { max-width: 100%; border-radius: 10px; }
    </style>
</head>
<body>

<div class="perfil">
    <h1>Perfil de <?= htmlspecialchars($user['name']) ?></h1>
    <img src="<?= $user['profile_image'] ? htmlspecialchars($user['profile_image']) : 'img/default.png' ?>" alt="Foto de perfil">
    <p><strong>Apelido:</strong> <?= htmlspecialchars($user['nickname']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Número:</strong> <?= htmlspecialchars($user['numero']) ?></p>

    <div class="eventos">
        <h2>Eventos Criados</h2>
        <?php if (count($eventos) === 0): ?>
            <p>Nenhum evento criado.</p>
        <?php else: ?>
            <?php foreach ($eventos as $evento): ?>
                <div class="evento">
                    <h3><?= htmlspecialchars($evento['title']) ?></h3>
                    <p><strong>Data:</strong> <?= htmlspecialchars($evento['event_date']) ?></p>
                    <p><strong>Local:</strong> <?= htmlspecialchars($evento['location']) ?></p>
                    <?php if (!empty($evento['image_reference'])): ?>
                        <img src="<?= htmlspecialchars($evento['image_reference']) ?>" alt="Imagem do evento">
                    <?php endif; ?>
                    <p><?= nl2br(htmlspecialchars($evento['description'])) ?></p>
                    <p>👍 Curtidas: <?= $evento['total_likes'] ?> |
                       💬 Comentários: <?= $evento['total_comments'] ?> |
                       ✅ Confirmados: <?= $evento['total_presencas'] ?>
                    </p>
>>>>>>> Stashed changes
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
