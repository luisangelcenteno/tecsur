<?php

	class Mcargo extends CI_Model{
		
		public function __construct(){
			parent::__construct();
		}

		public function mlista() {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('c_cargo, UPPER(x_cargo) AS x_cargo, l_estado, f_registro');
			$this->tecsur->from('cargos');
			$this->tecsur->order_by('x_cargo', 'ASC');
			$query = $this->tecsur->get();
			if(!$query->result()){
				$data['data'] = false;
			} else {
				$item = 1;
				foreach ($query->result() as $row) {
					$c_cargo = $this->encryption->encrypt($row->c_cargo);
					$x_cargo = $row->x_cargo;
					$l_estado = $row->l_estado;
					$f_registro = date("d/m/Y H:m:i", strtotime($row->f_registro));

					switch ($l_estado) {
						case '0':
							$l_estado = '<span class="badge bg-danger"><i class="fa fa-check-circle"></i> INACTIVO</span>';
							$titulo = 'Activar cargo';
							$icon = 'check';
							$valor = 1;
							$class_button = 'success';
							$btnEditar = '';
							break;
						case '1':
							$l_estado = '<span class="badge bg-success"><i class="fa fa-check-circle"></i> ACTIVO</span>';
							$titulo = 'Eliminar cargo';
							$icon = 'trash';
							$valor = 0;
							$class_button = 'danger';
							$btnEditar = '<button class="btn btn-info btn-sm" title="Editar cargo" type="button" onclick="editar(\''.$c_cargo.'\')"><i class="fas fa-edit"></i></button>';
							break;
						default: $l_estado = '<span class="badge bg-secondary"><i class="fa fa-check-circle"></i> NO DEFINIDO</span>'; break;
					}
					
					$btn_operaciones = $btnEditar.'
						<button class="btn btn-'.$class_button.' btn-sm" title="'.$titulo.'" type="button" onclick="cambio(\''.$c_cargo.'\', \''.$valor.'\')"><i class="fas fa-'.$icon.'"></i></button>
					';
					$data['data'][] = array($item, $f_registro, $x_cargo, $l_estado, $btn_operaciones);
					$item++;
				}
				$query->free_result();
			}
			$this->tecsur->close();
			return $data;
		}

		public function mcambio($c_cargo, $n_valor, $c_usuario) {
			$c_cargo = $this->encryption->decrypt($c_cargo);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'l_estado' => ''.$n_valor,
				'c_auditor' => $c_usuario
			);
			$data = $this->tecsur->update('cargos', $data, array('c_cargo' => $c_cargo));
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

		public function store($descripcion, $c_usuario) {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'x_cargo' => $descripcion,
				'l_estado' => '1',
				'c_auditor' => $c_usuario
			);
			$this->tecsur->insert('cargos', $data);
			$resultado = $this->tecsur->affected_rows();
			if($resultado == true){
				$validator['verify'] = true;
				$validator['msg'] = 'Cargo creado correctamente.';
			} else {
				$validator['verify'] = false;
				$validator['msg'] = 'Error al crear cargo.';
			}
			$this->tecsur->close();
			return $validator;
		}

		public function edit($descripcion, $c_cargo, $c_usuario) {
			$c_cargo = $this->encryption->decrypt($c_cargo);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'x_cargo' => $descripcion,
				'c_auditor' => $c_usuario
			);
			$data = $this->tecsur->update('cargos', $data, array('c_cargo' => $c_cargo, 'l_estado' => '1'));
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
