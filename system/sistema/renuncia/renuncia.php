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
                                <h4 class="m-b-30 m-t-0">Casos registrados</h4>
                                <div class="row">
                                    <table class="display font12" cellspacing="0" width="100%" id="plantel">
                                        <thead class="font12">
                                            <tr>
                                                <!--<td class="text-center"><strong>Doc. Aduntos</strong></td>-->
                                                <td class="text-center"><strong>Formato</strong></td>
                                                <td class="text-center"><strong>Código</strong></td>
                                                <td class="text-center"><strong>Fecha de Reg.</strong></td>
                                                <td class="text-center"><strong>Fecha de Exp.</strong></td>
                                                <td class="text-center"><strong>Estado</strong></td>                                                
                                                <td class="text-center"><strong>Plantel</strong></td>                                                
                                                <td class="text-center"><strong>Cedula</strong></td>
                                                <td class="text-center"><strong>Nombre</strong></td>
                                                <td class="text-center"><strong>Apellido</strong></td>
                                                <td class="text-center"><strong>Nacionalidad</strong></td>
                                                <td class="text-center"><strong>Año</strong></td>
                                                <td class="text-center"><strong>Universidad</strong></td>
                                                <td class="text-center"><strong>Carrera</strong></td>
                                                <td class="text-center"><strong>Motivo</strong></td>
                                                <td class="text-center"><strong>Cédula Recep.</strong></td>
                                                <td class="text-center"><strong>Nombre Recep.</strong></td>
                                                <td class="text-center"><strong>Apellido Recep.</strong></td>                                                
                                                <td class="text-center"><strong>Estatus</strong></td>
                                                <td class="text-center"><strong>Procesar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("es.est_descripcion,r.ren_codigo, r.ren_fecreg, r.ren_fecha, p.plant_descripcion, r.ren_cedula, r.ren_nombre, r.ren_apellido, n.nac_descripcion, r.ren_anual, r.ren_universidad, r.ren_carrera, r.ren_motivo, r.ren_recepced, r.ren_recepnom, r.ren_recepape, s.st_descripcion", "renuncia r, plantel p, tools_nacionalidad n, tools_status s, tools_estados es", "r.ren_plancodigo=p.plant_codigo and r.ren_nacional=n.nac_codigo and r.ren_status=s.st_codigo and r.ren_recepestado=es.est_codigo");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <!--<td class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-default" id="document" style="color:green;">
                                                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                                                    </a>
                                                </td>                                                -->
                                                <td class="text-center">
                                                    <a href="accion.php?ver=2&dmn=<?php echo $idMenut;?>&act=2&cod=<?php echo $row[ren_codigo];?>" class="btn btn-default" id="formats" style="color:green;" target="_blank">
                                                        <i class="fa fa-book" aria-hidden="true"></i>
                                                    </a>
                                                </td>                                                                                                
                                                <td class="text-center">
                                                    <?php echo $row[ren_codigo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo paraTodos::convertDate($row[ren_fecreg]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo paraTodos::convertDate($row[ren_fecha]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[est_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_descripcion];?>
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
                                                    <?php echo $row[nac_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_anual];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_universidad];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_carrera];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_motivo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_recepced];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_recepnom];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[ren_recepape];?>
                                                </td>                                                
                                                <td class="text-center">
                                                    <?php echo $row[st_descripcion];?>
                                                </td>
                                                <td class="text-center" id="td_status_<?php echo $row[ren_codigo];?>">
                                                    <?php
                                                        if($row[st_descripcion]=='ENVIADO'){
                                                    ?>
                                                    <select id="status" class="form-control"
                                                            onchange="
                                                                $.ajax({
                                                                url:'accion.php',
                                                                type:'POST',
                                                                data:{
                                                                dmn 	: <?php echo $idMenut;?>,
                                                                codigo 	: <?php echo $row[ren_codigo];?>,
                                                                ver 	: 2,
                                                                act     : 10,
                                                                actd    : 1,
                                                                status    : $('#status').val()
                                                                },
                                                                success : function (html) {
                                                                    $('#td_status_<?php echo $row[ren_codigo];?>').addClass('bg-green');
                                                                },
                                                                }); return false;">
                                                        <?php
                                                            combos::CombosSelect("1", "$row[ren_status]", "*", "tools_status", "st_codigo", "st_descripcion", "1=1");
                                                        ?>
                                                    </select>
                                                    <?php
                                                        } else {
                                                    ?>
                                                        <i class="fa fa-check-circle btn  btn-default" aria-hidden="true" style="color:green;"></i>
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
            },
            dom: 'Bfrtip',
            buttons: [
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
                        $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Renuncias registradas por plantel</h4></div>');
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'colvis',
                    text: 'Columnas visibles'
                }
            ],
            scrollX: "true",
            scrollY: "200px",
            "scrollCollapse": true
        });
    </script>

