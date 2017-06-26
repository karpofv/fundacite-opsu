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

$codigo = $_POST[codigo];
$plantcodigo = 2;
$cedula = $_POST[cedula];      
$nombre = $_POST[nombre];      
$apellido = $_POST[apellido];      
$nacional = $_POST[nacional];      
$anual = $_POST[anual];      
$universidad = $_POST[universidad];      
$carrera = $_POST[carrera];      
$motivo = $_POST[motivo];      
$fecha = $_POST[fecha];      
$cedrecp = $_POST[cedrecp];      
$nomrecep = $_POST[nomrecep];      
$aperecep = $_POST[aperecep];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $cedula!="" and $codigo==""){
    $consul = paraTodos::arrayConsultanum("ren_cedula", "renuncia", "ren_cedula=$cedula and ren_carrera='$carrera' and ren_universidad='$universidad'");
    if ($consul>0){
        paraTodos::showMsg("Este estudiante ya posee un caso de renuncia registrado bajo esta carrera en la universidad indicada", "alert-danger");
    } else{
        $fecha = paraTodos::deconvertDate($fecha);
        paraTodos::arrayInserte("ren_fecreg, ren_plancodigo,ren_cedula, ren_nombre, ren_apellido, ren_nacional, ren_anual, ren_universidad, ren_carrera, ren_motivo, ren_fecha, ren_recepced, ren_recepnom, ren_recepape, ren_status", "renuncia", "current_date, '$plantcodigo', '$cedula', '$nombre', '$apellido', '$nacional', '$anual', '$universidad', '$carrera', '$motivo', '$fecha', '$cedrecp', '$nomrecep', '$aperecep', '1'");
    }
}
/*UPDATE*/
if($editar == 1 and $cedula !="" and $codigo!=""){
    $fecha = paraTodos::deconvertDate($fecha);    
    paraTodos::arrayUpdate("ren_plancodigo='$plantcodigo',ren_cedula='$cedula', ren_nombre='$nombre', ren_apellido='$apellido', ren_nacional='$nacional', ren_anual='$anual', ren_universidad='$universidad', ren_carrera='$carrera', ren_motivo='$motivo', ren_fecha='$fecha', ren_recepced='$cedrecp', ren_recepnom='$nomrecep', ren_recepape='$aperecep'", "renuncia", "ren_codigo=$codigo");
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("ren_codigo=$codigo", "renuncia");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $cedula =="" and $codigo!=""){
    $consulta = paraTodos::arrayConsulta("*", "renuncia ", "ren_codigo=$codigo");
    foreach($consulta as $row){
        $plantcodigo = $row[ren_plancodigo];      
        $cedula = $row[ren_cedula];      
        $nombre = $row[ren_nombre];      
        $apellido = $row[ren_apellido];      
        $nacional = $row[ren_nacional];      
        $anual = $row[ren_anual];      
        $universidad = $row[ren_universidad];      
        $carrera = $row[ren_carrera];      
        $motivo = $row[ren_motivo];      
        $fecha = $row[ren_fecha];      
        $cedrecep = $row[ren_recepced];      
        $nomrecep = $row[ren_recepnom];      
        $aperecep = $row[ren_recepape];
    }
}
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Renuncias</h4> </div>
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
                                                    nacional : $('#nacional').val(),     
                                                    anual : $('#anual').val(),     
                                                    universidad : $('#universidad').val(),     
                                                    carrera : $('#carrera').val(),     
                                                    motivo : $('#motivo').val(),     
                                                    fecha : $('#fecha').val(),     
                                                    cedrecp : $('#cedrecep').val(),     
                                                    nomrecep : $('#nomrecep').val(),     
                                                    aperecep : $('#aperecep').val(),
                                                    editar: 1,
                                                    ver 	: 2
                                                    },
                                                    success : function (html) {
                                                    $('#page-content').html(html);
                                                    $('#codigo').val('');
                                                    $('#cedula').val('');
                                                    $('#nombre').val('');
                                                    $('#apellido').val('');
                                                    $('#nacional').val('');
                                                    $('#anual').val('');
                                                    $('#universidad').val('');
                                                    $('#carrera').val('');
                                                    $('#motivo').val('');
                                                    $('#fecha').val('');
                                                    $('#cedrecep').val('');
                                                    $('#nomrecep').val('');
                                                    $('#aperecep').val('');
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
                                            <div class="col-sm-2">
                                                <label class="control-label" for="nacional">Nacionalidad</label>                                                
                                                <select class="form-control" id="nacional">
                                                    <?php
                                                    combos::CombosSelect("1", "$nacional", "nac_codigo, nac_descripcion", "tools_nacionalidad", "nac_codigo", "nac_descripcion", "1=1");
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
                                            <div class="col-sm-2">
                                                <label class="control-label" for="anual">Año</label>                                                
                                                <input class="form-control" id="anual" type="number" value="<?php echo $anual;?>" min="0">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="universidad">Universidad</label>                                                
                                                <input class="form-control" id="universidad" type="text" value="<?php echo $universidad;?>">
                                            </div>
                                            <div class="col-sm-5">
                                                <label class="control-label" for="carrera">Carrera</label>                                                
                                                <input class="form-control" id="carrera" type="text" value="<?php echo $carrera;?>">
                                            </div>
                                            <div class="col-sm-12">
                                                <label class="control-label" for="motivo">Motivo</label>                                                
                                                <input class="form-control" id="motivo" type="text" value="<?php echo $motivo;?>">
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="control-label" for="cedrecep">Cedula del receptor</label>                                                
                                                <input class="form-control" id="cedrecep" type="number" value="<?php echo $cedrecep;?>" min="0">
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
                                                <td class="text-center"><strong>Cedula</strong></td>
                                                <td class="text-center"><strong>Nombre</strong></td>
                                                <td class="text-center"><strong>Apellido</strong></td>
                                                <td class="text-center"><strong>Universidad</strong></td>
                                                <td class="text-center"><strong>Carrera</strong></td>
                                                <td class="text-center"><strong>Estatus</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("*", "renuncia , tools_status", "ren_plancodigo=$plantcodigo and ren_status=st_codigo");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[ren_codigo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_cedula];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_nombre];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_apellido];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_universidad];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_carrera];?>
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
                                                            codigo 	: <?php echo $row[ren_codigo];?>,
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
                                                    if($row[ren_status]==1 or $row[ren_status]==4){
                                                ?>                                                    
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[ren_codigo];?>,
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
                        $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Clientes registrados</h4></div>');
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
