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

	<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

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
                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Configuracion</span></a>
                                </li>

                                <div class="dropdown-divider mb-0"></div>

                                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
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
                                        <li><a class="dropdown-item" href="/facturas_datos"><i class='bx bx-shield-alt-2'></i>PRINCIPAL</a></li>


                                    </ul>
                                </li>
                                <li class="nav-item">
                                <div class="mb-2">
                                <input type="text" class="form-control datepicker" />
								</div>
        </li>




                                <li class="nav-item dropdown">





                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                                        <div class="parent-icon"><i class='fas fa-route'></i>
                                        </div>
                                        <div class="menu-title d-flex align-items-center">Seleccione Ruta:</div>
                                        <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                                    </a>





                                    <ul id="lista-rutas" class="dropdown-menu">
                                        <!-- Las rutas se cargarán aquí -->
                                    </ul>


                            </ul>

                            </li>

                                 <!-- <button id="btnCargarCapa" class="btn btn-primary" style="margin-right: 10px;">Estadistica</button>-->
                            <button id="btnCargarCapa2" class="btn btn-primary">Ver Planificacion Hoy</button>


                            </ul>
                        </div>

                    </div>
                </nav>
            </div>
            <div class="modal fade" id="facturasModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Estadistica</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Cedula</th>
                                            <th>Nombres</th>
                                    

                                            <th>Ejecutadas</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $usuario)

                                        <tr>
                                            <td>{{ $usuario->cedula }}</td>

                                            <td>{{ $usuario->usuario }}</td>
                                      
                                            <td>{{ $usuario->ejecutadas}}</td>
                                        </tr>

                                        @endforeach





                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="facturasModal2" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">

<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="">Planificacion Hoy</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>

                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Cantidad</th>

                            <th>Recorrido</th>
                            <th>Ciclo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos as $dato)

                        <tr>
                            <td>{{ $dato->cedula }}</td>

                            <td>{{ $dato->nombre }}</td>
                            <td>{{ $dato->cantidad}}</td>
                            <td>{{ $dato->recorrido}}</td>
                            <td>{{ $dato->ciclo}}</td>
                        </tr>

                        @endforeach





                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
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
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. PORTOAGUAS EP.</p>
        </footer>
    </div>



<!-- Scripts -->
<!-- jQuery (inclúyelo solo una vez y antes que los demás scripts) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="{{asset('admin_aapp/js/pace.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6"></script>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <script src="{{asset('admin_aapp/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_aapp/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<!-- Moment.js -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Bootstrap Bundle con Popper -->
<script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script>

<!-- SimpleBar, MetisMenu, PerfectScrollbar, y otros plugins de tu elección -->
<script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('admin_aapp/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

<!-- Vectormap -->
<script src="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('admin_aapp/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

<script>
    var dia;

    function updateDia(selectedDates, dateStr, instance) {
    dia = new Date(selectedDates[0]).getDate().toString();
    cargarDatosPorDia(dia);
}
function cargarDatosPorDia(dia) {
        
    fetch(`/api/obtenerDatosT?dia=${dia}`)
        .then(response => response.json())
        .then(datos => {
            actualizarTabla(datos);
        })
        .catch(error => console.error('Error al cargar datos:', error));
}

function actualizarTabla(datos) {
    const tabla = $('#example2').DataTable();
    tabla.clear();
    datos.forEach(dato => {
        tabla.row.add([
            dato.cedula,
            dato.nombre,
            dato.cantidad,
            dato.recorrido,
            dato.ciclo
        ]);
    });
    tabla.draw();
}

    $(".datepicker").flatpickr({
        defaultDate: new Date(),
        onChange: updateDia
    });

    $(".date-format").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        onChange: updateDia
    });

    // Set initial value of dia to the current day
    dia = new Date().getDate().toString(); // Gets the day as a string
