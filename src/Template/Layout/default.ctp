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
        <?= $this->Html->charset() ?>
        <?= $this->Html->meta(array('http-equiv' => "X-UA-Compatible",'content' => 'IE=edge')); ?>

        <title><?= $cakeDescription; ?></title>

        <?= $this->Html->meta('description',"Ela Admin - HTML5 Admin Template"); ?>
        <?= $this->Html->meta('viewport',"width=device-width, initial-scale=1"); ?>
        <?= $this->Html->meta('favicon.ico','img/images/favicon.png',['type' => 'icon']); ?>

        <?= $this->Html->css('normalize') ?>
        <?php //echo $this->Html->css('../vendors/bootstrap/css/bootstrap.min') ?>
        

        <?php echo $this->Html->css('bootstrap.min') ?>
        <?php //echo $this->Html->css('../vendors/bootstrap/css/bootstrap.min') ?>
        <?php //echo $this->Html->css('../vendors/bootstrap/css/bootstrap-theme.min') ?>
        <?= $this->Html->css('font-awesome.min') ?>
        <?= $this->Html->css('themify-icons') ?>
        <?= $this->Html->css('pe-icon-7-filled') ?>
        <?= $this->Html->css('normalize') ?>

        <?= $this->Html->css('../vendors/weather/css/weather-icons') ?>
        <?= $this->Html->css('../vendors/calendar/fullcalendar') ?>

        <?= $this->Html->css('style') ?>
        <?= $this->Html->css('charts/chartist.min') ?>
        <?= $this->Html->css('lib/vector-map/jqvmap.min') ?>

        <?php //echo $this->Html->script('vendor/jquery-2.1.4.min'); ?>
        <?php echo $this->Html->script('vendor/jquery-1.11.3.min'); ?>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
        <?php echo $this->Html->script('popper.min'); ?>
        <?php echo $this->Html->script('funciones'); ?>

        <?php  // echo $this->Html->script('../vendors/bootstrap/js/bootstrap.min') ?>
        <?= $this->Html->script('lib/moment/moment') ?>
        
        <?= $this->Html->script('../vendors/datepicker/bootstrap-datepicker') ?>
        <?php //echo $this->Html->script('../vendors/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker') ?>

        <?php echo $this->Html->script('lib/flot-chart/jquery.flot'); ?>
        <?php echo $this->Html->script('lib/flot-chart/jquery.flot.pie'); ?>
        <?php echo $this->Html->script('lib/flot-chart/jquery.flot.spline'); ?>


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

            .card {
                min-height: 500px;
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
                            <?php echo $this->Html->link(__('<i class="menu-icon fa fa-laptop"></i>Dashboard'), ['controller'=>'dashboards','action' => 'index'],['title'=>'Dashboard','escape' => false]) ?>
                            <!-- <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a> -->
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Parametros</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Rutas'), ['controller'=>'Rutas','action' => 'index'],['title'=>'Rutas','escape' => false]) ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Clasif. Clientes'), ['controller'=>'Clasificaciones','action' => 'index'],['title'=>'Clasificacion','escape' => false]) ?>
                                </li>

                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Regiones'), ['controller'=>'Regiones','action' => 'index'],['title'=>'Clasificacion','escape' => false]) ?>
                                </li>

                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Comunas'), ['controller'=>'Comunas','action' => 'index'],['title'=>'Clasificacion','escape' => false]) ?>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Productos</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Categorias'), ['controller'=>'categorias','action' => 'index'],['title'=>'Categorias','escape' => false]) ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Productos'), ['controller'=>'Productos','action' => 'index'],['title'=>'Productos','escape' => false]) ?>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Usuarios</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Usuarios'), ['controller'=>'usuarios','action' => 'index'],['title'=>'Usuarios','escape' => false]) ?>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Clientes</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Clientes'), ['controller'=>'Clientes','action' => 'index'],['title'=>'Clientes','escape' => false]) ?>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Visitas</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Visitas'), ['controller'=>'visitas','action' => 'index'],['title'=>'Visitas','escape' => false]) ?>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Ventas</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html"></a></li>
                                <li>
                                    <?php echo $this->Html->link(__('<i class="fa fa-user"></i>Ventas'), ['controller'=>'Ventas','action' => 'index'],['title'=>'Ventas','escape' => false]) ?>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Table</a></li>
                                <li><i class="fa fa-table"></i><a href="tables-data.html">Data Table</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-th"></i><a href="forms-basic.html">Basic Form</a></li>
                                <li><i class="menu-icon fa fa-th"></i><a href="forms-advanced.html">Advanced Form</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Icons</li><!-- /.menu-title -->

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font Awesome</a></li>
                                <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="widgets.html"> <i class="menu-icon ti-email"></i>Widgets </a>
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-chartjs.html">Chart JS</a></li>
                                <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-flot.html">Flot Chart</a></li>
                                <li><i class="menu-icon fa fa-pie-chart"></i><a href="charts-peity.html">Peity Chart</a></li>
                            </ul>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-map-marker"></i>Maps</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-map-o"></i><a href="maps-gmap.html">Google Maps</a></li>
                                <li><i class="menu-icon fa fa-street-view"></i><a href="maps-vector.html">Vector Maps</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Extras</li><!-- /.menu-title -->
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-sign-in"></i><a href="page-login.html">Login</a></li>
                                <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Register</a></li>
                                <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Forget Pass</a></li>
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
                            <button class="search-trigger"><i class="fa fa-search"></i></button>
                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                    <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                </form>
                            </div>

                            <div class="dropdown for-notification">
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
                            </div>

                            <div class="dropdown for-message">
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
                            </div>
                        </div>

                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $this->Html->image('images/admin.jpg',['alt' => 'User Avatar','class' => 'user-avatar rounded-circle']); ?>
                            </a>

                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a>

                                <a class="nav-link" href="#"><i class="fa fa-bell-o"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>

                                <?php echo $this->Html->link('<i class="fa fa-power-off"></i>Logout</a>', ['controller'=>'usuarios','action'=>'logout'],['class'=>'nav-link','escape'=>false]); ?>
                            </div>
                        </div> 
                    </div>  
                </div>
            </header><!-- /header -->
            <!-- Header-->

            <?= $this->Flash->render() ?>
            <div class="content pb-0">
               
                <?= $this->fetch('content') ?>

            </div> <!-- .content -->



            <div class="clearfix"></div>

            <footer class="site-footer">
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
            </footer>

        </div><!-- /#right-panel -->

        <?php echo $this->Html->script('plugins'); ?>
        <?php echo $this->Html->script('main'); ?>

        <?php echo $this->Html->script('lib/chart-js/Chart.bundle'); ?>


        <!--Chartist Chart-->
        <?php echo $this->Html->script('lib/chartist/chartist.min'); ?>
        <?php echo $this->Html->script('lib/chartist/chartist-plugin-legend'); ?>

       

        <?php //echo $this->Html->script('../vendors/weather/js/jquery.simpleWeather.min'); ?>   
        <?php //echo $this->Html->script('../vendors/weather/js/weather-init'); ?>   

        <?php echo $this->Html->script('lib/moment/moment'); ?>
        <?php echo $this->Html->script('../vendors/calendar/fullcalendar.min'); ?>
        <?php echo $this->Html->script('../vendors/calendar/fullcalendar-init'); ?>

  

    

    </body>
</html>
