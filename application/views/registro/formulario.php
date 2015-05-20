<!--<div id="contenido">-->
<?php
	echo $tools;
?>
<script type="text/javascript" src="<?php echo base_url('scripts/jquery-ui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('scripts/additional-methods.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.watermark.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.mask.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('scripts/registro.js'); ?>"></script>
<script type="text/javascript">
	function obtenerImagen() {
		$.post("<?php echo base_url().'captcha'?>", '', function(data) {
			$("#img-captcha").attr("src", "<?php echo base_url().'captcha/getImage/'; ?>"+data+"/"+Math.random());
			$("#oculto").val(data);
		});
	}
	
	$(function() {
		$("#institucion").autocomplete({
			source: "<?php echo base_url(); ?>preregistro/autocompletar",
			minLength: 3
		});
		
		$("#perfil").change(function() {
			if($("#perfil option:selected").text() == "Otro") {
				var elemento = '<?php
									$attr = array(
												 'class'	=>	'otro_perfil'
												 );
									echo form_label('* Especifique el perfil:', '', $attr);
									$attr = array(
												 'id'		=>	'otro_perfil',
												 'name'		=>	'otro_perfil',
												 'class'	=>	'otro_perfil'
												 );
									echo form_input($attr); ?>';
				$("#perfil").after(elemento);
			} else {
				$(".otro_perfil").remove();
			}
		});
		
		$("#cargo").change(function() {
			if($("#cargo option:selected").text() == "Otro") {
				var elemento = '<?php
									$attr = array(
												 'class'	=>	'otro_cargo'
												 );
									echo form_label('* Especifique el cargo:', '', $attr);
									$attr = array(
												 'id'		=>	'otro_cargo',
												 'name'		=>	'otro_cargo',
												 'class'	=>	'otro_cargo',
												 'title'	=>	'El cargo puede ser igual al perfil'
												 );
									echo form_input($attr); ?>';
				$("#cargo").after(elemento);
				$("[title]").tooltip({
					position: {
						 my: "left top",
						 at: "right+5 top-5"
					}
				});
			} else {
				$(".otro_cargo").remove();
			}
		});
	});
</script>
<link href="<?php echo base_url('css/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/registro.css'); ?>" rel="stylesheet" type="text/css" />

<h4>LEE CUIDADOSAMENTE LAS INDICACIONES ANTES DE INICIAR TU PREREGISTRO</h4>
<p class="texto_prereg">Para realizar tu preregistro al Seminario Entre Pares 2015 debes llenar el siguiente formulario. Es importante que verifiques que tus datos sean correctos, pues de la misma manera en que llenes los campos de nombre y apellidos aparecerán en el comprobante y la Carta Invitación que recibirás por correo electrónico, así como en la Constancia de Asistencia que se emitirá posterior al evento.</p>
<!-- <p class="texto_prereg">A continuación encontrarás tres botones en la parte superior del formulario que se deben llenar de manera obligatoria, en el primer ingresa información personal y en los otros dos selecciona las actividades por día del Seminario que sean de tu interés. Los eventos seleccionados no deben empalmarse en horario pues el sistema automáticamente te deshabilitará las casillas.</p>-->
<div class="mensaje"></div>
<br clear="all" />
<?php
	$attr = array(
				 'id'	=>	'form_prerregistro',
				 'name'	=>	'form_prerregistro'
				 );
	echo form_open('', $attr);
?>
<div id="tabs">

<div id="tab1">
  <div class="preregistro">
