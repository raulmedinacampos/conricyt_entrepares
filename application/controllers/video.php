<?php
	class Video extends CI_Controller {
		public function index() {
			//$this->output->cache(60);
			$data['title'] = 'Videos';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("videos/video");
			$data['tools'] .= $herramienta->printTitle("Videos");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('videos/video', $data);
			$this->load->view('footer');
		}
	}
?>