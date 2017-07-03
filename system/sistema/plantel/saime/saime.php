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
$cedula = $_POST[cedula];      
$nombre = $_POST[nombre];      
$apellido = $_POST[apellido];
$fecnac = $_POST[fecnac];
$sexo = $_POST[sexo];
$tipo = $_POST[tipo];
$correo = $_POST[correo];
$telefono = $_POST[telefono];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $cedula!="" and $codigo==""){
    $fecnac = paraTodos::deconvertDate($fecnac);  
    paraTodos::arrayInserte("sai_plancodigo, sai_fecreg,sai_cedula, sai_nombre, sai_apellido, sai_fecnac, sai_tipopob, sai_correo, sai_sexo, sai_telefono", "saime", "'$plantcodigo',current_date,'$cedula', '$nombre', '$apellido', '$fecnac', '$tipo', '$correo', '$sexo', '$telefono'");
}
/*UPDATE*/
if($editar == 1 and $cedula !="" and $codigo!=""){
    $fecha = paraTodos::deconvertDate($fecha);
    paraTodos::arrayUpdate("sai_plancodigo='$plantcodigo', sai_cedula='$cedula', sai_nombre='$nombre', sai_apellido='$apellido', sai_fecnac='$fecnac', sai_tipopob='$tipo', sai_correo='$correo', sai_sexo='$sexo', sai_telefono='$telefono'", "saime", "sai_codigo=$codigo");
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("sai_codigo=$codigo", "saime");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $cedula =="" and $codigo!=""){
    $consulta = paraTodos::arrayConsulta("*", "saime ", "sai_codigo=$codigo");
    foreach($consulta as $row){
        $cedula = $row[sai_cedula];      
        $nombre = $row[sai_nombre];      
        $apellido = $row[sai_apellido];
        $fecnac = $row[sai_fecnac];
        $sexo = $row[sai_sexo];
        $tipo = $row[sai_tipopob];
        $correo = $row[sai_correo];
        $telefono = $row[sai_telefono];
    }
}
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">SAIME</h4> </div>
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
                                                    cedula : $('#cedula').val(),
                                                    nombre : $('#nombre').val(),
                                                    apellido : $('#apellido').val(),
                                                    fecnac : $('#fecnac').val(),
                                                    sexo : $('#sexo').val(),
                                                    tipo : $('#tipo').val(),
                                                    correo : $('#correo').val(),
                                                    telefono : $('#telef').val(),
                                                    editar: 1,
                                                    ver 	: 2
                                                    },
                                                    success : function (html) {
                                                    $('#page-content').html(html);
                                                    $('#codigo').val('');
                                                    $('#cedula').val('');
                                                    $('#nombre').val('');
                                                    $('#apellido').val('');
                                                    $('#fecnac').val('');
                                                    $('#sexo').val('');
                                                    $('#tipo').val('');
                                                    $('#correo').val('');
                                                    $('#telefono').val('');
                                                    },
                                                    }); return false;">                                     
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label class="control-label" for="cedula">Cedula</label>                                                
                                                <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>" min="0" required>
                                                <input class="form-control collapse" id="codigo" type="number" value="<?php echo $codigo; ?>">
                                            </div>
                                        </div>
                                        <div class="row">                                        
                                            <div class="col-sm-6">
                                                <label class="control-label" for="nombre">Nombres</label>                                                
                                                <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="control-label" for="apellido">Apellidos</label>                                                
                                                <input class="form-control" id="apellido" type="text" value="<?php echo $apellido;?>" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" for="fecnac">Fecha de nacimiento</label>                                                
                                                <input class="form-control" id="fecnac" type="text" value="<?php echo paraTodos::convertDate($fecnac);?>" required>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" for="sexo">Sexo</label>                                                
                                                <select class="form-control" id="sexo" required>
                                                        <?php
                                                        combos::CombosSelect("1", "$sexo", "id, Nombre", "sexo", "id", "Nombre", "1=1");
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label" for="tipo">Tipo de población</label>
                                                <select class="form-control" id="tipo" required>
                                                        <?php
                                                        combos::CombosSelect("1", "$tipo", "tip_codigo, tip_descripcion", "tools_tipopob", "tip_codigo", "tip_descripcion", "1=1");
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="correo">Correo</label>                                                
                                                <input class="form-control" id="correo" type="mail" value="<?php echo $correo;?>" required>
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="control-label" for="telef">Teléfono</label>                                                
                                                <input class="form-control" id="telef" type="tel" value="<?php echo $telefono;?>" required>
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
                                                <td class="text-center"><strong>Cedula</strong></td>
                                                <td class="text-center"><strong>Nombre</strong></td>
                                                <td class="text-center"><strong>Apellido</strong></td>
                                                <td class="text-center"><strong>Sexo</strong></td>
                                                <td class="text-center"><strong>Fec. Nac.</strong></td>
                                                <td class="text-center"><strong>Correo</strong></td>
                                                <td class="text-center"><strong>Teléfono</strong></td>
                                                <td class="text-center"><strong>Tipo de pob.</strong></td>
                                                <td class="text-center"><strong>Estatus</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("*", "saime , tools_status, sexo s", "sai_plancodigo=$plantcodigo and sai_status=st_codigo and sai_sexo=s.id");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[sai_codigo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_cedula];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_nombre];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_apellido];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_sexo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_fecnac];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_correo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_telefono];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_tipopob];?>
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
                                                            codigo 	: <?php echo $row[sai_codigo];?>,
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
                                                    if($row[sai_status]==1 or $row[sai_status]==4){
                                                ?>                                                    
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[sai_codigo];?>,
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
                        $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Casos SAIME registrados</h4></div>');
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
