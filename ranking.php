<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/examenfinal_cs/estilo.css">
    <link rel="shortcut icon" href="/examenfinal_cs/recursos/anillo.png" type="image/x-icon">
    <title>Ranking Cámara de Mazarbul</title>
</head>
<?php
session_start();
require_once "conexion.php";
if (isset($_SESSION['nombreGrupo'])) {
    $_SESSION['nombreGrupo'];
    $_SESSION['numeroParticipantes'];
    $_SESSION['fecha'];
    $_SESSION['tiempoIni'];
    $tiempoFin = time();
    $tiempoTotal = $tiempoFin - $_SESSION['tiempoIni'];
    $tiempoTotal = gmdate("H:i:s", $tiempoTotal);
    $actualizarTiempo = "UPDATE grupos SET tiempoTotal = '$tiempoTotal' WHERE ID = (SELECT MAX(ID) FROM grupos)";
    echo "<h1 class='ranking'>Enhorabuena, vuestro tiempo ha sido: $tiempoTotal</h1>";
    if ($conexion->query($actualizarTiempo)) {
        echo '<script type="text/javascript">';
        echo 'alert("Grupo guardado, ¡mostrando el ranking!");';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error al guardar el grupo, contacte con el administrador de la web);';
        echo '</script>';
    }
}
session_destroy();

?>

<body>
    <div>
        <h2 class="ranking">Mejores tiempos de "La Cámara de Mazarbul"</h2>
    </div>
    <div id="divTablaRank">
        <table id="tablRanking">
            <tr>
                <th>Grupo</th>
                <th>Participantes</th>
                <th>Fecha</th>
                <th>Tiempo</th>
            </tr>

            <?php
            $peticionGrupos = mysqli_query($conexion, "SELECT nombreGrupo, participantes, fecha, tiempoTotal FROM grupos ORDER BY tiempoTotal ASC");

            while ($listaGrupos = mysqli_fetch_array($peticionGrupos)) {
                echo "<tr><td>" . $listaGrupos["nombreGrupo"] . "</td>";
                echo "<td>" . $listaGrupos["participantes"] . "</td>";
                echo "<td>" . $listaGrupos["fecha"] . "</td>";
                echo "<td>" . $listaGrupos["tiempoTotal"] . "</td></tr>";
            }
            ?>
        </table>
        <button onclick="location.href ='/examenfinal_cs/index.php'">Volver al inicio</button>
    </div>
    <?php
    $conexion->close();
    ?>
</body>

</html>