<?php
    if($_POST[noti]!=""){
        paraTodos::arrayUpdate("sai_notifi=1", "saime", "sai_codigo=$_POST[noti]");
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
                <h4 class="page-title">SAIME</h4> </div>
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
                                        <thead>
                                            <tr>
                                                <!--<td class="text-center"><strong>Doc. Aduntos</strong></td>-->
                                                <td class="text-center"><strong>Formato</strong></td>                                                
                                                <td class="text-center"><strong>Código</strong></td>
                                                <td class="text-center"><strong>Fecha Reg.</strong></td>
                                                <td class="text-center"><strong>Plantel</strong></td>
                                                <td class="text-center"><strong>Cedula</strong></td>
                                                <td class="text-center"><strong>Nombre</strong></td>
                                                <td class="text-center"><strong>Apellido</strong></td>
                                                <td class="text-center"><strong>Sexo</strong></td>
                                                <td class="text-center"><strong>Fec. Nac.</strong></td>
                                                <td class="text-center"><strong>Correo</strong></td>
                                                <td class="text-center"><strong>Teléfono</strong></td>
                                                <td class="text-center"><strong>Tipo de pob.</strong></td>
                                                <td class="text-center"><strong>Estatus</strong></td>
                                                <td class="text-center"><strong>Procesar</strong></td>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("sa.sai_codigo, sa.sai_fecreg, p.plant_descripcion, sa.sai_cedula, sa.sai_nombre, sa.sai_apellido, se.Nombre, sa.sai_fecnac, sa.sai_correo, sa.sai_telefono, t.tip_descripcion, st.st_descripcion", "saime sa, plantel p, sexo se, tools_tipopob t, tools_status st", "sa.sai_plancodigo=p.plant_codigo and sa.sai_sexo=se.id and sa.sai_tipopob=t.tip_codigo and sa.sai_status=st.st_codigo");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                               <!-- <td class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-default" id="document" style="color:green;">
                                                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                                                    </a>
                                                </td>                                                -->
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-default" id="formats" style="color:green;">
                                                        <i class="fa fa-book" aria-hidden="true"></i>
                                                    </a>
                                                </td>                                                                                                                                                
                                                <td class="text-center">
                                                    <?php echo $row[sai_codigo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo paraTodos::convertDate($row[sai_fecreg]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_descripcion];?>
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
                                                    <?php echo $row[Nombre];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo paraTodos::convertDate($row[sai_fecnac]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_correo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[sai_telefono];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[tip_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[st_descripcion];?>
                                                </td>
                                                <td class="text-center" id="td_status_<?php echo $row[sai_codigo];?>">
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
                                                                codigo 	: <?php echo $row[sai_codigo];?>,
                                                                ver 	: 2,
                                                                act     : 10,
                                                                actd    : 1,
                                                                status    : $('#status').val()
                                                                },
                                                                success : function (html) {
                                                                    $('#td_status_<?php echo $row[sai_codigo];?>').addClass('bg-green');
                                                                },
                                                                }); return false;">
                                                        <?php
                                                            combos::CombosSelect("1", "$row[sai_status]", "*", "tools_status", "st_codigo", "st_descripcion", "1=1");
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
                        $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Clientes registrados</h4></div>');
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
