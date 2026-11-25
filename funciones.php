<?php

require('libraries/fpdf186/fpdf.php');

function generarComprobante($monto, $email, $chargeId, $carrito, $rutaComprobante, $codigoUnico, $apellidos, $nombres, $dni)
{
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);

    $logoPath = 'public/images/logo.png'; 
    $pdf->Image($logoPath, 10, 10, 50); 
    $pdf->Ln(20); 

    $pdf->Ln(20); 

    $pdf->SetX(50); 

    $pdf->Ln(15); 
    $pdf->SetFont('Arial', 'B', 14); 
    $pdf->Cell(0, 10, 'REPRESENTACIONES GENERALES HABEL E.I.R.L', 0, 0, 'L'); 
    $pdf->SetFont('Arial', '', 12); 
    $pdf->Cell(0, 10, '', 0, 1);
    $pdf->SetFont('Arial', '', 12); 
    $pdf->MultiCell(0, 10, utf8_decode('Dirección: AV. NICOLAS DE PIEROLA NRO. 611 CERCADO DE LIMA (CRUCE CON RUFINOTORRICO) LIMA - LIMA - LIMA'), 0, 'L');
    
    $pdf->Cell(0, 10, utf8_decode ('Teléfono: (01) 3635726'), 0, 1);

    $pdf->Cell(0, 10, utf8_decode ('Página Web: https://eventu.qhapai.com'), 0, 1);

    $pdf->Cell(0, 10, 'RUC: 20522442853', 0, 1);

    $pdf->Ln(5); 

    $pdf->SetFont('Arial', 'B', 14); 
    $pdf->Cell(0, 10, 'COMPROBANTE DE LA COMPRA', 0, 1, 'L'); 
    $pdf->SetFont('Arial', '', 12); 

    $pdf->Ln(5); 
    $pdf->Cell(0, 10, 'Apellidos: ' . $apellidos, 0, 1); 
    $pdf->Cell(0, 10, 'Nombres: ' . $nombres, 0, 1);
    $pdf->Cell(0, 10, 'DNI: ' . $dni, 0, 1); 

    $pdf->Ln(5); 
    $pdf->Cell(0, 10, 'Monto de la compra: S/. ' . $monto, 0, 1);
    $pdf->Cell(0, 10, 'Email: ' . $email, 0, 1);

    $pdf->Ln(10); 
    $pdf->SetFont('Arial', 'B', 14); 
    $pdf->SetFillColor(200, 220, 255); 

    $pdf->Cell(80, 10, 'Nombre del Producto', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Precio Unitario', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Subtotal', 1, 1, 'C', true);

    foreach ($carrito as $item) {
        $nombreProducto = $item['producto'];
        $precioUnitario = 'S/. ' . number_format($item['precio'], 2, '.', ',');
        $cantidad = $item['cantidad'];
        $subtotal = 'S/. ' . number_format($item['precio'] * $item['cantidad'], 2, '.', ',');
        
        $nombreProducto = mb_strimwidth($nombreProducto, 0, 30, '...');
        
        $lineasNombreProducto = calcularLineasTexto($pdf, $nombreProducto, 80);
        
        $alturaCelda = $lineasNombreProducto * 8; 
        
        $xActual = $pdf->GetX();
        $yActual = $pdf->GetY();
        
        $pdf->MultiCell(80, $alturaCelda, $nombreProducto, 1);
        
        $nuevaY = $pdf->GetY();
        
        $pdf->SetXY($xActual + 80, $yActual);
        
        $pdf->Cell(40, $alturaCelda, $precioUnitario, 1, 0, 'C');
        
        $pdf->SetXY($xActual + 120, $yActual);
        
        $pdf->Cell(30, $alturaCelda, $cantidad, 1, 0, 'C');
        
        $pdf->SetXY($xActual + 150, $yActual);
        
        $pdf->Cell(40, $alturaCelda, $subtotal, 1, 1, 'C'); 
        
        $pdf->SetXY($xActual, $nuevaY);
    }
    
    $codigoUnico = $_POST['codigoUnico']; 


    $fechaActual = date("Ymd_His");
    $nombreArchivo = 'comprobante_' . $codigoUnico . '.pdf'; 
    

    $rutaComprobante = 'ComprobantesDePago/' . $nombreArchivo;
    $pdf->Output($rutaComprobante, 'F');

    
    return 'Comprobante generado exitosamente en: ' . $rutaComprobante;
}

if (isset($_POST['generarComprobante'])) {
    $email = $_POST['email'];
    $monto = $_POST['monto'];
    $chargeId = isset($_SESSION['chargeId']) ? $_SESSION['chargeId'] : '';
    $carrito = json_decode(urldecode($_POST['carrito']), true);
    $codigoUnico = $_POST['codigoUnico'];
    $nombres = $_POST['nombres']; 
    $apellidos = $_POST['apellidos']; 
    $dni = $_POST['dni']; 

    $rutaComprobante = 'ComprobantesDePago/comprobante.pdf'; 
    echo generarComprobante($monto, $email, $chargeId, $carrito, $rutaComprobante, $codigoUnico, $nombres, $apellidos, $dni);
    exit;
}


function calcularLineasTexto($pdf, $texto, $anchoMaximo) {
    $lineas = 0;
    $textoRestante = $texto;

    while ($pdf->GetStringWidth($textoRestante) > $anchoMaximo) {
        $lineas++;
        $indiceSalto = strrpos($textoRestante, ' ', 0);

        if ($indiceSalto === false) {
            
            $indiceSalto = $anchoMaximo;
        }

        $textoRestante = substr($textoRestante, $indiceSalto);

        if ($textoRestante == $texto) {
            break;
        }
    }

    $lineas = max(1, $lineas);
    return $lineas;
}

?>
