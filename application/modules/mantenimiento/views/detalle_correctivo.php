<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/correctivo.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-3">
			<?php
				if($info[0]["foto_equipo"]) {
					$URLimagen = base_url($info[0]["foto_equipo"]);
				} else {
					$URLimagen = base_url('images/avatar.png');
				}
			?>
			<div class="form-group">
				<div class="row" align="center">
					<img src="<?php echo $URLimagen; ?>" class="img-rounded" alt="Foto Equipo" width="200" height="200" />
				</div>
			</div>
			<div class="form-group">
				<strong>Número Inventario Entidad:</strong>
				<span><?php echo $info?$info[0]["numero_inventario"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Dependencia:</strong>
				<span><?php echo $info?$info[0]["dependencia"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Marca:</strong>
				<span><?php echo $info?$info[0]["marca"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Modelo:</strong>
				<span><?php echo $info?$info[0]["modelo"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Número Serial:</strong>
				<span><?php echo $info?$info[0]["numero_serial"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Tipo Equipo:</strong>
				<span><?php echo $info?$info[0]["tipo_equipo"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Valor Comercial:</strong>
				<span><?php echo $info?$info[0]["valor_comercial"]:""; ?></span>
			</div>
			<div class="form-group">
				<strong>Fecha Adquisición:</strong>
				<span><?php echo $info?$info[0]["fecha_adquisicion"]:""; ?></span>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-tag"></i> <strong>FORMULARIO DE MANTENIMIENTOS CORRECTIVOS</strong>
				</div>
				<div class="panel-body">
					<form  name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<script>
							$( function() {
								$( "#fecha_inicio" ).datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat: 'yy-mm-dd'
								});
							});
						</script>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="fecha_inicio">Fecha de Inicio: *</label>
								<input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control" value="" placeholder="Fecha de Inicio" >
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label for="descripcion">Descripción: *</label>
								<textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:80%;" align="center">
									<div id="div_load" style="display:none">		
										<div class="progress progress-striped active">
											<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
												<span class="sr-only">45% completado</span>
											</div>
										</div>
									</div>
									<div id="div_error" style="display:none">			
										<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
									</div>
								</div>
							</div>
						</div>	
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:100%;" align="center">							
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-info'>
										Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
				<i class="fa fa-truck"></i> <?php echo $tituloListado; ?>
				</div>
				<div class="panel-body">	
				<br>
				<?php 										
					if(!$infoCorrectivo){ 
						echo '<div class="col-lg-12">
						<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
						</div>';
					} else {
				?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Id Mantenimiento</th>
								<th class="text-center">Fecha Inicio</th>
								<th class="text-center">No. Inventario Entidad</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Descripción</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoCorrectivo as $lista):
								echo "<tr>";
								echo "<td class='text-center'>" . $lista['id_correctivo'] . "</td>";
								echo "<td>" . $lista['fecha_inicio'] . "</td>";
								echo "<td>" . $lista['numero_inventario'] . "</td>";
								echo "<td class='text-center'>";
								switch ($lista['estado']) {
									case 1:
										$valor = 'Activo';
										$clase = "text-success";
										break;
									case 2:
										$valor = 'Inactivo';
										$clase = "text-danger";
										break;
								}
								echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
								echo "</td>";
								echo "<td>" . $lista['descripcion'] . "</td>";
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
		paging: false,
		"searching": false,
		"pageLength": 25
	});
});
</script>