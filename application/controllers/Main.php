<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Main extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			if(!$this->session->userdata('c_usuario') || !$this->session->userdata('c_perfil') || !$this->session->userdata('x_numero_doc') || !$this->session->userdata('x_nombre') || 
				!$this->session->userdata('x_ap_paterno') || !$this->session->userdata('x_ap_materno')){
				redirect('auth');
			}
			$this->load->model('Mauth');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && $this->session->userdata('c_perfil') && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				$data = array(
					'head' => $this->load->view('main/head', '', TRUE),
					'menu' => $this->load->view('main/menu', '', TRUE),
					'footer' => $this->load->view('main/footer', '', TRUE)
				);

				$this->load->view('main', $data);
			} else {
				show_404();
			}
		}

		public function mipassword(){
			$password = filter_input(INPUT_POST, 'mipassword', FILTER_SANITIZE_STRING);
			
			if(!$response = $this->Mauth->mpassword($password, $this->session->c_usuario)){
				$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
			}
			echo json_encode($response);
		}
		
	}
