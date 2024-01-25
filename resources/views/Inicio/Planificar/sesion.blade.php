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
    <style>
        .ciclo {
            display: inline-block;
            padding: 1px 23px;
            /* Ajusta el padding para que sea menos alto y más ancho */
            margin: 5px;
            border: 1px solid #1976D2;
            border-radius: 15px;
            /* Aumenta el border-radius para bordes más redondeados */
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: center;
            /* Asegura que el texto esté centrado horizontalmente */
            line-height: 30px;
            /* Ajusta la alineación vertical del texto */
        }

        .ciclo:hover {
            background-color: #1976D2;
            color: white;
        }
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
                            <a href="Lecto2">Rutas</a>
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
                    </ul>




                </li>
                <li>
                    <a href="facturas_datos" class="has-arrow">
                        <div class="parent-icon"><i class="fas fa-exclamation"></i></div>
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

                    <!--end breadcrumb-->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id='calendar'></div>
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
        <!-- Asegúrate de que jQuery esté cargado antes de este script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>






        <script src="assets_lectura/js/bootstrap.bundle.min.js"></script>

        <script src="assets_lectura/js/jquery.min.js"></script>
        <script src="assets_lectura/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="assets_lectura/plugins/fullcalendar/js/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/locales/es.js"></script>

        <script src="assets_lectura/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="assets_lectura/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

        <!--app JS-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Dentro de la sección <head> o justo antes de tus scripts -->
<script>
    // Establecer una variable global de JavaScript con el valor de la sesión de PHP
    var usuarioId = "{{ session('SESSION_CEDULA') }}";
</script>

<script>
            function convertirDatosACalendario(datos, anio, mes) {
                return datos.map(function(item) {
                    if (typeof mes === 'undefined' || typeof item.dia === 'undefined') {
                        console.error('Mes o día está indefinido. Mes:', mes, 'Día:', item.dia);
                        return null; // O manejar este caso de alguna otra manera
                    }

                    // Convertir mes y día a string si son números
                    var mesStr = (typeof mes === 'number') ? mes.toString() : mes;
                    var diaStr = (typeof item.dia === 'number') ? item.dia.toString() : item.dia;

                    // Formatear el mes y el día para tener dos dígitos
                    var fechaCompleta = anio + '-' + mesStr.padStart(2, '0') + '-' + diaStr.padStart(2, '0');
                    return {
                        title: 'Ciclo: ' + item.codigo_ciclofacturacion,
                        start: fechaCompleta
                    };
                }).filter(event => event !== null); // Filtrar los elementos nulos
            }

           
            var calendar; // Definición global de la variable calendar
            function enviarDatosACicloAPI(codigoCiclo, fecha) {


    $.ajax({
        url: '/api/ejecutarSP',
        method: 'POST',
        data: {
            iruta: codigoCiclo,
            fecha: fecha,
            idusuario: usuarioId
        },
        success: function(response) {
         //   console.log('Datos enviados con éxito:', response);
            if (response == 2) { // Verificar si la respuesta es exactamente 2
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Operación realizada con éxito.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(); // Recargar la página
                    }
                });
            }
        },
        error: function(error) {
  

    // Usando SweetAlert2 para mostrar el mensaje de error
    Swal.fire({
        title: 'Error',
        text: 'Ocurrió un error al enviar los datos. Por favor, inténtalo de nuevo.',
        icon: 'error',
        confirmButtonText: 'Cerrar'
    });
}

    });
}


            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    initialView: 'dayGridMonth',
                    initialDate: new Date(),//'2024-01-01',
                    navLinks: true,
                    selectable: true,
                    nowIndicator: true,
                    dayMaxEvents: true,
                    editable: true,
                    businessHours: true,
                    droppable: true,
                    drop: function(info) {
                       
                        var fechaSeleccionada = info.dateStr;
                        console.log("Ciclo: " + cicloNumero + ", Fecha: " + fechaSeleccionada);



                    },
                    select: function(info) {
            var fechaSeleccionada = info.startStr;

            Swal.fire({
                title: 'Planificacion Ingrese:',
                input: 'text',
                inputLabel: 'Código de Ruta',
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Necesitas ingresar un código de ruta!'
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    enviarDatosACicloAPI(result.value, fechaSeleccionada);
                }
            });
        },

                    datesSet: function(dateInfo) {
                        var mes = dateInfo.start.getMonth() + 1; // Meses van de 0 a 11, sumamos 1 para obtener un rango de 1 a 12
                        var anio = dateInfo.start.getFullYear();
                        actualizarCalendario(anio, mes);
                    },

                    events: []
                });
                calendar.render();


                var draggableEl = document.getElementById('external-events');
                new FullCalendar.Draggable(draggableEl, {
                    itemSelector: '.fc-event',
                    eventData: function(eventEl) {
                        return {
                            title: eventEl.innerText
                        };
                    }
                });

                const toggleButton = document.querySelector('.toggle-icon');
                const navigation = document.querySelector('.sidebar-wrapper');
                const pageWrapper = document.querySelector('.page-wrapper');
                toggleButton.addEventListener('click', function() {
                    navigation.classList.toggle('sidebar-hidden');
                    pageWrapper.classList.toggle('sidebar-collapsed');
                });

            });
          

            

            function actualizarCalendario(anio1, mes1) {
                $.ajax({
                    url: '/api/actualizarCalendario/' + anio1 + '/' + mes1,
                    method: 'POST',
                    data: {
                        anio: anio1,
                        mes: mes1
                    },
                    //data: { anio: 2023, mes: 12 },
                    success: function(data) {
                        // alert(mes1);
                        var eventos = convertirDatosACalendario(data, anio1, mes1);
                        if (calendar) {
                            calendar.removeAllEvents();
                            calendar.addEventSource(eventos);
                        } else {
                            console.error('El calendario no está definido');
                        }
                    },
                    error: function(error) {
                        console.error('Error al actualizar el calendario:', error);
                    }
                });
            }





            //Ciclo


            //Ruta





            document.getElementById('mySwitch').addEventListener('change', function() {
                if (this.checked) {
                    console.log('Switch is ON');
                    // Aquí puedes agregar más acciones para cuando el switch esté activado
                } else {
                    console.log('Switch is OFF');
                    // Aquí puedes agregar más acciones para cuando el switch esté desactivado
                }
            });
        </script>


</body>

</html>0