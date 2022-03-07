<?php
    include ("conexion.php");

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $sql = 
    "INSERT INTO usuario (nombre,correo,clave) VALUES ('$nombre','$correo','$clave')";

    if(mysqli_query($conn,$sql)){
        $data = 1;
    }
    else {
        $data = 2;
    }

    echo $data;
?>