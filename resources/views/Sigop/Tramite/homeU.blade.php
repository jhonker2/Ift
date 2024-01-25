@extends('Tramite.base')
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

@section('content')
<!--start page wrapper -->
<!--start page wrapper -->

<div class="page-content">
	<!--breadcrumb-->

	<!--end breadcrumb-->


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

	
	<!--end page wrapper -->
	<!--end page wrapper -->

	@endsection

</html>