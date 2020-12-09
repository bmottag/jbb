<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo_detalle_bomba.js"); ?>"></script>

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
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="list-group-item">
					<i class="fa fa-twitter fa-wrench"></i> Información General
				</a>
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="list-group-item">
					<i class="fa fa-twitter fa-wrench"></i> Información Específica
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-truck"></i> <strong>INFORMACIÓN DEL EQUIPO</strong>
				</div>
				<div class="panel-body">

<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">
		<p class="text-success">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoEspecifica?$infoEspecifica[0]["id_equipo_detalle_bomba"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<input type="hidden" id="hddMetodoGuardar" name="hddMetodoGuardar" value="<?php echo $info[0]['metodo_guardar']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="dimension">Dimensión: </label>
								<input type="text" id="dimension" name="dimension" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["dimension"]:""; ?>" placeholder="Dimension" >
							</div>

							<div class="col-sm-6">
								<label for="motor_frecuencia">Frecuencia Motor: </label>
								<input type="text" id="motor_frecuencia" name="motor_frecuencia" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motor_frecuencia"]:""; ?>" placeholder="Frecuencia Motor" >
							</div>							
						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="motor_velocidad">Velocidad Motor: </label>
								<input type="text" id="motor_velocidad" name="motor_velocidad" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motor_velocidad"]:""; ?>" placeholder="Velocidad Motor" >
							</div>
							
							<div class="col-sm-6">
								<label for="motor_voltaje">Voltaje Motor: </label>
								<input type="text" id="motor_voltaje" name="motor_voltaje" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["motor_voltaje"]:""; ?>" placeholder="Voltaje Motor" >
							</div>
						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="potencia">Potencia: </label>
								<input type="text" id="potencia" name="potencia" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["potencia"]:""; ?>" placeholder="Potencia"  >
							</div>

							<div class="col-sm-6">
								<label for="consumo">Consumo: </label>
								<input type="text" id="consumo" name="consumo" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["consumo"]:""; ?>" placeholder="Consumo"  >
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="hmax">Hmax: </label>
								<input type="text" id="hmax" name="hmax" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["hmax"]:""; ?>" placeholder="Hmax" >
							</div>

							<div class="col-sm-6">
								<label for="qmax">Qmax: </label>
								<input type="text" id="qmax" name="qmax" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["qmax"]:""; ?>" placeholder="Qmax" >
							</div>					
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="succion">Succión: </label>
								<input type="text" id="succion" name="succion" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["succion"]:""; ?>" placeholder="Succión" >
							</div>					
							
							<div class="col-sm-6">
								<label for="salida">Salida: </label>
								<input type="text" id="salida" name="salida" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["salida"]:""; ?>" placeholder="Salida" >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="color">Color: </label>
								<input type="text" id="color" name="color" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["color"]:""; ?>" placeholder="Color" >
							</div>					
							
							<div class="col-sm-6">
								<label for="peso">Peso: </label>
								<input type="text" id="peso" name="peso" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["peso"]:""; ?>" placeholder="Peso" >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="caracteristicas">Características: </label>
								<textarea id="caracteristicas" name="caracteristicas" placeholder="Características" class="form-control" rows="3"><?php echo $infoEspecifica?$infoEspecifica[0]["caracteristicas"]:""; ?></textarea>
							</div>
						
							<div class="col-sm-6">
								<label for="condiciones_operacion">Condiciones de Operación: </label>
								<textarea id="condiciones_operacion" name="condiciones_operacion" placeholder="Condiciones de Operación" class="form-control" rows="3"><?php echo $infoEspecifica?$infoEspecifica[0]["condiciones_operacion"]:""; ?></textarea>
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
		
					
	</div>
	
</div>
<!-- /#page-wrapper -->