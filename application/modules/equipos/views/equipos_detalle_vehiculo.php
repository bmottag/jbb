<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo_detalle_vehiculo.js"); ?>"></script>

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
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="btn btn-success btn-block">
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
			<div class="panel panel-success">
				<div class="panel-heading">
					<i class="fa fa-tags"></i> <strong>INFORMACIÓN ESPECÍFICA</strong>
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
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoEspecifica?$infoEspecifica[0]["id_equipo_detalle_vehiculo"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<input type="hidden" id="hddMetodoGuardar" name="hddMetodoGuardar" value="<?php echo $info[0]['metodo_guardar']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="placa">Placa: </label>
								<input type="text" id="placa" name="placa" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["placa"]:""; ?>" placeholder="Placa" required >
							</div>

							<div class="col-sm-6">
								<label for="linea">Línea: </label>
								<input type="text" id="linea" name="linea" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["linea"]:""; ?>" placeholder="Línea" >
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="color">Color: </label>
								<input type="text" id="color" name="color" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["color"]:""; ?>" placeholder="Color" >
							</div>
							
							<div class="col-sm-6">
								<label for="from">Clase Vehículo: </label>
								<select name="id_clase_vechiculo" id="id_clase_vechiculo" class="form-control" >
									<option value="">Seleccione...</option>
									<?php 									
									for ($i = 0; $i < count($claseVehiculo); $i++) { ?>
										<option value="<?php echo $claseVehiculo[$i]["id_clase_vechiculo"]; ?>" <?php if($infoEspecifica && $infoEspecifica[0]["fk_id_clase_vechiculo"] == $claseVehiculo[$i]["id_clase_vechiculo"]) { echo "selected"; }  ?>><?php echo $claseVehiculo[$i]["clase_vehiculo"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">							
							<div class="col-sm-6">
								<label for="from">Tipo Carrocería: </label>
								<select name="id_tipo_carroceria" id="id_tipo_carroceria" class="form-control" >
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoCarroceria); $i++) { ?>
										<option value="<?php echo $tipoCarroceria[$i]["id_tipo_carroceria"]; ?>" <?php if($infoEspecifica && $infoEspecifica[0]["fk_id_tipo_carroceria"] == $tipoCarroceria[$i]["id_tipo_carroceria"]) { echo "selected"; }  ?>><?php echo $tipoCarroceria[$i]["tipo_carroceria"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						
							<div class="col-sm-6">
								<label for="from">Combustible: </label>
								<select name="combustible" id="combustible" class="form-control" >
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["combustible"] == 1) { echo "selected"; }  ?>>Gasolina</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["combustible"] == 2) { echo "selected"; }  ?>>Diesel</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="capacidad">Capacidad: </label>
								<input type="text" id="capacidad" name="capacidad" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["capacidad"]:""; ?>" placeholder="Capacidad"  >
							</div>

							<div class="col-sm-6">
								<label for="servicio">Servicio: </label>
								<input type="text" id="servicio" name="servicio" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["servicio"]:""; ?>" placeholder="Servicio"  >
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_motor">Número Motor: </label>
								<input type="text" id="numero_motor" name="numero_motor" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_motor"]:""; ?>" placeholder="Número Motor" >
							</div>

							<div class="col-sm-6">
								<label for="multas">Multas: </label>
								<select name="multas" id="multas" class="form-control" >
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["multas"] == 1) { echo "selected"; }  ?>>Si</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["multas"] == 2) { echo "selected"; }  ?>>No</option>
								</select>
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
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-success'>
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