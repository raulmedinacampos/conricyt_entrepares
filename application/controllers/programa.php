<?php
	class Programa extends CI_Controller {
		public function index() {
			$this->programa_preliminar();
		}
		
		public function programa_preliminar() {
			//$this->output->cache(60);
			$data['title'] = 'Programa preliminar';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("programa/preliminar");
			$data['tools'] .= $herramienta->printTitle("Programa preliminar");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('programa/preliminar', $data);
			$this->load->view('footer');
		}
		
		public function expositores_perfil_y_semblanza() {
			//$this->output->cache(60);
			$data['title'] = 'Conferencistas: Semblanza curricular';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("programa/expositores_perfil_y_semblanza");
			$data['tools'] .= $herramienta->printTitle("Conferencistas: Semblanza curricular");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('programa/expositores_perfil_y_semblanza', $data);
			$this->load->view('footer');
		}
		
		public function p7_de_octubre() {
			$data['title'] = '7 de octubre';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = '';
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('programa/7_de_octubre', $data);
			$this->load->view('footer');
		}
		
		public function p8_de_octubre_2013() {
			$data['title'] = '8 de octubre';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = '';
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('programa/8_de_octubre_2013', $data);
			$this->load->view('footer');
		}
	}
?>