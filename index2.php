<?php
error_reporting(E_ALL);
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
?>
<!-- PROBANDO GIMON -->

<?php
require_once 'includes/conexion.php';
require_once 'includes/conf/auth.php';
if ($_SESSION['usuario_nivel'] != 'Empleado') {
    header('Location: index.php?error_login=5');
    exit;
}

switch ($_SESSION['usuario_nivel']) {
  case 'Empleado':
  require_once 'includes/conexion.php';
  require_once 'system/modelo/class.consultas.php';

  /*
  |--------------------------------------------------------------------------
  | Instanciamos la clase consulta
  |--------------------------------------------------------------------------
  | Esto es para llamamr los metodos que se encuentran en la class consulta
  |
  */
  //mail($correou, "Acceso Creado para el Sistema VENEZOLANA DE TRANSPORTES Y CONSTRUCCIONES", $elcontenido,$headers)or die('Error enviando correo');
  header('Location: system/index.php');
  break;
}
?>
