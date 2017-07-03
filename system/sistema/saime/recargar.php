<?php
//-------------------------------------------------------
// GENERAL********************************************
//-------------------------------------------------------
$opcion = $_POST[actd];
if ($opcion == '1') {
    $update = paraTodos::arrayUpdate("sai_status=$_POST[status]", "saime", "sai_codigo=$_POST[codigo]");
}
?>
