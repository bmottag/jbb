<script>
$(function(){ 
	$(".btn-primary").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalCombustible',
				data: {'idEquipo': oID, 'idControlCombustible': 'x'},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	

	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalCombustible',
				data: {'idEquipo': '', 'idControlCombustible': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>


<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-3">
		
			<?php if($info[0]["qr_code_img"]){ ?>
				<div class="form-group">
					<div class="row" align="center">
						<img src="<?php echo base_url($info[0]["qr_code_img"]); ?>" class="img-rounded" width="150" height="150" alt="QR CODE" />
					</div>
				</div>
			<?php } ?>

			<div class="form-group">
				<div class="row" align="center">
						<?php echo '<strong>No. Inventario:</strong> ' . $info[0]['numero_inventario']; ?>
				</div>
			</div>
		
			<div class="list-group">
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tag"></i> Información General
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
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-primary btn-block">
					<i class="fa fa-tint"></i> Seguimiento Operación
				</a>
				<a href="<?php echo base_url('equipos/poliza/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-book"></i> Pólizas
				</a>
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
				<a href="<?php echo base_url('inspection/set_vehicle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-book"></i> Diagnóstico Periódico
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-tint"></i> SEGUIMIENTO DE OPERACIÓN DE EQUIPO
				</div>
				<div class="panel-body">
				
					<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Seguimiento
					</button><br>

					
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
	if(!$listadoControlCombustible){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Fecha</th>
								<th class="text-center">Horas o Kilometros Actuales</th>
								<th class="text-center">Operador</th>
								<th class="text-center">Tipo de Consumo</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Valor</th>
								<th class="text-center">Labor Realizada</th>
								<th class="text-center">Editar</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoControlCombustible as $lista):
									echo "<tr>";
									echo "<td class='text-center'>" . $lista['fecha_combustible'] . "</td>";
									echo "<td class='text-right'>" . number_format($lista['kilometros_actuales']) . "</td>";
									echo "<td>" . $lista['name'] . "</td>";
									echo "<td class='text-center'>";
									switch ($lista['tipo_consumo']) {
										case 1:
											$valor = 'Combustible';
											$clase = "text-danger";
											break;
										case 2:
											$valor = 'Grasa';
											$clase = "text-success";
											break;
										case 3:
											$valor = 'Aceite Transmisión';
											$clase = "text-warning";
											break;
										case 4:
											$valor = 'Aceite Hidráulico';
											$clase = "text-primary";
											break;
										case 5:
											$valor = 'Aceite Motor';
											$clase = "text-violeta";
											break;
									}
									echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
									echo "</td>";

									echo "<td>" . $lista['cantidad'] . "</td>";
									echo "<td class='text-right'>$" . number_format($lista['valor'], 2) . "</td>";
									echo "<td>" . $lista['labor_realizada'] . "</td>";
									
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo_control_combustible']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
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
		 "ordering": false,
		 paging: false,
		"searching": false,
		"info": false
    });
});
</script>