@extends('Tramite.base')
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')

			<div class="page-content">
				<div class="chat-wrapper">
					<div class="chat-sidebar">
						<div class="chat-sidebar-header">
							<div class="d-flex align-items-center">
								<div class="chat-user-online">
									<img src="../img/persona.png" width="45" height="45" class="rounded-circle" alt="" />
								</div>
								<div class="flex-grow-1 ms-2">
									<p class="mb-0">Wilson Garcia</p>
								</div>
								<div class="dropdown">
									<div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded'></i>
									</div>
									<div class="dropdown-menu dropdown-menu-end"> <a class="dropdown-item" href="javascript:;">Settings</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Help & Feedback</a>
										<a class="dropdown-item" href="javascript:;">Enable Split View Mode</a>
										<a class="dropdown-item" href="javascript:;">Keyboard Shortcuts</a>
										<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Sign Out</a>
									</div>
								</div>
							</div>
							<div class="mb-3"></div>
							<div class="input-group input-group-sm"> <span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
								<input type="text" class="form-control" placeholder="Buscar Mensaje"> <span class="input-group-text bg-transparent"><i class='bx bx-dialpad'></i></span>
							</div>
							<div class="chat-tab-menu mt-3">
								<ul class="nav nav-pills nav-justified">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-conversation'></i>
											</div>
											<div><small>Chats</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-phone'></i>
											</div>
											<div><small>Calls</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bxs-contact'></i>
											</div>
											<div><small>Contacts</small>
											</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="pill" href="javascript:;">
											<div class="font-24"><i class='bx bx-bell'></i>
											</div>
											<div><small>Notifications</small>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="chat-sidebar-content">
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-Chats">
									<div class="p-3">
										<div class="meeting-button d-flex justify-content-between">
											
											<div class="dropdown"> <a href="#" class="btn btn-white btn-sm radius-30 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" data-display="static"><i class='bx bxs-edit me-2'></i>New Chat<i class='bx bxs-chevron-down ms-2'></i></a>
												<div class="dropdown-menu dropdown-menu-right">	<a class="dropdown-item" href="#">New Group Chat</a>
													<a class="dropdown-item" href="#">Nuevo chat Grupal</a>
													<a class="dropdown-item" href="#">Nuevo Chat</a>
												</div>
											</div>
										</div>
										
									</div>
									<div class="chat-list">
										<div class="list-group list-group-flush">
											<a href="javascript:;" class="list-group-item">
												<div class="d-flex">
													<div class="chat-user-online">
														<img src="assets/images/avatars/avatar-2.png" width="42" height="42" class="rounded-circle" alt="" />
													</div>
													<div class="flex-grow-1 ms-2">
														<h6 class="mb-0 chat-title">Harvey Inspector</h6>
														<p class="mb-0 chat-msg">Sobre el proyecto de Compromiso

.</p>
													</div>
													<div class="chat-time">9:51 AM</div>
												</div>
											</a>
											
											
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="chat-header d-flex align-items-center">
						<div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
						</div>
						<div>
							<h4 class="mb-1 font-weight-bold">Harvey Inspector</h4>
							<div class="list-inline d-sm-flex mb-0 d-none"> <a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><small class='bx bxs-circle me-1 chart-online'></small>En Linea</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-images me-1'></i>Documentos</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary">|</a>
								<a href="javascript:;" class="list-inline-item d-flex align-items-center text-secondary"><i class='bx bx-search me-1'></i>Buscar</a>
							</div>
						</div>
						<div class="chat-top-header-menu ms-auto"> <a href="javascript:;"><i class='bx bx-video'></i></a>
							<a href="javascript:;"><i class='bx bx-phone'></i></a>
							<a href="javascript:;"><i class='bx bx-user-plus'></i></a>
						</div>
					</div>
					<div class="chat-content">
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="../img/persona.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 2:35 PM</p>
									<p class="chat-left-msg">Hola Wilson Garcia</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex ms-auto">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 2:37 PM</p>
									<p class="chat-right-msg">Hola</p>
								</div>
							</div>
						</div>
						<div class="chat-content-leftside">
							<div class="d-flex">
								<img src="assets/images/avatars/avatar-3.png" width="48" height="48" class="rounded-circle" alt="" />
								<div class="flex-grow-1 ms-2">
									<p class="mb-0 chat-time">Harvey, 2:48 PM</p>
									<p class="chat-left-msg">Sobre el proyecto de Compromiso</p>
								</div>
							</div>
						</div>
						<div class="chat-content-rightside">
							<div class="d-flex">
								<div class="flex-grow-1 me-2">
									<p class="mb-0 chat-time text-end">you, 2:49 PM</p>
									<p class="chat-right-msg">digame</p>
								</div>
							</div>
						</div>
						
						</div>
						
						
					
						
					<div class="chat-footer d-flex align-items-center">
						<div class="flex-grow-1 pe-2">
							<div class="input-group">	<span class="input-group-text"><i class='bx bx-smile'></i></span>
								<input type="text" class="form-control" placeholder="Escribe">
							</div>
						</div>
						<div class="chat-footer-menu"> <a href="javascript:;"><i class='bx bx-file'></i></a>
							<a href="javascript:;"><i class='bx bxs-contact'></i></a>
							<a href="javascript:;"><i class='bx bx-microphone'></i></a>
							<a href="javascript:;"><i class='bx bx-dots-horizontal-rounded'></i></a>
						</div>
					</div>
					<!--start chat overlay-->
					<div class="overlay chat-toggle-btn-mobile"></div>
					<!--end chat overlay-->
				</div>
			</div>
		
		<!--end page wrapper -->
		<!--start overlay-->
	
    @endsection

</html>