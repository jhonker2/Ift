@extends('Sigop.Tramite.base')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Crear Tramites</div>


        </div>
        <!--end breadcrumb-->
        <form action="{{ route('guardar_tarea') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="combo1" class="form-label">Seleccione la fuente</label>
                <select class="form-select" name="idfuente">
                    <option value="">Seleccione la fuente</option>
                    @foreach ($fuentes as $idfuente => $descripcion)
                        <option value="{{ $idfuente }}">{{ $descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="combo2" class="form-label">Seleccione el Tipo</label>
                <select class="form-select" name="idtipocompromiso">
                    <option value="">Seleccione el Tipo</option>
                    @foreach ($tiposTramite as $idtipocompromiso => $descripcion)
                        <option value="{{ $idtipocompromiso }}">{{ $descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nombreInput" class="form-label">Responsable</label>
                <input type="text" class="form-control" id="nombreInput" placeholder="Escribe para buscar..."
                    list="resultList">
                <datalist id="resultList"></datalist>
                <input type="hidden" id="responsableId" name="responsableId">
            </div>



            <div class="mb-3">
                <label for="inputSolicitante" class="form-label">Referencia</label>
                <textarea class="form-control" name="solicitante" id="inputSolicitante" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="inputSolicitante" class="form-label">Descripcion</label>
                <textarea class="form-control" name="descripcionT" id="descripcionT" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary px-5">Registrar</button>
        </form>





    </div>
@endsection
