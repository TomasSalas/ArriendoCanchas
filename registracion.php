<?php
    include ("conexion.php");

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $tipo = "NORMAL";
    $sql = 
    "INSERT INTO usuario (nombre,correo,clave,tipo_usuario) VALUES ('$nombre','$correo','$clave','$tipo')";

    if(mysqli_query($conn,$sql)){
        $data = 1;
    }
    else {
        $data = 2;
    }

    echo $data;
?>