<!DOCTYPE html>
<html lang="es">
<head>
	<title>Dasdhboard TECSUR</title>
	<?= $head ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?= $menu ?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6"><h1>Dashboard</h1></div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item">Tecsur</li>
								<li class="breadcrumb-item active">Dashboard</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			
			<section class="content">
				<div class="container-fluid">
					<?php if ($this->session->c_perfil == 1) { ?>
					<h5 class="mb-2">Administración</h5>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?=base_url('areas')?>" title="Áreas">
								<div class="info-box">
									<span class="info-box-icon bg-info"><i class="fas fa-id-card"></i></span>
									<div class="info-box-content"><span class="info-box-text">Áreas</span></div>
								</div>
							</a>
						</div>
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?=base_url('cargos')?>" title="Cargos">
								<div class="info-box">
									<span class="info-box-icon bg-success"><i class="fas fa-university"></i></span>
									<div class="info-box-content"><span class="info-box-text">Cargos</span></div>
								</div>
							</a>
						</div>
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?=base_url('categorias')?>" title="Categorías">
								<div class="info-box">
									<span class="info-box-icon bg-warning"><i class="fas fa-list-alt"></i></span>
									<div class="info-box-content"><span class="info-box-text">Categorías</span></div>
								</div>
							</a>
						</div>
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?=base_url('usuarios')?>" title="Usuarios">
								<div class="info-box">
									<span class="info-box-icon bg-danger"><i class="fas fa-users"></i></span>
									<div class="info-box-content"><span class="info-box-text">Usuarios</span></div>
								</div>
							</a>
						</div>
					</div>
					<?php } if ($this->session->c_perfil == 1 || $this->session->c_perfil == 2) { ?>
					<h5 class="mb-2">Gestión de incidencias</h5>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?=base_url('registros')?>" title="Registro y seguimiento">
								<div class="info-box">
									<span class="info-box-icon bg-success"><i class="fas fa-registered"></i></span>
									<div class="info-box-content"><span class="info-box-text">Registro y seguimiento</span></div>
								</div>
							</a>
						</div>
					</div>
					<?php } if ($this->session->c_perfil == 1 || $this->session->c_perfil == 3) { ?>
					<h5 class="mb-2">Consultas generales</h5>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-12">
							<a href="<?=base_url('seguimientos')?>" title="Seguimiento de incidencias">
								<div class="info-box">
									<span class="info-box-icon bg-warning"><i class="fas fa-search-plus"></i></span>
									<div class="info-box-content"><span class="info-box-text">Seguimiento de incidencias</span></div>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
					<h5 class="mb-2">Ayuda</h5>
					<div class="row">
						<div class="col-md-3 col-sm-6 col-12">
							<div class="info-box">
								<span class="info-box-icon bg-primary"><i class="fas fa-key"></i></span>
								<div class="info-box-content"><span class="info-box-text">Cambiar contraseña</span></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?= $footer ?>

</body>
</html>
