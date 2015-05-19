<?php
if ( ! defined('BASEPATH')) exit('No se permite el acceso directo a las p&aacute;ginas de este sitio.');

class Cliente_nusoap extends CI_Controller {

   function index() {
   }  // end function

   /*
    * Método para probar el servicio web creado con la integración de NuSoap + CodeIgniter
   */
   function confirmar() {
	  $this->load->library('nusoap_lib');
      // Estos parametros no los necesitamos en este ejemplo, pero los pongo para que tengas idea de
      // todo lo que se puede configurar en nuestra petición
      $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
      $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
      $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
      $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

      // Instanciamos la clase cliente de nusoap
      //$this->client = new nusoap_client('http://entrepares.dev/ws/hello_a/wsdl', 'wsdl',
	  $this->client = new nusoap_client('http://entrepares.dev/prueba_ws.php?wsdl', 'wsdl',
              $proxyhost, $proxyport, $proxyusername, $proxypassword);

      // Cachamos algún error en los parámetros dados
      $err = $this->client->getError();
      if ($err) {
         echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
      } // endif

      // ¡Importante!
      //  Hacemos la llamada al método en forma de clase (Controlador..Nombre del método)
      $call = 'hello';

      $result = $this->client->call($call, array('id' => 5));

      // Gestionamos la respuesta
      $this->_manage_response($result, $this->client->fault, $this->client->getError());

      return;
   } // end function

function get_weather() {
	  $this->load->library('nusoap_lib');
      $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
      $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
      $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
      $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

      $this->client = new nusoap_client('http://www.webservicex.net/globalweather.asmx?WSDL', 'wsdl',
              $proxyhost, $proxyport, $proxyusername, $proxypassword);

      $err = $this->client->getError();
      if ($err) {
         echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
      } // endif

      $method = isset($_GET['method']) ? $_GET['method'] : 'function';

      $call = 'GetCitiesByCountry';

      $parts = array('CountryName' => 'Mexico');
      $result = $this->client->call($call, $parts);

      $this->_manage_response($result, $this->client->fault, $this->client->getError());

      return;
   } //end function

   /*
    * Acción predeterminada para las pruebas del webservices cliente
   */
   private function _manage_response($result, $is_fault, $is_error) {
      // Fallas
      if ($is_fault) {
         echo '<h2>Falla:</h2><pre>';
         print_r($result);
         echo '</pre>';
         echo '<h2>Request</h2><pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
         echo '<h2>Response</h2><pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
         echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
      } else {
         // Errores
         if ($is_error) {
            // Imprimir los detalles del error
            echo '<h2>Error:</h2><pre>' . $is_error . '</pre>';
            echo '<h2>Request</h2><pre>' . htmlspecialchars($this->client->request, ENT_QUOTES) . '</pre>';
            echo '<h2>Response</h2><pre>' . htmlspecialchars($this->client->response, ENT_QUOTES) . '</pre>';
            echo '<h2>Debug</h2><pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
         } else {
            // ¡Que felicidad, desplegamos el resultado!
            echo '<h2>Resultado:</h2><pre>';
            print_r($result);
            echo '</pre>';
         }
      }
      return;
   } // end function


} // end Class
?>