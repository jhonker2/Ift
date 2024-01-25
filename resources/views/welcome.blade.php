
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="robots" content="follow,index" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="assets_lectura/css/app.css" />
    <title>Lectura</title>

    <meta
      name="description"
      content="Lectura de facturacin"
    />
    <meta name="keywords" content="login page css, login template, login css, login form template" />

    <link
      rel="apple-touch-icon"
      sizes="180x180"
      href="https://mazipan.github.io/login-page-css/favicon/apple-touch-icon.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="https://mazipan.github.io/login-page-css/favicon/favicon-32x32.png"
    />
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="https://mazipan.github.io/login-page-css/favicon/favicon-16x16.png"
    />
    <link rel="manifest" href="https://mazipan.github.io/login-page-css/manifest.json" />

    <meta name="msapplication-TileColor" content="#6371C5" />
    <meta name="theme-color" content="#6371C5" />
    <link rel="manifest" href="https://mazipan.github.io/login-page-css/manifest.json" />

    <link rel="stylesheet" href="../shared/normalize.css" />
    <link rel="stylesheet" href="../shared/additional.css" />
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- You don't need this script, this is my GA code -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-25065548-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-25065548-2');
    </script>
  </head>

  <body>
    <div class="content-body">
      <div class="form-wrapper">
        <form class="bg-white">
          <h1 class="text-title">Login</h1>
          <div class="field-group">
            <label class="label" for="txt-email">Ingrese su usuario</label>
            <input class="input" type="email" id="txt-email" name="email" placeholder="" />
          </div>
          <div class="field-group">
            <label class="label" for="txt-password">Ingrese su contraseña</label>
            <input class="input" type="password" id="txt-password" name="password" placeholder="" />
          </div>

          <div class="field-group">
          <input class="btn-submit" type="submit" onclick="window.location.href='/home';" value="Inicio sesion" />
          </div>
        </form>

      </div>
    </div>


  </body>
</html>