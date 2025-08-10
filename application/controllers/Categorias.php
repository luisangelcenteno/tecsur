<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Categorias extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			if(!$this->session->userdata('c_usuario') || !$this->session->userdata('c_perfil') || !$this->session->userdata('x_numero_doc') || !$this->session->userdata('x_nombre') || 
				!$this->session->userdata('x_ap_paterno') || !$this->session->userdata('x_ap_materno')){
				redirect('auth');
			}
			$this->load->model('Mcategoria');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && $this->session->userdata('c_perfil') == 1 && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				$data = array(
					'head' => $this->load->view('main/head', '', TRUE),
					'menu' => $this->load->view('main/menu', '', TRUE),
					'footer' => $this->load->view('main/footer', '', TRUE)
				);

				$this->load->view('administracion/categorias', $data);
			} else {
				show_404();
			}
		}

		public function lista(){
			if ($this->session->userdata('c_perfil')== 1) {
				if(!$data = $this->Mcategoria->mlista()){
					$data['data'] = array(0 => 'Problema en la consulta.', 1 => false);
				}
			} else {
				$data['data'] = array(0 => 'No tienes permiso para esta acción.', 1 => false);
			}
			echo json_encode($data);
		}
		
	}
