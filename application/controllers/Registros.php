<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Registros extends CI_Controller{
		
		public function __construct(){
			parent::__construct();
			if(!$this->session->userdata('c_usuario') || !$this->session->userdata('c_perfil') || !$this->session->userdata('x_numero_doc') || !$this->session->userdata('x_nombre') ||
				!$this->session->userdata('x_ap_paterno') || !$this->session->userdata('x_ap_materno')){
				redirect('auth');
			}
			$this->load->library('reporte');
			$this->load->model('Mregistro');
		}

		public function index(){
			if($this->session->userdata('c_usuario') && ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 2) && $this->session->userdata('x_numero_doc') && $this->session->userdata('x_nombre') && $this->session->userdata('x_ap_paterno') && $this->session->userdata('x_ap_materno')){
				$data = array(
					'head' => $this->load->view('main/head', '', TRUE),
					'menu' => $this->load->view('main/menu', '', TRUE),
					'footer' => $this->load->view('main/footer', '', TRUE)
				);

				$this->load->view('gestion/registros', $data);
			} else {
				show_404();
			}
		}

		public function area(){
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 2) {
				if(!$data = $this->Mregistro->marea()){
					$this->output->set_status_header(401);
					exit;
				}
				echo json_encode($data);
			} else {
				$this->output->set_status_header(403);
				exit();
			}
		}

		public function rac(){
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 2) {
				$pathinfo = pathinfo($_FILES["nadjuntar"]["name"]);
		
				if (($pathinfo['extension'] == 'jpeg' || $pathinfo['extension'] == 'png') && $_FILES['nadjuntar']['size'] > 0  && $_FILES['nadjuntar']['size'] < 4097152) {
					date_default_timezone_set('America/Lima');
					$annio = date("Y"); $mes = date("m"); $dia = date("d"); $hora = date("H"); $minuto = date("i"); $segundo = date("s");
					$cadena = intval($annio.$mes.$dia.$hora.$minuto.$segundo);
					$name = $cadena.$this->session->c_usuario;

					$nfecha = filter_input(INPUT_POST, 'nfecha', FILTER_SANITIZE_STRING);
					$nsst = filter_input(INPUT_POST, 'nsst', FILTER_SANITIZE_STRING);
					$nubicacion = filter_input(INPUT_POST, 'nubicacion', FILTER_SANITIZE_STRING);
					$ntipo = filter_input(INPUT_POST, 'ntipo', FILTER_SANITIZE_STRING);
					$ncategoria = filter_input(INPUT_POST, 'ncategoria', FILTER_SANITIZE_STRING);
					$ndescripcion = filter_input(INPUT_POST, 'ndescripcion', FILTER_SANITIZE_STRING);
					$nelemento = filter_input(INPUT_POST, 'nelemento', FILTER_SANITIZE_STRING);
					$nareas = filter_input(INPUT_POST, 'nareas', FILTER_SANITIZE_STRING);

					$path = "upload";
					$extension = $pathinfo['extension'];
					$name = $name.'.'.$extension;
					$destino = $path."/".$name;

					$crac = $this->Mregistro->max_rac();

					$resultado = $this->Mregistro->mrac($crac, $nfecha, $nsst, $nubicacion, $ntipo, $ncategoria, $ndescripcion, $nelemento, $nareas, $name, $this->session->c_usuario, $this->session->c_area);
					if ($resultado == true) {
						if (copy($_FILES['nadjuntar']['tmp_name'], $destino)) {
							$resultado = true;
							$msg = "Se registro correctamente.";
						} else {
							$msg = "Registrado, sin guardar el archivo.";
							unlink($destino);
						}
					} else {
						$msg = "No se registro el RAC";
					}
					$response = array('msg' => $msg, 'verify' => $resultado);
				} else {
					$response = array('verify' => false, 'msg' => 'El archivo no esta permitido.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}

		public function racs(){
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 2) {
				$tipo = (int) filter_input(INPUT_POST, 'tipo', FILTER_VALIDATE_INT);
				$estado = (int) filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_INT);

				if ($tipo == 0 || $tipo == 1 || $tipo == 2) {
					if ($estado == 0 || $estado == 1 || $estado == 2) {
						if(!$data = $this->Mregistro->mracs($tipo, $estado, $this->session->c_area)){
							$data['data'] = array(0 => 'Problemas en la consulta', 1 => false);
						}
					}
				}
			} else {
				$data['data'] = array(0 => 'No tienes permiso.', 1 => false);
			}
			echo json_encode($data);
		}

		public function reporte($c_rac) {
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 2) {
				$c_rac = filter_var($c_rac, FILTER_VALIDATE_INT);
				$response = $this->Mregistro->reporte_incidencia($c_rac);
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

		public function atender(){
			if ($this->session->userdata('c_perfil') == 1 || $this->session->userdata('c_perfil') == 2) {
				$arecomendacion = filter_input(INPUT_POST, 'arecomendacion', FILTER_SANITIZE_STRING);
				$c_rac = filter_input(INPUT_POST, 'c_rac', FILTER_SANITIZE_STRING);
				
				if(!$response = $this->Mregistro->matender($arecomendacion, $c_rac, $this->session->c_usuario, $this->session->c_area)){
					$response = array('verify' => false, 'msg' => 'Error al continuar proceso.');
				}
			} else {
				$response = array('verify' => false, 'msg' => 'No tienes permiso para esta opción.');
			}
			echo json_encode($response);
		}
		
	}
