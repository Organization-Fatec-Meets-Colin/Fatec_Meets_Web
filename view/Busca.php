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
    <form action="ResultadosBusca.php" method="GET" class="search-form">
        <div class="form-group">
            <label for="tipo">Tipo de Evento:</label>
            <select name="tipo" id="tipo">
                <option value="">Todos</option>
                <option value="Palestra">Palestra</option>
                <option value="Workshop">Workshop</option>
                <option value="Festa">Festa</option>
                <option value="Feira">Feira</option>
            </select>
        </div>

        <div class="form-group">
            <label for="local">Local:</label>
            <select name="local" id="local">
                <option value="">Todos</option>
                <option value="Auditório">Auditório</option>
                <option value="Sala 101">Sala 101</option>
                <option value="Pátio">Pátio</option>
                <option value="Laboratório">Laboratório</option>
            </select>
        </div>

        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data">
        </div>

        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora">
        </div>

        <div class="form-group">
            <label for="semestre">Semestre:</label>
            <select name="semestre" id="semestre">
                <option value="">Todos</option>
                <option value="1">1º Semestre</option>
                <option value="2">2º Semestre</option>
                <option value="3">3º Semestre</option>
                <option value="4">4º Semestre</option>
                <option value="5">5º Semestre</option>
                <option value="6">6º Semestre</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pesquisa">Pesquisar:</label>
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite algo...">
        </div>

        <button type="submit" class="btn">Buscar</button>
    </form>
</div>

</body>
</html>