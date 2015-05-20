<?php
	echo $tools;
  	$i = 1;
?>
<script type="text/javascript">
	$(function() {
		/*$("td a").click(function(e) {
			e.preventDefault();
			$.post("<?php echo base_url('preregistro/enviarMailUrl'); ?>",
				   {id: $(this).data('usr')},
				   function(data) {
					   alert(data);
				 }
			);
		});*/
	});
</script>
<style type="text/css">
	table {
		width: 100%;
		margin-top: 10px;
		border-collapse: collapse;
		border: 1px #666666 solid;
	}
	th {
		padding: 4px 5px;
		background-color: #484F56;
		color: #FFFFFF;
		text-align: left;
	}
	tr:nth-child(2n+1) {
		background-color: #DEE1E2;
	}
	td {
		padding: 4px 5px;
	}
	td:nth-of-type(2) {
		min-width: 100px;
	}
</style>
<h3>Total de registros: <?php echo $usuarios->num_rows(); ?></h3>
<table>
  <tr>
    <th>No.</th>
    <th>Folio</th>
    <th>Nombre</th>
    <th>Estado</th>
    <th>Teléfono</th>
    <th>Correo</th>
    <th>Institución</th>
    <th>Enlace</th>
  </tr>
  <?php
  	foreach($usuarios->result() as $usuario) {
  ?>
  <tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo $usuario->folio; ?></td>
    <td><?php echo trim($usuario->nombre." ".$usuario->ap_paterno." ".$usuario->ap_materno); ?></td>
    <td><?php echo $usuario->entidad; ?></td>
    <td><?php echo $usuario->telefono; ?></td>
    <td><?php echo $usuario->correo; ?></td>
    <td><?php echo $usuario->institucion; ?></td>
    <td><?php echo base_url().'preregistro/seleccionar-actividades/'.md5($usuario->id_usuario); ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<?php
	echo $toolsPie;
?>