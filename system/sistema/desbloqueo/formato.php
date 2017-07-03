<?php
require_once('../includes/fpdf/fpdf.php');
class PDF extends FPDF {
    function Header() {
        /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona superior del Documento ***/
    }
    function Footer() {
        /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona Inferior del Documento ***/
    }
}
$pdf=new PDF();
$pdf->addpage();
$pdf->SetMargins(20, 20 , 20); 
$pdf->Image($absolute_uri.'assets/images/cintillo.png',10,10,180);
/*$pdf->Cell(0,5,utf8_decode('Inventario de Esta'),0,1,'C');
$pdf->Cell(0,5,utf8_decode('de la Universidad Nacional Experimental de los Llanos Occidentales'),0,1,'C');
$pdf->Cell(0,5,utf8_decode('"Ezequiel Zamora"'),0,1,'C');
$pdf->Cell(0,5,utf8_decode('"UNELLEZ"'),0,1,'C');*/
$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);
$consulsol = paraTodos::arrayConsulta("r.reg_status,r.reg_codigo, p.plant_descripcion, r.reg_fecreg, r.reg_fechaexp, r.reg_cedula, r.reg_nombres, r.reg_apellidos, r.reg_correo, r.reg_telefono, r.reg_recepcedula, r.reg_recpnombre, r.reg_recepapellido, e.est_descripcion, s.st_descripcion", "rsni r, plantel p, tools_estados e , tools_status s", "r.reg_plancodigo=p.plant_codigo and r.reg_recepestado=e.est_codigo and reg_caso='DESBLOQUEO' and s.st_codigo=r.reg_status and reg_codigo=$_GET[cod]");
foreach($consulsol as $row){
    /*DATOS*/
    $nombre = utf8_decode(strtoupper($row[reg_apellidos]." ".$row[reg_nombres]));
    $nombrerecep = utf8_decode(strtoupper($row[reg_recepapellido]." ".$row[reg_recpnombre]));
    $correo = utf8_decode(strtoupper($row[reg_correo]));
    $telefono = utf8_decode(strtoupper($row[reg_telefono]));
    $estado = utf8_decode(strtoupper($row[est_descripcion]));
    $fechaexp = $row[reg_fechaexp];
    $diasexp = date("d",strtotime($fechaexp));
    $anosexp = date("Y",strtotime($fechaexp));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mesexp = strtoupper($mes[(date('m', strtotime($fechaexp))*1)-1]);
    $cedulasol = number_format($row[reg_cedula],0, ",", ".");
    $cedularecep = number_format($row[reg_recepcedula],0, ",", ".");
    
    $pdf->MultiCell(0,5,utf8_decode("SOLICITUD DE ELIMINACIÓN O DESBLOQUEO DE REGISTRO EN EL SISTEMA NACIONAL DE INGRESO $anosexp"),0,'C',false);
    $pdf->Ln();
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(100,4,"Yo, $nombre",0,0,'J');
    $pdf->Cell(50,4,"C.I.:, $cedulasol",0,0,'J');
    $pdf->Cell(30,4," solicito:",0,0,'J');
    $pdf->Ln(20);
	$pdf->SetFont('Arial','B',12);
    $pdf->Cell(50,10,utf8_decode("Eliminación del Registro:"),0,0,'J');    
    $pdf->Cell(10,10,utf8_decode(""),0,0,'J');
    $pdf->Cell(10,10,utf8_decode(""),1,1,'J');    
    $pdf->Ln(4);    
    $pdf->Cell(50,10,utf8_decode("Desbloqueo del Expediente:"),0,0,'J');
    $pdf->Cell(10,10,utf8_decode(""),0,0,'J');
    $pdf->Cell(10,10,utf8_decode("X"),1,1,'C');
	$pdf->SetFont('Arial','',12);    
    $pdf->Cell(30,10,utf8_decode("En el registro del Sistema Nacional de Ingreso por la siguiente razón:"),0,1,'J');
    $pdf->Cell(30,8,utf8_decode("Datos del Aspirante:"),0,1,'J');    
    $pdf->Cell(180,8,utf8_decode("Correo Electrónico (Unipersonal): $correo"),0,1,'J');    
    $pdf->Cell(180,8,utf8_decode("Número Teléfonico: $telefono"),0,1,'J');
    $pdf->Ln(20);
    $pdf->Cell(180,8,utf8_decode("La presente se expide en $estado a los $diasexp días del mes de $mesexp de $anosexp."),0,1,'J');
    $pdf->Cell(180,15,utf8_decode("Firma del Aspirante: __________________________."),0,1,'J');
	$pdf->SetFont('Arial','B',13);    
    $pdf->MultiCell(180,10,utf8_decode("SOLO PARA SER LLENADO POR EL RESPONSABLE DE LA UNIDAD TERRITORIAL"),0,'C',false);    
	$pdf->SetFont('Arial','',12);
    $pdf->Cell(180,10,utf8_decode("Doy constancia de recibir la siguiente documentación para la eliminación de expediente:"),0,1,'J');
    $pdf->Cell(180,10,utf8_decode("Planillas Originales emitidas en el registro del SNI-$anosexp"),0,1,'J');
    $pdf->Cell(180,10,utf8_decode("Fotocopia de la cédula de Identidad"),0,1,'J');
	$pdf->SetFont('Arial','B',9);
    $pdf->Cell(180,10,utf8_decode("DATOS DEL FUNCIONACIO RECEPTOR"),0,1,'J');    
    $pdf->Cell(45,8,utf8_decode("ESTADO"),1,0,'C');    
    $pdf->Cell(45,8,utf8_decode("NOMBRE Y APELLIDO"),1,0,'C');    
    $pdf->Cell(45,8,utf8_decode("CEDULA"),1,0,'C');    
    $pdf->Cell(45,8,utf8_decode("FIRMA"),1,1,'C');    
	$pdf->SetFont('Arial','',9);    
    $pdf->Cell(45,8,utf8_decode("$estado"),1,0,'C');    
    $pdf->Cell(45,8,utf8_decode("$nombrerecep"),1,0,'C');    
    $pdf->Cell(45,8,utf8_decode("$cedularecep"),1,0,'C');    
    $pdf->Cell(45,8,utf8_decode(""),1,1,'C');    
}
$pdf->Output();
?>
