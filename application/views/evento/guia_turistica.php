<script type="text/javascript" src="<?php echo base_url(); ?>scripts/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("#imagenesTurismo").owlCarousel({
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
  <p>Guanajuato  es una hermosa ciudad minera, Joya de América, que debe su fama y su fortuna al  descubrimiento de ricas vetas de oro y plata. En la Época Prehispánica la  región estuvo habitada por tribus nómadas denominadas Chichimecas. En 1541 se  dieron las primeras incursiones españolas a este territorio y oficialmente fue  fundada en 1570.</p>
  <p>En  el año 1741, Guanajuato recibió el título de Ciudad por el rey Felipe V de  España. Durante el régimen del presidente Benito Juárez, Guanajuato fue temporalmente capital de la República.</p>
  <p>En  1945 el Colegio del Estado se convirtió en la Universidad de Guanajuato. En  1953 se empiezan a representar los Entremeses Cervantinos que dieron origen en  1972, a la creación del máximo evento artístico y cultural de América Latina,  el Festival Internacional Cervantino.</p>
  <p>Si  deseas conocer más sobre esta ciudad o planear un recorrido previo o posterior  al Seminario, te invitamos a que visites este sitio en donde encontrarás  información sobre:</p>
  <ul>
    <li>Atractivos turísticos</li>
    <li>Hospedaje</li>
    <li>Gastronomía</li>
    <li>Eventos y mucho más</li>
  </ul>
  <p>Ingresa a <a href="http://www.guanajuatocapital.mx/" target="_blank">http://www.guanajuatocapital.mx/</a></p>
  <div id="imagenesTurismo" class="owl-carousel">
    <img src="<?php echo base_url(); ?>images/gto1.jpg" />
    <img src="<?php echo base_url(); ?>images/gto2.jpg" />
    <img src="<?php echo base_url(); ?>images/gto3.jpg" />
    <img src="<?php echo base_url(); ?>images/gto4.jpg" />
    <img src="<?php echo base_url(); ?>images/gto5.jpg" />
    <img src="<?php echo base_url(); ?>images/gto6.jpg" />
    <img src="<?php echo base_url(); ?>images/gto7.jpg" />
    <img src="<?php echo base_url(); ?>images/gto8.jpg" />
  </div>
<?php
  	echo $toolsPie;
?>
</div>
