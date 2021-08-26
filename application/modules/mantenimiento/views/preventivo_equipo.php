<script>
$(function(){
	$(".btn-violeta").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'ordentrabajo/cargarModalOrdenTrabajo',
			data: {'idCompuesto': oID, 'tipoMantenimiento': 2},
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
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
				<a href="<?php echo base_url('mantenimiento/preventivo_equipo/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-block">
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
					<i class="fa fa-wrench"></i> <strong>MANTENIMIENTOS PREVENTIVOS DEL EQUIPO</strong>
				</div>
				<div class="panel-body">
					<!-- boton para cargue de mantenimiento desde la plantilla -->
					<a class='btn btn-info btn-block' href='<?php echo base_url('mantenimiento/add_mantenimiento_preventivo/' . $info[0]['id_equipo'] . '/' . $info[0]['fk_id_tipo_equipo']) ?>'>
							<span class="glyphicon glyphicon-plus" aria-hidden="true"> </span>  Adicionar Mantinimientos Preventivos
					</a>
					<br>

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
						if(!$infoPreventivo){ 
							echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
								</div>';
						} else {
					?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center"><small>Descripción</small></th>
								<th class="text-center"><small>Frecuencia Km/Horas</small></th>
								<th class="text-center"><small>Próximo Mantenimiento Km/Horas</small></th>
								<th class="text-center"><small>Orden Trabajo</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPreventivo as $lista):
								echo "<tr>";
								echo "<td><small>" . $lista['descripcion'] . "</small></td>";
								echo "<td class='text-right'><small>" . number_format($lista['frecuencia']) . "</small></td>";
								echo "<td class='text-right'><small>" . number_format($lista['proximo_mantemiento_kilometros_horas']) . "</small></td>";
								echo "<td class='text-center'>";
								$idCompuesto = $lista['id_preventivo_equipo'] . '-' . $info[0]['id_equipo'];
								?>
								<button type="button" class="btn btn-violeta btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $idCompuesto; ?>" >
									Crear O.T. <span class="glyphicon glyphicon-briefcase" aria-hidden="true">
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
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-briefcase"></i> <strong>ORDENES DE TRABAJO</strong>
				</div>
				<div class="panel-body">

					<?php 										
						if(!$infoOrdenesTrabajo){ 
							echo '<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
								</div>';
						} else {
					?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
                                <th class='text-center'><small>No. O.T.</small></th>
                                <th class='text-center'><small>Fecha Asignación</small></th>
                                <th class='text-center'><small>Asignado a</small></th>
                                <th class='text-center'><small>Estado</small></th>
                                <th class='text-center'><small>Información Adicional</small></th>
                                <th class='text-center'><small>Ver</small></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoOrdenesTrabajo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'><small>" . $lista['id_orden_trabajo'] . "</small></td>";
                                echo "<td class='text-center'><small>" . ucfirst(strftime("%b %d, %G %H:%M",strtotime($lista['fecha_asignacion']))) . "</small></td>";
                                echo "<td ><small>" . $lista['encargado'] . "</small></td>";
                                echo "<td class='text-center'>";
								switch ($lista['estado_actual']) {
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
								echo '<small><p class="' . $clase . '"><strong>' . $valor . '</small></strong></p>';
                                echo "</td>";
                                echo "<td><small>" . $lista['informacion_adicional'] . "</small></td>";
                                echo "<td class='text-center'>";
                                ?>
                                <a href="<?php echo base_url("ordentrabajo/ver_orden/" . $lista['id_orden_trabajo']); ?>" class="btn btn-success btn-xs">Ver O.T. <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
							endforeach;
						?>
						</tbody>
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