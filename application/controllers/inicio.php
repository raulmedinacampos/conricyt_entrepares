<?php
	class Inicio extends CI_Controller {
		public function index() {
			$this->load->view('header');
			$this->load->view('inicio');
			$this->load->view('footer');
		}
	}
?>