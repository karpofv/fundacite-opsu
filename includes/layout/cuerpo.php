    <?php
    if($_SESSION['usuario_permisos']==3){
        $consulprov = paraTodos::arrayConsultanum("*", "proveedor", "prov_nit=$_SESSION[ci]");
        if($consulprov==0){
    ?>
    <div class="alert-danger" id="alerta-msg" style="margin-left:12%;">
        <a class="close" data-dismiss="alert" onclick="cerrar()">&times;</a>
        <strong>Atención!</strong> Debe actualizar su información detallada. Haga click <a href="javascript:void(0)" onclick="$.ajax({
            url:'accion.php',
            type:'POST',
            data:{
            dmn 	: 160,									
            nit: <?php echo $_SESSION[ci];?>,
            ver 	: 2
            },
            success : function (html) {
            $('#page-content').html(html);
            }
            }); return false">aquí</a>
    </div>
    <?php
        }
    }
    ?>
<div class="content-page" id="page-content">