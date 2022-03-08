<?php
    include "conexion.php";
 
    $id = $_POST['id'];
    
    $sql = ("UPDATE arriendo SET estado = 0 WHERE id_arriendo= '$id'");
    
    if($conn->query($sql) === true){
        $var = 1;
    }else{
        $var = 2;
    }

    echo $var;
?>