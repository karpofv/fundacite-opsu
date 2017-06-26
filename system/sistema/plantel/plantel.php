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
$cozona = $_POST[cozona];
$nombre = $_POST[nombre];
$direccion = $_POST[direccion];
$parroquia = $_POST[parroquia];
$cedcontact = $_POST[cedcontact];
$nomcontact = $_POST[nomcontact];
$apecontact = $_POST[apecontact];
$telefcontact = $_POST[telefcontact];
$correocontact = $_POST[correocontact];
$eliminar = $_POST[eliminar];
$editar = $_POST[editar];
/*GUARDAR*/
if ($editar=='1' and $nombre!="" and $codigo==""){
    $consul = paraTodos::arrayConsultanum("plant_descripcion", "personal", "plant_descripcion='$nombre'");
    if ($consul>0){
        paraTodos::showMsg("Este plantel ya se encuentra registrado", "alert-danger");
    } else{
        paraTodos::arrayInserte("plant_codzona, plant_descripcion, plant_direccion, plant_parroquia, plant_contact_cedula, plant_contact_nombre, plant_contact_apellido, plant_contact_telefono, plant_contact_correo", "plantel", "$cozona, '$nombre', '$direccion', '$parroquia', '$cedcontact', '$nomcontact', '$apecontact', '$telefcontact', '$correocontact'");
    }
}
/*UPDATE*/
if($editar == 1 and $nombre !="" and $codigo!=""){
    paraTodos::arrayUpdate("plant_codzona='$cozona', plant_descripcion='$nombre', plant_direccion='$direccion', plant_parroquia='$parroquia', plant_contact_cedula='$cedcontact', plant_contact_nombre='$nomcontact', plant_contact_apellido='$apecontact', plant_contact_telefono='$telefcontact', plant_contact_correo='$correocontact'", "plantel", "plant_codigo=$codigo");
}
/*ELIMINAR*/
if ($eliminar !=''){
    paraTodos::arrayDelete("plant_codigo=$codigo", "plantel");
    $codigo="";
}
/*MOSTRAR*/
if($editar == 1 and $nombre =="" and $codigo!=""){
    $consulta = paraTodos::arrayConsulta("*", "plantel p", "p.plant_codigo=$codigo");
    foreach($consulta as $row){
        $cozona = $row[plant_codzona];
        $nombre = $row[plant_descripcion];
        $direccion = $row[plant_direccion];
        $parroquia = $row[plant_parroquia];
        $cedcontact = $row[plant_contact_cedula];
        $nomcontact = $row[plant_contact_nombre];
        $apecontact = $row[plant_contact_apellido];
        $telefcontact = $row[plant_contact_telefono];
        $correocontact = $row[plant_contact_correo];
            $consulpar = paraTodos::arrayConsulta("est_codigo, mun_codigo", "tools_estados e, tools_municipios m, tools_parroquia p", "m.mun_estcodigo=e.est_codigo and p.par_muncodigo=m.mun_codigo and p.par_codigo=$parroquia");
            foreach($consulpar as $par){
                $selestado = $par[est_codigo];
                $selmun = $par[mun_codigo];
            }        
    }
}
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Planteles</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Planteles</h4>
                                <div class="row">
                                    <form class="form-horizontal"
                                          onsubmit="
                                                    $.ajax({
                                                    url:'accion.php',
                                                    type:'POST',
                                                    data:{
                                                    dmn 	: <?php echo $idMenut;?>,
                                                    codigo 	: $('#codigo').val(),
                                                    cozona  : $('#cozona').val(),
                                                    nombre  : $('#nombre').val(),
                                                    direccion   : $('#direccion').val(),
                                                    parroquia   : $('#parroquia').val(),
                                                    cedcontact  : $('#cedcontact').val(),
                                                    nomcontact  : $('#nomcontact').val(),
                                                    apecontact  : $('#apecontact').val(),
                                                    telefcontact    : $('#telefcontact').val(),
                                                    correocontact   : $('#correocontact').val(),
                                                    editar: 1,
                                                    ver 	: 2
                                                    },
                                                    success : function (html) {
                                                    $('#page-content').html(html);
                                                    $('#codigo').val('');
                                                    $('#cozona').val('');
                                                    $('#nombre').val('');
                                                    $('#direccion').val('');
                                                    $('#parroquia').val('');
                                                    $('#cedcontact').val('');
                                                    $('#nomcontact').val('');
                                                    $('#apecontact').val('');
                                                    $('#telefcontact').val('');
                                                    $('#correocontact').val('');
                                                    },
                                                    }); return false;">
    <!--DATOS DEL PLANTEL-->
                                        <div class="col-sm-6">
                                            <div class="box-header">
                                                <h4>Datos del plantel</h4>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="cozona">Código</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="cozona" type="number" value="<?php echo $cozona; ?>">
                                                    <input class="form-control collapse" id="codigo" type="number" value="<?php echo $codigo; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="nombre">Nombre del plantel</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>"> </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="direccion">Dirección</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="direccion" type="text" value="<?php echo $direccion;?>"> </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="selestado">Estados</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="selestado"
                                                            onchange="$.ajax({
                                                                      type: 'POST',
                                                                      url: 'accion.php',
                                                                      data: {
                                                                      codigo: $('#selestado').val(), 
                                                                      dmn: <?php echo $idMenut;?>,
                                                                      ver: 2,
                                                                      act: 10,
                                                                      actd: 1
                                                                      },
                                                                      ajaxSend: $('#selmun').html(cargando),                                                    
                                                                      success: function(html) { $('#selmun').html(html); }
                                                                      });">
                                                        <option value="0">Seleccione un estado</option>
                                                        <?php
                                                        combos::CombosSelect("1", "$selestado", "est_codigo, est_descripcion", "tools_estados", "est_codigo", "est_descripcion", "1=1");
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="selmunicipio">Municipios</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="selmun"
                                                            onchange="$.ajax({
                                                                      type: 'POST',
                                                                      url: 'accion.php',
                                                                      data: {
                                                                      codigo: $('#selmun').val(), 
                                                                      dmn: <?php echo $idMenut;?>,
                                                                      ver: 2,
                                                                      act: 10,
                                                                      actd:2
                                                                      },
                                                                      ajaxSend: $('#parroquia').html(cargando),                                                    
                                                                      success: function(html) { $('#parroquia').html(html); }
                                                                      });">
                                                        <option value="0">Seleccione un municipio</option>                                        
                                                        <?php
                                                        combos::CombosSelect("1", "$selmun", "mun_codigo, mun_descripcion", "tools_municipios", "mun_codigo", "mun_descripcion", "mun_estcodigo=$selestado");
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="parroquia">Parroquias</label>
                                                <div class="col-sm-8">
                                                <select class="form-control" id="parroquia">
                                                    <option value="0">Seleccione una parroquia</option>
                                                    <?php
                                                        combos::CombosSelect("1", "$parroquia", "par_codigo, par_descripcion", "tools_parroquia", "par_codigo", "par_descripcion", "par_muncodigo=$selmun");
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
    <!--FIN DATOS DEL PLANTEL-->
    <!--DATOS DE CONTACTO-->
                                        <div class="col-sm-6">
                                            <div class="box-header">
                                                <h4>Datos de contacto</h4>
                                            </div>                                            
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="cedcontact">Cédula</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="cedcontact" type="number" value="<?php echo $cedcontact;?>"> </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="nomcontact">Nombres</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="nomcontact" type="text" value="<?php echo $nomcontact;?>"> </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="apecontact">Apellidos</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="apecontact" type="text" value="<?php echo $apecontact;?>"> </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="telefcontact">Teléfonos</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="telefcontact" type="text" value="<?php echo $telefcontact;?>"> </div>
                                            </div>
                                            <div class="form-group" style="display: block;">
                                                <label class="col-sm-2 control-label" for="correocontact">Correo electrónico</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" id="correocontact" type="mail" value="<?php echo $correocontact;?>"> </div>
                                            </div>                                            
                                        </div>
    <!--FIN DATOS DE CONTACTO-->                                        
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
                                                <td class="text-center"><strong>Nombre</strong></td>
                                                <td class="text-center"><strong>Dirección</strong></td>
                                                <td class="text-center"><strong>Parroquia</strong></td>
                                                <td class="text-center"><strong>Nombre de contact</strong></td>
                                                <td class="text-center"><strong>Telef. de contact</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("*", "plantel p, tools_parroquia par", "p.plant_parroquia=par.par_codigo");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[plant_codzona];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_direccion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[par_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_contact_nombre];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_contact_telefono];?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[plant_codigo];?>,
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
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            codigo 	: <?php echo $row[plant_codigo];?>,
                                                            eliminar : 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
                                                        },
                                                    }); return false;"><i class="fa fa-eraser"></i>
									               </a>
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
