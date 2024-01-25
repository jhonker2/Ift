@extends('Inicio.base')
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')
<!--end header -->
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">


        <br>

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Total Trabajos Ejecutados: <span id="total_ejecutadas">{{ $sumaEjecutadas
                    }}</span></div>




        </div>
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="breadcrumb-title pe-4"> Fotos Subidas: {{ $totalFotos }}</div>



        </div>
        <div class="container mt-5">

            <div class="row">
                @foreach ($usuarios as $usuario)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <div class="status-indicator bg-success"></div>
                        <!-- Indicador de estado, clase bg-success para verde -->
                        <img src="{{ asset('img/persona.png') }}" class="card-img-top mx-auto" alt="Profile">
                        <div class="card-body">
                            <h5 class="card-title">{{ $usuario->usuario }}</h5>
                            <div class="task-count"> {{ $usuario->ejecutadas }} / {{ $usuario->ejecutadas }}
                            </div> <!-- Datos dinámicos -->
                            <div class="modal-button">
                                <button type="button" class="btn btn-primary btn-open-modal" data-bs-toggle="modal"
                                    data-bs-target="#taskModal-{{ $usuario->cedula }}">
                                    Ver Cuentas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="taskModal-{{ $usuario->cedula }}" tabindex="-1"
                    aria-labelledby="modalLabel{{ $usuario->cedula }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $usuario->cedula }}">Detalles de
                                    Facturas</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th>Numero Cuenta</th>
                                                <th>Lectura</th>
                                                <th>Estado</th>

                                                <th>HORA</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($filteredData as $factura)
                                            @if ($factura->id_usuario == $usuario->cedula)
                                            <tr>
                                                <td>{{ $factura->numero_cuenta }}</td>
                                                <td>
                                                    <a href="{{ url('/api/download/' . $factura->numero_cuenta) }}"
                                                        class="btn btn-primary">Descargar</a>
                                                </td>
                                                <td>{{ $factura->soapwhrite }}</td>
                                                <td>{{ $factura->fecha_actualizacion}}</td>
                                            </tr>
                                            @endif
                                            @endforeach





                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                @endforeach
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

@endsection


</html>


@section('js')
<script>
    let total_ejecutadas;

    var refreshId = setInterval(function () {
        total_eje();
    }, 45000);

    const total_eje = () => {
        $.ajax({
            url: "/get_total_ejecutas",
            type: "GET",
            dataType: "json",
            success: function (res) {

            }
        })
    }

</script>
@endsection