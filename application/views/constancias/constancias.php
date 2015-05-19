<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.mask.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#folio").mask('EP2014 - 0NNNN', {translation: {'N': {pattern: /[0-9]/, optional: true}}});
		
		$("#folio").mouseover(function() {
			$("#folio").mousemove(function(e) {
				$(".tooltip-seg").css({left : e.pageX , top: e.pageY});
			});
			
			eleOffset = $(this).offset();
			$(".tooltip-seg").fadeIn("fast").css({
				left: eleOffset.left + $(this).outerWidth(),
				top: eleOffset.top
			});
			}).mouseout(function() {
				$(".tooltip-seg").fadeOut("fast");
			});
		
		$("#formConstancia").validate({
			rules: {
				folio: {
					required: true,
					minlength: 14,
					maxlength: 14
				}
			},
			messages: {
				folio: ""
			}
		});
	});
</script>
<div id="contenido">
<?php
	echo $tools;
?>
  <p><strong>Bienvenid@</strong></p>
  <p>En esta página podrás descargar tu Constancia de Asistencia al Tercer Seminario Entre Pares, llevado a cabo los días 22 y 23 de septiembre de 2014.</p>
  <p>Ten presentes las siguientes recomendaciones:</p>
  <ul>
    <li>La constancia es generada al momento, usando tu nombre completo tal y como fue capturado durante tu registro o pre registro. Si detectas alguna anomalía, por favor llámanos al (55) 5322 7700 Ext. 4020 a la 4016 y coméntanos el error a corregir.</li>
    <li>La constancia se genera en formato PDF, por lo que necesitas contar con un programa que te permita visualizarla, como Acrobat Reader©, que puedes descargar desde este enlace en caso de no tenerlo instalado en tu equipo.</li>
    <li>Tienes hasta el 31 de diciembre de 2014 para descargar tu Constancia de asistencia.</li>
  </ul>
<p>Captura el número de folio de tu registro o pre-registro exactamente como lo recibiste en el siguiente recuadro (ejemplo: EP2014-12345), y presiona el botón <strong>Obtener constancia</strong>:</p>
<?php
	$attr = array(
				  'id'		=>	'formConstancia',
				  'name'	=>	'formConstancia',
				  'target'	=>	'_blank'
				  );
	echo form_open(base_url('constancia/consulta'), $attr);
	
	$attr = array(
				  'id'			=>	'folio',
				  'name'		=>	'folio',
				  'maxlength'	=>	'25'
				  );
	echo form_input($attr);
	
	$attr = array(
				  'id'		=>	'boton1',
				  'name'	=>	'boton1',
				  'class'	=>	'boton',
				  'value'	=>	'Obtener constancia'
				  );
	echo form_submit($attr);
	echo form_close();
?>
<div class="tooltip-seg">Captura tu número de folio exactamente como lo recibiste. No olvides incluir el guión como en el siguiente ejemplo: <strong>EP2014 - 12345</strong></div>
</div>
