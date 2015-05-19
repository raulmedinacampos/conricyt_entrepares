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
<?php if($total > $totalSede) { ?>
<h3>Total de registrados: <?php echo $total; ?></h3>
<?php } ?>
<h3>Total de registrados en sede: <?php echo $totalSede; ?></h3>
<h3>Distribución por Estado</h3>
<table>
  <tr>
    <th>Región</th>
    <th>Total de registros</th>
  </tr>
  <?php
  	foreach($resEntidad->result() as $val) {
  ?>
  <tr>
    <td><?php echo $val->entidad; ?></td>
    <td><?php echo $val->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<h3>Distribución por región</h3>
<table>
  <tr>
    <th>Región</th>
    <th>Total de registros</th>
  </tr>
  <?php
  	foreach($resRegion->result() as $val) {
  ?>
  <tr>
    <td><?php echo $val->region; ?></td>
    <td><?php echo $val->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<h3>Distribución por género</h3>
<table>
  <tr>
    <th>Región</th>
    <th>Total de registros</th>
  </tr>
  <?php
  	foreach($resSexo->result() as $val) {
  ?>
  <tr>
    <td><?php echo $val->sexo; ?></td>
    <td><?php echo $val->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<h3>Distribución por tipo de institución</h3>
<table>
  <tr>
    <th>Tipo de institucion</th>
    <th>Total de registros</th>
  </tr>
  <?php
  	foreach($resTipoInstitucion as $val) {
  ?>
  <tr>
    <td><?php echo $val->tipo_institucion; ?></td>
    <td><?php echo $val->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<h3>Distribución por perfil</h3>
<table>
  <tr>
    <th>Perfil</th>
    <th>Total de registros</th>
  </tr>
  <?php
  	foreach($resPerfil->result() as $val) {
  ?>
  <tr>
    <td><?php echo $val->perfil; ?></td>
    <td><?php echo $val->total; ?></td>
  </tr>
  <?php
	}
  ?>
</table>
<?php
	echo $toolsPie;
?>