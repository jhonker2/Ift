<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <style>
        /* Estilos personalizados aquí */
        .card {
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .status-indicator {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 15px;
            height: 15px;
            background-color: green;
            /* Verde por defecto, puedes cambiarlo dinámicamente con clases */
            border-radius: 50%;
        }

        .card-img-top {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-top: -40px;
        }

        .card-body {
            text-align: center;
        }

        .task-count {
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Estilos para el botón y el modal */
        .modal-button {
            width: 100%;
            text-align: center;
        }

        .btn-open-modal {
            width: auto;
            /* O ajusta según tus necesidades */
        }

        /* Ajusta los colores y las fuentes según el diseño */
    </style>
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

            @if(session('SESSION_ROL') == 'ROL_FA_LECTO' || session('SESSION_ROL') == 'ROL_DESA')

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
                            <a href='Lecto2'>Rutas</a>
                        </li>

                    </ul>


                </li>
                @endif	
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fas fa-desktop"></i></div>
                        <div class="menu-title">Monitoreo</div>
                    </a>
                    <ul>
                        <li>
                            <a href='Monitoreo'>Personal Campo</a>
                        </li>
                        <li>
                            <a href='http://192.168.1.15/facturamonitoreo'>Tiempo Real</a>
                        </li>
                    </ul>




                </li>
                <li>

                    <a href="facturas_datos" class="has-arrow">
                        <div class="parent-icon"><i class="fas fa-exclamation"></i></div>
                        <div class="menu-title">Critica Lectura</div>
                    </a>

                    <ul>
                        <li>
                            <a href='facturas_datos'> Critica Lectura</a>
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
                    <a class="d-flex align-items-center nav-link dropdown-toggle gap-2 dropdown-toggle-nocaret" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('admin_aapp/images/avatars/man.png')}}" class="user-img" alt="user avatar">
                        <div class="user-info">
									<p class="user-name mb-0">{{ session('SESSION_USER', 'Usuario por defecto') }}</p>
									<p class="designattion mb-0">{{ session('SESSION_ID', 'ID por defecto') }}</p>
								</div>
                    </a>

                </div>
            </div>


        </header>


       
    </div>


                 <div class="container mt-3">
					@yield('content')

					@if(isset($datosSesion))
					<ul>
						@foreach($datosSesion as $clave => $valor)
						<li><strong>{{ $clave }}:</strong> {{ is_array($valor) ? json_encode($valor) : $valor }}</li>
						@endforeach
					</ul>
					@endif
				</div>





    <!-- Bootstrap JS -->
    <script src="assets_lectura/js/bootstrap.bundle.min.js"></script>

    <!--plugins-->
    <script src="assets_lectura/js/jquery.min.js"></script>
    <script src="assets_lectura/plugins/simplebar/js/simplebar.min.js"></script>

    <script src="assets_lectura/plugins/fullcalendar/js/main.min.js"></script>


    <script src="assets_lectura/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets_lectura/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--plugins-->

    <script src="{{asset('admin_aapp/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <!--app JS-->

    @yield('js')


    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['excel','print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

</body>

</html>