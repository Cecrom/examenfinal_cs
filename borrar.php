<?php

include "conexion.php";

$ID = $_GET['ID'];

$borrar = mysqli_query($conexion,"DELETE FROM grupos WHERE ID = $ID");

if($borrar)
{
    mysqli_close($conexion);
    header("location:administracion.php");
    exit;
}
else
{
    echo "Error al borrar el grupo";
}
?>