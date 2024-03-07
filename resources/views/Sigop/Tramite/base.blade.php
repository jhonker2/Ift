<!doctype html>
<html lang="es">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
	<!--plugins-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet" />

	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/fullcalendar/css/main.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/css/header-colors.css')}}" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<script src="https://kit.fontawesome.com/2afebe029b.js" crossorigin="anonymous"></script>
	<input type="hidden" name="csrf-token" value="{{ csrf_token() }}" id="csrf-token">
	<title>PORTOAGUAS EP</title>

	<style>
		/* Estilos personalizados para expandir el modal */
		.wf-item {
			display: inline-block;
			/* Cambio aquí */
			position: relative;
			/* Cambio aquí */
			margin: 20px;
			/* Espacio alrededor de cada elemento */
			border: 1px solid #346789;
			border-radius: 5px;
			padding: 10px;
			background-color: #9DBEC7;
			cursor: pointer;
			/* Opcional: cambia el cursor al pasar el mouse */
		}

		#searchButton {
			background-color: transparent;
			/* Fondo transparente */
			border: none;
			/* Sin borde */
			color: #007bff;
			/* Color del ícono, ajusta según necesites */
		}

		#searchButton:hover {
			background-color: rgba(0, 123, 255, 0.1);
			/* Fondo ligeramente azul al pasar el mouse, opcional */
		}

		.table-portoaguas {
			--bs-table-color: #fff;
			--bs-table-bg: #2196F3;
			--bs-table-border-color: #2196F3;
			--bs-table-striped-bg: #2196F3;
			--bs-table-striped-color: #fff;
			--bs-table-active-bg: #1b5581;
			--bs-table-active-color: #fff;
			--bs-table-hover-bg: #215cab;
			--bs-table-hover-color: #fff;
			color: var(--bs-table-color);
			border-color: var(--bs-table-border-color);
		}

		.cont_btn {
			position: absolute;
			right: 0;
			margin-right: 17em;

		}

		.flex {
			display: flex;
		}

		.ml5 {
			margin-left: 5px;
		}

		.btn_auxliar {
			padding: 10px;
			cursor: pointer;
		}

		hr {
			border-top: 1px solid rgb(0 0 0 / 82%) !important;
		}
	</style>
	<input type="hidde" id="SESS_USER_ID" value="{{Session::get('SESSION_CEDULA')}}">
	@yield('css')
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<a href="/home">
						<h4 class="logo-text">PORTOAGUAS </h4>
					</a>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-plus'></i></div>

						<div class="menu-title">Mis Opciones</div>
					</a>
					<ul>
						<li><a href="/proceso/1/1"><i class='bx bx-radio-circle'></i>
								Nuevos</a></li>
						<li><a href="/borrador"><i class='bx bx-radio-circle'></i>
								Borrador</a></li>
					</ul>
				</li>
				<li>


				</li>
				<li class="menu-label">PROCESO</li>

				<li>
					<a href="javascript:;">
						<div class="parent-icon"><i class='bx bx-book'></i></div>
						<div class="menu-title">Administrar</div>
					</a>
					@if(session('SESSION_ROL')=="ROL_PL_SIGOP" ||session('SESSION_ROL')=="ROL_DESA" )
					<ul>
						<li>
							<a href="/fuentes">
								<i class='bx bx-radio-circle'></i>
								Configuracion de fuentes
							</a>
						</li>
						<li>
							<a href="/tipos_fuentes">
								<i class='bx bx-radio-circle'></i>
								Configuración tipos de fuentes
							</a>
						</li>
					</ul>
					@endif
				</li>
				<li>
					<a class="has-arrow" href="javascript:;">
						<div class="parent-icon"><i class="bx bx-repeat"></i>
						</div>
						<div class="menu-title">Procesos</div>
					</a>
					<ul>
						<li><a href="/proceso/1/1"><i class='bx bx-radio-circle'></i>
								Compromisos</a></li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
						<a href="avascript:;" class="btn d-flex align-items-center"><i
								class="bx bx-search"></i>Search</a>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
							<li class="nav-item dropdown dropdown-app">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
									href="javascript:;"><i class='bx bx-grid-alt'></i></a>
								<div class="dropdown-menu dropdown-menu-end p-0">
									<div class="app-container p-2 my-2">
										<div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
											<div class="col">
												<a href="https://mail.portoaguas.gob.ec/">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="{{asset('img/zimbra.png')}}" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Zimbra</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="http://intranet.portoaguas.gob.ec/">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="{{asset('img/logoc.png')}}" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Intranet</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="https://drive.portoaguas.gob.ec:8443/">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="{{ asset('assets/images/app/google-drive.png') }}"
																width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Drive</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a
													href="https://saft.portoaguas.gob.ec/sistema/login.php?emp=PORTOAGUAS">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="{{asset('img/saft.png')}}" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Saft</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="https://portal.compraspublicas.gob.ec/sercop/">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="{{asset('img/secorp.png')}}" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Secorp</p>
														</div>
													</div>
												</a>
											</div>
											<div class="col">
												<a href="http://intranet.portoaguas.gob.ec/rol">
													<div class="app-box text-center">
														<div class="app-icon">
															<img src="{{asset('img/roles.png')}}" width="30" alt="">
														</div>
														<div class="app-name">
															<p class="mb-0 mt-1">Roles</p>
														</div>
													</div>
												</a>
											</div>



										</div><!--end row-->

									</div>
								</div>
							</li>

							<li class="nav-item dropdown dropdown-large">

								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
										</a>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<div class="dropdown-menu dropdown-menu-end">
									<div class="header-message-list">
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
							href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{asset('img/persona.png')}}" class="user-img" alt="user avatar">
							<div class="user-info">


								<div class="user-info">
									<p class="user-name mb-0">{{ session('SESSION_USER', 'Usuario por defecto') }}</p>
									<p class="designattion mb-0">{{ session('SESSION_ID', 'ID por defecto') }}</p>
								</div>

							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-user fs-5"></i><span>Perfil</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-cog fs-5"></i><span>Configuracion</span></a>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
							</li>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
										class="bx bx-download fs-5"></i><span>Descargar Docs</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item d-flex align-items-center" href="/logout"><i
										class="bx bx-log-out-circle"></i><span>Cerrar Sesion</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="tareaModal" tabindex="-1" aria-labelledby="tareaModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="tareaModalLabel">TRÁMITE: 5987778</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!-- Contenido del modal -->
							<table class="table">
								<thead>
									<tr>
										<th>TAREA</th>
										<th>FECHA ASIGNACIÓN</th>
										<th>FECHA FIN</th>
										<th>USUARIO</th>
										<th>ESTADO</th>
										<th>ACCIÓN</th>
									</tr>
								</thead>
								<tbody>
									<tr class="row-highlight">
										<td>REGISTRO</td>
										<td>2017-05-19 09:24:51.0</td>
										<td>2017-05-19 09:24:53.0</td>
										<td>JHONNY CARLOS ROJAS MACIAS</td>
										<td>PROCESO</td>
										<td>
											<button class="btn btn-sm btn-primary eye-button"><i
													class="fas fa-eye"></i></button>
											<button class="btn btn-sm btn-warning"><i
													class="fas fa-unlock-alt"></i></button>
											<button class="btn btn-sm btn-success"><i
													class="fas fa-arrow-right"></i></button>
										</td>
									</tr>
									<tr class="row-standard">
										<td>FIN</td>
										<td>2017-05-19 09:24:53.0</td>
										<td>2017-05-19 09:24:53.0</td>
										<td>USUARIO SISTEMA</td>
										<td>PROCESO</td>
										<td>
											<button class="btn btn-sm btn-primary eye-button"><i
													class="fas fa-eye"></i></button>
											<button class="btn btn-sm btn-warning"><i class="fas fa-lock"></i></button>
											<button class="btn btn-sm btn-success"><i
													class="fas fa-arrow-right"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="SearchModal" tabindex="-1" role="dialog" aria-labelledby="SearchModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content" style="min-height: calc(40vh - 3.5rem);">
						<div class="modal-header gap-5">
							<div class="position-relative popup-search w-100">
								<input class="form-control form-control-lg ps-5 border border-3 border-primary"
									type="search" id="searchInput" placeholder="BUSCAR TRAMITE">
								<button id="searchButton" class="btn position-absolute end-0 top-50 translate-middle-y">
									<i class="fas fa-search"></i>
								</button>

							</div>
						</div>
					</div>
				</div>
			</div>

			<!--MODALES DE FUENTES-->

			<div class="modal fade" id="modal_r_fuente" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modal title</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<label for="input15" class="form-label">Fuente</label>
								<div class="position-relative input-icon">
									<input type="text" class="form-control" id="ip_fuente" placeholder="Fuente">
									<span class="position-absolute top-50 translate-middle-y"><i
											class="bx bx-world"></i></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" id="btn_s_fuente"
								onclick="save_fuente()">Guardar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal_e_fuente" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Editar Fuente de ingreso</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<label for="input15" class="form-label">Fuente</label>
								<div class="position-relative input-icon">
									<input type="hidden" id="ip_eidfuente">
									<input type="text" class="form-control" id="ip_efuente" placeholder="Fuente">
									<span class="position-absolute top-50 translate-middle-y"><i
											class="bx bx-world"></i></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" id="btn_s_fuente"
								onclick="save_fuente()">Guardar</button>
						</div>
					</div>
				</div>
			</div>

			<!--FIN MODALES DE FUENTES-->

			<!--MODALES DE TIPOS DE FUENTES-->

			<div class="modal fade" id="modal_r_tfuente" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Registrar tipos de tramite</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<label for="input15" class="form-label">Tipo de tramite</label>
								<div class="position-relative input-icon">
									<input type="text" class="form-control" id="ip_tipo" placeholder="Tipo de tramite">
									<span class="position-absolute top-50 translate-middle-y"><i
											class="bx bx-world"></i></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" id="btn_s_tfuente"
								onclick="save_tfuente()">Guardar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal_e_tfuente" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Editar Fuente de ingreso</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<label for="input15" class="form-label">Tipos de Fuente</label>
								<div class="position-relative input-icon">
									<input type="hidden" id="ip_eidfuente">
									<input type="text" class="form-control" id="ip_efuente" placeholder="Fuente">
									<span class="position-absolute top-50 translate-middle-y"><i
											class="bx bx-world"></i></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" id="btn_s_fuente"
								onclick="save_fuente()">Guardar</button>
						</div>
					</div>
				</div>
			</div>


			<!--MODAL TAREAS TRAMITES-->
			<div class="modal fade" id="modal_tarea_tramite" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tramite: <span id="id_tramite"></span></h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="card">
								<div class="card-body">
									<table class="table mb-0">
										<thead class="table-portoaguas">
											<tr>
												<th scope="col">#</th>
												<th scope="col">TAREA</th>
												<th scope="col">FECHA ASIGNACION</th>
												<th scope="col">FECHA FIN</th>
												<th scope="col">USUARIO</th>
												<th scope="col">ESTADO</th>
											</tr>
										</thead>
										<tbody id="body_c">


										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- MODAL REASIGNAR-->
			<div class="modal fade" id="modal_reasignar" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Reasignar Tramite</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<select class="form-select mb-3" aria-label="Default select example">
									<option selected="">Open this select menu</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
								<div class="col-md-12">
									<textarea class="form-control" id="ip_observacion_reasignar"
										placeholder="Observacion..." rows="3"></textarea>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="ip_ace_reasignar">
										<label class="form-check-label" for="ip_ace_reasignar">Estoy seguro(a) de que
											deseo
											devolver
											la tarea</label>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-primary" id="btn_s_fuente"
									onclick="save_fuente()">Guardar</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="modal_devolver" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Devolver Tarea</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<textarea class="form-control" id="ip_observacion_devolver" placeholder="Observacion..."
									rows="3"></textarea>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="ip_ace_devolver">
									<label class="form-check-label" for="ip_ace_devolver">Estoy seguro(a) de que deseo
										devolver
										la tarea</label>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							<button type="button" class="btn btn-primary" id="btn_devolver"
								onclick="devolver_tramite()">Devolver</button>
						</div>
					</div>
				</div>
			</div>

		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content2">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 cabe_control">
					<div class="breadcrumb-title pe-3">{{session('SESSION_PAGE','null')}}</div>
					<div class="ps-3 flex">
						@foreach($botones as $b)
						@if($b->tipo=='B')
						<div class="ml5 btn_auxliar" onclick="{{$b->query}}">
							<span>
								@php
								echo($b->icono);
								@endphp
							</span>
							<span>{{$b->etiqueta}}</span>
						</div>
						@endif
						@endforeach
					</div>
					@if(session('SESSION_PAGE')=='COMPROMISOS')
					<div class="cont_btn">
						@foreach($botones as $b)
						@if($b->tipo=='A')
						<button type="button" class="btn btn-primary px-5" id="btn_save_compromiso"
							onclick="{{$b->query}}">@php echo($b->icono); @endphp {{$b->etiqueta}}</button>
						@endif
						@endforeach

					</div>
					@endif

				</div>
				<div>
					@yield('content')
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
				class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2024. PORTOAGUAS EP.</p>
		</footer>
	</div>


	<!-- Modal -->

	<!-- search modal -->

	</div>

	<!-- end search modal -->
	<div class="modal fade" id="filesModal" tabindex="-1" aria-labelledby="processModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="processModalLabel">Detalles del Trámite</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Detalles del trámite -->
					<div class="container-fluid mb-3">
						<div class="row mb-2">
							<div class="col">
								<strong>Número Trámite:</strong> 2032258
							</div>
						</div>
						<div class="row mb-2">
							<div class="col">
								<strong>Cédula Responsable:</strong> 1313356782
							</div>
							<div class="col">
								<strong>Responsable:</strong> GARCIA INTRIAGO WILSON XAVIER
							</div>
						</div>
						<div class="row mb-2">
							<div class="col">
								<strong>Motivo:</strong> ALCALDIA
							</div>
						</div>
					</div>
					<!-- Lista de archivos -->
					<div class="list-group">
						<a href="#"
							class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

							<a href="http://192.168.1.21/a1.pdf" target="_blank"
								class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								SOLICITUD
								<span class="badge badge-primary badge-pill">Ver</span>
							</a>
						</a>
						<a href="#"
							class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
							MEMORANDO
							<span class="badge badge-primary badge-pill">Ver</span>
						</a>
						<a href="#"
							class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
							DOCUMENTOS SOPORTE
							<span class="badge badge-primary badge-pill">Ver</span>
						</a>
						<!-- Más elementos según sea necesario -->
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="workflowModal" tabindex="-1" aria-labelledby="workflowModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="workflowModalLabel">Flujo de Trabajo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="workflow-container" style="position: relative; width: 100%; height: 400px;">
						<div id="inicio" class="wf-item" style="position: absolute; left: 20px; top: 50%;">
							<i class="fa fa-play"></i> Inicio
						</div>
						<div id="proceso" class="wf-item" style="position: absolute; left: 40%; top: 50%;"
							onclick="openFilesModal()">
							<i class="fa fa-cogs"></i> Proceso
						</div>
						<div id="fin" class="wf-item" style="position: absolute; left: 80%; top: 50%;">
							<i class="fa fa-flag-checkered"></i> Fin
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>

	</div>

	<!-- search modal -->

	</div>



	@if(session('alerta'))
	<script>
		alert("{{ session('alerta') }}");
	</script>
	@endif

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.15.5/js/jsplumb.min.js"></script>

	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->

	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/fullcalendar/js/main.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<script>
		document.addEventListener("DOMContentLoaded", function () {
			document.getElementById("searchButton").addEventListener("click", searchTramite);
		});

		function searchTramite() {
			var inputVal = document.getElementById("searchInput").value;
			if (inputVal === "5987778") {

				// Cierra el modal de búsqueda y abre el modal de tarea
				$('#SearchModal').modal('hide');
				$('#tareaModal').modal('show');
			} else {
				alert("Número de trámite no encontrado.");
			}
		}


		function handleKeyPress(e) {
			var key = e.keyCode || e.which;
			if (key == 13) { // 13 es el código de tecla para Enter
				searchTramite();
			}
		}

	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const procesoLinks = document.querySelectorAll('.proceso-link');

			procesoLinks.forEach(link => {
				link.addEventListener('click', function () {
					const procesoId = this.getAttribute('data-proceso-id');
					guardarProcesoEnSesion(procesoId);
				});
			});

			function guardarProcesoEnSesion(procesoId) {
				fetch('/guardar-proceso-en-sesion/' + procesoId, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({
						procesoId: procesoId
					})
				})
					.then(response => response.json())
					.then(data => {
						console.log(data);
						// Aquí puedes redirigir al usuario o mostrar un mensaje
					})
					.catch(error => console.error('Error:', error));
			}
		});
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
				},
				initialView: 'dayGridMonth',
				initialDate: '2023-09-12',
				navLinks: true, // can click day/week names to navigate views
				selectable: true,
				nowIndicator: true,
				dayMaxEvents: true, // allow "more" link when too many events
				editable: true,
				selectable: true,
				businessHours: true,
				dayMaxEvents: true, // allow "more" link when too many events
				events: [{
					title: 'Compromiso',
					start: '2023-09-01',
				}, {
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2020-09-28'
				}]
			});
			calendar.render();
		});
	</script>
	<script>
		// Esta función se llamará cuando se haga clic en el div wf-item para el proceso
		function openFilesModal() {
			// Cierra el modal de flujo de trabajo si está abierto
			$('#workflowModal').modal('hide');

			// Abre el modal de archivos después de un corto retraso para permitir que se cierre el modal de flujo de trabajo
			setTimeout(function () {
				$('#filesModal').modal('show');
			}, 500); // 500 milisegundos de retraso
		}
	</script>

	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset('assets/js/index2.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ asset('assets/js/sigop.js')}}"></script>
	@yield('js')
	<!--plugins-->
	<script>



		$(document).ready(function () {
			$('#workflowModal').on('shown.bs.modal', function () {
				jsPlumb.ready(function () {
					var instance = jsPlumb.getInstance({
						Container: "workflow-container"
					});

					// Configuración básica de jsPlumb
					instance.importDefaults({
						Connector: ["Straight"],
						Anchors: ["Right", "Left"],
						Endpoint: null, // Aquí se elimina el endpoint
						PaintStyle: {
							strokeWidth: 2,
							stroke: "#567567"
						},
						Overlays: [] // Aquí se eliminan los overlays
					});

					// Crear conexiones automáticamente
					instance.connect({
						source: "inicio",
						target: "proceso"
					});
					instance.connect({
						source: "proceso",
						target: "fin"
					});
				});

			});

			// Asegúrate de que jsPlumb se reinicializa al cerrar el modal para evitar duplicados
			$('#workflowModal').on('hidden.bs.modal', function () {
				jsPlumb.deleteEveryConnection();
				jsPlumb.deleteEveryEndpoint();
			});
		});
	</script>



</body>

</html>