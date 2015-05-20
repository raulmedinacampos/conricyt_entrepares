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
		margin-top: -25px;
	}
</style>
<h3>Total de registrados: <?php echo $total; ?></h3>
<table>
  <tr>
  	<th>No.</th>
    <th>Región</th>
    <th>Registros</th>
  </tr>
  <?php
  	foreach($registros->result() as $row) {
  ?>
  <tr>
  	<td><?php echo $i++; ?></td>
    <td><?php echo $row->region; ?></td>
    <td><?php echo $row->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<?php
	echo $toolsPie;
?>