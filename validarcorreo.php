<?php
    include ("conexion.php");

    $correo = $_POST['correo'];

    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $data = "2";
    }else{
        $data = "1";
    }

    echo $data;
?>