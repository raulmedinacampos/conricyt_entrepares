<script type="text/javascript" src="<?php echo base_url(); ?>scripts/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#imagenesHoteles").owlCarousel({
			items: 2,
			itemsDesktop: [1200, 2],
			itemsTablet: [768, 1],
			itemsMobile: [460, 1],
			autoPlay: true,
			navigation: true,
			navigationText: ["anterior", "siguiente"]
		});
	});
</script>
<link href="<?php echo base_url(); ?>css/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/owl.theme.css" rel="stylesheet" type="text/css" />

<div id="contenido">
<?php
	echo $tools;
?>
  <table class="sede centrado" style="width: 100%;">
    <tr>
      <td class="negro">
        <p><strong>Sede: Poliforum León, Congresos y Exposiciones<br />
          <br />
        Dirección: Blvd. Adolfo López Mateos esq. Blvd. Francisco Villa Col. Oriental. León, Gto., C.P. 37530<br />
        <br />
        Teléfono: (477) 710 7000</strong></p>
      </td>
    </tr>
  </table>
  <div class="mapa">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14887.940430164093!2d-101.6601152!3d21.1131599!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x273b7023f32b0841!2sPoliforum+Le%C3%B3n!5e0!3m2!1ses!2smx!4v1406049976578" width="100%" height="350" frameborder="0" style="border:0"></iframe>
    </div>
  <div id="imagenesHoteles" class="owl-carousel">
    <img src="<?php echo base_url(); ?>images/ugto.jpg" />
    <img src="<?php echo base_url(); ?>images/poliforum1.jpg" />
    <img src="<?php echo base_url(); ?>images/poliforum2.jpg" />
    <img src="<?php echo base_url(); ?>images/sala2_1.jpg" />
    <img src="<?php echo base_url(); ?>images/sala2_2.jpg" />
    <img src="<?php echo base_url(); ?>images/sala2_3.jpg" />
    <img src="<?php echo base_url(); ?>images/sala2_4.jpg" />
  </div>
<?php
  	echo $toolsPie;
?>
</div>
