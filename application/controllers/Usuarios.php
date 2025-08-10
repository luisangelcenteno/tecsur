<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Usuarios extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			if(!$this->session->userdata('c_usuario') || !$this->session->userdata('c_perfil') || !$this->session->userdata('x_numero_doc') || !$this->session->userdata('x_nombre') || 
				!$this->session->userdata('x_ap_paterno') || !$this->session->userdata('x_ap_materno')){
				redirect('auth');
			}
			$this->load->model('Musuario');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && $this->session->userdata('c_perfil') == 1 && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				$data = array(
					'head' => $this->load->view('main/head', '', TRUE),
					'menu' => $this->load->view('main/menu', '', TRUE),
					'footer' => $this->load->view('main/footer', '', TRUE)
				);

				$this->load->view('administracion/usuarios', $data);
			} else {
				show_404();
			}
		}

		public function perfil(){
			if ($this->session->userdata('c_perfil') == 1) {
				if(!$data = $this->Musuario->mperfil()){
					$this->output->set_status_header(401);
					exit;
				}
				echo json_encode($data);
			} else {
				$this->output->set_status_header(403);
				exit();
			}
		}

		public function cargo(){
			if ($this->session->userdata('c_perfil') == 1) {
				if(!$data = $this->Musuario->mcargo()){
					$this->output->set_status_header(401);
					exit;
				}
				echo json_encode($data);
			} else {
				$this->output->set_status_header(403);
				exit();
			}
		}

		public function area(){
			if ($this->session->userdata('c_perfil') == 1) {
				if(!$data = $this->Musuario->marea()){
					$this->output->set_status_header(401);
					exit;
				}
				echo json_encode($data);
			} else {
				$this->output->set_status_header(403);
				exit();
			}
		}

		public function tdocumento(){
			if ($this->session->userdata('c_perfil') == 1) {
				if(!$data = $this->Musuario->mtdocumento()){
					$this->output->set_status_header(401);
					exit;
				}
				echo json_encode($data);
			} else {
				$this->output->set_status_header(403);
				exit();
			}
		}

		public function lista(){
			if ($this->session->userdata('c_perfil') == 1) {
				if(!$data = $this->Musuario->mlista()){
					$data['data'] = array(0 => 'Problema en la consulta.', 1 => false);
				}
			} else {
				$data['data'] = array(0 => 'No tienes permiso para esta acción.', 1 => false);
			}
			echo json_encode($data);
		}

		public function cambio(){
			if ($this->session->userdata('c_perfil') == 1) {
				$c_usuario = filter_input(INPUT_POST, 'c_usuario', FILTER_SANITIZE_STRING);
				$n_valor = (int) filter_input(INPUT_POST, 'n_valor', FILTER_VALIDATE_INT);

				if ($n_valor == 0 || $n_valor == 1) {
					if(!$response = $this->Musuario->mcambio($c_usuario, $n_valor, $this->session->c_usuario)){
						$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
					}
				} else {
					$response = array('verify' => false, 'msg' => 'Valor de proceso incorrecto.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}

		public function password(){
			if ($this->session->userdata('c_perfil') == 1) {
				$password = filter_input(INPUT_POST, 'ppassword', FILTER_SANITIZE_STRING);
				$cusuario = filter_input(INPUT_POST, 'pc_usuario', FILTER_SANITIZE_STRING);
				
				if(!$response = $this->Musuario->mpassword($password, $cusuario, $this->session->c_usuario)){
					$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}

		public function registrar(){
			if ($this->session->userdata('c_perfil') == 1) {
				$nperfil = filter_input(INPUT_POST, 'nperfil', FILTER_SANITIZE_STRING);
				$ncargo = filter_input(INPUT_POST, 'ncargo', FILTER_SANITIZE_STRING);
				$narea = filter_input(INPUT_POST, 'narea', FILTER_SANITIZE_STRING);
				$ntdocumento = filter_input(INPUT_POST, 'ntdocumento', FILTER_SANITIZE_STRING);
				$nndocumento = filter_input(INPUT_POST, 'nndocumento', FILTER_SANITIZE_STRING);
				$nnombre = filter_input(INPUT_POST, 'nnombre', FILTER_SANITIZE_STRING);
				$nappaterno = filter_input(INPUT_POST, 'nappaterno', FILTER_SANITIZE_STRING);
				$napmaterno = filter_input(INPUT_POST, 'napmaterno', FILTER_SANITIZE_STRING);
				$ncorreo = filter_input(INPUT_POST, 'ncorreo', FILTER_SANITIZE_STRING);

				$cusuario = $this->Musuario->max_store();
				
				if(!$response = $this->Musuario->store($cusuario, $nperfil, $ncargo, $narea, $ntdocumento, $nndocumento, $nnombre, $nappaterno, $napmaterno, $ncorreo, $this->session->c_usuario)){
					$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}

		public function user(){
			if ($this->session->userdata('c_perfil') == 1) {
				$cusuario = filter_input(INPUT_POST, 'cusuario', FILTER_SANITIZE_STRING);
				$response = $this->Musuario->muser($cusuario);
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}

		public function editar(){
			if ($this->session->userdata('c_perfil') == 1) {
				$nperfil = filter_input(INPUT_POST, 'eperfil', FILTER_SANITIZE_STRING);
				$ncargo = filter_input(INPUT_POST, 'ecargo', FILTER_SANITIZE_STRING);
				$narea = filter_input(INPUT_POST, 'earea', FILTER_SANITIZE_STRING);
				$ntdocumento = filter_input(INPUT_POST, 'etdocumento', FILTER_SANITIZE_STRING);
				$nndocumento = filter_input(INPUT_POST, 'endocumento', FILTER_SANITIZE_STRING);
				$nnombre = filter_input(INPUT_POST, 'enombre', FILTER_SANITIZE_STRING);
				$nappaterno = filter_input(INPUT_POST, 'eappaterno', FILTER_SANITIZE_STRING);
				$napmaterno = filter_input(INPUT_POST, 'eapmaterno', FILTER_SANITIZE_STRING);
				$ncorreo = filter_input(INPUT_POST, 'ecorreo', FILTER_SANITIZE_STRING);
				$cusuario = filter_input(INPUT_POST, 'ec_usuario', FILTER_SANITIZE_STRING);
				
				if(!$response = $this->Musuario->edit($cusuario, $nperfil, $ncargo, $narea, $ntdocumento, $nndocumento, $nnombre, $nappaterno, $napmaterno, $ncorreo, $this->session->c_usuario)){
					$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}
		
	}
