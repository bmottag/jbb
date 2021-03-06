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
						<strong>No. Inventario: </strong><?php echo $info[0]['numero_inventario']; ?>
						<br>
						<strong>Tipo Equipo: </strong><?php echo  $info[0]['tipo_equipo']; ?>
				</div>
			</div>
		
			<div class="list-group">
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa <?php echo $info[0]['icono']; ?>"></i> Información General
				</a>
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="btn btn-info btn-block">
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
				<a href="<?php echo base_url('mantenimiento/preventivo_equipo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Preventivo
				</a>
				<a href="<?php echo base_url('equipos/diagnostico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tasks"></i> Diagnóstico Periódico
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-tags"></i> <strong>INFORMACIÓN ESPECÍFICA</strong>
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

					<form  name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoEspecifica?$infoEspecifica[0]["id_equipo_detalle_vehiculo"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<input type="hidden" id="hddMetodoGuardar" name="hddMetodoGuardar" value="<?php echo $info[0]['metodo_guardar']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="dimensiones">Dimensiones: </label>
								<input type="text" id="dimensiones" name="dimensiones" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["dimensiones"]:""; ?>" placeholder="Dimensiones" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="linea">Línea: </label>
								<input type="text" id="linea" name="linea" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["linea"]:""; ?>" placeholder="Línea" <?php echo $deshabilitar; ?>>
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="color">Color: </label>
								<input type="text" id="color" name="color" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["color"]:""; ?>" placeholder="Color" <?php echo $deshabilitar; ?>>
							</div>
							
							<div class="col-sm-6">
								<label for="from">Clase Vehículo: </label>
								<select name="id_clase_vechiculo" id="id_clase_vechiculo" class="form-control" <?php echo $deshabilitar; ?>>
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
								<select name="id_tipo_carroceria" id="id_tipo_carroceria" class="form-control" <?php echo $deshabilitar; ?>>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoCarroceria); $i++) { ?>
										<option value="<?php echo $tipoCarroceria[$i]["id_tipo_carroceria"]; ?>" <?php if($infoEspecifica && $infoEspecifica[0]["fk_id_tipo_carroceria"] == $tipoCarroceria[$i]["id_tipo_carroceria"]) { echo "selected"; }  ?>><?php echo $tipoCarroceria[$i]["tipo_carroceria"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						
							<div class="col-sm-6">
								<label for="from">Combustible: </label>
								<select name="combustible" id="combustible" class="form-control" <?php echo $deshabilitar; ?>>
									<option value=''>Select...</option>
									<option value=1 <?php if($infoEspecifica && $infoEspecifica[0]["combustible"] == 1) { echo "selected"; }  ?>>Gasolina</option>
									<option value=2 <?php if($infoEspecifica && $infoEspecifica[0]["combustible"] == 2) { echo "selected"; }  ?>>Diesel</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="capacidad">Capacidad: </label>
								<input type="text" id="capacidad" name="capacidad" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["capacidad"]:""; ?>" placeholder="Capacidad"  <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="servicio">Servicio: </label>
								<input type="text" id="servicio" name="servicio" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["servicio"]:""; ?>" placeholder="Servicio"  <?php echo $deshabilitar; ?>>
							</div>						
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_motor">Número Motor: </label>
								<input type="text" id="numero_motor" name="numero_motor" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_motor"]:""; ?>" placeholder="Número Motor" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="numero_chasis">Número Chasis: </label>
								<input type="text" id="numero_chasis" name="numero_chasis" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_chasis"]:""; ?>" placeholder="Número Chasis" <?php echo $deshabilitar; ?>>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="codigo_gps">Código GPS: </label>
								<input type="text" id="codigo_gps" name="codigo_gps" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["codigo_gps"]:""; ?>" placeholder="Código GPS" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="codigo_ship">Código Ship: </label>
								<input type="text" id="codigo_ship" name="codigo_ship" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["codigo_ship"]:""; ?>" placeholder="Código Ship" <?php echo $deshabilitar; ?>>
							</div>						
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_licencia_transito">Número de Licencia de Tránsito: </label>
								<input type="text" id="numero_licencia_transito" name="numero_licencia_transito" class="form-control" value="<?php echo $infoEspecifica?$infoEspecifica[0]["numero_licencia_transito"]:""; ?>" placeholder="Número de Licencia de Tránsito" <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="multas">Multas: </label>
								<select name="multas" id="multas" class="form-control" <?php echo $deshabilitar; ?>>
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

						<?php if(!$deshabilitar){ ?>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:100%;" align="center">							
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-success'>
										Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button>
								</div>
							</div>
						</div>
						<?php } ?>
															
					</form>

				</div>
			</div>
		</div>
		
					
	</div>
	
</div>
<!-- /#page-wrapper -->