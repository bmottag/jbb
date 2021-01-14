<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/control_combustible.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-3">
		
			<?php if($info[0]["qr_code_img"]){ ?>
				<div class="form-group">
					<div class="row" align="center">
						<img src="<?php echo base_url($info[0]["qr_code_img"]); ?>" class="img-rounded" width="200" height="200" alt="QR CODE" />
					</div>
				</div>
			<?php } ?>
		
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
					<i class="fa fa-tint"></i> Control Combustible
				</a>
				<a href="<?php echo base_url('equipos/poliza/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-book"></i> Pólizas
				</a>
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-tint"></i> <strong>CONTROL COMBUSTIBLE DEL EQUIPO</strong>
				</div>
				<div class="panel-body">

<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">
		<p class="text-success">
			<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
			<?php echo $retornoExito ?>	
		</p>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="col-lg-12">
		<p class="text-danger">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>	
		</p>
	</div>
    <?php
}
?>
				
					<form  name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoControlCombustible?$infoControlCombustible[0]["id_equipo_control_combustible"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="kilometros_actuales">Kilometros Actuales: *</label>
								<input type="text" id="kilometros_actuales" name="kilometros_actuales" class="form-control" value="<?php echo $infoControlCombustible?$infoControlCombustible[0]["kilometros_actuales"]:""; ?>" placeholder="Kilometros Actuales" required >
							</div>
						
							<div class="col-sm-6">
								<label for="cantidad">Cantidad: *</label>
								<input type="text" id="cantidad" name="cantidad" class="form-control" value="<?php echo $infoControlCombustible?$infoControlCombustible[0]["cantidad"]:""; ?>" placeholder="Cantidad" required >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="valor">Valor: *</label>
								<input type="text" id="valor" name="valor" class="form-control" value="<?php echo $infoControlCombustible?$infoControlCombustible[0]["valor"]:""; ?>" placeholder="Valor" required >
							</div>
						
							<div class="col-sm-6">
								<label for="observacion">Observación: </label>
								<textarea id="observacion" name="observacion" placeholder="Observación" class="form-control" rows="3"><?php echo $infoControlCombustible?$infoControlCombustible[0]["observacion"]:""; ?></textarea>
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
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-primary'>
										Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button>
								</div>
							</div>
						</div>
															
					</form>

				</div>
			</div>
			
			<!--INICIO TABLA CONTROL COMBUSTIBLE -->
			<?php 
				if($listadoControlCombustible){
			?>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tr class="dafault">
					<th class="text-center">Fecha</th>
					<th class="text-center">Kilometros Actuales</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Valor</th>
					<th class="text-center">Observación</th>
					<th class="text-center">Editar</th>
				</tr>
				<?php
					foreach ($listadoControlCombustible as $data):
						echo "<tr>";					
						echo "<td class='text-center'>" . $data['fecha_combustible'] . "</td>";
						echo "<td class='text-right'>" . number_format($data['kilometros_actuales']) . "</td>";
						echo "<td>" . $data['cantidad'] . "</td>";
						echo "<td class='text-right'>$" . number_format($data['valor'], 2) . "</td>";
						echo "<td>" . $data['observacion'] . "</td>";
						echo "<td class='text-center'>";
				?>					
						<a class='btn btn-danger btn-xs' href='<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo'] . '/' . $data['id_equipo_control_combustible']); ?>'>
							Editar <span class="fa fa-edit" aria-hidden="true">
						</a>
				<?php
						echo "</td>";                     
						echo "</tr>";
					endforeach;
				?>
			</table>
			<?php } ?>
			<!--FIN TABLA CONTROL COMBUSTIBLE -->
			
		</div>
		
	</div>
	
</div>
<!-- /#page-wrapper -->