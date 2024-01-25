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
								<img src="{{asset('admin_aapp/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">
								<div class="user-info">
									<p class="user-name mb-0">JOSE LUIS</p>
									<p class="designattion mb-0">ROL</p>
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
								  <li><a class="dropdown-item" href="https://virtual.portoaguas.gob.ec:444/pagofacil"><i class='bx bx-pie-chart-alt' ></i>Pago Facil</a></li>
								  <li><a class="dropdown-item" href=""><i class='bx bx-shield-alt-2'></i>Estado Servidor</a></li>
								  
								</ul>
							  </li>
							 
							 
							 
							 
							  <li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
									<div class="parent-icon"><i class='bx bx-line-chart'></i>
									</div>
									<div class="menu-title d-flex align-items-center">Analisis</div>
									<div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
								</a>
								
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href=""><i class='bx bx-pie-chart-alt' ></i>Analisis Pagos</a></li>
                                        
                                      </ul>
							
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
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Tabla</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"></li>
							</ol>
						</nav>
					</div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Cargar Excel</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Hacer Match</button>
                        </div>
                    </div>
                 
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">PAGOS PORTOAGUAS</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
    <tr>
        <th>idControlFactura</th>
        <th>numero_cuenta</th>
        <th>lectura</th>
        <th>estado</th>
        <th>soapwhrite</th>
    </tr>
</thead>

								
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!-- search modal -->
		<div class="modal" id="SearchModal" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
			  <div class="modal-content">
				<div class="modal-header gap-2">
				  <div class="position-relative popup-search w-100">
					<input class="form-control form-control-lg ps-5 border border-3 border-primary" type="search" placeholder="Search">
					<span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i class='bx bx-search'></i></span>
				  </div>
				  <button type="button" class="btn-close d-md-none" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					
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
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
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
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
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
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
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
	<script>
    $(document).ready(function() {
        // Fetch data from API
        $.ajax({
            url: 'http://157.100.116.41:8090/getcontrol',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Assuming data is the JSON object you provided
                var lectura = atob(data.lectura); // Decoding the base64 encoded string
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(lectura, "text/xml");
                
                // Extracting data from the XML
                var fecha = xmlDoc.getElementsByTagName("fechaLecturaActual")[0].childNodes[0].nodeValue;
                var hora = xmlDoc.getElementsByTagName("horaLecturaActual")[0].childNodes[0].nodeValue;
                var cuenta = data.numero_cuenta;
                var montoPago = xmlDoc.getElementsByTagName("consumo")[0].childNodes[0].nodeValue; // Assuming this is the montoPago
                var banco = "Unknown"; // Placeholder since the bank info isn't provided

                // Append data to the table
                $('#example tbody').append('<tr><td>' + idControlFactura + '</td><td>' + numero_cuenta + '</td><td>' + lectura + '</td><td>' + estado + '</td><td>' + soapwhrite + '</td></tr>');
                
                // Initialize DataTable
                $('#example').DataTable();
            },
            error: function(error) {
                console.log("Error fetching data:", error);
            }
        });
    });
</script>

</body>

</html>