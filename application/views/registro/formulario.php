<!--<div id="contenido">-->
<?php
	echo $tools;
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

		$("[title]").tooltip({
			position: {
				 my: "left top",
				 at: "right+5 top-5"
			}
		});

		$("#correo_conf").bind("cut copy paste",function(e) {
			e.preventDefault();
		});
		
		$("#img-recargar img").click(function(e) {
			e.preventDefault();
			obtenerImagen();
		});
		
		$("#chk_ap_pat").click(function() {
			if($(this).is(":checked")) {
				$("#ap_paterno").attr("disabled", "disabled");
				$("#chk_ap_mat").attr("disabled", "disabled");
			} else {
				$("#ap_paterno").removeAttr("disabled");
				$("#chk_ap_mat").removeAttr("disabled");
			}
		});

		$("#chk_ap_mat").click(function() {
			if($(this).is(":checked")) {
				$("#ap_materno").attr("disabled", "disabled");
				$("#chk_ap_pat").attr("disabled", "disabled");
			} else {
				$("#ap_materno").removeAttr("disabled");
				$("#chk_ap_pat").removeAttr("disabled");
			}
		});
		
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
		
		$("#btn_enviar_reg").click(function() {
			validator.element("#captcha");
			if($("#form_prerregistro").valid()) {
				var confirmacion = '<h4>Confirma la información capturada</h4>';
				confirmacion += "<ul>";
				confirmacion += "<li>Nombre: " + $("#nombre").val() + "</li>";
				confirmacion += "<li>Apellido paterno: " + $("#ap_paterno").val() + "</li>";
				confirmacion += "<li>Apellido materno: " + $("#ap_materno").val() + "</li>";
				confirmacion += "<li>Sexo: " + $("#sexo option:selected").text() + "</li>";
				confirmacion += "<li>Institución de procedencia: " + $("#institucion").val() + "</li>";
				confirmacion += "<li>Entidad federativa: " + $("#entidad option:selected").text() + "</li>";
				if($("#otro_perfil").length) {
					confirmacion += "<li>Perfil: " + $("#otro_perfil").val() + "</li>";
				} else {
					confirmacion += "<li>Perfil: " + $("#perfil option:selected").text() + "</li>";
				}
				if($("#otro_cargo").length) {
					confirmacion += "<li>Cargo: " + $("#otro_cargo").val() + "</li>";
				} else {
					confirmacion += "<li>Cargo: " + $("#cargo option:selected").text() + "</li>";
				}
				confirmacion += "<li>Teléfono: " + $("#telefono").val() + "</li>";
				confirmacion += "<li>Correo: " + $("#correo").val() + "</li>";
				confirmacion += "<li>¿Cómo te enteraste?: " + $("#como_se_entero option:selected").text() + "</li>";
				confirmacion += "<li>¿Cómo te transportarás?: " + $("#transporte option:selected").text() + "</li>";
				confirmacion += "<li>22 de septiembre: " + $(".dia1:checked").length + " actividades</li>";
				confirmacion += "<li>23 de septiembre: " + $(".dia2:checked").length + " actividades</li>";
				confirmacion += "</ul>";
				confirmacion += '<input type="button" id="btn_confirmar" value="Aceptar" />';
				confirmacion += '<input type="button" id="btn_regresar" value="Regresar" />';
				
				$(".mensaje").html(confirmacion);
				$(".mensaje").modal();

				$("#btn_confirmar").click(function() {
					$(".mensaje").html('<br /><br /><img src="<?php echo base_url(); ?>images/loading.gif" />');
					$.post('<?php echo base_url();?>preregistro/alta',
							$("#form_prerregistro").serialize(),
							function(data) {
								$(".mensaje").toggle();
								$('.lbox').remove();
								$(".mensaje").html('<br/><h3>'+data+'</h3><br/><input type="button" id="btn_limpiar" value="Aceptar" onclick="limpiar();" />');
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
		
		$("#chk_recorrido").change(function() {
			if($(this).is(":checked")) {
				li = "<li><a href='#tab4'>Recorrido turístico</a></li>";
				tabs.find(".ui-tabs-nav").append(li);
				$("#tab4").css("display", "block");
				tabs.tabs( "refresh" );
				$("#nombre_rec").val($("#nombre").val());
				$("#ap_pat_rec").val($("#ap_paterno").val());
				$("#ap_mat_rec").val($("#ap_materno").val());
				$("#inst_rec").val($("#institucion").val());
				$("#fecha_llegada").prop("disabled", false);
				$("#hora_llegada").prop("disabled", false);
				$("#celular").prop("disabled", false);
				mostrarEnvio();
			} else {
				if($(".ui-tabs-nav li").length >= 4) {
					tabs.find(".ui-tabs-nav li").last().remove();
					$("#tab4").css("display", "none");
					ocultarEnvio();
				}
			}
		});
		
		$("#btn_cancelar_rec").click(function() {
			$("#tabs").tabs({ active: 0 });
			$("#chk_recorrido").prop("checked", false);
			$("#chk_recorrido").trigger("change");
			$(".btn_tabs").css("display", "block");
			$(".div-captcha").css("display", "none");
		});
		
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
				nombre: {
					required: true
				},
				ap_paterno: {
					required: true
				},
				ap_materno: {
					required: true
				},
				sexo: "required",
				institucion: {
					required: true
				},
				entidad: "required",
				perfil: "required",
				otro_perfil: {
					required: true
				},
				cargo: "required",
				otro_cargo: {
					required: true
				},
				telefono: {
					required: true,
					telefono: true
				},
				correo: {
					required: true,
					email: true
				},
				correo_conf: {
					equalTo: "#correo"
				},
				como_se_entero: "required",
				transporte: "required",
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
				nombre: "Campo obligatorio",
				ap_paterno: "Campo obligatorio",
				ap_materno: "Campo obligatorio",
				sexo: "Campo obligatorio",
				institucion: "Campo obligatorio",
				entidad: "Campo obligatorio",
				perfil: "Campo obligatorio",
				otro_perfil: "Campo obligatorio",
				cargo: "Campo obligatorio",
				otro_cargo: "Campo obligatorio",
				telefono: {
					required: "Campo obligatorio",
					telefono: "Teléfono inválido"
				},
				correo: {
					required: "Campo obligatorio",
					email: "Correo inválido"
				},
				correo_conf: "Verifique el correo",
				como_se_entero: "Campo obligatorio",
				transporte: "Campo obligatorio",
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
<h4>LEE CUIDADOSAMENTE LAS INDICACIONES ANTES DE INICIAR TU PREREGISTRO</h4>
<p class="texto_prereg">Para realizar tu preregistro al Seminario Entre Pares 2014 debes llenar el siguiente formulario. Es importante que verifiques que tus datos sean correctos, pues de la misma manera en que llenes los campos de nombre y apellidos aparecerán en el comprobante y la Carta Invitación que recibirás por correo electrónico, así como en la Constancia de Asistencia que se emitirá posterior al evento.</p>
<p class="texto_prereg">A continuación encontrarás tres botones en la parte superior del formulario que se deben llenar de manera obligatoria, en el primer ingresa información personal y en los otros dos selecciona las actividades por día del Seminario que sean de tu interés. Los eventos seleccionados no deben empalmarse en horario pues el sistema automáticamente te deshabilitará las casillas.</p>
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
    <li><a href="#tab1">Datos personales</a></li>
    <li><a href="#tab2">22 de septiembre</a></li>
    <li><a href="#tab3">23 de septiembre</a></li>
  </ul>
<div id="tab1">
  <div class="preregistro">
<?php
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
?>
  </div> <!-- Termina contenedor del formulario -->
  <div style="clear:both;"></div>
</div> <!-- Termina tab1 -->

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