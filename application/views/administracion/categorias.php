<!DOCTYPE html>
<html lang="es">
<head>
	<title>Administración de categorías TECSUR</title>
	<?= $head ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?= $menu ?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6"><h1>Categorías</h1></div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Administración</li>
								<li class="breadcrumb-item active">Categorías</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-md-12 col-lg-9">
							<div class="card">
								<div class="card-header">
									<div class="card-tools">
										<button type="button" class="btn btn-tool" title="Registrar categoría" id="btnRegistrarCategoria"><i class="fas fa-plus"></i> Registrar categoría</button>
									</div>
								</div>
								<div class="card-body">
									<table id="tblCategoria" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>N°</th>
												<th>FECHA DE REGISTRO</th>
												<th>DESCRIPCIÓN</th>
												<th>ESTADO</th>
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
		<script src="<?=base_url('assets/js/categoria.js')?>"></script>

</body>
</html>
