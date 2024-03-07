@extends('Sigop.Tramite.base') @section('content')
<div>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"></div>
        <div class="ps-3">
        </div>
        <div class="ms-auto mr-4">
            <button type="button" onclick="show_modal('modal_r_tfuente')" class="btn btn-primary px-5"><i
                    class="bx bx-plus mr-1"></i>Agregar</button>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <table id="tbl_fuentes" class="table table-striped table-bordered dataTable" style="width: 100%" role="grid"
                aria-describedby="example_info">
                <thead>
                    <tr role="row">
                        <th>ID TRAMITE</th>
                        <th>RESPONSABLE</th>
                        <th>FECHA REGISTRO</th>
                        <th>USUARIO REGISTRO</th>
                        <th>ESTADO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tramites as $t)
                    <tr>
                        <td>{{$t->id}}</td>
                        <td>{{$t->responsable}}</td>
                        <td>{{$t->created_at}}</td>
                        <td>{{$t->usuario_registro}}</td>
                        @if($t->estado == 0)
                        <td>BORRADOR</td>
                        @endif
                        <td><button type="button" class="btn btn-outline-primary"
                                onclick="abrir_borrador({{$t->id}},{{$t->id_tarea}},{{$t->id_proceso}})"><i
                                    class="bx bx-edit me-0"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID TRAMITE</th>
                        <th>RESPONSABLE</th>
                        <th>FECHA REGISTRO</th>
                        <th>USUARIO REGISTRO</th>
                        <th>ESTADO</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection @section('js')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $("#tbl_fuentes").DataTable();
    });

    const abrir_borrador = (id_tramite, id_tarea, id_proceso) => {
        window.location.replace('/proceso/' + id_proceso + '/' + id_tarea + '/' + id_tramite);
    }
    const save_tfuente = () => {
        $("#btn_s_tfuente").html(
            "<span class='spinner-border spinner-border-sm margin-spiner' role='status' aria-hidden='true'></span><span > Guardando..</span>"
        );
        $("#btn_s_tfuente").attr('disabled', true);
        let tipo = $("#ip_tipo").val();
        if (tipo == "") {
            alert("El campo fuente se encuentra vacio!")
            $("#btn_s_fuente").html('Guardar');
            $("#btn_s_fuente").removeAttr('disabled');

        } else {
            var token = $("#csrf-token").val();
            let datos = {
                tipo: tipo
            };
            _AJAX_("/store/tipofuentes", "POST", token, datos, 1);
        }
    }

    const modal_editar = (id, fuente) => {
        show_modal("modal_e_tfuente");
        $("#ip_eidfuente").val(id);
        $("#ip_efuente").val(fuente);
    }
</script>
@endsection