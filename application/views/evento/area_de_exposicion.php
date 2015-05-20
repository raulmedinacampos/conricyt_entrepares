<script type="text/javascript">
	$(function() {
		$.getJSON("<?php echo base_url();?>scripts/stands.json", function(data) {
			$.each(data.stand, function(key, val) {
				$("#plano").append('<div id="stn'+val.id+'" data-div="'+val.id+'" data-editorial="'+val.editorial+'" data-logo="'+val.logo+'" data-url="'+val.url+'" data-x="'+val.x+'" data-y="'+val.y+'" style="top:'+val.y+'px;left:'+val.x+'px;"></div>');
			});
			
			$.each($("#plano div"), function() {
				var texto = '<a href="'+$(this).data('url')+'" target="_blank"><p>'+$(this).data('editorial')+'</p>';
				texto += '<img src="<?php echo base_url(); ?>images/stands/'+$(this).data('logo')+'" /></a>';
				var div = $('<div></div>');
				var contenedor = $('<div class="info"></div>');
				div.append(texto);
				contenedor.append(div);
				$(this).append(contenedor);
				$(this).hover(function() {
					$(this).children().fadeIn(200);
				}, function() {
					$(this).children().fadeOut(200);
				});
			});
			
		});
		
		$(".tarifas li").hover(function() {
			var capa = $(this).data('id');
			switch(capa) {
				case 1:
				case 2:
					$("#stn1,#stn2").css("background-color", "rgba(75,106,141,0.4)");
					$("#stn1").children().css("left", "-95px");
					break;
				case 19:
				case 20:
					$("#stn19,#stn20").css("background-color", "rgba(75,106,141,0.4)");
					$("#stn19").children().css("left", "-95px");
					break;
				case 21:
				case 22:
					$("#stn21,#stn22").css("background-color", "rgba(75,106,141,0.4)");
					$("#stn21").children().css("left", "-94px");
					break;
				case 28:
				case 29:
					$("#stn28,#stn29").css("background-color", "rgba(75,106,141,0.4)");
					$("#stn28").children().css("left", "-35px");
					break;
				default:
					$("#stn"+capa).css("background-color", "rgba(75,106,141,0.4)");
					break;
			}
			
			$("#stn"+capa).children().fadeIn(200);
			//alert($("#stn"+capa).children().offset().toSource());
			//if($(document).scrollTop() > 330 && $("#stn"+capa).position().top < 330) {
			/*if($(document).scrollTop() > 330 && $("#stn"+capa).position().top < 350) {
				$("html, body").animate({ scrollTop: 330 }, 600);
			}*/
		}, function() {
			var capa = $(this).data('id');
			switch(capa) {
				case 1:
				case 2:
					$("#stn1,#stn2").css("background-color", "none");
					break;
				case 8:
				case 9:
				case 10:
					$("#stn8,#stn9,#stn10").css("background-color", "none");
					break;
				case 11:
				case 12:
					$("#stn11,#stn12").css("background-color", "none");
					break;
				case 19:
				case 20:
					$("#stn19,#stn20").css("background-color", "none");
					break;
				case 21:
				case 22:
					$("#stn21,#stn22").css("background-color", "none");
					break;
				case 28:
				case 29:
					$("#stn28,#stn29").css("background-color", "none");
					break;
				default:
					$("#stn"+capa).css("background-color", "none");
					break;
			}
			
			$("#stn"+capa).children().fadeOut(200);
		});
	});
</script>
<div id="contenido">
<?php
	echo $tools;
?>
  <p><em>Entre Pares,</em> Seminario para  publicar y navegar en las redes de la información científica, brinda un espacio para la exhibición y promoción del fondo científico de las casas editoras,  integradoras y empresas que ofrecen herramientas para la búsqueda de  información científica, patrocinadoras del evento:</p>
  <div id="plano"><img src="<?php echo base_url();?>images/mapa_stands.png" /></div>
<table class="tarifas">
    <tr>
      <td>
        <h3>Editoriales</h3>
        <ul>
          <li data-id="26">ACS Publications</li>
          <li data-id="7">BioOne</li>
          <li data-id="18">Cambridge</li>
          <li data-id="1">Dotlib</li>
          <li data-id="32">Ebsco</li>
          <li data-id="3">Elsevier</li>
          <li data-id="6">Emerald</li>
          <li data-id="13">e-Tech Solutions</li>
          <li data-id="4">IOP</li>
          <li data-id="19">Lippincott</li>
          <li data-id="30">Nature</li>
          <li data-id="14">Oxford</li>
          <li data-id="31">Springer</li>
          <li data-id="28">Systems Link</li>
          <li data-id="27">Taylor &amp; Francis</li>
        </ul>
      </td>
      <td>
        <ul style="margin-top:0;">
          <li data-id="16">Thomson Reuters</li>
          <li data-id="17">Wiley</li>
        </ul>
        <h3>IES y Centros de Investigación</h3>
        <ul>
          <li data-id="21">CICY</li>
          <li data-id="8">Revista Acta Universitaria</li>
        </ul>
        <h3 style="margin-top:19px;">Proveedores de servicio</h3>
        <ul>
          <li data-id="10">AJE</li>
          <li data-id="12">Akarenni</li>
          <li data-id="9">Dulces La Tradicional</li>
          <li data-id="25">Escire</li>
          <li data-id="5">Infoestratégica</li>
          <li data-id="11">OCV</li>
          <li data-id="15">Swets</li>
        </ul>
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>Con el objetivo de propiciar la difusión y el acercamiento entre el  público y los representantes de las editoriales patrocinadoras, se espera la visita a esta área de la comunidad científica, docentes, estudiantes de posgrado y público en general, interesados en conocer  los materiales producidos por las editoriales.</p>
  <p>¡No dejes de visitarlo!</p>
<?php
  	echo $toolsPie;
?>
</div>
