<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('admin_aapp/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('admin_aapp/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('admin_aapp/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('admin_aapp/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/icons.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('admin_aapp/css/header-colors.css')}}" />
    <link href="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('admin_aapp/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    <link href="{{asset('admin_aapp/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('admin_aapp/css/app.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('admin_aapp/css/header-colors.css')}}" />
    <title>REPORTERIA AAPP</title>

    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />


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
                                <img src="{{asset('admin_aapp/images/logo-icon.png')}}" class="logo-icon"
                                    alt="logo icon">
                            </div>
                            <div class="">
                                <h4 class="logo-text">PortoAguas</h4>
                            </div>
                        </div>
                        <div class="mobile-toggle-menu d-block d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar"><i class='bx bx-menu'></i></div>
                        <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                            <a href="avascript:;" class="btn d-flex align-items-center"><i
                                    class="bx bx-search"></i>Search</a>
                        </div>
                        <div class="top-menu ms-auto">
                            <ul class="navbar-nav align-items-center gap-1">


                                <li class="nav-item dropdown dropdown-app">

                            </ul>
                        </div>
                        <div class="user-box dropdown px-3">
                            <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('admin_aapp/images/avatars/man.png')}}" class="user-img"
                                    alt="user avatar">
                                    <div class="user-info">
									<p class="user-name mb-0">{{ session('SESSION_USER', 'Usuario por defecto') }}</p>
									<p class="designattion mb-0">{{ session('SESSION_ID', 'ID por defecto') }}</p>
								</div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                            class="bx bx-user fs-5"></i><span>Configuracion</span></a>
                                </li>

                                <div class="dropdown-divider mb-0"></div>

                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                            class="bx bx-log-out-circle"></i><span>Logout</span></a>
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
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                        aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="">
                                    <img src="{{asset('admin_aapp/images/logo-icon.png')}}" class="logo-icon"
                                        alt="logo icon">
                                </div>
                                <div class="">
                                    <h4 class="logo-text">Portoaguas</h4>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav align-items-center flex-grow-1">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                        data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                                        </div>
                                        <div class="menu-title d-flex align-items-center">Dashboard</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/facturas_datos"><i
                                                    class='bx bx-shield-alt-2'></i>PRINCIPAL</a></li>


                                    </ul>
                                </li>




                                <li class="nav-item dropdown">





                                </li>
                              
                                  
                            </ul>

                        
                        </div>
                    </div>
                </nav>
            </div>
            <!--end navigation-->
        </div>
        <!--end header wrapper-->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <!--breadcrumb-->
            <div class="row row-cols-1 row-cols-md-1">
                <div class="col col-lg-12">
                    <div class="card radius-10 shadow-none bg-transparent">
                        <div class="card-body">
                            <div id="map" style="width: 100%; height: 900px;"></div>
                            <!-- Aquí es donde se mostrará el mapa -->
                        </div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->

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

        <!--end page wrapper -->
        <!-- search modal -->
        <!-- Modal -->
        <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="miModalLabel">Reasignacion de Ruta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Seleccione cuadrillero.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end search modal -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. PORTOAGUAS EP.</p>
        </footer>
    </div>
    <script type="module" src="{{asset('admin_aapp/js/app.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6"></script>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>




    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Define todas tus funciones aquí
            cargarDatosDeRutas();

            function cargarRutas() {
            fetch('/api/rutastotales')
      //fetch('/api/rutastotalesR')
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la respuesta del servidor: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            actualizarMenuRutas(data);
        })
        .catch(error => {
            console.error('Error al cargar rutas:', error);
            // Aquí podrías manejar el error, como mostrar un mensaje al usuario
        });
}

           


            function cargarDatosRuta(numeroRuta) {
                // Mostrar alerta de carga
                Swal.fire({
                    title: 'Cargando...',
                    html: 'Espera mientras se cargan los datos de la ruta.',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                });
                
                 // fetch(`/rutasxcuentaPromedio/${numeroRuta}`)
               fetch(`/rutasxcuenta/${numeroRuta}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Cerrar la alerta de carga
                        Swal.close();

                        // Mostrar alerta de éxito
                        Swal.fire({
                            title: 'Terminado',
                            text: 'Los datos se cargaron correctamente.',
                            icon: 'success',
                        }).then(() => {
                            // Llamar a ejecutarSondeo después de cerrar la alerta de éxito
                            ejecutarSondeo();
                        });

                     //   console.log('Datos de la ruta:', data);
                    })
                    .catch(error => {
                        console.error('Error al cargar datos de la ruta:', error);
                        Swal.fire({
                            title: 'Error',
                            text: error.message,
                            icon: 'error',
                        });
                    });
            }

            function ejecutarSondeo() {
                Swal.fire({
                    title: 'Comenzando facturación máxima...',
                    html: 'Por favor espera.',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                fetch('/api/enviarLecturas3', {
                    method: 'POST', // Asegúrate de usar el método correcto aquí
                    // Incluye cualquier encabezado o cuerpo necesario para tu solicitud
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.close();
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Sondeo se ejecutó correctamente.',
                            icon: 'success',
                        });
                    //    console.log('Respuestas de la API:', data);
                    })
                    .catch(error => {
                        console.error('Error al ejecutar sondeo:', error);
                        Swal.fire({
                            title: 'Error',
                            text: error.message,
                            icon: 'error',
                        });
                    });
            }


            function actualizarMenuRutas(rutas) {
                const menuRutas = document.querySelector('#lista-rutas');
                menuRutas.innerHTML = '';

                rutas.forEach(ruta => {
                    const rutaElement = document.createElement('li');
                    rutaElement.innerHTML = `<a class="dropdown-item" href="#" data-numero-ruta="${ruta.numero_ruta}">Ruta ${ruta.numero_ruta} (${ruta.cuentas} cuentas)</a>`;
                    menuRutas.appendChild(rutaElement);
                });

                asignarEventoRutas();
            }


            function asignarEventoRutas() {
                document.querySelectorAll('#lista-rutas .dropdown-item').forEach(item => {
                    item.addEventListener('click', event => {
                        event.preventDefault();
                        const numeroRuta = event.target.getAttribute('data-numero-ruta');
                        cargarDatosRuta(numeroRuta);
                    });
                });
            }

          
                var polygonLayerIds = []; // Mueve la declaración aquí

function cargarDatosDeRutas() {
    fetch('/cc_x_rutas')
        .then(response => response.json())
        .then(bi => {
            datosRutas = bi;
        })
        .catch(error => console.error('Error al cargar datos:', error));
}


    




            function addPolygonLayersForRoutes() {
                fetch('/api/getGrecorrido')
                    .then(response => response.json())
                    .then(dataArray => {
                        dataArray.forEach(data => {
                            addPolygonLayer(data);
                        });
                    })
                    .catch(error => console.error('Error fetching route data:', error));
            }


       

            map.on('load', function () {

                cargarRutas();
                addPolygonLayersForRoutes();
            });

            map.on('click', function (e) {
                console.log('Click event triggered');
    console.log('Clicked point coordinates:', e.point);
    console.log('Querying layers:', polygonLayerIds);
                var features = map.queryRenderedFeatures(e.point, {
                    
                    layers: polygonLayerIds
                });

                if (!features.length) {
                    return;
                }

                var feature = features[0];
                var id_recorrido = feature.properties.id_recorrido;
                var numero_ruta = feature.properties.numero_ruta;

                // Mostrar diálogo con la información
                Swal.fire({
                    title: 'Datos de la Ruta',
                    html: '<div style="text-align: left;">' +
                        '<strong>ID de Recorrido:</strong> ' + id_recorrido + '<br>' +
                        '<strong>Número Ruta:</strong> ' + numero_ruta + '</div>' +
                        '<select id="miCombo" class="form-select mt-3" onchange="agregarCuadrillero()">' +
                        '    <option value="">Seleccione un Cuadrillero</option>' +
                        '    <option value="1">Cuadrillero 1</option>' +
                        '    <option value="2">Cuadrillero 2</option>' +
                        '    <option value="3">Cuadrillero 3</option>' +
                        '    <option value="4">Cuadrillero 4</option>' +
                        '    <option value="5">Cuadrillero 5</option>' +
                        '</select>' +
                        '<div id="miTarjeta" style="display:none; margin-top: 20px;"></div>',
                    icon: 'info',
                    customClass: {
                        popup: 'custom-swal'
                    },
                    showConfirmButton: false,
                    position: 'center',
                    didOpen: () => {
                        window.agregarCuadrillero = function () {
                            var seleccion = document.getElementById("miCombo").value;
                            var tarjeta = document.getElementById("miTarjeta");
                            if (seleccion) {
                                tarjeta.style.display = "block";
                                var nuevoCuadrillero = document.createElement("div");
                                nuevoCuadrillero.innerHTML = '<div style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; position: relative;">' +
                                    '<h4>Cuadrillero ' + seleccion + '</h4>' +
                                    '<span style="cursor:pointer; color:#FF0000; font-size: 14px; position: absolute; top: 10px; right: 10px;" onclick="eliminarCuadrillero(this)">X</span>' +
                                    '</div>';
                                tarjeta.appendChild(nuevoCuadrillero);
                            }
                        }

                        window.eliminarCuadrillero = function (elem) {
                            var cuadrilleroDiv = elem.parentNode.parentNode;
                            cuadrilleroDiv.remove();
                        }
                    }
                });





            });
        });


    </script>
    <script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('admin_aapp/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

    <!-- REQUIRED SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script>
    <!--plugins-->
    <script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/metismenu/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>



    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Moment.js (necesario para algunos plugins de fecha) -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <!-- daterangepicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</body>

</html>