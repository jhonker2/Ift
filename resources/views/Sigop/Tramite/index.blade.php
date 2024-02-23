@extends('Sigop.Tramite.base') @section('content')
    <div class="page-content">
        <hr />
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Tramites Completados</p>
                                <h5 class="mb-0">5</h5>
                            </div>
                        </div>
                        <div class="" id="chart2"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Tramites >10 Dias</p>
                                <h5 class="mb-0">0</h5>
                            </div>
                        </div>
                        <div class="" id="chart3"></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Tramites en Ejecucion</p>
                                <h5 class="mb-0">0</h5>
                            </div>
                        </div>
                        <div class="" id="chart5"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card radius-10">
            <div class="card-body">
                <div class="table-responsive lead-table">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Personal</th>
                                <th>Tramites</th>
                                <th>Progresos</th>
                                <th>Ultima actualizacion</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img src="img/person.png" class="rounded-circle" width="40" height="40"
                                                alt="" />
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">
                                                <?php echo e(session('SESSION_USER', 'Usuario por defecto')); ?>
                                            </h6>
                                            <p class="mb-0 font-13 text-secondary">
                                                <?php echo e(session('SESSION_ID', 'ID por defecto')); ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>0</td>
                                <td class="w-25">
                                    <div class="progress radius-10" style="height: 5px">
                                        <div class="progress-bar bg-primary w-75" role="progressbar"></div>
                                    </div>
                                </td>
                                <td>14 Oct 2023</td>
                                <td>
                                    <div class="badge rounded-pill bg-primary w-100">
                                        En proceso
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img src="img/person.png" class="rounded-circle" width="40" height="40"
                                                alt="" />
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">David Buckley</h6>
                                            <p class="mb-0 font-13 text-secondary"></p>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td class="w-25">
                                    <div class="progress radius-10" style="height: 5px">
                                        <div class="progress-bar bg-danger w-50" role="progressbar"></div>
                                    </div>
                                </td>
                                <td>15 Oct 2023</td>
                                <td>
                                    <div class="badge rounded-pill bg-danger w-100">Atrasado</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img src="img/person.png" class="rounded-circle" width="40" height="40"
                                                alt="" />
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">James Caviness</h6>
                                            <p class="mb-0 font-13 text-secondary"></p>
                                        </div>
                                    </div>
                                </td>
                                <td>2</td>
                                <td class="w-25">
                                    <div class="progress radius-10" style="height: 5px">
                                        <div class="progress-bar bg-success w-100" role="progressbar"></div>
                                    </div>
                                </td>
                                <td>16 Oct 2023</td>
                                <td>
                                    <div class="badge rounded-pill bg-success w-100">
                                        Completado
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img src="img/person.png" class="rounded-circle" width="40" height="40"
                                                alt="" />
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">John Roman</h6>
                                            <p class="mb-0 font-13 text-secondary"></p>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td class="w-25">
                                    <div class="progress radius-10" style="height: 5px">
                                        <div class="progress-bar bg-primary w-50" role="progressbar"></div>
                                    </div>
                                </td>
                                <td>18 Oct 2023</td>
                                <td>
                                    <div class="badge rounded-pill bg-primary w-100">
                                        En proceso
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img src="img/person.png" class="rounded-circle" width="40" height="40"
                                                alt="" />
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">Johnny Seitz</h6>
                                            <p class="mb-0 font-13 text-secondary"></p>
                                        </div>
                                    </div>
                                </td>
                                <td>2</td>
                                <td class="w-25">
                                    <div class="progress radius-10" style="height: 5px">
                                        <div class="progress-bar bg-danger w-50" role="progressbar"></div>
                                    </div>
                                </td>
                                <td>22 Oct 2023</td>
                                <td>
                                    <div class="badge rounded-pill bg-danger w-100">Atrasado</div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <img src="img/person.png" class="rounded-circle" width="40"
                                                height="40" alt="" />
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14">Pauline Bird</h6>
                                            <p class="mb-0 font-13 text-secondary"></p>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td class="w-25">
                                    <div class="progress radius-10" style="height: 5px">
                                        <div class="progress-bar bg-success w-100" role="progressbar"></div>
                                    </div>
                                </td>
                                <td>24 Oct 2023</td>
                                <td>
                                    <div class="badge rounded-pill bg-success w-100">
                                        Completado
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
