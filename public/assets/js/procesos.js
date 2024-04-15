let id_tramite_i = $("#id_tramite_init").html();
let id_tarea_i = $("#id_tarea").val();
$(document).ready(function () {
    toast.info("Here is some information!");
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor
        }).catch(error => {
            console.error(error);
        });
    if (id_tramite_i != '0') {
        if (id_tarea_i == 1) {
            document.getElementById('nombreInput').addEventListener('input', function () {
                var selectedOption = document.querySelector(
                    `#resultList option[value="${this.value}"]`);
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
                            let resultList = document.getElementById('resultList');
                            resultList.innerHTML = ''; // Limpiar resultados anteriores
                            data.forEach(item => {
                                resultList.innerHTML +=
                                    `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            document.getElementById('nombreInputseguimiento').addEventListener('input', function () {
                var selectedOption = document.querySelector(
                    `#resultList_seguimiento option[value="${this.value}"]`);
                var seguiminetoId = selectedOption ? selectedOption.getAttribute('data-id') : '';
                document.getElementById('seguiminetoId').value = seguiminetoId;
            });
    
            document.getElementById('nombreInputseguimiento').addEventListener('keyup', function () {
                var query = this.value;
                if (query.length >= 2) {
                    $.ajax({
                        url: `/get_empleados?nombres=${query}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            let resultList = document.getElementById('resultList_seguimiento');
                            resultList.innerHTML = ''; // Limpiar resultados anteriores
                            data.forEach(item => {
                                resultList.innerHTML +=
                                    `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
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
    }else{
        document.getElementById('nombreInput').addEventListener('input', function () {
            var selectedOption = document.querySelector(
                `#resultList option[value="${this.value}"]`);
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
                            resultList.innerHTML +=
                                `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });


        document.getElementById('nombreInputseguimiento').addEventListener('input', function () {
            var selectedOption = document.querySelector(
                `#resultList_seguimiento option[value="${this.value}"]`);
            var seguiminetoId = selectedOption ? selectedOption.getAttribute('data-id') : '';
            document.getElementById('seguiminetoId').value = seguiminetoId;
        });

        document.getElementById('nombreInputseguimiento').addEventListener('keyup', function () {
            var query = this.value;
            if (query.length >= 2) {
                $.ajax({
                    url: `/get_empleados?nombres=${query}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var resultList = document.getElementById('resultList_seguimiento');
                        resultList.innerHTML = ''; // Limpiar resultados anteriores
                        data.forEach(item => {
                            resultList.innerHTML +=
                                `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
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
                $("#id_tramite_init").html(respuesta.id_tramite);
                let lista =
                "<li class='mt_1-3'><div class='button_files'><div class=' puntero mr-15' onclick='descargar_archivo(" +
                respuesta.id_archivo + ")'><i class='fa-solid fa-paperclip mr-15'></i><span>" +
                respuesta.name_archivo + "</span></div><div class='puntero' onclick='delete_file(" +
                respuesta.id_archivo +
                ")'><i class='fa-solid fa-circle-xmark rojo'></i></div></div></li>"

                $("#lista_file_2").append(lista)
            } else {
                alert(
                    "El archivo NO se ha podido subir. si el archivo pesa mas de 1 GB recarge su navegador ");
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
    let seguiminetoId = $("#seguiminetoId").val();
    let asunto = $("#ip_asunto").val();
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
        descripcion,
        seguiminetoId,
        asunto
    },
        token,
        function (respuesta) {
            $("#barra_de_progreso").val(0);
            if (respuesta.registro) {
                //  mostrarRespuesta('El archivo ha sido subido correctamente.', true);
                // alert("El archivo ha sido subido correctamente.");

                // this show an informational message:
                toast.info("Here is some information!");
                $("#id_tramite_init").html(respuesta.id_tramite);
                let lista =
                    "<li class='mt_1-3'><div class='button_files'><div class=' puntero mr-15' onclick='descargar_archivo(" +
                    respuesta.id_archivo + ")'><i class='fa-solid fa-paperclip mr-15'></i><span>" +
                    respuesta.name_archivo + "</span></div><div class='puntero' onclick='delete_file(" +
                    respuesta.id_archivo +
                    ")'><i class='fa-solid fa-circle-xmark rojo'></i></div></div></li>"
                $("#lista_file_" + id_tarea).append(lista);
            } else {
                alert(
                    "El archivo NO se ha podido subir. si el archivo pesa mas de 1 GB recarge su navegador ");
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
    $("#load_p").show();
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
    let seguimientoId = $("#seguiminetoId").val();
    let asunto = $("#ip_asunto").val();

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
            descripcion: descripcion,
            seguimientoId,
            asunto
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