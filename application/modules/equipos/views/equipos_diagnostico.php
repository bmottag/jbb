<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-3">
			<!-- IMAGEN DEL EQUIPO -->
			<?php 
				$imagen = FALSE;
				if($fotosEquipos){ 
					$imagen = base_url($fotosEquipos[0]["equipo_foto"]);
				}elseif($info[0]["qr_code_img"]){
					$imagen = base_url($info[0]["qr_code_img"]);
				}
				if($imagen){
			?>
				<div class="form-group">
					<div class="row" align="center">
						<img src="<?php echo $imagen; ?>" class="img-rounded" width="150" height="150" alt="Imagen Equipo" />
					</div>
				</div>
			<?php } ?>
			<!-- FIN IMAGEN DEL EQUIPO -->
			<div class="form-group">
				<div class="row" align="center">
						<strong>No. Inventario: </strong><?php echo $info[0]['numero_inventario']; ?>
						<br>
						<strong>Tipo Equipo: </strong><?php echo  $info[0]['tipo_equipo']; ?>
						<?php 
							if($info[0]['horas_kilometros_actuales']){ 
								echo "<br><strong>Kilometos/Horas actuales: </strong>" . number_format($info[0]['horas_kilometros_actuales']);
							}
						?>
				</div>
			</div>
		
			<div class="list-group">
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa <?php echo $info[0]['icono']; ?>"></i> Información General
				</a>
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tags"></i> Información Específica
				</a>
				<a href="<?php echo base_url('equipos/foto/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-photo"></i> Foto Equipo
				</a>
				<a href="<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-thumb-tack"></i> Localización
				</a>
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tint"></i> Seguimiento Operación
				</a>
				<a href="<?php echo base_url('equipos/documento/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-book"></i> Documentos
				</a>
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
				<a href="<?php echo base_url('mantenimiento/preventivo_equipo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Preventivo
				</a>
				<a href="<?php echo base_url('ordentrabajo/listar_ot/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-briefcase"></i> Ordenes de Trabajo
				</a>
				<a href="<?php echo base_url('equipos/diagnostico/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-default btn-block">
					<i class="fa fa-tasks"></i> Diagnóstico Periódico
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-book"></i> <strong>DIAGNÓSTICO PERIÓDICO DEL EQUIPO</strong>
				</div>
				<div class="panel-body">
				
					<?php if(!$deshabilitar){ ?>
					<a href="<?php echo base_url('inspection/set_vehicle/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-block">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Diagnóstico Periódico
					</a><br>
					<?php } ?>

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