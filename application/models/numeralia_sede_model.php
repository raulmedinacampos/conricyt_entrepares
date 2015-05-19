<?php
	class Numeralia_sede_model extends CI_Model {
		public function getRegs() {
			$this->db->select('u.id_usuario, u.folio, u.nombre, u.ap_paterno, u.ap_materno, u.institucion, u.correo, ue.usuario');
			$this->db->from('usuario u');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->join('usuario_evento ue', 'u.id_usuario = ue.usuario', 'left');
			$this->db->where('up.programa', '1');
			$this->db->group_by('u.id_usuario');
			$this->db->order_by('u.nombre, u.ap_paterno, u.ap_materno');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRegsByInst() {
			$this->db->select('u.institucion, COUNT(*) AS total');
			$this->db->from('usuario u');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->where('up.programa', '1');
			$this->db->group_by('institucion');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRegsByDay() {
			$this->db->select('DATE(fecha_inscripcion) AS fecha, COUNT(*) AS total');
			$this->db->from('usuario_programa');
			$this->db->where('programa', '1');
			$this->db->group_by('DATE( fecha_inscripcion )');
			$this->db->order_by('fecha', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getEnrolledByActivities() {
			$this->db->select('e.id_evento, e.evento, COUNT(*) AS total');
			$this->db->from('evento e');
			$this->db->join('usuario_evento ue', 'e.id_evento = ue.evento');
			$this->db->group_by('ue.evento');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}

		public function getEnrolledByActivityByDay($fecha) {
			$this->db->select('SUBSTRING(e.inicio FROM 12 FOR 5) AS inicio, SUBSTRING(e.fin FROM 12 FOR 5) AS fin, e.evento, COUNT(*) AS total');
			$this->db->from('evento e');
			$this->db->join('usuario_evento ue', 'e.id_evento = ue.evento');
			$this->db->where('DATE(e.inicio)', $fecha);
			$this->db->group_by('ue.evento');
			$this->db->order_by('total', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}

		public function getRegsByActivity($id) {
			$this->db->select('e.id_evento, COUNT(*) AS total');
			$this->db->from('evento e');
			$this->db->join('usuario_evento ue', 'e.id_evento = ue.evento');
			$this->db->where('e.id_evento', $id);
			$this->db->group_by('ue.evento');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query->row();
			}
		}
		
		public function getRegsByState() {
			$this->db->select('e.entidad, COUNT( * ) AS total');
			$this->db->from('usuario u');
			$this->db->join('entidad e', 'u.entidad = e.id_entidad');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->where('up.estatus', '1');
			$this->db->group_by('u.entidad');
			$this->db->order_by('total', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRegsByRegions() {
			$this->db->select('r.region, COUNT( * ) AS total');
			$this->db->from('usuario u');
			$this->db->join('entidad e', 'u.entidad = e.id_entidad');
			$this->db->join('region r', 'e.region = r.id_region');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->where('up.estatus', '1');
			$this->db->group_by('r.region');
			$this->db->order_by('total', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRegsByGenre() {
			$this->db->select("IF(u.sexo = 'm', 'Masculino', (IF(u.sexo = 'f', 'Femenino', ''))) AS sexo, COUNT(u.sexo) AS total", FALSE);
			$this->db->from('usuario u');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->where('up.estatus', '1');
			$this->db->group_by('u.sexo');
			$this->db->order_by('total', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRegsByInstitutionType() {
			$this->db->select("ti.tipo_institucion, COUNT(*) AS total");
			$this->db->from('usuario u');
			$this->db->join('institucion i', 'u.institucion = i.institucion');
			$this->db->join('cat_tipo_institucion ti', 'i.tipo_institucion = ti.id_tipo_institucion');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->where('up.estatus', '1');
			$this->db->group_by('i.tipo_institucion');
			$this->db->order_by('total', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getRegsByProfiles() {
			$this->db->select("cp.perfil, COUNT(*) AS total");
			$this->db->from('usuario u');
			$this->db->join('cat_perfil cp', 'u.id_perfil = cp.id_perfil');
			$this->db->join('usuario_programa up', 'u.id_usuario = up.usuario');
			$this->db->where('up.estatus', '1');
			$this->db->group_by('u.id_perfil');
			$this->db->order_by('total', 'DESC');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function totalRegs($estatus = '') {
			$this->db->select('usuario, programa');
			$this->db->from('usuario_programa');
			$this->db->where('programa', '1');
			$this->db->where('estatus', '1');
			
			if($estatus) {
				$this->db->where('estatus', $estatus);
			}
			
			return $this->db->count_all_results();
		}
	}
?>