<?php
//-------------------------------------------------------
// GENERAL********************************************
//-------------------------------------------------------
$opcion = $_POST[actd];
if ($opcion == '1') {
    $update = paraTodos::arrayUpdate("ren_status=$_POST[status]", "renuncia", "ren_codigo=$_POST[codigo]");
}
?>
