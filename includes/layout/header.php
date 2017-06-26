
<div class="topbar">
    <div class="topbar-left">
        <div class="text-center"> <a href="accion.php?ver=1" class="logo"><span>OP</span>SU</a> <a href="javascript:void(0)" class="logo-sm"><span>I</span></a></div>
        <img src="../assets/images/logo.jpg" class="img-responsive">
    </div>
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown">
                        <a id="notify" href="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-bell-o"></i>
                        </a>
                        <ul class="dropdown-menu" id="ultnotify">

                        </ul>
                    </li>                    
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box">
                            <i class="mdi mdi-fullscreen"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true">
                            <i class="mdi mdi-menu"></i>
                            <span class="profile-username"> <?php echo $_SESSION['nombre_usuario'];?> <br/> <small></small> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick="$.ajax({
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
            }); return false"> Tus datos</a></li>
                            <li><a href="accion.php?org=44&salir=1"> Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="ventanaVer">
</div>
