<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RANKING GENERAL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-main">
        <div class="container-header">
            <h1>RANKING GENERAL</h1>
            <div class="iconos-nav">
                <a href="index.php"><img src="img/home-icon.png" alt="Icono de una casa"></a>
                <a href="index.php"><img src="img/back-icon.png" alt="Icono de un flecha señalando a la izquierda"></a>
            </div>
        </div>
        <!-- <table class="tabla-ranking" id="ranking">
            <thead>
                <tr>
                    <th class="celda-cabecera">Posición</th>
                    <th class="celda-cabecera">Jugador</th>
                    <th class="celda-cabecera">Muertes</th>
                    <th class="celda-cabecera">Partidas</th>
                    <th class="celda-cabecera">Muertes/Partidas</th>
                    <th class="celda-cabecera">Victorias</th>
                    <th class="celda-cabecera">Victorias/Partidas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="posicion" id="pos-1">1</td>
                    <td class="jugador" id="jugador-1">Menen</td>
                    <td class="muertes" id="muertes-1">60</td>
                    <td class="partidas" id="partidas-1">26</td>
                    <td class="muertes-por-partida" id="muertes-por-partida-1">2,31</td>
                    <td class="victorias" id="victorias-1">5</td>
                    <td class="victorias-por-partida" id="victorias-por-partida-1">19%</td>
                </tr>
                <tr>
                    <td class="posicion" id="pos-2">2</td>
                    <td class="jugador" id="jugador-2">Jairon</td>
                    <td class="muertes" id="muertes-2">54</td>
                    <td class="partidas" id="partidas-2">26</td>
                    <td class="muertes-por-partida" id="muertes-por-partida-2">2,08</td>
                    <td class="victorias" id="victorias-2">5</td>
                    <td class="victorias-por-partida" id="victorias-por-partida-2">19%</td>
                </tr>
                <tr>
                    <td class="posicion" id="pos-3">3</td>
                    <td class="jugador" id="jugador-3">Pablin</td>
                    <td class="muertes" id="muertes-3">31</td>
                    <td class="partidas" id="partidas-3">19</td>
                    <td class="muertes-por-partida" id="muertes-por-partida-3">1,63</td>
                    <td class="victorias" id="victorias-3">4</td>
                    <td class="victorias-por-partida" id="victorias-por-partida-3">21%</td>
                </tr>
                <tr>
                    <td class="posicion" id="pos-4">4</td>
                    <td class="jugador" id="jugador-4">Jairin</td>
                    <td class="muertes" id="muertes-4">10</td>
                    <td class="partidas" id="partidas-4">7</td>
                    <td class="muertes-por-partida" id="muertes-por-partida-4">1,43</td>
                    <td class="victorias" id="victorias-4">1</td>
                    <td class="victorias-por-partida" id="victorias-por-partida-4">19%</td>
                </tr>
                <tr>
                    <td class="posicion" id="pos-5">5</td>
                    <td class="jugador" id="jugador-5">Bati</td>
                    <td class="muertes" id="muertes-5">6</td>
                    <td class="partidas" id="partidas-5">6</td>
                    <td class="muertes-por-partida" id="muertes-por-partida-5">1,00</td>
                    <td class="victorias" id="victorias-5">1</td>
                    <td class="victorias-por-partida" id="victorias-por-partida-5">17%</td>
                </tr>
            </tbody>
        </table>
        
    </div>
    <div class="container-footer">
        <div class="ranking-trios">
            <img src="img/Trios.png" alt="3 personajes de Fortnite">
            <p>RANKING TRIOS</p>
        </div>
        <div class="ranking-escuadrones">
            <img src="img/Squads.png" alt="4 personajes de Fortnite">
            <p>RANKING ESCUADRONES</p>
        </div>
    </div> -->

    <?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "fortnite3";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos necesarios para el ranking
$sql = "SELECT 
j.nombre AS nombre_jugador,
j.id AS id_jugador,
SUM(muertes_jugador) AS muertes_totales,
COUNT(*) AS partidas_totales,
SUM(muertes_jugador) / COUNT(*) AS muertes_por_partida,
SUM(CASE WHEN p.posicion_final = 1 THEN 1 ELSE 0 END) AS victorias_totales,
SUM(CASE WHEN p.posicion_final = 1 THEN 1 ELSE 0 END) / COUNT(*) AS victorias_por_partida
FROM 
jugadores j
JOIN 
(SELECT 
    jugador1_id AS id_jugador, 
    muertes_jugador1 AS muertes_jugador,
    posicion_final
 FROM 
    partidas
 UNION ALL
 SELECT 
    jugador2_id, 
    muertes_jugador2,
    posicion_final
 FROM 
    partidas
 UNION ALL
 SELECT 
    jugador3_id, 
    muertes_jugador3,
    posicion_final
 FROM 
    partidas
 UNION ALL
 SELECT 
    jugador4_id, 
    muertes_jugador4,
    posicion_final
 FROM 
    partidas) AS p
ON 
j.id = p.id_jugador
GROUP BY 
j.id, j.nombre
ORDER BY 
muertes_por_partida DESC;
";

$resultado = $conn->query($sql);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    echo '<table class="tabla-ranking" id="ranking">';
    echo '<thead>';
    echo '<tr>';
    echo '<th class="celda-cabecera">Posición</th>';
    echo '<th class="celda-cabecera">Jugador</th>';
    echo '<th class="celda-cabecera">Muertes</th>';
    echo '<th class="celda-cabecera">Partidas</th>';
    echo '<th class="celda-cabecera">Muertes/Partidas</th>';
    echo '<th class="celda-cabecera">Victorias</th>';
    echo '<th class="celda-cabecera">Victorias/Partidas</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    $posicion = 1;
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr>';
        echo '<td class="posicion">' . $posicion . '</td>';
        echo '<td class="jugador">' . $fila['nombre_jugador'] . '</td>';
        echo '<td class="muertes">' . $fila['muertes_totales'] . '</td>';
        echo '<td class="partidas">' . $fila['partidas_totales'] . '</td>';
        echo '<td class="muertes-por-partida">' . number_format($fila['muertes_por_partida'], 2) . '</td>';
        echo '<td class="victorias">' . $fila['victorias_totales'] . '</td>';
        echo '<td class="victorias-por-partida">' . number_format($fila['victorias_por_partida'] * 100, 2) . '%</td>';
        echo '</tr>';
        $posicion++;
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "No se encontraron jugadores.";
}


// Cerrar la conexión a la base de datos
$conn->close();
?>



</body>
</html>