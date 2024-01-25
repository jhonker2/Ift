<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--favicon-->
    <link rel="icon" href="{{asset('/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('admin_aapp/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('admin_aapp/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('admin_aapp/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('admin_aapp/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/icons.css')}}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('admin_aapp/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_aapp/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_aapp/css/header-colors.css')}}" />
    <title>Lectofacturacion</title>

    <style>
        #xml-dialog {
            position: fixed;
            /* Fija la posición en la pantalla */
            top: 50%;
            /* Centra el modal verticalmente */
            left: 50%;
            /* Centra el modal horizontalmente */
            transform: translate(-50%, -50%);
            /* Ajusta la posición exacta del centro */
            z-index: 1050;
            /* Asegúrate de que el z-index sea suficiente para estar por encima de otros elementos */
        }
        #example2 th, #example2 td {
        white-space: nowrap;
        max-width: 170px; /* Adjust this value based on your preference */
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #example2 th:nth-child(3), #example2 td:nth-child(3) {
        white-space: normal;
    }
    
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--start header wrapper-->
        <div class="header-wrapper">
            <!--start header -->
            <header>
                <div class="topbar d-flex align-items-center">
                    <nav class="navbar navbar-expand gap-3">
                        <div class="topbar-logo-header d-none d-lg-flex">
                            <div class="">
                                <img src="{{asset('admin_aapp/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
                            </div>
                            <div class="">
                                <h4 class="logo-text">PortoAguas</h4>
                            </div>
                        </div>
                        <div class="mobile-toggle-menu d-block d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"><i class='bx bx-menu'></i></div>
                        <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                            <a href="avascript:;" class="btn d-flex align-items-center"><i class="bx bx-search"></i>Search</a>
                        </div>
                        <div class="top-menu ms-auto">
                            <ul class="navbar-nav align-items-center gap-1">


                                <li class="nav-item dropdown dropdown-app">

                            </ul>
                        </div>
                        <div class="user-box dropdown px-3">
                            <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('admin_aapp/images/avatars/man.png')}}" class="user-img" alt="user avatar">
                                <div class="user-info">
                                    <p class="user-name mb-0">{{ session('SESSION_USER', 'Usuario por defecto') }}</p>
                                    <p class="designattion mb-0">{{ session('SESSION_ID', 'ID por defecto') }}</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center" href="Monitoreo"><i class="bx bx-user fs-5"></i><span>Configuracion</span></a>
                                </li>

                                <div class="dropdown-divider mb-0"></div>

                                <li><a class="dropdown-item d-flex align-items-center" href="loginle"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <!--end header -->
            <!--navigation-->
            <div class="primary-menu">
                <nav class="navbar navbar-expand-lg align-items-center">
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{asset('admin_aapp/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
                                </div>
                                <div class="">
                                    <h4 class="logo-text">Portoaguas</h4>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav align-items-center flex-grow-1">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                                        </div>
                                        <div class="menu-title d-flex align-items-center">Dashboard</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="facturas_datos"><i class='bx bx-shield-alt-2'></i>Regresar</a></li>

                                    </ul>
                                </li>



                                @if(session('SESSION_ROL') == 'ROL_FA_LECTO' || session('SESSION_ROL') == 'ROL_DESA')
                               
                                @endif




                              
                               
                              
                              
                            </ul>
                        </div>
                        <!-- Modal para mensajes -->

                    </div>
                </nav>
            </div>
            <!--end navigation-->
        </div>
        <!--end header wrapper-->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>


                </div>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="mb-3">
                   
                </div>
                <h6 class="mb-0 text-uppercase">LECTOFACTURACION</h6>
                <hr />

                <div class="card">

                    <div class="card-body">


                        <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered" style="width:100%">
                  
                  <thead>
                          <tr>
                              <th>CUENTA</th>
                              <th>NOMBRES COMPLETOS</th>
                              <th>CODIGO MEDIDOR</th>
                              <th>NUMERO MEDIDOR</th>
                              <th>ULTIMA LECTURA</th>
                              <th>CONSUMO PROMEDIO</th>
                              <th>NUMERO RUTA</th>
                              <th>RECORRIDO</th>
                              <th>ESTADO</th>
                          </tr>
                          <tr>
        <!-- Campos de filtro para cada columna -->
        <th><input type="text" placeholder="Buscar por cuenta" /></th>
        <th><input type="text" placeholder="Buscar por nombres" /></th>
        <th><input type="text" placeholder="Buscar por código" /></th>
        <th><input type="text" placeholder="Buscar por número" /></th>
        <th><input type="text" placeholder="Buscar por lectura" /></th>
        <th><input type="text" placeholder="Buscar por consumo" /></th>
        <th><input type="text" placeholder="Buscar por ruta" /></th>
        <th><input type="text" placeholder="Buscar por recorrido" /></th>
        <th><input type="text" placeholder="Buscar por estado" /></th>
    </tr>
                      </thead>
                      <tbody>
                          
                         

                      </tbody>
                  </table>

                            <div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mensajeModalLabel">Mensaje</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="mensajeModalBody">
                                            <!-- El mensaje se insertará aquí -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-close" onclick="closeDialog()"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
        <!-- search modal -->

        <!-- end search modal -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. PORTOAGUAS EP.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--end switcher-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
 
	
  <script>
$(document).ready(function() {
    // Inicializa la DataTable
  
    var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['excel', 'pdf', 'print'],
        columnDefs: [
            { "orderable": false, "targets": [0,1,3,4,5,6,7,8] } // Adjust column indexes as needed
        ]
    });

    table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');


    // Cargar datos en la DataTable usando Ajax
    $.ajax({
        url: '/cuentasfull', // Reemplaza con tu URL de la API
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Convierte los datos al formato adecuado para DataTables
            var formattedData = data.slice(0, 60000).map(function(item) {
                var lect = Number(item.LECT);
    if (isNaN(lect)) {
        lect = -1; // Un valor que nunca coincidirá con 0
    }
                return [
                    item.NUMERO_CUENTA,
                    item.NOMBRES,
                    item.CODIGO_MEDIDOR,
                    item.NUMERO_MEDIDOR,
                    item.ULTIMA_LECTURA,
                    item.CONSUMO_PROMEDIO,
                    item.NUMERO_RUTA,
                    item.ID_RECORRIDO,
                    lect === 0 ? "SIN LECTURA" : "RETENIDA"
                ];
            });

            // Añade los datos a la DataTable y actualízala
            table.rows.add(formattedData).draw();
        },
        error: function() {
            alert("Error al cargar los datos");
        }
    });

    // Evento de búsqueda para cada columna
    $('#example2 thead th input[type="text"]').on('keyup change', function() {
        var columnIdx = $(this).parent().index();
        var val = $.fn.dataTable.util.escapeRegex($(this).val());

        // Realiza una búsqueda exacta en esa columna específica
        table.column(columnIdx).search(val ? "^" + val + "$" : "", true, false).draw();
    });
});

</script>

    <!--app JS-->


</body>

</html>