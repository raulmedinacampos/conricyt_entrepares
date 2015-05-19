<?php
	class Reporte extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('reporte_model', 'reporte', TRUE);
		}
		
		private function formatearFecha($fecha) {
			$meses = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
			list($anio, $mes, $dia) = explode("-", $fecha);
			$str_fecha = $dia." de ".$meses[(int)$mes]." de ".$anio;
			return $str_fecha;
		}
		
		public function index() {
			$registros = $this->reporte->getRegs();
			$data['title'] = utf8_encode('Reporte general');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Reporte general"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['registros'] = $registros;
			$data['total'] = $this->reporte->totalRegs();
			$this->load->view('header', $data);
			$this->load->view('reportes/general', $data);
			$this->load->view('footer');
		}
		
		public function por_institucion() {
			$registros = $this->reporte->getRegsByInst();
			$registros_aux = $registros->result();
			
			$xls = addslashes($this->uri->segment(3));
			
			if($xls) {
				$this->load->library('excel');
				$fila = 1;
				
				// Contenido de las celdas
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setSize(18);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('Reporte por institución'));
				$fila+=2;
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('Total de registrados: '.$this->reporte->totalRegs()));
				$fila+=2;

				// Encabezados
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->getColor()->setRGB('FFFFFF');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('484F56');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$this->excel->getActiveSheet()
									->setCellValue('A'.$fila, utf8_encode('Institución'))
									->setCellValue('B'.$fila, utf8_encode('Registrados'));
				$fila++;
									
				// Datos
				for($i=0; $i<sizeof($registros_aux); $i++) {
					$row = $registros_aux[$i];
					$this->excel->getActiveSheet()
										->setCellValue('A'.$fila, strip_tags($row->institucion))
										->setCellValue('B'.$fila, utf8_encode($row->total));
					
					$setColor = ($fila > 1 && $fila % 2 == 1) ? true : false;
					
					if($setColor) {
						$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DEE1E2');
					}
					
					$fila++;
				}
				
				// Ancho de las columnas
				$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				
				// Nombre de la hoja
				$this->excel->getActiveSheet()->setTitle(utf8_encode('Por institución'));

				// Headers para salida de archivo xlsx
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="reporte_por_institucion.xlsx"');
				header('Cache-Control: max-age=0');
				// Header para IE9
				header('Cache-Control: max-age=1');
				
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
				$objWriter->save("php://output");
				exit();
			}
			
			$data['title'] = utf8_encode('Reporte por institución');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Reporte por institución"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['registros'] = $registros;
			$data['total'] = $this->reporte->totalRegs();
			$this->load->view('header', $data);
			$this->load->view('reportes/institucion', $data);
			$this->load->view('footer');
		}
		
		public function por_dia() {
			$datos = $this->reporte->getRegsByDay();
			$datos_aux = $datos->result();
			
			foreach($datos_aux as &$val) {
				$val->fecha = $this->formatearFecha($val->fecha)."<br/>";
			}
			
			$xls = addslashes($this->uri->segment(3));
			
			if($xls) {
				$this->load->library('excel');
				$fila = 1;
				
				// Contenido de las celdas
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setSize(18);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('Reporte por día'));
				$fila+=2;
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('Total de registrados: '.$this->reporte->totalRegs()));
				$fila+=2;

				// Encabezados
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFont()->getColor()->setRGB('FFFFFF');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('484F56');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$this->excel->getActiveSheet()
									->setCellValue('A'.$fila, utf8_encode('Día'))
									->setCellValue('B'.$fila, utf8_encode('Registrados'));
				$fila++;
									
				// Datos
				for($i=0; $i<sizeof($datos_aux); $i++) {
					$row = $datos_aux[$i];
					$this->excel->getActiveSheet()
										->setCellValue('A'.$fila, utf8_encode(strip_tags($row->fecha)))
										->setCellValue('B'.$fila, utf8_encode($row->total));
					
					$setColor = ($fila > 1 && $fila % 2 == 1) ? true : false;
					
					if($setColor) {
						$this->excel->getActiveSheet()->getStyle('A'.$fila.':B'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DEE1E2');
					}
					
					$fila++;
				}
				
				// Ancho de las columnas
				$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
				
				// Nombre de la hoja
				$this->excel->getActiveSheet()->setTitle(utf8_encode('Por día'));

				// Headers para salida de archivo xlsx
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="reporte_por_dia.xlsx"');
				header('Cache-Control: max-age=0');
				// Header para IE9
				header('Cache-Control: max-age=1');
				
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
				$objWriter->save("php://output");
				exit();
			}
			
			$data['title'] = utf8_encode('Reporte por día');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Reporte por día"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['total'] = $this->reporte->totalRegs();
			$data['registros'] = $datos_aux;
			
			$this->load->view('header', $data);
			$this->load->view('reportes/dia', $data);
			$this->load->view('footer');
		}
		
		public function por_region() {
			$data['title'] = utf8_encode('Reporte por región');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Reporte por región"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['total'] = $this->reporte->totalRegs();
			$data['registros'] = $this->reporte->getRegsByRegions();
			
			$this->load->view('header', $data);
			$this->load->view('reportes/region', $data);
			$this->load->view('footer');
		}
		
		public function por_actividad() {
			$this->load->model('registro_model', 'registro', TRUE);
			
			$data['title'] = utf8_encode('Reporte por actividad');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Reporte por actividad"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['eventos1'] = $this->registro->getSchedule('2014-09-22', '1');
			$data['eventos2'] = $this->registro->getSchedule('2014-09-22', '2,3,4,5,6,7,8,9');
			$data['columnas'] = $this->registro->getColumns(array(2,3,4,5,6,7,8,9));
			$data['filas1'] = $this->registro->getRows('2014-09-22', '2,3,4,5,6,7,8,9');
			$data['eventos3'] = $this->registro->getSchedule('2014-09-23', '1');
			$data['eventos4'] = $this->registro->getSchedule('2014-09-23', '2,3,4,5,6,7,8,9');
			$data['filas2'] = $this->registro->getRows('2014-09-23', '2,3,4,5,6,7,8,9');
			$data['registrados'] = $this->reporte->getEnrolledByActivities();
			$data['total'] = $this->reporte->totalRegs();
			
			$this->load->view('header', $data);
			$this->load->view('reportes/actividad', $data);
			$this->load->view('footer');
		}
		
		public function por_actividad_dia() {
			$datos1 = $this->reporte->getEnrolledByActivityByDay('2014-09-22');
			$datos_aux1 = $datos1->result();
			
			foreach($datos_aux1 as &$val) {
				$val->evento = str_replace("<br />", " ", $val->evento);
			}
			
			$datos2 = $this->reporte->getEnrolledByActivityByDay('2014-09-23');
			$datos_aux2 = $datos2->result();
			
			foreach($datos_aux2 as &$val) {
				$val->evento = str_replace("<br />", " ", $val->evento);
			}
			
			$xls = addslashes($this->uri->segment(3));
			
			if($xls) {
				$this->load->library('excel');
				$fila = 1;
				
				// Contenido de las celdas
				$this->excel->setActiveSheetIndex(0);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setSize(18);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('Reporte por actividades por día'));
				$fila+=2;
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('22 de septiembre'));
				$fila+=2;

				// Encabezados
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFont()->getColor()->setRGB('FFFFFF');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('484F56');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$this->excel->getActiveSheet()
									->setCellValue('A'.$fila, utf8_encode('Horario'))
									->setCellValue('B'.$fila, utf8_encode('Eventos'))
									->setCellValue('C'.$fila, utf8_encode('Registrados'));
				$fila++;
									
				// Datos
				for($i=0; $i<sizeof($datos_aux1); $i++) {
					$row = $datos_aux1[$i];
					$this->excel->getActiveSheet()
										->setCellValue('A'.$fila, utf8_encode($row->inicio.' - '.$row->fin))
										->setCellValue('B'.$fila, $row->evento)
										->setCellValue('C'.$fila, utf8_encode($row->total));
					
					$setColor = ($fila > 1 && $fila % 2 == 1) ? true : false;
					
					if($setColor) {
						$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DEE1E2');
					}
					
					$fila++;
				}
				
				// Ancho de las columnas
				$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				
				// Nombre de la hoja
				$this->excel->getActiveSheet()->setTitle(utf8_encode('22 de septiembre'));
				
				// Segunda hoja
				$fila = 1;
				$this->excel->createSheet(1);
				$this->excel->setActiveSheetIndex(1);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setSize(18);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('Reporte por actividades por día'));
				$fila+=2;
				$this->excel->getActiveSheet()->getStyle('A'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->setCellValue('A'.$fila, utf8_encode('23 de septiembre'));
				$fila+=2;

				// Encabezados
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFont()->getColor()->setRGB('FFFFFF');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('484F56');
				$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				
				$this->excel->getActiveSheet()
									->setCellValue('A'.$fila, utf8_encode('Horario'))
									->setCellValue('B'.$fila, utf8_encode('Eventos'))
									->setCellValue('C'.$fila, utf8_encode('Registrados'));
				$fila++;
									
				// Datos
				for($i=0; $i<sizeof($datos_aux2); $i++) {
					$row = $datos_aux2[$i];
					$this->excel->getActiveSheet()
										->setCellValue('A'.$fila, utf8_encode($row->inicio.' - '.$row->fin))
										->setCellValue('B'.$fila, $row->evento)
										->setCellValue('C'.$fila, utf8_encode($row->total));
					
					$setColor = ($fila > 1 && $fila % 2 == 1) ? true : false;
					
					if($setColor) {
						$this->excel->getActiveSheet()->getStyle('A'.$fila.':C'.$fila)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DEE1E2');
					}
					
					$fila++;
				}
				
				// Ancho de las columnas
				$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
				$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
				
				// Nombre de la hoja
				$this->excel->getActiveSheet()->setTitle(utf8_encode('23 de septiembre'));

				// Headers para salida de archivo xlsx
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="reporte_por_actividad_por_dia.xlsx"');
				header('Cache-Control: max-age=0');
				// Header para IE9
				header('Cache-Control: max-age=1');
				
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
				$objWriter->save("php://output");
				exit();
			}
			
			$data['title'] = utf8_encode('Reporte por actividad por día');
			$this->load->library('herramientas');
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Reporte por actividad por día"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['registros1'] = $datos_aux1;
			$data['registros2'] = $datos_aux2;
			
			$this->load->view('header', $data);
			$this->load->view('reportes/actividad_dia', $data);
			$this->load->view('footer');
		}
		
		public function numeralia() {
			$data['title'] = utf8_encode('Numeralia Entre Pares 2014');
			$this->load->library('herramientas');
			$totalTipo = 0;
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Numeralia Entre Pares 2014"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			$data['total'] = $this->reporte->totalRegs();
			$data['totalSede'] = $this->reporte->totalRegs(1);
			$data['resEntidad'] = $this->reporte->getRegsByState();
			$data['resRegion'] = $this->reporte->getRegsByRegions();
			$data['resSexo'] = $this->reporte->getRegsByGenre();
			
			$tipoInstitucion = $this->reporte->getRegsByInstitutionType();
			$resTipoInstitution = $tipoInstitucion->result();
			
			foreach($resTipoInstitution as $val) {
				$totalTipo += $val->total;
			}
			
			$otros = $data['total'] - $totalTipo;
			
			foreach($resTipoInstitution as &$val) {
				if($val->tipo_institucion == 'Otras Instituciones') {
					$val->total += $otros;
				}
			}
			
			$data['resTipoInstitucion'] = $resTipoInstitution;
			$data['resPerfil'] = $this->reporte->getRegsByProfiles();
			
			$this->load->view('header', $data);
			$this->load->view('reportes/numeralia', $data);
			$this->load->view('footer');
		}
		
		public function numeralia_sede() {
			$data['title'] = utf8_encode('Numeralia (Sede) Entre Pares 2014');
			$this->load->library('herramientas');
			$totalTipo = 0;
			$herramienta = new Herramientas();
			$data['tools'] = $herramienta->printTitle(utf8_encode("Numeralia (Sede) Entre Pares 2014"));
			$data['tools'] .= $herramienta->printTools();
			$data['toolsPie'] = $herramienta->printBackToTop();
			
			$this->load->model('numeralia_sede_model', 'numeralia', TRUE);
			$data['total'] = $this->numeralia->totalRegs();
			$data['totalSede'] = $this->numeralia->totalRegs(1);
			$data['resEntidad'] = $this->numeralia->getRegsByState();
			$data['resRegion'] = $this->numeralia->getRegsByRegions();
			$data['resSexo'] = $this->numeralia->getRegsByGenre();
			
			$tipoInstitucion = $this->numeralia->getRegsByInstitutionType();
			$resTipoInstitution = $tipoInstitucion->result();
			
			foreach($resTipoInstitution as $val) {
				$totalTipo += $val->total;
			}
			
			$otros = $data['total'] - $totalTipo;
			
			foreach($resTipoInstitution as &$val) {
				if($val->tipo_institucion == 'Otras Instituciones') {
					$val->total += $otros;
				}
			}
			
			$data['resTipoInstitucion'] = $resTipoInstitution;
			$data['resPerfil'] = $this->numeralia->getRegsByProfiles();
			
			$this->load->view('header', $data);
			$this->load->view('reportes/numeralia', $data);
			$this->load->view('footer');
		}
	}
?>