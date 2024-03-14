let editor;
let user_session_activa = $("#SESS_USER_ID").val();
var toast = new Toasty();

const show_modal = (modal) => {
    $("#" + modal).modal('show');
}

const hide_modal = (modal) => {
    $("#" + modal).modal('hide');
}

const abrir_tramite = (id) =>{
    _AJAX_('get_tareas_tramites/'+id,'GET','','',2);
}

const _AJAX_ = (ruta, tipo, token, datos, p) =>{
    if (tipo == "POST") {
        $.ajax({
            url: ruta,
            type: tipo,
            dataType: "json",
            headers: { "X-CSRF-TOKEN": token },
            data: datos,
            success: function (res) {
                if (p == 0) { //SAVE FUENTES
                    if (res.respuesta) {
                        Swal.fire(
                            "Tramites!",
                            "los tramites han sido reagsinado.",
                            "success"
                        );
                        _AJAX_("/get_fuentes", "GET", "", "", 0);
                        $("#btn_s_fuente").html('Guardar');
                        $("#btn_s_fuente").removeAttr('disabled');
                        $("#modal_r_fuente").modal("hide");
                    }
                } else if (p == 1) { // SAVE TIPO DE FUENTES
                    if (res.respuesta) {
                        Swal.fire(
                            "Tipo de fuentes",
                            "El tipo de fuente ha sido reagsinado.",
                            "success"
                        );
                        _AJAX_("/get_tipos_fuentes", "GET", "", "", 1);
                        $("#btn_s_tfuente").html('Guardar');
                        $("#btn_s_tfuente").removeAttr('disabled');
                        $("#modal_r_tfuente").modal("hide");
                    }
                } else if (p == 2) {
                    if (res.respuesta) {
                        alert(res.sms);
                        $("#id_tramite_init").html(respuesta.id_tramite);
                    }else{
                        alert("Error al guardar el tramite");
                    }
                }else if(p==3){
                    if(res.respuesta){
                        Swal.fire(
                            "Tramite",
                            "El tramite enviado de manera correcta",
                            "success"
                        );

                        window.location.href ='/home';

                    }
                }else if(p==4){
                    alert(res);
                }else if(p==5){
                    alert("PROCESS DE GUARDAR TAREA "+res);
                }else if(p==6){
                    if(res.respuesta){
                        Swal.fire(
                            "Tramite",
                            "El tramite enviado de manera correcta",
                            "success"
                        );
    
                        window.location.href ='/home';
                    }
                    
                }else if(p==7){
                    if(res.respuesta){
                        Swal.fire(
                            "Tramite",
                            "El tramite enviado de manera correcta",
                            "success"
                        );
    
                        window.location.href ='/home';
                    }
                    
                }else if(p==8){
                    
                }else if(p==9){
                    //editar fuente
                    if(res.respuesta){
                        _AJAX_("/get_fuentes", "GET", "", "", 0);
                        hide_modal('modal_e_fuente');
                    }
                }else if(p==10){
                    //editar fuente
                    if(res.res){
                        _AJAX_("/get_fuentes", "GET", "", "", 0);
                        //hide_modal('modal_e_fuente');
                    }
                }
                
            },
        }).fail(function (jqXHR, textStatus, errorthrown) {
            if (jqXHR.status === 0) {
                alert("Not connect: Verify Network.");
            } else if (jqXHR.status == 404) {
                alert("Requested page not found [404]");
            } else if (jqXHR.status == 500) {
                alert("Internal Server Error [500].");
            } else if (textStatus === "parsererror") {
                alert("Requested JSON parse failed.");
            } else if (textStatus === "timeout") {
                alert("Time out error.");
            } else if (textStatus === "abort") {
                alert("Ajax request aborted.");
            } else {
                alert("Uncaught Error: " + jqXHR.responseText);
            }
        });
    } else if (tipo == "GET") {
        $.ajax({
            url: ruta,
            type: tipo,
            dataType: "json",
            success: function (res) {
                let html_ = "";
                if (p == 0) {
                    if (res.respuesta == true) {
                        let ht = "";
                        ht +='<table id="tbl_fuentes" class="table table-striped table-bordered dataTable" style="width: 100%" role="grid" aria-describedby="example_info"><thead><tr role="row"><th>N</th><th>FUENTE</th><th>FECHA REGISTRO</th><th>USUARIO REGISTRO</th><th>ESTADO</th><th>OPCIONES</th></tr></thead><tbody>';
                        $(res.data).each(function (i, data) {
                            let fuente= "'"+data.descripcion+"'";
                            ht += "<tr>";
                            ht +='<td>' +data.id +"</td>";
                            ht +='<td >' +data.descripcion +"</td>";
                            ht +='<td >' +data.created_at +"</td>";
                            ht +='<td >' +data.usuario_registro +"</td>";
                            if(data.estado==1){
                                ht +='<td> ACTIVO</td>';
                            }else{
                                ht +='<td> INACTIVO</td>';
                            }
                            ht += '<td >';
                            ht +=
                                '<button type="button" class="btn btn-outline-primary" onclick="modal_editar(' +
                                data.id +
                                "," +
                                fuente +
                                ')"><i class="bx bx-edit me-0"></i></button><button type="button" class="btn btn-outline-danger" onclick="modal_delete(' +
                                data.id +
                                ')"><i class="bx bx-trash-alt me-0"></i></button>'
                            ht += "</td></tr>";
                        });
                        ht += "</tbody>";
                        ht +='<tfoot><tr><th>N</th><th>FUENTE</th><th>FECHA REGISTRO</th><th>USUARIO REGISTRO</th><th>ESTADO</th><th></th></tr></tfoot>'
                        ht += "  </table>";
                        $("#div_fuentes").html(ht);
                    }
                    $("#tbl_fuentes").DataTable();
                }else if(p==1){
                    
                    if (res.respuesta == true) {
                        let ht = "";
                        ht +='<table id="tbl_fuentes" class="table table-striped table-bordered dataTable" style="width: 100%" role="grid" aria-describedby="example_info"><thead><tr role="row"><th>N</th><th>TIPO DE FUENTE</th><th>FECHA REGISTRO</th><th>USUARIO REGISTRO</th><th>ESTADO</th><th>OPCIONES</th></tr></thead><tbody>';
                        $(res.data).each(function (i, data) {
                            ht += "<tr>";
                            ht +='<td>' +data.id +"</td>";
                            ht +='<td >' +data.descripcion +"</td>";
                            ht +='<td >' +data.created_at +"</td>";
                            ht +='<td >' +data.usuario_registro +"</td>";
                            if(data.estado==1){
                                ht +='<td> ACTIVO</td>';
                            }else{
                                ht +='<td> INACTIVO</td>';
                            }
                            ht += '<td >';
                            ht +=
                                '<button type="button" class="btn btn-outline-primary" onclick="modal_editar(' +
                                data.id +
                                "," +
                                data.descripcion +
                                ')"><i class="bx bx-edit me-0"></i></button><button type="button" class="btn btn-outline-danger" onclick="modal_delete(' +
                                data.id +
                                ')"><i class="bx bx-trash-alt me-0"></i></button>'
                            ht += "</td></tr>";
                        });
                        ht += "</tbody>";
                        ht +='<tfoot><tr><th>N</th><th>FUENTE</th><th>FECHA REGISTRO</th><th>USUARIO REGISTRO</th><th>ESTADO</th><th></th></tr></tfoot>'
                        ht += "  </table>";
                        $("#div_fuentes").html(ht);
                    }
                    $("#tbl_fuentes").DataTable();
                }else if(p==2){
                    let html = "";
                    let id_tramite=0;
                    $(res).each(function (i, data) {
                        html+='<tr><th scope="row">'+data.id+'</th>'
                        html+='<td>'+data.tarea+'</td>'
                        html+='<td>'+data.fecha_ejecucion+'</td>'
                        if(isNaN(data.fecha_fin)){
                            html+='<td>'+data.fecha_fin+'</td>'
                        }else{
                            html+='<td></td>'
                        }
                        html+='<td>'+data.empleado+'</td>'
                        if(data.estado=='A'){
                            html+='<td>REASIGNADO</td>'
                        }else if(data.estado=='P'){
                            html+='<td>PROCESADO</td>'
                        }else if(data.estado=='E'){
                            if(data.id_usuario==user_session_activa){
                                html+='<td> <a href="/proceso/'+data.id_proceso+'/'+data.id_tarea+'/'+data.id_tramite+'">EJECUCIÓN</a></td>'
                            }else{
                                html +='<td>EJECUCION</td>'
                            }
                        }
                        html+='</tr>'
                        id_tramite = data.id_tramite;
                    });
                    $("#body_c").html(html)
                    $("#id_tramite").html(id_tramite);
                    show_modal('modal_tarea_tramite');// modal de tareas tramites

                }else if(p==3){
                    if(res.respuesta){
                    let id_tarea_ = $("#id_tarea").val();
                    if(id_tarea_ == 1){
                        $(res.tramite).each(function (i, data) {
                            let f = data.fecha_fin.split(" ");
                            $("#sel_fuente").val(data.id_fuente);
                            $("#sel_tipo").val(data.id_tipo_fuente);
                            $("#responsableId").val(data.responsable);
                             buscar_empleado(data.responsable);
                            //$(".ck-content").html(data.descripcion);
                            editor.setData(data.descripcion)
                            $("#ip_fecha").val(f[0]);
    
                            
                        });
                        let lista="";
                    $(res.archivos).each(function(i,data){
                        if(data.id_tarea==id_tarea_){
                            lista ="<li class='mt_1-3'><div class='button_files'><div class=' puntero mr-15' onclick='descargar_archivo(" + data.id_archivo + ")'><i class='fa-solid fa-paperclip mr-15'></i><span>" + data.name + "</span></div><div class='puntero' onclick='delete_file("+ data.id_archivo+")'><i class='fa-solid fa-circle-xmark rojo'></i></div></div></li>"
                           // lista +="<li><a href='#' onclick='descargar_archivo(" + data.id_archivo + ")'>" + data.name + "</a></li>"
                           $("#lista_file_"+id_tarea_).append(lista)
                        }
                    });
                    }else if(id_tarea_==2){
                        $(res.tramite).each(function (i, data) {
                            let f = data.fecha_fin.split(" ");

                        $("#s_fuente").html(data.fuente);
                        $("#s_tipo").html(data.tipo_fuente);
                        //$("#s_responsale").html(data.responsable);
                         buscar_empleado_v2(data.responsable);
                        //$(".ck-content").html(data.descripcion);
                        $("#s_descripcion").html(data.descripcion);
                        $("#s_fecha_compromiso").html(f[0]);
                    });
                    let lista="";
                    $(res.archivos).each(function(i,data){
                        if(data.id_tarea==id_tarea_){
                            lista ="<li class='mt_1-3'><div class='button_files'><div class=' puntero mr-15' onclick='descargar_archivo(" + data.id_archivo + ")'><i class='fa-solid fa-paperclip mr-15'></i><span>" + data.name + "</span></div><div class='puntero' onclick='delete_file("+ data.id_archivo+")'><i class='fa-solid fa-circle-xmark rojo'></i></div></div></li>"
                        }else{
                            lista ="<li><a href='#' onclick='descargar_archivo(" + data.id_archivo + ")'>" + data.name + "</a></li>"
                        }
                        $("#lista_file_"+data.id_tarea).append(lista)
                    });

                    }else if(id_tarea_==4){
                        console.log(res);
                        $(res.tramite).each(function (i, data) {
                            let f = data.fecha_fin.split(" ");
                            $("#s_fuente").html(data.fuente);
                            $("#s_tipo").html(data.tipo_fuente);
                            buscar_empleado_v2(data.responsable);
                            $("#s_descripcion").html(data.descripcion);
                            $("#s_fecha_compromiso").html(f[0]);
                        });
                        $(res.archivos).each(function(i,data){
                            
                           let  lista ="<li><a href='#' onclick='descargar_archivo(" + data.id_archivo + ")'>" + data.name + "</a></li>"
                            $("#lista_file_"+data.id_tarea).append(lista)
                        });

                        $(res.tarea_tramite).each(function(i,data){
                            if(data.id_tarea==2 && data.estado=='P'){
                                $("#observacion2").html(data.observacion)   
                            }
                         });
                    }
                    

                    }
                }else if(p==4){
                    if(res.respuesta){
                        let id_tramite = $("#id_tramite_init").html();
                        let id_tarea = $("#id_tarea").val();
                        let token = $("#csrf-token").val();
                        let datos = {
                            id_tramite,
                            id_tarea
                        };
                        _AJAX_("/GET_archivos", "POST", token, datos, 8);
                    }
                }
            },
        }).fail(function (jqXHR, textStatus, errorthrown) {
            if (jqXHR.status === 0) {
                alert("Not connect: Verify Network.");
            } else if (jqXHR.status == 404) {
                alert("Requested page not found [404]");
            } else if (jqXHR.status == 500) {
                alert("Internal Server Error [500].");
            } else if (textStatus === "parsererror") {
                alert("Requested JSON parse failed.");
            } else if (textStatus === "timeout") {
                alert("Time out error.");
            } else if (textStatus === "abort") {
                alert("Ajax request aborted.");
            } else {
                alert("Uncaught Error: " + jqXHR.responseText);
            }
        });
    }
}

