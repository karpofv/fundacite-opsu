<?php
//-------------------------------------------------------
// GENERAL********************************************
//-------------------------------------------------------
$opcion = $_POST[actd];
if ($opcion == '1') {
    $consulstatus = paraTodos::arrayConsulta("reg_consigced", "rsni", "reg_codigo=$_POST[codigo]");
    foreach($consulstatus as $statusconsul){
        $status = $statusconsul[reg_consigced];
    }
    if($status==1){
        $statusmod = 2;
        $icono = "fa fa-times-circle";
        $color = "red";
    } else {
        $statusmod = 1;
        $icono = "fa fa-check-square";
        $color = "green";        
    }
    $update = paraTodos::arrayUpdate("reg_consigced=$statusmod", "rsni", "reg_codigo=$_POST[codigo]");
    echo "<i class='$icono' style='color:$color; font-size:16px;'></i>";
}
if ($opcion == '2') {
    $consulstatus = paraTodos::arrayConsulta("reg_consigplan", "rsni", "reg_codigo=$_POST[codigo]");
    foreach($consulstatus as $statusconsul){
        $status = $statusconsul[reg_consigplan];
    }
    if($status==1){
        $statusmod = 2;
        $icono = "fa fa-times-circle";
        $color = "red";        
    } else {
        $statusmod = 1;
        $icono = "fa fa-check-square";
        $color = "green";                
    }
    $update = paraTodos::arrayUpdate("reg_consigplan=$statusmod", "rsni", "reg_codigo=$_POST[codigo]");
    echo "<i class='$icono' style='color:$color; font-size:16px;'></i>";
}
?>
