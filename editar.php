<?php
    include "conexion.php";
 
    $id = $_POST['id'];
    
    $sql = ("SELECT * FROM arriendo WHERE id_arriendo = '$id' ");
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