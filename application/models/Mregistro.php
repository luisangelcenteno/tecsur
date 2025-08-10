<?php

	class Mregistro extends CI_Model{
		
		public function __construct(){
			parent::__construct();
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

		public function max_rac(){
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select('MAX(c_rac) AS c_rac');
			$this->tecsur->from('adjunto_racs');
			$data = $this->tecsur->get();
			$contador = $data->num_rows();
			if ($contador == 0) {
				$c_rac = 1;
			} else {
				$row = $data->row();
				$c_rac = (int) $row->c_rac;
				$c_rac++;
			}
			$data->free_result();
			$this->tecsur->close();
			return $c_rac;
		}

		public function mrac($crac, $nfecha, $nsst, $nubicacion, $ntipo, $ncategoria, $ndescripcion, $nelemento, $nareas, $name, $c_auditor, $c_area) {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'c_rac' => $crac,
				'c_tipo_estandar' => $ntipo,
				'c_categoria' => $ncategoria,
				'c_area_registra' => $c_area,
				'c_area_atiende' => $nareas,
				'c_usuario_registra' => $c_auditor,
				'c_usuario_atiende' => 0,
				'n_sst' => $nsst,
				'x_ubicacion' => $nubicacion,
				'x_descripcion' => $ndescripcion,
				'x_recomendacion' => '',
				'x_elemento' => $nelemento,
				'l_atencion' => '0',
				'f_reporte' => $nfecha,
				'c_auditor' => $c_auditor
			);
			$this->tecsur->insert('racs', $data);
			$this->tecsur->close();


			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'c_rac' => $crac,
				'x_path' => 'upload',
				'x_documento' => $name,
				'l_estado' => '1',
				'c_auditor' => $c_auditor
			);
			$this->tecsur->insert('adjunto_racs', $data);
			$resultado = $this->tecsur->affected_rows();
			if($resultado == true){
				$validator['verify'] = true;
				$validator['msg'] = 'RAC creado correctamente.';
			} else {
				$validator['verify'] = false;
				$validator['msg'] = 'Error al crear RAC.';
			}
			$this->tecsur->close();

			return $validator;
		}

		public function mracs($tipo, $estado, $c_area) {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select("r.c_rac, te.x_tipo_estandar, c.x_categoria, ar.x_area as x_area_registra, r.c_area_atiende, ati.x_area as x_area_atiende, concat(u.x_nombre,' ',u.x_ap_paterno,' ',u.x_ap_materno) AS x_usuario_registra,
			concat(us.x_nombre,' ',us.x_ap_paterno,' ',us.x_ap_materno) AS x_usuario_atiende, r.n_sst, r.x_ubicacion, r.x_descripcion, r.x_recomendacion, r.x_elemento, r.l_atencion, r.f_registro,
			r.f_reporte, adr.x_path, adr.x_documento");
			$this->tecsur->from('racs r');
			$this->tecsur->join('tipo_estandares te', 'r.c_tipo_estandar = te.c_tipo_estandar');
			$this->tecsur->join('categorias c', 'r.c_categoria = c.c_categoria');
			$this->tecsur->join('areas ar', 'r.c_area_registra = ar.c_area');
			$this->tecsur->join('areas ati', 'r.c_area_atiende = ati.c_area');
			$this->tecsur->join('usuarios u', 'r.c_usuario_registra = u.c_usuario');
			$this->tecsur->join('usuarios us', 'r.c_usuario_atiende = us.c_usuario', 'left');
			$this->tecsur->join('adjunto_racs adr', 'r.c_rac = adr.c_rac');
			if ($tipo == 0) {
				$this->tecsur->where('r.c_area_registra', $c_area);
				$this->tecsur->or_where('r.c_area_atiende', $c_area);
			} else if ($tipo == 1) {
				$this->tecsur->where('r.c_area_registra', $c_area);
			} else if ($tipo == 2) {
				$this->tecsur->where('r.c_area_atiende', $c_area);
			}
			if ($estado == 1) {
				$this->tecsur->where('r.l_atencion', '0');
			} else if ($estado == 2) {
				$this->tecsur->where('r.l_atencion', '1');
			}
			$this->tecsur->order_by('r.f_registro', 'ASC');
			$query = $this->tecsur->get();
			if(!$query->result()){
				$data['data'] = false;
			} else {
				foreach ($query->result() as $row) {
					$c_rac = $this->encryption->encrypt($row->c_rac);
					$x_tipo_estandar = $row->x_tipo_estandar;
					$x_categoria = $row->x_categoria;
					$x_area_registra = $row->x_area_registra;
					$c_area_atiende = $row->c_area_atiende;
					$x_area_atiende = $row->x_area_atiende;
					$n_sst = $row->n_sst;
					$x_ubicacion = $row->x_ubicacion;
					$x_descripcion = $row->x_descripcion;
					$x_recomendacion = $row->x_recomendacion;
					$l_atencion = $row->l_atencion;
					$f_reporte = date("d/m/Y", strtotime($row->f_reporte));

					$reporte = '<button class="btn btn-danger btn-sm" type="button" title="REPORTE" onclick="reporte('.$row->c_rac.')"><i class="fa fa-file"></i></button>';
					if ($l_atencion == '0' && $c_area_atiende == $c_area) {
						$atiende = '<button class="btn btn-primary btn-sm" type="button" title="ATENDER" onclick="atender(\''.$c_rac.'\')"><i class="fa fa-edit"></i></button>';
					} else {
						$atiende = '';
					}

					switch ($l_atencion) {
						case '0':
							$i_estado = '<a title="PENDIENTE"><i class="fa fa-info-circle" style="color: blue;"></i></a>';
							break;
						case '1':
							$i_estado = '<a title="ATENDIDO"><i class="fa fa-check-circle" style="color: green;"></i></a>';
							break;
					}

					$buttons = $reporte.' '.$atiende;
					$data['data'][] = array($f_reporte, $x_tipo_estandar, $x_categoria, $x_area_registra, $x_area_atiende, $n_sst, $x_ubicacion, $x_descripcion, $x_recomendacion, $i_estado, $buttons);
				}
				$query->free_result();
			}
			$this->tecsur->close();
			return $data;
		}

		public function reporte_incidencia($c_rac) {
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$this->tecsur->select("r.c_rac, te.x_tipo_estandar, c.x_categoria, ar.x_area as x_area_registra, ati.x_area as x_area_atiende, concat(u.x_nombre,' ',u.x_ap_paterno,' ',u.x_ap_materno) AS x_usuario_registra,
			concat(us.x_nombre,' ',us.x_ap_paterno,' ',us.x_ap_materno) AS x_usuario_atiende, r.n_sst, r.x_ubicacion, r.x_descripcion, r.x_recomendacion, r.x_elemento, r.l_atencion, r.f_registro,
			r.f_reporte, adr.x_path, adr.x_documento");
			$this->tecsur->from('racs r');
			$this->tecsur->join('tipo_estandares te', 'r.c_tipo_estandar = te.c_tipo_estandar');
			$this->tecsur->join('categorias c', 'r.c_categoria = c.c_categoria');
			$this->tecsur->join('areas ar', 'r.c_area_registra = ar.c_area');
			$this->tecsur->join('areas ati', 'r.c_area_atiende = ati.c_area');
			$this->tecsur->join('usuarios u', 'r.c_usuario_registra = u.c_usuario');
			$this->tecsur->join('usuarios us', 'r.c_usuario_atiende = us.c_usuario', 'left');
			$this->tecsur->join('adjunto_racs adr', 'r.c_rac = adr.c_rac');
			$this->tecsur->where('r.c_rac', $c_rac);
			$query = $this->tecsur->get();
			$data['contador'] = $query->num_rows();
            foreach ($query->result() as $row) {
				$data['x_tipo_estandar'] = $row->x_tipo_estandar;
				$data['x_categoria'] = $row->x_categoria;
				$data['x_area_registra'] = $row->x_area_registra;
				$data['x_area_atiende'] = $row->x_area_atiende;
				$data['x_usuario_registra'] = $row->x_usuario_registra;
				$data['x_usuario_atiende'] = $row->x_usuario_atiende;
				$data['n_sst'] = $row->n_sst;
				$data['x_ubicacion'] = $row->x_ubicacion;
				$data['x_descripcion'] = $row->x_descripcion;
				$data['x_recomendacion'] = $row->x_recomendacion;
				$data['x_elemento'] = $row->x_elemento;
				$data['f_registro'] = date("d/m/Y H:i:s", strtotime($row->f_registro));
				$data['f_reporte'] = date("d/m/Y", strtotime($row->f_reporte));
				$data['x_documento'] = $row->x_documento;
				switch ($row->l_atencion) {
					case '0': $data['x_estado'] = 'PENDIENTE'; break;
					case '1': $data['x_estado'] = 'ATENDIDO'; break;
					default: $data['x_estado'] = 'SIN DEFINIR'; break;
				}
            }
			$query->free_result();
			$this->tecsur->close();
			return $data;
		}

		public function matender($arecomendacion, $c_rac, $c_auditor, $c_area) {
			$c_rac = $this->encryption->decrypt($c_rac);
			$this->tecsur = $this->load->database('tecsur', TRUE);
			$data = array(
				'x_recomendacion' => $arecomendacion,
				'l_atencion' => '1',
				'c_auditor' => $c_auditor
			);
			$data = $this->tecsur->update('racs', $data, array('c_rac' => $c_rac, 'c_area_atiende' => $c_area, 'l_atencion' => '0'));
			$response = $this->tecsur->affected_rows();
			if($response){
				$validator['verify'] = true;
				$validator['msg'] = 'Atendido correctamente.';
			} else {
				$validator['verify'] = false;
				$validator['msg'] = 'No se atendio la incidencia.';
			}
			$this->tecsur->close();
			return $validator;
		}

	}
