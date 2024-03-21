<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Partida</title>
</head>
<body>
    
<?php

// DATOS TABLA PARTIDAS
$tipo_equipo = $_GET['equipo'];
$modo_juego = $_GET['modo'];
$lugar_caida = $_GET['caida'];
$posicion_final = $_GET['posicion'];



$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "fortnite_stats";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión no realizada: " . $conn->connect_error);
}

$sql = "INSERT INTO `partidas` (`tipo_equipo`, `modo_juego`, `lugar_caida`, `posicion_final`) VALUES ('" . $tipo_equipo . "', '" . $modo_juego . "', '" . $lugar_caida . "', '" . $posicion_final . "');";

if ($conn->query($sql) === TRUE) {
    echo '<p>PARTIDA AÑADIDA</p>';
    echo '<a href="index.php">VOLVER A INICIO</a>';
} else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
}

$conn->close();

?>

</body>
</html>