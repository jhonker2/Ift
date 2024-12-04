@extends('Sigop.Tramite.base')
@section('css')
<link href="{{ asset('assets/css/procesos.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div id="load_p" class="load hide">
    <div class="load_padre">
        <div class="load_hijo">
            <img src="{{asset('img/logoc.png')}}" alt="logo_load" class="w7">
        </div>
        <div class="load_hijo">
            <span>Cargando...</span>
        </div>
    </div>
</div>
<div class="page-content">
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
            <input type="hidden" id="id_tarea_tramite_init" value="{{$tarea_tramite}}">
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

<!-- MODAL REASIGNAR-->
<div class="modal fade" id="modal_reasignar" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reasignar Tramite</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <label for="single-select-field" class="form-label">Usuario a reasignar</label>
                    <select class="js-example-basic-single" id="usuario_disponibles">
                        <option value="0">Seleccione un usuario</option>
                        @foreach($usuarios as $u)
                        <option value="{{$u->IDENTIFICACION}}">{{$u->NOMBRES}}</option>
                        @endforeach
                    </select>
                    <div class="col-md-12">
                        <textarea class="form-control" id="ip_observacion_reasignar" placeholder="Observacion..."
                            rows="3"></textarea>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ip_ace_reasignar">
                            <label class="form-check-label" for="ip_ace_reasignar">Estoy seguro(a) de que
                                deseo
                                devolver
                                la tarea</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn_s_fuente"
                        onclick="reasignar_tramite()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/upload.js') }}"></script>
<script src="{{ '/ckeditor5-build-classic/ckeditor.js' }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/procesos.js?v=1.0.0') }}"></script>
<script src="{{ asset('js/select.custom.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2(
            {
                dropdownParent: $('#modal_reasignar')
            }
        );
    });
</script>
@endsection