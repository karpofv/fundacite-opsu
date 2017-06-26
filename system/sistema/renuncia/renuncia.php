<?php
    if($_POST[noti]!=""){
        paraTodos::arrayUpdate("ren_notifi=1", "renuncia", "ren_codigo=$_POST[noti]");
    }
?>
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
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("*", "renuncia , tools_status", "ren_status=st_codigo");
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
