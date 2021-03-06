<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Entre Pares

<?php if(isset($title)) {echo " - ".$title;} ?>

</title>

<!-- Favicon -->

<link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon" />

<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon" />

<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/vnd.microsoft.icon" />

<!-- Stylesheet -->

<link href="<?php echo base_url(); ?>css/estilos.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/estilos-responsive.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/impresion.css" rel="stylesheet" type="text/css" media="print" />

<link href="<?php echo base_url(); ?>css/jquery.shadow.css" rel="stylesheet" type="text/css" />

<!-- Javascript libraries -->

<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery-1.11.0.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>scripts/modernizr-latest.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>scripts/herramientas.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.validate.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.watermark.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.shadow.js"></script>

<script type="text/javascript">

	$(function() {

		$("#busqueda").watermark("Buscar");

		

		$("#menu ul li").bind("mouseover", function() {

			$(this).children("ul").fadeIn();

		});

		

		$("#menu ul li").bind("mouseleave", function() {

			$(this).children("ul").fadeOut();

		});

		

		$("#menu ul li ul li").bind("mouseover", function() {

			$(this).parent().stop();

		});

		

		$(".itemBackToTop a").click(function() {

			$("html, body").animate({ scrollTop: 212 }, 600);

			return false;

		});

	});

</script>

<!-- Google Analytics -->

<script>  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');  ga('create', 'UA-34749925-1', 'auto');  ga('send', 'pageview');</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35299003-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Fin Google Analytics -->


<!--scroll subir-->
<script type="text/javascript">
    $(document).ready(function(){
  
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
  
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
  
    });
</script>

