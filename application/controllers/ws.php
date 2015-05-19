<?php
	class Ws extends CI_Controller {
		function index() {
			$this->load->library("nuSoap_lib");
			$this->nusoap_server = new nusoap_server();
			$this->nusoap_server->configureWSDL("conricyt_wsdl", "urn:conricyt_wsdl");
	
			$this->nusoap_server->register('hello',                // method name
				array('name' => 'xsd:string'),        // input parameters
				array('return' => 'xsd:string'),      // output parameters
				'urn:conricyt_wsdl',                      // namespace
				'urn:conricyt_wsdl#hello',                // soapaction
				'rpc',                                // style
				'encoded',                            // use
				'Says hello to the caller'            // documentation
			);
			
			if($this->uri->rsegment(3) == "wsdl") {
				$_SERVER['QUERY_STRING'] = "wsdl";
			} else {
				$_SERVER['QUERY_STRING'] = "";
			}
			
			$this->nusoap_server->service(file_get_contents("php://input"));
		}
		
		function hello_a() {
			function hello($name) {
					return 'Hello, ' . $name;
			}
			$this->nusoap_server->service(file_get_contents("php://input"));
		}
	}
?>