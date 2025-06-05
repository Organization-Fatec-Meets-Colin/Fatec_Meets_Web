<?php 
      require __DIR__ . '/../config.php';  
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
    <title>Criar Post - Fatec Meet</title>
    <link rel="stylesheet" href="css/estilo-postar.css">
    <!-- Adicione Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>


    
    <div class="container">
        <div class="post-form">
            <h2>Criar Novo Post</h2>
            <form action="../PHP/Upload.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título do evento:</label>
                    <input type="text" id="titulo" name="titulo" required>
                    <span class="hint">Escolha o título para o seu meet</span>
                </div>

                <div class="form-group">
                    <label for="local">Local do evento:</label>
                    <input type="text" id="local" name="local" required>

                    <span class="hint">Ex: Biblioteca, sala maker, quadra ou na grama</span>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Selecione uma categoria</option>
                        <option value="leitura">Leitura</option>
                        <option value="esporte">Esporte</option>
                        <option value="estudos">Estudos</option>
                        <option value="musica">Música</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_evento">Data e Hora do Evento:</label>
                    <input type="datetime-local" id="data_evento" name="data_evento" required>
                    <span class="hint">Escolha quando o evento vai acontecer</span>
                </div>



                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" required></textarea>
                    <span class="hint">Aqui é um espaço livre para falar mais sobre seu meet! :) </span>
                </div>

                <div class="form-group">
                    <label for="imagem">Selecionar Imagem:</label>
                    <div class="file-upload">
                        <label for="imagem" class="upload-area" id="uploadLabel">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="upload-text">Arraste e solte uma imagem ou clique para selecionar</span>
                            <span class="file-info" id="fileInfo">Nenhum arquivo selecionado</span>
                        </label>
                        <input type="file" id="imagem" name="imagem" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Postar <i class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar nome do arquivo selecionado
        document.getElementById('imagem').addEventListener('change', function (e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Nenhum arquivo selecionado';
            document.getElementById('fileInfo').textContent = fileName;

            // Mostrar prévia da imagem se quiser
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const uploadLabel = document.getElementById('uploadLabel');
                    uploadLabel.style.backgroundImage = `url(${event.target.result})`;
                    uploadLabel.style.backgroundSize = 'cover';
                    uploadLabel.style.backgroundPosition = 'center';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });


        document.querySelector('.menu-toggle').addEventListener('click', function () {
            document.querySelector('.navbar-links').classList.toggle('active');
        });

    </script>

</body>

</html>