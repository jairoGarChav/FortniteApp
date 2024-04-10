<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RANKING ESCUADRONES</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-main">
        <div class="container-header">
            <h1>RANKING ESCUADRONES</h1>
            <div class="iconos-nav">
                <a href="index.php"><img src="img/home-icon.png" alt="Icono de una casa"></a>
                <!-- <a href="index.php"><img src="img/back-icon.png" alt="Icono de un flecha señalando a la izquierda"></a> -->
            </div>
        </div>


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

        // Consulta SQL para obtener los datos necesarios para el ranking de escuadrones
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
                    WHERE
                        tipo_equipo = 'escuadrones'
                    UNION ALL
                    SELECT 
                        jugador2_id, 
                        muertes_jugador2,
                        posicion_final
                    FROM 
                        partidas
                    WHERE
                        tipo_equipo = 'escuadrones'
                    UNION ALL
                    SELECT 
                        jugador3_id, 
                        muertes_jugador3,
                        posicion_final
                    FROM 
                        partidas
                    WHERE
                        tipo_equipo = 'escuadrones'
                    UNION ALL
                    SELECT 
                        jugador4_id, 
                        muertes_jugador4,
                        posicion_final
                    FROM 
                        partidas
                    WHERE
                        tipo_equipo = 'escuadrones') AS p
                ON 
                    j.id = p.id_jugador
                GROUP BY 
                    j.id, j.nombre
                ORDER BY 
                    muertes_por_partida DESC;";

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
            echo "No se encontraron datos para el ranking de escuadrones.";
        }


        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>
    </div>
    <div class="container-footer">
        <div class="ranking-trios">
            <a href="ranking-general.php">
                <img src="img/tarjeta-ranking-general.png" alt="Personajes de Fortnite">
                <p>RANKING GENERAL</p>
            </a>
        </div>
        <div class="ranking-duos">
            <a href="ranking-duos.php">
                <img src="img/Duos.jpg" alt="2 personajes de Fortnite">
                <p>RANKING DUOS</p>
            </a>
        </div>
        <div class="ranking-escuadrones">
            <a href="ranking-trios.php">
                <img src="img/Trios.png" alt="3 personajes de Fortnite">
                <p>RANKING TRÍOS</p>
            </a>
        </div>
    </div>

</body>

</html>
