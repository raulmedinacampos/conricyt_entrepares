<?php

	class Programa extends CI_Controller {

		public function index() {

			$this->programa_preliminar();

		}

		

		public function programa_preliminar() {

			//$this->output->cache(60);

			$data['title'] = 'Programa descargable';

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printDate("programa/preliminar");

			$data['tools'] .= $herramienta->printTitle("Programa descargable");

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

		

		public function p22_septiembre_2014() {

			$data['title'] = '22 de septiembre';

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printDate("programa/expositores_perfil_y_semblanza");

			$data['tools'] .= $herramienta->printTitle("Programa 22 de septiembre");

			$data['tools'] .= $herramienta->printTools();

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('programa/22-septiembre-2014', $data);

			$this->load->view('footer');

		}

		

		public function p23_septiembre_2014() {

			$data['title'] = '23 de septiembre';

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printDate("programa/expositores_perfil_y_semblanza");

			$data['tools'] .= $herramienta->printTitle("Programa 23 de septiembre");

			$data['tools'] .= $herramienta->printTools();

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('programa/23-septiembre-2014', $data);

			$this->load->view('footer');

		}

	}

?>