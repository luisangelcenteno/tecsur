<?php
	class Mauth extends CI_Model{
		
		public function __construct(){
			parent::__construct();
		}

		public function logueo($usuario, $password){
			$response['verify'] = false;
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('l.c_usuario, l.x_password, u.c_perfil, u.c_area, u.x_numero_doc, u.x_nombre, u.x_ap_paterno, u.x_ap_materno');
			$this->tecsur->from('login l');
			$this->tecsur->join('usuarios u', 'l.c_usuario = u.c_usuario');
			$this->tecsur->where('l.x_usuario', $usuario);
			$this->tecsur->where('u.l_estado', '1');
			$this->tecsur->limit(1);
			$query = $this->tecsur->get();
			$valida = $query->num_rows();
			if ($valida == 1) {
				$row = $query->row();
				if (password_verify($password, $row->x_password)) {
					$response['verify'] = true;
					$response['c_usuario'] = $row->c_usuario;
					$response['c_perfil'] = $row->c_perfil;
					$response['c_area'] = $row->c_area;
					$response['x_numero_doc'] = $row->x_numero_doc;
					$response['x_nombre'] = $row->x_nombre;
					$response['x_ap_paterno'] = $row->x_ap_paterno;
					$response['x_ap_materno'] = $row->x_ap_materno;
				} else {
					$response['msg'] = 'Contraseña incorrecta, intente nuevamente.';
				}
			} else {
				$response['msg'] = 'Usuario no registrado en el sistema.';
			}
			$this->tecsur->close();
			return $response;
		}

		public function mpassword($password, $c_usuario) {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'x_password' => $password,
				'c_auditor' => $c_usuario
			);
			$data = $this->tecsur->update('login', $data, array('c_usuario' => $c_usuario));
			$response = $this->tecsur->affected_rows();
			if($response){
				$validator['verify'] = true;
				$validator['msg'] = 'Actualizado correctamente.';
			} else {
				$validator['verify'] = false;
				$validator['msg'] = 'No se actualizo la información.';
			}
			$this->tecsur->close();
			return $validator;
		}

	}
