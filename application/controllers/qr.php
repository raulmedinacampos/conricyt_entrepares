<?php
	class Qr extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('ciqrcode');
		}
		
		public function index() {
			$id = $this->uri->segment(3);
			settype($id, "int");
			header("Content-Type: image/png");
			$params['data'] = base_url().'registro/confirmar/'.$id;
			$this->ciqrcode->generate($params);
		}
	}
?>