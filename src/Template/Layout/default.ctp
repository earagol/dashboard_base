<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Estrella';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset() ?>
        <?php echo $this->Html->meta(array('http-equiv' => "X-UA-Compatible",'content' => 'IE=edge')); ?>

        <title><?php echo $cakeDescription; ?></title>

        <?php echo $this->Html->meta('description',"Agua Purificada Estrella"); ?>
        <?php echo $this->Html->meta('viewport',"width=device-width, initial-scale=1"); ?>
        <?php echo $this->Html->meta('favicon.ico','img/images/favicon.png',['type' => 'icon']); ?>

        <?php echo $this->Html->css('normalize') ?>
        <?php echo $this->Html->css('bootstrap.min') ?>
        <?php //echo $this->Html->css('../vendors/bootstrap/css/bootstrap') ?>
        <?php echo $this->Html->css('font-awesome.min') ?>
        <?php echo $this->Html->css('themify-icons') ?>
        <?php echo $this->Html->css('pe-icon-7-filled') ?>

        <?php echo $this->Html->css('../vendors/weather/css/weather-icons') ?>
        <?php echo $this->Html->css('../vendors/calendar/fullcalendar') ?>
        


        <?php echo $this->Html->css('style') ?>
        <?php echo $this->Html->css('charts/chartist.min') ?>
        <?php echo $this->Html->css('lib/vector-map/jqvmap.min') ?>

        <?php echo $this->Html->script('vendor/jquery-2.1.4.min'); ?>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
        <?php echo $this->Html->script('popper.min'); ?>
        <?php echo $this->Html->script('plugins'); ?>
        <?php echo $this->Html->script('main'); ?>

        <?php echo $this->Html->script('lib/moment/moment') ?>
        <?php echo $this->Html->script('../vendors/tempusdominus-datepicker/tempusdominus-bootstrap-4.min') ?>
        <?php echo $this->Html->css('../vendors/tempusdominus-datepicker/tempusdominus-bootstrap-4.min') ?>

        <?php //echo $this->Html->css('lib/chosen/chosen.min') ?>
        <?php //echo $this->Html->script('lib/chosen/chosen.jquery.min') ?>


        <?php //echo $this->Html->script('vendor/jquery-1.11.3.min'); ?>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <?php  // echo $this->Html->script('../vendors/bootstrap/js/bootstrap.min') ?>
        <?php //echo $this->Html->script('lib/flot-chart/jquery.flot'); ?>
        <?php //echo $this->Html->script('lib/flot-chart/jquery.flot.pie'); ?>
        <?php //echo $this->Html->script('lib/flot-chart/jquery.flot.spline'); ?>
        <?php //echo $this->Html->script('bootstrap') ?> 
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->



        <style>
            #weatherWidget .currentDesc {
                color: #ffffff!important;
            }
            .traffic-chart { 
                min-height: 335px; 
            }
            #flotPie1  {
                height: 150px;
            } 
            #flotPie1 td {
                padding:3px;
            }
            #flotPie1 table {
                top: 20px!important;
                right: -10px!important;
            }
            .chart-container {
                display: table;
                min-width: 270px ;
                text-align: left;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            #flotLine5  {
                 height: 105px;
            } 

            #flotBarChart {
                height: 150px;
            }
            #cellPaiChart{
                height: 160px;
            }

            .card:not(.nocard) {
               min-height: 500px;
            }

           /* .card {
                min-height: 500px;
            }*/

            footer{
                margin-top: 200px;
            }

            .pagina{
                justify-content:center;
            }

            ul.pagination {
                display:block;
                /*margin-left:-0.3125rem;*/
                min-height:1.5rem
            }

            ul.pagination li {
                color:#222;
                font-size:0.875rem;
                height:1.5rem;
                margin-left:0.3125rem
            }

            ul.pagination li a,ul.pagination li button {
                border-radius:3px;
                transition:background-color 300ms ease-out;
                background:none;
                color:#999;
                display:block;
                font-size:1em;
                font-weight:normal;
                line-height:inherit;
                padding:0.0625rem 0.625rem 0.0625rem
            }

            ul.pagination li:hover a,ul.pagination li a:focus,ul.pagination li:hover button,ul.pagination li button:focus {
                background:#e6e6e6
            }

            ul.pagination li.unavailable a,ul.pagination li.unavailable button {
                cursor:default;
                color:#999
            }

            ul.pagination li.unavailable:hover a,ul.pagination li.unavailable a:focus,ul.pagination li.unavailable:hover button,ul.pagination li.unavailable button:focus {
                background:transparent
            }

            ul.pagination li.current a,ul.pagination li.current button {
                background:#008CBA;
                color:#fff;
                cursor:default;
                font-weight:bold
            }

            ul.pagination li.current a:hover,ul.pagination li.current a:focus,ul.pagination li.current button:hover,ul.pagination li.current button:focus {
                background:#008CBA
            }

            ul.pagination li {
                display:block;
                display:inline-block;
                /*float:left*/
            }

            .pagination-centered {
                text-align:center
            }

            .pagination-centered ul.pagination li {
                display:inline-block;
                float:none
            }

            ul.pagination li.active{
                background-color: #666;
                color: white;
            }
            

        </style>
    </head>

    <body>

         <!-- Left Panel --> 
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default"> 
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">

                        <li class="active">
                            <?php echo $this->Html->link(__(' <i class="menu-icon fa fa-laptop"></i>Dashboard'), ['controller'=>'dashboards','action' => 'index'],['title'=>'Dashboard','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        <li >
                            <?php echo $this->Html->link(__(' <i class="menu-icon fa fa-exchange"></i>Ventas'), ['controller'=>'Ventas','action' => 'add'],['title'=>'Ventas','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gear"></i>Parametros</a>
                            <ul class="sub-menu children dropdown-menu">
                                <!-- <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li> -->
                                <li><i class="fa fa-arrow-circle-right"></i><?php echo $this->Html->link(__('Regiones'), ['controller'=>'Regiones','action' => 'index'],['title'=>'Regiones','escape' => false]) ?></li>

                                <li><i class="fa fa-arrow-right"></i><?php echo $this->Html->link(__('Comunas'), ['controller'=>'Comunas','action' => 'index'],['title'=>'Comunas','escape' => false]) ?></li>

                                <li><i class="fa fa-bars"></i><?php echo $this->Html->link(__('Tipos Parametros'), ['controller'=>'parametrosTipos','action' => 'index'],['title'=>'Tipos Parametros','escape' => false]) ?></li>

                                <li><i class="fa fa-asterisk"></i><?php echo $this->Html->link(__('Parametros Valores'), ['controller'=>'parametrosValores','action' => 'index'],['title'=>'Parametros Valores','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-truck"></i>Productos</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-barsa-user"></i><?php echo $this->Html->link(__('Categorias'), ['controller'=>'categorias','action' => 'index'],['title'=>'Categorias','escape' => false]) ?></li>
                                <li><i class="fa fa-truck"></i><?php echo $this->Html->link(__('Productos'), ['controller'=>'Productos','action' => 'index'],['title'=>'Productos','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Usuarios</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-user"></i><?php echo $this->Html->link(__('Usuarios'), ['controller'=>'usuarios','action' => 'index'],['title'=>'Usuarios','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-male"></i>Clientes</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-caret-square-o-up"></i><?php echo $this->Html->link(__('Clasif. Clientes'), ['controller'=>'Clasificaciones','action' => 'index'],['title'=>'Clasificacion','escape' => false]) ?></li>

                                <li><i class="fa fa-th-large"></i><?php echo $this->Html->link(__('Clientes'), ['controller'=>'Clientes','action' => 'index'],['title'=>'Clientes','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-home"></i>Visitas</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-th-large"></i><?php echo $this->Html->link(__('Visitas'), ['controller'=>'visitas','action' => 'index'],['title'=>'Visitas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Visitas'), ['controller'=>'Visitas','action' => 'reporteVisitas'],['title'=>'Visitas Pendientes','escape' => false]) ?></li>

                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Ventas</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-road"></i><?php echo $this->Html->link(__('Rutas'), ['controller'=>'Rutas','action' => 'index'],['title'=>'Rutas','escape' => false]) ?></li>

                                <li><i class="fa fa-road"></i><?php echo $this->Html->link(__('Listado Ventas'), ['controller'=>'Ventas','action' => 'ventas'],['title'=>'Listado de Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-exchange"></i><?php echo $this->Html->link(__('Ventas'), ['controller'=>'Ventas','action' => 'index'],['title'=>'Ventas','escape' => false]) ?></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-inbox"></i>Reportes</a>
                            <ul class="sub-menu children dropdown-menu">

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Diario'), ['controller'=>'Ventas','action' => 'reporteDiarioVendedor'],['title'=>'Reporte Diario','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Reporte Clientes'), ['controller'=>'Ventas','action' => 'reporteClientesVentas'],['title'=>'Reporte Clientes Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Consolidado Ventas Vendedor'), ['controller'=>'Ventas','action' => 'reporteConsolidadoVentasUsuario'],['title'=>'Reporte Clientes Ventas','escape' => false]) ?></li>

                                <li><i class="fa fa-inbox"></i><?php echo $this->Html->link(__('Consolidado Ventas Rutas'), ['controller'=>'Ventas','action' => 'reporteConsolidadoRutas'],['title'=>'Reporte Rutas Ventas','escape' => false]) ?></li>
                            </ul>
                        </li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </aside><!-- /#left-panel --> 
        <!-- Left Panel -->


        <!-- Right Panel --> 
        <div id="right-panel" class="right-panel">

            <!-- Header-->
            <header id="header" class="header">  
                <div class="top-left">
                    <div class="navbar-header"> 
                        <a class="navbar-brand" href="./"><?php echo $this->Html->image('images/logo.png', ['alt' => 'Logo']); ?> </a>
                        <a class="navbar-brand hidden" href="./"><?php echo $this->Html->image('images/logo2.png', ['alt' => 'Logo']); ?></a> 
                        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a> 
                    </div> 
                </div>
                <div class="top-right"> 
                    <div class="header-menu"> 
                        <div class="header-left">
                            <!-- <button class="search-trigger"><i class="fa fa-search"></i></button>
                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                    <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                </form>
                            </div> -->

                            <!-- <div class="dropdown for-notification">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="count bg-danger">3</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="notification">
                                    <p class="red">You have 3 Notification</p>
                                    <a class="dropdown-item media" href="#">
                                        <i class="fa fa-check"></i>
                                        <p>Server #1 overloaded.</p>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <i class="fa fa-info"></i>
                                        <p>Server #2 overloaded.</p>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <i class="fa fa-warning"></i>
                                        <p>Server #3 overloaded.</p>
                                    </a>
                                </div>
                            </div> -->

                            <!-- <div class="dropdown for-message">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                    <span class="count bg-primary">4</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="message">
                                    <p class="red">You have 4 Mails</p>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><?php echo $this->Html->image('images/avatar/1.jpg',['alt' => 'avatar']); ?></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Jonathan Smith</span>
                                            <span class="time float-right">Just now</span>
                                            <p>Hello, this is an example msg</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><?php echo $this->Html->image('images/avatar/2.jpg',['alt' => 'avatar']); ?></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Jack Sanders</span>
                                            <span class="time float-right">5 minutes ago</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><?php echo $this->Html->image('images/avatar/3.jpg',['alt' => 'avatar']); ?></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Cheryl Wheeler</span>
                                            <span class="time float-right">10 minutes ago</span>
                                            <p>Hello, this is an example msg</p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item media" href="#">
                                        <span class="photo media-left"><?php echo $this->Html->image('images/avatar/4.jpg',['alt' => 'avatar']); ?></span>
                                        <div class="message media-body">
                                            <span class="name float-left">Rachel Santos</span>
                                            <span class="time float-right">15 minutes ago</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                                        </div>
                                    </a>
                                </div>
                            </div> -->
                        </div>

                        <div class="user-area dropdown float-right">

                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php //echo $this->Html->image('images/admin.jpg',['alt' => 'User Avatar','class' => 'user-avatar rounded-circle']); ?>
                                <?php echo $currentUser['full_name']; ?>
                            </a>

                            <div class="user-menu dropdown-menu">
                                <?php echo $this->Html->link('<i class="fa fa-key"></i>Cambiar clave</a>', ['controller'=>'usuarios','action'=>'cambio_clave'],['class'=>'nav-link','escape'=>false]); ?>
                                <!-- <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a> -->

                                <!-- <a class="nav-link" href="#"><i class="fa fa-bell-o"></i>Notifications <span class="count">13</span></a> -->

                                <!-- <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a> -->

                                <?php echo $this->Html->link('<i class="fa fa-power-off"></i>Salir</a>', ['controller'=>'usuarios','action'=>'logout'],['class'=>'nav-link','escape'=>false]); ?>
                            </div>
                        </div> 
                    </div>  
                </div>
            </header><!-- /header -->
            <!-- Header-->

            <?php echo $this->Flash->render() ?>
            <div class="content pb-0 center" >
               
                <?php echo $this->fetch('content') ?>

            </div> <!-- .content -->



            <div class="clearfix"></div>

           <!--  <footer class="site-footer">
                <div class="footer-inner bg-white">
                    <div class="row">
                        <div class="col-sm-6">
                            Copyright &copy; 2018 Ela Admin
                        </div>
                        <div class="col-sm-6 text-right">
                            Designed by <a href="https://colorlib.com">Colorlib</a>
                        </div>
                    </div>
                </div>
            </footer> -->

        </div><!-- /#right-panel -->

        
        

        <?php echo $this->Html->script('lib/chart-js/Chart.bundle'); ?>


        <!--Chartist Chart-->
        <?php echo $this->Html->script('lib/chartist/chartist.min'); ?>
        <?php echo $this->Html->script('lib/chartist/chartist-plugin-legend'); ?>

       

        <?php //echo $this->Html->script('../vendors/weather/js/jquery.simpleWeather.min'); ?>   
        <?php //echo $this->Html->script('../vendors/weather/js/weather-init'); ?>   

        <?php echo $this->Html->script('../vendors/calendar/fullcalendar.min'); ?>
        <?php echo $this->Html->script('../vendors/calendar/fullcalendar-init'); ?>

        <script type="text/javascript">

            (function( $ ) {
                $(".menu-item-has-children.dropdown").click();
            })(jQuery);
            
            

        </script>

  

    

    </body>
</html>
