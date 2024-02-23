@extends('Sigop.Tramite.base')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    </div>

    <button type="button" class="btn btn-primary px-5" onclick="location.href='compromiso.html'">Compromiso</button>
    <button type="button" class="btn btn-primary px-5" onclick="location.href='compromiso.html'">Prueba</button>

    <hr />
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
        <div class="col">
            <div class="card border-primary border-bottom border-3 border-0">
                <img src="assets/images/gallery/01.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-primary">TAREA 1</h5>
                    <p class="card-text">Descripcion</p>
                    <hr>
                    <div class="d-flex align-items-center gap-2">
                        <a href="javascript:;" class="btn btn-inverse-primary"><i class='bx bx-star'></i>Desactivar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-danger border-bottom border-3 border-0">
                <img src="assets/images/gallery/01.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-danger">TAREA 2</h5>
                    <p class="card-text">Descripcion</p>
                    <hr>
                    <div class="d-flex align-items-center gap-2">
                        <a href="javascript:;" class="btn btn-inverse-primary"><i class='bx bx-star'></i>Desactivar</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-success border-bottom border-3 border-0">
                <img src="assets/images/gallery/01.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-success">TAREA 3</h5>
                    <p class="card-text">Descripcion</p>
                    <hr>
                    <div class="d-flex align-items-center gap-2">
                        <a href="javascript:;" class="btn btn-inverse-primary"><i class='bx bx-star'></i>Desactivar</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-warning border-bottom border-3 border-0">
                <img src="assets/images/gallery/01.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-warning">TAREA 4</h5>
                    <p class="card-text">Descripcion</p>
                    <hr>
                    <div class="d-flex align-items-center gap-2">
                        <a href="javascript:;" class="btn btn-inverse-primary"><i class='bx bx-star'></i>Desactivar</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
