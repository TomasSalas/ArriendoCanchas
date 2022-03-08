<?php
    include ("conexion.php");

    $fecha = $_POST['fecha'];
    $cancha = $_POST['cancha']; 


    $sql2 = ("SELECT H.id_hora, H.hora_desc , COUNT(c.id_cancha) FROM  hora_arriendo as H 
    LEFT join arriendo A on A.hora = H.id_hora AND a.fecha = '$fecha' AND A.estado = 1
    LEFT JOIN cancha C on c.id_cancha = A.cancha and c.id_cancha = '$cancha'
    GROUP BY a.fecha , H.hora_desc
    HAVING COUNT(C.ID_CANCHA) = 0
    ORDER BY H.id_hora ASC;");

    $query = $conn->query($sql2);

    $html = "<option  class='form-control' value='0'>Seleccione:</option>";
    foreach ($query as $row){
        $html .=  "<option class='form-control' value='".$row['id_hora']."'>".$row['hora_desc']."</option>";
    }
    echo $html;
?>