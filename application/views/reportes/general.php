<?php
	echo $tools;
	$i = 1;
?>
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
</style>
<h3>Total de registrados: <?php echo $total; ?></h3>
<table>
  <tr>
  	<th>No.</th>
    <th>Folio</th>
    <th>Nombre</th>
    <th>Institución</th>
    <th>Correo</th>
    <th>Invitación</th>
    <th>Comprobante</th>
  </tr>
  <?php
  	foreach($registros->result() as $row) {
  ?>
  <tr>
  	<td><?php echo $i++; ?></td>
    <td><?php echo $row->folio; ?></td>
    <td><?php echo trim($row->nombre." ".$row->ap_paterno." ".$row->ap_materno); ?></td>
    <td><?php echo $row->institucion; ?></td>
    <td><?php echo $row->correo; ?></td>
    <td><a href="<?php echo base_url('preregistro/reimprimirInvitacion/'.$row->id_usuario); ?>" target="_blank">Descargar</a></td>
    <td><?php if($row->usuario) {echo '<a href="'.base_url('preregistro/reimprimirComprobante/'.$row->id_usuario).'" target="_blank">Descargar</a>'; } else {echo 'Sin actividades';} ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<?php
	echo $toolsPie;
?>