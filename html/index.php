<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra Papel o Tijera</title>
    <link rel="stylesheet" href="styleIndex.css">
</head>

<body>
    <div class="cont-menu">
        <div class="title-container">
            <h1 class="angled-title title">Piedra</h1>
            <h1 class="normal-title title">Papel</h1>
            <h1 class="angled-title-right title">Tijera</h1>
        </div>
        <div class="conteiner-name">
            <div class="box-name">
                <h2 id="namePlayer" class="name-player">Player</h2>
                <button id="openModal" class="btn-open-modal">✏️</button>
            </div>
        </div>

        <div class="modal-name" id="modal">
            <div class="modal-cont">
                <h2>Ingresa tu nombre:</h2>
                <input type="text" id="playerNameInput" class="input-player" required>
                <button id="saveNameButton" class="btn-save">Guardar</button>
            </div>
        </div>

        <div class="list-link">
            <a href="./pages/PHP/gameOriginal.php" class="link-box" id="phpLink">JUEGO ORIGINAL (PHP)</a>
            <a href="./pages/PHP-JS/gamePlus.php" class="link-box" id="jsLink">JUEGO PLUS (PHP + JS)</a>
            <a href="./pages/Table/tableDB.php" class="link-box" id="tableLink">TABLA DE JUGADORES</a>
        </div>
    </div>

    <script src="./script.js"></script>
</body>

</html>