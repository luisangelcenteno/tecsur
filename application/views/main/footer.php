	<footer class="main-footer">
		<div class="float-right d-none d-sm-block"><b>Version</b> 1.0.0</div>
		<strong>Copyright &copy; 2024 <a href="#!">Integrador I</a>.</strong> Todos los derechos reservados.
	</footer>

	<div class="modal fade" id="modalCambioPassword" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="fa fa-edit"></i> Cambiar contraseña</h5>
				</div>
				<?php
				$attributes = array('autocomplete' => 'off', 'id' => 'frmCambioPassword');
				echo form_open(null, $attributes);
				?>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group row">
								<label for="miusuario" class="col-sm-5 col-form-label">Usuario: </label>
								<div class="col-sm-7">
									<input type="text" class="form-control form-control-sm text-uppercase text-center" id="miusuario" value="<?php echo $this->session->userdata('x_nombre').' '.$this->session->userdata('x_ap_paterno') ?>" readonly>
								</div>
							</div>
							<div class="form-group row mb-0">
								<label for="mipassword" class="col-sm-5 col-form-label">Nueva contraseña: <b class="text-danger">(*)</b></label>
								<div class="col-sm-7">
									<input type="password" class="form-control form-control-sm text-uppercase" id="mipassword" name="mipassword">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="fa fa-window-close"></i> Cancelar</button>
					<button type="submit" class="btn btn-success btn-sm btnFrmCambioPassword"><i class="fa fa-edit"></i> Cambiar</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalReporte" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fa fa-file"></i> Reporte de incidencia </h5>
				<a type="button" class="btn btn-danger btn-sm" data-dismiss="modal" title="Cerrar"><i class="fa fa-times"></i></a>
			</div>
			<div class="modal-body">
				<iframe class="iframeReporte" width="100%" height="600px" align="middle"></iframe>
			</div>
			<div class="modal-footer"></div>
		</div>
		</div>
	</div>
	
</div>

<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/notify/bootstrap-notify.min.js')?>"></script>
<script src="<?=base_url('assets/js/module/buttons.js')?>"></script>



<script src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jszip/jszip.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/pdfmake/pdfmake.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/pdfmake/vfs_fonts.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>

<script src="<?=base_url('assets/js/adminlte.min.js')?>"></script>

<script src="<?=base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')?>"></script>
