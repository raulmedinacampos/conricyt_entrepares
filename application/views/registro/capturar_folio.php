<style type="text/css">
/*estilos para el listado*/
#form1 { position:relative; margin:auto; width:300px; max-width:300px; height: auto;  line-height:40px; padding:10px;  border:#CCC 3px solid; text-align: right; background-color:#666; color:#FFF; margin-top:50px; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow: 5px 5px 0 #333; -webkit-box-shadow: 5px 5px 10px #333; -moz-box-shadow:50px 50px  #333; }

#folio, #nombre, #ap_pat, #ap_mat, #correo, #btn_consultar { border:#CCC 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;}

#datosUsuario { position:relative; margin:auto; width:auto;  height: auto;  line-height:40px; padding:10px;  border:#CCC 3px solid; text-align: right; background-color:#EEE; color:#333; margin-top:50px; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow: 5px 5px 0 #333; -webkit-box-shadow: 5px 5px 10px #333; -moz-box-shadow:50px 50px  #333;}

#datosUsuario td { padding:5px;}


tr:nth-of-type(odd) {
    background-color:#CACACA;  text-align:center; 
}

tr:nth-of-type(even) {
    background-color: #BED7F1; text-align:center;
}
</style>
<script type="text/javascript">
	$(function() {
		$("#btn_consultar").click(function() {
			if($("#form1").valid()) {
				$("#datosUsuario").children().remove();
				$.post("<?php echo base_url('registro/checkUser'); ?>",
					$("#form1").serialize(),
					function(data) {
						var contenido = '';
						var confirmar = '';
						if(data) {
							var usr = $.parseJSON(data);
							contenido = '<tr><th>Folio</th>';
							contenido += '<th>Nombre completo</th>';
							contenido += '<th>Correo</th>';
							contenido += '<th>Institución</th>';
							contenido += '<th>Confirmar</th></tr>';
							$.each(usr, function() {
								if(this.estatus == 1) {
									confirmar = "Confirmado";
								} else {
									confirmar = '<button class="btn_confirmar" data-id="'+this.id_usuario+'">Confirmar</button>';
								}
								
								contenido += '<tr>';
								contenido += '<td>'+this.folio+'</td>';
								contenido += '<td>'+this.nombre+' '+this.ap_paterno+' '+this.ap_materno+'</td>';
								contenido += '<td>'+this.correo+'</td>';
								contenido += '<td>'+this.institucion+'</td>';
								contenido += '<td>'+confirmar+'</td>';
								contenido += '</tr>';
							});
						} else {
							contenido = '<tr><th colspan="5">No se encontró al usuario</th></tr>';
						}
						$("#datosUsuario").append(contenido);
							
						$("#datosUsuario .btn_confirmar").click(function(e) {
							e.preventDefault();
							$.post("<?php echo base_url('registro/confirmar_usuario'); ?>",
								{id_usuario: $(this).data("id")},
								function(data) {
									alert(data);
									$("#form1").each(function() {
										this.reset();
									});
									
									$("#datosUsuario").children().remove();
								}
							);
						});
					}
				);
			}
		});
		
		$("#form1").validate({
			rules: {
				folio: {
					digits: true
				}
			},
			messages: {
				folio: "Escriba solo el número consecutivo del folio (sin prefijo y sin ceros a la izquierda)"
			}
		});
	});
</script>
<?php
	$attr = array(
				  'id'		=>	'form1',
				  'name'	=>	'form1'
				  );
	echo form_open('', $attr);
	echo form_label('Folio: ');
	$attr = array(
				  'id'		=>	'folio',
				  'name'	=>	'folio'
				  );
	echo form_input($attr);
	echo '<br />';
	echo form_label('Nombre: ');
	$attr = array(
				  'id'		=>	'nombre',
				  'name'	=>	'nombre'
				  );
	echo form_input($attr);
	echo '<br />';
	echo form_label('Apellido paterno: ');
	$attr = array(
				  'id'		=>	'ap_pat',
				  'name'	=>	'ap_pat'
				  );
	echo form_input($attr);
	echo '<br />';
	echo form_label('Apellido materno: ');
	$attr = array(
				  'id'		=>	'ap_mat',
				  'name'	=>	'ap_mat'
				  );
	echo form_input($attr);
	echo '<br />';
	echo form_label('Correo: ');
	$attr = array(
				  'id'		=>	'correo',
				  'name'	=>	'correo'
				  );
	echo form_input($attr);
	echo '<br />';
	$attr = array(
				  'id'		=>	'btn_consultar',
				  'name'	=>	'btn_consultar',
				  'content'	=>	'Consultar'
				  );
	echo form_button($attr);
	echo form_close();
	$attr = array(
				  'id'		=>	'form2',
				  'name'	=>	'form2'
				  );
	echo form_open('', $attr);
?>
<table id="datosUsuario">
</table>
<?php
	echo form_close();
?>