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
					<i class="fa fa-book"></i> <strong>DIAGNÓSTICO PERIÓDICO DEL EQUIPO</strong>
					<?php if(!$deshabilitar){ ?>
					<div class="pull-right">
						<div class="btn-group">
							<a href="<?php echo base_url('inspection/set_vehicle/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-xs">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Diagnóstico Periódico
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
	if(!$listadoDiagnostico){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Fecha Registro</th>
								<th class="text-center">Responsable</th>
								<th class="text-center">Horas o Kilometros actuales</th>
								<th class="text-center">Comentarios</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoDiagnostico as $lista):
									echo "<tr>";
									echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_registro'])) . "</td>";
									echo "<td class='text-center'>" . $lista['name'] . "</td>";
									echo "<td class='text-right'>" . $lista['horas_actuales_vehiculo'] . "</td>";
									echo "<td>" . $lista['comments'] . "</td>";
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