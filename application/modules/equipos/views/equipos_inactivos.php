<div id="page-wrapper">
	<br>		
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-danger">
				<div class="panel-heading">	
					<i class="fa fa-truck"></i> EQUIPOS INACTIVOS
				</div>
				<div class="panel-body">	
				
<br>


<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
	</div>
    <?php
}
?> 

<?php 										
	if(!$info){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
			
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>							
								<th class="text-center">No. Inventario Entidad</th>
								<th class="text-center">Dependencia</th>
								<th class="text-center">Marca</th>
								<th class="text-center">Modelo</th>
								<th class="text-center">Número Serial</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Observación</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
							
									echo "<tr>";
									echo "<td class='text-center'>" . $lista['numero_inventario'];
									
									if(!$deshabilitar){
						?>			<br>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
						<?php
									}
									echo "</td>";

									echo "<td class='text-center'>" . $lista['dependencia'] . "</td>";
									echo "<td>" . $lista['marca'] . "</td>";
									echo "<td>" . $lista['modelo'] . "</td>";
									echo "<td class='text-center'>" . $lista['numero_serial'] . "</td>";
									echo "<td class='text-center'>";
									switch ($lista['estado_equipo']) {
										case 1:
											$valor = 'Activo';
											$clase = "text-success";
											break;
										case 2:
											$valor = 'Inactivo';
											$clase = "text-danger";
											break;
									}
									echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
									echo "</td>";
									echo "<td>" . $lista['observacion'] . "</td>";
									
									echo "</tr>";

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
		paging: false,
		"searching": false,
		"pageLength": 25
	});
});
</script>