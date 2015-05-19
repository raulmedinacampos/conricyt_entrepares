<?php
	class Constancia_model extends CI_Model {
		public function getPrints($usr) {
			$this->db->select('impresion_constancia');
			$this->db->from('usuario_programa');
			$this->db->where('usuario', $usr);
			$this->db->where('programa', 1);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) {
				$row = $query->row();
				return $row->impresion_constancia;
			}
		}
		
		public function updatePrints($usr, $data) {
			$this->db->where('usuario', $usr);
			$this->db->where('programa', 1);
			$this->db->update('usuario_programa', $data);
		}
	}
?>