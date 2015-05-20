<?php
	echo $tools;
?>
<script type="text/javascript">
	$(function() {
		$("#btn_mensaje").click(function() {
			$(".lbox").remove();
			$("#errores").css("display", "none");
		});
		
		document.getElementById("form_encuesta").reset();
		$("#p_2, #p_3").css("display", "none");
		
	<?php
		if($usuario_estatus == 1) {
	?>
			$("#tr_4_11").css("display", "none");
			$("#tr_4_12, #tr_4_13, #tr_4_22").css("display", "table-row");
	<?php
		} else if($usuario_estatus == 2) {
	?>
			$("#tr_4_11").css("display", "table-row");
			$("#tr_4_12, #tr_4_13, #tr_4_22").css("display", "none");
	<?php
		}
	?>
		
		$("input:radio[name='rb_1']").change(function() {
			if($(this).val() == "si") {
				$("#p_2").css("display", "none");
				$("#p_3").css("display", "block");
			} else if($(this).val() == "no"){
				$("#p_2").css("display", "block");
				$("#p_3").css("display", "none");
			}
		});
		
		$("#chk_5_23").change(function() {
			var chk = $(this);
			var div = chk.parent("div");
			var campo = '';
			
			if($(this).is(":checked")) {
				campo = '<span style="margin-left:10px;"><span style="margin-right:5px;">¿Cuáles?</span><input type="text" id="txt_otro" name="txt_otro" /></span>';
				div.find("br:last-child").remove();
				div.append(campo);
			} else {
				div.find("span:last-child").remove();
			}
		});
		
		$("#btn_enviar").click(function() {
			if($("#form_encuesta").valid()) {
				$("#errores").css("display", "none");
				$("#form_encuesta").submit();
			} else {
				$("#errores").css("display", "block");
				$("#errores").modal();
			}
		});
		
		$("#form_encuesta").validate({
			errorLabelContainer: $("#errores ul"),
			wrapper: "li",
			rules: {
				rb_1: "required",
				txt_2: "required",
				"chk_3[]": {
					required: true,
					minlength: 1
				},
			<?php
				for($i=11; $i<23; $i++) {
					echo 'opc_'.$i.': "required",';
				}
			?>
				"chk_5[]": {
					required: true,
					minlength: 1
				},
				txt_otro: {
					required: "#chk_5_23"
				},
				txt_6: "required",
				txt_7: "required",
				rb_8: "required"
			}
		});
	});
