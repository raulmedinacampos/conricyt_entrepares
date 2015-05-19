<!--<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url();?>scripts/bootstrap.min.js"></script>-->
<?php
	echo form_open();
	echo form_label('Nombre(s):');
	$attr = array(
				 'id'	=>	'nombre',
				 'name'	=>	'nombre'
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
	$opciones = array(
					  ''	=>	'Seleccione',
					  'm'	=>	'Masculino',
					  'f'	=>	'Femenino'
					  );
	echo form_dropdown('entidad', $opciones, '', $attr);
	echo "<br />";
	echo form_label('Perfil:');
	$attr = 'id = "perfil"';
	$opciones = array(
					  ''	=>	'Seleccione',
					  'm'	=>	'Masculino',
					  'f'	=>	'Femenino'
					  );
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
	$attr = array(
				 'id'		=>	'btn_enviar_reg',
				 'name'		=>	'btn_enviar_reg',
				 'content'	=>	'Registrarse'
				 );
	echo form_button($attr);
	echo "<br />";
	echo form_close();
?>