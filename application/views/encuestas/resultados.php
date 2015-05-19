<style type="text/css">
	table {
		width: 310px;
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
	h3 {
		clear: both;
	}
</style>
<?php
	echo $tools;
?>
<h3>Encuestas respondidas: <?php echo $totalRespondidas; ?></h3>
<?php
	foreach($preguntas as $pregunta) {
		foreach($respuestas as $key => $respuesta) {
			if($pregunta->id_pregunta == $key) {
				echo '<h3>'.$pregunta->pregunta.'</h3>';
				?>
				<table <?php if($pregunta->tipo == 'rate5') {echo 'style="float: left;"'; }?>>
				  <tr>
					<th>Respuesta</th>
					<th>Total</th>
                    <?php
						if($pregunta->tipo == 'rate5') {
					?>
                    <th>Interpretación</th>
                    <?php
						}
					?>
				  </tr>
				<?php
				foreach($respuesta as $k => $v) {
				?>
				  <tr>
					<td><?php echo ucfirst($k); ?></td>
					<td><?php echo $v; ?></td>
                    <?php
						if($pregunta->tipo == 'rate5') {
							$calificacion = "";
							if($v < 2) {
								$calificacion = "Muy malo";
							} else if($v >= 2 && $v < 3) {
								$calificacion = "Malo";
							} else if($v >= 3 && $v < 4) {
								$calificacion = "Regular";
							} else if($v >= 4 && $v < 5) {
								$calificacion = "Bueno";
							} else if($v >= 5) {
								$calificacion = "Excelente";
							}
					?>
                    <td><?php echo $calificacion; ?></td>
                    <?php
						}
					?>
				  </tr>
				<?php
				}
				?>
                </table>
                <?php
					if($pregunta->tipo == 'rate5') {
				?>
                	<table style="float: left; margin-left: 25px;">
                      <tr>
                        <th>Calificación</th>
                        <th>Interpretación</th>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Excelente</td>
                      </tr>
                      <tr>
                        <td>4 - 4.99</td>
                        <td>Bueno</td>
                      </tr>
                      <tr>
                        <td>3 - 3.99</td>
                        <td>Regular</td>
                      </tr>
                      <tr>
                        <td>2 - 2.99</td>
                        <td>Malo</td>
                      </tr>
                      <tr>
                        <td>1 - 1.99</td>
                        <td>Muy malo</td>
                      </tr>
                    </table>
                <?php
					}
			}
		}
	}
?>
<?php
	echo $toolsPie;
?>
