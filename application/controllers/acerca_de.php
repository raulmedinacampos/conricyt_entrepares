<?php
	class Acerca_de extends CI_Controller {
		public function index() {
			$this->conricyt();
		}
		
		public function conricyt() {
			//$this->output->cache(60);
			$data['title'] = utf8_encode('Acerca de CONRICYT');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("acerca_de/conricyt");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("Acerca de CONRICYT"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('acerca_de/conricyt', $data);
			$this->load->view('footer');
		}
		
		public function entre_pares() {
			//$this->output->cache(60);
			$data['title'] = utf8_encode('¿Qué es Entre Pares?');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printDate("acerca_de/entre_pares");
			$data['tools'] .= $herramienta->printTitle(utf8_encode("¿Qué es Entre Pares?"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('acerca_de/entre_pares', $data);
			$this->load->view('footer');
		}
	}
?>