<?php
// PHP/upload.php

require __DIR__ . '/../config.php'; // inclui sessão, BASE_URL e $pdo

// Redireciona para login se usuário não estiver autenticado
if (!isset($_SESSION['usuario'])) {
    header('Location: ' . BASE_URL . 'view/Login.php');
    exit;
}

// Dados do formulário
$titulo     = $_POST['titulo']     ?? '';
$local      = $_POST['local']      ?? '';
$categoria  = $_POST['categoria']  ?? ''; // você ainda não usa isso no insert
$descricao  = $_POST['descricao']  ?? '';
$user_id    = $_SESSION['usuario']['id'] ?? null;

// Validação da data
if (!empty($_POST['data_evento'])) {
    $event_date = date('Y-m-d H:i:s', strtotime($_POST['data_evento']));
} else {
    die("Data do evento inválida.");
}

// Pasta de destino
$diretorio = __DIR__ . '/../uploads/';
if (!is_dir($diretorio)) {
    mkdir($diretorio, 0755, true);
}

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagemTmp     = $_FILES['imagem']['tmp_name'];
    $nomeOriginal  = basename($_FILES['imagem']['name']);
    $extensao      = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($extensao, $extensoesPermitidas)) {
        die("Formato de imagem não permitido.");
    }

    $nomeUnico      = uniqid('img_', true) . '.' . $extensao;
    $caminhoFinal   = $diretorio . $nomeUnico;
    $caminhoNoBanco = 'uploads/' . $nomeUnico;

    if (move_uploaded_file($imagemTmp, $caminhoFinal)) {
        // Inserção no banco com PDO
        $sql = "INSERT INTO events (user_id, title, description, event_date, location, image_reference)
                VALUES (:user_id, :title, :description, :event_date, :location, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id'     => $user_id,
            ':title'       => $titulo,
            ':description' => $descricao,
            ':event_date'  => $event_date,
            ':location'    => $local,
            ':image'       => $caminhoNoBanco
        ]);

        header("Location: " . BASE_URL . "index.php?sucesso=1");
        exit;
    } else {
        echo "Erro ao mover o arquivo.";
    }
} else {
    echo "Erro no upload da imagem.";
}
