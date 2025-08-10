<!DOCTYPE html>
<html lang="es">
<head>
	<title>Administración de usuarios TECSUR</title>
	<?= $head ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?= $menu ?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6"><h1>Usuarios</h1></div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Administración</li>
								<li class="breadcrumb-item active">Usuarios</li>
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
										<button type="button" class="btn btn-tool" title="Registrar usuario" id="btnRegistrarUsuario"><i class="fas fa-plus"></i> Registrar usuario</button>
									</div>
								</div>
								<div class="card-body">
									<table id="tblUsuario" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>TIPO DOC.</th>
												<th>N° DOC</th>
												<th>NOMBRES</th>
												<th>AP. PATERNO</th>
												<th>AP. MATERNO</th>
												<th>ÁREA</th>
												<th>PERFIL</th>
												<th>CARGO</th>
												<th>CORREO</th>
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
								<ul><li id="x_usuario"></li></ul>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="c_usuario" name="c_usuario">
						<input type="hidden" id="n_valor" name="n_valor">
						<button type="button" class="btn btn-outline-danger btn-sm modalclose" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-danger btn-sm btnFrmCambio" id="btnFrmCambio"></button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-edit"></i> Cambiar contraseña</h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmPassword');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group row">
									<label for="pusuario" class="col-sm-5 col-form-label">Usuario: </label>
									<div class="col-sm-7">
										<input type="text" class="form-control form-control-sm text-uppercase text-center" id="pusuario" readonly>
									</div>
								</div>
								<div class="form-group row mb-0">
									<label for="ppassword" class="col-sm-5 col-form-label">Nueva contraseña: <b class="text-danger">(*)</b></label>
									<div class="col-sm-7">
										<input type="password" class="form-control form-control-sm text-uppercase" id="ppassword" name="ppassword">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="pc_usuario" name="pc_usuario">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-success btn-sm btnFrmPassword"><i class="fa fa-edit"></i> Cambiar</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-user"></i> Registrar usuario</h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmRegistrar');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group row">
									<label for="nperfil" class="col-sm-4 col-form-label">Perfil:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm nperfil" id="nperfil" name="nperfil"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="ncargo" class="col-sm-4 col-form-label">Cargo:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm ncargo" id="ncargo" name="ncargo"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="narea" class="col-sm-4 col-form-label">Área:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm narea" id="narea" name="narea"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="ntdocumento" class="col-sm-4 col-form-label">Tipo documento:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm ntdocumento" id="ntdocumento" name="ntdocumento"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="nndocumento" class="col-sm-4 col-form-label">N° documento:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="nndocumento" name="nndocumento">
									</div>
								</div>
								<div class="form-group row">
									<label for="nnombre" class="col-sm-4 col-form-label">Nombres:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="nnombre" name="nnombre">
									</div>
								</div>
								<div class="form-group row">
									<label for="nappaterno" class="col-sm-4 col-form-label">Apellido paterno:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="nappaterno" name="nappaterno">
									</div>
								</div>
								<div class="form-group row">
									<label for="napmaterno" class="col-sm-4 col-form-label">Apellido materno:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="napmaterno" name="napmaterno">
									</div>
								</div>
								<div class="form-group row mb-0">
									<label for="ncorreo" class="col-sm-4 col-form-label">Correo:</label>
									<div class="col-sm-8">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm text-uppercase" id="ncorreo" name="ncorreo">
											<div class="input-group-append"><span class="input-group-text">@utp.edu.pe</span></div>
										</div>
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
								<div class="form-group row">
									<label for="eperfil" class="col-sm-4 col-form-label">Perfil:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm nperfil" id="eperfil" name="eperfil"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="ecargo" class="col-sm-4 col-form-label">Cargo:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm ncargo" id="ecargo" name="ecargo"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="earea" class="col-sm-4 col-form-label">Área:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm narea" id="earea" name="earea"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="etdocumento" class="col-sm-4 col-form-label">Tipo documento:</label>
									<div class="col-sm-8">
										<select class="form-control form-control-sm ntdocumento" id="etdocumento" name="etdocumento"></select>
									</div>
								</div>
								<div class="form-group row">
									<label for="endocumento" class="col-sm-4 col-form-label">N° documento:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="endocumento" name="endocumento">
									</div>
								</div>
								<div class="form-group row">
									<label for="enombre" class="col-sm-4 col-form-label">Nombres:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="enombre" name="enombre">
									</div>
								</div>
								<div class="form-group row">
									<label for="eappaterno" class="col-sm-4 col-form-label">Apellido paterno:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="eappaterno" name="eappaterno">
									</div>
								</div>
								<div class="form-group row">
									<label for="eapmaterno" class="col-sm-4 col-form-label">Apellido materno:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control form-control-sm text-uppercase" id="eapmaterno" name="eapmaterno">
									</div>
								</div>
								<div class="form-group row mb-0">
									<label for="ecorreo" class="col-sm-4 col-form-label">Correo:</label>
									<div class="col-sm-8">
										<div class="input-group input-group-sm">
											<input type="text" class="form-control form-control-sm text-uppercase" id="ecorreo" name="ecorreo">
											<div class="input-group-append"><span class="input-group-text">@utp.edu.pe</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="ec_usuario" name="ec_usuario">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-success btn-sm btnFrmEditar"><i class="fa fa-edit"></i> Editar</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<?= $footer ?>
		<script src="<?=base_url('assets/js/usuario.js')?>"></script>

</body>
</html>
