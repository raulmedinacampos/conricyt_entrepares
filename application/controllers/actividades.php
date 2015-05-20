<?php
	class Actividades extends CI_Controller {
		public function index() {
			$this->output->cache(60);
			$data['title'] = 'Actividades';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("actividades/actividades");
			$data['tools'] .= $herramienta->printTitle("Actividades");
			$data['tools'] .= $herramienta->printTools();
			$this->load->view('header', $data);
			$this->load->view('actividades/actividades', $data);
			$this->load->view('footer');
		}
		
		public function conferencias() {
			$this->output->cache(60);
			$data['title'] = 'Conferencias';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("actividades/conferencias");
			$data['tools'] .= $herramienta->printTitle("Conferencias");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('actividades/conferencias', $data);
			$this->load->view('footer');
		}
		
		public function talleres() {
			$this->output->cache(60);
			$data['title'] = 'Talleres';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("actividades/talleres");
			$data['tools'] .= $herramienta->printTitle("Talleres");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('actividades/talleres', $data);
			$this->load->view('footer');
		}
		
		public function encuentros() {
			$this->output->cache(60);
			$data['title'] = 'Encuentros';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("actividades/encuentros");
			$data['tools'] .= $herramienta->printTitle("Encuentros");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('actividades/encuentros', $data);
			$this->load->view('footer');
		}
		
		public function encuentro_de_editores_de_revistas_cientificas_mexicanas() {
			$data['title'] = 'Encuentro de Editores de Revistas Cient&iacute;ficas Mexicanas';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle("Encuentro de Editores de Revistas Cient&iacute;ficas Mexicanas");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('actividades/encuentro_de_editores_de_revistas', $data);
			$this->load->view('footer');
		}

		public function encuentro_con_bibliotecarios() {
			$data['title'] = 'Encuentro con Bibliotecarios';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle("Encuentro con Bibliotecarios");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('actividades/encuentro_con_bibliotecarios', $data);
			$this->load->view('footer');
		}
		
		public function encuentro_de_revistas_cientificas() {
			$data['title'] = 'Encuentro de Revistas Cient&iacute;ficas';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle("Encuentro de Revistas Cient&iacute;ficas");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('actividades/encuentro_de_revistas_cientificas', $data);
			$this->load->view('footer');
		}
	}
?>