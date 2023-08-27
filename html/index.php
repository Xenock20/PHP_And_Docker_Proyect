<?php
$host = 'mysql';  // Nombre del servicio MySQL en Docker Compose
$user = 'root';
$password = 'rootadmin';
$database = 'juego';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully to MySQL!";
?>
