<?php
    include "conexion.php";
 
    $id = $_POST['id'];
    
    $sql = (
    "SELECT A.ID_ARRIENDO , A.FECHA, C.ID_CANCHA, C.CANCHA_DESC , U.NOMBRE 
    FROM ARRIENDO A 
    JOIN CANCHA C ON C.ID_CANCHA = A.CANCHA 
    JOIN USUARIO U ON U.ID = A.ID_USUARIO 
    WHERE A.ID_ARRIENDO = '$id' ");
    $query = $conn->query($sql);

    if($query->num_rows > 0){
        $userdata = $query->fetch_assoc();
        $data ['status'] = 'ok';
	    $data ['result'] = $userdata;
    }
    else {
        $data ['status'] = 'error';
	    $data ['result'] = "";
    }
    echo json_encode ($data);
?>