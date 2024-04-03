<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Añadir Partida</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

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
    
    // Consulta para obtener la lista de jugadores
    $sql = "SELECT nombre FROM jugadores";
    $resultado = $conn->query($sql);
    
    // Crear un array para almacenar los nombres de los jugadores
    $jugadores = array();
    
    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        // Almacenar los nombres de los jugadores en el array
        while ($fila = $resultado->fetch_assoc()) {
            $jugadores[] = $fila['nombre'];
        }
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>
    
    <div class="container-form">
        <div class="formulario">
        <form action="crear-Partida.php" method="get">
            <div class="logo-h1">
                <h1 id="h1-formulario">AÑADIR PARTIDA</h1>
                <p>Añade las estadísticas de la partida.</p>
            </div>
            <fieldset class="partida">
                <div class="div-tipo-equipo">
                    <p class="tipo-equipo">Tipo de equipo</p>
                        <!-- <input type="radio" name="equipo" id="duos" value="duos" onclick="desactivarJugadores()"> -->
                        <input type="radio" name="equipo" id="duos" value="duos">
                        <label for="duos">Duos</label>
                        <input type="radio" name="equipo" id="trios" value="trios">
                        <label for="trios">Tríos</label>
                        <input type="radio" name="equipo" id="escuadrones" value="escuadrones">
                        <label for="escuadrones">Escuadrones</label>
                </div>
                <div class="div-modo-juego">
                    <p class="modo-juego">Modo de juego</p>
                        <input type="radio" name="modo" id="competitivo" value="competitivo">
                        <label for="competitivo">Competitivo</label>
                        <input type="radio" name="modo" id="normal" value="normal">
                        <label for="normal">Normal</label>
                </div>
                <div class="div-lugar-caida">
                    <p class="lugar-caida">Lugar de caída</p>
                        <select name="caida" id="caida">
                            <option value="CanchasCancheras">Canchas Cancheras      🥅</option>
                            <option value="CarretesConservados">Carretes Conservados   🎞️</option>
                            <option value="DominioDuelista">Dominio Duelista       🤠</option>
                            <option value="ElInframundo">El Inframundo          🔥</option>
                            <option value="EmbarcaderoEmpinado">Embarcadero Empinado   ⛵</option>
                            <option value="EntradaEstigia">Entrada Estigia        🧞‍♂️</option>
                            <option value="GlaciarGrandioso">Glaciar Grandioso      🧊</option>
                            <option value="MansionMajestuosa">Mansion Majestuosa     🏘️</option>
                            <option value="MonteOlimpo">Monte Olimpo           ⛰️</option>
                            <option value="PlazaPlacentera">Plaza Placentera       🏙️</option>
                            <option value="VillaViñedo">Villa Viñedo           🍇</option>
                            <option value="SinUbicacion">Sin ubicación          🤦‍♂️</option>
                        </select>
                </div>
            </fieldset>
            <fieldset class="estadisticas">
                <div class="div-titulos-jugadores-muertes">
                    <p>JUGADORES</p>
                    <p>MUERTES</p>
                </div>
                <div class="jugador1">
                    <!-- <label for="jugador1-muertes">
                        J1
                    </label>
                    <input type="number" name="jugador1-muertes" id="jugador1-muertes"> -->
                    <label for="jugador1">J1:</label>
    <input list="lista-jugadores" name="jugador1" id="jugador1">
    <datalist id="lista-jugadores1">
        <?php foreach ($jugadores as $jugador): ?>
            <option value="<?php echo $jugador; ?>">
        <?php endforeach; ?>
    </datalist>
    <input type="number" name="muertes_jugador1" id="jugador1-muertes">
                </div>
                <div class="jugador2">
                    <!-- <label for="jugador2-muertes">
                        Jugador 2
                    </label>
                    <input type="number" name="jugador2-muertes" id="jugador2-muertes"> -->
                    <label for="jugador2">J2:</label>
    <input list="lista-jugadores" name="jugador2" id="jugador2">
    <datalist id="lista-jugadores2">
        <?php foreach ($jugadores as $jugador): ?>
            <option value="<?php echo $jugador; ?>">
        <?php endforeach; ?>
    </datalist>
    <input type="number" name="muertes_jugador2" id="jugador2-muertes">
                </div>
                <div class="jugador3">
                    <!-- <label for="jugador3-muertes">
                        Jugador 3
                    </label>
                    <input type="number" name="jugador3-muertes" id="jugador3-muertes"> -->
                    <label for="jugador3">J3:</label>
    <input list="lista-jugadores" name="jugador3" id="jugador3">
    <datalist id="lista-jugadores3">
        <?php foreach ($jugadores as $jugador): ?>
            <option value="<?php echo $jugador; ?>">
        <?php endforeach; ?>
    </datalist>
    <input type="number" name="muertes_jugador3" id="jugador3-muertes">
                </div>
                <div class="jugador4">
                    <!-- <label for="jugador4-muertes">
                        Jugador 4
                    </label>
                    <input type="number" name="jugador4-muertes" id="jugador4-muertes"> -->
                    <label for="jugador4">J4:</label>
    <input list="lista-jugadores4" name="jugador4" id="jugador4">
    <datalist id="lista-jugadores4">
        <?php foreach ($jugadores as $jugador): ?>
            <option value="<?php echo $jugador; ?>">
        <?php endforeach; ?>
    </datalist>
    <input type="number" name="muertes_jugador4" id="jugador4-muertes">
                </div>
                <div class="posicion-final">
                    <label for="posicion">
                        Posición final
                    </label>
                    <input type="number" name="posicion" id="posicion">
            </fieldset>
            <input type="submit" value="REGISTRAR DATOS">
        </form>
        <img class="imagen-formu" src="img/form-img.jpg" alt="Imagen Fortnite">
        </div>
        <div class="boton-inicio">
            <button>VOLVER A INICIO</button>
        </div>
    </div>
    <script>
        document.getElementById('duos').addEventListener('click', desactivarJugadores);

        function desactivarJugadores() {
    

    var tipoEquipoDuos = document.querySelector('#duos');


    var inputJugador3 = document.querySelector('#jugador3');
    var inputMuertesJugador3 = document.querySelector('#jugador3-muertes');

    var inputJugador4 = document.querySelector('#jugador4');
    var inputMuertesJugador4 = document.querySelector('#jugador4-muertes');


    if (tipoEquipoDuos.checked) {
        // inputJugador3.setAttribute("disabled", true);
        inputJugador3.disabled = true;
        inputMuertesJugador3.disabled = true;
        inputJugador4.disabled = true;
        inputMuertesJugador4.disabled = true;
    } else {
        // datalistJugadores3.setAttribute("disabled", false);
        inputJugador3.disabled = false;
        inputMuertesJugador3.disabled = false;
        console.log("Datalist desactivado, muertes del jugador 3 activadas");
        inputJugador4.disabled = false;
        inputMuertesJugador4.disabled = false;
        console.log("Datalist desactivado, muertes del jugador 4 activadas");
    }
}


// function desactivarJugador3() {
    

//     var tipoEquipoTrios = document.querySelector('#trios');

//     var inputJugador4 = document.querySelector('#jugador4');

//     var inputMuertesJugador4 = document.querySelector('#jugador4-muertes');

//     if (tipoEquipoDuos.checked) {
//         // inputJugador3.setAttribute("disabled", true);
//         inputJugador3.disabled = true;
//         inputMuertesJugador3.disabled = true;
//         console.log("Datalist y muertes del jugador 3 desactivados");
//     } else {
//         // datalistJugadores3.setAttribute("disabled", false);
//         inputJugador3.disabled = false;
//         inputMuertesJugador3.disabled = false;
//         console.log("Datalist desactivado, muertes del jugador 3 activadas");
//     }
// }


    </script>
</body>
</html>