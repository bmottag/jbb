<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalContratos',
                data: {'idContrato': oID},
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
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-truck fa-fw"></i> EQUIPOS - CONTRATOS MANTENIMIENTO
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-book"></i> LISTA CONTRATOS DE MANTENIMIENTO
				</div>
				<div class="panel-body">
					<ul class="nav nav-pills">
						<li <?php if($estado == 1){ echo "class='active'";} ?>><a href="<?php echo base_url("contratos/contratos/1"); ?>">Contratos en Ejecución</a>
						</li>
						<li <?php if($estado == 2){ echo "class='active'";} ?>><a href="<?php echo base_url("equipos/contratos/3"); ?>">Contratos Finalizados</a>
						</li>
					</ul>
					<br>

					<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Contrato de Mantenimiento
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
					if($info){
				?>			
					<p class="text-danger"><strong>Nota:</strong><br> Cuando la fila esta en rojo, es porque el documento esta vencido.</p>
					<p class="text-warning"> Cuando la fila esta en amarillo, es porque el documento tiene menos de 30 días para vencerse.</p>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Número Contrato</th>
								<th>Proveedor</th>
								<th class="text-center">Vigencia Desde</th>
								<th class="text-center">Vigencia Hasta</th>
								<th>Supervisor</th>
								<th class="text-right">Valor</th>
								<th class="text-right">Saldo</th>
								<th class="text-center"></th>
							</tr>
						</thead>
						<tbody>							
						<?php
							$filtroFecha = strtotime(date('Y-m-d'));
							foreach ($info as $lista):
									//semaforo de acuerdo a fecha de vencimiento
									$fechaVencimiento = strtotime($lista['fecha_hasta']);
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
									echo "<td>" . $lista['numero_contrato'] . "</td>";
									echo "<td>" . $lista['nombre_proveedor'] . "</td>";
									echo "<td class='text-center'>" . $lista['fecha_desde'] . "</td>";
									echo "<td class='text-center'>" . $lista['fecha_hasta'] . "</td>";
									echo "<td>" . $lista['name'] . "</td>";
									echo "<td class='text-right'>$" . $lista['valor_contrato'] . "</td>";
									echo "<td class='text-right'>$" . $lista['saldo_contrato'] . "</td>";
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_contrato_mantenimiento']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>

								<br><br>

	                            <form  name="formHistorial" id="formHistorial" method="post" action="<?php echo base_url("equipos/historial_contratos"); ?>">
	                                <input type="hidden" class="form-control" id="hddidContrato" name="hddidContrato" value="<?php echo $lista['id_contrato_mantenimiento']; ?>" />
	                                
	                                <button type="submit" class="btn btn-default btn-xs" id="btnSubmit2" name="btnSubmit2">
	                                    Ver Cambios <span class="fa fa-th-list" aria-hidden="true" />
	                                </button>
	         
	                            </form>
						<?php
									switch ($lista['estado_contrato']) {
										case 1:
											echo '<small><strong>En Ejecución</strong></small>';
											break;
										case 2:
											echo '<small><strong>En Ejecución - Prorroga</strong></small>';
											break;
										case 3:
											echo '<small><strong>Finalizado</strong></small>';
											break;
									}
									echo "</td>";
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
		"pageLength": 100
	});
});
</script>