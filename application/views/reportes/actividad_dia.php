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
	.xsl_ico {
		display: inline;
		float: right;
		margin-bottom: 10px;
		margin-top: -5px;
	}
</style>
<a href="<?php echo base_url('reporte/por-actividad-dia/xls'); ?>"><img class="xsl_ico" src="<?php echo base_url('images/excel.png'); ?>" /></a>
<h3>22 de septiembre</h3>
<table>
  <tr>
  	<th>No.</th>
    <th>Horario</th>
    <th>Evento</th>
    <th>Registros</th>
  </tr>
  <?php
  	foreach($registros1 as $row) {
  ?>
  <tr>
  	<td><?php echo $i++; ?></td>
    <td><?php echo $row->inicio." - ".$row->fin; ?></td>
    <td><?php echo $row->evento; ?></td>
    <td><?php echo $row->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<br />
<h3>23 de septiembre</h3>
<table>
  <tr>
  	<th>No.</th>
    <th>Horario</th>
    <th>Evento</th>
    <th>Registros</th>
  </tr>
  <?php
	$i = 1;
  	foreach($registros2 as $row) {
  ?>
  <tr>
  	<td><?php echo $i++; ?></td>
    <td><?php echo $row->inicio." - ".$row->fin; ?></td>
    <td><?php echo $row->evento; ?></td>
    <td><?php echo $row->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<?php
	echo $toolsPie;
?>