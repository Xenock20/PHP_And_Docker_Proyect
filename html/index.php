<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra Papel o Tijera</title>
    <style>
        /*Por motivos de conflictos con los archivos solo es posible el uso de estilos en el mismo index*/

        @import url('https://fonts.googleapis.com/css2?family=Gluten&family=Open+Sans&display=swap');

        body {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f1f1f1;
            font-family: 'Open Sans', sans-serif;
        }

        a:link,
        a:visited,
        a:active {
            text-decoration: none;
        }

        .cont-menu {
            width: 50%;
            height: 100%;
            margin: auto;
        }

        .title-container {
            width: 500px;
            text-align: center;
            font-size: 24px;
            margin: 20px auto;
            height: 25%;
        }

        .title {
            display: inline-block;
            position: relative;
            padding: 10px;
            border-radius: 10px;
            color: rgb(255, 255, 255);
            font-family: 'Gluten', cursive;
        }

        .angled-title {
            transform: rotate(-25deg);
            z-index: 1;
            left: 30px;
            background-color: blue;
        }

        .normal-title {
            top: -10px;
            z-index: 2;
            background-color: red;
        }

        .angled-title-right {
            transform: rotate(25deg);
            z-index: 3;
            right: 30px;
            background-color: rgb(233, 233, 0);
        }

        .conteiner-name {
            height: 10%;
        }

        .box-name {
            width: 50%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .name-player {
            text-align: center;
            font-size: 28px;
            margin: 0px 20px;
        }

        .btn-open-modal {
            font-size: 24px;
            width: 45px;
            height: 45px;
            padding: 5px;
            border: none;
            border-bottom: 5px solid #010101;
            background-color: #fff;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.1s;
        }

        .btn-open-modal:hover {
            border-bottom: 2px solid #010101;
        }

        .modal-name {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 10;
            display: flex;
            justify-content: center;
        }

        .modal-cont {
            width: 300px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .btn-save {
            width: 75px;
            height: 35px;
            font-size: 17px;
            margin: 5px;
        }

        .input-player {
            height: 28px;
            padding: 2px;
            font-size: 17px;
            outline: none;
            text-align: center;
        }

        .list-link {
            width: 100%;
            height: 55%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        .link-box {
            cursor: pointer;
            text-align: center;
            width: 215px;
            height: 30px;
            padding: 10px;
            border-radius: 15px;
            background-color: purple;
            transition: all 0.5s;
            color: white;
            font-size: 18px;
        }

        .link-box:hover {
            transform: scale(1.2);
        }
    </style>
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
        </div>
    </div>

    <script src="./script.js"></script>
</body>

</html>