<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Eventos - Fatec Meets</title>
    <link rel="stylesheet" href="css/estilo-busca.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>


<?php include '../components/navbar.php'; ?>

<div class="container">
    <h1>Buscar Eventos</h1>
    <form action="Exibir_pesquisa.php" method="GET" class="search-form">
        <div class="form-group">
            <label for="tipo">Tipo de Evento:</label>
            <select name="tipo" id="tipo">
                <option value="%" selected>Todos</option>
                <option value="estudos">Estudos</option>
                <option value="leitura">Leitura</option>
                <option value="esporte">Esportes</option>
                <option value="musica">Musica</option>
            </select>
        </div>

        <div class="form-group">
            <label for="local">Local:</label>
            <input type="text" name="local" id="local">
            <!-- <select name="local" id="local">
                <option value="%" selected>Todos</option>
                <option value="Auditório">Auditório</option>
                <option value="Sala 101">Sala 101</option>
                <option value="Pátio">Pátio</option>
                <option value="Laboratório">Laboratório</option>
                <option value="Biblioteca">Biblioteca</option>
                <option value="Cantina">Cantina</option>
                <option value="Sala de Estudos">Sala de Estudos</option>
                <option value="Fatec">Fatec</option>
            </select> -->
        </div>

        <!-- <div class="form-group">
            <label for="data_inicial">Data:</label>
            <input type="date" name="data_inicial" id="data_inicial" placeholder="Desde">
        </div> -->

        <!-- <div class="form-group">
            <label for="data_final">Até:</label>
            <input type="date" name="data_final" id="data_final" placeholder="até">
        </div>

        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora">
        </div> -->

        <!-- Não tem semestre no cadastro dos eventos (não sei porque pesquisar por semestre) -->
        <!-- <div class="form-group">
            <label for="semestre">Semestre:</label>
            <select name="semestre" id="semestre">
                <option value="%">Todos</option>
                <option value="1">1º Semestre</option>
                <option value="2">2º Semestre</option>
                <option value="3">3º Semestre</option>
                <option value="4">4º Semestre</option>
                <option value="5">5º Semestre</option>
                <option value="6">6º Semestre</option>
            </select>
        </div> -->

        <div class="form-group">
            <label for="pesquisa">Pesquisar:</label>
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite algo...">
        </div>

        <button type="submit" class="btn">Buscar</button>
    </form>
</div>

</body>
</html>