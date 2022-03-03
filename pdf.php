<?php
    include ("./fpdf/fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','','12');
    $pdf->Cell(0,10,'Generar Archivos con PHP',0,1);

    $pdf->Output('D','basic.pdf');
?>