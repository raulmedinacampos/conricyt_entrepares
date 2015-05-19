<?php
	class Encuesta_model extends CI_Model {
		public function getOptions() {
			$this->db->select('id_opcion, opcion, pregunta');
			$this->db->from('opcion');
			$this->db->where('estatus', 1);
			$this->db->order_by('orden');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getQuestions() {
			$this->db->select('p.id_pregunta, p.pregunta, ctp.tipo');
			$this->db->from('pregunta p');
			$this->db->join('cat_tipo_pregunta ctp', 'p.tipo_pregunta = ctp.id_tipo_pregunta');
			$this->db->where('ctp.estatus', 1);
			$this->db->where('p.estatus', 1);
			$this->db->order_by('p.orden');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getUserStatus($id) {
			$this->db->select('estatus');
			$this->db->from('usuario_programa');
			$this->db->where('usuario', $id);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->estatus;
			}
		}
		
		public function getStatsYN($question) {
			$this->db->select('respuesta, COUNT(*) AS total');
			$this->db->from('respuesta');
			$this->db->where('pregunta', $question);
			$this->db->where('estatus', 1);
			$this->db->group_by('respuesta');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getStatsOpc($question) {
			$this->db->select('o.opcion, r.respuesta, COUNT(*) AS total');
			$this->db->from('respuesta r');
			$this->db->join('opcion o', 'r.respuesta = o.id_opcion');
			$this->db->where('r.pregunta', $question);
			$this->db->where('r.estatus', 1);
			$this->db->group_by('r.respuesta');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getStatsRate($question) {
			$this->db->select('o.opcion, AVG(r.respuesta) AS respuesta, COUNT(*) AS total');
			$this->db->from('respuesta r');
			$this->db->join('opcion o', 'r.opcion = o.id_opcion');
			$this->db->where('r.pregunta', $question);
			$this->db->where('r.estatus', 1);
			$this->db->group_by('r.opcion');
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return $query;
			}
		}
		
		public function getTotalSurveys() {
			$this->db->select('DISTINCT(usuario)');
			$this->db->from('respuesta r');
			$this->db->where('r.estatus', 1);
			$query = $this->db->get();
			
			return $query->num_rows();
		}
		
		public function isAnswered($usr) {
			$this->db->from('respuesta');
			$this->db->where('usuario', $usr);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				return true;
			}
		}
		
		public function insertData($data) {
			if($this->db->insert('respuesta', $data)) {
				return true;
			}
		}
	}
?>