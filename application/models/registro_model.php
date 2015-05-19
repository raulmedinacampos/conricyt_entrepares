<?php
	class Registro_model extends CI_Model {
		public function getEntities() {
			$this->db->select('id_entidad, entidad');
			$this->db->from('entidad');
			$this->db->where('estatus', 1);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getEntityById($id) {
			$this->db->select('id_entidad, entidad');
			$this->db->from('entidad');
			$this->db->where('id_entidad', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->entidad;
			}
		}
		
		public function getProfiles() {
			$str = "SELECT id_perfil, perfil FROM cat_perfil WHERE estatus = 1 ORDER BY FIELD(perfil, 'Otro'), perfil ASC";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getProfileById($id) {
			$this->db->select('id_perfil, perfil');
			$this->db->from('cat_perfil');
			$this->db->where('id_perfil', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->perfil;
			}
		}
		
		public function getPositions() {
			$str = "SELECT id_cargo, cargo FROM cat_cargo WHERE estatus = 1 ORDER BY FIELD(cargo, 'Otro'), cargo ASC";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getPositionById($id) {
			$this->db->select('id_cargo, cargo');
			$this->db->from('cat_cargo');
			$this->db->where('id_cargo', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->cargo;
			}
		}
		
		public function getInstitutions($val) {
			$this->db->select('institucion');
			$this->db->from('institucion');
			$this->db->where('estatus', 1);
			$this->db->like('institucion', $val);
			$this->db->or_like('siglas', $val);
			$this->db->order_by('institucion', 'asc');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getInformation() {
			$this->db->select('id, forma');
			$this->db->from('cat_como_se_entero');
			$this->db->where('estatus', 1);
			$this->db->order_by('forma', 'asc');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getInformationById($id) {
			$this->db->select('id, forma');
			$this->db->from('cat_como_se_entero');
			$this->db->where('id', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->forma;
			}
		}
		
		public function getTransports() {
			$this->db->select('id, transporte');
			$this->db->from('cat_forma_transporte');
			$this->db->where('estatus', 1);
			$this->db->order_by('transporte', 'asc');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getTransportById($id) {
			$this->db->select('id, transporte');
			$this->db->from('cat_forma_transporte');
			$this->db->where('id', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->transporte;
			}
		}
		
		public function getFolio() {
			$str = "SELECT u.folio FROM usuario u JOIN usuario_programa up ON u.id_usuario = up.usuario JOIN programa p ON up.programa = p.id_programa WHERE up.estatus > 0 AND p.estatus = 1 AND p.programa = 'Seminario Entre Pares 2014' ORDER BY id_usuario DESC LIMIT 1";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query->row();
			}
		}
		
		public function checkUser($email) {
			$this->db->select('id_usuario');
			$this->db->from('usuario');
			$this->db->where('correo', $email);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return true;
			}
		}

		public function userIsEnrolled($id) {
			$this->db->select('usuario');
			$this->db->from('usuario_evento');
			$this->db->where('usuario', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return true;
			}
		}

		public function getUserById($id) {
			$this->db->select('id_usuario, fecha_alta, folio, nombre, ap_paterno, ap_materno, institucion, correo');
			$this->db->from('usuario');
			$this->db->where('id_usuario', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query->row();
			}
		}
		
		public function getUserByFolio($folio) {
			$this->db->select('id_usuario, fecha_alta, folio, nombre, ap_paterno, ap_materno, institucion, correo');
			$this->db->from('usuario');
			$this->db->where('folio', $folio);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query->row();
			}
		}
		
		public function getUserByMD5($md5) {
			$this->db->select('id_usuario, fecha_alta, folio, nombre, ap_paterno, ap_materno, institucion, correo');
			$this->db->from('usuario');
			$this->db->where('MD5(id_usuario)', $md5);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query->row();
			}
		}
		
		public function getUsersToEnroll() {
			$str = "SELECT u.id_usuario, u.folio, u.nombre, u.ap_paterno, u.ap_materno, e.entidad, u.institucion, u.telefono, u.correo FROM usuario u LEFT JOIN entidad e ON u.entidad = e.id_entidad WHERE u.estatus > 0 AND u.id_usuario NOT IN(SELECT DISTINCT(usuario) FROM usuario_evento)";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getActivitiesByUserDate($usr, $fecha) {
			$this->db->select('e.evento, SUBSTRING(e.inicio FROM 12 FOR 5) AS inicio, SUBSTRING(e.fin FROM 12 FOR 5) AS fin');
			$this->db->from('evento e');
			$this->db->join('usuario_evento ue', 'e.id_evento = ue.evento');
			$this->db->where('ue.usuario', $usr);
			$this->db->where('DATE(e.inicio)', $fecha);
			$this->db->order_by('e.inicio, e.evento');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getTotalTours() {
			$this->db->from('recorrido_guanajuato');
			$this->db->where('estatus', 1);
			return $this->db->count_all_results();
		}
		
		public function getStatusTour($usr) {
			$this->db->select('estatus');
			$this->db->from('recorrido_guanajuato');
			$this->db->where('usuario', $usr);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query->row();
			}
		}
		
		public function searchUsers($filtro) {
			$str = "SELECT u.id_usuario, u.fecha_alta, u.folio, u.nombre, u.ap_paterno, u.ap_materno, u.institucion, u.correo, up.estatus FROM usuario u JOIN usuario_programa up ON u.id_usuario = up.usuario".$filtro." ORDER BY up.estatus DESC, u.id_usuario ASC";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function insertData($data) {
			$usr = '';
			if($this->db->insert('usuario', $data)) {
				$this->db->set('usuario', $this->db->insert_id());
				$usr = $this->db->insert_id();
				$this->db->set('programa', 1);
				
				if(strtotime(date('Y-m-d H:i:s')) < strtotime('2014-09-23 08:00:00')) {
					$this->db->set('estatus', 2);
				}
				
				$this->db->set('fecha_inscripcion', $data['fecha_alta']);
				$this->db->insert('usuario_programa');
				return $usr;
			}
		}
		
		public function insertActivity($usr, $act) {
			$this->db->set('usuario', $usr);
			$this->db->set('evento', $act);
			$this->db->insert('usuario_evento');
			return true;
		}
		
		public function insertTour($data) {
			if($this->db->insert('recorrido_guanajuato', $data)) {
				return true;
			}
		}
		
		public function confirmUser($id) {
			$data = array('estatus'=>1);
			$this->db->where('usuario', $id);
			$this->db->where('programa', 1);
			if($this->db->update('usuario_programa', $data)) {
				return true;
			}
		}

		public function isUserConfirmed($id) {
			$this->db->select('usuario');
			$this->db->from('usuario_programa');
			$this->db->where('usuario', $id);
			$this->db->where('programa', 1);
			$this->db->where('estatus', 1);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return true;
			}
		}

		public function getColumns($salones=array('')) {
			$this->db->select('id_ubicacion_evento, ubicacion');
			$this->db->from('ubicacion_evento');
			$this->db->where('programa', 1);
			$this->db->where('estatus', 1);
			if($salones) {
				$this->db->where_in('id_ubicacion_evento', $salones);
			}
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRows($dia='', $salones='') {
			$filtro = '';
			if($dia) {
				$filtro .= " AND DATE(e.inicio) = '$dia'";
			}
			
			if($salones) {
				$filtro .= " AND ub.id_ubicacion_evento IN($salones)";
			}
			
			$str = "SELECT SUBSTRING(e.inicio FROM 12 FOR 5) AS inicio, SUBSTRING(e.fin FROM 12 FOR 5) AS fin FROM evento e JOIN ubicacion_evento ub ON e.ubicacion_evento = ub.id_ubicacion_evento WHERE ub.programa = 1 AND (TIME(e.fin) - TIME(e.inicio)) IN (3000, 7000)".$filtro." GROUP BY TIME(e.inicio), TIME(e.fin) ORDER BY e.inicio, e.fin";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getSchedule($dia='', $salones='') {
			$filtro = '';
			if($dia) {
				$filtro .= " AND DATE(e.inicio) = '$dia'";
			}
			
			if($salones) {
				$filtro .= " AND ub.id_ubicacion_evento IN($salones)";
			}
			
			$str = "SELECT e.id_evento, e.evento, e.descripcion, SUBSTRING(e.inicio FROM 12 FOR 5) AS inicio, SUBSTRING(e.fin FROM 12 FOR 5) AS fin, e.ubicacion_evento, e.cupo, e.tipo_evento FROM evento e JOIN ubicacion_evento ub ON e.ubicacion_evento = ub.id_ubicacion_evento JOIN programa p ON ub.programa = p.id_programa WHERE p.programa = 'Seminario Entre Pares 2014' AND e.estatus = 1".$filtro."ORDER BY e.inicio";
			$query = $this->db->query($str);
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
    }
?>