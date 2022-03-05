<?php
    require ("./fpdf/fpdf.php");
    /* Recibo los datos via get */
    $fecha  = $_GET['fecha'];
    $nombre  = $_GET['nombre'];
    $cancha  = $_GET['cancha'];
    $id  = $_GET['id'];
    $hora  = $_GET['hora'];
    /* Comienzo con la creacion del PDF */
    $pdf = new FPDF('P', 'mm', array(250,200));
    $pdf->AddPage();
    $pdf->Image('./img/logo.jpeg',5,10,-200);
    $pdf->SetFont('Arial','B','24');
    $pdf->Cell(0,40,'Gracias por tu Reserva',0,1,'C');
    $pdf->SetFont('Arial','','18');
    $pdf->Cell(50,10,'Nombre Cliente: '.$nombre,0,1);
    $pdf->Cell(50,10,'ID de su Arriendo: '.$id,0,1);
    $pdf->Cell(50,10,'Fecha de su Arriendo: '.$fecha,0,1);
    $pdf->Cell(50,10,'Hora de su Arriendo: '.$hora,0,1); 
    $pdf->Cell(50,10,'Cancha: '.$cancha,0,1); 
    $pdf->SetFont('Arial','B','24');
    $pdf->Cell(0,40,'Un abrazo de gol y gracias por tu preferencia',0,1,'C'); 
    $pdf->SetFont('Arial','','18');
    $pdf->Cell(0,10,'Ante cualquier eventualidad con tu reserva.',0,1 ,'C'); 
    $pdf->Cell(0,10,'Recordar que puedes cancelar la cancha llamando al',0,1 ,'C');
    $pdf->SetFont('Arial','B','18');
    $pdf->Cell(0,10,'+569 93016086',0,1 , 'C');
    /* Linea de salida PDF */
    $pdf->Output('Arriendo'.$nombre.'.pdf' , 'D');
?>
