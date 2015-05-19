<?php
	class Descargables extends CI_Controller {
		public function index() {
			$this->output->cache(60);
			$data['title'] = 'Descargables';
			$data['tools'] = '';
			$data['toolsPie'] = '';
			$this->load->view('header', $data);
			$this->load->view('descargables/descargables', $data);
			$this->load->view('footer');
		}
		
		public function descargables_7_de_octubre_2013() {
			$this->output->cache(60);
			$data['title'] = 'Conferencias 7 de octubre 2013';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = '';
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('descargables/descargables_7_de_octubre_2013', $data);
			$this->load->view('footer');
		}
		
		public function descargables_8_de_octubre_2013() {
			$this->output->cache(60);
			$data['title'] = 'Conferencias 8 de octubre 2013';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = '';
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('descargables/descargables_8_de_octubre_2013', $data);
			$this->load->view('footer');
		}
	}
?>