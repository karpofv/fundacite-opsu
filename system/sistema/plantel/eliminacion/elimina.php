<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery-1.12.4.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta_base; ?>assets/plugins/datatables/buttons.colVis.min.js"></script>
<?php
$consulplantel= paraTodos::arrayConsulta("plant_codigo", "plantel", "plant_codzona=$_SESSION[ci]");
foreach($consulplantel as $plantel){
    $plantcodigo = $plantel[plant_codigo];
}
$codigo = $_POST[codigo];
$cedula = $_POST[reg_cedula];
$nombre = $_POST[reg_nombres];
$apellido = $_POST[reg_apellidos];
$correo = $_POST[reg_correo];
$telefono = $_POST[reg_telefono];
$fecha = $_POST[reg_fechaexp];
$consigplan = $_POST[reg_consigplan];
$consigced = $_POST[reg_consigced];
$nomrecep = $_POST[reg_recpnombre];
$aperecep = $_POST[reg_recepapellido];
$cedrecp = $_POST[reg_recepcedula];
$estadorecep = $_POST[reg_recepestado];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $cedula!="" and $codigo==""){
    $consul = paraTodos::arrayConsultanum("reg_cedula", "rsni", "reg_cedula=$cedula and reg_caso='ELIMINACION' and reg_status='1'");
    if ($consul>0){
        paraTodos::showMsg("Este estudiante ya posee un caso de ELIMINACION activo", "alert-danger");
    } else{
        $fecha = paraTodos::deconvertDate($fecha);
        paraTodos::arrayInserte("reg_plancodigo,reg_fecreg, reg_cedula, reg_nombres, reg_apellidos, reg_caso, reg_correo, reg_telefono, reg_fechaexp, reg_recpnombre, reg_recepapellido, reg_recepcedula, reg_recepestado, reg_status", "rsni", "'$plantcodigo',current_date, '$cedula', '$nombre', '$apellido', 'ELIMINACION','$correo', '$telefono', '$fecha', '$nomrecep', '$aperecep', '$cedrecp','$estadorecep', '1'");
    }
}
/*UPDATE*/
if($editar == 1 and $cedula !="" and $codigo!=""){
    $fecha = paraTodos::deconvertDate($fecha);    
    paraTodos::arrayUpdate("reg_cedula='$cedula', reg_nombres='$nombre', reg_apellidos='$apellido', reg_correo='$correo', reg_telefono='$telefono', reg_fechaexp='$fecha', reg_recpnombre='$nomrecep', reg_recepapellido='$aperecep', reg_recepcedula='$cedrecp', reg_recepestado='$estadorecep'", "rsni", "reg_codigo=$codigo");
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("reg_codigo=$codigo", "rsni");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $cedula =="" and $codigo!=""){
    $consulta = paraTodos::arrayConsulta("*", "rsni ", "reg_codigo=$codigo");
    foreach($consulta as $row){
        $cedula = $row[reg_cedula];
        $nombre = $row[reg_nombres];
        $apellido = $row[reg_apellidos];
        $correo = $row[reg_correo];
        $telefono = $row[reg_telefono];
        $fecha = paraTodos::convertDate($row[reg_fechaexp]);
        $consigplan = $row[reg_consigplan];
        $consigced = $row[reg_consigced];
        $nomrecep = $row[reg_recpnombre];
        $aperecep = $row[reg_recepapellido];
        $cedrecp = $row[reg_recepcedula];
        $estadorecep = $row[reg_recepestado];
    }
}
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">ELIMINACIONES</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Registrar caso</h4>
                                <div class="row">
                                    <form action="javascript:void(0);"
                                          onsubmit="
                                                    $.ajax({
                                                    url:'accion.php',
                                                    type:'POST',
                                                    data:{
                                                    dmn 	: <?php echo $idMenut;?>,
                                                    codigo 	: $('#codigo').val(),
                                                    plantcodigo : <?php echo $plantcodigo;?>,
                                                    reg_cedula : $('#cedula').val(),
                                                    reg_nombres : $('#nombre').val(),
                                                    reg_apellidos : $('#apellido').val(),
                                                    reg_correo : $('#correo').val(),
                                                    reg_telefono : $('#telefono').val(),
                                                    reg_fechaexp : $('#fecha').val(),
                                                    reg_consigplan : $('#consigplan').val(),
                                                    reg_consigced : $('#consigced').val(),
                                                    reg_recpnombre : $('#nomrecep').val(),
                                                    reg_recepapellido : $('#aperecep').val(),
                                                    reg_recepcedula : $('#cedrecep').val(),
                                                    reg_recepestado : $('#estadorecep').val(),
                                                    editar: 1,
                                                    ver 	: 2
                                                    },
                                                    success : function (html) {
                                                    $('#page-content').html(html);
                                                    $('#codigo').val('');
                                                    $('#cedula').val('');
                                                    $('#nombre').val('');
                                                    $('#apellido').val('');
                                                    $('#correo').val('');
                                                    $('#telefono').val('');
                                                    $('#fecha').val('');
                                                    $('#nomrecep').val('');
                                                    $('#aperecep').val('');
                                                    $('#cedrecep').val('');
                                                    },
                                                    }); return false;">                                     
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label class="control-label" for="fecha">Fecha</label>                                                
                                                <input class="form-control" id="fecha" type="text" value="<?php echo $fecha; ?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" for="cedula">Cedula</label>                                                
                                                <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>" min="0">
                                                <input class="form-control collapse" id="codigo" type="number" value="<?php echo $codigo; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cedula">Estado</label>                                                
                                                    <select class="form-control" id="estadorecep">
                                                        <?php
                                                        combos::CombosSelect("1", "$estadorecep", "est_codigo, est_descripcion", "tools_estados", "est_codigo", "est_descripcion", "1=1");
                                                        ?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="row">                                        
                                            <div class="col-sm-6">
                                                <label class="control-label" for="nombre">Nombres</label>                                                
                                                <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label" for="apellido">Apellidos</label>                                                
                                                <input class="form-control" id="apellido" type="text" value="<?php echo $apellido;?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="correo">Correo</label>                                                
                                                <input class="form-control" id="correo" type="mail" value="<?php echo $correo;?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="telefono">Teléfono</label>                                                
                                                <input class="form-control" id="telefono" type="text" value="<?php echo $telefono;?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label class="control-label" for="cedrecep">Cedula del receptor</label>                                                
                                                <input class="form-control" id="cedrecep" type="number" value="<?php echo $cedrecp;?>" min="0">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="nomrecep">Nombre del receptor</label>                                                
                                                <input class="form-control" id="nomrecep" type="text" value="<?php echo $nomrecep;?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="aperecep">Apellido del receptor</label>                                                
                                                <input class="form-control" id="aperecep" type="text" value="<?php echo $aperecep;?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <input id="enviar" type="submit" value="Guardar" class="btn btn-primary col-md-offset-5">
                                        </div>                                        
                                    </form>
                                </div>
                                <div class="row">
                                    <table class="table table-hover" id="plantel">
                                        <thead>
                                            <tr>
                                                <td class="text-center"><strong>Código</strong></td>
                                                <td class="text-center"><strong>Fecha</strong></td>
                                                <td class="text-center"><strong>Cedula</strong></td>
                                                <td class="text-center"><strong>Nombre</strong></td>
                                                <td class="text-center"><strong>Apellido</strong></td>
                                                <td class="text-center"><strong>Correo</strong></td>
                                                <td class="text-center"><strong>Teléfono</strong></td>
                                                <td class="text-center"><strong>Consig. Ced</strong></td>
                                                <td class="text-center"><strong>Consig. Plan.</strong></td>                                                
                                                <td class="text-center"><strong>Estatus</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $consulsol = paraTodos::arrayConsulta("*", "rsni , tools_status", "reg_plancodigo=$plantcodigo and reg_status=st_codigo and reg_caso='ELIMINACION'");
                                            foreach($consulsol as $row){
                                            ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[reg_codigo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_fechaexp];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_cedula];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_nombres];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_apellidos];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_correo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_telefono];?>
                                                </td>
                                                <?php
                                                if($row[reg_consigced]==1){
                                                    $icono = "fa fa-check-square";
                                                    $color = "green";
                                                } else {
                                                    $icono = "fa fa-times-circle";
                                                    $color = "red";
                                                }
                                                ?>                                                
                                                <td class="text-center">
                                                    <a href="javascript:void(0);"
                                                       onclick="$.ajax({
                                                                url:'accion.php',
                                                                type:'POST',
                                                                data:{
                                                                dmn 	: <?php echo $idMenut;?>,
                                                                codigo 	: <?php echo $row[reg_codigo];?>,
                                                                ver 	: 2,
                                                                act: 10,
                                                                actd: 1
                                                                },
                                                                success : function (html) {
                                                                $('#td_consigced<?php echo $row[reg_codigo];?>').html(html);
                                                                },
                                                                }); return false;" id="td_consigced<?php echo $row[reg_codigo];?>">
                                                        <i class="<?php echo $icono;?>" style="color:<?php echo $color;?>; font-size:16px;"></i>
                                                    </a>
                                                </td>
                                                <?php
                                                if($row[reg_consigplan]==1){
                                                    $icono2 = "fa fa-check-square";
                                                    $color2 = "green";
                                                } else {
                                                    $icono2 = "fa fa-times-circle";
                                                    $color2 = "red";                                                    
                                                }
                                                ?>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);"
                                                       onclick="$.ajax({
                                                                url:'accion.php',
                                                                type:'POST',
                                                                data:{
                                                                dmn 	: <?php echo $idMenut;?>,
                                                                codigo 	: <?php echo $row[reg_codigo];?>,
                                                                ver 	: 2,
                                                                act: 10,
                                                                actd: 2                                                                
                                                                },
                                                                success : function (html) {
                                                                $('#td_consigplan<?php echo $row[reg_codigo];?>').html(html);
                                                                },
                                                                }); return false;" id="td_consigplan<?php echo $row[reg_codigo];?>">
                                                        <i class="<?php echo $icono2;?>" style="color:<?php echo $color2;?>;  font-size:16px;"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[st_descripcion];?>
                                                </td>                                                
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[reg_codigo];?>,
                                                            editar 	: 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
                                                        },
                                                    }); return false;"><i class="fa fa-edit"></i>
									               </a>
                                                </td>
                                                <td class="text-center">
                                                <?php
                                                    if($row[reg_status]==1 or $row[reg_status]==4){
                                                ?>                                                    
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[reg_codigo];?>,
                                                            eliminar : 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
                                                        },
                                                    }); return false;"><i class="fa fa-eraser"></i>
									               </a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
<?php
								            }
?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#plantel').DataTable({
            language: {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
            , dom: 'Bfrtip'
            , buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    title: '',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (win) {
                        $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Eliminaciones</h4></div>');
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'colvis',
                    text: 'Columnas visibles'
                }
            ]
        });
    </script>
