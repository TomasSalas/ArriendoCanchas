<?php
    include "conexion.php";
 
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $sql = ("SELECT correo,nombre FROM usuario WHERE correo = '$usuario' and clave = '$clave'");
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