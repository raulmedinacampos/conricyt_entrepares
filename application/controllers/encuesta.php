<?php
	class Encuesta extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('encuesta_model', 'encuesta', TRUE);
		}
		
		public function index() {
			$this->load->library('session');
			$id = $this->session->flashdata('id_usr');
			
			if(!$id) {
				redirect(base_url('constancia'));
			}
			
			if($this->encuesta->isAnswered($id)) {
				$this->session->set_flashdata('id_usr', $id);
				redirect(base_url('constancia/consulta'));
			}
			
			$data['title'] = utf8_encode('Encuesta de satisfacción Entre Pares 2014');
			$this->load->helper('form');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Encuesta de satisfacción Entre Pares 2014"));
			$data['tools'] .= $herramienta->printTools();
			$data['id_usuario'] = $id;
			$data['usuario_estatus'] = $this->encuesta->getUserStatus($id);
			$data['preguntas'] = $this->encuesta->getQuestions();
			$data['opciones'] = $this->encuesta->getOptions();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('encuestas/encuesta', $data);
			$this->load->view('footer');
		}
		
		public function guardarEncuesta() {
			$this->load->library('session');
			$data['usuario'] = $this->input->post('id_usuario');
			
			if(!$this->encuesta->isAnswered($data['usuario'])) {
				$res_preguntas = $this->encuesta->getQuestions();
				$preguntas = $res_preguntas->result();
				$res_opciones = $this->encuesta->getOptions();
				$opciones = $res_opciones->result();
				
				foreach($preguntas as $val) {
					$data['respuesta'] = '';
					$data['pregunta'] = '';
					$data['opcion'] = '';
					$resp_aux = array();
					
					switch($val->tipo) {
						case 'sn':
							$data['respuesta'] = $this->input->post('rb_'.$val->id_pregunta);
							$data['pregunta'] = $val->id_pregunta;
						break;
						case 'abierta':
							$data['respuesta'] = addslashes($this->input->post('txt_'.$val->id_pregunta));
							$data['pregunta'] = $val->id_pregunta;
						break;
						case 'opc':
							$resp_aux = $this->input->post('chk_'.$val->id_pregunta);
							
							if($this->input->post('txt_otro')) {
								$data['respuesta'] = addslashes($this->input->post('txt_otro'));
							}
							
							$data['pregunta'] = $val->id_pregunta;
						break;
						case 'rate5':
							foreach($opciones as $opc) {
								if($opc->pregunta == $val->id_pregunta && $this->input->post('opc_'.$opc->id_opcion)) {
									//$data['respuesta'] .= $opc->id_opcion.','.$this->input->post('opc_'.$opc->id_opcion).'|';
									$resp_aux[$opc->id_opcion] = $this->input->post('opc_'.$opc->id_opcion);
								}
							}
							
							$data['pregunta'] = $val->id_pregunta;
						break;
						default:
						break;
					}
					
					if($data['pregunta']) {
						$encuesta_guardada = true;
						
						if($data['respuesta'] && !$this->encuesta->insertData($data)) {
							$encuesta_guardada = false;
						}
						//echo $val->pregunta."<br />".$data['respuesta'];
						//echo "<br /><br />";
						
						if($resp_aux) {
							foreach($resp_aux as $k => $r) {
								$data['opcion'] = $k;
								$data['respuesta'] = $r;
								
								//echo $data['opcion']." => ".$data['respuesta']."<br />";
							
								if($data['respuesta'] && !$this->encuesta->insertData($data)) {
									$encuesta_guardada = false;
								}
							}
						}
					}
				}
						//exit();
				
				if($encuesta_guardada) {
					$this->session->set_flashdata('id_usr', $data['usuario']);
					redirect(base_url('constancia/consulta'));
				} else {
					echo "Ocurrió un error";
				}
			} else {
				$this->session->set_flashdata('id_usr', $data['usuario']);
				redirect(base_url('constancia/consulta'));
			}
		}
		
		public function resultados() {
			$data['title'] = utf8_encode('Resultados encuesta Entre Pares 2014');
			$this->load->helper('form');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Resultados encuesta Entre Pares 2014"));
			$data['tools'] .= $herramienta->printTools();
			$preguntas = $this->encuesta->getQuestions();
			$preguntas = $preguntas->result();
			$data['preguntas'] = $preguntas;
			
			$datos = array();
			foreach($preguntas as $val) {
				$valores = array();
				switch($val->tipo) {
					case 'sn':
						$respuestas = $this->encuesta->getStatsYN($val->id_pregunta);
						$respuestas = $respuestas->result();
						
						foreach($respuestas as $resp) {
							$valores[$resp->respuesta] = $resp->total;
						}
						
						$datos[$val->id_pregunta] = $valores;
						break;
					case 'opc':
						$respuestas = $this->encuesta->getStatsOpc($val->id_pregunta);
						
						if($respuestas) {
							$respuestas = $respuestas->result();
							
							foreach($respuestas as $resp) {
								$valores[$resp->opcion] = $resp->total;
							}
							
							$datos[$val->id_pregunta] = $valores;
						}
						break;
					case 'rate5':
						$respuestas = $this->encuesta->getStatsRate($val->id_pregunta);
						$respuestas = $respuestas->result();
						
						foreach($respuestas as $resp) {
							$valores[$resp->opcion] = number_format($resp->respuesta, 2, '.', ',');
						}
						
						$datos[$val->id_pregunta] = $valores;
						break;
					default:
						break;
				}
			}
			
			$data['respuestas'] = $datos;
			$data['totalRespondidas'] = $this->encuesta->getTotalSurveys();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$this->load->view('header', $data);
			$this->load->view('encuestas/resultados', $data);
			$this->load->view('footer');			
		}
	}
?>