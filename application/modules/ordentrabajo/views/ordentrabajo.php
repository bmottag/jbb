<script>
$(function(){
	$(".btn-violeta").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'ordentrabajo/cargarModalEstadoOrdenTrabajo',
			data: {'idOrdenTrabajo': oID},
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
	});
});
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">	
		<div class="col-lg-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-automobile"></i> <strong>INFORMACIÓN DEL EQUIPO</strong>
				</div>
				<div class="panel-body">

					<?php if($fotosEquipos){ ?>
						<div class="form-group">
							<div class="row" align="center">
								<img src="<?php echo base_url($fotosEquipos[0]["equipo_foto"]); ?>" class="img-rounded" width="150" height="150" alt="Photo" />
							</div>
						</div>
					<?php } ?>
				
					<strong>No. Inventario Entidad: </strong><?php echo $infoEquipo[0]['numero_inventario']; ?><br>
					<strong>Marca: </strong><?php echo $infoEquipo[0]['marca']; ?><br>
					<strong>Modelo: </strong><?php echo $infoEquipo[0]['modelo']; ?><br>
					<strong>No. Serial: </strong><?php echo $infoEquipo[0]['numero_serial']; ?><br>
					<strong>Tipo Equipo: </strong><?php echo $infoEquipo[0]['tipo_equipo']; ?>					
					
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<i class="fa fa-wrench"></i> <strong>INFORMACIÓN DEL MANTENIMIENTO</strong>
				</div>
				<div class="panel-body">
					<?php 
						if($information[0]['tipo_mantenimiento'] == 1){
					?>
					<strong>Fecha Registro: </strong><?php echo $infoMantenimiento[0]['fecha']; ?><br>
					<strong>Descripción Falla: </strong><br><?php echo $infoMantenimiento[0]['descripcion']; ?><br>
					<strong>Consideración: </strong><br><?php echo $infoMantenimiento[0]['consideracion']; ?><br>
					<strong>Tipo de Mantenimiento: </strong>Correctivo
					<?php 
						}else{
					?>
					<strong>Descripción: </strong><br><?php echo $infoMantenimiento[0]['descripcion']; ?><br>
					<strong>Tipo de Mantenimiento: </strong>Preventivo
					<?php
						}
					?>
					
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-wrench"></i> <strong>INFORMACIÓN ORDEN DE TRABAJO</strong>
				</div>
				<div class="panel-body">

					<strong>No. OT: </strong><?php echo $information[0]['id_orden_trabajo']; ?><br>
					<strong>Encargado: </strong><?php echo $information[0]['encargado']; ?><br>
					<strong>Estado Actual: </strong>
					<?php
					switch ($information[0]['estado_actual']) {
						case 1:
							$valor = 'Asignada';
							$clase = "text-info";
							break;
						case 2:
							$valor = 'Solucionado';
							$clase = "text-success";
							break;
						case 3:
							$valor = 'Cancelado';
							$clase = "text-danger";
							break;
					}
					echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
					?>
				</div>
			</div>
		</div>
					
	</div>	

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-wrench"></i> HISTORIAL ORDEN DE TRABAJO <strong>No. <?php echo $information[0]["id_orden_trabajo"]; ?></strong>
				</div>
				<div class="panel-body">
				
					<button type="button" class="btn btn-violeta btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $information[0]['id_orden_trabajo']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Información
					</button><br>
					
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
	if(!$infoEstado){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Fecha Registro</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Información Adicional</th>
								<th class="text-center">Estado</th>								
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoEstado as $lista):
									echo "<tr>";
									echo "<td class='text-center'>" . $lista['fecha_registro_estado'] . "</td>";
									echo "<td>" . $lista['name'] . "</td>";
									echo "<td>" . $lista['informacion_adicional_estado'] . "</td>";
									echo "<td class='text-center'>";
									switch ($lista['estado']) {
										case 1:
											$valor = 'Asignada';
											$clase = "text-info";
											break;
										case 2:
											$valor = 'Solucionado';
											$clase = "text-success";
											break;
										case 3:
											$valor = 'Cancelado';
											$clase = "text-danger";
											break;
									}
									echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
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

<!--INICIO Modal para adicionar ESTADO -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar ESTADO -->

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