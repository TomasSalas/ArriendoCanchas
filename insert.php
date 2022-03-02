<?php
    include ("conexion.php");

    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id = $_POST['id'];
    $estado = 1;
    $sql=("INSERT INTO arriendo (fecha,hora,id_usuario,estado)VALUES('$fecha','$hora','$id','$estado');");

    if($conn->query($sql) === TRUE){
        echo $data = 1;
    }
    else {
        echo $data = 2;
    }
?>