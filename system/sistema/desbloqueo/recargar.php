<?php
//-------------------------------------------------------
// GENERAL********************************************
//-------------------------------------------------------
$opcion = $_POST[actd];
if ($opcion == '1') {
    $update = paraTodos::arrayUpdate("reg_status=$_POST[status]", "rsni", "reg_codigo=$_POST[codigo]");
}
?>
