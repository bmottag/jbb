<script>
$(function(){ 
	$(".btn-info").click(function () {	
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
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-block">
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
				<a href="<?php echo base_url('equipos/diagnostico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tasks"></i> Diagnóstico Periódico
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-tint"></i> <strong>SEGUIMIENTO DE OPERACIÓN DE EQUIPO</strong>
				</div>
				<div class="panel-body">
				
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Seguimiento de Operación
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
	if(!$listadoControlCombustible){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center"><small>Fecha</small></th>
								<th class="text-center"><small>Horas o Kilometros Actuales</small></th>
								<th class="text-center"><small>Operador</small></th>
								<th class="text-center"><small>Tipo de Consumo</small></th>
								<th class="text-center"><small>Cantidad</small></th>
								<th class="text-center"><small>Lugar</small></th>
								<th class="text-center"><small>Valor X Galón</small></th>
								<th class="text-center"><small>Valor Total</small></th>
								<th class="text-center"><small>Labor Realizada</small></th>
								<th class="text-center"><small>Editar</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listadoControlCombustible as $lista):
									echo "<tr>";
									echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G",strtotime($lista['fecha_combustible']))) . "</small></td>";
									echo "<td class='text-right'><small>" . number_format($lista['kilometros_actuales']) . "</small></td>";
									echo "<td><small>" . $lista['name'] . "</small></td>";
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
									echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
									echo "</td>";

									echo "<td><small>" . $lista['cantidad'] . "</small></td>";
									echo "<td><small>" . $lista['lugar'] . "</small></td>";
									echo "<td class='text-right'><small>$" . number_format($lista['valor_x_galon'], 2) . "</small></td>";
									echo "<td class='text-right'><small>$" . number_format($lista['valor_total'], 2) . "</small></td>";
									echo "<td><small>" . $lista['labor_realizada'] . "</small></td>";
									
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