<?php
$name = $_GET['player'];
$cpuChoice = '';
$cpuChoices = ['piedra', 'papel', 'tijera'];
$result = '';
$playerChoice = '';
$msj_info = '';
$showMsj = false;

function determinarWin($playerChoice, $cpuChoice)
{
    if ($playerChoice == $cpuChoice) {
        return "Empate";
    } elseif (
        ($playerChoice === 'piedra' && $cpuChoice === 'tijera') ||
        ($playerChoice === 'tijera' && $cpuChoice === 'papel') ||
        ($playerChoice === 'papel' && $cpuChoice === 'piedra')
    ) {
        return "Ganaste";
    } else {
        return "Perdiste";
    }
}

function saveResultado($result, $playerName, $choiceCpu, $choicePlayer)
{
    $host = 'mysql';
    $user = 'root';
    $password = 'rootadmin';
    $database = 'juego';

    $mysqli = new mysqli($host, $user, $password, $database);

    if ($mysqli->connect_error) {
        header("Location: index.html");
        exit();
    }

    $name = mysqli_real_escape_string($mysqli, $playerName);
    $result = mysqli_real_escape_string($mysqli, $result);

    $query = "INSERT INTO Partida (resultado, jugador, eleccion_jugador, eleccion_cpu) 
              VALUES ('$result', '$name', '$choicePlayer', '$choiceCpu')";

    if ($mysqli->query($query)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['gameSubmit'])) {
    $playerChoice = $_POST['opt'];
    $cpuChoice = $cpuChoices[array_rand($cpuChoices)];
    $result = determinarWin($playerChoice, $cpuChoice);
}

if (isset($_POST['submitResultToDatabase'])) {
    $playerChoice = $_POST['playerChoice'];
    $cpuChoice = $_POST['cpuChoice'];
    $result = determinarWin($playerChoice, $cpuChoice);

    $insertSuccess = saveResultado($result, $name, $cpuChoice, $playerChoice);

    if ($insertSuccess) {
        header("Location: ../Table/tableDB.php");
        exit();
    } else {
        $msj_info = "Hubo un error al guardar el resultado en la base de datos.";
    }

    $showMsj = true;
}

if (isset($_POST['playAgain'])) {
    $playerChoice = $_POST['playerChoice'];
    $cpuChoice = $_POST['cpuChoice'];
    $result = determinarWin($playerChoice, $cpuChoice);

    $insertSuccess = saveResultado($result, $name, $cpuChoice, $playerChoice);

    $result = '';
    $playerChoice = '';
    $cpuChoice = '';
    $msj_info = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Original</title>
    <link rel="stylesheet" href="styleGame.css">
</head>

<body>
    <div class="title-container">
        <h1 class="angled-title title">Piedra</h1>
        <h1 class="normal-title title">Papel</h1>
        <h1 class="angled-title-right title">Tijera</h1>
    </div>
    <div class="cont-game">
        <form method="POST" class="form">
            <h2 class="subtitle">Seleccione tu jugada <?php echo $name ?></h2>
            <div class="options-cont">
                <div class="opt-cont">
                    <input type="radio" name="opt" value="piedra" id="piedra" required class="in-opt">
                    <label for="piedra" class="opt-label">
                        <img src="../../img/piedra.png" alt="img-piedra" class="img-opt">
                        <span class="text-opt">PIEDRA</span>
                    </label>
                    </input>
                </div>
                <div class="opt-cont">
                    <input type="radio" name="opt" value="papel" id="papel" required class="in-opt">
                    <label for="papel" class="opt-label">
                        <img src="../../img/papel.png" alt="img-papel" class="img-opt">
                        <span class="text-opt">PAPEL</span>
                    </label>
                    </input>
                </div>
                <div class="opt-cont">
                    <input type="radio" name="opt" value="tijera" id="tijera" required class="in-opt">
                    <label for="tijera" class="opt-label">
                        <img src="../../img/tijera.png" alt="img-tijera" class="img-opt">
                        <span class="text-opt">TIJERA</span>
                    </label>
                    </input>
                </div>
            </div>

            <button type="submit" name="gameSubmit" class="btn-play">¡Jugar!</button>
        </form>

        <h3>VS</h3>

        <div class="cont-cpu">
            <div class="box-cpu">
                <h2 class="title-cpu">CPU</h2>
                <img src="../../img/cpu.png" alt="cpu-img" class="img-cpu">
            </div>
        </div>
    </div>

    <a href="../../index.php" class="return-link">Volver al Inicio</a>

    <?php if ($playerChoice) : ?>
        <div class="modal-result">
            <div class="cont-result">
                <p class="text-choise">Elección de la CPU: <?php echo ucfirst($cpuChoice); ?></p>
                <p class="text-choise-player">Tu eleccion: <?php echo ucfirst($playerChoice); ?></p>
                <p class="text-result-finaly">Resultado: <?php echo $result; ?></p>
                <?php if ($showMsj) : ?>
                    <div class='msj-box'>
                        <p> <?php echo $msj_info ?></p>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <input type="hidden" name="playerChoice" value="<?php echo $playerChoice; ?>">
                    <input type="hidden" name="cpuChoice" value="<?php echo $cpuChoice; ?>">
                    <div class="btn-result">
                        <button type="submit" class="btn-res save" name="submitResultToDatabase">Guardar Resultado e Ir a la tabla</button>
                        <button type="submit" class="btn-res again" name="playAgain">Revancha</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>