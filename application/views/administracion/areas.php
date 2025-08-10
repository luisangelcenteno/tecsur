<!DOCTYPE html>
<html lang="es">
<head>
	<title>Administración de áreas TECSUR</title>
	<?= $head ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?= $menu ?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6"><h1>Áreas </h1></div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Administración</li>
								<li class="breadcrumb-item active">Áreas</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<div class="card-tools">
										<button type="button" class="btn btn-tool" title="Registrar área" id="btnRegistrarArea"><i class="fas fa-plus"></i> Registrar área</button>
									</div>
								</div>
								<div class="card-body">
									<table id="tblArea" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>N°</th>
												<th>FECHA DE REGISTRO</th>
												<th>DESCRIPCIÓN</th>
												<th>ESTADO</th>
												<th>OPERACIONES</th>
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

		<div class="modal fade" id="modalCambio" tabindex="-1" role="dialog" data-backdrop="static">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="titleCambio"></h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmCambio');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<p id="mensaje" class="text-uppercase"></p>
								<ul><li id="x_area"></li></ul>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="c_area" name="c_area">
						<input type="hidden" id="n_valor" name="n_valor">
						<button type="button" class="btn btn-outline-danger btn-sm modalclose" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-danger btn-sm btnFrmCambio" id="btnFrmCambio"></button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-save"></i> Registrar área</h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmRegistrar');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group row mb-0">
									<label for="rdescripcion" class="col-sm-5 col-form-label text-uppercase">Descripción: <b class="text-danger">(*)</b></label>
									<div class="col-sm-7">
										<input type="text" class="form-control form-control-sm" id="rdescripcion" name="rdescripcion">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-success btn-sm btnFrmRegistrar"><i class="fa fa-save"></i> Crear</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-edit"></i> Editar área</h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmEditar');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group row mb-0">
									<label for="edescripcion" class="col-sm-5 col-form-label">Descripción: <b class="text-danger">(*)</b></label>
									<div class="col-sm-7">
										<input type="text" class="form-control form-control-sm text-uppercase" id="edescripcion" name="edescripcion">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="ec_area" name="ec_area">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-success btn-sm btnFrmEditar"><i class="fa fa-edit"></i> Editar</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<?= $footer ?>
		<script src="<?=base_url('assets/js/area.js')?>"></script>

</body>
</html>
