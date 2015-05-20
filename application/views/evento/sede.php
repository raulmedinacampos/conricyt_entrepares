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

        <p><strong>Sede: Centro de Convenciones Yucatán Siglo XXI<br />

          <br />

        Dirección: C. 60 Nte. #299-E Ex-Cordemex. Col. Revolución. C.P. 97118. Mérida, Yucatán, México.<br />

        <br />

        Teléfono: 01 (999) 942 1900</strong></p>

      </td>

    </tr>

  </table>

<br clear="all" />
  <div class="mapa" style=" position:relative; float:left; margin-left:10px; display:block;">

   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9835299486876!2d-89.62957799999998!3d21.033345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f56742600e2aed3%3A0x6916ea0e8d04a6f7!2sCENTRO+DE+CONVENCIONES+Y+EXPOSICIONES+YUCAT%C3%81N+SIGLO+XXI!5e0!3m2!1ses!2smx!4v1429662744199" width="100%" height="350" frameborder="0" style="border:0"></iframe>

    </div>


<br clear="all" />

  <div id="imagenesHoteles" class="owl-carousel" style=" position:relative; float:left; display:block;">

    <img src="<?php echo base_url(); ?>images/yucatan/1.jpg" />

    <img src="<?php echo base_url(); ?>images/yucatan/2.jpg" />

    <img src="<?php echo base_url(); ?>images/yucatan/3.jpg" />

    <img src="<?php echo base_url(); ?>images/yucatan/4.jpg" />

    <img src="<?php echo base_url(); ?>images/yucatan/5.jpg" />

    <img src="<?php echo base_url(); ?>images/yucatan/6.jpg" />

    <img src="<?php echo base_url(); ?>images/yucatan/7.jpg" />

  </div>

<?php

  	echo $toolsPie;

?>

</div>

