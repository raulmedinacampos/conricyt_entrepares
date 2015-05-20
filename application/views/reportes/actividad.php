<!--<div id="contenido">-->
<?php
	echo $tools;
?>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.watermark.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>scripts/jquery.mask.min.js"></script>
<script type="text/javascript">
$(function() {
	var tabs = $("#tabs").tabs();
});
</script>
<link href="<?php echo base_url(); ?>css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	table {
		width: 100%;
		border-collapse: collapse;
		border: 1px #5D5D5D solid;
	}
	th {
		padding: 5px 0;
		background-color: #484F56;
		color: #FFFFFF;
	}
	td {
		min-width: 80px;
		padding: 5px;
		background-color: #FFFFFF;
		border: 1px #5D5D5D solid;
		vertical-align: top;
	}
	td:first-of-type {
		width: 80px;
		font-weight: bold;
	}
	td:hover {
		background-color: #D8DCE2;
	}
	td div {
		position: absolute;
		margin: 3px 0 0 3px;
		height: 14px;
		width: 14px;
	}
	td span {
		display: block;
		text-align: center;
	}
	.ui-widget {
		font-family: inherit !important;
		font-size: inherit !important;
	}
	.ui-widget-header {
		background: none;
		border: none;
		border-bottom: 1px #CCCCCC solid;
		border-radius: unset;
	}
	.ui-state-active a, .ui-state-active a:link, .ui-state-active a:visited {
		color: #2E4156;
	}
	.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
		border: 1px #CCCCCC solid;
	}
	.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover {
		background: none #FFFFFF;
		border: 1px #CCCCCC solid;
	}
	.ui-state-hover a, .ui-state-hover a:hover, .ui-state-hover a:link, .ui-state-hover a:visited {
		color: #969696;
	}
	.inscritos1 {
		float: right;
	}
	.inscritos1, .inscritos2 {
		color: #FF0000;
		font-weight: bold;
	}
</style>
<h3>Total de registrados: <?php echo $total; ?></h3><br />
<div id="tabs">
  <ul>
    <li><a href="#tab1">22 de septiembre</a></li>
    <li><a href="#tab2">23 de septiembre</a></li>
  </ul>
  <div id="tab1">
    <table>
      <tr>
        <th>Horario</th>
        <th>Poliforum León</th>
      </tr>
      <?php
	foreach($eventos1->result() as $evento) {
?>
      <tr>
        <td><?php echo $evento->inicio.' - '.$evento->fin; ?></td>
        <td><strong><?php echo $evento->evento;?></strong><?php if($evento->descripcion) {echo "<br/>".$evento->descripcion;}?>
        <?php
		  if($evento->tipo_evento == 1 || $evento->tipo_evento == 2 || $evento->tipo_evento == 6) {
			  $t_reg = 0;
		      foreach($registrados->result() as $reg) {
			      if($reg->id_evento == $evento->id_evento) {
					  $t_reg = $reg->total;
			      }
		      }
		?>
          <span class="inscritos1"><?php if($t_reg > 0) {echo '('.$t_reg.')';} ?></span>
        <?php
		  }
        ?>
        </td>
      </tr>
      <?php
	}
