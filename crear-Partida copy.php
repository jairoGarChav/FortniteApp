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

$muertes_jugador1 = $_GET['muertes_jugador1'];
$muertes_jugador2 = $_GET['muertes_jugador2'];
$muertes_jugador3 = $_GET['muertes_jugador3'];
$muertes_jugador4 = $_GET['muertes_jugador4'];




$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "fortnite3";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión no realizada: " . $conn->connect_error);
}

// Obtener el nombre del jugador seleccionado para cada jugador
$jugador1_nombre = $_GET['jugador1'];
$jugador2_nombre = $_GET['jugador2'];
$jugador3_nombre = $_GET['jugador3'];
$jugador4_nombre = $_GET['jugador4'];

// Buscar el ID del jugador en la base de datos
$jugador1_id = null;
$jugador2_id = null;
$jugador3_id = null;
$jugador4_id = null;

// Realizar consultas para obtener las ID de los jugadores basadas en los nombres seleccionados
$sql_jugador1_id = "SELECT id FROM jugadores WHERE nombre = '$jugador1_nombre'";
$sql_jugador2_id = "SELECT id FROM jugadores WHERE nombre = '$jugador2_nombre'";
$sql_jugador3_id = "SELECT id FROM jugadores WHERE nombre = '$jugador3_nombre'";
$sql_jugador4_id = "SELECT id FROM jugadores WHERE nombre = '$jugador4_nombre'";

$resultado_jugador1_id = $conn->query($sql_jugador1_id);
$resultado_jugador2_id = $conn->query($sql_jugador2_id);
$resultado_jugador3_id = $conn->query($sql_jugador3_id);
$resultado_jugador4_id = $conn->query($sql_jugador4_id);

// Verificar si se encontró la ID del jugador y asignarla
if ($resultado_jugador1_id->num_rows > 0) {
    $fila = $resultado_jugador1_id->fetch_assoc();
    $jugador1_id = $fila['id'];
}
if ($resultado_jugador2_id->num_rows > 0) {
    $fila = $resultado_jugador2_id->fetch_assoc();
    $jugador2_id = $fila['id'];
}
if ($resultado_jugador3_id->num_rows > 0) {
    $fila = $resultado_jugador3_id->fetch_assoc();
    $jugador3_id = $fila['id'];
}
if ($resultado_jugador4_id->num_rows > 0) {
    $fila = $resultado_jugador4_id->fetch_assoc();
    $jugador4_id = $fila['id'];
}

// Añadir los datos a la tabla partidas
$sql_partidas = "INSERT INTO `partidas` (`tipo_equipo`, `modo_juego`, `lugar_caida`, `posicion_final`, `jugador1_id`, `muertes_jugador1`, `jugador2_id`, `muertes_jugador2`, `jugador3_id`, `muertes_jugador3`, `jugador4_id`, `muertes_jugador4`) 
                VALUES ('$tipo_equipo', '$modo_juego', '$lugar_caida', '$posicion_final', '$jugador1_id', '$muertes_jugador1', '$jugador2_id', '$muertes_jugador2', '$jugador3_id', '$muertes_jugador3', '$jugador4_id', '$muertes_jugador4')";

if ($conn->query($sql_partidas) === TRUE) {
    echo '<p>PARTIDA AÑADIDA</p>';
    echo '<a href="index.php">VOLVER A INICIO</a>';
} else {
    echo 'Error: ' . $sql_partidas . '<br>' . $conn->error;
}

// OBTENER DATOS DE JUGADORES
// Realizar una consulta SQL para obtener los datos de los jugadores de la base de datos
$sql_jugadores = "SELECT id, nombre FROM jugadores";
$resultado = $conn->query($sql_jugadores);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Inicializar un array para almacenar los datos de los jugadores
    $jugadores = array();
    
    // Recorrer los resultados de la consulta y almacenar los datos en el array
    while ($fila = $resultado->fetch_assoc()) {
        $jugadores[] = $fila; // Agregar fila al array de jugadores
    }
} else {
    // No se encontraron jugadores en la base de datos
    echo "No se encontraron jugadores.";
}

// Verificar si se ha enviado un jugador desde el formulario
if (isset($_GET['jugador'])) {
    $jugador_id = $_GET['jugador'];

    // Aquí puedes realizar la inserción en la base de datos utilizando $jugador_id
    // Por ejemplo:
    $sql_insert_jugador = "INSERT INTO jugadores (id) VALUES ('$jugador_id')";
    
    if ($conn->query($sql_insert_jugador) === TRUE) {
        echo "Nuevo registro insertado correctamente";
    } else {
        echo "Error: " . $sql_insert_jugador . "<br>" . $conn->error;
    }
} else {
    echo "No se ha enviado ningún jugador desde el formulario.";
}

$conn->close();

?>

</body>
</html> 