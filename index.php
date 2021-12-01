<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/examenfinal_cs/estilo.css">
    <link rel="shortcut icon" href="/examenfinal_cs/recursos/logo.png" type="image/x-icon">
    <title>Buscadores de tesoros</title>
</head>
<?php
session_start();

// Elimina la sesión del administrador para garantizar la seguridad

if (isset($_SESSION['admin'])) {
    $_SESSION['admin'] = false;
}
?>

<body>

    <div id="cabecera">
        <div id="logo"><img src="/examenfinal_cs/recursos/logo.png" alt=""></div>
        <h1>Buscadores de tesoros</h1>
        <button onclick="location.href='/examenfinal_cs/administracion.php'">Administracion</button>
    </div>
    <div id="presentacion">
        <h3>Las mejores Scape Rooms ambientadas en tus películas favoritas</h3>
    </div>
    <div id="divElegirJuego">
        <table>
            <td>
                <p>Cámara de Mazarbul</p>
            </td>
            <td><button onclick="inicio()">Comenzar</button></td>
            <td><button onclick="location.href = '/examenfinal_cs/ranking.php'">Ranking</button></td>
            </tr>
            <td>
                <p>La cámara secreta</p>
            </td>
            <td><button onclick="proximamente()">Comenzar</button></td>
            <td><button onclick="proximamente()">Ranking</button></td>

            </tr>
            <td>
                <p>El arca perdida</p>
            </td>
            <td><button onclick="proximamente()">Comenzar</button></td>
            <td><button onclick="proximamente()">Ranking</button></td>

            </tr>
        </table>
    </div>
    <div id="divImagenInicio" style="display: none;">
        <img src="/examenfinal_cs/recursos/imagendelapuerta.png" alt="Puerta de entrada a Moria con la inscripción 'Habla, amigo, y entra" onclick="entrarAJugar()">
    </div>
</body>
<script src="/examenfinal_cs/funcionalidad.js"></script>

</html>