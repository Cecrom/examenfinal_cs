<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/examenfinal_cs/estilo.css">
    <link rel="shortcut icon" href="/examenfinal_cs/recursos/anillo.png" type="image/x-icon">
    <title>Cámara de Mazarbul</title>
</head>
</head>
<?php
session_start();
$_SESSION['nombreGrupo'];
$_SESSION['numeroParticipantes'];
$_SESSION['fecha'];
$_SESSION['tiempoIni'];
?>

<body>
    <nav id="navJugar">
        <?php
        echo '<h1>Grupo ' . $_SESSION['nombreGrupo'] . '. Participantes: ' . $_SESSION['numeroParticipantes'] . '.</h1>';
        ?>
    </nav>
    <div id="general">
        <div>
            <p>Habéis llegado a lo que puede ser el final de vuestro viaje. Al comenzar a oir los gritos de guerra que surgían de lo profundo, os encondísteis en esta cámara, la Cámara de Mazarbul. Ahora están golpeando la puerta. Por el momento aguantará, por lo menos diez minutos... Tenéis ese tiempo para encontrar otra salida o ser pasto de las huestes de trasgos.</p>
            <p>Con un rápido vistazo a vuestro alrededor podéis encontrar lo siguiente: </p>
        </div>
        <div>
            <table>
                <tr>
                    <td>
                        <p>Un libro con runas enanas</p>
                    </td>
                    <td><button onclick="libro()">Coger</button></td>
                </tr>
                <tr>
                    <td>
                        <p>Una baul decorado</p>
                    </td>
                    <td><button onclick="caja()">Acercarse</button></td>
                </tr>
                <tr>
                    <td>
                        <p>Una pequeña ventana que ilumina la tumba central</p>
                    </td>
                    <td><button onclick="ventana()">Intentar alcanzarla</button></td>
                </tr>
                <tr>
                    <td>
                        <p>La tumba del centro de la sala</p>
                    </td>
                    <td><button onclick="tumba()">Aproximarse con respeto</button></td>
                </tr>
            </table>
        </div>
        <div id="avance">
        </div>
        <div id="final">
            <?php
            if (isset($_POST['salir'])) {
                echo "<p>La tumba se abre, dejando ver una escalera que desciende hacia las profundidades.\nCorriendo, descendéis por las mismas, puede ser vuestra única salida.\nPero de nuevo os enfrentáis a otra prueba...\nUna antigua inscripción está grabada en la roca:<div class='imagenRunas'><img src='/examenfinal_cs/recursos/pruebafinal.jpg'></div>";
                echo "<p>Tendrás que usar el pergamino de traducciones<div class='imagenRunas'><img src='/examenfinal_cs/recursos/runasenanas.jpg'></div></p>";
                echo "<form id='formFinal' method='post' onsubmit='return validarFinal()'><label>¿Qué prununcias en alto?</label><input name='pronunciar' id='pronunciar' type='text'><input type='submit' name='respuesta' value='Responder'></form>";
            }

            if (!empty($_POST['pronunciar']) && isset($_POST['respuesta'])) {
                if (strtolower($_POST['pronunciar']) == 'gracias') {
                    header("location: /examenfinal_cs/ranking.php");
                } else {
                    return false;
                }
            }
            ?>
        </div>
    </div>
</body>
<script src="/examenfinal_cs/funcionalidad.js"></script>

</html>