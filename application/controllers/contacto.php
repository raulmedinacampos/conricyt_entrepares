<?php
	class Contacto extends CI_Controller {
		public function index() {
			$this->output->cache(60);
			$data['title'] = 'Contacto';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("contacto/contacto");
			$data['tools'] .= $herramienta->printTitle("Contacto");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('contacto/contacto', $data);
			$this->load->view('footer');
		}
	}
?>