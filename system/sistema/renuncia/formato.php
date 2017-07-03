<?php
require_once('../includes/fpdf/fpdf.php');
class PDF extends FPDF {
    function Header() {
        /*** Funcion Donde es Escribe los Datos que se Imprimen en la zona superior del Documento ***/
    }
    function Footer() {
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
$consulsol = paraTodos::arrayConsulta("es.est_descripcion,r.ren_codigo, r.ren_fecreg, r.ren_fecha, p.plant_descripcion, r.ren_cedula, r.ren_nombre, r.ren_apellido, ren_nacional, r.ren_anual, r.ren_universidad, r.ren_carrera, r.ren_motivo, r.ren_recepced, r.ren_recepnom, r.ren_recepape, s.st_descripcion", "renuncia r, plantel p, tools_nacionalidad n, tools_status s, tools_estados es", "r.ren_plancodigo=p.plant_codigo and r.ren_nacional=n.nac_codigo and r.ren_status=s.st_codigo and ren_codigo=$_GET[cod] and r.ren_recepestado=est_codigo");
foreach($consulsol as $row){
    /*DATOS*/
    $nombre = utf8_decode(strtoupper($row[ren_apellido]." ".$row[ren_nombre]));
    $venezola ="";
    $extran = "";
    if($row[ren_nacionalidad]==1){
        $venezola ="X";
    } else{
        $extran = "X";
    }
    $nombre = utf8_decode(strtoupper($row[ren_apellido]." ".$row[ren_nombre]));
    $nombrerecep = utf8_decode(strtoupper($row[ren_recepape]." ".$row[ren_recepnom]));
    $estado = utf8_decode(strtoupper($row[est_descripcion]));
    $motivo = utf8_decode(strtoupper($row[ren_motivo]));
    $universidad = utf8_decode(strtoupper($row[ren_universidad]));
    $carrera = utf8_decode(strtoupper($row[ren_carrera]));
    $fechaexp = $row[ren_fecha];
    $diasexp = date("d",strtotime($fechaexp));
    $anosexp = date("Y",strtotime($fechaexp));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mesexp = strtoupper($mes[(date('m', strtotime($fechaexp))*1)-1]);
    $cedulasol = number_format($row[ren_cedula],0, ",", ".");
    $cedularecep = number_format($row[ren_recepced],0, ",", ".");
    
    $pdf->MultiCell(0,5,utf8_decode("RENUNCIA DE CUPO "),0,'C',false);
    $pdf->Ln();
	$pdf->SetFont('Arial','',11);
    $pdf->MultiCell(0,8,utf8_decode("Yo $nombre, titular de la Cédula de identidad N.º V ( $venezola ) E ( $extran ) $cedulasol, informo que participe en el Sistema Nacional de Ingreso (SNI) del año $anosexp, fui asignado a la Institución de Educación Universitaria $universidad, en la carrera o Programa Nacional de Formación $carrera y hago constar por medio de la presente que renuncio al cupo en la carrera o PNF $carrera en la Institución antes mencionada."),0,'J',false);
    $pdf->Ln(20);
	$pdf->SetFont('Arial','B',11);    
    $pdf->MultiCell(0,5,utf8_decode("Motivo:"),0,'L',false);
	$pdf->SetFont('Arial','',11);    
    $pdf->Ln(10);
    $pdf->MultiCell(0,8,utf8_decode("$motivo"),0,'J',false);    
    $pdf->Ln(4);
    $pdf->MultiCell(0,8,utf8_decode("La presente se expide  en $estado a los $diasexp días del mes de $mesexp de $anosexp."),0,'J',false);
    $pdf->Ln(20);    
	$pdf->SetFont('Arial','B',11);
    $pdf->Cell(90,10,utf8_decode("DATOS DEL BACHILLER"),0,0,'J');    
    $pdf->Cell(90,10,utf8_decode("DATOS DEL FUNCIONARIO RECEPTOR"),0,1,'J');
    $pdf->Cell(90,10,utf8_decode("Nombre y Apellido: $nombre"),0,0,'J');    
    $pdf->Cell(90,10,utf8_decode("Nombre y Apellido: $nombrerecep"),0,1,'J');    
    $pdf->Cell(90,10,utf8_decode("Cédula de identidad N.º $cedulasol"),0,0,'J');
    $pdf->Cell(90,10,utf8_decode("Cédula de identidad N.º $cedularecep"),0,1,'J');
    $pdf->Line(190, 260, 20, 260);
	$pdf->SetFont('Arial','',8);
    $pdf->SetXY(60,261);
    $pdf->MultiCell(90,4,utf8_decode("Calle Este 2 entre Esq. Dr. Paúl y Salvador de León, Torre MPPEUCT - CNU, Sector La Hoyada, Parroquia Catedral, Municipio Libertador, Caracas www.opsu.gob.ve"),0,'C',false);    
}
$pdf->Output();
?>
