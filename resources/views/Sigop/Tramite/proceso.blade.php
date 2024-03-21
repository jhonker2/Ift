@extends('Sigop.Tramite.base')
@section('css')
<link href="{{ asset('assets/css/procesos.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        @if (isset($tramite))
        <div class="breadcrumb-title pe-3 mt-5"><span>#</span>

            @if(sizeof($tramite_data)!=0)
            @foreach($tramite_data as $td)
            <span id="code_tramite">{{$td->id_tramite}}</span>
            @endforeach
            @else
            <span id="code_tramite">0</span>
            @endif
            <span class="hide" id="id_tramite_init">{{$tramite }}</span>
        </div>
        @else
        <div class="breadcrumb-title pe-3 mt-5"><span>#</span>
            <span id="code_tramite">0</span><span id="id_tramite_init">0</span>
        </div>
        @endif
        @foreach ($procesos as $p)
        <div class="breadcrumb-title pe-3 mt-5"><span id="proceso"><strong>Proceso:</strong> {{ $p->descripcion
                }}</span>
        </div>
        <input type="hidden" id="id_proceso" value="{{ $p->id }}">
        @endforeach
        @foreach ($tareas as $t)
        <div class="breadcrumb-title pe-3 mt-5"><span id="tarea"><strong>Tarea:</strong> {{ $t->descripcion }}</span>
        </div>
        <input type="hidden" id="id_tarea" value="{{ $t->id }}">
        @endforeach
    </div>
    <!--end breadcrumb-->
    @foreach ($tareas as $t)
    @if ($t->id == 1)
    <div id="form_1">
        <div class="mb-3">
            <label for="combo1" class="form-label"><strong> Seleccione la fuente:</strong></label>
            <select class="form-select" id="sel_fuente">
                <option value="0">Seleccione la fuente</option>
                @foreach ($fuentes as $f)
                <option value="{{ $f->id }}">{{ $f->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="combo2" class="form-label"><strong> Seleccione el Tipo:</strong></label>
            <select class="form-select" id="sel_tipo">
                <option value="0">Seleccione el Tipo</option>
                @foreach ($tiposTramite as $t)
                <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label"><strong> Asunto:</strong></label>
            <input type="text" class="form-control" id="ip_asunto" placeholder="Ingrese un asunto" autocomplete="off">

        </div>
        <div class="mb-3">
            <label for="nombreInput" class="form-label"><strong> Responsable:</strong></label>
            <input type="text" class="form-control" id="nombreInput"
                placeholder="Ingrese el nombre o cedula del responsable" list="resultList">
            <datalist id="resultList"></datalist>
            <input type="hidden" id="responsableId" name="responsableId">
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>Seleccione la Fecha del compromiso:</strong></label>
            <input type="date" id="ip_fecha" class="form-control date-time" />
        </div>
        <div class="mb-3">
            <label for="nombreInputseguimiento" class="form-label"><strong>Usuario para seguimiento:</strong></label>
            <input type="text" class="form-control" id="nombreInputseguimiento"
                placeholder="Ingrese el nombre o cédula del usuario para seguimiento..." list="resultList_seguimiento">
            <datalist id="resultList_seguimiento"></datalist>
            <input type="hidden" id="seguiminetoId" name="seguiminetoId">
        </div>

        <h6 class="mb-0 text-uppercase">Archivos:</h6>
        <input type="hidden" id="ids_archivos">

        <div class="file-upload">
            <i class="fa-solid fa-paperclip"></i>
            <span>Adjuntar documentos</span>
            <input type="file" id="file" data-file name="file" />
        </div>
        <div id="files_uploads">
            <ul id="lista_file_1">
            </ul>
        </div>
        <div class="mb-3">
            <label for="inputSolicitante" class="form-label"><strong>Descripción</strong></label>
            <textarea name="content" id="editor"></textarea>
        </div>
    </div>
    @elseif($t->id == 2)
    <div id="form_2">
        <div>
            <strong>Fuente: </strong>
            <span id="s_fuente"></span>
        </div>
        <div>
            <strong>Tipo: </strong>
            <span id="s_tipo"></span>

        </div>
        <div>
            <strong>Responsable: </strong>
            <span id="s_responsable"></span>
        </div>
        <div>
            <strong>Fecha compromiso: </strong>
            <span id="s_fecha_compromiso"></span>
        </div>
        <div id="files_uploads">
            <span><strong>Documentos de respaldo</strong></span>
            <ul id="lista_file_1">
            </ul>
        </div>
        <div>
            <strong>Descripción: </strong>
            <span id="s_descripcion"></span>
        </div>
        <hr>
        <div class="file-upload">
            <i class="fa-solid fa-paperclip"></i>
            <span>Adjuntar documentos</span>
            <input type="file" id="file" data-file_res name="file" />
        </div>
        <div id="files_uploads">
            <ul class="mt-2" id="lista_file_2">
            </ul>
        </div>
        <div class="mb-3">
            <label for="inputSolicitante" class="form-label">Descripción</label>
            <textarea name="content" id="editor"></textarea>
        </div>
    </div>
    @elseif($t->id == 4)
    <div id="form_4">
        <div>
            <strong>Fuente: </strong>
            <span id="s_fuente"></span>
        </div>
        <div>
            <strong>Tipo: </strong>
            <span id="s_tipo"></span>

        </div>
        <div>
            <strong>Responsable: </strong>
            <span id="s_responsable"></span>
        </div>
        <div>
            <strong>Fecha compromiso: </strong>
            <span id="s_fecha_compromiso"></span>
        </div>
        <div id="files_uploads">
            <span><strong>Documentos de respaldo</strong></span>
            <ul id="lista_file_1">
            </ul>
        </div>
        <div>
            <strong>Descripción: </strong>
            <p id="s_descripcion"></p>
        </div>
        <hr>
        <div id="campos_formulario_2">
            <span><strong>Observación: </strong></span>
            <p id="observacion2">

            </p>
        </div>
        <div id="files_uploads">
            <span><strong>Documentos de respaldo:</strong></span>
            <ul class="mt-2" id="lista_file_2">
            </ul>
        </div>
        <hr>
        <div id="grupo_observacion">
            <div class="form-check form-switch">
                <!--<input class="form-check-input" type="checkbox" id="chk_estado">-->
                <input class="form-check-input" type="checkbox" role="switch" id="chk_estado">
                <label class="form-check-label" for="chk_estado">Se aprueba los documentos</label>
            </div>
            <textarea class="form-control" id="txt_observacion" placeholder="Observacion..." rows="3"></textarea>
        </div>

        <div>
            <div id="cont_chk">

            </div>
            <p id="txt_observacion_4"></p>
        </div>

    </div>
    @endif
    @endforeach
</div>
@endsection

@section('js')
<script src="{{ asset('js/upload.js') }}"></script>
<script src="{{ '/ckeditor5-build-classic/ckeditor.js' }}"></script>
<script src="{{ asset('assets/js/procesos.js') }}"></script>
@endsection