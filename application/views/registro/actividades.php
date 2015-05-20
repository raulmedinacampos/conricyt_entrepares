<!--<div id="contenido">-->
<?php
	echo $tools;
	
	if($con_actividades) {
?>
<script type="text/javascript">
	function reenviar() {
		window.location.href = "http://entrepares.conricyt.mx/";
	}
	
	$(function() {
		$(".mensaje").html('<br/><br/><h3>Ya has seleccionado actividades</h3><br/><input type="button" id="btn_limpiar" value="Aceptar" onclick="reenviar();" />');
		$(".mensaje").modal();
	});
</script>
	  <h3>Ya has seleccionado actividades</h3>
	  <div class="mensaje"></div>
<?php
	} else {
?>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.watermark.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.mask.min.js"></script>
<script type="text/javascript">
	function limpiar() {
		var formulario = document.getElementById("form_prerregistro");
		$(".mensaje").toggle();
		$('.lbox').remove();
		formulario.reset();
		location.reload();
	}
	
	function obtenerImagen() {
		$.post("<?php echo base_url().'captcha'?>", '', function(data) {
			$("#img-captcha").attr("src", "<?php echo base_url().'captcha/getImage/'; ?>"+data+"/"+Math.random());
			$("#oculto").val(data);
		});
	}
	
	function compararHorarios(hi1, hf1, hi2, hf2) {
		var chocan = false;
		hi1 = parseInt(hi1);
		hf1 = parseInt(hf1);
		hi2 = parseInt(hi2);
		hf2 = parseInt(hf2);
		
		if(hi1 == hi2 || hf1 == hf2) {
			chocan = true;
		}
		
		if(hi1 < hf2 && hf1 > hi2) {			
			if(hi1 < hi2) {
				if(hf1 < hf2 || hf1 > hf2) {
					chocan = true;
				}
			}
			
			if(hi1 > hi2) {
				if(hf1 > hf2 || hf1 < hf2) {
					chocan = true;
				}
			}
		}
		
		return chocan;
	}
	
	function bloquearCheck(chk) {
		$("." + clase).each(function() {
			$(this).prop("disabled", false);
		});
		var clase = chk.attr('class');
		var seleccionados = [];
		var desactivados = []
		$("." + clase).each(function() {
			if($(this).is(":checked")) {
				seleccionados.push($(this));
			}
		});
		
		if(seleccionados.length > 0) {
			for(var i=0; i<seleccionados.length; i++) {
				$("." + clase).each(function() {
					if($(this).val() != seleccionados[i].val()) {
						if(compararHorarios($(this).data('inicio'), $(this).data('fin'), seleccionados[i].data('inicio'), seleccionados[i].data('fin'))) {
							desactivados.push($(this));
							$(this).prop("disabled", true);
						} else {
							$(this).prop("disabled", false);
						}
					}
				});
			}
		} else {
			$("." + clase).each(function() {
				$(this).prop("disabled", false);
			});
		}
		
		for(var i=0; i<desactivados.length; i++) {
			$("." + clase).each(function() {
				if($(this).val() == desactivados[i].val()) {
					$(this).prop("disabled", true);
				}
			});
		}
	}
	
	function mostrarEnvio() {
		$(".ui-tabs-nav li").click(function() {
			if($(".ui-tabs-nav li").length == ($("#tabs").tabs('option', 'active'))+1) {
				$(".btn_tabs").css("display", "none");
				$(".div-captcha").css("display", "block");
			}
		});
	}

	function ocultarEnvio() {
		if($("#tabs").tabs('option', 'active') == 0) {
			$("#btn_ant_tab").parent().css("display", "none");
			$("#btn_sig_tab").css("display", "inline");
		}
		
		if(($(".ui-tabs-nav li").length)-1 == $("#tabs").tabs('option', 'active')) {
			$("#btn_sig_tab").css("display", "none");
		}
		
		$(".ui-tabs-nav li").click(function() {
			if($(".ui-tabs-nav li").length != ($("#tabs").tabs('option', 'active'))+1) {
				$(".btn_tabs").css("display", "block");
				$(".div-captcha").css("display", "none");
				
				if($("#tabs").tabs('option', 'active') == 0) {
					$("#btn_ant_tab").parent().css("display", "none");
					$("#btn_sig_tab").css("display", "inline");
				} else {
					$("#btn_ant_tab").parent().css("display", "inline");
				}
				
				if(($(".ui-tabs-nav li").length)-2 <= $("#tabs").tabs('option', 'active')) {
					$("#btn_sig_tab").css("display", "inline");
				}
			}
		});
	}

	$(function() {
		$("input:checkbox").each(function() {
			$(this).prop("disabled", false);
			$(this).prop("checked", false);
		});
		
		$("#fecha_llegada").prop("disabled", true);
		$("#hora_llegada").prop("disabled", true);
		$("#celular").prop("disabled", true);
		
		obtenerImagen();
		
		$.validator.addMethod("telefono", function(phone_number, element) {
			phone_number = phone_number.replace(/\s+/g, "");
			return this.optional(element) || phone_number.match(/^[0-9]+[0-9-]{3,15}[0-9]$/);
		}, "Wrong phone format");
		
		$("[title]").tooltip({
			position: {
				 my: "left top",
				 at: "right+5 top-5"
			}
		});

		$.validator.addMethod("f_llegada", function(fecha, element) {
			var f = fecha.split("/");
			
			return this.optional(element) || (f[2] == '2014' && parseInt(f[1]) <= 9 && parseInt(f[0]) <= 21);
		}, "Wrong date");
		
		$.validator.addMethod("h_llegada", function(hora, element, params) {
			var f = $(params).val().split("/");
			var h = hora.split(":");
			
			if(f[2] == '2014' && parseInt(f[1]) <= 9 && f[0] == 21) {
				return ((h[1] == '00' && parseInt(h[0]) <= 13) || (parseInt(h[1]) >= 1 && parseInt(h[1]) <= 59 && parseInt(h[0]) <= 12));
			}

			if(f[2] == '2014' && parseInt(f[1]) <= 9 && parseInt(f[0]) < 21) {
				return true;
			}
			return this.optional(element);

		}, "Wrong hour");
		
		$("[title]").tooltip({
			position: {
				 my: "left top",
				 at: "right+5 top-5"
			}
		});

		$("#img-recargar img").click(function(e) {
			e.preventDefault();
			obtenerImagen();
		});
		
		$("#btn_enviar_reg").click(function() {
			validator.element("#captcha");
			if($("#form_prerregistro").valid()) {
				var confirmacion = '<h4>Confirma la información capturada</h4>';
				confirmacion += "<ul>";
				confirmacion += "<li>22 de septiembre: " + $(".dia1:checked").length + " actividades</li>";
				confirmacion += "<li>23 de septiembre: " + $(".dia2:checked").length + " actividades</li>";
				confirmacion += "</ul>";
				confirmacion += '<input type="button" id="btn_confirmar" value="Aceptar" />';
				confirmacion += '<input type="button" id="btn_regresar" value="Regresar" />';
				
				$(".mensaje").html(confirmacion);
				$(".mensaje").modal();

				$("#btn_confirmar").click(function() {
					$(".mensaje").html('<br /><br /><img src="<?php echo base_url(); ?>images/loading.gif" />');
					$.post('<?php echo base_url();?>preregistro/agregarActividades',
							$("#form_prerregistro").serialize(),
							function(data) {
								$(".mensaje").toggle();
								$('.lbox').remove();
								$(".mensaje").html('<br/><br/><h3>'+data+'</h3><br/><input type="button" id="btn_limpiar" value="Aceptar" onclick="limpiar();" />');
								$(".mensaje").modal();
							}
					);
				});
			} else {
				alert("Revisa cuidadosamente que hayas llenado la información solicitada en cada una de las pestañas");
			}
		});

		var tabs = $("#tabs").tabs();
		
		$('#fecha_llegada').watermark('dd/mm/aaaa');
		$('#hora_llegada').watermark('hh:mm');
		
		$('#fecha_llegada').mask('00/00/0000');
		$('#hora_llegada').mask('00:00');
		
		mostrarEnvio();
		ocultarEnvio();
		
		$("#btn_ant_tab").click(function(e) {
			e.preventDefault();
			var t = $("#tabs").tabs('option', 'active');
			t--;
			$("#tabs").tabs({ active: t });
			
			if(t == 0) {
				$("#btn_ant_tab").parent().css("display", "none");
				$("#btn_sig_tab").css("display", "inline");
			} else {
				$("#btn_ant_tab").parent().css("display", "inline");
				$("#btn_sig_tab").css("display", "inline");
			}
			
			if(($(".ui-tabs-nav li").length)-1 == t) {
				$("#btn_ant_tab").css("display", "none");
				$(".btn_tabs").css("display", "none");
				$(".div-captcha").css("display", "block");
			} else {
				$("#btn_ant_tab").css("display", "inline");
				$(".btn_tabs").css("display", "block");
				$(".div-captcha").css("display", "none");
			}
		});

		$("#btn_sig_tab").click(function(e) {
			e.preventDefault();
			var t = $("#tabs").tabs('option', 'active');
			t++;
			$("#tabs").tabs({ active: t });
			
			if(t == 0) {
				$("#btn_ant_tab").parent().css("display", "none");
			} else {
				$("#btn_ant_tab").parent().css("display", "inline");
			}
			
			if(($(".ui-tabs-nav li").length)-1 == t) {
				$("#btn_sig_tab").css("display", "none");
				$(".btn_tabs").css("display", "none");
				$(".div-captcha").css("display", "block");
			} else {
				$("#btn_sig_tab").css("display", "inline");
				$(".btn_tabs").css("display", "block");
				$(".div-captcha").css("display", "none");
			}
		});

		$("#chk_recorrido").change(function() {
			if($(this).is(":checked")) {
				$("#fecha_llegada").prop("disabled", false);
				$("#hora_llegada").prop("disabled", false);
				$("#celular").prop("disabled", false);
			} else {
				$("#fecha_llegada").prop("disabled", true);
				$("#hora_llegada").prop("disabled", true);
				$("#celular").prop("disabled", true);
			}
		});

		$(".dia1").each(function() {
			var actual = $(this);
			actual.change(function() {
				bloquearCheck(actual);
				var seleccionados1 = $(".dia1:checked").length;
				if(seleccionados1 > 1) {
					$(".dia1:checked").each(function() {
						if($(this).val() != actual.val()) {
							var inicio = $(this).data('inicio');
							var fin = $(this).data('fin');
							
							if(compararHorarios(inicio, fin, actual.data('inicio'), actual.data('fin'))) {
								if(confirm("Estos horarios se traslapan, ¿estás seguro?")) {
									$(this).prop("checked", false);
									actual.prop("disabled", false);
									bloquearCheck(actual);
								} else {
									actual.prop("checked", false);
									$(this).prop("disabled", false);
									bloquearCheck($(this));
								}
							}
						}
					});
				}
			});
		});
		
		$(".dia2").each(function() {
			var actual = $(this);
			actual.change(function() {
				bloquearCheck(actual);
				var seleccionados1 = $(".dia2:checked").length;
				if(seleccionados1 > 1) {
					$(".dia2:checked").each(function() {
						if($(this).val() != actual.val() && $(this).data('salon') != actual.data('salon')) {
							var inicio = $(this).data('inicio');
							var fin = $(this).data('fin');
							
							if(compararHorarios(inicio, fin, actual.data('inicio'), actual.data('fin'))) {
								if(confirm("Estos horarios se traslapan, ¿estás seguro?")) {
									$(this).prop("checked", false);
									actual.prop("disabled", false);
									bloquearCheck(actual);
								} else {
									actual.prop("checked", false);
									$(this).prop("disabled", false);
									bloquearCheck($(this));
								}
							}
						}
					});
				}
			});
		});
		
		$("td div").click(function() {
			var chk = $(this).next();
			if(chk.is(":checked")) {
				chk.prop("checked", false);
			} else {
				chk.prop("checked", true);
			}
			chk.trigger("change");
		});

		var validator = $("#form_prerregistro").validate({
			errorElement: 'span',
			onkeyup: false,
			ignore: [],
			rules: {
				"id_evento[]": {
					required: true,
					minlength: 1
				},
				fecha_llegada: {
					required: "#chk_recorrido:checked",
					f_llegada: true
				},
				hora_llegada: {
					required: "#chk_recorrido:checked",
					h_llegada: "#fecha_llegada"
				},
				celular: {
					required: "#chk_recorrido:checked",
				},
				captcha: {
					required: true,
					equalTo: "#oculto"
				}
			},
			messages: {
				"id_evento[]": "Selecciona al menos una actividad en cualquiera de las dos fechas",
				fecha_llegada: {
					required: "Campo obligatorio",
					f_llegada: "Debes llegar a más tardar el día 21 de septiembre"
				},
				hora_llegada: {
					required: "Campo obligatorio",
					h_llegada: "La hora de llegada no es válida"
				},
				celular: "Campo obligatorio",
				captcha: {
					required: "Campo obligatorio",
					equalTo: "Código inválido"
				}
			}
		});
	});
</script>
<link href="<?php echo base_url(); ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table {
		width: 100%;
		border-collapse: collapse;
		border: 1px #5D5D5D solid;
	}
	th {
		padding: 5px 0;
		background-color: #484F56;
		color: #FFFFFF;
	}
	td {
		min-width: 80px;
		padding: 5px;
		background-color: #FFFFFF;
		border: 1px #5D5D5D solid;
		vertical-align: top;
	}
	td:first-of-type {
		width: 80px;
		font-weight: bold;
	}
	td:hover {
		background-color: #D8DCE2;
	}
	td div {
		position: absolute;
		margin: 3px 0 0 3px;
		height: 14px;
		width: 14px;
	}
	td span {
		display: block;
		text-align: center;
	}
	.ui-widget {
		font-family: inherit !important;
		font-size: inherit !important;
	}
	.ui-widget-header {
		background: none;
		border: none;
		border-bottom: 1px #CCCCCC solid;
		border-radius: unset;
	}
	.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
		color: #2E4156;
	}
	.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
		border: 1px #CCCCCC solid;
	}
	.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover {
		background: none #FFFFFF;
		border: 1px #CCCCCC solid;
	}
	.ui-state-hover a, .ui-state-hover a:hover, .ui-state-hover a:link, .ui-state-hover a:visited {
		color: #969696;
	}
	td span.error {
		position: relative;
		width: auto;
		top: 7px;
		float: right;
		font-weight: bold;
	}
