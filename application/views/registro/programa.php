<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery-ui.min.js"></script>
<script type="text/javascript">
	function compararHorarios(hi1, hf1, hi2, hf2) {
		var chocan = false;
		hi1 = parseInt(hi1);
		hf1 = parseInt(hf1);
		hi2 = parseInt(hi2);
		hf2 = parseInt(hf2);
		
		if(hi1 == hi2 || hf1 == hf2) {
			chocan = true;
		}
		
		if(hi1 < hf2 && hf1 > hi2) {			
			if(hi1 < hi2) {
				if(hf1 < hf2 || hf1 > hf2) {
					chocan = true;
				}
			}
			
			if(hi1 > hi2) {
				if(hf1 > hf2 || hf1 < hf2) {
					chocan = true;
				}
			}
		}
		
		return chocan;
	}
	
	function bloquearCheck(chk) {
		$("." + clase).each(function() {
			$(this).prop("disabled", false);
		});
		var clase = chk.attr('class');
		var seleccionados = [];
		var desactivados = []
		$("." + clase).each(function() {
			if($(this).is(":checked")) {
				seleccionados.push($(this));
			}
		});
		
		if(seleccionados.length > 0) {
			for(var i=0; i<seleccionados.length; i++) {
				$("." + clase).each(function() {
					if($(this).val() != seleccionados[i].val()) {
						if(compararHorarios($(this).data('inicio'), $(this).data('fin'), seleccionados[i].data('inicio'), seleccionados[i].data('fin'))) {
							desactivados.push($(this));
							$(this).prop("disabled", true);
						} else {
							$(this).prop("disabled", false);
						}
					}
				});
			}
		} else {
			$("." + clase).each(function() {
				$(this).prop("disabled", false);
			});
		}
		
		for(var i=0; i<desactivados.length; i++) {
			$("." + clase).each(function() {
				if($(this).val() == desactivados[i].val()) {
					$(this).prop("disabled", true);
				}
			});
		}
	}
	
	$(function() {
		$("#tabs").tabs();
		
		$(".dia1").each(function() {
			var actual = $(this);
			actual.change(function() {
				bloquearCheck(actual);
				var seleccionados1 = $(".dia1:checked").length;
				if(seleccionados1 > 1) {
					$(".dia1:checked").each(function() {
						if($(this).val() != actual.val()) {
							var inicio = $(this).data('inicio');
							var fin = $(this).data('fin');
							
							if(compararHorarios(inicio, fin, actual.data('inicio'), actual.data('fin'))) {
								if(confirm("Estos horarios se traslapan, ¿estás seguro?")) {
									$(this).prop("checked", false);
									actual.prop("disabled", false);
									bloquearCheck(actual);
								} else {
									actual.prop("checked", false);
									$(this).prop("disabled", false);
									bloquearCheck($(this));
								}
							}
						}
					});
				}
			});
		});
		
		$(".dia2").each(function() {
			var actual = $(this);
			actual.change(function() {
				bloquearCheck(actual);
				var seleccionados1 = $(".dia2:checked").length;
				if(seleccionados1 > 1) {
					$(".dia2:checked").each(function() {
						if($(this).val() != actual.val() && $(this).data('salon') != actual.data('salon')) {
							var inicio = $(this).data('inicio');
							var fin = $(this).data('fin');
							
							if(compararHorarios(inicio, fin, actual.data('inicio'), actual.data('fin'))) {
								if(confirm("Estos horarios se traslapan, ¿estás seguro?")) {
									$(this).prop("checked", false);
									actual.prop("disabled", false);
									bloquearCheck(actual);
								} else {
									actual.prop("checked", false);
									$(this).prop("disabled", false);
									bloquearCheck($(this));
								}
							}
						}
					});
				}
			});
		});
		
		$("td div").click(function() {
			var chk = $(this).next();
			if(chk.is(":checked")) {
				chk.prop("checked", false);
			} else {
				chk.prop("checked", true);
			}
			chk.trigger("change");
		});
	});
</script>
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
	
	/*.ui-tabs-nav {
		margin: 0;
		padding: 0;
		list-style: none outside none;
	}
	.ui-tabs-nav li {
		display: inline;
	}*/
	.ui-widget {
		font-family: inherit !important;
		font-size: inherit !important;
	}
</style>
<p>Programa de actividades</p>
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
        <td><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" /><?php } echo $evento->evento;?><?php if($evento->descripcion) {echo "<br/>".$evento->descripcion;}?></td>
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
        <td><div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia1" /><span><strong><?php echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
        <?php
				  }
				  for($j=0; $j<=3; $j++) {
					  if(isset($filas1->result()[$i+$j]->fin)) {
						  if($evento->fin == $filas1->result()[$i+$j]->fin && $fila->fin != $filas1->result()[$i+$j]->fin) {
			?>
        <td rowspan="<?php echo $rowspan; ?>"><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia1" /><span><strong><?php } echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
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
        <td colspan="<?php echo $columnas->num_rows() + 1; ?>">Fin de la jornada</td>
      </tr>
    </table>
    <p>&nbsp;</p>
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
      <td><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" /><?php } echo $evento->evento;?>
        <?php if($evento->descripcion) {echo "<br/>".$evento->descripcion;}?></td>
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
        <td><div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia2" /><span><strong><?php echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
        <?php
				  }
				  for($j=0; $j<=3; $j++) {
					  if(isset($filas2->result()[$i+$j]->fin)) {
						  if($evento->fin == $filas2->result()[$i+$j]->fin && $fila->fin != $filas2->result()[$i+$j]->fin) {
			?>
        <td rowspan="<?php echo $rowspan; ?>"><?php if($evento->tipo_evento == 1 || $evento->tipo_evento == 2) { ?><div></div><input name="id_evento[]" type="checkbox" value="<?php echo $evento->id_evento; ?>" data-inicio="<?php echo str_replace(":", "", $evento->inicio); ?>" data-fin="<?php echo str_replace(":", "", $evento->fin); ?>" data-salon="<?php echo $evento->ubicacion_evento; ?>" class="dia2" /><span><strong><?php } echo $evento->evento; ?></strong></span><span><?php if($evento->descripcion){echo "<br />".$evento->descripcion;} ?></span></td>
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
        <td colspan="<?php echo $columnas->num_rows() + 1; ?>">Clausura<br />18:00 - 18:30</td>
      </tr>
    </table>
  </div>
</div>
