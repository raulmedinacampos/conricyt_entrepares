<?php
	class Preregistro extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('registro_model', 'registro', TRUE);
		}
		
		private function generarFolio($prefijo = "EP2015") {
			$anterior = $this->registro->getFolio();
			if(!$anterior) {
				$folio = $prefijo." - "."00001";
			} else {
				$anterior = $anterior->folio;
				list($pre, $consecutivo) = explode("-", $anterior);
				$consecutivo = (int) $consecutivo;
				$consecutivo++;
				$folio = $prefijo." - ".str_pad($consecutivo, 5, "0", STR_PAD_LEFT);
			}
			return $folio;
		}
		
		private function strtoupper_utf8($cadena) {
			$convertir_de = array(
				"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
				"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë","e", "ì", "í", "î", "ï",
				"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "?", "?", "?", "?", "?", "?", "?", "?",
				"?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?",
				"?", "?", "?", "?"
			);
			$convertir_a = array(
				"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
				"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë","E", "Ì", "Í", "Î", "Ï",
				"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "?", "?", "?", "?", "?", "?", "?", "?",
				"?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?",
				"?", "?", "?", "?"
			);
			return str_replace($convertir_de, $convertir_a, $cadena);
		}
		
		private function formatearNombre($cadena) {
			$excepciones = array('de', 'la', 'de la', 'del', 'y');
			$cadena = trim($cadena);
			$partes = explode(" ", $cadena);
			
			for($i=0; $i<sizeof($partes); $i++) {
				$partes[$i] = ucfirst(mb_strtolower(trim($partes[$i])));
			}
			
			for($i=0; $i<sizeof($partes); $i++) {
				for($j=0; $j<sizeof($excepciones); $j++) {
					if(strtolower($partes[$i]) == $excepciones[$j]) {
						$partes[$i] = strtolower($partes[$i]);
					}
				}
			}
			
			$cadena = implode(" ", $partes);
			return $cadena;
		}
		
		private function formatearFecha($fecha) {
			$meses = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
			list($anio, $mes, $dia) = explode("-", $fecha);
			$str_fecha = "México D.F. a ".$dia." de ".$meses[(int)$mes]." de ".$anio;
			return $str_fecha;
		}
		
		private function formatearHora($fechahora) {
			list($fecha, $hora) = explode(" ", $fechahora);
			$pos = strrpos($hora, ":", -1);
			$hora = substr($hora, 0, $pos);
			return $hora;
		}
		
		private function fechaMySQL($fecha) {
			$fecha = explode("/", $fecha);
			$fecha = array_reverse($fecha);
			$fecha = implode("-", $fecha);
			return $fecha;
		}
		
		private function crearComprobante($data, $usr='') {
			list($fecha, $hora) = explode(" ", $data['fecha_alta']);
			$fecha = $this->formatearFecha($fecha);
			$nombre = utf8_decode($data['nombre']);
			$ap_paterno = utf8_decode($data['ap_paterno']);
			$ap_materno = utf8_decode($data['ap_materno']);
			$nombre_completo = $this->strtoupper_utf8(trim($nombre." ".$ap_paterno." ".$ap_materno));
			$institucion = $this->strtoupper_utf8(utf8_decode(trim($data['institucion'])));
			$estatus_recorrido = 0;
			$header = '<p class="header"><img src="'.base_url().'images/header_pdf.jpg" /></p>';
			$footer = '<p class="footer"><strong>Oficina del Consorcio Nacional de Recursos de Información Científica y Tecnológica</strong><br />Av. Insurgentes Sur 1582, Col. Crédito Constructor, Del. Benito Juárez, C.P. 03940 México D.F. – Tel: 5322 7700 ext. 4020 a la 4026</p>';
			$html = '<div class="contenido">';
			$html .= '<p class="titulo2">Consorcio Nacional de Recursos de Información Científica y Tecnológica</p>';
			$html .= '<p class="fecha">'.$fecha.'</p>';
			$html .= '<p class="remitente">ESTIMADO(A) '.$nombre_completo.'<br />'.$institucion.'<br />P r e s e n t e:</p>';
			$html .= '<img class="qr" src="'.base_url().'qr/index/'.$data['id_usuario'].'" />';
			$html .= '<p>Tu pre-registro se ha realizado con éxito. Para confirmar tu registro en la sede es necesario que lleves impreso este comprobante o, en su defecto, presenta el código QR en un dispositivo móvil (tablet o celular). Una vez confirmado tu registro recibirás el kit de bienvenida en donde encontrarás tu gafete para acceder a las actividades académicas del Seminario.</p>';
			$html .= '<p>Cuarenta y ocho horas posteriores al evento podrás obtener una constancia digital de asistencia, para lo cual deberás consultar el procedimiento de descarga en la página del Seminario http://entrepares.conricyt.mx/</p>';
			$html .= '<p><strong>Número de Folio: '.$data['folio'].'</strong></p>';
			$html .= '<p><strong>Actividades seleccionadas:</strong></p>';
			
			if($usr) {
				$actividades1 = $this->registro->getActivitiesByUserDate($usr, '2014-09-22');
				$actividades2 = $this->registro->getActivitiesByUserDate($usr, '2014-09-23');
				$estatus_recorrido = $this->registro->getStatusTour($usr);
			} else {
				$actividades1 = $this->registro->getActivitiesByUserDate($data['id_usuario'], '2014-09-22');
				$actividades2 = $this->registro->getActivitiesByUserDate($data['id_usuario'], '2014-09-23');
				$estatus_recorrido = $this->registro->getStatusTour($data['id_usuario']);
			}
			
			$estatus_recorrido = ($estatus_recorrido) ? $estatus_recorrido->estatus : 0;
			
			if($estatus_recorrido == '1') {
				$html .= '<strong>21 de septiembre</strong>';
				$html .= '<p>13:00 a 20:30 &nbsp; Recorrido turístico a la Ciudad de Guanajuato.<br />Lugar de Reunión: Poliforum León.</p>';
				$html .= '<p>Nota: Si por alguna razón no puedes asistir al Recorrido Turístico es importante que te comuniques con la Oficina del Consorcio para cancelar tu lugar y otorgárselo a alguien más. Comunícate al (55) 5322 7700 Ext. 4020-4026</p>';
			} else if($estatus_recorrido == '2'){
				$html .= '<strong>21 de septiembre</strong>';
				$html .= '<p>16:00 a 19:00 &nbsp; Recorrido turístico a la Ciudad de Guanajuato.</p>';
				$html .= '<p>Podrás unirte al Recorrido Turístico en la Ciudad de Guanajuato. El grupo se reunirá en el Teatro Juárez a las 16 hrs, aunque puedes llegar antes. Recuerda que los gastos de la comida y del transporte que uses corren por tu cuenta.</p>';
				$html .= '<p>Consulta el itinerario del Recorrido en http://entrepares.conricyt.mx/sobre-el-evento/actividades-extraseminario</p>';
			}
			
			if($actividades1) {
				$html .= '<strong>22 de septiembre</strong>';
				$html .= '<ul>';
				foreach($actividades1->result() as $actividad) {
					$html .= '<li>'.$actividad->inicio.' a '.$actividad->fin.' &nbsp; '.utf8_decode($actividad->evento).'</li>';
				}
				$html .= '</ul>';
			}
			
			if($actividades2) {
				$html .= '<strong>23 de septiembre</strong>';
				$html .= '<ul>';
				foreach($actividades2->result() as $actividad) {
					$html .= '<li>'.$actividad->inicio.' a '.$actividad->fin.' &nbsp; '.utf8_decode($actividad->evento).'</li>';
				}
				$html .= '</ul>';
			}
			
			$html .= '<p class="firma">A t e n t a m e n t e,</p>';
			$html .= '<p><strong>Consorcio Nacional de Recursos de Información Científica y Tecnológica</strong></p>';
			$stylesheet = file_get_contents(base_url().'css/pdf.css');
			
			$this->load->library('pdf');
			$pdf = $this->pdf->load("c", "Letter", "", "", 20, 20, 45, 30, 10, 10);
			$pdf->SetHTMLHeader(utf8_encode($header));
			$pdf->SetHTMLFooter(utf8_encode($footer));
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->WriteHTML(utf8_encode($html));
			//$pdf->Output();
			$contenido_pdf = $pdf->Output(utf8_encode('Comprobante de pre registro.pdf'), 'S');
			return $contenido_pdf;
		}
		
		private function crearInvitacion($data) {
			error_reporting(0);
			
			list($fecha, $hora) = explode(" ", $data['fecha_alta']);
			$fecha = $this->formatearFecha($fecha);
			$nombre = utf8_decode($data['nombre']);
			$ap_paterno = utf8_decode($data['ap_paterno']);
			$ap_materno = utf8_decode($data['ap_materno']);
			$remitente = $this->strtoupper_utf8(trim($nombre." ".$ap_paterno." ".$ap_materno));
			$institucion = $this->strtoupper_utf8(utf8_decode(trim($data['institucion'])));
			$header = '<p class="header"><img src="'.base_url().'images/header_pdf.jpg" /></p>';
			$footer = '<p class="footer"><strong>Oficina del Consorcio Nacional de Recursos de Información Científica y Tecnológica</strong><br />Av. Insurgentes Sur 1582, Col. Crédito Constructor, Del. Benito Juárez, C.P. 03940 México D.F. – Tel: 5322 7700 ext. 4020 a la 4026</p>';
			$html = '<div class="contenido">';
			$html .= '<p class="titulo2">Consorcio Nacional de Recursos de Información Científica y Tecnológica</p>';
			$html .= '<p class="fecha">'.$fecha.'</p>';
			$html .= '<p class="remitente">ESTIMADO(A) '.$remitente.'<br />'.$institucion.'<br />P r e s e n t e:</p>';
			$html .= '<p>El Consorcio Nacional de Recursos de Información Científica y Tecnológica y el Centro de Investigación Científica de Yucatán (CICY), tienen el agrado de invitarle cordialmente a <strong>Entre Pares. Cuarto Seminario para publicar y navegar en las redes de la Información Científica</strong>, cuyo objetivo central es promover la producción de artículos científicos entre la comunidad académica de posgrado e investigación del país; propiciando un espacio de encuentro con las principales editoriales científicas internacionales.</p>';
			$html .= '<p>El Seminario tendrá lugar los días 5 y 6 de octubre de 2015, en el Centro de Convenciones Yucatán Siglo XXI, recinto Sede del Seminario, seleccionado por el Centro de Investigación Científica de Yucatán, institución coorganizadora del evento y cuyo programa completo podrá consultarlo en la página http://entrepares.conricyt.mx.';
			$html .= '<p>Agradecemos su interés en participar.</p>';
			$html .= '<p class="firma">A t e n t a m e n t e,</p>';
			$html .= '<blockquote><p><img src="'.base_url().'images/firma_pdf.jpg" /></p></blockquote>';
			$html .= '<p>Mtra. Margarita Ontiveros y Sánchez de la Barquera<br />Coordinadora General<br />Consorcio Nacional de Recursos de Información Científica y Tecnológica</p>';
			$html .= '</div>';
			$stylesheet = file_get_contents(base_url().'css/pdf.css');
			
			$this->load->library('pdf');
			$pdf = $this->pdf->load("c", "Letter", "", "", 20, 20, 45, 30, 10, 10);
			$pdf->SetHTMLHeader(utf8_encode($header));
			$pdf->SetHTMLFooter(utf8_encode($footer));
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->WriteHTML(utf8_encode($html));
			//$pdf->Output();
			$contenido_pdf = $pdf->Output(utf8_encode('Invitación a Entrepares.pdf'), 'S');
			return $contenido_pdf;
		}
		
		private function contenidoPDF($url) {
			$contenido = file_get_contents($url);
			$subcadena = '<div id="contenido">';
			$pos = strpos($contenido, $subcadena);
			$contenido = substr($contenido, $pos);
			$subcadena = '<div class="itemBackToTop">';
			$pos = strpos($contenido, $subcadena);
			$contenido = substr($contenido, 0, $pos);
			$contenido = str_replace('<div class="itemToolbar">', '<div class="itemToolbar" style="display:none;">', $contenido);
			$contenido = str_replace('<div class="widgetsRedes">', '<div class="widgetsRedes" style="display:none;">', $contenido);
			$contenido .= '</div>';
			$footer = '<p class="footer"><strong>CONSORCIO NACIONAL DE RECURSOS DE INFORMACIÓN CIENTÍFICA Y TECNOLÓGICA (CONRICYT)<br />Copyright &copy; 2014 Derechos Reservados</strong><br />Av. Insurgentes Sur 1582, Col. Crédito Constructor, Del. Benito Juárez, C.P. 03940 México D.F. – Tel: 5322 7700 ext. 4020 a la 4026</p>';

			$stylesheet = file_get_contents(base_url().'css/pdf.css');
			$this->load->library('pdf');
			$pdf = $this->pdf->load("c", "Letter", "", "", 20, 20, 20, 30, 10, 10);
			$pdf->SetHTMLFooter(utf8_encode($footer));
			$pdf->WriteHTML($stylesheet, 1);
			$pdf->WriteHTML($contenido);
			$contenido_pdf = $pdf->Output(utf8_encode('contenido.pdf'), 'S');
			return $contenido_pdf;
		}
		
		public function enviarContenido() {
			$correo = $this->input->post('correo_pdf');
			$url = $this->input->post('url');
			$this->load->library('phpmailer');
			$body = "<h5>Contenido del sitio de Entre Pares</h5>";
			$body .= "<br/><p>Contenido del sitio Entre Pares</p>";
			
			$this->phpmailer->IsSMTP();
			$this->phpmailer->SMTPDebug  = 0; 
			$this->phpmailer->SMTPAuth   = true;					// activa autenticación
			$this->phpmailer->Host       = "smtp.gmail.com";		// servidor de correo
			//$this->phpmailer->Host       = "74.125.136.108";		// servidor de correo
			$this->phpmailer->Port       = 465;                    // puerto de salida que usa Gmail
			$this->phpmailer->SMTPSecure = 'ssl';					// protocolo de autenticación
			$this->phpmailer->Username   = "conricyt@gmail.com";
			$this->phpmailer->Password   = 'C0nR1c17p1x3l8lu3';
			
			$this->phpmailer->SetFrom('conricyt@gmail.com', 'CONRICyT');
			$this->phpmailer->AddReplyTo('no-replay@conacyt.mx', 'CONRICyT');
			$this->phpmailer->Subject    = utf8_encode("Información de Entre Pares");
			$this->phpmailer->AltBody    = utf8_encode("Información de Entre Pares");
			
			$this->phpmailer->MsgHTML($body);
			
			$this->phpmailer->AddAddress($correo);
			
			$this->phpmailer->AddStringAttachment($this->contenidoPDF($url),'informacion.pdf');
			
			$this->phpmailer->CharSet = 'UTF-8';
			
			if(!$this->phpmailer->Send()) {
			  echo "Error al enviar correo: " . $this->phpmailer->ErrorInfo;
			} else {
			  echo "Correo enviado";
			}
		}
		
		private function enviarMail($data, $usr) {
			$this->load->library('phpmailer');
			$nombre = $data['nombre'];
			$ap_paterno = $data['ap_paterno'];
			$ap_materno = $data['ap_materno'];
			$remitente = $nombre." ".$ap_paterno." ".$ap_materno;
			$remitente = trim($remitente);
			$body = '<table width="100%" border="1" cellspacing="0" cellpadding="10" border="0" bordercolor="#FFFFFF"><tr><td bgcolor="#005199" align="center"><font size="4" face="Arial" color="#e0e0e0"><strong>Comprobante de preregistro y Carta invitaci&oacute;n para asistir al Seminario Entre Pares. Cuarto Seminario para publicar y navegar en las redes de la informaci&oacute;n cient&iacute;fica</strong></font></td></tr></table>';
			$body .= '<br /><br /><p><font size="3" face="Arial" color="#006699"><strong>&iexcl;Hola, '.$remitente.'!</strong></font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">En archivo anexo se te env&iacute;a la Carta Invitaci&oacute;n, la cual podr&aacute;s utilizar para gestionar en tu instituci&oacute;n el permiso y/o vi&aacute;ticos para asistir al Cuarto Seminario Entre Pares, que tendr&aacute; lugar los d&iacute;as 5 y 6 de octubre de 2015 en el Centro de Convenciones Yucat&aacute;n Siglo XXI.</font></p>';
			//$body .= '<p><font size="3" face="Arial" color="#006699">Para confirmar tu registro en la sede es necesario que lleves impreso el comprobante de preregistro o, en su defecto, presentar el c&oacute;digo QR en un dispositivo m&oacute;vil (tablet o celular). Una vez confirmado recibir&aacute;s el kit de bienvenida en donde encontrar&aacute;s tu gafete para acceder a las actividades acad&eacute;micas del Seminario.</p>';
			$body .= '<p><font size="3" face="Arial" color="#FF0000">En caso de alguna duda, por favor comun&iacute;cate al tel&eacute;fono (55) 5322 7700 ext. 4020 a 4026 o bien escr&iacute;benos a la cuenta entrepares@conricyt.mx</font></p>';
			$body .= '<table width="100%" border="1" cellspacing="0" cellpadding="10" border="0" bordercolor="#FFFFFF"><tr><td bgcolor="#e0e0e0" align="center"><font size="3" face="Arial" color="#005199"><strong>Consorcio Nacional de Recursos de Informaci&oacute;n Cient&iacute;fica y Tecnol&oacute;gica (CONRICYT)</strong></font></td></tr></table>';
			
			$this->phpmailer->IsSMTP();
			$this->phpmailer->SMTPDebug  = 0; 
			$this->phpmailer->SMTPAuth   = true;					// activa autenticación
			$this->phpmailer->Host       = "smtp.gmail.com";		// servidor de correo
			//$this->phpmailer->Host       = "74.125.136.108";		// servidor de correo
			$this->phpmailer->Port       = 465;                    // puerto de salida que usa Gmail
			$this->phpmailer->SMTPSecure = 'ssl';					// protocolo de autenticación
			$this->phpmailer->Username   = "conricyt@gmail.com";
			$this->phpmailer->Password   = 'C0nR1c17p1x3l8lu3';
			
			$this->phpmailer->SetFrom('conricyt@gmail.com', 'CONRICyT');
			$this->phpmailer->AddReplyTo('no-replay@conacyt.mx', 'CONRICyT');
			$this->phpmailer->Subject    = "Seminario Entre Pares 2015";
			$this->phpmailer->AltBody    = "Seminario Entre Pares 2015";
			
			$this->phpmailer->MsgHTML($body);
			
			$this->phpmailer->AddAddress($data['correo'], $remitente);
			
			$this->phpmailer->AddStringAttachment($this->crearInvitacion($data), 'invitacion.pdf');
			//$this->phpmailer->AddStringAttachment($this->crearComprobante($data, $usr),'comprobante.pdf');
			
			$this->phpmailer->CharSet = 'UTF-8';
			
			if(!$this->phpmailer->Send()) {
			  //echo "Error al enviar correo: " . $this->phpmailer->ErrorInfo;
			} else {
			  //echo "Correo enviado";
			}
		}
		
		private function enviarMailComprobante($usr) {
			$datos = $this->registro->getUserById($usr);
			$data = array();
			
			foreach($datos as $key=>$val) {
				$data[$key] = $val;
			}
			$this->load->library('phpmailer');
			$nombre = $data['nombre'];
			$ap_paterno = $data['ap_paterno'];
			$ap_materno = $data['ap_materno'];
			$remitente = $nombre." ".$ap_paterno." ".$ap_materno;
			$remitente = trim($remitente);
			$body = '<table width="100%" border="1" cellspacing="0" cellpadding="10" border="0" bordercolor="#FFFFFF"><tr><td bgcolor="#005199" align="center"><font size="4" face="Arial" color="#e0e0e0"><strong>Comprobante de preregistro para asistir al Seminario Entre Pares. Cuarto Seminario para publicar y navegar en las redes de la informaci&oacute;n cient&iacute;fica</strong></font></td></tr></table>';
			$body .= '<br /><br /><p><font size="3" face="Arial" color="#006699"><strong>&iexcl;Hola, '.$remitente.'!</strong></font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">En archivo anexo se te env&iacute;a el comprobante de preregistro, el cual es necesario que lleves impreso o, en su defecto, presentar el c&oacute;digo QR en un dispositivo m&oacute;vil (tablet o celular). Una vez confirmado recibir&aacute;s el kit de bienvenida en donde encontrar&aacute;s tu gafete para acceder a las actividades acad&eacute;micas del Seminario.</p>';
			$body .= '<p><font size="3" face="Arial" color="#FF0000">En caso de alguna duda, por favor comun&iacute;cate al tel&eacute;fono (55) 5322 7700 ext. 4020 a 4026 o bien escr&iacute;benos a la cuenta entrepares@conricyt.mx</font></p>';
			$body .= '<table width="100%" border="1" cellspacing="0" cellpadding="10" border="0" bordercolor="#FFFFFF"><tr><td bgcolor="#e0e0e0" align="center"><font size="3" face="Arial" color="#005199"><strong>Consorcio Nacional de Recursos de Informaci&oacute;n Cient&iacute;fica y Tecnol&oacute;gica (CONRICYT)</strong></font></td></tr></table>';
			
			$this->phpmailer->IsSMTP();
			$this->phpmailer->SMTPDebug  = 0; 
			$this->phpmailer->SMTPAuth   = true;					// activa autenticación
			$this->phpmailer->Host       = "smtp.gmail.com";		// servidor de correo
			//$this->phpmailer->Host       = "74.125.136.108";		// servidor de correo
			$this->phpmailer->Port       = 465;                    // puerto de salida que usa Gmail
			$this->phpmailer->SMTPSecure = 'ssl';					// protocolo de autenticación
			$this->phpmailer->Username   = "conricyt@gmail.com";
			$this->phpmailer->Password   = 'C0nR1c17p1x3l8lu3';
			
			$this->phpmailer->SetFrom('conricyt@gmail.com', 'CONRICyT');
			$this->phpmailer->AddReplyTo('no-replay@conacyt.mx', 'CONRICyT');
			$this->phpmailer->Subject    = "Seminario Entre Pares 2015";
			$this->phpmailer->AltBody    = "Seminario Entre Pares 2015";
			
			$this->phpmailer->MsgHTML($body);
			
			$this->phpmailer->AddAddress($data['correo'], $remitente);
			
			$this->phpmailer->AddStringAttachment($this->crearComprobante($data, $usr),'comprobante.pdf');
			
			$this->phpmailer->CharSet = 'UTF-8';
			
			if(!$this->phpmailer->Send()) {
			  //echo "Error al enviar correo: " . $this->phpmailer->ErrorInfo;
			} else {
			  //echo "Correo enviado";
			}
		}
		
		public function enviarMailUrl() {
			$id = $this->input->post('id');
			
			if(!$id) {
				die("Error");
			}
			
			$datos = $this->registro->getUserById($id);
			$data = array();
			
			foreach($datos as $key=>$val) {
				$data[$key] = $val;
			}
			
			$this->load->library('phpmailer');
			$nombre = $data['nombre'];
			$ap_paterno = $data['ap_paterno'];
			$ap_materno = $data['ap_materno'];
			$remitente = $nombre." ".$ap_paterno." ".$ap_materno;
			$remitente = trim($remitente);
			$body = '<br /><br /><p><font size="3" face="Arial" color="#006699"><strong>&iexcl;Hola, '.$remitente.'!</strong></font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">Agradecemos el haber obtenido la Carta Invitaci&oacute;n, sin embargo es importante que contin&uacute;es con el procedimiento para elegir las conferencias o talleres de tu inter&eacute;s y as&iacute; concluir con tu Preregistro para el Seminario Entre Pares 2015.</font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">A continuaci&oacute;n, considera los siguientes pasos:</font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">1. Dar clic o copiar y pegar la siguiente url en tu navegador:</font></p>';
			$body.= '<p><font size="3" face="Arial"><a href="'.base_url().'preregistro/seleccionar-actividades/'.md5($data['id_usuario']).'">'.base_url().'preregistro/seleccionar-actividades/'.md5($data['id_usuario']).'</a></font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">2. Se mostrar&aacute; una p&aacute;gina en donde encontrar&aacute;s tres botones que debes llenar de manera obligatoria. En los dos primeros botones selecciona las actividades de tu inter&eacute;s por d&iacute;a del Seminario. Y el tercero corresponde a un recorrido Tur&iacute;stico en Guanajuato si es de tu inter&eacute;s.</font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">3. Al t&eacute;rmino del llenado del formulario deber&aacute;s dar clic sobre el bot&oacute;n "Enviar"</font></p>';
			$body .= '<p><font size="3" face="Arial" color="#006699">4. Recibir&aacute;s un correo electr&oacute;nico con tu comprobante de Preregistro que incluye un c&oacute;digo QR que deber&aacute;s presentar en la sede para confirmar tu Registro</font></p>';
			$body .= '<p><font size="3" face="Arial" color="#FF0000">En caso de alguna duda, por favor comun&iacute;cate al tel&eacute;fono (55) 5322 7700 ext. 4020 a 4026 o bien escr&iacute;benos a la cuenta entrepares@conricyt.mx</font></p>';
			$body .= '<table width="100%" border="1" cellspacing="0" cellpadding="10" border="0" bordercolor="#FFFFFF"><tr><td bgcolor="#e0e0e0" align="center"><font size="3" face="Arial" color="#005199"><strong>Consorcio Nacional de Recursos de Informaci&oacute;n Cient&iacute;fica y Tecnol&oacute;gica (CONRICYT)</strong></font></td></tr></table>';
			
			$this->phpmailer->IsSMTP();
			$this->phpmailer->SMTPDebug  = 0; 
			$this->phpmailer->SMTPAuth   = true;					// activa autenticación
			$this->phpmailer->Host       = "pro.turbo-smtp.com";		// servidor de correo
			//$this->phpmailer->Host       = "74.125.136.108";		// servidor de correo
			$this->phpmailer->Port       = 465;                    // puerto de salida que usa Gmail
			$this->phpmailer->SMTPSecure = 'ssl';					// protocolo de autenticación
			$this->phpmailer->Username   = "entrepares@conricyt.mx";
			$this->phpmailer->Password   = '76uZpdjk';
			
			$this->phpmailer->SetFrom('entrepares@conricyt.mx', 'Entrepares CONRICyT');
			$this->phpmailer->AddReplyTo('no-replay@conacyt.mx', 'Entrepares CONRICyT');
			$this->phpmailer->Subject    = "Seminario Entre Pares 2014";
			$this->phpmailer->AltBody    = "Seminario Entre Pares 2014";
			
			$this->phpmailer->MsgHTML($body);
			
			$this->phpmailer->AddAddress($data['correo'], $remitente);
			
			$this->phpmailer->CharSet = 'UTF-8';
			
			if(!$this->phpmailer->Send()) {
			  echo "Error al enviar correo: " . $this->phpmailer->ErrorInfo;
			} else {
			  echo "Correo enviado";
			}
		}
		
		public function index() {
			$this->load->helper('form');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['title'] = utf8_encode('Preregistro');
			$data['tools'] = $herramienta->printTitle(utf8_encode("Preregistro"));
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['entidades'] = $this->registro->getEntities();
			$data['perfiles'] = $this->registro->getProfiles();
			$data['cargos'] = $this->registro->getPositions();
			$data['medios_informacion'] = $this->registro->getInformation();
			$data['transportes'] = $this->registro->getTransports();
			//$data['eventos1'] = $this->registro->getSchedule('2014-09-22', '1');
			//$data['eventos2'] = $this->registro->getSchedule('2014-09-22', '2,3,4,5,6,7,8,9');
			//$data['columnas'] = $this->registro->getColumns(array(2,3,4,5,6,7,8,9));
			//$data['filas1'] = $this->registro->getRows('2014-09-22', '2,3,4,5,6,7,8,9');
			//$data['eventos3'] = $this->registro->getSchedule('2014-09-23', '1');
			//$data['eventos4'] = $this->registro->getSchedule('2014-09-23', '2,3,4,5,6,7,8,9');
			//$data['filas2'] = $this->registro->getRows('2014-09-23', '2,3,4,5,6,7,8,9');
			$data['total_recorrido'] = $this->registro->getTotalTours();
			$this->load->view('header', $data);
			$this->load->view('registro/formulario', $data);
			$this->load->view('footer');
		}
		
		public function seleccionar_actividades() {
			/*$id = addslashes($this->uri->segment(3));
			
			if(!$id) {
				redirect(base_url().'preregistro/index');
			}
			
			$usr = $this->registro->getUserByMD5($id);
			
			if(!$usr) {
				redirect(base_url().'preregistro/index');
			}
			
			$this->load->helper('form');*/
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['title'] = utf8_encode('Preregistro');
			$data['tools'] = $herramienta->printTitle(utf8_encode("Preregistro"));
			$data['toolsPie'] = $herramienta->printBackToTop();
			/*$data['con_actividades'] = $this->registro->userIsEnrolled($usr->id_usuario);
			$data['usuario'] = $usr;
			$data['eventos1'] = $this->registro->getSchedule('2014-09-22', '1');
			$data['eventos2'] = $this->registro->getSchedule('2014-09-22', '2,3,4,5,6,7,8,9');
			$data['columnas'] = $this->registro->getColumns(array(2,3,4,5,6,7,8,9));
			$data['filas1'] = $this->registro->getRows('2014-09-22', '2,3,4,5,6,7,8,9');
			$data['eventos3'] = $this->registro->getSchedule('2014-09-23', '1');
			$data['eventos4'] = $this->registro->getSchedule('2014-09-23', '2,3,4,5,6,7,8,9');
			$data['filas2'] = $this->registro->getRows('2014-09-23', '2,3,4,5,6,7,8,9');
			$data['total_recorrido'] = $this->registro->getTotalTours();*/
			$this->load->view('header', $data);
			//$this->load->view('registro/actividades', $data);
			$this->load->view('footer');
		}
		
		public function pendientes() {
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['title'] = utf8_encode('Pendientes');
			$data['tools'] = $herramienta->printTitle(utf8_encode("Usuarios pendientes de actividades"));
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['usuarios'] = $this->registro->getUsersToEnroll();
			$this->load->view('header', $data);
			$this->load->view('registro/pendientes', $data);
			$this->load->view('footer');
		}
		
		public function alta() {
			$extension = trim($this->input->post('extension'));
			if($extension) {
				$extension = " ext. ".$extension;
			}
			
			$usr = $this->input->post('hdn_usuario');
			
			$data['fecha_alta'] = date("Y-m-d H:i:s");
			$data['folio'] = $this->generarFolio();
			$data['nombre'] = $this->formatearNombre($this->input->post('nombre'));
			$data['ap_paterno'] = $this->formatearNombre($this->input->post('ap_paterno'));
			$data['ap_materno'] = $this->formatearNombre($this->input->post('ap_materno'));
			$data['sexo'] = $this->input->post('sexo');
			$data['institucion'] = trim($this->input->post('institucion'));
			$data['entidad'] = $this->input->post('entidad');
			$data['id_perfil'] = $this->input->post('perfil');
			$data['perfil'] = trim($this->input->post('otro_perfil'));
			$data['id_cargo'] = $this->input->post('cargo');
			$data['cargo'] = trim($this->input->post('otro_cargo'));
			$data['telefono'] = trim($this->input->post('telefono')).$extension;
			$data['correo'] = mb_strtolower(trim($this->input->post('correo')));
			$data['como_se_entero'] = $this->input->post('como_se_entero');
			$data['forma_transporte'] = $this->input->post('transporte');
			$eventos = $this->input->post('id_evento');
			
			if ( $usr ) {
				// Se actualiza el registro
				$this->registro->updateUser($usr, $data);
			} else {
				// Se inserta nuevo registro
				$usr = $this->registro->insertData($data);
			}
			
			if ( !$this->registro->checkUser($usr) ) {
				$this->registro->insertProgram($usr, $data);
			
				$this->enviarMail($data, $usr);
				//echo utf8_encode('¡Su solicitud se ha procesado correctamente!<br />Usted ha recibido en su cuenta de correo la carta invitación, así como las indicaciones correspondientes<br /><span style="font-size:12px;"><a href="'.base_url('preregistro/reimprimirInvitacion/'.$usr).'" target="_blank">Descargar invitación</a> &nbsp; <a href="'.base_url('preregistro/reimprimirComprobante/'.$usr).'" target="_blank">Descargar comprobante</a></span>');
				echo utf8_encode('¡Su solicitud se ha procesado correctamente!<br />Usted ha recibido en su cuenta de correo la carta invitación así como las indicaciones correspondientes<br /><span style="font-size:12px;"><a href="'.base_url('preregistro/reimprimirInvitacion/'.$usr).'" target="_blank">Descargar invitación</a></span>');
			} else {
				echo utf8_encode("El usuario ya está registrado");
			}
			
			/*if(!$this->registro->checkUser($data['correo'])) {
				$usr = $this->registro->insertData($data);
				
				foreach($eventos as $val) {
					$this->registro->insertActivity($usr, $val);
				}
				
				if($this->input->post('chk_recorrido')) {
					$recorrido['llegada'] = $this->fechaMySQL($this->input->post('fecha_llegada'))." ".$this->input->post('hora_llegada');
					$recorrido['celular'] = $this->input->post('celular');
					$recorrido['estatus'] = ($this->registro->getTotalTours() < 132) ? 1: 2;
					$recorrido['usuario'] = $usr;
					//$this->registro->insertTour($recorrido);
				}

				$this->enviarMail($data, $usr);
				echo utf8_encode('¡Su solicitud se ha procesado correctamente!<br />Usted ha recibido en su cuenta de correo la carta invitación, así como las indicaciones correspondientes<br /><span style="font-size:12px;"><a href="'.base_url('preregistro/reimprimirInvitacion/'.$usr).'" target="_blank">Descargar invitación</a> &nbsp; <a href="'.base_url('preregistro/reimprimirComprobante/'.$usr).'" target="_blank">Descargar comprobante</a></span>');
			} else {
				echo utf8_encode("El usuario ya está registrado");
			}*/
		}
		
		public function agregarActividades() {
			$usr = $this->input->post('id_usuario');
			$eventos = $this->input->post('id_evento');
			
			if(!$this->registro->userIsEnrolled($usr)) {
				foreach($eventos as $val) {
					$this->registro->insertActivity($usr, $val);
				}
				
				if($this->input->post('chk_recorrido')) {
					$recorrido['llegada'] = $this->fechaMySQL($this->input->post('fecha_llegada'))." ".$this->input->post('hora_llegada');
					$recorrido['celular'] = $this->input->post('celular');
					$recorrido['estatus'] = ($this->registro->getTotalTours() < 132) ? 1: 2;
					$recorrido['usuario'] = $usr;
					//$this->registro->insertTour($recorrido);
				}

				$this->enviarMailComprobante($usr);
				echo utf8_encode("¡Tu solicitud se ha procesado correctamente!<br />Has recibido en tu cuenta de correo el comprobante de prerregistro, así como las indicaciones correspondientes");
			} else {
				echo utf8_encode("Ya has seleccionado cursos previamente");
			}
		}
		
		public function autocompletar() {
			$cadena = $this->input->get('term');
			$instituciones = $this->registro->getInstitutions($cadena);
			$valores = array();
			foreach($instituciones->result() as $val) {
				array_push($valores, $val->institucion);
			}
			
			echo json_encode($valores);
		}
		
		public function reimprimirInvitacion() {
			$id = $this->uri->segment(3);
			settype($id, "int");
			$datos = $this->registro->getUserById($id);
			$data = array();
			
			foreach($datos as $key=>$val) {
				$data[$key] = $val;
			}
			$pdf = $this->crearInvitacion($data);
			header('Content-type: application/pdf');
			echo $pdf;
		}
		
		public function reimprimirComprobante() {
			$id = $this->uri->segment(3);
			settype($id, "int");
			$datos = $this->registro->getUserById($id);
			$data = array();
			
			foreach($datos as $key=>$val) {
				$data[$key] = $val;
			}
			$pdf = $this->crearComprobante($data);
			header('Content-type: application/pdf');
			echo $pdf;
		}
	}
?>