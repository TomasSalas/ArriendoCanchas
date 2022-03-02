<?php
    include ("conexion.php");

    $fecha = $_POST['fecha'];

    $sql =("SELECT H.id_hora, H.hora_desc FROM  hora_arriendo as H 
    LEFT join arriendo A on A.hora = H.id_hora AND a.fecha = '$fecha'
    GROUP BY a.fecha , H.hora_desc
    HAVING COUNT(hora)=0");

    $query = $conn->query($sql);

    $html = "<option  class='form-control' value='0'>Seleccione:</option>";
    foreach ($query as $row){
        $html .=  "<option class='form-control' value='".$row['id_hora']."'>".$row['hora_desc']."</option>";
    }
    echo $html;
?>