<?php

require ('./fpdf/fpdf.php');
require ('./modelo/conexion.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('resources/empleados.png', 10, 8, 20);
        $this->SetFont("Arial", "B", 15);
        $this->Cell(0, 10, "REPORTE EMPLEADOS", 0, 1, "C");
        $this->SetFont("Arial", "", 10);
        $this->Cell(25, 5, "Fecha: " . date("d/m/y"), 0, 1, "C");
        $this->Ln(4);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, "Pagina " . $this->PageNo() . " / {nb}", 0, 1, "C");
    }
}

    //ID del empleado por url
    $id = $_GET['id'];

    //Consulta que trae los datos de la base de datos
    $sql = "SELECT * FROM nomina_empleado WHERE id ='$id'";
    $resultado = $conexion->query($sql);


    $pdf = new PDF("P", "mm", "LETTER");
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont("Arial", "B", 10);

    //Encabezados de la tabla en el PDF
    $pdf->Cell(20,5,"ID", 1, 0, "C", 1);
    $pdf->Cell(50,5,"Nombre", 1, 0, "C", 1);
    $pdf->Cell(30,5,"Cargo", 1, 0, "C", 1);
    $pdf->Cell(30,5,"Salario Base", 1, 0, "C", 1);
    $pdf->Cell(20,5,"Dias", 1, 0, "C", 1);
    $pdf->Cell(30,5,"Pago Total", 1, 1, "C", 1);

    
    $pdf->SetFont("Arial", "", 10);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    

    //Información de la tabla
    while ($row = $resultado->fetch_assoc()) {
        $pdf->Cell(20,5,$row['identificacion'], 1, 0, "L");
        /*
        20 = la anchura de la celda
        1 = Ocupa un celda
        0 = Es un salto de linea si es un 1
        "C", "L", "R" = Alineación del texto
        */
        $pdf->Cell(50,5,$row['nombre'], 1, 0, "C");
        $pdf->Cell(30,5,$row['cargo'], 1, 0, "C");
        $pdf->Cell(30,5,$row['salario'], 1, 0, "R");
        $pdf->Cell(20,5,$row['dias'], 1, 0, "C");
        $pdf->Cell(30,5,$row['salario_neto'], 1, 1, "C");
    }



    $pdf->Output();

?>