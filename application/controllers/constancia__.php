<?php
	class Constancia extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('constancia_model', 'constancia', TRUE);
		}
		
		public function index() {
			$data['title'] = 'Constancias';
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle("Constancia de asistencia");
			$this->load->helper('form');
			$this->load->view('header', $data);
			$this->load->view('constancias/constancias', $data);
			$this->load->view('footer');
		}
		
		public function consulta() {
			$usr = -1;
			$this->load->library('session');
			$id = $this->session->flashdata('id_usr');
			$folio = $this->input->post('folio');
			$this->load->library('session');
			$this->load->model('encuesta_model', 'encuesta', TRUE);
			$this->load->model('registro_model', 'registro', TRUE);
			
			if($folio) {
				$usuario = $this->registro->getUserByFolio($folio);
			}
			
			if($id) {
				$usuario = $this->registro->getUserById($id);
			}
			
			//$usr = $usuario->id_usuario;
			if($usuario) {
				$usr = $usuario->id_usuario;
			}
			
			if($this->registro->userIsEnrolled($usr)) {
				if($this->encuesta->isAnswered($usr)) {
					$impresiones = $this->constancia->getPrints($usr);
					$data['impresion_constancia'] = ($impresiones+1);
					$this->constancia->updatePrints($usr, $data);
					$nombre = utf8_decode(trim($usuario->nombre." ".$usuario->ap_paterno." ".$usuario->ap_materno));
					$this->load->library('pdf');
					$pdf = $this->pdf->load("c", "Letter", "", "", 14, 10, 10, 10);
					$pdf->AddPage('L');
					$pdf->SetDisplayMode('fullpage');
					$html = '<img src="'.base_url('images/reconocimiento.png').'" style="width:100%;" />';
					$html .= '<div style="position:absolute; width:90%; top:44%; font-size:28pt; font-style:italic; text-align:center;">'.$nombre.'</div>';
					
					$pdf->WriteHTML(utf8_encode($html));
					$pdf->Output();
				} else {
					$this->session->set_flashdata('id_usr', $usr);
					redirect(base_url('encuesta'));
				}
			} else {
				$data['title'] = 'Constancia no disponible';
				
				$this->load->view('header', $data);
				$this->load->view('constancias/sin_actividades');
				$this->load->view('footer');
			}
		}
	}
?>