?>
    </table>
    <p>&nbsp;</p>
    <table>
      <tr>
        <th>Horario</th>
        <?php
        foreach($columnas->result() as $columna) {
	?>
        <th><?php echo $columna->ubicacion; ?></th>
        <?php
	     }
    ?>
      </tr>
      <?php
	$i = 1;
	$rowspan = 1;
  	foreach($filas1->result() as $fila) {
  ?>
      <tr>
        <td><?php echo $fila->inicio." - ".$fila->fin;?></td>
        <?php
		foreach($columnas->result() as $columna) {
		  foreach($eventos2->result() as $evento) {
			  if($evento->inicio == $fila->inicio && $evento->ubicacion_evento == $columna->id_ubicacion_evento) {
				  $rowspan = (strtotime($evento->fin) - strtotime($evento->inicio)) / 1800;
				  if($evento->fin == $fila->fin) {
	?>
        <td><span><strong><?php echo $evento->evento; ?></strong><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span>
        <?php
		  if($evento->tipo_evento == 1 || $evento->tipo_evento == 2 || $evento->tipo_evento == 6) {
			  $t_reg = 0;
		      foreach($registrados->result() as $reg) {
			      if($reg->id_evento == $evento->id_evento) {
					  $t_reg = $reg->total;
			      }
		      }
		?>
          <span class="inscritos2"><?php if($t_reg > 0) {echo '('.$t_reg.')';} ?></span>
        <?php
		  }
        ?>
        </td>
        <?php
				  }
				  for($j=0; $j<=3; $j++) {
					  $aux = $filas1->result();
					  if(isset($aux[$i+$j]->fin)) {
						  if($evento->fin == $aux[$i+$j]->fin && $fila->fin != $aux[$i+$j]->fin) {
			?>
        <td rowspan="<?php echo $rowspan; ?>"><span><strong><?php echo $evento->evento; ?></strong><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span>
        <?php
		  if($evento->tipo_evento == 1 || $evento->tipo_evento == 2 || $evento->tipo_evento == 6) {
			  $t_reg = 0;
		      foreach($registrados->result() as $reg) {
			      if($reg->id_evento == $evento->id_evento) {
					  $t_reg = $reg->total;
			      }
		      }
		?>
          <span class="inscritos2"><?php if($t_reg > 0) {echo '('.$t_reg.')';} ?></span>
        <?php
		  }
        ?>
        </td>
        <?php
						  }
					  }
				  }
			  }
		  }
	  }
	?>
      </tr>
      <?php
  		($i < $filas1->num_rows()-1) ? $i++ : $i = $filas1->num_rows()-1;
	}
  ?>
      <tr>
        <td colspan="<?php echo $columnas->num_rows() + 1; ?>"><span>Fin de la jornada</span></td>
      </tr>
    </table>
  </div>
  <div id="tab2">
  <table>
    <tr>
      <th>Horario</th>
      <th>Poliforum León</th>
    </tr>
    <?php
	foreach($eventos3->result() as $evento) {
?>
    <tr>
      <td><?php echo $evento->inicio.' - '.$evento->fin; ?></td>
      <td><strong><?php echo $evento->evento;?></strong><?php if($evento->descripcion) {echo "<br/>".$evento->descripcion;}?>
        <?php
		  if($evento->tipo_evento == 1 || $evento->tipo_evento == 2 || $evento->tipo_evento == 6) {
			  $t_reg = 0;
		      foreach($registrados->result() as $reg) {
			      if($reg->id_evento == $evento->id_evento) {
					  $t_reg = $reg->total;
			      }
		      }
		?>
          <span class="inscritos1"><?php if($t_reg > 0) {echo '('.$t_reg.')';} ?></span>
        <?php
		  }
        ?>
      </td>
    </tr>
    <?php
	}
?>
  </table>
  <p>&nbsp;</p>
    <table>
      <tr>
        <th>Horario</th>
        <?php
        foreach($columnas->result() as $columna) {
	?>
        <th><?php echo $columna->ubicacion; ?></th>
        <?php
	     }
    ?>
      </tr>
      <?php
	$i = 1;
	$rowspan = 1;
  	foreach($filas2->result() as $fila) {
  ?>
      <tr>
        <td><?php echo $fila->inicio." - ".$fila->fin;?></td>
        <?php
		foreach($columnas->result() as $columna) {
		  foreach($eventos4->result() as $evento) {
			  if($evento->inicio == $fila->inicio && $evento->ubicacion_evento == $columna->id_ubicacion_evento) {
				  $rowspan = (strtotime($evento->fin) - strtotime($evento->inicio)) / 1800;
				  if($evento->fin == $fila->fin) {
	?>
        <td><span><strong><?php echo $evento->evento; ?></strong><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span>
        <?php
		  if($evento->tipo_evento == 1 || $evento->tipo_evento == 2 || $evento->tipo_evento == 6) {
			  $t_reg = 0;
		      foreach($registrados->result() as $reg) {
			      if($reg->id_evento == $evento->id_evento) {
					  $t_reg = $reg->total;
			      }
		      }
		?>
          <span class="inscritos2"><?php if($t_reg > 0) {echo '('.$t_reg.')';} ?></span>
        <?php
		  }
        ?>
        </td>
        <?php
				  }
				  for($j=0; $j<=3; $j++) {
					  $aux = $filas2->result();
					  if(isset($aux[$i+$j]->fin)) {
						  if($evento->fin == $aux[$i+$j]->fin && $fila->fin != $aux[$i+$j]->fin) {
			?>
        <td rowspan="<?php echo $rowspan; ?>"><span><strong><?php echo $evento->evento; ?></strong><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span>
        <?php
		  if($evento->tipo_evento == 1 || $evento->tipo_evento == 2 || $evento->tipo_evento == 6) {
			  $t_reg = 0;
		      foreach($registrados->result() as $reg) {
			      if($reg->id_evento == $evento->id_evento) {
					  $t_reg = $reg->total;
			      }
		      }
		?>
          <span class="inscritos2"><?php if($t_reg > 0) {echo '('.$t_reg.')';} ?></span>
        <?php
		  }
        ?>
        </td>
        <?php
						  }
					  }
				  }
			  }
		  }
	  }
	?>
      </tr>
      <?php
  		($i < $filas2->num_rows()-1) ? $i++ : $i = $filas2->num_rows()-1;
	}
  ?>
      <tr>
        <td colspan="<?php echo $columnas->num_rows() + 1; ?>"><span>Clausura<br />18:00 - 18:30</span></td>
      </tr>
    </table>
  </div>
</div>
<div style="clear:both;"></div>
<?php
	echo $toolsPie;
?>
<!--</div>
-->