</style>
<h4>¡Es momento de concluir tu preregistro!</h4>
<p>A continuación encontrarás dos botones en la parte superior del formulario que corresponden a las actividades que se presentarán durante los días  del Seminario. Los eventos seleccionados no deben empalmarse en horario pues el sistema automáticamente te deshabilitará las casillas.</p>
<p>Una vez que hayas llenado y enviado el  formulario recibirás por correo electrónico tu Comprobante  de Preregistro.</p>
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
  <ul>
    <li><a href="#tab2">22 de septiembre</a></li>
    <li><a href="#tab3">23 de septiembre</a></li>
  </ul>
  <div id="tab2">
    <table>
      <tr>
        <th>Horario</th>
        <th>Poliforum León</th>
      </tr>
      <?php
	foreach($eventos1->result() as $evento) {
?>
      <tr>
        <td><?php echo $evento->inicio.' - '.$evento->fin; ?></td>
        <td><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" class="dia1" /><strong><?php } echo $evento->evento;?></strong><?php if($evento->descripcion) {echo "<br/>".$evento->descripcion;}?></td>
      </tr>
      <?php
	}
?>
    </table>
    <p>&nbsp;</p>
    <table>
      <tr>
        <th>Horario</th>
        <?php
        foreach($columnas->result() as $columna) {
	?>
        <th><?php echo $columna->ubicacion; ?></th>
        <?php
	     }
    ?>
      </tr>
      <?php
	$i = 1;
	$rowspan = 1;
  	foreach($filas1->result() as $fila) {
  ?>
      <tr>
        <td><?php echo $fila->inicio." - ".$fila->fin;?></td>
        <?php
		foreach($columnas->result() as $columna) {
		  foreach($eventos2->result() as $evento) {
			  if($evento->inicio == $fila->inicio && $evento->ubicacion_evento == $columna->id_ubicacion_evento) {
				  $rowspan = (strtotime($evento->fin) - strtotime($evento->inicio)) / 1800;
				  if($evento->fin == $fila->fin) {
	?>
        <td>
    <?php
		if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) {
    ?>
    	<div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia1" />
    <?php
		}
    ?>
        <span><strong><?php echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
        <?php
				  }
				  for($j=0; $j<=3; $j++) {
					  $aux = $filas1->result();
					  if(isset($aux[$i+$j]->fin)) {
						  if($evento->fin == $aux[$i+$j]->fin && $fila->fin != $aux[$i+$j]->fin) {
			?>
        <td rowspan="<?php echo $rowspan; ?>">
		<?php
        	if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) {
				if(!$evento->cupo) {
		?>
        <div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia1" />
		<?php
				} else {
					echo '<p style="font-weight:bold; text-align:center; color: #FF0000;">Se ha llenado el cupo de esta actividad</p>';
				}
		  }
echo '<span><strong>'.$evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
        <?php
						  }
					  }
				  }
			  }
		  }
	  }
	?>
      </tr>
      <?php
  		($i < $filas1->num_rows()-1) ? $i++ : $i = $filas1->num_rows()-1;
	}
  ?>
      <tr>
        <td colspan="<?php echo $columnas->num_rows() + 1; ?>"><span>Fin de la jornada</span></td>
      </tr>
    </table>
  </div>
  <div id="tab3">
  <table>
    <tr>
      <th>Horario</th>
      <th>Poliforum León</th>
    </tr>
    <?php
	foreach($eventos3->result() as $evento) {
?>
    <tr>
      <td><?php echo $evento->inicio.' - '.$evento->fin; ?></td>
      <td><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" class="dia2" /><strong><?php } echo $evento->evento;?></strong><?php if($evento->descripcion) {echo "<br/>".$evento->descripcion;}?></td>
    </tr>
    <?php
	}