<?php
	$attr = array(
				'id'		=>	'hdn_usuario',
				'name'		=>	'hdn_usuario',
				'type'		=>	'hidden',
				'value'		=>	''
			);
	echo form_input($attr);
	 
	echo '<div class="datos">';
	echo form_label('* Nombre(s):');
	$attr = array(
				 'id'		=>	'nombre',
				 'name'		=>	'nombre',
				 'title'	=>	'Escribe tu nombre como aparecerá en la constancia'
				 );
	echo form_input($attr);

	echo form_label('* Apellido paterno:');
	$attr = array(
				 'id'	=>	'ap_paterno',
				 'name'	=>	'ap_paterno',
				 'title'	=>	'Escribe tu apellido paterno como aparecerá en la constancia'
				 );
	echo form_input($attr);
	$attr = array(
				 'id'		=>	'chk_ap_pat',
				 'name'		=>	'chk_ap_pat'
				 );
	echo '<div class="div_apellido">';
	echo form_checkbox($attr);
	echo "<span>Sin apellido paterno</span>";
	echo "</div>";

	echo form_label('* Apellido materno:');
	$attr = array(
				 'id'		=>	'ap_materno',
				 'name'		=>	'ap_materno',
				 'title'	=>	'Escribe tu apellido materno como aparecerá en la constancia'
				 );
	echo form_input($attr);
	$attr = array(
				 'id'		=>	'chk_ap_mat',
				 'name'		=>	'chk_ap_mat'
				 );
	echo '<div class="div_apellido">';
	echo form_checkbox($attr);
	echo "<span>Sin apellido materno</span>";
	echo "</div>";

	echo form_label('* Sexo:');
	$attr = 'id = "sexo"';
	$opciones = array(
					  ''	=>	'Seleccione',
					  'm'	=>	'Masculino',
					  'f'	=>	'Femenino'
					  );
	echo form_dropdown('sexo', $opciones, '', $attr);

	echo form_label('* Institución de procedencia:');
	$attr = array(
				 'id'		=>	'institucion',
				 'name'		=>	'institucion',
				 'title'	=>	'Escribe el nombre de la institución a la que perteneces o elije dentro de las opciones que se te presentan. Si la institución no existe en el listado, escribe correctamente el nombre'
				 );
	echo form_input($attr);

	echo form_label('* Entidad federativa:');
	$attr = 'id = "entidad"';
	$opciones = array('' => 'Seleccione');
	foreach($entidades->result() as $val) {
		$opciones += array($val->id_entidad => $val->entidad);
	}
	echo form_dropdown('entidad', $opciones, '', $attr);

	echo form_label('* Perfil:');
	$attr = 'id = "perfil"';
	$opciones = array('' => 'Seleccione');
	foreach($perfiles->result() as $val) {
		$opciones += array($val->id_perfil => $val->perfil);
	}
	echo form_dropdown('perfil', $opciones, '', $attr);
	
	echo form_label('* Cargo:');
	$attr = 'id = "cargo" title = "El cargo puede ser igual al perfil"';
	$opciones = array('' => 'Seleccione');
	foreach($cargos->result() as $val) {
		$opciones += array($val->id_cargo => $val->cargo);
	}
	echo form_dropdown('cargo', $opciones, '', $attr);

	echo form_label('* Teléfono de contacto:');
	$attr = array(
				 'id'		=>	'telefono',
				 'name'		=>	'telefono',
				 'title'	=>	'Escribe tu número telefónico fijo con lada o celular'
				 );
	echo form_input($attr);

	echo form_label('Extensión telefónica:');
	$attr = array(
				 'id'		=>	'extension',
				 'name'		=>	'extension'
				 );
	echo form_input($attr);
	echo '</div>';  // Div datos
	
	echo form_label('* Correo electrónico:');
	$attr = array(
				 'id'		=>	'correo',
				 'name'		=>	'correo',
				 'title'	=>	'Ingresa correctamente tu correo electrónico donde recibirás información sobre el Seminario'
				 );
	echo form_input($attr);

	echo form_label('Confirmar el correo electrónico:');
	$attr = array(
				 'id'		=>	'correo_conf',
				 'name'		=>	'correo_conf',
				 'title'	=>	'Confirma tu correo electrónico. Este campo no permite copiar y pegar, favor de teclear el correo'
				 );
	echo form_input($attr);

	echo '<div class="datos">';
	echo form_label('* ¿Cómo te enteraste del Seminario?');
	$attr = 'id = "como_se_entero"';
	$opciones = array('' => 'Seleccione');
	foreach($medios_informacion->result() as $val) {
		$opciones += array($val->id => $val->forma);
	}
	echo form_dropdown('como_se_entero', $opciones, '', $attr);

	echo form_label('* ¿De qué forma te transportarás al Seminario?');
	$attr = 'id = "transporte"';
	$opciones = array('' => 'Seleccione');
	foreach($transportes->result() as $val) {
		$opciones += array($val->id => $val->transporte);
	}
	echo form_dropdown('transporte', $opciones, '', $attr);
	echo '</div>';  // Div datos
?>
  </div> <!-- Termina contenedor del formulario -->
  <div style="clear:both;"></div>
