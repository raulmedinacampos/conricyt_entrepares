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
	obtenerImagen();
	
	$("input:checkbox").each(function() {
		$(this).prop("disabled", false);
		$(this).prop("checked", false);
	});
	
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
});