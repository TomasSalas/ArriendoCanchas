<?php
            require ("./fpdf/fpdf.php");
            $fecha  = $_GET['fecha'];
            $nombre  = $_GET['nombre'];
            $cancha  = $_GET['cancha'];
            $id  = $_GET['id'];
            $hora  = $_GET['hora'];
            
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->Image('./img/logo.jpeg',5,10,-200);
            $pdf->SetFont('Arial','B','20');
            $pdf->Cell(0,40,'Gracias por tu Reserva',0,1,'C');
            $pdf->SetFont('Arial','','18');
            $pdf->Cell(50,10,'Nombre Cliente: '.$nombre,0,1);
            $pdf->Cell(50,10,'ID de su Arriendo: '.$id,0,1);
            $pdf->Cell(50,10,'Fecha de su Arriendo: '.$fecha,0,1);
            $pdf->Cell(50,10,'Hora de su Arriendo: '.$hora,0,1); 
            $pdf->Cell(50,10,'Cancha: '.$cancha,0,1); 
            $pdf->Output('Arriendo'.$nombre.'.pdf' , 'D');
?>