</script>

    <script>
        $(document).ready(function () {
            $('#example2').DataTable();
        });
    </script>

    <script>
        
        $(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#example2')) {
        $('#example2').DataTable().destroy();
    }
    $('#example2').DataTable({
        lengthChange: false,
        buttons: ['excel', 'print']
    });
});


    </script>
    

    <script>
         // document.getElementById('btnCargarCapa').addEventListener('click', function() {
            // Open the modal
            //  new bootstrap.Modal(document.getElementById('facturasModal')).show();
        //  });
        document.getElementById('btnCargarCapa2').addEventListener('click', function() {
            // Open the modal
            new bootstrap.Modal(document.getElementById('facturasModal2')).show();
        });
        document.addEventListener('DOMContentLoaded', (event) => {
            const idUsuarioSesion = "{{ session('SESSION_CEDULA', '0') }}";

            // Define todas tus funciones aquí
            cargarDatosDeRutas();
            let cantSeleccionada;

            function cargarRutas() {
                // fetch('/api/rutastotales')
                fetch('/api/rutastotalesPromedio')
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
                        addPolygonLayersForRoutes(numeroRuta); // Llama a la función con el número de ruta
                    });
                });
            }



            var polygonLayerIds = []; // Mueve la declaración aquí

            function cargarDatosDeRutas() {
                fetch('/cc_x_rutasLecto2')
                    .then(response => response.json())
                    .then(bi => {
                        datosRutas = bi;
                    })
                    .catch(error => console.error('Error al cargar datos:', error));
            }


            console.log('Resultado de la búsqueda:', polygonLayerIds);
            var datosRutas = [];
            function addPolygonLayer(data) {
    const georuta = JSON.parse(data.georuta);
    const color = data.color;
    const numeroRutaStr = String(data.numero_ruta);
    const idRecorridoStr = String(data.id_recorrido);
    const layerId = idRecorridoStr;

    // Buscar el dato 'cant' correspondiente
    const rutaData = datosRutas.find(ruta =>
        String(ruta.numero_ruta) === numeroRutaStr &&
        String(ruta.ID_RECORRIDO) === idRecorridoStr
    );

    const cant = rutaData ? rutaData.cant : 'N/D';

    // Solo agregar la capa si 'cant' no es 'N/D'
    if (cant !== 'N/D') {
        // Aquí va todo el código para agregar la capa y la capa de texto
        map.addLayer({
                    'id': layerId,
                    'type': 'fill',
                    'source': {
                        'type': 'geojson',
                        'data': {
                            'type': 'Feature',
                            'properties': {
                                'id_recorrido': idRecorridoStr,
                                'numero_ruta': numeroRutaStr,
                                'cantidad': cant
                            },
                            'geometry': {
                                'type': 'Polygon',
                                'coordinates': georuta
                            }
                        },
                    },
                    'layout': {},
                    'paint': {
                        'fill-color': color,
                        'fill-opacity': 0.6
                    }
                });

                map.addLayer({
                    'id': `label-${layerId}`,
                    'type': 'symbol',
                    'source': layerId,
                    'layout': {
                        'text-field': `Recorrido: ${idRecorridoStr}\nCant: ${cant}`,
                        'text-size': 15,
                        'text-anchor': 'center',
                        'text-offset': [0, 0],
                        'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold']
                    },
                    'paint': {
                        'text-color': '#000000'
                    }
                });

        polygonLayerIds.push(layerId);
    } else {
        console.log(`Ruta omitida: Recorrido ${idRecorridoStr}, Cant: ${cant}`);
    }
}


            // Function to update the table with fetched data
            function updateCuadrillaTable(data) {
                const tableBody = document.getElementById('tablaDatos').querySelector('tbody');
                tableBody.innerHTML = '';
                data.forEach(item => {
                    let row = tableBody.insertRow();

                    // Celda para el ID del cuadrillero
                    let cellId = row.insertCell();
                    cellId.textContent = item.id_cuadrilla;


                    // Celda para el botón de eliminación
                    let cellDelete = row.insertCell();
                    cellDelete.style.textAlign = 'right'; // Alineación a la derecha

                    // Crear y agregar el botón de eliminación
                    let deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger btn-sm';
                    deleteButton.innerHTML = '<i class="fas fa-times"></i>';
                    deleteButton.onclick = function() {
                        actualizarCuadrilleros(item.recorrido, item.rutas_tabla, item.cedula);

                    };
                    cellDelete.appendChild(deleteButton);
                });
            }




            function actualizarCuadrilleros(recorrido, rutasTabla, cedula) {
                // Crear un objeto FormData
                let formData = new FormData();
                formData.append('recorrido', recorrido);

                formData.append('idRuta', rutasTabla);
                formData.append('cuadrilla', cedula);

                // Realizar la solicitud POST
                fetch('/api/update_getdato', {
                        method: 'POST',
                        body: formData // Usar formData en lugar de JSON
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Eliminado',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                        // Aquí podrías actualizar la tabla o hacer algo más tras la actualización
                    })
                    .catch(error => console.error('Error al actualizar cuadrillero:', error));
            }



            function addPolygonLayersForRoutes(numeroRuta) {
                fetch(`/api/getGrecorrido/${numeroRuta}`) // Usa la variable numeroRuta aquí
                    .then(response => response.json())
                    .then(dataArray => {
                        // Limpia las capas existentes antes de agregar nuevas
                        polygonLayerIds.forEach(id => {
                            if (map.getLayer(id)) {
                                map.removeLayer(id);
                                map.removeSource(id);
                            }
                        });
                        polygonLayerIds = []; // Limpia el arreglo de IDs

                        // Agrega las capas para la ruta seleccionada
                        dataArray.forEach(data => {
                            addPolygonLayer(data);
                        });
                    })
                    .catch(error => console.error('Error fetching route data:', error));
            }


            mapboxgl.accessToken = 'pk.eyJ1IjoicG9ydG9hZ3Vhc2VwIiwiYSI6ImNscWdvYjdzbTFjcmIycXBhd2QzdmMyd2QifQ.ydlniQ9GaHJornYg4nytog';
            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/portoaguasep/clm77uezc02mt01qbbn1jhjbt',
                center: [-80.493740, -1.038224],
                zoom: 13
            });


            map.on('load', function() {

                cargarRutas();
                addPolygonLayersForRoutes();
            });

            map.on('click', function(e) {
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
                var cantidad = feature.properties.cantidad;
                fetchCuadrillaData(numero_ruta, id_recorrido);




                // Mostrar diálogo con la información
                Swal.fire({
                    title: 'Datos de la Ruta',
                    html: `  <div style="text-align: left;">
            <strong>ID de Recorrido:</strong> <span id="idRecorrido"></span><br>
            <strong>Número Ruta:</strong> <span id="numeroRuta"></span>
        </div>
        <div id="tablaDatosContainer" style="margin-top: 20px;">
            <table id="tablaDatos" class="table">
                <thead>
                    <tr>
                        <th>Cuadrilleros en la Ruta</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Los datos se insertarán aquí -->
                </tbody>
            </table>
        </div>
                <select id="miCombo" class="form-select mt-3">
                    <option value="">Seleccione un Cuadrillero</option>
                </select>
                <div id="miTarjeta" style="display:none; margin-top: 20px;"></div>`,
                    icon: 'info',
                    customClass: {
                        popup: 'custom-swal'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Asignar Cuadrillero',
                    cancelButtonText: 'Cancelar',
                    didOpen: () => {
                        cargarCuadrilleros();
                        document.getElementById("idRecorrido").textContent = id_recorrido;
                        document.getElementById("numeroRuta").textContent = numero_ruta;

                        window.agregarCuadrillero = function() {
                            var seleccion = document.getElementById("miCombo").value;
                            var tarjeta = document.getElementById("miTarjeta");
                            if (seleccion) {
                                tarjeta.style.display = "block";
                                var nuevoCuadrillero = document.createElement("div");
                                nuevoCuadrillero.innerHTML = `<div style="border: 1px solid #ddd; padding: 10px; margin-top: 10px; position: relative;">
                                                <h4>${seleccion}</h4>
                                                <span style="cursor:pointer; color:#FF0000; font-size: 14px; position: absolute; top: 10px; right: 10px;" onclick="actualizarCuadrilleros(this)">X</span>
                                            </div>`;
                                tarjeta.appendChild(nuevoCuadrillero);
                            }
                        }

                        window.actualizarCuadrilleros = function(elem) {
                            var cuadrilleroDiv = elem.parentNode.parentNode;
                            cuadrilleroDiv.remove();
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const selectCuadrilleros = document.getElementById("miCombo");
                        const idCuadrilleroSeleccionado = selectCuadrilleros.value;
                        if (idCuadrilleroSeleccionado) {
                            ejecutarDesrutal(id_recorrido, numero_ruta, idCuadrilleroSeleccionado, cantidad);
                        } else {
                            console.error("No se seleccionó ningún cuadrillero.");
                        }
                    }
                });

                function fetchCuadrillaData(ruta, id_recorrido) {


                    fetch(`/api/get_datos_d/${ruta}/${id_recorrido}/${dia}`, {


                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                ruta: ruta,
                                id_recorrido: id_recorrido
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            updateCuadrillaTable(data);
                        })
                        .catch(error => console.error('Error fetching data:', error));
                }



                function cargarCuadrilleros() {
                    fetch('/api/getcuadrilleros')
                        .then(response => response.json())
                        .then(data => {
                            const selectCuadrilleros = document.getElementById("miCombo");
                            data.forEach(cuadrillero => {
                                let option = document.createElement("option");
                                option.value = cuadrillero.ID_USUARIO;
                                option.text = cuadrillero.NOMBRES;
                                selectCuadrilleros.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                function ejecutarDesrutal(idReco, numRuta, idCuadrilla, cantidad) {

                    console.log("Llamando a ejecutarDesrutal con:", idReco, numRuta, idCuadrilla, cantidad);

                    const datos = {
                        iruta: numRuta,
                        cantidad: cantidad,
                        irecorrido: idReco,
                        idusuario: idUsuarioSesion, // Usando la variable
                        idcuadrilla: idCuadrilla
                    };

                    console.log("Datos a enviar:", datos);

                    fetch('/api/ejecutarDesrutal', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(datos)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`Error en la respuesta del servidor: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(result => {
                            if (result.RESU === 2) {
                                Swal.fire({
                                    title: 'Éxito',
                                    text: 'Inserción exitosa',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Error en la inserción',
                                    icon: 'error',
                                    confirmButtonText: 'Cerrar'
                                });
                            }

                        })

                        .catch(error => {
                            console.error('Error al llamar a la API:', error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error al llamar a la API',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        });

                }



            });



        });
    </script>


</body>

</html>