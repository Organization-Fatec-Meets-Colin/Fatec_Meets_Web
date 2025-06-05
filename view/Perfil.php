<?php require __DIR__ . '/../config.php';
      require __DIR__ . '/../components/navbar.php';

require __DIR__ . '/../config.php';
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Meets</title>
    <link rel="stylesheet" href="../view/css/estilo-perfil.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>


    <!-- Perfil -->
    <section class="profile-container">
        <div class="profile-header">
            <img src="https://i.pravatar.cc/150?img=32" alt="Foto de Perfil" class="profile-img">

            <div class="profile-info">
                <div class="top-row">
                    <h2>matheusmarinho</h2>
                    <a href="../view/EditarPerfil.php"><button class="edit-btn">Editar perfil</button></a>
                </div>
                <div class="stats">
                    <span><strong>45</strong> publicações</span>
                    <span><strong>1023</strong> seguidores</span>
                    <span><strong>876</strong> seguindo</span>
                </div>
                <div class="bio">
                    <strong>Matheus Marinho</strong><br>
                    Desenvolvedor e amante de fotografia 📸<br>
                    www.devmatheusmarinho.dev
                </div>
            </div>
        </div>

        <!-- Galeria de Fotos -->
        <div class="gallery">
            <div class="photo"><img src="imagens/post1.jpg" alt=""></div>
            <div class="photo"><img src="imagens/post2.jpg" alt=""></div>
            <div class="photo"><img src="imagens/post3.jpg" alt=""></div>
            <div class="photo"><img src="imagens/post1.jpg" alt=""></div>
            <div class="photo"><img src="imagens/post2.jpg" alt=""></div>
            <div class="photo"><img src="imagens/post3.jpg" alt=""></div>
        </div>
    </section>

</body>
</html>
