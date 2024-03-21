<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Jugador</title>
</head>
<body>

<?php

// DATOS TABLA JUGADORES
$avatar_jugador = $_GET['avatar'];
$nombre_jugador = $_GET['nombre'];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "fortnite_stats";



// Verificar si se ha enviado un archivo
if(isset($_FILES['avatar'])) {
    $archivo_nombre = $_FILES['avatar']['name'];
    $archivo_temporal = $_FILES['avatar']['tmp_name'];
    
    // Directorio donde se guardarán los avatares
    $directorio_destino = 'img/';
    
    // Mover el archivo cargado al directorio de destino
    if(move_uploaded_file($archivo_temporal, $directorio_destino . $archivo_nombre)) {
        // Archivo subido exitosamente, ahora guardamos la ruta en la base de datos
        $ruta_avatar = $directorio_destino . $archivo_nombre;
        
        // Conectar a la base de datos (aquí deberías tener tus credenciales de conexión)
        $conexion = new mysqli("localhost", "usuario", "contraseña", "fortnite_stats");
        
        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }
        
        // Insertar la ruta del avatar en la base de datos
        $sql = "INSERT INTO tabla_avatares (ruta_avatar) VALUES ('$ruta_avatar')";
        if ($conexion->query($sql) === TRUE) {
            echo "Avatar subido y ruta guardada en la base de datos correctamente.";
        } else {
            echo "Error al guardar la ruta en la base de datos: " . $conexion->error;
        }
        
        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "Error al subir el archivo.";
    }
}




// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión no realizada: " . $conn->connect_error);
}

$sql = "INSERT INTO `jugadores` (`avatar`, `nombre`) VALUES ('" . $avatar_jugador . "', '" . $nombre_jugador . "');";

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