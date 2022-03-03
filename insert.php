<?php
    include ("conexion.php");
    require ("./fpdf/fpdf.php");

    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $estado = 1;
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $id_arriendo =  strtoupper(substr(str_shuffle($permitted_chars),0,10));

    if($hora == 1){
        $horadesc = "18:00";
    }elseif($hora == 2){
        $horadesc = "19:00";
    }elseif($hora == 3){
        $horadesc = "20:00";
    }elseif($hora == 4){
        $horadesc = "21:00";
    }elseif($hora == 5){
        $horadesc = "22:00";
    }elseif($hora == 6){
        $horadesc = "23:00";
    };  
    $sql=("INSERT INTO arriendo (id_arriendo,fecha,hora,id_usuario,estado)VALUES('$id_arriendo','$fecha','$hora','$id','$estado');");

    if($conn->query($sql) === TRUE){
        
        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->Image('./img/logo.jpg',5,10,-200);
        $pdf->SetFont('Arial','B','20');
        $pdf->Cell(0,40,'Gracias por tu Reserva',0,1,'C');
        $pdf->SetFont('Arial','','18');
        $pdf->Cell(50,10,'Nombre Cliente: '.$nombre,0,1);
        $pdf->Cell(50,10,'ID de su Arriendo: '. $id_arriendo,0,1);
        $pdf->Cell(50,10,'Fecha de su Arriendo: '.$fecha,0,1);
        $pdf->Cell(50,10,'Hora de su Arriendo: '. $horadesc,0,1); 

        $pdf->Output('F','doc.pdf');
        $pdf->Close(); 

        $data = 1;
        
    }
    else {
        $data = 2;
    }

    echo $data;
?>