</script>
<style type="text/css">
	textarea {
		font-family: sans-serif;
		font-size: 12px;
	}
	
	#errores {
		display: none;
		position: fixed;
		top: 50%;
		left: 50%;
		margin-top: -70px;
		margin-left: -262px;
		padding: 0 10px;
		background-color: #FFFFFF;
		border-radius: 8px;
		text-align: center;
		z-index: 999;
	}
	
	#errores li {
		display: none !important;
	}
	
	/* estilos de la encuesta*/
	
	#instru { font-size:18px;}	
	
	#pregunta-1 { position:relative; height:auto; margin:10px 0px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333; background-color:#F2F2F2;}
	
	#p_4 {position:relative; height:auto; margin:10px 0px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333;}
	
	td { text-align:center;}
	
	td:nth-of-type(1) { text-align:left;}
	
	tr:nth-of-type(even) { background-color: #E9E9E9; }
	
	#p_5 { position:relative; height:auto; margin:10px 0px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333; background-color:#F2F2F2;}
	
	#p_6 {  position:relative; height:auto; margin:10px 0px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333;}
	
	#p_7 { position:relative; height:auto; margin:10px 0px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333; background-color:#F2F2F2;}
	
	#p_8 {position:relative; height:auto; margin:10px 0px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333;}
	
	#btn_enviar {position:relative; height:auto; left:50%; margin-left:-50px; padding:10px; border:#666 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow:2px 2px 5px #333; -webkit-box-shadow:2px 2px 5px #333; -moz-box-shadow:2px 2px 5px #333;}
	
	
	/* Fin estilos de la encuesta*/
</style>
<div id="contenido">
  <p id="instru">Antes de descargar tu Constancia de Asistencia a la Tercera edición del Seminario <em>Entre Pares</em> es necesario que respondas la siguiente encuesta de satisfacción, con el objetivo de conocer tu opinión sobre el evento y tomar en cuenta tus comentarios y sugerencias para la organización de la Cuarta edición del Seminario.</p>
  <p><strong>Lee atentamente cada pregunta y responde.</strong></p>
  <?php
	$attr =  array(
				'name'        => 'form_encuesta',
				'id'          => 'form_encuesta'
				);
	echo form_open(base_url('encuesta/guardarEncuesta'), $attr);
	
	foreach($preguntas->result() as $val) {
		if($val->id_pregunta == 1) {
			echo '<div id="pregunta-1">';
		}
		
		if($val->id_pregunta == 4) {
			echo '</div>';
		}
		
		echo '<div id="p_'.$val->id_pregunta.'">';
		echo '<p>'.$val->pregunta.'</p>';
		
    	switch($val->tipo) {
			case 'sn':
				$attr =  array(
							'name'        => 'rb_'.$val->id_pregunta,
							'id'          => 'rb_'.$val->id_pregunta.'_si',
							'value'       => 'si',
							'style'       => ''
							);
				echo form_radio($attr)." Sí";
				$attr =  array(
							'name'        => 'rb_'.$val->id_pregunta,
							'id'          => 'rb_'.$val->id_pregunta.'_no',
							'value'       => 'no',
							'style'       => ''
							);
				echo form_radio($attr)." No";
				break;
			case 'abierta':
				$attr =  array(
							'name'        => 'txt_'.$val->id_pregunta,
							'id'          => 'txt_'.$val->id_pregunta,
							'style'       => 'width:90%; height:60px;'
							);
				echo form_textarea($attr);
				break;
			case 'opc':
				$valores = array();
				foreach($opciones->result() as $opcion) {
					if($val->id_pregunta == $opcion->pregunta) {
						$valores[$opcion->id_opcion] = $opcion->opcion;
					}
				}
				
				foreach($valores as $key => $valor) {
					$attr =  array(
								'name'        => 'chk_'.$val->id_pregunta.'[]',
								'id'          => 'chk_'.$val->id_pregunta.'_'.$key,
								'value'       => $key,
								'style'       => ''
								);
					echo form_checkbox($attr)." ".$valor.'<br />';
				}
				break;
			case 'rate5':
			?>
  <table>
    <tr>
      <th>Aspecto a evaluar</th>
      <th>Excelente<br />
      5</th>
      <th>Bueno<br />
      4</th>
      <th>Regular<br />
      3</th>
      <th>Malo<br />
      2</th>
      <th>Muy malo<br />
        1</th>
    </tr>
    <?php
				$valores = array();
				foreach($opciones->result() as $opcion) {
					if($val->id_pregunta == $opcion->pregunta) {
						$valores[$opcion->id_opcion] = $opcion->opcion;
					}
				}
				
				foreach($valores as $key => $valor) {
			?>
    <tr id="tr_<?php echo $val->id_pregunta."_".$key; ?>">
      <td><?php echo $valor; ?></td>
      <?php
				  	for($i=5; $i>0; $i--) {
						$attr =  array(
									'name'        => 'opc_'.$key,
									'id'          => 'opc_'.$val->id_pregunta.'_'.$key.'_'.$i,
									'value'       => $i,
									'style'       => ''
									);
						echo '<td>'.form_radio($attr).'</td>';
					}
                  ?>
    </tr>
    <?php
				}
			?>
    </table>
  <?php
				break;
			case 'rate10':
			?>
  <table>
    <tr>
      <th>Aspecto a evaluar</th>
      <th>10</th>
      <th>9</th>
      <th>8</th>
      <th>7</th>
      <th>6</th>
      <th>5</th>
      <th>4</th>
      <th>3</th>
      <th>2</th>
      <th>1</th>
    </tr>
    <?php
				$valores = array();
				foreach($opciones->result() as $opcion) {
					if($val->id_pregunta == $opcion->pregunta) {
						array_push($valores, $opcion->opcion);
					}
				}
				
				foreach($valores as $key => $valor) {
			?>
    <tr>
      <td><?php echo $valor; ?></td>
      <?php
				  	for($i=10; $i>0; $i--) {
						$attr =  array(
									'name'        => 'opc_'.$key,
									'id'          => 'opc_'.$val->id_pregunta.'_'.$key.'_'.$i,
									'value'       => $i,
									'style'       => ''
									);
						echo '<td>'.form_radio($attr).'</td>';
					}
                  ?>
    </tr>
    <?php
				}
			?>
    </table>
  <?php
				break;
			default:
				break;
		}
	?>
  <?php
		echo '</div>';		
	}

	echo "<br />";
	echo form_hidden('id_usuario', $id_usuario);
	$attr =  array(
				'name'        => 'btn_enviar',
				'id'          => 'btn_enviar',
				'content'     => 'Enviar',
				'style'       => ''
				);

	echo form_button($attr);
	echo form_close();
?>
</div>
<div id="errores">
  <h3>¡Aún hay preguntas sin responder!</h3>
    <h4>Debes responder todas las preguntas para poder descargar tu constancia de asistencia.</h4>
    <button id="btn_mensaje">Aceptar</button>
    <ul></ul>
</div>
<?php
	echo $toolsPie;
?>