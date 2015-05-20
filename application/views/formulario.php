<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/additional-methods.min.js"></script>
<script type="text/javascript">
	$(function() {
		$.validator.addMethod("telefono", function(phone_number, element) {
			phone_number = phone_number.replace(/\s+/g, "");
			return this.optional(element) || phone_number.match(/^[0-9]+[0-9-]{3,15}[0-9]$/);
		}, "Wrong phone format");
		
		$("#correo_conf").bind("cut copy paste",function(e) {
			e.preventDefault();
		});
		
		$("#btn_enviar_reg").click(function() {
			if($("#form_prerregistro").valid()) {
				var confirmacion = 'Confirme la información capturada';
				confirmacion += "<ul>";
				confirmacion += "<li>Nombre: " + $("#nombre").val() + "</li>";
				confirmacion += "<li>Apellido paterno: " + $("#ap_paterno").val() + "</li>";
				confirmacion += "<li>Apellido materno: " + $("#ap_materno").val() + "</li>";
				confirmacion += "<li>Sexo: " + $("#sexo option:selected").text() + "</li>";
				confirmacion += "<li>Institución de procedencia: " + $("#institucion").val() + "</li>";
				confirmacion += "<li>Entidad federativa: " + $("#entidad option:selected").text() + "</li>";
				confirmacion += "<li>Perfil: " + $("#perfil option:selected").text() + "</li>";
				confirmacion += "<li>Cargo: " + $("#cargo").val() + "</li>";
				confirmacion += "<li>Teléfono: " + $("#telefono").val() + "</li>";
				confirmacion += "<li>Correo: " + $("#correo").val() + "</li>";
				confirmacion += "<li>¿Cómo se entero?: " + $("#nombre").val() + "</li>";
				confirmacion += "<li>¿Cómo se transportará?: " + $("#nombre").val() + "</li>";
				confirmacion += "</ul>";
				if(confirm(confirmacion)) {
					$.post('<?php base_url();?>prerregistro/alta',
							$("#form_prerregistro").serialize(),
							function(data) {
								alert(data);
							}
					);
				}
			}
		});
		
		$("#form_prerregistro").validate({
			rules: {
				nombre: {
					required: true
				},
				sexo: "required",
				entidad: "required",
				perfil: "required",
				telefono: {
					telefono: true
				},
				correo: {
					required: true,
					email: true
				},
				correo_conf: {
					equalTo: "#correo"
				}
			}
		});
	});
</script>
<?php
	$attr = array(
				 'id'	=>	'form_prerregistro',
				 'name'	=>	'form_prerregistro'
				 );
	echo form_open('', $attr);
	echo form_label('Nombre(s):');
	$attr = array(
				 'id'		=>	'nombre',
				 'name'		=>	'nombre'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Apellido paterno:');
	$attr = array(
				 'id'	=>	'ap_paterno',
				 'name'	=>	'ap_paterno'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Apellido materno:');
	$attr = array(
				 'id'	=>	'ap_materno',
				 'name'	=>	'ap_materno'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Sexo:');
	$attr = 'id = "sexo"';
	$opciones = array(
					  ''	=>	'Seleccione',
					  'm'	=>	'Masculino',
					  'f'	=>	'Femenino'
					  );
	echo form_dropdown('sexo', $opciones, '', $attr);
	echo "<br />";
	echo form_label('Institución de procedencia:');
	$attr = array(
				 'id'	=>	'institucion',
				 'name'	=>	'institucion'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Entidad federativa:');
	$attr = 'id = "entidad"';
	$opciones = array('' => 'Seleccione');
	
	foreach($entidades->result() as $val) {
		$opciones += array($val->id_entidad => $val->entidad);
	}
	
	echo form_dropdown('entidad', $opciones, '', $attr);
	echo "<br />";
	echo form_label('Perfil:');
	$attr = 'id = "perfil"';
	$opciones = array('' => 'Seleccione');
	
	foreach($perfiles->result() as $val) {
		$opciones += array($val->id_perfil => $val->perfil);
	}
	
	echo form_dropdown('perfil', $opciones, '', $attr);
	echo "<br />";
	echo form_label('Cargo:');
	$attr = array(
				 'id'	=>	'cargo',
				 'name'	=>	'cargo'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Teléfono de contacto:');
	$attr = array(
				 'id'	=>	'telefono',
				 'name'	=>	'telefono'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Correo electrónico:');
	$attr = array(
				 'id'	=>	'correo',
				 'name'	=>	'correo'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('Confirmar el correo electrónico:');
	$attr = array(
				 'id'	=>	'correo_conf',
				 'name'	=>	'correo_conf'
				 );
	echo form_input($attr);
	echo "<br />";
	echo form_label('¿Cómo se enteró del seminario?');
	$attr = 'id = "como_se_entero"';
	$opciones = array('' => 'Seleccione');
	
	foreach($medios_informacion->result() as $val) {
		$opciones += array($val->id => $val->forma);
	}
	
	echo form_dropdown('como_se_entero', $opciones, '', $attr);
	echo "<br />";
	echo form_label('¿De qué forma se transportará hacia la sede?');
	$attr = 'id = "transporte"';
	$opciones = array('' => 'Seleccione');
	
	foreach($transportes->result() as $val) {
		$opciones += array($val->id => $val->transporte);
	}
	
	echo form_dropdown('transporte', $opciones, '', $attr);
	echo "<br />";
	echo form_label('Escriba el texto que se muestra:');
	echo '<img src="'.base_url().'captcha" />';
	$attr = array(
				 'id'	=>	'captcha',
				 'name'	=>	'captcha'
				 );
	echo form_input($attr);
	echo "<br />";
	$attr = array(
				 'id'		=>	'btn_enviar_reg',
				 'name'		=>	'btn_enviar_reg',
				 'content'	=>	'Registrarse'
				 );
	echo form_button($attr);
	echo "<br />";
	echo form_close();
?>