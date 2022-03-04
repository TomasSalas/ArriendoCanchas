<?php
    include ("conexion.php");


    $sql =("SELECT * FROM cancha"); 

    $query = $conn->query($sql);

    $html = "<option  class='form-control' value='0'>Seleccione:</option>";
    foreach ($query as $row){
        $html .=  "<option class='form-control' value='".$row['id_cancha']."'>".$row['cancha_desc']."</option>";
    }
    echo $html;
?>