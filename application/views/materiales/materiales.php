<?php

	class Materiales extends CI_Controller {

		public function index() {

			$data['title'] = utf8_encode('Materiales');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Materiales"));

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/materiales', $data);

			$this->load->view('footer');

		}



		public function logos() {

			$data['title'] = utf8_encode('Logos');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Logos"));

			$data['tools'] .= $herramienta->printDate('materiales/logos');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/logos', $data);

			$this->load->view('footer');

		}



		public function flyers() {

			$data['title'] = utf8_encode('Flyers');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Flyers"));

			$data['tools'] .= $herramienta->printDate('materiales/flyers');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/flyers', $data);

			$this->load->view('footer');

		}

		

		public function presentaciones_2014() {

			$data['title'] = utf8_encode('Presentaciones 2014');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Presentaciones 2014"));

			$data['tools'] .= $herramienta->printDate('materiales/presentaciones_2014');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/presentaciones_2014', $data);

			$this->load->view('footer');

		}


		public function galeria_fotos_2014() {

			$data['title'] = utf8_encode('Galería de Fotos 2014');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Galer&iacute;a de Fotos 2014"));

			$data['tools'] .= $herramienta->printDate('materiales/galeria_fotos_2014');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/galeria_fotos_2014', $data);

			$this->load->view('footer');

		}
		
		public function descargables_2013() {

			$data['title'] = utf8_encode('Descargables 2013');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Descargables 2013"));

			$data['tools'] .= $herramienta->printDate('materiales/descargables_2013');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/descargables_2013', $data);

			$this->load->view('footer');

		}
		
		public function descargables_2012() {

			$data['title'] = utf8_encode('Descargables 2012');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Descargables 2012"));

			$data['tools'] .= $herramienta->printDate('materiales/descargables_2012');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/descargables_2012', $data);

			$this->load->view('footer');

		}		

		public function descargables_24_septiembre_2012() {

			$data['title'] = utf8_encode('Descargables 2012');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Descargables 2012 - 24 de Septiembre"));

			$data['tools'] .= $herramienta->printDate('materiales/descargables_24_septiembre_2012');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/descargables_24_septiembre_2012', $data);

			$this->load->view('footer');

		}	
		
		public function descargables_25_septiembre_2012() {

			$data['title'] = utf8_encode('Descargables 2012');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Descargables 2012 - 25 de Septiembre"));

			$data['tools'] .= $herramienta->printDate('materiales/descargables_25_septiembre_2012');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/descargables_25_septiembre_2012', $data);

			$this->load->view('footer');

		}	


		public function galeria_fotos_2012() {

			$data['title'] = utf8_encode('Galería de Fotos 2012');

			$this->load->library('herramientas');

			$herramienta = new Herramientas();

			$data['tools'] = $herramienta->printTitle(utf8_encode("Galer&iacute;a de Fotos 2012"));

			$data['tools'] .= $herramienta->printDate('materiales/galeria_fotos_2012');

			$data['toolsPie'] = $herramienta->printBackToTop();

			$this->load->view('header', $data);

			$this->load->view('materiales/galeria_fotos_2012', $data);

			$this->load->view('footer');

		}





	}

?>