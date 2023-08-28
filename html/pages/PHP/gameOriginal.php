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

function saveResultado($result, $playerName)
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

    $query = "INSERT INTO Partida (resultado, jugador) 
              VALUES ('$result', '$name')";

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

    $insertSuccess = saveResultado($result, $name);

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

    $insertSuccess = saveResultado($result, $name);

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
    <link rel="stylesheet" href="styleGameOriginal.css">
</head>

<body>
    <h1 class="title">Juego de Piedra, papel o tijera</h1>
    <form method="POST" class="form">
        <h2 class="subtitle">Seleccione tu jugada <?php echo $name ?></h2>
        <div class="options-cont">
            <div class="opt-cont">
                <input type="radio" name="opt" value="piedra" id="piedra" required>
                <label for="piedra">
                    <img src="../../img/piedra.png" alt="img-piedra" class="img-opt">
                    <span class="text-opt">PIEDRA</span>
                </label>
                </input>
            </div>
            <div class="opt-cont">
                <input type="radio" name="opt" value="papel" id="papel" required>
                <label for="papel">
                    <img src="../../img/papel.png" alt="img-papel" class="img-opt">
                    <span class="text-opt">PAPEL</span>
                </label>
                </input>
            </div>
            <div class="opt-cont">
                <input type="radio" name="opt" value="tijera" id="tijera" required>
                <label for="tijera">
                    <img src="../../img/tijera.png" alt="img-tijera" class="img-opt">
                    <span class="text-opt">TIJERA</span>
                </label>
                </input>
            </div>
        </div>

        <button type="submit" name="gameSubmit">¡Jugar!</button>
    </form>

    <h3>VS</h3>

    <div class="cont-cpu">
        <div class="box-cpu">
            <h2 class="title-cpu">CPU</h2>
            <img src="../../img/cpu.png" alt="cpu-img" class="img-cpu">
        </div>
    </div>

    <?php if ($playerChoice) : ?>
        <div class="modal-result">
            <div class="cont-result">
                <p>Elección de la CPU: <?php echo ucfirst($cpuChoice); ?></p>
                <p>Resultado: <?php echo $result; ?></p>
                <?php if ($showMsj) : ?>
                    <div class='msj-box'>
                        <p> <?php echo $msj_info ?></p>
                    </div>
                <?php endif; ?>
                <form method="POST">
                    <input type="hidden" name="playerChoice" value="<?php echo $playerChoice; ?>">
                    <input type="hidden" name="cpuChoice" value="<?php echo $cpuChoice; ?>">
                    <div class="btn-result">
                        <button type="submit" name="submitResultToDatabase">Guardar Resultado e Ir a la tabla</button>
                        <button type="submit" name="playAgain">Revancha</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>