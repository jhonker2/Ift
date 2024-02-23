const show_modal = (modal) => {
    $("#" + modal).modal('show');
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
                    if (res.data == "eliminado") {
                        notif({
                            msg: "<b>Correcto:</b> Proyecto eliminado",
                            type: "success",
                        });
                        $("#btn-eliminar-proyecto").html(
                            "<i class='fa fa-save'></i> Eliminar"
                        );
                        $("#modal_delete_proyecto").modal("hide");

                        _AJAX_("/get_project", "GET", "", "", 0);
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
                            html+='<td> <a href="/proceso/'+data.id_proceso+'/'+data.id_tarea+'/'+data.id_tramite+'">EJECUCIÓN</a></td>'
                        }
                        html+='</tr>'
                        id_tramite = data.id_tramite;
                    });
                    $("#body_c").html(html)
                    $("#id_tramite").html(id_tramite);
                    show_modal('modal_tarea_tramite');// modal de tareas tramites

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
