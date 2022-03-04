<?php
    include ("conexion.php");
    require ("./fpdf/fpdf.php");

    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $estado = 1;
    $cancha = $_POST['cancha'];
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $id_arriendo =  strtoupper(substr(str_shuffle($permitted_chars),0,10));

    if($hora == 1){
        $horadesc = "18:00";
    }elseif($hora == 2){
        $horadesc = "19:00";
    }elseif($hora == 3){
        $horadesc = "20:00";
    }elseif($hora == 4){
        $horadesc = "21:00";
    }elseif($hora == 5){
        $horadesc = "22:00";
    }elseif($hora == 6){
        $horadesc = "23:00";
    };  
    $sql=("INSERT INTO arriendo (id_arriendo,fecha,hora,id_usuario,estado,cancha)VALUES('$id_arriendo','$fecha','$hora','$id','$estado','$cancha');");

    if(mysqli_query($conn,$sql)){
        $data = '?fecha='.$fecha.'&hora='.$horadesc.'&id='.$id_arriendo.'&nombre='.$nombre.'&cancha='.$cancha;
    }
    else {
        $data = 2;
    }

    echo $data;
?>