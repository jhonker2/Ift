@extends('Sigop.Tramite.base')
@section('css')
<style>
    .cabe_control {
        width: 100%;
        position: fixed;
        background: #ddd;
        padding: 1.2em;
    }

    .ck-content {
        height: 15em !important;
    }

    .file-upload {
        background: #349aeb;
        padding: 8px;
        border-radius: 10px;
        color: #fff;
        width: 13em;
        overflow: hidden;
        position: relative;
    }

    .file-upload input {
        position: absolute;
        height: 400px;
        width: 400px;
        left: -200px;
        top: -200px;
        background: transparent;
        opacity: 0;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: alpha(opacity=0);
        cursor: pointer;

    }

    .mt-5 {
        margin-top: 5em;
    }

    .mt-2 {
        margin-top: 2em;
    }

    .ocultar {
        display: none;
    }

    .mostrar {
        display: show;
    }

    .button_files {
        display: flex;
        background: #ddd;
        position: absolute;
        padding: 7px;
        border-radius: 10px;
    }

    .rojo {
        color: red;
    }

    .puntero {
        cursor: pointer;
    }

    .mr-15 {
        margin-right: 15px;
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        @if(isset($tramite))
        <div class="breadcrumb-title pe-3 mt-5"><span>#</span><span id="id_tramite_init">{{$tramite}}</span>
        </div>
        @else
        <div class="breadcrumb-title pe-3 mt-5"><span>#</span><span id="id_tramite_init">0</span>
        </div>
        @endif
        @foreach($procesos as $p)
        <div class="breadcrumb-title pe-3 mt-5"><span id="proceso">Proceso: {{$p->descripcion}}</span>
        </div>
        <input type="hidden" id="id_proceso" value="{{$p->id}}">
        @endforeach
        @foreach($tareas as $t)
        <div class="breadcrumb-title pe-3 mt-5"><span id="tarea">Tarea: {{$t->descripcion}}</span>
        </div>
        <input type="hidden" id="id_tarea" value="{{$t->id}}">

        @endforeach
    </div>
    <!--end breadcrumb-->
    @foreach($tareas as $t)
    @if($t->id==1)
    <div id="form_1">

        <div class="mb-3">
            <label for="combo1" class="form-label">Seleccione la fuente</label>
            <select class="form-select" id="sel_fuente">
                <option value="0">Seleccione la fuente</option>
                @foreach ($fuentes as $f)
                <option value="{{ $f->id }}">{{ $f->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="combo2" class="form-label">Seleccione el Tipo</label>
            <select class="form-select" id="sel_tipo">
                <option value="0">Seleccione el Tipo</option>
                @foreach ($tiposTramite as $t)
                <option value="{{ $t->id }}">{{ $t->descripcion }}</option>
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
            <label class="form-label">Seleccione la Fecha del compromiso</label>
            <input type="date" id="ip_fecha" class="form-control date-time" />
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
            <label for="inputSolicitante" class="form-label">Descripción</label>
            <textarea name="content" id="editor"></textarea>
        </div>
    </div>
    @elseif($t->id==2)
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

    @elseif($t->id==4)
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
        <div class="form-check form-switch">
            <!--<input class="form-check-input" type="checkbox" id="chk_estado">-->
            <input class="form-check-input" type="checkbox" role="switch" id="chk_estado">
            <label class="form-check-label" for="chk_estado">Se aprueba los documentos</label>
        </div>
        <textarea class="form-control" id="txt_observacion" placeholder="Observacion..." rows="3"></textarea>

    </div>
    @endif

    @endforeach
</div>
@endsection

@section('js')
<script src="{{asset('js/upload.js')}}"></script>
<script src="{{'/ckeditor5-build-classic/ckeditor.js'}}"></script>
<script>
    let id_tramite_i = $("#id_tramite_init").html();
    let id_tarea_i = $("#id_tarea").val();
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor
        }).catch(error => {
            console.error(error);
        });
    $(document).ready(function () {
        if (id_tramite_i != '0') {
            if (id_tarea_i == 1) {
                document.getElementById('nombreInput').addEventListener('input', function () {
                    var selectedOption = document.querySelector(`#resultList option[value="${this.value}"]`);
                    var responsableId = selectedOption ? selectedOption.getAttribute('data-id') : '';
                    document.getElementById('responsableId').value = responsableId;
                });

                document.getElementById('nombreInput').addEventListener('keyup', function () {
                    var query = this.value;
                    if (query.length >= 2) {
                        $.ajax({
                            url: `/get_empleados?nombres=${query}`,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                var resultList = document.getElementById('resultList');
                                resultList.innerHTML = ''; // Limpiar resultados anteriores
                                data.forEach(item => {
                                    resultList.innerHTML += `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                });
                _AJAX_("/open/" + id_tramite_i + "/" + id_tarea_i + "/tramite", "GET", "", "", 3);
            } else if (id_tarea_i == 2) {
                _AJAX_("/open/" + id_tramite_i + "/" + id_tarea_i + "/tramite", "GET", "", "", 3);
            } else if (id_tarea_i == 4) {
                _AJAX_("/open/" + id_tramite_i + "/tramite", "GET", "", "", 3);
            }
        }
    })

    const load_file_server_tarea2 = (file_name) => {
        let token = $("#csrf-token").val();
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();

        $("#file").upload('/uplodad/file_registro', {
            file_name,
            id_tramite,
            id_tarea,
            id_proceso,
        },
            token,
            function (respuesta) {
                $("#barra_de_progreso").val(0);
                if (respuesta.registro) {
                    //  mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                    alert("El archivo ha sido subido correctamente.");
                    $("#id_tramite_init").html(respuesta.id_tramite);
                    $("#lista_file_2").append("<li><a href='#' onclick='alert(" + respuesta.id_archivo + ")'>" + respuesta.name_archivo + "</a> <a href='#'> <i class='fa-solid fa-trash-can'></i></a></li>")
                } else {
                    alert("El archivo NO se ha podido subir. si el archivo pesa mas de 1 GB recarge su navegador ");
                }
            },
            function (progreso, valor) {
                //Barra de progreso.
                /*$("#porce").html(valor + "%");
                $("#barra_de_progreso").val(valor);*/
                console.log(valor + " " + progreso);
            });
    }

    const load_file_server = (file_name) => {
        let token = $("#csrf-token").val();
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        let fuente = $("#sel_fuente").val();
        let tipo = $("#sel_tipo").val();
        let fecha_fin = $("#ip_fecha").val();
        let responsableId = $("#responsableId").val();
        let descripcion = editor.getData(); //$(".ck-content").html();

        $("#file").upload('/uplodad/file', {
            file_name,
            id_tramite,
            id_tarea,
            id_proceso,
            fuente,
            tipo,
            fecha_fin,
            responsableId,
            descripcion
        },
            token,
            function (respuesta) {
                $("#barra_de_progreso").val(0);
                if (respuesta.registro) {
                    //  mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                    alert("El archivo ha sido subido correctamente.");
                    $("#id_tramite_init").html(respuesta.id_tramite);
                    $("#lista_file").append("<li><a href='#' onclick='alert(" + respuesta.id_archivo + ")'>" + respuesta.name_archivo + "</a> <a href='#'> <i class='fa-solid fa-trash-can'></i></a></li>")
                } else {
                    alert("El archivo NO se ha podido subir. si el archivo pesa mas de 1 GB recarge su navegador ");
                }
            },
            function (progreso, valor) {
                //Barra de progreso.
                /*$("#porce").html(valor + "%");
                $("#barra_de_progreso").val(valor);*/
                console.log(valor + " " + progreso);
            });
    }

    const f_send_tramite = () => {
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        let responsableId = $("#responsableId").val();
        let token = $("#csrf-token").val();
        let datos = {
            id_tramite,
            id_proceso,
            id_tarea,
            responsableId,
        };

        _AJAX_("/enviar_tramite", "POST", token, datos, 3);
    }
    const f_savetramite = () => {
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        let fuente = $("#sel_fuente").val();
        let tipo = $("#sel_tipo").val();
        let fecha_fin = $("#ip_fecha").val();
        let responsableId = $("#responsableId").val();
        //let descripcion = $(".ck-content").html();
        let descripcion = editor.getData(); //$(".ck-content").html();
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
                id_tramite,
                id_proceso,
                id_tarea,
                fuente: fuente,
                tipo: tipo,
                fecha_fin: fecha_fin,
                responsableId: responsableId,
                descripcion: descripcion
            };
            _AJAX_("/store/compromisos", "POST", token, datos, 2);
        }
    }

    const f_send_tarea = () => {
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        let token = $("#csrf-token").val();
        let datos = {
            id_tramite,
            id_proceso,
            id_tarea,
            user_session_activa,

        };

        _AJAX_("/ps_enviar_tarea_2", "POST", token, datos, 6);
    }
    const f_savetarea2 = () => {
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        //let descripcion = $(".ck-content").html();
        let descripcion = editor.getData(); //$(".ck-content").html();
        if (descripcion == "") {
            alert("Falta ingresar descripcion");
        } else {
            let token = $("#csrf-token").val();
            let datos = {
                id_tramite,
                id_proceso,
                id_tarea,
                descripcion,
                user_session_activa
            };
            _AJAX_("/sp_guardar_tarea", "POST", token, datos, 2);
        }
    }


    const f_savetarea4 = () => {
        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        //let descripcion = $(".ck-content").html();
        let observacion = $("#txt_observacion").val();
        let estado_confirmado = $("#chk_estado").is(':checked');
        console.log(estado_confirmado);
        if (!estado_confirmado) { //false
            if (observacion == "") {
                alert("Debe ingresar un observacion por lo cual no aprueba la documentacion");
                return;
            }
        }
        let token = $("#csrf-token").val();
        let datos = {
            id_tramite,
            id_proceso,
            id_tarea,
            user_session_activa,
            estado_confirmado,
            observacion
        };
        _AJAX_("/sp_guardar_tarea", "POST", token, datos, 2);
    }

    const f_send_tarea4 = () => {
        let estado_confirmado = $("#chk_estado").is(':checked');
        console.log(estado_confirmado);
        if (!estado_confirmado) {
            alert("Check no activado");
        } else {
            alert("Aprobado");
        }

        let id_tramite = $("#id_tramite_init").html();
        let id_tarea = $("#id_tarea").val();
        let id_proceso = $("#id_proceso").val();
        let observacion = $("#txt_observacion").val();
        let token = $("#csrf-token").val();
        let datos = {
            id_tramite,
            id_proceso,
            id_tarea,
            user_session_activa,
            estado_confirmado,
            observacion
        };
        _AJAX_("/ps_enviar_tarea_4", "POST", token, datos, 7);

    }
    let logFile = document.querySelectorAll("[data-file]");
    for (let item of logFile) {
        item.addEventListener(
            "change",
            function (event) {
                const file = event.target.files[0];
                const reader = new FileReader();
                file_name = file.name;
                file_type = file.type;
                file_size = file.size;
                reader.onloadend = () => {
                    if (file_size > 26214400) {
                        alert("El archivo que intenta subir supera los 25 mb");
                    } else {
                        fileURL = reader.result;
                        console.log(file_name + " " + file_size);
                        let use_to = this.id;
                        load_file_server(file_name)
                    }
                };
                reader.readAsDataURL(file);
            },
            false
        );
    }

    let logFile2 = document.querySelectorAll("[data-file_res]");
    for (let item of logFile2) {
        item.addEventListener(
            "change",
            function (event) {
                const file = event.target.files[0];
                const reader = new FileReader();
                file_name = file.name;
                file_type = file.type;
                file_size = file.size;
                reader.onloadend = () => {
                    if (file_size > 26214400) {
                        alert("El archivo que intenta subir supera los 25 mb");
                    } else {
                        fileURL = reader.result;
                        console.log(file_name + " " + file_size);
                        let use_to = this.id;
                        load_file_server_tarea2(file_name)
                    }
                };
                reader.readAsDataURL(file);
            },
            false
        );
    }


    const devolver_tramite = () => {

        let id_proceso = $("#id_proceso").val();
        let id_tarea = $("#id_tarea").val();
        let observacion = $("#ip_observacion_devolver").val();
        if (observacion == "") {
            alert('Por favor ingrese una observacion para poder devolver');
            return;
        }
        if (!$('#ip_ace_devolver').prop('checked')) {
            alert('No ha aceptado la devolución');
            return;
        }

        if (id_proceso == "" || id_tarea == "") {
            alert("No tiene camino");
            return;
        }
        let token = $("#csrf-token").val();
        let datos = {
            id_proceso,
            id_tarea,
        };
        _AJAX_('/sp_devolver_tarea', 'POST', token, datos, 4);



    }


</script>
@endsection