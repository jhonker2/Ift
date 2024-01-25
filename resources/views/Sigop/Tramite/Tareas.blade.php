@extends('Tramite.base')
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')
		<!--start page wrapper -->

			
			
				<!--end breadcrumb-->
             
                        <h5 class="card-title">Crear Tareas</h5>
                        <hr/>
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <!-- ... tus otros campos de formulario aquí ... -->
                
                                        <!-- Primer Combobox -->
                                        <div class="mb-3">
                                            <label for="combo1" class="form-label">Seleccionar Proceso</label>
                                            <select class="form-select" id="combo1">
                                                <option>Selecione proceso</option>
                                                <option>Compromiso</option>
                                                <option>Item 2</option>
                                                <option>Item 3</option>
                                                <option>Item 4</option>
                                                <option>Item 5</option>
                                            </select>
                                        </div>
                
                                        <!-- Segundo Combobox -->
                                        <div class="mb-3">
                                            <label for="combo2" class="form-label">Seleccionar notificacion</label>
                                            <select class="form-select" id="combo2">
                                                <option>Selecione notificacion</option>
                                                <option>Notificacion de tramites nuevos</option>
                                                <option>Item 2</option>
                                                <option>Item 3</option>
                                                <option>Item 4</option>
                                                <option>Item 5</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Ingrese Descripcion de la tarea</label>
                                            <textarea class="form-control" id="inputProductDescription" rows="3"></textarea>
                                          </div>
                                        <button type="button" class="btn btn-primary px-5">Registrar</button>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                
		<!--end page wrapper -->

@endsection
</html>