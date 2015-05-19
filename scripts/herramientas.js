// Herramientas

$.fn.modal = function(){
	$('body').append('<div class="lbox"></div>');
	$(".mensaje").toggle();
	$("#btn_regresar").click(function() {
		$(".mensaje").toggle();

		if($(".mensaje").is(":visible") == 0) {
			$('.lbox').remove();
		}
	});
};

$(function() {
	var tamanio = 1.15;
	
	$("a.print").click(function(e) {
		e.preventDefault();
		window.print();
	});
	
	$("a.send_mail").click(function(e) {
		e.preventDefault();
		var formulario = '';
		formulario += '<div class="form_contenido mensaje">';
		formulario += '<form id="form_herramientas" name="form_herramientas" method="post" action="">';
		formulario += '<br /><h3>Enviar esta p\u00e1gina por correo electr\u00f3nico</h3><br />';
		formulario += '<input type="text" id="correo_pdf" name="correo_pdf" /><br /><br />';
		formulario += '<input type="hidden" id="url" name="url" value="'+$(location).attr('href')+'" />';
		formulario += '<input type="button" id="btn_enviar_pdf" name="btn_enviar_pdf" value="Enviar" />'
		formulario += '<input type="button" id="btn_cerrar_pdf" value="Cancelar" />'
		formulario += '</form>';
		formulario += '</div>';
		$(".itemToolbar").after(formulario);
		
		$("#correo_pdf").watermark("Correo electr\u00f3nico");
		$(".modal").modal();
		
		$("#btn_enviar_pdf").click(function(e) {
			e.preventDefault();
			var form1 = $(this).parent("form");
			if(form1.valid()) {
				$(".mensaje").html('<br /><br /><img src="/images/loading.gif" />');
				$.post('/preregistro/enviarContenido',
					   form1.serialize(),
					   function(data) {
						   var confirmacion = '<br/><br/><h3>'+data+'</h3><br/>';
						   confirmacion += '<input type="button" id="btn_cerrar_pdf" value="Aceptar" />';
						   $(".mensaje").html(confirmacion);
						   
							$("#btn_cerrar_pdf").click(function(e) {
								$(".form_contenido").remove();
								$('.lbox').remove();
							});
					   }
				);
			}
		});
		
		$("#btn_cerrar_pdf").click(function(e) {
			$(".form_contenido").remove();
			$('.lbox').remove();
		});
		
		$("#form_herramientas").validate({
			rules: {
				correo_pdf: {
					required: true,
					email: true
				}
			},
			messages: {
				correo_pdf: ''
			}
		});
	});
	
	$("a.zoom_out").click(function(e) {
		e.preventDefault();
		if(tamanio > 0.9) {
			tamanio -= 0.1;
			$("#contenido").css("font-size", tamanio + "em");
		}
	});
	
	$("a.zoom_in").click(function(e) {
		e.preventDefault();
		if(tamanio < 1.35) {
			tamanio += 0.1;
			$("#contenido").css("font-size", tamanio + "em");
		}
	});
});