const buscar_empleado_v2 = async (cedula) =>{
    $.ajax({
        url: `/get_empleados?nombres=${cedula}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            //var resultList = document.getElementById('resultList');
            //resultList.innerHTML = ''; // Limpiar resultados anteriores
            data.forEach(item => {
                $("#s_responsable").html(`${item.NOMBRES} (${item.CARGO})`)
                //resultList.innerHTML += `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
            });
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

const buscar_empleado = async (cedula) =>{
    $.ajax({
        url: `/get_empleados?nombres=${cedula}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            //var resultList = document.getElementById('resultList');
            //resultList.innerHTML = ''; // Limpiar resultados anteriores
            data.forEach(item => {
                $("#nombreInput").val(`${item.NOMBRES} (${item.CARGO})`)
                //resultList.innerHTML += `<option data-id="${item.IDENTIFICACION}" value="${item.NOMBRES} (${item.CARGO})"></option>`;
            });
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
        }
    });
}


const descargar_archivo = (id_archivo) =>{
    var url = "/sp_download_file/" + id_archivo;
        console.log(url);
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    //_AJAX_('/sp_download_file/'+id_archivo,'GET','','',4);

}

const delete_file = (id_archivo) => {
    _AJAX_('/sp_delete_file/'+id_archivo,'GET','','',4);

}

