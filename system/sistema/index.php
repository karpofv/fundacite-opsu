<?php
unset($_SESSION[ver]);
include("../includes/layout/head.php");
include("../includes/layout/header.php");
include("../includes/layout/sidebar.php");
include("../includes/layout/cuerpo.php");
$registrado = paraTodos::arrayConsultanum("Nombres, Apellidos", "registrados", "cedula=$_SESSION[ci]");
if($registrado>0){
    $consulregistrado = paraTodos::arrayConsulta("Nombres, Apellidos", "registrados", "cedula=$_SESSION[ci]");
    foreach($consulregistrado as $registrado){
        $nombre = ucfirst($registrado[Apellidos])." ".ucfirst($registrado[Nombres]);
    }
}else {
    $consulplantel = paraTodos::arrayConsulta("plant_descripcion", "plantel", "plant_codzona=$_SESSION[ci]");
    foreach($consulplantel as $plantel){
        $nombre = $plantel[plant_descripcion];
    }
}
?>        
            <div class="content">
                <div class="">
                    <div class="page-header-title">
                        <h4 class="page-title">Inicio</h4>
                        <h5 class="page-title">Bienvenido <?php echo $nombre;?></h5>
                    </div>
                </div>
                <div class="page-content-wrapper ">
                    <div class="container">
                    </div>
                </div>
            </div>
            <footer class="footer"> © 2017 FUNDACITE | Proveedores - Todos los Derechos Reservados. </footer>
    <?php
    include("../includes/layout/foot.php");
?>