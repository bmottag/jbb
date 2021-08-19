<div id="page-wrapper">
	<br>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href=" <?php echo base_url('equipos/contratos'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-clock-o"></i> CAMBIOS REALIZADOS AL CONTRATO DE MANTENIMINENTO: 
				</div>
				<div class="panel-body">

				<?php
					if($infoContratosHistorial){
				?>				
					<table class="table table-hover">
						<thead>
							<tr>
                                <th class='text-center'>Fecha cambio</th>
                                <th>Realizado por</th>
								<th>Número Contrato</th>
								<th>Proveedor</th>
								<th class="text-center">Vigencia Desde</th>
								<th class="text-center">Vigencia Hasta</th>
								<th>Supervisor</th>
								<th class="text-right">Valor</th>
								<th class="text-right">Estado</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoContratosHistorial as $lista):
								echo '<tr>';
                                echo '<td class="text-center">' . $lista['fecha_registro'] . '</td>';
                                echo '<td>' . $lista['name'] . '</td>';
								echo "<td>" . $lista['numero_contrato'] . "</td>";
								echo "<td>" . $lista['nombre_proveedor'] . "</td>";
								echo "<td class='text-center'>" . $lista['fecha_desde'] . "</td>";
								echo "<td class='text-center'>" . $lista['fecha_hasta'] . "</td>";
								echo "<td>" . $lista['supervisor'] . "</td>";
								echo "<td class='text-right'>$" . $lista['valor_contrato'] . "</td>";
								echo "<td class='text-center'>";
								switch ($lista['estado_contrato']) {
									case 1:
										$valor = 'En Ejecución';
										$clase = "text-primary";
										break;
									case 2:
										$valor = 'En Ejecución - Prorroga';
										$clase = "text-warning";
										break;
									case 3:
										$valor = 'Finalizado';
										$clase = "text-danger";
										break;
								}
								echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
								echo "</td>";
                                echo '</tr>';
							endforeach;
						?>
						</tbody>
					</table>

				<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"pageLength": 100
	});
});
</script>