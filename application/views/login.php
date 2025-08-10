<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TECSUR</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
		<link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
		<link rel="stylesheet" href="<?=base_url('assets/css/adminlte.min.css')?>">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="card card-outline card-primary">
				<div class="card-header text-center">
					<a href="/tecsur" class="h1"><b>TEC</b>SUR</a>
				</div>
				<div class="card-body">
					<p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>
					<?php
						$attributes = array('autocomplete' => 'off', 'id' => 'frmIngresar');
						echo form_open(null, $attributes);
					?>
						<div class="input-group mb-3">
							<input type="text" class="form-control x_input" placeholder="Usuario" name="x_usuario" id="x_usuario" minlength="9" maxlength="9" required>
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-user"></span></div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control x_input" placeholder="Contraseña" name="x_password" id="x_password" required>
							<div class="input-group-append">
								<div class="input-group-text"><span class="fas fa-lock"></span></div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-primary btn-block" id="btnIngresar">Ingresar</button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>

		<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
		<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
		<script src="<?=base_url('assets/js/adminlte.min.js')?>"></script>
		<script src="<?=base_url('assets/plugins/notify/bootstrap-notify.min.js')?>"></script>
		<script src="<?=base_url('assets/js/module/buttons.js')?>"></script>
		<script src="<?=base_url('assets/js/login.js')?>"></script>
	</body>
</html>
