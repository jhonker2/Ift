@extends('Sigop.Tramite.base')
@section('css')
<style>
    .ck-content {
        height: 15em !important;
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Crear Compromiso</div>


    </div>
    <!--end breadcrumb-->
    <div class="mb-3">
        <label for="combo1" class="form-label">Seleccione la fuente</label>
        <select class="form-select" id="sel_fuente">
            <option value="">Seleccione la fuente</option>
            @foreach ($fuentes as $f)
            <option value="{{ $f->id }}">{{ $f->descripcion }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="combo2" class="form-label">Seleccione el Tipo</label>
        <select class="form-select" id="sel_tipo">
            <option value="">Seleccione el Tipo</option>
            @foreach ($tiposTramite as $t)
            <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="nombreInput" class="form-label">Responsable</label>
        <input type="text" class="form-control" id="nombreInput" placeholder="Escribe para buscar..." list="resultList">
        <datalist id="resultList"></datalist>
        <input type="hidden" id="responsableId" name="responsableId">
    </div>
    <div class="mb-3">
        <label class="form-label">Seleccione la Fecha del compromiso</label>
        <input type="date" id="ip_fecha" class="form-control date-time" />
    </div>
    <!--<h6 class="mb-0 text-uppercase">Archivos:</h6>
    <input id="fancy-file-upload" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png" multiple>-->

    <div class="mb-3">
        <label for="inputSolicitante" class="form-label">Descripción</label>
        <div id="editor"></div>
    </div>
    <button type="button" class="btn btn-primary px-5" id="btn_save_compromiso" onclick="f_saveCompromiso()">Registrar
        compromiso</button>
</div>
@endsection

@section('js')
<script src="{{'/ckeditor5-build-classic/ckeditor.js'}}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    const f_saveCompromiso = () => {
        let fuente = $("#sel_fuente").val();
        let tipo = $("#sel_tipo").val();
        let fecha_fin = $("#ip_fecha").val();
        let responsableId = $("#responsableId").val();
        let descripcion = $(".ck-content").html();
        if (fuente == "") {
            alert("Falta el dato fuente");
        } else if (tipo == "") {
            alert("Falta el dato tipo");

        } else if (fecha_fin == "") {
            alert("Falta el dato fecha fin");

        } else if (responsableId == "") {
            alert("Falta el dato responsable");

        } else if (descripcion == "") {
            alert("Falta la descripcion");
        } else {
            let token = $("#csrf-token").val();
            let datos = {
                fuente: fuente,
                tipo: tipo,
                fecha_fin: fecha_fin,
                responsableId: responsableId,
                descripcion: descripcion
            };
            _AJAX_("/store/compromisos", "POST", token, datos, 2);
        }
    }
</script>
@endsection