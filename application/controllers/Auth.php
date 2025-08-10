<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('Mauth');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && $this->session->userdata('c_perfil') && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				redirect('main');
			} else {
				$this->load->view('login');
			}
		}

		public function validate(){
			$this->form_validation->set_error_delimiters('', '');
			$usuario = filter_input(INPUT_POST, 'x_usuario', FILTER_SANITIZE_STRING);
			$password = filter_input(INPUT_POST, 'x_password', FILTER_SANITIZE_STRING);
			
			$response = $this->Mauth->logueo($usuario, $password);
			
			if ($response['verify']) {
				$response['url'] = base_url('main');
				$data = array(
					'c_usuario' => $response['c_usuario'],
					'c_perfil' => $response['c_perfil'],
					'c_area' => $response['c_area'],
					'x_numero_doc' => $response['x_numero_doc'],
					'x_nombre' => $response['x_nombre'],
					'x_ap_paterno' => $response['x_ap_paterno'],
					'x_ap_materno' => $response['x_ap_materno']
				);
				$this->session->set_userdata($data);
			}
			echo json_encode($response);
		}

		public function logout(){
			$vars = array('c_usuario', 'c_perfil', 'c_area', 'x_numero_doc', 'x_nombre', 'x_ap_paterno', 'x_ap_materno');
			$this->session->unset_userdata($vars);
			$this->session->sess_destroy();
			redirect('auth');
		}

	}
