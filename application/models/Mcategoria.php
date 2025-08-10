<?php

	class Mcategoria extends CI_Model{
		
		public function __construct(){
			parent::__construct();
		}

		public function mlista() {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('x_categoria, l_estado, f_registro');
			$this->tecsur->from('categorias');
			$this->tecsur->order_by('x_categoria', 'ASC');
			$query = $this->tecsur->get();
			if(!$query->result()){
				$data['data'] = false;
			} else {
				$item = 1;
				foreach ($query->result() as $row) {
					$x_categoria = $row->x_categoria;
					$l_estado = $row->l_estado;
					$f_registro = date("d/m/Y H:m:i", strtotime($row->f_registro));

					switch ($l_estado) {
						case '0': $l_estado = '<span class="badge bg-danger"><i class="fa fa-check-circle"></i> INACTIVO</span>'; break;
						case '1': $l_estado = '<span class="badge bg-success"><i class="fa fa-check-circle"></i> ACTIVO</span>'; break;
						default: $l_estado = '<span class="badge bg-secondary"><i class="fa fa-check-circle"></i> NO DEFINIDO</span>'; break;
					}
					
					$data['data'][] = array($item, $f_registro, $x_categoria, $l_estado);
					$item++;
				}
				$query->free_result();
			}
			$this->tecsur->close();
			return $data;
		}

	}
