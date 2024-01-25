<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="assets_lectura/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets_lectura/plugins/fullcalendar/css/main.min.css" rel="stylesheet" />
    <link href="assets_lectura/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets_lectura/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets_lectura/css/pace.min.css" rel="stylesheet" />
    <script src="assets_lectura/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets_lectura/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets_lectura/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets_lectura/css/app.css" rel="stylesheet">
    <link href="assets_lectura/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="assets_lectura/css/dark-theme.css" />
    <link rel="stylesheet" href="assets_lectura/css/semi-dark.css" />
    <link rel="stylesheet" href="assets_lectura/css/header-colors.css" />
    <title>Portoaguas</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="assets_lectura/images/menu1.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">Portoaguas EP</h4>
                </div>
                <div class="toggle-icon ms-auto ">
                    <i class="fas fa-ellipsis-v "></i>
                </div>

            </div>

            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>

                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="menu-title">Planificar</div>
                    </a>

                    <ul>
                        <li>
                            <a href='Sesiones'>Periodos</a>
                        </li>
                        <li>
                            <a href='Ruta'>Rutas</a>
                        </li>

                    </ul>


                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fas fa-desktop"></i></div>
                        <div class="menu-title">Monitoreo</div>
                    </a>




                </li>
                <li>
                    <a href='CriticaLectura' class="has-arrow">
                        <i class="fas fa-book"></i> <i class="fas fa-exclamation"></i>
                        <div class="menu-title">Critica Lectura</div>
                    </a>


                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <i class="fas fa-chart-bar"></i>
                        <div class="menu-title">Reportes e Indicadores</div>
                    </a>

                    <ul>
                        <li>
                            <a href='Balances'> Balance</a>
                        </li>
                        <li>
                            <a href='Reportes'> Reporte</a>
                        </li>
                        <li>
                            <a href='Dashboards'> Dashboard</a>
                        </li>
                    </ul>

                </li>


            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>


            <div class="topbar d-flex align-items-center">

                <div class="dropdown ms-auto">
                    <a class="btn btn-secondary dropdown-toggle" style="color: #1976D2" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">Configuración</a>
                        <a class="dropdown-item" href="#">Cerrar sesión</a>
                    </div>
                </div>
            </div>


        </header>


        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div id="external-events">
                    <h4><i class="fas fa-sync-alt" style="color: #1976D2" id="toggle-cycles"></i> Ciclos </i></h4>
                    <div class="cycles-container">
                        <div class="fc-event cycle-1">Ciclo 122</div>
                        <div class="fc-event cycle-2">Ciclo 2</div>
                        <div class="fc-event cycle-2">Ciclo 3</div>
                        <div class="fc-event cycle-2">Ciclo 4 </div>
                        <div class="fc-event cycle-2">Ciclo 5</div>
                        <div class="fc-event cycle-2">Ciclo 6</div>
                        <div class="fc-event cycle-2">Ciclo 7</div>
                        <div class="fc-event cycle-2">Ciclo 8</div>

                        <div class="fc-event cycle-2">Ciclo 9</div>
                        <div class="fc-event cycle-2">Ciclo 10</div>
                        <div class="fc-event cycle-2">Ciclo 11</div>
                        <div class="fc-event cycle-2">Ciclo 12</div>
                        <div class="fc-event cycle-2">Ciclo 13</div>
                        <div class="fc-event cycle-2">Ciclo 14</div>
                        <div class="fc-event cycle-2">Ciclo 15</div>
                        <div class="fc-event cycle-2">Ciclo 16</div>
                        <div class="fc-event cycle-2">Ciclo 17</div>

                    </div>
                </div>

                <br>

                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Periodo de Facturacion</div>

                    <div class="ms-auto">
                        <div class="btn-group">
                            <button class="btn btn-primary sync-btn">Sync</button> <!-- Botón Sync -->

                            <span class="sync-text">Periodo de Facturación</span> <!-- Palabra Sincronizar -->
                            <label class="switch">
                                <input type="checkbox" id="mySwitch">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>





                </div>

            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Portoaguas EP 2023.</p>
        </footer>
    </div>







    <!-- Bootstrap JS -->
    <script src="assets_lectura/js/bootstrap.bundle.min.js"></script>


    <!--plugins-->
    <script src="assets_lectura/js/jquery.min.js"></script>
    <script src="assets_lectura/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/locales/es.js"></script>
    <script src="assets_lectura/plugins/fullcalendar/js/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/locales/es.js"></script>

    <script src="assets_lectura/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets_lectura/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <!--app JS-->
    <script src="assets_lectura/js/app.js"></script>
    <script src="assets_lectura/js/calendario.js"></script>



</body>

</html>