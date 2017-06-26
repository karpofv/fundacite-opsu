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
            <h4 class="page-title">Desbloqueos</h4> </div>
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
                                            <td class="text-center"><strong>Fecha</strong></td>
                                            <td class="text-center"><strong>Cedula</strong></td>
                                            <td class="text-center"><strong>Nombre</strong></td>
                                            <td class="text-center"><strong>Apellido</strong></td>
                                            <td class="text-center"><strong>Correo</strong></td>
                                            <td class="text-center"><strong>Teléfono</strong></td>
                                            <td class="text-center"><strong>Consig. Ced</strong></td>
                                            <td class="text-center"><strong>Consig. Plan.</strong></td>
                                            <td class="text-center"><strong>Estatus</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $consulsol = paraTodos::arrayConsulta("*", "rsni , tools_status", "reg_status=st_codigo and reg_caso='DESBLOQUEO'");
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
                                                    <a href="javascript:void(0);"id="td_consigced<?php echo $row[reg_codigo];?>">
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
                                                    <a href="javascript:void(0);" id="td_consigplan<?php echo $row[reg_codigo];?>">
                                                        <i class="<?php echo $icono2;?>" style="color:<?php echo $color2;?>;  font-size:16px;"></i>
                                                    </a>
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
