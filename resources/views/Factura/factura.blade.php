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
                            @if(session('SESSION_ROL') == 'ROL_FA_LECTO' || session('SESSION_ROL') == 'ROL_DESA')

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                                        </div>
                                        <div class="menu-title d-flex align-items-center">Dashboard</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href=""><i class='bx bx-shield-alt-2'></i>Estado Servidor</a></li>

                                    </ul>
                                </li>
                                @endif



                                @if(session('SESSION_ROL') == 'ROL_FA_LECTO' || session('SESSION_ROL') == 'ROL_DESA')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='bx bx-line-chart'></i>
                                        </div>
                                        <div class="menu-title d-flex align-items-center">Sondeo</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <!-- <li><a class="dropdown-item" href="javascript:void(0);" onclick="confirmarSondeo()"><i class='bx bx-pie-chart-alt'></i>Hacer Sondeo XML</a></li>-->
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="confirmarSondeosOLO()">
                                                <i class='bx bx-pie-chart-alt'></i> Hacer Sondeo (<span style="color: red;">{{ $conteo }}</span>)
                                            </a>
                                        </li>
                                        

                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick=" confrimarEstimado()"><i class='bx bx-pie-chart-alt'></i>Sondeo Estimado</a></li>

                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick=" confrimarPromedio()"><i class='bx bx-pie-chart-alt'></i>Cuenta sin Lectura</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick=" confirmarSondeo()"><i class='bx bx-pie-chart-alt'></i>Hacer Sondeo XML</a></li>

                                    </ul>


                                </li>
                                @endif




                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='bx bx-line-chart'></i></div>
                                        <div class="menu-title d-flex align-items-center">Facturas</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="facturas_reales"><i class='bx bx-receipt'></i>Facturadas</a></li>
                                        <li><a class="dropdown-item" href="facturas_datos"><i class='bx bx-file'></i>No Facturadas</a></li>
                                        <li><a class="dropdown-item" href="reporteria"><i class='bx bx-file'></i>Reporteria</a></li>

                                    </ul>
                                </li>
                                @if(session('SESSION_ROL') == 'ROL_FA_LECTO' || session('SESSION_ROL') == 'ROL_DESA')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='bx bx-monitor'></i></div> <!-- Cambia la clase bx-line-chart a bx-monitor -->
                                        <div class="menu-title d-flex align-items-center">Monitoreo</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="Sesiones"><i class='bx bx-shield-alt-2'></i>Planificacion</a></li>
                                        <li><a class="dropdown-item" href="Lecto2"><i class='bx bx-shield-alt-2'></i>Rutas</a></li>

                                        <li><a class="dropdown-item" href="Monitoreo"><i class='bx bx-shield-alt-2'></i>Monitoreo</a></li>
                                        <li><a class="dropdown-item" href="facturamonitoreo"><i class='bx bx-shield-alt-2'></i>Tiempo real</a></li>

                                    </ul>
                                </li>
                                @endif
                                @if(session('SESSION_ROL') == 'ROL_FA_LECTO' || session('SESSION_ROL') == 'ROL_DESA')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon">
                                            <!-- Cambiado a un icono de gráfico de barras -->
                                            <i class='bx bx-bar-chart-alt'></i>
                                        </div>
                                        <i class='bx bx-pie-chart-alt'></i> Hacer Sondeo (<span style="color: red;">{{ $conteo2 }}</span>)
                                        <div class="ms-auto dropy-icon">
                                            <!-- Cambiado a un icono de gráfico de área -->
                                            <i class='bx bx-area-chart'></i>
                                        </div>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <!-- Otros elementos del menú, si necesitas cambiar sus iconos, sigue el mismo patrón -->
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="MenuCompleto()">
                                                <!-- Icono de gráfico circular para 'Hacer Sondeo' -->
                                                <i class='bx bx-pie-chart'></i> Hacer Sondeo
                                            </a>
                                        </li>
                                    </ul>
                                </li>
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
                    <form action="{{ url('facturas_datos') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="numero_cuenta" placeholder="Ingrese número de cuenta" value="{{ request('numero_cuenta') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>

                </div>
                <h6 class="mb-0 text-uppercase">LECTOFACTURACION</h6>
                <hr />

                <div class="card">

                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                  
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Numero Cuenta</th>
                                        <th>Lectura</th>
                                        <th>Estado</th>
                                        <th>Cuadrillero</th>
                                        <th>XML</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $factura)
                                    <tr>
                                        <td>{{ $factura->idControlFactura }}</td>
                                        <td>{{ $factura->numero_cuenta }}</td>
                                        <td>
                                            <a href="{{ url('/api/download/' . $factura->numero_cuenta) }}" class="btn btn-primary">Descargar</a>
                                        </td>
                                        <td>{{ $factura->soapwhrite }}</td>

                                        <td>{{ $factura->id_usuario }}</td>
                                        <td>
                                            <a href="#" class="btn-ver-xml" data-xml="{{ $factura->lectura }}" data-id="{{ $factura->idControlFactura }}">Ver XML</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <dialog id="xml-dialog" class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">FACTURACION</h5>
                                                <button type="button" class="btn-close" onclick="closeDialog()"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea id="xml-text" class="form-control" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="enviar-button" class="btn btn-primary" onclick="sendLecturaToAPI()">Enviar</button>

                                            </div>
                                        </div>
                                    </dialog>


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
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end switcher-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('admin_aapp/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
        
 
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: ['excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
        
    <script>
        function confrimarEstimado() {
            mostrarDialogo("/SondeoE");
        }

        function confrimarPromedio() {
            mostrarDialogo("/SondeoP");
        }

        function mostrarDialogo(ruta) {
            Swal.fire({
                title: 'Ingrese la contraseña',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Acceder',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    if (password === "Portoaguas/*/*/*") {
                        window.location.href = ruta;
                    } else {
                        Swal.showValidationMessage('Contraseña incorrecta');
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }


        function closeDialog() {
            var dialog = document.getElementById('xml-dialog');
            if (dialog && dialog.open) {
                dialog.close();
            }
        }

        function showDialog() {
            var dialog = document.getElementById('xml-dialog');
            if (dialog) {
                dialog.showModal();
            }
        }


        function confirmarSondeo() {
            const respuesta = confirm("¿Desea realizar el sondeo?");

            if (respuesta) {
                // Si el usuario hace clic en "Sí", llama a tu API
                fetch('/api/enviarLecturas2', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Para protección CSRF en Laravel
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Aquí puedes manejar la respuesta de tu API, por ejemplo, mostrar un mensaje de éxito
                        mostrarMensaje("Sondeo realizado con éxito.");
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mostrarMensaje("Error al realizar el sondeo.");
                    });
            }


        }
        /*function confirmarSondeoNormalCuenta2() {
            Swal.fire({
                title: 'Ingrese el número de cuenta',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                preConfirm: (numeroCuenta) => {
                    if (!numeroCuenta) {
                        Swal.showValidationMessage('Por favor, ingrese el número de cuenta');
                        return;
                    }

                    // Divide el string de números de cuenta en un array
                    const numerosCuenta = numeroCuenta.split(',');

                    // Mapea cada número de cuenta a una promesa de fetch
                    const fetchPromises = numerosCuenta.map(numCuenta => {
                        const url = `/api/enviarLecturasC/${numCuenta.trim()}`;

                        return fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            return response.json();
                        })
                        .catch(error => {
                            return { error: true, numCuenta, message: error.message };
                        });
                    });

                    // Usa Promise.all para manejar todas las promesas
                    return Promise.all(fetchPromises)
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    const failedAccounts = result.value.filter(r => r.error).map(r => r.numCuenta);
                    if (failedAccounts.length > 0) {
                        Swal.fire({
                            title: 'Algunas cuentas fallaron',
                            text: 'Cuentas con error: ' + failedAccounts.join(', '),
                            icon: 'warning'
                        });
                    } else {
                        mostrarMensaje("Sondeo realizado con éxito.");
                    }
                }
            });
        }
        */
        function confirmarSondeoCuentaPromedio() {
    // Primero solicitar la ruta
    Swal.fire({
        title: 'Ingrese la ruta',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Siguiente',
        showLoaderOnConfirm: true,
        preConfirm: (ruta) => {
            if (!ruta) {
                Swal.showValidationMessage('Por favor, ingrese la ruta');
                return;
            }
            return ruta.trim();
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((resultRuta) => {
        if (resultRuta.isConfirmed && resultRuta.value) {
            const ruta = resultRuta.value;

            // Solicitar la observación
            Swal.fire({
                title: 'Ingrese la observación',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Siguiente',
                showLoaderOnConfirm: true,
                preConfirm: (observacion) => {
                    if (!observacion) {
                        Swal.showValidationMessage('Por favor, ingrese la observación');
                        return;
                    }
                    return observacion.trim();
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((resultObservacion) => {
                if (resultObservacion.isConfirmed && resultObservacion.value) {
                    const observacion = resultObservacion.value;

                    // Luego solicitar los números de cuenta
                    Swal.fire({
                        title: 'Ingrese los números de cuenta',
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Enviar',
                        showLoaderOnConfirm: true,
                        preConfirm: (numeroCuenta) => {
                            if (!numeroCuenta) {
                                Swal.showValidationMessage('Por favor, ingrese los números de cuenta');
                                return;
                            }
                            return numeroCuenta.split(',');
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((resultNumeroCuenta) => {
                        if (resultNumeroCuenta.isConfirmed && resultNumeroCuenta.value) {
                            const numerosCuenta = resultNumeroCuenta.value;

                            let i = 0;

                            // Mostrar inicialmente el contador de solicitudes
                            Swal.fire({
                                title: `Cuenta Promediada ${i + 1} de ${numerosCuenta.length}`,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                },
                                allowOutsideClick: () => !Swal.isLoading()
                            });

                            const enviarSolicitud = () => {
                                if (i < numerosCuenta.length) {
                                    const numCuenta = numerosCuenta[i].trim();
                                    const url = `/api/rutasxcuentaPromedioCuenta?ruta=${ruta}&numerocuenta=${numCuenta}&observacion=${observacion}`;

                                    fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        }
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error(response.statusText);
                                        }
                                        return response.json();
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(`Request failed: ${error}`);
                                    })
                                    .finally(() => {
                                        i++;
                                        // Actualizar el contador en la ventana existente
                                        Swal.update({
                                            title: `Cuenta Promediada ${i + 1} de ${numerosCuenta.length}`
                                        });

                                        if (i < numerosCuenta.length) {
                                            setTimeout(enviarSolicitud, 1300); // Espera 1.3 segundos antes de la siguiente solicitud
                                        } else {
                                            Swal.close(); // Cierra el Swal cuando todas las solicitudes se han completado
                                            confirmarSondeosDD(); // Llama esta función una vez que todas las solicitudes se hayan completado
                                        }
                                    });
                                }
                            };

                            enviarSolicitud(); // Inicia el proceso de envío
                        }
                    });
                }
            });
        }
    });
}


      


        function confirmarSondeonormalCuenta2() {
            Swal.fire({
                title: 'Ingrese el número de cuenta',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                showLoaderOnConfirm: true,
                preConfirm: (numeroCuenta) => {
                    if (!numeroCuenta) {
                        Swal.showValidationMessage('Por favor, ingrese el número de cuenta');
                        return;
                    }

                    // Divide el string de números de cuenta en un array
                    const numerosCuenta = numeroCuenta.split(',');

                    // Mapea cada número de cuenta a una promesa de fetch
                    const fetchPromises = numerosCuenta.map(numCuenta => {
                        const url = `/api/enviarLecturasC/${numCuenta.trim()}`;

                        return fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText);
                                }
                                return response.json();
                            });
                    });

                    // Usa Promise.all para manejar todas las promesas
                    return Promise.all(fetchPromises)
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    mostrarMensaje("Sondeo realizado con éxito.");
                }
            });
        }

        function confirmarSondeosOLO() {
            Swal.fire({
                title: 'Operación Masiva',
                text: "¿Quieres realizar el sondeo de manera masiva?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, realizar masivamente',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar indicador de carga
                    Swal.fire({
                        title: 'Procesando...',
                        text: 'Por favor, espere.',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const url = `/api/enviarLecturas`;

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        // JavaScript: Manejo de la respuesta de la API
                        .then(data => {
                            Swal.close(); // Cierra el indicador de carga
                            if (data.errores && data.errores.length > 0) {
                                let mensajeError = "Errores encontrados en los siguientes idControlFactura: " + data.errores.map(e => e.idControlFactura).join(", ");
                                Swal.fire('Error', mensajeError, 'error');
                            } else {
                                mostrarMensaje("Sondeo realizado con éxito.");
                            }
                        })
                        .catch(error => {
                            //Swal.fire('Error', `La operación falló: ${error}`, 'error');
                        });

                }
            });
        }
       // Lugar para agregar la función mostrarMensaje si es necesario.
function MenuCompleto() {
    Swal.fire('Operación Completa', 'success');


Swal.fire({
    title: '¿Quieres ejecutar Sondeo?',
    showDenyButton: true,
    confirmButtonText: 'Si',
    denyButtonText: `Sondeo Cuentas`,
}).then((result) => {
    if (result.isConfirmed) {
        confirmarSondeosDD();
    } else if (result.isDenied) {
        confirmarSondeoCuentaPromedio();
    }
});
}
        function confirmarSondeosDD() {
            Swal.fire({
                title: 'Operación Masiva',
                text: "¿Quieres realizar el sondeo de manera masiva?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, realizar masivamente',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar indicador de carga
                    Swal.fire({
                        title: 'Procesando...',
                        text: 'Por favor, espere.',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    const url = `/api/enviarLecturas3`;

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        // JavaScript: Manejo de la respuesta de la API
                        .then(data => {
                            Swal.close(); // Cierra el indicador de carga
                            if (data.errores && data.errores.length > 0) {
                               let mensajeError = "Errores encontrados en los siguientes idControlFactura: " + data.errores.map(e => e.idControlFactura).join(", ");
                                Swal.fire('Error', mensajeError, 'error');
                            } else {
                                mostrarMensaje("Sondeo realizado con éxito.");
                            }
                        })
                        .catch(error => {
                           // Swal.fire('Error', `La operación falló: ${error}`, 'error');
                        });

                }
            });
        }

        function confirmarSondeonormal() {
            const respuesta = confirm("¿Desea realizar el sondeo?");

            if (respuesta) {
                // Si el usuario hace clic en "Sí", llama a tu API
                fetch('/api/enviarLecturas', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Para protección CSRF en Laravel
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Aquí puedes manejar la respuesta de tu API, por ejemplo, mostrar un mensaje de éxito
                        mostrarMensaje("Sondeo realizado con éxito.");
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        mostrarMensaje("Error al realizar el sondeo.");
                    });
            }
        }





        function mostrarMensaje(mensaje) {
            document.getElementById("mensajeModalBody").innerText = mensaje;
            var myModal = new bootstrap.Modal(document.getElementById('mensajeModal'));
            myModal.show();
        }


        document.addEventListener("DOMContentLoaded", function() {
            const verXmlLinks = document.querySelectorAll(".btn-ver-xml");
            const dialog = document.getElementById("xml-dialog");
            const xmlTextArea = document.querySelector("#xml-text");

            verXmlLinks.forEach(function(link) {
                link.addEventListener("click", function(event) {
                    event.preventDefault();

                    // Remover la clase 'active' de todos los enlaces
                    verXmlLinks.forEach(link => link.classList.remove('active'));

                    // Agregar la clase 'active' al enlace actualmente clickeado
                    this.classList.add('active');

                    // Obtener los datos XML y mostrar el diálogo
                    const xmlData = this.getAttribute("data-xml");
                    if (xmlTextArea) {
                        xmlTextArea.value = xmlData;
                        dialog.showModal();
                    } else {
                        console.error("xmlTextArea is not defined.");
                    }
                });
            });

            // Función para cerrar el diálogo
            window.closeDialog = function() {
                if (dialog && dialog.open) {
                    dialog.close();
                }
            };

            // Función para enviar datos a la API
            window.sendLecturaToAPI = function() {
                // Obtener el enlace activo con la clase 'active'
                const activeLink = document.querySelector(".btn-ver-xml.active");
                if (!activeLink) {
                    console.error("No active link found.");
                    return;
                }

                const idControlFactura = activeLink.getAttribute("data-id");
                const xmlContent = xmlTextArea.value;
                const base64Content = btoa(unescape(encodeURIComponent(xmlContent)));

                fetch('/api/NumeroLecto', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            lectura: base64Content,
                            idControlFactura: idControlFactura
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mostrar la respuesta del servidor en el área de texto
                        xmlTextArea.value = JSON.stringify(data);
                        closeDialog();

                    })
                    .catch(error => {
                        console.error('Error:', error);
                        xmlTextArea.value = "Error al enviar la información.";
                    });
            };
        });
    </script>



    <!--app JS-->


</body>

</html>