?>
  </table>
  <p>&nbsp;</p>
    <table>
      <tr>
        <th>Horario</th>
        <?php
        foreach($columnas->result() as $columna) {
	?>
        <th><?php echo $columna->ubicacion; ?></th>
        <?php
	     }
    ?>
      </tr>
      <?php
	$i = 1;
	$rowspan = 1;
  	foreach($filas2->result() as $fila) {
  ?>
      <tr>
        <td><?php echo $fila->inicio." - ".$fila->fin;?></td>
        <?php
		foreach($columnas->result() as $columna) {
		  foreach($eventos4->result() as $evento) {
			  if($evento->inicio == $fila->inicio && $evento->ubicacion_evento == $columna->id_ubicacion_evento) {
				  $rowspan = (strtotime($evento->fin) - strtotime($evento->inicio)) / 1800;
				  if($evento->fin == $fila->fin) {
	?>
        <td>
    <?php
		if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) {
    ?>
    	<div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia2" />
    <?php
		}
    ?>
        <span><strong><?php echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
        <?php
				  }
				  for($j=0; $j<=3; $j++) {
					  $aux = $filas2->result();
					  if(isset($aux[$i+$j]->fin)) {
						  if($evento->fin == $aux[$i+$j]->fin && $fila->fin != $aux[$i+$j]->fin) {
			?>
        <td rowspan="<?php echo $rowspan; ?>"><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia2" /><span><strong><?php } echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
        <?php
						  }
					  }
				  }
			  }
		  }
	  }
	?>
      </tr>
      <?php
  		($i < $filas2->num_rows()-1) ? $i++ : $i = $filas2->num_rows()-1;
	}
  ?>
      <tr>
        <td colspan="<?php echo $columnas->num_rows() + 1; ?>"><span>Clausura<br />18:00 - 18:30</span></td>
      </tr>
    </table>
  </div>
</div>
<div class="btn_tabs">
  <span><button id="btn_ant_tab">Anterior</button></span>
  <button id="btn_sig_tab">Siguiente</button>
</div>
<div class="div-captcha" style="display:none;">
  <?php
	echo form_label('* Escriba el texto que se muestra:');
	$attr = array(
				 'id'		=>	'captcha',
				 'name'		=>	'captcha',
				 'title'	=>	'Escribe la palabra que se muestra en la imagen de abajo'
				 );
	echo form_input($attr);
	echo '<input type="hidden" id="oculto" name="oculto" value="" />';
	echo '<input type="hidden" id="id_usuario" name="id_usuario" value="'.$usuario->id_usuario.'" />';
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
	} // Else de la validación de actividades registradas
	echo $toolsPie;
?>
<!--</div>
-->