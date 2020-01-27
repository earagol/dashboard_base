<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Estrella</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <?php echo $this->Html->css('../tema2/vendors/bootstrap/dist/css/bootstrap.min') ?>
    <?php echo $this->Html->css('../tema2/vendors/font-awesome/css/font-awesome.min') ?>
    <?php echo $this->Html->css('../tema2/vendors/themify-icons/css/themify-icons') ?>
    <?php echo $this->Html->css('../tema2/vendors/flag-icon-css/css/flag-icon.min') ?>
    <?php echo $this->Html->css('../tema2/vendors/selectFX/css/cs-skin-elastic.css') ?>
    <?php echo $this->Html->css('../tema2/vendors/jqvmap/dist/jqvmap.min') ?>

    <?php echo $this->Html->css('../tema2/assets/css/style') ?>
    



  <!--  <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

 -->

    <?php echo $this->Html->script('../tema2/vendors/jquery/dist/jquery.min'); ?>
    <?php echo $this->Html->script('../tema2/vendors/popper.js/dist/umd/popper.min'); ?>
    <?php echo $this->Html->script('../tema2/vendors/bootstrap/dist/js/bootstrap.min'); ?>
    <?php echo $this->Html->script('../tema2/assets/js/main'); ?>

    <?php //echo $this->Html->script('../tema2/vendors/chart.js/dist/Chart.bundle.min'); ?>
    <?php //echo $this->Html->script('../tema2/assets/js/dashboard'); ?>
    <?php //echo $this->Html->script('../tema2/assets/js/widgets'); ?>
    <?php //echo $this->Html->script('../tema2/vendors/jqvmap/dist/jquery.vmap.min'); ?>
    <?php //echo $this->Html->script('../tema2/vendors/jqvmap/examples/js/jquery.vmap.sampledata'); ?>
    <?php //echo $this->Html->script('../tema2/vendors/jqvmap/dist/maps/jquery.vmap.world'); ?>

    <?php echo $this->Html->script('lib/moment/moment') ?>

    <?php echo $this->Html->script('../vendors/tempusdominus-datepicker/tempusdominus-bootstrap-4.min') ?>
    <?php echo $this->Html->css('../vendors/tempusdominus-datepicker/tempusdominus-bootstrap-4.min') ?>

 

    
    

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
               <!--  <a class="navbar-brand" href="./"><?php echo $this->Html->image('images/logo.png', ['alt' => 'Logo']); ?> </a>
                <a class="navbar-brand hidden" href="./"><?php echo $this->Html->image('images/logo2.png', ['alt' => 'Logo']); ?></a>  -->

                <!--<a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>-->
            </div>
            <?php if($currentUser['role'] == 'admin'): ?>
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <?php echo $this->Html->link(__(' <i class="menu-icon fa fa-laptop"></i>Dashboard'), ['controller'=>'dashboards','action' => 'index',1],['title'=>'Dashboard','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        <li >
                            <?php echo $this->Html->link(__(' <i class="menu-icon fa fa-exchange"></i>Ventas'), ['controller'=>'Ventas','action' => 'add'],['title'=>'Ventas','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        <h3 class="menu-title">Parametros</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gear"></i>Parametros</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-road"></i><?php echo $this->Html->link(__('Rutas'), ['controller'=>'Rutas','action' => 'index'],['title'=>'Rutas','escape' => false]) ?></li>

                                <li><i class="fa fa-arrow-circle-right"></i><?php echo $this->Html->link(__('Regiones'), ['controller'=>'Regiones','action' => 'index'],['title'=>'Regiones','escape' => false]) ?></li>

                                <li><i class="fa fa-arrow-right"></i><?php echo $this->Html->link(__('Comunas'), ['controller'=>'Comunas','action' => 'index'],['title'=>'Comunas','escape' => false]) ?></li>

                                <li><i class="fa fa-bars"></i><?php echo $this->Html->link(__('Tipos Parametros'), ['controller'=>'parametrosTipos','action' => 'index'],['title'=>'Tipos Parametros','escape' => false]) ?></li>

                                <li><i class="fa fa-asterisk"></i><?php echo $this->Html->link(__('Parametros Valores'), ['controller'=>'parametrosValores','action' => 'index'],['title'=>'Parametros Valores','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Productos</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-truck"></i>Productos</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-barsa-user"></i><?php echo $this->Html->link(__('Categorias'), ['controller'=>'categorias','action' => 'index'],['title'=>'Categorias','escape' => false]) ?></li>
                                <li><i class="fa fa-truck"></i><?php echo $this->Html->link(__('Productos'), ['controller'=>'Productos','action' => 'index'],['title'=>'Productos','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Usuarios</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Usuarios</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-user"></i><?php echo $this->Html->link(__('Usuarios'), ['controller'=>'usuarios','action' => 'index'],['title'=>'Usuarios','escape' => false]) ?></li>
                                <li><i class="fa fa-user"></i><?php echo $this->Html->link(__('Cierre Operaciones'), ['controller'=>'usuarios','action' => 'cierreOperacionesDiario'],['title'=>'Usuarios','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Clientes</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-male"></i>Clientes</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-caret-square-o-up"></i><?php echo $this->Html->link(__('Clasif. Clientes'), ['controller'=>'Clasificaciones','action' => 'index'],['title'=>'Clasificacion','escape' => false]) ?></li>

                                <li><i class="fa fa-th-large"></i><?php echo $this->Html->link(__('Clientes'), ['controller'=>'Clientes','action' => 'index'],['title'=>'Clientes','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Visitas</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Visitas</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-th-large"></i><?php echo $this->Html->link(__('Visitas'), ['controller'=>'visitas','action' => 'index'],['title'=>'Visitas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Visitas'), ['controller'=>'Visitas','action' => 'reporteVisitas'],['title'=>'Visitas Pendientes','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Dif. VisitasVsVentas'), ['controller'=>'Visitas','action' => 'reporteVisitasVentasDiferentes'],['title'=>'Visitas Pendientes','escape' => false]) ?></li>

                            </ul>
                        </li>

                        <h3 class="menu-title">Ventas</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Ventas</a>
                            <ul class="sub-menu children dropdown-menu">

                                <li><i class="fa fa-road"></i><?php echo $this->Html->link(__('Listado Ventas'), ['controller'=>'Ventas','action' => 'ventas'],['title'=>'Listado de Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-exchange"></i><?php echo $this->Html->link(__('Ventas'), ['controller'=>'Ventas','action' => 'index'],['title'=>'Ventas','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Reportes</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-inbox"></i>Reportes</a>
                            <ul class="sub-menu children dropdown-menu">

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Diario'), ['controller'=>'Ventas','action' => 'reporteDiarioVendedor'],['title'=>'Reporte Diario','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Clientes'), ['controller'=>'Ventas','action' => 'reporteClientesVentas'],['title'=>'Reporte Clientes Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Embases'), ['controller'=>'Ventas','action' => 'reporteClientesEmbases'],['title'=>'Reporte Clientes Embases','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Consolidado'), ['controller'=>'Ventas','action' => 'unionDiarioVentasVendedor'],['title'=>'Reporte Consolidado','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Ventas Vendedor'), ['controller'=>'Ventas','action' => 'reporteConsolidadoVentasUsuario'],['title'=>'Reporte Clientes Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Ventas Rutas'), ['controller'=>'Ventas','action' => 'reporteConsolidadoRutas'],['title'=>'Reporte Rutas Ventas','escape' => false]) ?></li>
                                
                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Consolidado Ventas Rango'), ['controller'=>'Ventas','action' => 'reporteConsolidadoVentasRango'],['title'=>'Reporte Rutas Ventas','escape' => false]) ?></li>

                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            <?php else: ?>

                 <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <?php echo $this->Html->link(__(' <i class="menu-icon fa fa-laptop"></i>Dashboard'), ['controller'=>'dashboards','action' => 'index',1],['title'=>'Dashboard','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        <li >
                            <?php echo $this->Html->link(__(' <i class="menu-icon fa fa-exchange"></i>Ventas'), ['controller'=>'Ventas','action' => 'add'],['title'=>'Ventas','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        <h3 class="menu-title">Parametros</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gear"></i>Parametros</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-asterisk"></i><?php echo $this->Html->link(__('Parametros Valores'), ['controller'=>'parametrosValores','action' => 'index'],['title'=>'Parametros Valores','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Usuarios</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Usuarios</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-user"></i><?php echo $this->Html->link(__('Usuarios'), ['controller'=>'usuarios','action' => 'index'],['title'=>'Usuarios','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Clientes</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-male"></i>Clientes</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-th-large"></i><?php echo $this->Html->link(__('Clientes'), ['controller'=>'Clientes','action' => 'index'],['title'=>'Clientes','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Visitas</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Visitas</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-th-large"></i><?php echo $this->Html->link(__('Visitas'), ['controller'=>'visitas','action' => 'index'],['title'=>'Visitas','escape' => false]) ?></li>
                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Visitas'), ['controller'=>'Visitas','action' => 'reporteVisitas'],['title'=>'Visitas Pendientes','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Ventas</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Ventas</a>
                            <ul class="sub-menu children dropdown-menu">

                                <li><i class="fa fa-road"></i><?php echo $this->Html->link(__('Listado Ventas'), ['controller'=>'Ventas','action' => 'ventas'],['title'=>'Listado de Ventas','escape' => false]) ?></li>
                                <li><i class="fa fa-exchange"></i><?php echo $this->Html->link(__('Ventas'), ['controller'=>'Ventas','action' => 'index'],['title'=>'Ventas','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <h3 class="menu-title">Reportes</h3><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-inbox"></i>Reportes</a>
                            <ul class="sub-menu children dropdown-menu">

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Diario'), ['controller'=>'Ventas','action' => 'reporteDiarioVendedor'],['title'=>'Reporte Diario','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Clientes'), ['controller'=>'Ventas','action' => 'reporteClientesVentas'],['title'=>'Reporte Clientes Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Embases'), ['controller'=>'Ventas','action' => 'reporteClientesEmbases'],['title'=>'Reporte Clientes Embases','escape' => false]) ?></li>

                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->

            <?php endif; ?>
        </nav>
        <?php echo $this->element('version'); ?>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <!--<button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>-->

                        <!--<div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                            </div>
                        </div>-->

                       <!-- <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary">9</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                </span>
                            </a>
                                <a class="dropdown-item media bg-flat-color-3" href="#">
                                <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                                <span class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </span>
                            </a>
                            </div>
                        </div>-->
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php //echo $this->Html->image('images/admin.jpg',['alt' => 'User Avatar','class' => 'user-avatar rounded-circle']); ?>
                            <?php echo $currentUser['full_name']; ?>
                        </a>

                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>-->

                        <div class="user-menu dropdown-menu">

                            <?php echo $this->Html->link('<i class="fa fa-key"></i>Cambiar clave</a>', ['controller'=>'usuarios','action'=>'cambio_clave'],['class'=>'nav-link','escape'=>false]); ?>
                            <?php echo $this->Html->link('<i class="fa fa-user"></i>Editar perfil</a>', ['controller'=>'usuarios','action'=>'perfil',$currentUser['id']],['class'=>'nav-link','escape'=>false]); ?>
                             <?php echo $this->Html->link('<i class="fa fa-power-off"></i>Salir</a>', ['controller'=>'usuarios','action'=>'logout'],['class'=>'nav-link','escape'=>false]); ?>


                            <!--<a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>-->
                        </div>
                    </div>

                    <!--<div class="language-select dropdown" id="language-select">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="language">
                            <div class="dropdown-item">
                                <span class="flag-icon flag-icon-fr"></span>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-es"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-us"></i>
                            </div>
                            <div class="dropdown-item">
                                <i class="flag-icon flag-icon-it"></i>
                            </div>
                        </div>
                    </div>-->

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <?php echo $this->Flash->render() ?>
        <div class="content mt-3">
           
            <?php echo $this->fetch('content') ?>

        </div> <!-- .content -->
        
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    

    <!--
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    -->
    <script>
        (function($) {
            "use strict";

          /*  jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
            */
        })(jQuery);
    </script>

</body>

</html>
