<?php
$host = 'mysql';  // Nombre del servicio MySQL en Docker Compose
$user = 'root';
$password = 'rootadmin';
$database = 'juego';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$query = "SELECT * FROM Partida";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Resultados</title>
    <link rel="stylesheet" href="stylesTable.css">
</head>

<body>
    <div class="container">
        <h1>Tabla de Resultados</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Resultado</th>
                <th>Jugador</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['resultado']; ?></td>
                    <td><?php echo $row['jugador']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <a href="../../index.php" class="return-link">Volver al Inicio</a>
</body>

</html>