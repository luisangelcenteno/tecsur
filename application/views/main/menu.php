<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>
    <ul class="navbar-nav ml-auto">
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="/tecsur/auth/logout" role="button">Cerrar sesión</a>
		</li>
	</ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="/tecsur" class="brand-link"><span class="brand-text font-weight-light">SOFT TECSUR</span></a>
    <div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image"><img src="/tecsur/assets/img/user.png" class="img-circle elevation-2" alt="User Image"></div>
			<div class="info"><a href="#" class="d-block"><?php echo $this->session->userdata('x_nombre').' '.$this->session->userdata('x_ap_paterno') ?></a></div>
		</div>
		
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<?php if ($this->session->c_perfil == 1) { ?>
				<li class="nav-item menu-is-opening menu-open">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-cog"></i><p>Administración <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"><a href="<?=base_url('areas')?>" class="nav-link"><p>Áreas</p></a></li>
						<li class="nav-item"><a href="<?=base_url('cargos')?>" class="nav-link"><p>Cargos</p></a></li>
						<li class="nav-item"><a href="<?=base_url('categorias')?>" class="nav-link"><p>Categorías</p></a></li>
						<li class="nav-item"><a href="<?=base_url('usuarios')?>" class="nav-link"><p>Usuarios</p></a></li>
					</ul>
				</li>
				<?php } if ($this->session->c_perfil == 1 || $this->session->c_perfil == 2) { ?>
				<li class="nav-item menu-is-opening menu-open">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-registered"></i><p>Gestión de incidencias <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"><a href="<?=base_url('registros')?>" class="nav-link"><p>Registro y seguimiento</p></a></li>
					</ul>
				</li>
				<?php } if ($this->session->c_perfil == 1 || $this->session->c_perfil == 3) { ?>
				<li class="nav-item menu-is-opening menu-open">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-registered"></i><p>Consultas generales <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"><a href="<?=base_url('seguimientos')?>" class="nav-link"><p>Seguimiento de incidencias</p></a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="nav-item menu-is-opening menu-open">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-registered"></i><p>Ayuda <i class="right fas fa-angle-left"></i></p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item"><a href="#!" class="nav-link" id="menuCambioPassword"><p>Cambiar contraseña</p></a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</aside>
