<style type="text/css">
/*estilos para datos  de la confirmacion*/
#datos-confirmacion { position:relative; margin:auto; width:460px; max-width:400px; height:180px; max-height:180px; line-height:20px; padding:10px;  border:#666 3px solid; text-align:left; background-color:#CCC; color:#333; margin-top:50px; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow: 5px 5px 0 #333; -webkit-box-shadow: 5px 5px 10px #333; -moz-box-shadow:50px 50px  #333; }
</style>
<div id="datos-confirmacion">
<?php
	if(!$usuario) {
		echo '<h1>Escanee el código QR</h1>';
	} else {
		if($yaConfirmado) {
			echo '<h1>'.trim($usuario->nombre." ".$usuario->ap_paterno." ".$usuario->ap_materno).' ya ha sido confirmado</h1>';
			echo '<h3><a href="'.base_url('registro/confirmar').'">Regresar</a></h3>';
		} else if($confirmado) {
?>
  <h3>Folio: <?php echo $usuario->folio; ?><br />
  Nombre: <?php echo trim($usuario->nombre." ".$usuario->ap_paterno." ".$usuario->ap_materno); ?><br />
  Institución: <?php echo $usuario->institucion; ?></h3>
  <h2>El registro se ha actualizado</h2>
  <h3><a href="<?php echo base_url('registro/confirmar'); ?>">Regresar</a></h3>
  <?php
		} else {
			echo '<h2>El registro no se pudo actualizar, intente hacelo manualmente <a href="'.base_url('registro/confirmar-manual').'">aquí</a></h2>';
		}
	}
?>
</div>
