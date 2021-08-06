<div id="page-wrapper">
	<br>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a class="btn btn-primary btn-xs" href=" <?php echo base_url('equipos/documento/' . $infoDocumento[0]['fk_id_equipo_d']); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-clock-o"></i> CAMBIOS REALIZADOS AL DOCUMENTO: 
				</div>
				<div class="panel-body">

				<?php
					if($infoDocumentoHistorial){
				?>				
					<table class="table table-hover">
						<thead>
							<tr>
                                <th class='text-center'>Fecha cambio</th>
                                <th>Realizado por</th>
                                <th>Tipo Documento</th>
								<th class="text-center">Fecha Inicio</th>
								<th class="text-center">Fecha Vencimiento</th>
								<th class="text-center">No. Documento</th>
								<th>Descripción</th>
                                <th>URL</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoDocumentoHistorial as $lista):
								echo '<tr>';
                                echo '<td class="text-center">' . $lista['fecha_registro'] . '</td>';
                                echo '<td>' . $lista['name'] . '</td>';
                                echo '<td>' . $lista['tipo_documento'] . '</td>';
								echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_inicio'])) . "</td>";
								echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_vencimiento'])) . "</td>";
                                echo "<td class='text-center'>" . $lista['numero_documento'] . "</td>";
                                echo '<td>' . $lista['descripcion'] . '</td>';
                                echo '<td>';
								if($lista['url_documento']){
									$enlace = '../files/equipos/' . $lista['url_documento'];
									echo "<a href='$enlace' target='_blank'>Ver Documento</a>";
								}else{
									echo "---";
								}
                                echo  '</td>';
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