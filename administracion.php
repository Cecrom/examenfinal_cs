<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/examenfinal_cs/estilo.css">
    <link rel="shortcut icon" href="/examenfinal_cs/recursos/logo.png" type="image/x-icon">
    <title>Buscadores de tesoros - Administración</title>
</head>

<?php
session_start();

require_once "conexion.php";

if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = false;
}


if ($conexion->connect_error) {
    echo '<script type="text/javascript">';
    echo 'alert("No se ha podido conectar con la base de datos. Contacte con el administrador de la web, por favor.");';
    echo '</script>';
    echo "<button onclick=\"location.href='/examenfinal_cs/inicio.html'\">Volver</button>";
}

?>

<body>
    <div id="login">
        <h1>Zona de administración</h1>
        <p>Aqui puede gestionar los grupos que han pasado por las pruebas</p>
        <form method="POST" onsubmit="validarAdmin()">
            <label>Usuario:</label>
            <input type="text" name="usuario">
            <label>Contraseña:</label>
            <input type="password" id="usuario" name="contraseña">
            <input type="submit" id="contraseña" name="entrar" value="Entrar">
        </form>
    </div>
    <div id="botones">
        <button onclick="location.href = '/examenfinal_cs/index.php';">Volver al inicio</button>
        <?php
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            echo "<form method='POST'>";
            echo "<button name='mostrarGrupos' id='mostrarGrupos'>Mostrar grupos</button>";
            echo "</form>";
        } else {
            if (isset($_POST['entrar'])) {
                if ((isset($_POST['usuario']) && isset($_POST['contraseña']))) {

                    $usuario = $_POST['usuario'];
                    $contraseña = $_POST['contraseña'];

                    $comprobarUsuario = mysqli_query($conexion, "SELECT usuario FROM administracion WHERE usuario = '$usuario'");
                    $comprobarContraseña = mysqli_query($conexion, "SELECT contraseña FROM administracion WHERE usuario = '$usuario'");
                    $contraseñaEnBase = mysqli_fetch_assoc($comprobarContraseña);

                    if (mysqli_num_rows($comprobarUsuario) == 0) {
                        echo '<script type="text/javascript">';
                        echo 'alert("Usuario o contraseña erroneos.");';
                        echo '</script>';
                    } elseif (!password_verify($contraseña, $contraseñaEnBase['contraseña'])) {
                        echo '<script type="text/javascript">';
                        echo 'alert("Usuario o contraseña erroneos.");';
                        echo '</script>';
                    } else {
                        // Guarda la sesión del administrador, por comodidad
                        $_SESSION['admin'] = true;
                        echo "<form method='POST'>";
                        echo "<button name='mostrarGrupos' id='mostrarGrupos'>Mostrar grupos</button>";
                        echo "</form>";
                    }
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Debe rellenar todos los campos.");';
                    echo '</script>';
                }
            }
        }
        ?>
    </div>

    <?php

    if (isset($_POST['mostrarGrupos'])) {
        mostrarGrupos($conexion);
    }

    function borrarGrupo($ID, $conexion)
    {
        $borrarGrupo = "DELETE FROM grupos WHERE ID = " . $ID . "";
        if ($conexion->query($borrarGrupo)) {
            echo "<script type='text/javascript'>alert('Grupo borrado');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error al borrar el grupo');</script>";
        }
    }

    function mostrarGrupos($conexion)
    {
        $peticionGrupos = mysqli_query($conexion, "SELECT nombreGrupo, participantes, fecha, tiempoTotal, ID FROM grupos");
        echo "<div id='divTablaGrupos'>";
        echo '<table id="gruposAdmin"><tr><th>Nombre</th><th>Número de integrantes</th><th>Fecha</th><th>Tiempo</th><th>Acción</th></tr>';
        while ($listaGrupos = mysqli_fetch_array($peticionGrupos)) {
            echo "<tr><td>" . $listaGrupos["nombreGrupo"] . "</td>";
            echo "<td>" . $listaGrupos["participantes"] . "</td>";
            echo "<td>" . $listaGrupos["fecha"] . "</td>";
            echo "<td>" . $listaGrupos["tiempoTotal"] . "</td>";
            echo "<td><button id='botonBorrar'><a href='borrar.php?ID= " . $listaGrupos['ID'] . "'>Borrar</a></button></td></tr>";
        }
        echo '</table>';
        echo "</div>";
    }

    $conexion->close();

    ?>
</body>
<script src="/examenfinal_cs/funcionalidad.js"></script>

</html>