</div> <!-- Termina tab1 -->


  <div id="tab4" style="display:none">
  <?php
  	if($total_recorrido < 132) {
  ?>
  	<p>¡Has decidido participar en el Recorrido Turístico en Guanajuato!</p>
    <p>Ahora debes ingresar tu número de celular, fecha y hora de llegada a León. Es importante que tomes en cuenta que tu lugar es intransferible ya que los asientos en los autobuses que trasladarán a los asistentes a Guanajuato son limitados.</p>
    <div class="preregistro">
	  <?php
        echo form_label('Nombre');
        $attr = array(
                     'id'		=>	'nombre_rec',
                     'name'		=>	'nombre_rec',
					 'disabled'	=>	'disabled'
                     );
        echo form_input($attr);
        echo form_label('Apellido paterno');
        $attr = array(
                     'id'		=>	'ap_pat_rec',
                     'name'		=>	'ap_pat_rec',
					 'disabled'	=>	'disabled'
                     );
        echo form_input($attr);
        echo form_label('Apellido materno');
        $attr = array(
                     'id'		=>	'ap_mat_rec',
                     'name'		=>	'ap_mat_rec',
					 'disabled'	=>	'disabled'
                     );
        echo form_input($attr);
        echo form_label('Institución');
        $attr = array(
                     'id'		=>	'inst_rec',
                     'name'		=>	'inst_rec',
					 'disabled'	=>	'disabled'
                     );
        echo form_input($attr);
        echo form_label('Fecha de llegada a Guanajuato');
        $attr = array(
                     'id'		=>	'fecha_llegada',
                     'name'		=>	'fecha_llegada',
					 'disabled'	=>	'disabled',
                     'title'	=>	'¿Qué día llegarás a la Ciudad de León, Guanajuato?'
                     );
        echo form_input($attr);
        echo form_label('Hora de llegada a Guanajuato');
        $attr = array(
                     'id'		=>	'hora_llegada',
                     'name'		=>	'hora_llegada',
					 'disabled'	=>	'disabled',
                     'title'	=>	'¿A qué hora llegarás a la Ciudad de León, Guanajuato? Usa el formato de 24 horas'
                     );
        echo form_input($attr);
        echo form_label('Celular');
        $attr = array(
                     'id'		=>	'celular',
                     'name'		=>	'celular',
					 'disabled'	=>	'disabled',
                     'title'	=>	'Anota un celular donde podamos localizarte'
                     );
        echo form_input($attr);
		$attr = array(
					 'id'		=>	'btn_cancelar_rec',
					 'name'		=>	'btn_cancelar_rec',
					 'content'	=>	'Cancelar recorrido',
					 'style'	=>	'clear:both; display:block; margin:auto;'
					 );
		echo form_button($attr);
	  ?>
    </div>
  <?php
	} else {
  ?>
    <div class="preregistro">
      <p>Podrás unirte al Recorrido Turístico en la Ciudad de Guanajuato. El grupo se reunirá en el Teatro Juárez a las 16 hrs, aunque puedes llegar antes. Recuerda que los gastos de la comida y del transporte que uses corren por tu cuenta.</p>
      <p>Consulta el itinerario del Recorrido en <a href="http://entrepares.conricyt.mx/sobre-el-evento/actividades-extraseminario" target="_blank">http://entrepares.conricyt.mx/sobre-el-evento/actividades-extraseminario</a></p>
    </div>
  <?php
	}
  ?>
    <div style="clear:both;"></div>
  </div>
</div>
<div class="btn_tabs" style="display: none;">
  <span><button id="btn_ant_tab">Anterior</button></span>
  <button id="btn_sig_tab">Siguiente</button>
</div>
<div class="div-captcha">
  <?php
	echo form_label('* Escriba el texto que se muestra:');
	$attr = array(
				 'id'		=>	'captcha',
				 'name'		=>	'captcha',
				 'title'	=>	'Escribe la palabra que se muestra en la imagen de abajo'
				 );
	echo form_input($attr);
	echo '<input type="hidden" id="oculto" name="oculto" value="" />';
	echo "<br clear='all'/>";
	echo '<div id="recargar"><div id="img-recargar"><a href="#"><img src="'.base_url().'images/recargar.jpg" /></a></div>Recargar</div>';
	echo '<div id="div-captcha">';
	echo '<img id="img-captcha" src="'.base_url().'captcha" />';
	echo "</div>";
	echo "<br clear='all'/>";
	
	$attr = array(
				 'id'		=>	'btn_enviar_reg',
				 'name'		=>	'btn_enviar_reg',
				 'content'	=>	'Enviar'
				 );
	echo form_button($attr);
	
	echo form_close();
?>
</div>
<div style="clear:both;"></div>
<?php
	echo $toolsPie;
?>
<!--</div>
-->