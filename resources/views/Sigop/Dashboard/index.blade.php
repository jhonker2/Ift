@extends('Sigop.Tramite.base')

@section('css')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    #container {
        height: 400px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
@endsection
@section('content')
<div>
    <div class="card shadow-none bg-transparent">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h4 class="mb-3 mb-md-0">Compromisos</h4>
                </div>
                <div class="col-md-9">
                    <form class="float-md-end">
                        <div class="row row-cols-md-auto g-lg-3">
                            <label for="inputFromDate" class="col-md-2 col-form-label text-md-end">Desde:</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="inputFromDate">
                            </div>
                            <label for="inputToDate" class="col-md-2 col-form-label text-md-end">Hasta:</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="inputToDate">
                            </div>
                        </div>
                        <div>
                            <button>buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body" style="position: relative;">

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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">

                    <figure class="highcharts-figure">
                        <div id="c_fuentes"></div>

                    </figure>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="c_tfuentes"></div>

                    </figure>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection @section('js')
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

    _AJAX_('/get_series_fuentes', 'GET', '', '', 6);
    _AJAX_('/get_series_tfuentes', 'GET', '', '', 7);



</script>
@endsection