<?php

	class Musuario extends CI_Model{
		
		public function __construct(){
			parent::__construct();
		}

		public function mlista() {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('u.c_usuario, p.x_perfil, c.x_cargo, td.x_documento, a.x_area, u.x_numero_doc, u.x_nombre, u.x_ap_paterno, u.x_ap_materno, u.x_correo, u.l_estado');
			$this->tecsur->from('usuarios u');
			$this->tecsur->join('perfiles p', 'p.c_perfil = u.c_perfil');
			$this->tecsur->join('cargos c', 'c.c_cargo = u.c_cargo');
			$this->tecsur->join('tipo_documentos td', 'td.c_tipo_documento = u.c_tipo_documento');
			$this->tecsur->join('areas a', 'a.c_area = u.c_area');
			$this->tecsur->order_by('u.x_nombre', 'ASC');
			$query = $this->tecsur->get();
			if(!$query->result()){
				$data['data'] = false;
			} else {
				$item = 1;
				foreach ($query->result() as $row) {
					$c_usuario = $this->encryption->encrypt($row->c_usuario);
					$x_perfil = $row->x_perfil;
					$x_cargo = $row->x_cargo;
					$x_documento = $row->x_documento;
					$x_area = $row->x_area;
					$x_numero_doc = $row->x_numero_doc;
					$x_nombre = $row->x_nombre;
					$x_ap_paterno = $row->x_ap_paterno;
					$x_ap_materno = $row->x_ap_materno;
					$x_correo = $row->x_correo;
					$l_estado = $row->l_estado;

					switch ($l_estado) {
						case '0':
							$l_estado = '<span class="badge bg-danger"><i class="fa fa-check-circle"></i> INACTIVO</span>';
							$titulo = 'Activar usuario';
							$icon = 'check';
							$valor = 1;
							$class_button = 'success';
							$btnEditar = '';
							break;
						case '1':
							$l_estado = '<span class="badge bg-success"><i class="fa fa-check-circle"></i> ACTIVO</span>';
							$titulo = 'Eliminar usuario';
							$icon = 'trash';
							$valor = 0;
							$class_button = 'danger';
							$btnEditar = '
								<button class="btn btn-info btn-sm" title="Editar usuario" type="button" onclick="editar(\''.$c_usuario.'\')"><i class="fas fa-edit"></i></button>
								<button class="btn btn-secondary btn-sm" title="Cambiar contraseña" type="button" onclick="password(\''.$c_usuario.'\')"><i class="fas fa-key"></i></button>
							';
							break;
						default: $l_estado = '<span class="badge bg-secondary"><i class="fa fa-check-circle"></i> NO DEFINIDO</span>'; break;
					}
					
					$btn_operaciones = $btnEditar.'
						<button class="btn btn-'.$class_button.' btn-sm" title="'.$titulo.'" type="button" onclick="cambio(\''.$c_usuario.'\', \''.$valor.'\')"><i class="fas fa-'.$icon.'"></i></button>
					';
					
					$data['data'][] = array($x_documento, $x_numero_doc, $x_nombre, $x_ap_paterno, $x_ap_materno, $x_area, $x_perfil, $x_cargo, $x_correo, $l_estado, $btn_operaciones);
					$item++;
				}
				$query->free_result();
			}
			$this->tecsur->close();
			return $data;
		}

		public function mcambio($c_usuario, $n_valor, $c_auditor) {
			$c_usuario = $this->encryption->decrypt($c_usuario);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'l_estado' => ''.$n_valor,
				'c_auditor' => $c_auditor
			);
			$data = $this->tecsur->update('usuarios', $data, array('c_usuario' => $c_usuario));
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

		public function mpassword($password, $c_usuario, $c_auditor) {
			$c_usuario = $this->encryption->decrypt($c_usuario);
			$password = password_hash($password, PASSWORD_DEFAULT);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'x_password' => $password,
				'c_auditor' => $c_auditor
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

		public function mperfil(){
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('c_perfil, UPPER(x_perfil) AS x_perfil');
			$this->tecsur->from('perfiles');
			$this->tecsur->where('l_estado', '1');
			$this->tecsur->order_by('x_perfil', 'ASC');
			$data = $this->tecsur->get();
			if(!$data->result()){
				$validator['verify'] = false;
			} else {
				foreach ($data->result() as $row) {
					$validator['id'][] = $row->c_perfil;
					$validator['name'][] = $row->x_perfil;
				}
				$validator['verify'] = true;
				$validator['contar'] = $data->num_rows();
				$data->free_result();
			}
			$this->tecsur->close();
			return $validator;
		}

		public function mcargo(){
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('c_cargo, UPPER(x_cargo) AS x_cargo');
			$this->tecsur->from('cargos');
			$this->tecsur->where('l_estado', '1');
			$this->tecsur->order_by('x_cargo', 'ASC');
			$data = $this->tecsur->get();
			if(!$data->result()){
				$validator['verify'] = false;
			} else {
				foreach ($data->result() as $row) {
					$validator['id'][] = $row->c_cargo;
					$validator['name'][] = $row->x_cargo;
				}
				$validator['verify'] = true;
				$validator['contar'] = $data->num_rows();
				$data->free_result();
			}
			$this->tecsur->close();
			return $validator;
		}

		public function marea(){
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('c_area, UPPER(x_area) AS x_area');
			$this->tecsur->from('areas');
			$this->tecsur->where('l_estado', '1');
			$this->tecsur->order_by('x_area', 'ASC');
			$data = $this->tecsur->get();
			if(!$data->result()){
				$validator['verify'] = false;
			} else {
				foreach ($data->result() as $row) {
					$validator['id'][] = $row->c_area;
					$validator['name'][] = $row->x_area;
				}
				$validator['verify'] = true;
				$validator['contar'] = $data->num_rows();
				$data->free_result();
			}
			$this->tecsur->close();
			return $validator;
		}

		public function mtdocumento(){
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('c_tipo_documento, UPPER(x_documento) AS x_documento');
			$this->tecsur->from('tipo_documentos');
			$this->tecsur->where('l_estado', '1');
			$this->tecsur->order_by('x_documento', 'ASC');
			$data = $this->tecsur->get();
			if(!$data->result()){
				$validator['verify'] = false;
			} else {
				foreach ($data->result() as $row) {
					$validator['id'][] = $row->c_tipo_documento;
					$validator['name'][] = $row->x_documento;
				}
				$validator['verify'] = true;
				$validator['contar'] = $data->num_rows();
				$data->free_result();
			}
			$this->tecsur->close();
			return $validator;
		}

		public function max_store(){
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('MAX(c_usuario) AS c_usuario');
			$this->tecsur->from('usuarios');
			$data = $this->tecsur->get();
			$row = $data->row();
			$c_usuario = $row->c_usuario;
			$data->free_result();
			$this->tecsur->close();
			return $c_usuario + 1;
		}

		public function store($cusuario, $nperfil, $ncargo, $narea, $ntdocumento, $nndocumento, $nnombre, $nappaterno, $napmaterno, $ncorreo, $c_auditor) {
			$xcorreo = $ncorreo.'@utp.edu.pe';

			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'c_usuario' => $cusuario,
				'x_usuario' => $ncorreo,
				'x_password' => '$2y$10$DWLrzBwNCLXqVbRp5oNbEOHMdFLCk64lMUKtfjzsSj4fs7SvSVzIC',
				'c_auditor' => $c_auditor
			);
			$this->tecsur->insert('login', $data);
			$this->tecsur->close();


			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'c_usuario' => $cusuario,
				'c_perfil' => $nperfil,
				'c_cargo' => $ncargo,
				'c_tipo_documento' => $narea,
				'c_area' => $ntdocumento,
				'x_numero_doc' => $nndocumento,
				'x_nombre' => $nnombre,
				'x_ap_paterno' => $nappaterno,
				'x_ap_materno' => $napmaterno,
				'x_correo' => $xcorreo,
				'l_estado' => '1',
				'c_auditor' => $c_auditor
			);
			$this->tecsur->insert('usuarios', $data);
			$resultado = $this->tecsur->affected_rows();
			if($resultado == true){
				$validator['verify'] = true;
				$validator['msg'] = 'Usuario creado correctamente.';
			} else {
				$validator['verify'] = false;
				$validator['msg'] = 'Error al crear usuario.';
			}
			$this->tecsur->close();
			return $validator;
		}

		public function muser($cusuario){
			$cusuario = (int) $this->encryption->decrypt($cusuario);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('u.c_perfil, u.c_cargo, u.c_tipo_documento, u.c_area, l.x_usuario');
			$this->tecsur->from('login l');
			$this->tecsur->join('usuarios u', 'l.c_usuario = u.c_usuario');
			$this->tecsur->where('u.c_usuario', $cusuario);
			$data = $this->tecsur->get();
			$row = $data->row();
			$validator['perfil'] = (int) $row->c_perfil;
			$validator['cargo'] = $row->c_cargo;
			$validator['documento'] = $row->c_tipo_documento;
			$validator['area'] = $row->c_area;
			$validator['usuario'] = $row->x_usuario;
			$data->free_result();
			$this->tecsur->close();
			return $validator;
		}

		public function edit($cusuario, $nperfil, $ncargo, $narea, $ntdocumento, $nndocumento, $nnombre, $nappaterno, $napmaterno, $ncorreo, $c_auditor) {
			$cusuario = (int) $this->encryption->decrypt($cusuario);
			$xcorreo = $ncorreo.'@utp.edu.pe';

			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'x_usuario' => $ncorreo
			);
			$this->tecsur->update('login', $data, array('c_usuario' => $cusuario));
			$this->tecsur->close();


			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'c_perfil' => $nperfil,
				'c_cargo' => $ncargo,
				'c_tipo_documento' => $ntdocumento,
				'c_area' => $narea,
				'x_numero_doc' => $nndocumento,
				'x_nombre' => $nnombre,
				'x_ap_paterno' => $nappaterno,
				'x_ap_materno' => $napmaterno,
				'x_correo' => $xcorreo,
				'c_auditor' => $c_auditor
			);
			$data = $this->tecsur->update('usuarios', $data, array('c_usuario' => $cusuario, 'l_estado' => '1'));
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
