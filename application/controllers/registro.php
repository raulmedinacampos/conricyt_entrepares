<?php
	class Registro extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('registro_model', 'registro', TRUE);
		}
		
		public function index() {
			$this->confirmar();
		}
		
		public function login() {
			$this->load->helper('form');
			$this->load->view('header');
			$this->load->view('registro/login');
			$this->load->view('footer');
		}
		
		public function checkLogin() {
			$this->load->library('session');
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			
			if($user === 'regEntrepares' && $pass === '$eminari0') {
				$this->session->set_userdata('ep2014', hash('sha256', $user));
				redirect(base_url().'registro/confirmar');
			} else {
				redirect(base_url().'registro/login');
			}
		}
		
		public function confirmar() {
			$this->load->library('session');
			if($this->session->userdata('ep2014')) {
				$data['yaConfirmado'] = false;
				$id_usuario = $this->uri->segment(3);
				if($id_usuario) {
					$data['usuario'] = $this->registro->getUserById($id_usuario);
					if(!$this->registro->isUserConfirmed($id_usuario)) {
						$data['confirmado'] = $this->registro->confirmUser($id_usuario);
					} else {
						$data['yaConfirmado'] = true;
					}
				} else {
					$data['usuario'] = array();
				}
				$this->load->view('header');
				$this->load->view('registro/confirmacion', $data);
				$this->load->view('footer');
			} else {
				redirect(base_url('registro/login'));
			}
		}
		
		public function confirmar_usuario() {
			$id_usuario = $this->input->post('id_usuario');
			if($this->registro->confirmUser($id_usuario)) {
				echo "Confirmado";
			} else {
				echo "Usuario incorrecto, verifique el folio";
			}
		}
		
		public function confirmar_manual() {
			$this->load->library('session');
			$this->load->helper('form');
			if($this->session->userdata('ep2014')) {
				$this->load->view('header');
				$this->load->view('registro/capturar_folio');
				$this->load->view('footer');
			} else {
				redirect(base_url().'registro/login');
			}
		}
		
		public function consultarUsuario() {
			$correo = addslashes($this->input->post('correo'));
			$usuario = $this->registro->getUserByMail($correo);
				
			if($usuario) {
				echo json_encode($usuario);
			}
		}
		
		public function checkUser() {
			$folio = addslashes($this->input->post('folio'));
			$nombre = addslashes($this->input->post('nombre'));
			$ap_paterno = addslashes($this->input->post('ap_pat'));
			$ap_materno = addslashes($this->input->post('ap_mat'));
			$correo = addslashes($this->input->post('correo'));
			$filtro = '';
			
			if($folio) {
				$folio = explode("-", $folio);
				
				if(sizeof($folio) > 1) {
					$folio = $folio[1];
				} else {
					$folio = $folio[0];
				}
				
				$folio = ltrim(trim($folio), "0");
				$folio = str_pad($folio, 5, '0', STR_PAD_LEFT);
				$folio = "EP2014 - ".$folio;
			}
			
			if($folio) {
				$filtro .= "u.folio = '$folio'";
			}
			
			if($nombre) {
				if($filtro) {
					$filtro .= " AND ";
				}
				$filtro .= "nombre LIKE '$nombre'";
			}
			
			if($ap_paterno) {
				if($filtro) {
					$filtro .= " AND ";
				}
				$filtro .= "ap_paterno LIKE '$ap_paterno'";
			}
			
			if($ap_materno) {
				if($filtro) {
					$filtro .= " AND ";
				}
				$filtro .= "ap_materno LIKE '$ap_materno'";
			}

			if($correo) {
				if($filtro) {
					$filtro .= " AND ";
				}
				$filtro .= "correo LIKE '%$correo%'";
			}
			
			if($filtro) {
				$filtro = ' WHERE ' . $filtro;
			}
			
			$datos = $this->registro->searchUsers($filtro);
			$registros = array();
			if($datos) {
				foreach($datos->result_array() as $val) {
					array_push($registros, $val);
				}
				echo json_encode($registros);
			}
		}
	}
?>