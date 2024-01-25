<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard con Menú Lateral</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">

<style>
    .sidebar {
      width: 100px;
      background-color: black;
      border-radius: 10px;
      position: fixed;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: white;
      padding: 10px 0;
    }
    .sidebar-logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar-logo img {
      width: auto;
      height: 80px;
    }
    .nav-link {
      color: white;
      text-align: center;
      padding: 12px 0;
    }
    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .nav-item + .nav-item {
      margin-top: 18px;
    }
    .cards-container {
      margin-left: 150px;
      padding: 20px;
    }
    .card {
      margin-bottom: 20px;
    }
    /* Asegurarse que las tarjetas no se solapen con el sidebar */
    .container-fluid {
      padding-left: 150px;
    }
    .card-body h4 {
  color: #333;
  font-size: 24px;
}
.custom-card {
  border: 1px solid #ccc; /* Cambia el color del borde si lo deseas */
  background-color: #d3d1d1; /* Cambia el color de fondo si lo deseas */
}


.bottom-right-image {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 100px; /* Ajusta el tamaño según tus necesidades */
}
.container-fluid {
  padding-left: 150px;
  margin-top: 20px; /* Ajusta este valor según tus necesidades */
}


.custom-card {
  border: 1px solid #ccc;
  background-color: #edeef0; /* Un gris claro */
  margin-top: 20px; /* Para asegurar que no esté pegada a la parte superior */
}

.card-body {
  position: relative;
  padding: 1rem;
}

/* Estilo para la barra de progreso, ajusta según tus preferencias */
.progress {
  background-color: #e9ecef;
  border-radius: 0.25rem;
  overflow: hidden;
  height: 20px;
  width: 100px; /* Tamaño de la barra de progreso */
}

.progress-bar {
  background-color: #333; /* Color azul de Bootstrap */
  width: 83%; /* El porcentaje que deseas mostrar */
  transition: width 0.6s ease;
}

/* Asegúrate de tener estos estilos si aún no los tienes */
.btn-primary {
  color: #fff;
  background-color: #333;
  border-color: #ffffff;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5;
  border-radius: 0.2rem;
}

/* Para iconos más grandes */
.fa-2x {
  font-size: 2em;
}
/* Agrega estilos para la lista de trámites */
/* Estilo para las tarjetas de trámites */
/* Estilo para las tarjetas de trámites */
.task-card {
    min-width: 200px; /* Ancho mínimo para que las tarjetas sean más anchas */
    border: 1px solid #ccc;
    border-radius: 5px; /* Bordes redondeados */
    background-color: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
    gap: 5px; /* Espacio entre los elementos dentro de la tarjeta */
}

.task-card i {
    color: #555; /* O el color que prefieras */
    margin-right: 5px; /* Espacio entre el ícono y el texto */
}

/* Estilos para el botón 'Ir al Proceso' */
.btn-dark {
    background-color: #bbbbbb;
    border: none;
    color: #fff;
}

.btn-dark.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}


/* Estilos para las nuevas tarjetas de estadísticas */
.stats-card {
  text-align: center;
  background-color: #fff;
  border-radius: 10px;
  padding: 10px;
  width: 150px; /* O el ancho que prefieras */
  box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra suave para la tarjeta */
  margin: 0 10px; /* Espacio entre las tarjetas */
}

.stats-number {
  display: block;
  font-size: 2em; /* Tamaño grande para el número */
  font-weight: 700; /* Negrita para el número */
}

.stats-text {
  display: block;
  font-weight: 400; /* Fuente normal para el texto */
}
.bottom-right-image {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 200px; /* Ajusta el tamaño según tus necesidades */
  height: auto; /* Esto mantendrá la proporción de la imagen */
}


.custom-card h4 {
  margin-bottom: 0.5rem; /* Espacio después del título */
}

.custom-card p {
  font-size: 0.9rem; /* Tamaño más pequeño para el subtítulo */
}

  </style>
