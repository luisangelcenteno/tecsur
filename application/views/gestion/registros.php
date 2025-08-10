<!DOCTYPE html>
<html lang="es">
<head>
	<title>Gestión de registro y seguimiento de incidencias TECSUR</title>
	<?= $head ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?= $menu ?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6"><h1>Registro y seguimiento</h1></div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Gestión</li>
								<li class="breadcrumb-item active">Registro y seguimiento</li>
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
									<div class="card-tools">
										<button type="button" class="btn btn-tool" title="Registrar incidencia" id="btnRegistrar"><i class="fas fa-plus"></i> Registrar incidencia</button>
									</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-12">
											<div class="form-group row">
												<label for="tipo" class="col-sm-4 col-form-label">Tipo solicitud:</label>
												<div class="col-sm-8">
													<select class="form-control form-control-sm" id="tipo" name="tipo">
														<option value="0">TODOS</option>
														<option value="1">INCIDENCIA REGISTRADA POR MI ÁREA</option>
														<option value="2">INCIDENCIA REPORTADA A MI ÁREA</option>
													</select>
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

		<div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-save"></i> Reporte de actos y condiciones subestándares</h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmRegistrar');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-5">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="nfecha">Fecha: <b class="text-danger">(*)</b></label>
											<input type="date" class="form-control form-control-sm" id="nfecha" name="nfecha">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="nsst">N° SST:</label>
											<input type="text" class="form-control form-control-sm" id="nsst" name="nsst">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="nubicacion">Ubicación: <b class="text-danger">(*)</b></label>
											<input type="text" class="form-control form-control-sm" id="nubicacion" name="nubicacion">
										</div>
										<div class="form-group">
											<label for="nubicacion">Tipo: <b class="text-danger">(*)</b></label>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ntipo" value="2">
												<label class="form-check-label">ACTO SUBESTANDAR</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ntipo" value="1">
												<label class="form-check-label">CONDICION SUBESTANDAR</label>
											</div>
										</div>
										<div class="form-group">
											<label for="nubicacion">Categoría: <b class="text-danger">(*)</b></label>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="1">
												<label class="form-check-label">VEHÍCULOS</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="2">
												<label class="form-check-label">INSTALACIONES (ESTRUC, OFICINAS. ALMACENES, ELÉCTRICAS)</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="3">
												<label class="form-check-label">EQUIPOS, HERRAMIENTAS Y/O MÁQUINAS</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="4">
												<label class="form-check-label">SEÑALIZACIÓN</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="5">
												<label class="form-check-label">ORDEN Y LIMPIEZA</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="6">
												<label class="form-check-label">MOBILIARIO (SILLAS, MESAS, ESCRITORIOS, ESTANTES)</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="7">
												<label class="form-check-label">MANEJO DE RESIDUOS (PELIGROSO / NO PELIGROSO)</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="8">
												<label class="form-check-label">ELEMENTOS DE EMERGENCIA (EXTINTOR, BOTIQUIN, CAMILLAS)</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="9">
												<label class="form-check-label">EQUIPO DE PROTECCIÓN PERSONAL (EPP)</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="10">
												<label class="form-check-label">MANIPULACIÓN DE CARGAS (CON EQUIPO Y/O MANUAL)</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="11">
												<label class="form-check-label">OTROS</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="ncategoria" value="12">
												<label class="form-check-label">DOCUMENTOS RELACIONADOS A LA ACTIVIDAD</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="ndescripcion">Descripción: <b class="text-danger">(*)</b></label>
											<textarea class="form-control" name="ndescripcion" id="ndescripcion" rows="3"></textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="nelemento">Elemento observado: </label>
											<input type="text" class="form-control form-control-sm" name="nelemento" id="nelemento">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="nareas">Área/Dpto/Gerencia: <b class="text-danger">(*)</b></label>
											<select class="form-control form-control-sm narea" name="nareas" id="nareas"></select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="nadjuntar">Adjuntar imagen: <b class="text-danger">(Opcional PNG, JPEG)</b></label>
											<div class="input-group">
												<div class="custom-file">
													<label class="custom-file-label" for="nadjuntar">Seleccionar imagen</label>
													<input type="file" class="custom-file-input" name="nadjuntar" id="nadjuntar" accept="image/png, image/jpeg">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-primary btn-sm btnFrmRegistrar"><i class="fa fa-save"></i> Grabar</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalAtender" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><i class="fa fa-edit"></i> Atender incidencia</h5>
					</div>
					<?php
					$attributes = array('autocomplete' => 'off', 'id' => 'frmAtender');
					echo form_open(null, $attributes);
					?>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group row mb-0">
									<label for="arecomendacion" class="col-sm-5 col-form-label">Recomendación: <b class="text-danger">(*)</b></label>
									<div class="col-sm-7">
										<textarea class="form-control" id="arecomendacion" name="arecomendacion" rows="3"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" id="c_rac" name="c_rac">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
						<button type="submit" class="btn btn-success btn-sm btnFrmAtender"><i class="fa fa-save"></i> Atender</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<?= $footer ?>
		<script src="<?=base_url('assets/js/registro.js')?>"></script>

</body>
</html>
