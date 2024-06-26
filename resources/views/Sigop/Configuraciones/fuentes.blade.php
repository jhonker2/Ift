@extends('Sigop.Tramite.base') @section('content')
    <div>
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"></div>
            <div class="ps-3">
            </div>
            <div class="ms-auto mr-4">
                <button type="button" onclick="show_modal('modal_r_fuente')" class="btn btn-primary px-5"><i
                        class="bx bx-plus mr-1"></i>Agregar</button>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                        <div class="row">
                            <div class="col-sm-12" id="div_fuentes">
                                <table id="tbl_fuentes" class="table table-striped table-bordered dataTable"
                                    style="width: 100%" role="grid" aria-describedby="example_info">
                                    <thead>
                                        <tr role="row">
                                            <th>N</th>
                                            <th>FUENTE</th>
                                            <th>FECHA REGISTRO</th>
                                            <th>USUARIO REGISTRO</th>
                                            <th>ESTADO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fuentes as $f)
                                            <tr>
                                                <td>{{ $f->id }}</td>
                                                <td>{{ $f->descripcion }}</td>
                                                <td>{{ $f->created_at }}</td>
                                                <td>{{ $f->usuario_registro }}</td>
                                                @if ($f->estado == 1)
                                                    <td>ACTIVO</td>
                                                @else
                                                    <td>INACTIVO</td>
                                                @endif
                                                <td><button type="button" class="btn btn-outline-primary"
                                                        onclick="modal_editar({{ $f->id }},'{{ $f->descripcion }}')"><i
                                                            class="bx bx-edit me-0"></i></button>
                                                    <button type="button" class="btn btn-outline-danger"
                                                        onclick="delete_fuente({{ $f->id }})"><i
                                                            class="bx bx-trash-alt me-0"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>N</th>
                                            <th>FUENTE</th>
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
                </div>
            </div>
        </div>
    </div>
    @endsection @section('js')
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#tbl_fuentes").DataTable();
        });


        const save_fuente = () => {
            $("#btn_s_fuente").html(
                "<span class='spinner-border spinner-border-sm margin-spiner' role='status' aria-hidden='true'></span><span > Guardando..</span>"
            );
            $("#btn_s_fuente").attr('disabled', true);
            let fuente = $("#ip_fuente").val();
            if (fuente == "") {
                alert("El campo fuente se encuentra vacio!")
                $("#btn_s_fuente").html('Guardar');
                $("#btn_s_fuente").removeAttr('disabled');

            } else {
                var token = $("#csrf-token").val();
                let datos = {
                    fuente: fuente
                };
                _AJAX_("/store/fuente", "POST", token, datos, 0);
            }
        }

        const modal_editar = (id, fuente) => {
            show_modal("modal_e_fuente");
            $("#ip_eidfuente").val(id);
            $("#ip_efuente").val(fuente);
        }

        const update_fuente = () => {
            let fuente = $("#ip_efuente").val();
            let id_fuente = $("#ip_eidfuente").val();

            if (fuente == "") {
                alert("El campo fuente se encuentra vacio!")
            } else {
                var token = $("#csrf-token").val();
                let datos = {
                    fuente,
                    id_fuente
                };
                _AJAX_("/update/fuente", "POST", token, datos, 9);
            }

        }

        const delete_fuente = (id_fuente) => {

            Swal.fire({
                title: "Esta seguro de eliminar la fuente?",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: "Eliminar",
                denyButtonText: `Cancelar`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    if (id_fuente == "") {
                        alert("El campo fuente se encuentra vacio!")
                    } else {
                        var token = $("#csrf-token").val();
                        let datos = {
                            id_fuente
                        };
                        _AJAX_("/delete/fuente", "POST", token, datos, 10);
                    }
                }
            });


        }
    </script>
@endsection
