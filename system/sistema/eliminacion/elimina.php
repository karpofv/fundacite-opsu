<?php
    if($_POST[noti]!=""){
        paraTodos::arrayUpdate("reg_notifi=1", "rsni", "reg_codigo=$_POST[noti]");
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
            <h4 class="page-title">Eliminaciones</h4> </div>
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
                                            <td class="text-center"><strong>Plantel</strong></td>
                                            <td class="text-center"><strong>Fec. Registro</strong></td>
                                            <td class="text-center"><strong>Fecha Exp.</strong></td>
                                            <td class="text-center"><strong>Cedula</strong></td>
                                            <td class="text-center"><strong>Nombre</strong></td>
                                            <td class="text-center"><strong>Apellido</strong></td>
                                            <td class="text-center"><strong>Correo</strong></td>
                                            <td class="text-center"><strong>Teléfono</strong></td>
                                            <td class="text-center"><strong>Cédula Recep.</strong></td>
                                            <td class="text-center"><strong>Nombre Recep.</strong></td>
                                            <td class="text-center"><strong>Apellido Recep.</strong></td>
                                            <td class="text-center"><strong>Estado Recep.</strong></td>
                                            <td class="text-center"><strong>Estatus</strong></td>
                                            <td class="text-center"><strong>Procesar</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulsol = paraTodos::arrayConsulta("r.reg_status,r.reg_codigo, p.plant_descripcion, r.reg_fecreg, r.reg_fechaexp, r.reg_cedula, r.reg_nombres, r.reg_apellidos, r.reg_correo, r.reg_telefono, r.reg_recepcedula, r.reg_recpnombre, r.reg_recepapellido, e.est_descripcion, s.st_descripcion", "rsni r, plantel p, tools_estados e , tools_status s", "r.reg_plancodigo=p.plant_codigo and r.reg_recepestado=e.est_codigo and reg_caso='ELIMINACION' and s.st_codigo=r.reg_status");
                                            foreach($consulsol as $row){
                                            ?>
                                            <tr>
                                                <!--<td class="text-center">
                                                    <a href="javascript:void(0)" class="btn btn-default" id="document" style="color:green;">
                                                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                                                    </a>
                                                </td>                                                -->
                                                <td class="text-center">
                                                    <a href="accion.php?ver=2&dmn=<?php echo $idMenut;?>&act=2&cod=<?php echo $row[reg_codigo];?>" class="btn btn-default" id="formats" style="color:green;" target="_blank">
                                                        <i class="fa fa-book" aria-hidden="true"></i>
                                                    </a>
                                                </td>                                                
                                                <td class="text-center">
                                                    <?php echo $row[reg_codigo];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[plant_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo paraTodos::convertDate($row[reg_fecreg]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo paraTodos::convertDate($row[reg_fechaexp]);?>
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
                                                <td class="text-center">
                                                    <?php echo $row[reg_recepcedula];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_recpnombre];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[reg_recepapellido];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[est_descripcion];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row[st_descripcion];?>
                                                </td>
                                                <td class="text-center" id="td_status_<?php echo $row[reg_codigo];?>">
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
                                                                codigo 	: <?php echo $row[reg_codigo];?>,
                                                                ver 	: 2,
                                                                act     : 10,
                                                                actd    : 1,
                                                                status    : $('#status').val()
                                                                },
                                                                success : function (html) {
                                                                    $('#td_status_<?php echo $row[reg_codigo];?>').addClass('bg-green');
                                                                },
                                                                }); return false;">
                                                        <?php
                                                            combos::CombosSelect("1", "$row[reg_status]", "*", "tools_status", "st_codigo", "st_descripcion", "1=1");
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
                        $(win.document.body).css('font-size', '8pt').prepend('<div><h4 style="text-align:center">Eliminaciones registradas por plantel</h4></div>');
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
