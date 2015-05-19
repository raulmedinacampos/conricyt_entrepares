<?php
if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Herramientas {
	public function printDate($file) {
		$dia = array('domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado');
		$mes = array('', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
		$fecha = 'Actualizado: ';
		$fecha .= $dia[date("w", filemtime(APPPATH.'views/'.$file.'.php'))]." ";
		$fecha .= date("d", filemtime(APPPATH.'views/'.$file.'.php'))." de ";
		$fecha .= $mes[date("n", filemtime(APPPATH.'views/'.$file.'.php'))]." de ";
		$fecha .= date("Y", filemtime(APPPATH.'views/'.$file.'.php')). ", ";
		$fecha .= date("H:i:s", filemtime(APPPATH.'views/'.$file.'.php'));
		return '<span class="itemFechaCreacion">'.utf8_encode($fecha).'</span>';
	}
	
	public function printTitle($titulo) {
		return "<h2 class='itemTitle'>$titulo</h2>";
	}
	
	public function printTools() {
		return '
		<div class="itemToolbar">
		  <ul>
			<li>
			  <span>tama&ntilde;o de la fuente</span>
			  <a href="#" class="zoom_out"><img src="'.base_url().'images/font_decrease.gif" /></a>
			  <a href="#" class="zoom_in"><img src="'.base_url().'images/font_increase.gif" /></a>
			</li>
			<li><a href="#" class="print">Imprimir</a></li>
			<li><a href="#" class="send_mail">Email</a></li>
		  </ul>
		</div>';
	}
	
	public function printShareTwitter() {
		return "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-lang=\"es\">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
	}
	
	public function printLikeFacebook($url) {
		return '<div class="fb-like" data-href="'.$url.'" data-width="200" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>';
	}
	
	public function printGooglePlus($url) {
		return '<g:plusone href="'.$url.'"></g:plusone>

		<script type="text/javascript">
		  window.___gcfg = {
			lang: "es-419"
		  };
	
		  (function() {
			var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
			po.src = "https://apis.google.com/js/plusone.js";
			var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>';
	}
	
	public function printSocialNetworks($url) {
		$content = '<div class="widgetsRedes">';
		$content .= $this->printShareTwitter();
		$content .= $this->printLikeFacebook($url);
		$content .= $this->printGooglePlus($url);
		$content .= '</div>';
		return $content;
	}
	
	public function printBackToTop() {
		return '<div class="itemBackToTop"><a href="#">volver arriba</a></div>';
	}
}
?> 