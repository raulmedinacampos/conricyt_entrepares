<?php
	class Sobre_el_evento extends CI_Controller {
		public function index() {
			$this->sede();
		}
		
		public function sede() {
			$this->output->cache(60);
			$data['title'] = utf8_encode('Sede');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/sede");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Sede"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/sede', $data);
			$this->load->view('footer');
		}
		
		public function patrocinadores() {
			$this->output->cache(60);
			$data['title'] = 'Patrocinadores';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/patrocinadores");
			$data['tools'] .= $herramienta->printTitle("Patrocinadores");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/patrocinadores');
			$this->load->view('footer');
		}
		
		public function area_de_exposicion() {
			$this->output->cache(60);
			$data['title'] = utf8_encode('Área de exposición');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/area_de_exposicion");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Área de exposición"));
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/area_de_exposicion', $data);
			$this->load->view('footer');
		}
		
		public function hospedaje() {
			$this->output->cache(60);
			$data['title'] = utf8_encode('Hospedaje');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/hospedaje");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Hospedaje"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/hospedaje', $data);
			$this->load->view('footer');
		}
		
		public function avisos() {
			$this->output->cache(60);
			$data['title'] = utf8_encode('Avisos');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/avisos");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Avisos"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/avisos', $data);
			$this->load->view('footer');
		}
		
		public function guia_turistica() {
			$this->output->cache(60);
			$data['title'] = utf8_encode('Guía turística');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/guia_turistica");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Guía turística"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/guia_turistica', $data);
			$this->load->view('footer');
		}
		
		public function actividades_extraseminario() {
			$this->output->cache(60);
			$data['title'] = utf8_encode('Actividades extraseminario');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("evento/actividades_recreativas");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Actividades extraseminario"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('evento/actividades_recreativas', $data);
			$this->load->view('footer');
		}
	}
?>