</head>
<body>
 
  <div class="sidebar">
    <div class="sidebar-logo">
      <img src="img/logo.png" alt="Logo">
    </div>
    <br>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-home"></i>
          </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-tasks"></i>
            </a>
          </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-bell"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-chart-bar"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-envelope"></i>
          </a>
        </li>
      
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
  </div>

  <!-- Contenedor principal para las tarjetas -->
  <div class="container-fluid">
    <div class="row">
      <!-- Primera fila de tarjetas -->
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="card h-100 custom-card">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h4 style="font-family: 'Montserrat', sans-serif; font-weight: 700;">Hola Wilson!</h4>
                <h5>Bienvenido al sistema COP</h5>
              </div>
              <div class="col-4">
                <img src="img/persona.png" alt="Imagen" class="bottom-right-image">
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <!-- Nuevas tarjetas para Tareas Terminadas y en Ejecución -->
<div class="col-lg-6 col-md-6 mb-4">
    <div class="card h-100 custom-card">
      <div class="card-body d-flex justify-content-between">
        <div class="stats-card">
            <span class="stats-number">4</span>
            <span class="stats-text">En Ejecución</span>
          </div><div class="stats-card">
          <span class="stats-number">11</span>
          <span class="stats-text">Tareas Terminadas</span>
        </div>
        
       
        <div class="stats-card">
            <span class="stats-number">0</span>
            <span class="stats-text">Anuladas</span>
          </div>
      </div>
    </div>
  </div>
  
    
     
    </div>

    <div class="row">
      <!-- Segunda fila de tarjetas -->
      <!-- Tarjeta 4 -->
<div class="col-lg-6 col-md-6 mb-4">
    <div class="card h-100 custom-card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <i class="fas fa-tasks fa-2x"></i>
        <span style="font-family: 'Montserrat', sans-serif; font-weight: 700;">Tareas Pendientes</span>

        <div class="progress" style="width: 200px;">
          <div class="progress-bar" role="progressbar" style="width: 83%;" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100">83%</div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="col-lg-6 col-md-6 mb-4">
    <div class="card h-100 custom-card">

        
      <div class="card-body d-flex justify-content-between align-items-center">
    

        <span style="font-family: 'Montserrat', sans-serif; font-weight: 700;">Siempre Pendiente a tus trámites!</span>
        <span class="text-muted" style="font-size: 30px; margin-right: 30px;"> <!-- Aumenta el tamaño y ajusta el margen -->
          <i class="far fa-clock" style="font-size: 30px;"></i> 11:23 <!-- Aumenta el tamaño del icono -->
        </span>
      </div>
    </div>
  </div>
  
  
      <!-- Tarjeta 6 -->
<!-- Tarjeta 6 -->
<!-- Tarjeta 6 -->
<div class="col-lg-6 col-md-12 mb-4">
    <div class="card h-100 custom-card">
        <div class="card-body">
            <h4 class="fw-bold mb-3">TRÁMITES EN PROCESO</h4>
            <!-- Inicio de lista de trámites como tarjetas -->
            <div class="d-flex flex-column gap-3">
                <!-- Tarjeta de trámite 1 -->
                <div class="task-card p-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt me-2"></i>
                        <span>Nombre del Trámite 1</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span>6 h 30 min</span>
                    </div>
                    <button class="btn btn-dark btn-sm">Ir al Proceso</button>
                </div>
                <!-- Repite para cada trámite -->
            </div>
            <br>
            <div class="d-flex flex-column gap-3">
                <!-- Tarjeta de trámite 1 -->
                <div class="task-card p-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt me-2"></i>
                        <span>Nombre del Trámite 1</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span>6 h 30 min</span>
                    </div>
                    <button class="btn btn-dark btn-sm">Ir al Proceso</button>
                </div>
                <!-- Repite para cada trámite -->
            </div>
            <br>
            <div class="d-flex flex-column gap-3">
                <!-- Tarjeta de trámite 1 -->
                <div class="task-card p-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt me-2"></i>
                        <span>Nombre del Trámite 1</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span>6 h 30 min</span>
                    </div>
                    <button class="btn btn-dark btn-sm">Ir al Proceso</button>
                </div>
                <!-- Repite para cada trámite -->
            </div>
            <br>
           
            <!-- Fin de lista de trámites como tarjetas -->
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6 mb-4">
    <div class="card h-100 custom-card">
        <canvas id="myLineChart"></canvas>

    </div>
  </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Tus datos reales
    const data = {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
      datasets: [{
        label: 'Actividades',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    };
  
    // Funciones personalizadas (si no las necesitas, puedes eliminarlas)
    function getLineColor(ctx) {
      // Implementa esta función si la necesitas
    }
    function alternatePointStyles(ctx) {
      // Implementa esta función si la necesitas
    }
    function makeHalfAsOpaque(ctx) {
      // Implementa esta función si la necesitas
    }
    function adjustRadiusBasedOnData(ctx) {
      // Implementa esta función si la necesitas
    }
  
    // Configuración del gráfico
    const config = {
      type: 'line',
      data: data,
      options: {
        responsive: true, // Asegúrate de que el gráfico sea responsivo
        plugins: {
          legend: {
            position: 'top', // Puedes cambiar la posición de la leyenda
          },
          title: {
            display: true,
            text: 'Tus Estadisticas' // Título del gráfico
          }
        }
      }
    };
  
    // Creación del gráfico
    new Chart(document.getElementById('myLineChart'), config);
  </script>
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
