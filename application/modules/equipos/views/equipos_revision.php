<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/inspeccion_vehiculos.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<!-- Start of menu -->
		<?php
			$this->load->view('menu_equipos');
		?>
		<!-- End of menu -->
		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-book"></i> <strong>CHEQUEO PREOPERACIONAL DIARIO</strong>
					<?php if(!$deshabilitar){ ?>
					<div class="pull-right">
						<div class="btn-group">
							<a href="<?php echo base_url('external/add_vehiculos_inspection/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-xs">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Chequeo Preoperacional
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="panel-body">
				
<?php
	$retornoExito = $this->session->flashdata('retornoExito');
	if ($retornoExito) {
?>
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
<?php
	}
	$retornoError = $this->session->flashdata('retornoError');
	if ($retornoError) {
?>
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
<?php
	}
?> 

<?php 										
	if(!$listadoRevision){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table width="100%" class="table table-striped table-bordered table-hover small" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Fecha Registro</th>
								<th class="text-center">Operador/Conductor</th>
								<th class="text-center">Dependencia</th>
								<th class="text-center">Vehículo Activo</th>
								<th class="text-center">Enlaces</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoRevision as $lista):
									echo "<tr>";
									echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_registro'])) . "</td>";
									echo "<td class='text-center'>" . $lista['name'] . "</td>";
									echo "<td class='text-center'>" . $lista['dependencia'] . "</td>";
									echo "<td class='text-center'>";
									if($lista['activo'] == 1){
										echo "Si";
									}else{
										echo "No";
									}
									echo "</td>";
									echo "<td class='text-center'>";
						?>
									<a title="Descargar Chequeo Preoperacional - FIS.PR.06.F.13" href="<?php echo base_url("reportes/inspecciones/". $lista['id_inspection_vehiculos']); ?>" class="btn btn-info btn-xs" target="_blank"> <span class="fa fa-file-pdf-o" aria-hidden="true" /></a>

									<button type="button" id="<?php echo $lista['id_inspection_vehiculos']; ?>" class='btn btn-danger btn-xs' title="Eliminar Chequeo Preoperacional">
											<i class="fa fa-trash-o"></i>
									</button>
						<?php
									echo "</td>";
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
		
<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true,
		 "ordering": false,
		 paging: false,
		"searching": false,
		"info": false
    });
});
</script>