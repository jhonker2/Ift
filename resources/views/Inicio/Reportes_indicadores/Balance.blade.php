<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('admin_aapp/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('admin_aapp/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('admin_aapp/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{asset('admin_aapp/plugins/highcharts/css/highcharts.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


	<link href="{{asset('admin_aapp/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin_aapp/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('admin_aapp/css/app.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('admin_aapp/css/header-colors.css')}}" />
	<title>REPORTERIA AAPP</title>
	<link href='https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css' rel='stylesheet' />

    <!-- comentario -->
    
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Inicio</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img alt="image" class="img-circle"
                                                  src="{{asset('img/ico4.png')}}" />
                      </div>
                    <div class="info">
                        <a href="#" class="d-block">d </a>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Buscar">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/monitoreoAAPP/estadistica" class="nav-link active" style="background-color: #f8f9fa; margin-bottom: 10px; padding: 10px; border-radius: 5px;">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Estadistica</p>
                                    </a>
                                    <a href="/monitoreoAAPP/report" class="nav-link active" style="background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Reportes</p>
                                    </a>
                                    <a href="/monitoreoAAPP/home" class="nav-link active" style="background-color: #f8f9fa; margin-bottom: 10px; padding: 10px; border-radius: 5px;">
                                        <i class="fas fa-tv nav-icon"></i> <!-- Ícono que representa un monitor o pantalla -->
                                        <p>Monitoreo</p>
                                      </a>
                                    

                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          
                <div class="container-fluid">
                   
                   
                            <!--end row-->
                            <div class="row row-cols-1 row-cols-md-1">
                                <div class="col col-lg-8">
                                    <div class="card radius-10 shadow-none bg-transparent">
                                        <div class="card-body">
                                            <div id="map" style="width: 100%; height: 600px;"></div> <!-- Aquí es donde se mostrará el mapa -->
                                        </div>
                                    </div>
                                </div>
                               
                 
        </div>
                            
               
            
        </div>

    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    
    
<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script> 
<!--plugins-->
<script src="{{asset('admin_aapp/js/jquery.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

<script src="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- highcharts js -->
<script src="{{asset('admin_aapp/plugins/highcharts/js/highcharts.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>

<script src="{{asset('admin_aapp/js/index2.js')}}"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.js'></script>
<script type="module" src="{{asset('admin_aapp/js/app.js')}}"></script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Moment.js (necesario para algunos plugins de fecha) -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- daterangepicker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Bootstrap y plugins -->




</body>

</html>