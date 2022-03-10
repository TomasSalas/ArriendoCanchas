<?php
    include "conexion.php";

    $sql = ("SELECT C.CANCHA_DESC , COUNT(A.CANCHA) FROM ARRIENDO A JOIN CANCHA C ON C.ID_CANCHA = A.CANCHA GROUP BY C.CANCHA_DESC;");
    $query = $conn->query($sql);

    foreach ($query as $row){
        $data[] = $row;
    }
    echo json_encode($data);
?>