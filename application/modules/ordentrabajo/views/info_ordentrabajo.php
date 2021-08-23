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

<div id="page-wrapper">
	<br>
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
						<strong>No. Inventario: </strong><?php echo $info[0]['numero_inventario']; ?>
						<br>
						<strong>Tipo Equipo: </strong><?php echo  $info[0]['tipo_equipo']; ?>
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
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
				<a href="<?php echo base_url('mantenimiento/preventivo_equipo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Preventivo
				</a>
				<a href="<?php echo base_url('equipos/diagnostico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tasks"></i> Diagnóstico Periódico
				</a>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDEN DE TRABAJO</strong>
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

					<table class="table table-bordered table-striped table-hover table-condensed">
						<tr>
							<th colspan="5">Información del mantenimiento solicitado</th>
						</tr>
						<tr class="dafault">
							<th class="text-center"><small>Fecha Solicitud</small></th>
							<th class="text-center"><small>Descripción Falla</small></th>
							<th class="text-center"><small>Consideración o Requerimiento</small></th>
							<th class="text-center"><small>Solicitante</small></th>
							<th class="text-center"><small>Tipo de Mantenimiento</small></th>
						</tr>
						<?php
							foreach ($infoMantenimiento as $data):
								echo "<tr>";					
								echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($data['fecha']))) . "</small></td>";
								echo "<td><small>" . $data['descripcion'] . "</small></td>";
								echo "<td><small>" . $data['consideracion'] . "</small></td>";
								echo "<td><small>" . $data['name'] . "</small></td>";
								echo "<td><small>";
								if($information[0]['tipo_mantenimiento'] == 1){
									echo 'Correctivo';
								}else{
									echo 'Preventivo';
								}
								echo "</small></td>";
								echo "</tr>";
							endforeach;
						?>
					</table>

					<?php
						if($information[0]['usar_contrato']){
					?>

							<div class="alert alert-danger">
								<span class="fa fa-info-circle" aria-hidden="true"></span>
								<strong>Nota:</strong> Para esta O.T. se hace uso del contrato de mantenimiento.<br>
								<strong>No. Contrato Mantenimiento:</strong> <?php echo $info[0]['numero_contrato']; ?>
							</div>
					<?php
						}
					?>

					<table class="table table-bordered table-striped table-hover table-condensed">
						<tr>
							<th colspan="5">Información Orden de Trabajo</th>
						</tr>
						<tr class="dafault">
                            <th class='text-center'><small>No. O.T.</small></th>
                            <th class='text-center'><small>Fecha Asignación</small></th>
                            <th class='text-center'><small>Asignado a</small></th>
                            <th class='text-center'><small>Observación</small></th>
                            <th class='text-center'><small>Última Actualización</small></th>
                            <th class='text-center'><small>Estado Actual</small></th>
						</tr>
						<?php
							foreach ($information as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'><small>" . $lista['id_orden_trabajo'] . "</small></td>";
                                echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_asignacion']))) . "</small></td>";
                                echo "<td ><small>" . $lista['encargado'] . "</small></td>";
                                echo "<td><small>" . $lista['observacion'] . "</small></td>";
                                echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_ultima_actualizacion']))) . "</small></td>";
                                echo "<td class='text-center'>";
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
								echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
								echo "</td>";
                                echo "</tr>";
                            endforeach;
						?>
					</table>

					<button type="button" class="btn btn-violeta btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $information[0]['id_orden_trabajo']; ?>" <?php echo $deshabilitar; ?>>
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Información
					</button><br>

					<table class="table table-bordered table-striped table-hover table-condensed">
						<thead>
							<tr>
								<th colspan="4">Histórico</th>
							</tr>
							<tr>
								<th class="text-center"><small>Fecha Registro</small></th>
								<th class="text-center"><small>Registrado por</small></th>
								<th class="text-center"><small>Información Adicional</small></th>
								<th class="text-center"><small>Estado</small></th>								
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoEstado as $lista):
									echo "<tr>";
									echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_registro_estado']))) . "</small></td>";
									echo "<td><small>" . $lista['name'] . "</small></td>";
									echo "<td><small>" . $lista['informacion_adicional_estado'] . "</small></td>";
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
									echo '<small><p class="' . $clase . '"><strong>' . $valor . '</strong></p></small>';
									echo "</td>";
									echo "</tr>";
							endforeach;
						?>
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">
		</div>
	</div>
</div>
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