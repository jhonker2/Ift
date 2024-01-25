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
	<title>Cobranza</title>

	<style>
		#xml-dialog {
		  position: fixed; /* Fija la posición en la pantalla */
		  top: 50%; /* Centra el modal verticalmente */
		  left: 50%; /* Centra el modal horizontalmente */
		  transform: translate(-50%, -50%); /* Ajusta la posición exacta del centro */
		  z-index: 1050; /* Asegúrate de que el z-index sea suficiente para estar por encima de otros elementos */
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
									<div class="parent-icon"><i class='bx bx-line-chart'></i></div>
									<div class="menu-title d-flex align-items-center">Regresar</div>
									<div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="facturas_datos"><i class='bx bx-receipt'></i>Regresar</a></li>
					
								</ul>
							</li>
							
							
							  
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
					<form action="{{ url('facturas_reales') }}" method="get">
						<div class="input-group">
							<input type="text" class="form-control" name="numero_cuenta" placeholder="Ingrese número de cuenta" value="{{ request('numero_cuenta') }}">
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">Buscar</button>
							</div>
						</div>
					</form>
					
				</div>
				<h6 class="mb-0 text-uppercase">LECTOFACTURACION</h6>
				<hr/>
				
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
												<a href="{{ url('api/download/' . $factura->numero_cuenta) }}" class="btn btn-primary">Descargar</a>
											</td>
											<td>{{ $factura->soapwhrite }}</td>
											
											<td>
												@if(isset($factura->id_usuario))
													{{ $factura->id_usuario }}
												@else
													N/A
												@endif
											</td>
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
	
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('admin_aapp/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('admin_aapp/js/jquery.min.js')}}"></script>
	<script src="{{asset('admin_aapp/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('admin_aapp/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('admin_aapp/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('admin_aapp/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin_aapp/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script>
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
        fetch('/enviarLecturas', {
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

function confirmarSondeonormal() {
    const respuesta = confirm("¿Desea realizar el sondeo?");

    if (respuesta) {
        // Si el usuario hace clic en "Sí", llama a tu API
        fetch('/enviarLecturas', {
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


document.addEventListener("DOMContentLoaded", function () {
    const verXmlLinks = document.querySelectorAll(".btn-ver-xml");
    const dialog = document.getElementById("xml-dialog");
    const xmlTextArea = document.querySelector("#xml-text");

    verXmlLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
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
    window.closeDialog = function () {
        if (dialog && dialog.open) {
            dialog.close();
        }
    };

    // Función para enviar datos a la API
    window.sendLecturaToAPI = function () {
        // Obtener el enlace activo con la clase 'active'
        const activeLink = document.querySelector(".btn-ver-xml.active");
        if (!activeLink) {
            console.error("No active link found.");
            return;
        }

        const idControlFactura = activeLink.getAttribute("data-id");
        const xmlContent = xmlTextArea.value;
        const base64Content = btoa(unescape(encodeURIComponent(xmlContent)));

        fetch('/NumeroLecto', {
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
        })
        .catch(error => {
            console.error('Error:', error);
            xmlTextArea.value = "Error al enviar la información.";
        });
    };
});



	</script>
	
	
	
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
	<!--app JS-->
	<script src="{{asset('admin_aapp/js/app.js')}}"></script>
	

</body>

</html>