<!-- este código esta en el footer <a href="#" class="scrollup"></a> es donde se ubica el boton-->
<style>
.scrollup{width:40px; height:40px; opacity:0.8; position:fixed; bottom:50px; right:100px; display:none; text-indent:-9999px; background-image: url(http://entrepares.conricyt.mx/images/icon_top.png);  border:orange 0px solid; 
}
</style>
<!--fin scroll subir-->

<!-- fijar menu -->
<script>

$(function() {

	// grab the initial top offset of the navigation 
	var sticky_navigation_offset_top = $('#menu').offset().top;
	
	// our function that decides weather the navigation bar should have "fixed" css position or not.
	var sticky_navigation = function(){
		var scroll_top = $(window).scrollTop(); // our current vertical position from the top
		
		// if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
		if (scroll_top > sticky_navigation_offset_top) { 
			
			if ($( window ).width() > 899){
				
			$('#menu').css({ 'position': 'fixed', 'width': '100%',  'top':0, 'left':0, 'z-index':100 });
			}
			
		} else {
			$('#menu').css({ 'position': 'relative' }); 
		}   
	};
	
	// run our function on load
	sticky_navigation();
	
	// and run it again every time you scroll
	$(window).scroll(function() {
		 sticky_navigation();
	});
	
	// NOT required:
	// for this demo disable all links that point to "#"
	$('a[href="#"]').click(function(event){ 
		event.preventDefault(); 
	});
	
});
</script>

<!--Fin  fijar menu -->


</head>

<body>

<div id="fb-root" ></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>

<div id="comunidad" >

  <div  id="comunidad-busqueda"  >

    <!-- <div id="buscador" style=" position: relative; float:right; top:2px;  right:10px;">

      <form id="formBuscador" method="post" action="">

        <input type="text" name="busqueda" id="busqueda" />

        <img src="<?php echo base_url(); ?>images/btnBuscar.png" alt="" width="25" height="25" />

      </form>

    </div>-->

    <div id="comunidad-redes" > <a href="http://blog.conricyt.mx/" target="_blank">

      <div style=" position: absolute; left:0px; min-width:27px; min-height:27px; border:red 0px solid; "></div>

      </a> <a href="http://www.youtube.com/user/CONRICYT" target="_blank">

      <div style=" position: absolute; left:31px; min-width:27px; min-height:27px; border:red 0px solid; "></div>

      </a> <a href="https://twitter.com/CONRICYT" target="_blank">

      <div style=" position: absolute; left:62px; min-width:27px; min-height:27px; border:red 0px solid; "></div>

      </a> <a href="https://www.facebook.com/CONRICYT" target="_blank">

      <div style=" position: absolute; left:93px; min-width:27px; min-height:27px; border:red 0px solid; "></div>

      </a> </div>

  </div>

</div>

<header >

  <div id="headerInt" style=" border:yellow 0px solid;  ">

    <!--    <div id="accesoComunidad"> <a href="#"><img src="<?php //echo base_url(); ?>images/btnUnirse.png" alt="" /></a> <a href="#"><img src="<?php //echo base_url(); ?>images/btningresar.png" alt="" /></a> </div>-->

    <div id="headerInt-entrepares" > <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="Entrepares" /></a> </div>

    <div id="headerInt-medio" ><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo-medio.png" alt="Entrepares" /></a></div>

    <div id="headerInt-conricyt" > <a href="http://www.conricyt.mx/" target="_blank"><img src="<?php echo base_url(); ?>images/conricyt.png" alt="" /></a> </div>

  </div>

</header>

<nav id="menu" >

  <ul>

    <li><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/home.png" alt="" /></a></li>

    <li>Acerca de

      <ul>

        <li><a href="<?php echo base_url(); ?>acerca-de/conricyt">CONRICYT</a></li>

        <li><a href="<?php echo base_url(); ?>acerca-de/entre-pares">Entre Pares</a></li>

      </ul>

    </li>

    <li>Sobre el evento

      <ul>

        <li><a href="<?php echo base_url(); ?>sobre-el-evento/sede">Sede</a></li>

        <!--<li><a href="<?php echo base_url(); ?>sobre-el-evento/patrocinadores">Patrocinadores</a></li>

        <li><a href="<?php echo base_url(); ?>sobre-el-evento/area-de-exposicion">Área de exposición</a></li>

        <li><a href="<?php echo base_url(); ?>sobre-el-evento/hospedaje">Hospedaje</a></li>

        <li><a href="<?php echo base_url(); ?>sobre-el-evento/avisos">Avisos</a></li>

        <li><a href="<?php echo base_url(); ?>sobre-el-evento/guia-turistica">Guía turística</a></li>

        <li><a href="<?php echo base_url(); ?>sobre-el-evento/actividades-extraseminario">Actividades Extraseminario</a></li>--><!--Se quito por falta de información-->

      </ul>

    </li>

    <!--<li>Programa

      <ul>

        <li><a href="<?php echo base_url(); ?>programa/programa-preliminar">Programa descargable</a></li>

         
        <li><a href="<?php echo base_url(); ?>programa/22-septiembre-2014">22 de septiembre</a></li>
       
        <li><a href="<?php echo base_url(); ?>programa/23-septiembre-2014">23 de septiembre</a></li>
        
              <li><a href="<?php echo base_url(); ?>programa/expositores-perfil-y-semblanza">Conferenciastas: Semblanza curricular</a></li>

      </ul>-->

    </li>

   <!-- <li><a href="<?php echo base_url(); ?>actividades">Actividades</a>

      <ul>

        <li><a href="<?php echo base_url(); ?>actividades/conferencias">Conferencias</a></li>

        <li><a href="<?php echo base_url(); ?>actividades/talleres">Talleres</a></li>

        <li><a href="<?php echo base_url(); ?>actividades/encuentros">Encuentros</a></li>-->

        <!--<li><a href="<?php echo base_url(); ?>actividades/encuentro-de-editores-de-revistas-cientificas-mexicanas">Encuentro de editores de revistas</a></li>

        <li><a href="<?php echo base_url(); ?>actividades/encuentro-con-bibliotecarios">Encuentro con bibliotecarios</a></li>

        <li><a href="<?php echo base_url(); ?>actividades/encuentro-de-revistas-cientificas">Encuentro de revistas científicas</a></li>-->

      <!--</ul>

    </li>-->

    <!--<li><a href="<?php echo base_url(); ?>carta-invitacion">Carta invitación</a></li>-->

    <!--    <li><a href="<?php echo base_url(); ?>descargables">Descargables</a>

	  <ul>

        <li><a href="<?php echo base_url(); ?>descargables/descargables-7-de-octubre-2013">Conferencias 7 de octubre de 2013</a></li>

        <li><a href="<?php echo base_url(); ?>descargables/descargables-8-de-octubre-2013">Conferencias 8 de octubre de 2013</a></li>

      </ul>

    </li>-->

    <!--<li><a href="http://new.livestream.com/accounts/10001055" target="_blank">Transmisión en vivo</a></li>-->
	
	<!--<li><a href="<?php echo base_url('constancia'); ?>">Constancia</a></li>-->

    <li>Materiales

      <ul>

        <li><a href="<?php echo base_url(); ?>materiales/logos">Logos</a></li>

<!--        <li><a href="<?php //echo base_url(); ?>materiales/flyers">Flyers</a></li>
        
        <li><a href="<?php //echo base_url(); ?>materiales/presentaciones-2014">Presentaciones 2014</a></li>-->
        
        <li><a href="<?php echo base_url(); ?>materiales/galeria-fotos-2014">Descargables 2014</a></li>
        
        <li><a href="<?php echo base_url(); ?>materiales/descargables-2013">Descargables 2013</a></li>
        
        <li><a href="<?php echo base_url(); ?>materiales/descargables-2012">Descargables 2012</a></li>

      </ul>

    </li>

    <li><a href="<?php echo base_url(); ?>video">Videos</a></li>

    <li><a href="<?php echo base_url(); ?>contacto">Contacto</a></li>

    <!--    <li><a href="<?php echo base_url(); ?>contacto">Histórico</a></li>-->

  </ul>

</nav>

<div id="contenedor" style=" border:red 0px solid; ">

