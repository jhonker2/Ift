@extends('Sigop.Tramite.base')
@section('css')
<style>
    .seleccion {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <hr />
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Compromisos Completados</p>
                            <h5 class="mb-0">{{$completados}}</h5>
                        </div>
                    </div>
                    <div class="" id="chart2"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Compromisos vencidos</p>
                            <h5 class="mb-0">0</h5>
                        </div>
                    </div>
                    <div class="" id="chart3"></div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Compromisos en Ejecucion</p>
                            <h5 class="mb-0">{{$ejecucion}}</h5>
                        </div>
                    </div>
                    <div class="" id="chart5"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card radius-10">
        <div class="card-body">
            <div class="table-responsive lead-table">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Personal</th>
                            <th>Descripción</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Dias retrasado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compromisos as $c)
                        <tr class="seleccion" onclick="abrir_tramite({{$c->id}})">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <img src="img/person.png" class="rounded-circle" width="40" height="40"
                                            alt="" />
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">
                                            {{$c->empleado}}
                                        </h6>
                                        <p class="mb-0 font-13 text-secondary">
                                            {{$c->cargo}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>@php echo($c->descripcion) @endphp</td>
                            <td>{{$c->fecha_inicio}}</td>
                            <td>{{$c->fecha_fin}}</td>
                            @if($c->estado==1)
                            @if($c->dias_retrasado==0)
                            <td>
                                <div class="badge rounded-pill bg-danger w-100">
                                    Hoy se vence el compromiso
                                </div>
                            </td>
                            @else
                            @php
                            $dias = explode(" ",$c->dias_retrasado)
                            @endphp
                            <td>
                                @if($dias[1]=="Atrasado")
                                <div class="badge rounded-pill bg-danger">
                                    {{$c->dias_retrasado}}
                                </div>
                                @else
                                <div class="badge rounded-pill bg-success">
                                    {{$c->dias_retrasado}}
                                </div>
                                @endif
                            </td>
                            @endif
                            @else
                            <td></td>
                            @endif
                            <!--<td class="w-25">
                                <div class="progress radius-10" style="height: 5px">
                                    <div class="progress-bar bg-primary w-75" role="progressbar"></div>
                                </div>
                            </td>-->
                            <td>
                                @if($c->estado==1)
                                <div class="badge rounded-pill bg-warning w-100">
                                    EJECUCION
                                </div>
                                @elseif($c->estado==2)
                                <div class="badge rounded-pill bg-success w-100">
                                    FINALIZADO
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const abrir_tramite = (id_tramite) => {
        alert(id_tramite);
    }
</script>
@endsection