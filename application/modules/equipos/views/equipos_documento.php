<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-info").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalDocumento',
				data: {'idEquipo': oID, 'idDocumento': 'x'},
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
				url: base_url + 'equipos/cargarModalDocumento',
				data: {'idEquipo': '', 'idDocumento': oID},
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
						<strong>No. Inventario: </strong><?php echo $info[0]['numero_inventario']; ?>
						<br>
						<strong>Tipo Equipo: </strong><?php echo  $info[0]['tipo_equipo']; ?>
						<?php 
							if($info[0]['horas_kilometros_actuales']){ 
								echo "<br><strong>Kilometos/Horas actuales: </strong>" . $info[0]['horas_kilometros_actuales'];
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
				<a href="<?php echo base_url('equipos/documento/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-block">
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
					<i class="fa fa-book"></i> <strong>DOCUMENTOS DEL EQUIPO</strong>
				</div>
				<div class="panel-body">
				
					<?php if(!$deshabilitar){ ?>
					<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal" id="<?php echo $info[0]['id_equipo']; ?>">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Documento del Equipo
					</button><br>
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
	if(!$listadoDocumentos){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
				<div class="row">
					<div class="col-lg-6">
						<div class="alert alert-danger">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Cuando la fila esta en rojo, es porque el <b>documento esta vencido.</b>
						</div>		
					</div>
					<div class="col-lg-6">
						<div class="alert alert-warning">
							<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
							Cuando la fila esta en amarillo, es porque el <b>Documento tiene menos de 30 días para vencerse.</b>
						</div>		
					</div>
				</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Tipo Documento</th>
								<th class="text-center">Fecha Inicio</th>
								<th class="text-center">Fecha Vencimiento</th>
								<th class="text-center">No. Documento</th>
								<th>Descripción</th>
								<th class="text-center">Usuario</th>
								<?php if(!$deshabilitar){ ?>
								<th class="text-center">Enlaces</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>							
						<?php
							$filtroFecha = strtotime(date('Y-m-d'));
							foreach ($listadoDocumentos as $lista):
									//semaforo de acuerdo a fecha de vencimiento
									$fechaVencimiento = strtotime($lista['fecha_vencimiento']);
									$diferencia = $fechaVencimiento - $filtroFecha;
									//2678400 --> equivalen a 30 dias
									//si la diferencia es mayor a 30 dias no hay problema
									if($diferencia > 2678400){
										$estilosFila = '';
									}elseif($diferencia <= 2678400 && $diferencia >= 0){
										//si la diferencia es entre 0 y 30 dias, entonces se va a vencer pronto
										$estilosFila = 'warning text-warning';
									}else{
										//si la diferencia es menor que 0 entonces esta vencida
										$estilosFila = 'danger text-danger';
									}
									echo "<tr class='$estilosFila'>";
									echo "<td>" . $lista['tipo_documento'] . "</td>";
									echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_inicio'])) . "</td>";
									echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($lista['fecha_vencimiento'])) . "</td>";
									echo "<td class='text-center'>" . $lista['numero_documento'] . "</td>";
									echo "<td>" . $lista['descripcion'] . "</td>";
									echo "<td class='text-center'>" . $lista['name'] . "</td>";

									if(!$deshabilitar){
									echo "<td class='text-center'>";
									
									if($lista['url_documento']){
										$enlace = '../../files/equipos/' . $lista['url_documento'];
										echo "<a href='$enlace' target='_blank'>Ver Documento</a>";
										echo "<br><br>";
									}
						?>

								<a class="btn btn-info btn-xs" href="<?php echo base_url('equipos/documents_form/' . $lista['fk_id_equipo_d'] . '/' . $lista['id_equipo_documento']); ?>">Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
								</a>
								<br><br>

	                            <form  name="formHistorial" id="formHistorial" method="post" action="<?php echo base_url("equipos/historial_documentos"); ?>">
	                                <input type="hidden" class="form-control" id="hddidDocumento" name="hddidDocumento" value="<?php echo $lista['id_equipo_documento']; ?>" />
	                                
	                                <button type="submit" class="btn btn-default btn-xs" id="btnSubmit2" name="btnSubmit2">
	                                    Ver Cambios <span class="fa fa-th-list" aria-hidden="true" />
	                                </button>
	         
	                            </form>

						<?php
									echo "</td>";
									}
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
		
				
<!--INICIO Modal para adicionar POLIZA -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar POLIZA -->

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