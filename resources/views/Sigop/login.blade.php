<!DOCTYPE html>
<html lang="en">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link
      rel="icon"
      href="assets('/images/favicon-32x32.png"
      type="image/png"
    />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link
      href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
      rel="stylesheet"
    />
    <link
      href="assets/plugins/metismenu/css/metisMenu.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css"
      rel="stylesheet"
    />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"
      rel="stylesheet"
    />
    <link href="assets/css/app.css" rel="stylesheet" />
    <link href="assets/css/icons.css" rel="stylesheet" />
    <link
      href="https://api.mapbox.com/mapbox-gl-js/v2.4.1/mapbox-gl.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css"
    />

    <!-- Theme Style CSS -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />

    <link rel="stylesheet" href="assets/css/dark-theme.css" />
    <link rel="stylesheet" href="assets/css/semi-dark.css" />
    <link rel="stylesheet" href="assets/css/header-colors.css" />

    <title>LectoFacturacion</title>
  </head>

  <body class="">
    <!--wrapper-->
    <div class="wrapper">
      <div class="section-authentication-cover">
        <div class="">
          <div class="row g-0">
            <div
              class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex"
            >
              <div
                class="card shadow-none bg-transparent shadow-none rounded-0 mb-0"
              >
                <div class="card-body">
                  <img src="assets/images/mesa.png" width="850" alt="" />
                </div>
              </div>
            </div>

            <div
              class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center"
            >
              <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                <div class="card-body p-sm-5">
                  <div class="">
                    <div class="mb-3 text-center">
                      <img src="assets/images/logoc.png" width="170" alt="" />
                    </div>
                    <div class="text-center mb-4">
                      <h6>Bienvenido a</h6>
                      <h5 class="">SIGOP</h5>
                    </div>

                    <div class="form-body">
                      <form id="loginForm" class="row g-3">
                        <div class="col-12">
                          <label for="inputCedula" class="form-label"
                            >Cedula</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="ip_usuario"
                            placeholder="Ingrese su cedula"
                            required
                          />
                        </div>
                        <div class="col-12">
                          <label for="inputPassword" class="form-label"
                            >Password</label
                          >
                          <div class="input-group" id="show_hide_password">
                            <input
                              type="password"
                              class="form-control border-end-0"
                              id="ip_clave"
                              placeholder="Ingrese su contrasena"
                              required
                            />
                            <a
                              href="javascript:;"
                              class="input-group-text bg-transparent"
                              ><i class="bx bx-hide"></i
                            ></a>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="d-grid">
                            <button
                              type="button"
                              id="btn_login"
                              class="btn btn-primary"
                            >
                              Iniciar Sesion
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- ... tu c�digo posterior ... -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->
        </div>
      </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script type="module" src="assets/js/app.js"></script>
    <script>
      $(document).ready(function () {
        $("#ip_clave").keypress(function (tecla) {
          if (tecla.which == 13) {
            let usuario = $("#ip_usuario").val();
            let clave = $("#ip_clave").val();
            if (usuario == "" && clave == "") {
              alert("Por favor ingrese su correo y contraseña!");
            } else if (usuario == "") {
              alert("Por favor ingrese su correo!");
            } else if (clave == "") {
              alert("Por favor ingrese su contraseña!");
            } else {
              login(usuario, clave);
            }
          }
        });
        $("#btn_login").click(function () {
          var usuario = $("#ip_usuario").val();
          var clave = $("#ip_clave").val();
          login(usuario, clave);
        });

        function login(usuario, clave) {
          $.ajax({
            type: "POST",
            url: "/loginingresar2",
            data: {
              _token: $('meta[name="csrf-token"]').attr("content"),
              usuario: usuario,
              clave: clave,
            },
            success: function (response) {
              Swal.fire({
                icon: "success",
                title: "Ingreso Correcto!",
                text: response.message,
              }).then(function () {
                debugger;
                window.location.href = response.redirectUrl; // Redirigir basado en la URL enviada por Laravel
              });
            },
            error: function (xhr) {
              var mensaje = "Error en la autenticación";
              if (xhr.status === 404) {
                mensaje = "Usuario no encontrado";
              }
              // Usar SweetAlert2 para mostrar un mensaje de error
              Swal.fire({
                icon: "error",
                title: "Error",
                text: mensaje,
              });
            },
          });
        }

        $("#show_hide_password a").on("click", function (event) {
          event.preventDefault();
          var input = $("#show_hide_password input");
          if (input.attr("type") === "password") {
            input.attr("type", "text");
            $(this).find("i").toggleClass("bx-hide bx-show");
          } else {
            input.attr("type", "password");
            $(this).find("i").toggleClass("bx-show bx-hide");
          }
        });
      });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
  </body>
</html>
