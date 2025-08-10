<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Areas extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			if(!$this->session->userdata('c_usuario') || !$this->session->userdata('c_perfil') || !$this->session->userdata('x_numero_doc') || !$this->session->userdata('x_nombre') || 
				!$this->session->userdata('x_ap_paterno') || !$this->session->userdata('x_ap_materno')){
				redirect('auth');
			}
			$this->load->model('Marea');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && $this->session->userdata('c_perfil') == 1 && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				$data = array(
					'head' => $this->load->view('main/head', '', TRUE),
					'menu' => $this->load->view('main/menu', '', TRUE),
					'footer' => $this->load->view('main/footer', '', TRUE)
				);

				$this->load->view('administracion/areas', $data);
			} else {
				show_404();
			}
		}

		public function lista(){
			if ($this->session->userdata('c_perfil') == 1) {
				if(!$data = $this->Marea->mlista()){
					$data['data'] = array(0 => 'Problema en la consulta.', 1 => false);
				}
			} else {
				$data['data'] = array(0 => 'No tienes permiso para esta acción.', 1 => false);
			}
			echo json_encode($data);
		}

		public function cambio(){
			if ($this->session->userdata('c_perfil') == 1) {
				$c_area = filter_input(INPUT_POST, 'c_area', FILTER_SANITIZE_STRING);
				$n_valor = (int) filter_input(INPUT_POST, 'n_valor', FILTER_VALIDATE_INT);

				if ($n_valor == 0 || $n_valor == 1) {
					if(!$response = $this->Marea->mcambio($c_area, $n_valor, $this->session->c_usuario)){
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

		public function registrar(){
			if ($this->session->userdata('c_perfil') == 1) {
				$descripcion = filter_input(INPUT_POST, 'rdescripcion', FILTER_SANITIZE_STRING);
				
				if(!$response = $this->Marea->store($descripcion, $this->session->c_usuario)){
					$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}
		
		public function editar(){
			if ($this->session->userdata('c_perfil') == 1) {
				$descripcion = filter_input(INPUT_POST, 'edescripcion', FILTER_SANITIZE_STRING);
				$carea = filter_input(INPUT_POST, 'ec_area', FILTER_SANITIZE_STRING);
				
				if(!$response = $this->Marea->edit($descripcion, $carea, $this->session->c_usuario)){
					$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}

	}
