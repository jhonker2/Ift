@extends('Sigop.Tramite.base') @section('content')
<h5 class="card-title">Crear Tareas</h5>
<hr />
<div class="form-body mt-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="border border-3 p-4 rounded">
        <!-- Primer Combobox -->
        <div class="mb-3">
          <label for="combo1" class="form-label">Seleccionar Proceso</label>
          <select class="form-select" id="combo1">
            <option>Selecione proceso</option>
            @foreach($procesos as $p)
            <option value="{{$p->idproceso}}">{{$p->descripcion}}</option>
            @endforeach
          </select>
        </div>

        <!-- Segundo Combobox -->
        <div class="mb-3">
          <label for="combo2" class="form-label"
            >Seleccionar notificacion</label
          >
          <select class="form-select" id="combo2">
            <option>Selecione notificacion</option>
            @foreach($plantilla_noti as $p)
            <option value="{{$p->idplantillanotificacion}}">
              {{$p->descripcion}}
            </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="inputProductDescription" class="form-label"
            >Ingrese Descripcion de la tarea</label
          >
          <textarea
            class="form-control"
            id="inputProductDescription"
            rows="3"
          ></textarea>
        </div>
        <button type="button" class="btn btn-primary px-5">Registrar</button>
      </div>
    </div>
  </div>
  <!--end row-->
</div>
@endsection
