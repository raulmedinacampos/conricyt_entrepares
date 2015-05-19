<?php
	class Comite_organizador extends CI_Controller {
		public function index() {
			$this->conricyt();
		}
		
		public function conricyt() {
			$this->output->cache(60);
			$data['title'] = 'CONRICYT';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("comite_organizador/conricyt");
			$data['tools'] .= $herramienta->printTitle("CONRICYT");
			$data['tools'] .= $herramienta->printTools();
			
			$data['toolsPie']= $herramienta->printSocialNetworks(current_url());
			$data['toolsPie'] .= $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('comite_organizador/conricyt', $data);
			$this->load->view('footer');
		}
		
		public function instituciones_fundadoras() {
			$this->output->cache(60);
			$data['title'] = 'Instituciones fundadoras';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("comite_organizador/instituciones_fundadoras");
			$data['tools'] .= $herramienta->printTitle("Instituciones fundadoras");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie']= $herramienta->printSocialNetworks(current_url());
			$data['toolsPie'] .= $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('comite_organizador/instituciones_fundadoras');
			$this->load->view('footer');
		}
		
		public function patrocinadores() {
			$this->output->cache(60);
			$data['title'] = 'Patrocinadores';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("comite_organizador/patrocinadores");
			$data['tools'] .= $herramienta->printTitle("Patrocinadores");
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('comite_organizador/patrocinadores');
			$this->load->view('footer');
		}
	}
?>