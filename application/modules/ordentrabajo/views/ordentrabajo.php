<div id="page-wrapper">
	<br>
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
				<a href="<?php echo base_url('ordentrabajo/listar_ot/' . $info[0]['id_equipo']); ?>"class="btn btn-violeta btn-block">
					<i class="fa fa-briefcase"></i> Ordenes de Trabajo
				</a>
				<a href="<?php echo base_url('equipos/diagnostico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tasks"></i> Diagnóstico Periódico
				</a>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDENES DE TRABAJO</strong>
				</div>
				<div class="panel-body">

				<?php 										
					if(!$infoOT){ 
						echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
							</div>';
					}else{
				?>
						<table class="table table-bordered table-striped table-hover table-condensed">
							<tr class="dafault">
	                            <th class='text-center'><small>No. O.T.</small></th>
	                            <th class='text-center'><small>Fecha Asignación</small></th>
	                            <th class='text-center'><small>Asignado a</small></th>
	                            <th class='text-center'><small>Observación</small></th>
	                            <th class='text-center'><small>Última Actualización</small></th>
	                            <th class='text-center'><small>Estado Actual</small></th>
	                            <th class='text-center'><small>Tiempo de Solución</small></th>
	                            <th class="text-center"><small>Costo Mantenimiento</small></th>	
							</tr>

						<?php
							foreach ($infoOT as $data):
	                            echo "<tr>";
	                            echo "<td class='text-center'><small>";
	                    ?>
                                <a href="<?php echo base_url("ordentrabajo/ver_orden/" . $data['id_orden_trabajo']); ?>" class="btn btn-violeta btn-xs"><?php echo $data['id_orden_trabajo']; ?> <i class='fa fa-sign-out fa-fw'></i></a>
	                    <?php
	                          	echo "</small></td>";
	                            echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($data['fecha_asignacion']))) . "</small></td>";
	                            echo "<td ><small>" . $data['encargado'] . "</small></td>";
	                            echo "<td><small>" . $data['observacion'] . "</small></td>";
	                            echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($data['fecha_ultima_actualizacion']))) . "</small></td>";
	                            echo "<td class='text-center'>";
								switch ($data['estado_actual']) {
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
								echo "<td>";
								echo "</td>";
								echo "<td class='text-center'>";
								echo "<small>$" . number_format($data['costo_mantenimiento']) . '<small>';
								echo "</td>";
	                            echo "</tr>";
							endforeach;
						?>
						</table>
				<?php } ?>
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