<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/examenfinal_cs/estilo.css">
    <link rel="shortcut icon" href="/examenfinal_cs/recursos/anillo.png" type="image/x-icon">
    <title>Entrada a la Cámara de Mazarbul</title>
</head>
<?php
session_start();

require_once "conexion.php";

if ($conexion->connect_error) {
    echo '<script type="text/javascript">';
    echo 'document.getElementById("introducirUsuario").innerHTML = "";';
    echo 'alert("No se ha podido conectar con la base de datos. Contacte con el administrador de la web, por favor.");';
    echo '</script>';
    echo "<button onclick=\"location.href='/examenfinal_cs/inicio.html'\">Volver</button>";
}

// Valida y guardada el grupo, así como el momento en el que comienza la scape room

if (isset($_POST['enviar'])) {
    if (!empty($_POST['nombreGrupo']) && !empty($_POST['numeroParticipantes'])) {
        $_SESSION['nombreGrupo'] = $_POST['nombreGrupo'];
        $grupo = $_SESSION['nombreGrupo'];
        $_SESSION['numeroParticipantes'] = $_POST['numeroParticipantes'];
        $participantes = $_SESSION['numeroParticipantes'];
        $_SESSION['fecha'] = date("d-m-Y", time()); // Guarda la fecha en dia - mes - año de la partida
        $fecha = $_SESSION['fecha'];
        $_SESSION['tiempoIni'] = time(); // Guarda el tiempo en el que comienza la scape room
        if (strlen($grupo) > 20) {
            echo '<script type="text/javascript">';
            echo 'alert("Error al guardar el grupo, el nombre del grupo no debe superar los 20 caracteres.");';
            echo '</script>';
            session_unset();
        } elseif (strlen((string)$participantes) > 1) {
            echo '<script type="text/javascript">';
            echo 'alert("Error al guardar el grupo, no pueden participar más de 9 personas.");';
            echo '</script>';
            session_unset();
        } else {
            $introducirDatos = "INSERT INTO grupos (nombreGrupo, participantes, fecha) VALUES ('$grupo',$participantes,'$fecha')";
            if (mysqli_query($conexion, $introducirDatos)) {
                echo '<script type="text/javascript">';
                echo 'alert("Grupo guardado, preparaos para comenzar");';
                echo '</script>';
                header("location: /examenfinal_cs/jugarcamarademazarbul.php");
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Error de conexión con la base de datos, contacte con la persona administradora de la web.");';
                echo '</script>';
                session_unset();
            }
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Debe rellenar todos los datos del formulario");';
        echo '</script>';
    }
}

?>

<body>
    <div id="introducirUsuario">
        <form id="formGrupo" method="POST" onsubmit="return validar()">
            <table>
                <tr>
                    <th colspan="2">Introduzca los datos de su grupo</th>
                </tr>
                <tr>
                    <td>Nombre del grupo</td>
                    <td><input type="text" name="nombreGrupo" id="nombreGrupo"></td>
                </tr>
                <tr>
                    <td>Número de participantes</td>
                    <td><input type="number" name="numeroParticipantes" id="numeroParticipantes"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="enviar" id="enviar" value="Enviar"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
<script src="/examenfinal_cs/funcionalidad.js"></script>
<?php
$conexion->close();
?>

</html>