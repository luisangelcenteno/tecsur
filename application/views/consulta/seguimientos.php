<!DOCTYPE html>
<html lang="es">
<head>
	<title>Consulta, seguimiento de incidencias TECSUR</title>
	<?= $head ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?= $menu ?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6"><h1>Seguimiento de incidencias</h1></div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Consulta</li>
								<li class="breadcrumb-item active">Seguimiento de incidencias</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
							<div class="card card-info card-outline">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-search"></i> Búsqueda General</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12">
											<div class="form-group row">
												<label for="area" class="col-sm-4 col-form-label">Áreas:</label>
												<div class="col-sm-8">
													<select class="form-control form-control-sm narea" id="area" name="area"></select>
												</div>
											</div>
											<div class="form-group row mb-0">
												<label for="estado" class="col-sm-4 col-form-label">Estado:</label>
												<div class="col-sm-8">
													<select class="form-control form-control-sm" id="estado" name="estado">
														<option value="0">TODOS</option>
														<option value="1">PENDIENTES</option>
														<option value="2">ATENDIDOS</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button class="btn btn-primary btn-sm float-right" id="btnBuscar"><i class="fa fa-search"></i> BUSCAR</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="content">
				<div class="container-fluid">
					<div class="card card-info card-outline">
						<div class="card-body table-responsive">
							<div class="row">
								<div class="col-12">
									<table id="tblRac" class="table table-bordered table-striped" width="100%">
										<thead>
											<tr>
												<th>FECHA</th>
												<th>TIPO ESTANDAR</th>
												<th>CATEGORÍA</th>
												<th>ÁREA QUE REGISTRA</th>
												<th>ÁREA QUE ATIENDE</th>
												<th>SST</th>
												<th>UBICACIÓN</th>
												<th>DESCRIPCIÓN</th>
												<th>RECOMENDACIÓN</th>
												<th>ESTADO</th>
												<th></th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		

		<?= $footer ?>
		<script src="<?=base_url('assets/js/seguimiento.js')?>"></script>

</body>
</html>
