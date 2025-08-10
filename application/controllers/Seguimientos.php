<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Seguimientos extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			if(!$this->session->userdata('c_usuario') || !$this->session->userdata('c_perfil') || !$this->session->userdata('x_numero_doc') || !$this->session->userdata('x_nombre') || 
				!$this->session->userdata('x_ap_paterno') || !$this->session->userdata('x_ap_materno')){
				redirect('auth');
			}
			$this->load->library('reporte');
			$this->load->model('Mseguimiento');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 3) && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				$data = array(
					'head' => $this->load->view('main/head', '', TRUE),
					'menu' => $this->load->view('main/menu', '', TRUE),
					'footer' => $this->load->view('main/footer', '', TRUE)
				);

				$this->load->view('consulta/seguimientos', $data);
			} else {
				show_404();
			}
		}

		public function area(){
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 3) {
				if(!$data = $this->Mseguimiento->marea()){
					$this->output->set_status_header(401);
					exit;
				}
				echo json_encode($data);
			} else {
				$this->output->set_status_header(403);
				exit();
			}
		}

		public function racs(){
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 3) {
				$area = (int) filter_input(INPUT_POST, 'area', FILTER_VALIDATE_INT);
				$estado = (int) filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_INT);

				if ($estado == 0 || $estado == 1 || $estado == 2) {
					if(!$data = $this->Mseguimiento->mracs($area, $estado)){
						$data['data'] = array(0 => 'Problemas en la consulta', 1 => false);
					}
				}
			} else {
				$data['data'] = array(0 => 'No tienes permiso.', 1 => false);
			}
			echo json_encode($data);
		}

		public function reporte($c_rac) {
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 3) {
				$c_rac = filter_var($c_rac, FILTER_VALIDATE_INT);
				$response = $this->Mseguimiento->reporte_incidencia($c_rac);
				$contador = $response['contador'];
				if ($contador == 1) {
					$pdf = new Reporte();
					$pdf->SetTitle('REPORTE DE INCIDENCIA');
					$pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetY(45);
					$pdf->informacion($response);
					$pdf->Output();
					$this->pdf->Output("reporte_de_incidencia.pdf", 'I');
				} else {
					echo "No se encontró el reporte.";
					exit();
				}
			} else {
				echo "No tienes permiso para ver el reporte.";
				exit();
			}
		}
		
	}
