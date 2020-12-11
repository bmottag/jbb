<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-truck"></i> <strong>INFORMACIÓN DEL MANTENIMIENTO PREVENTIVO</strong>
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
					<form name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_inventario">Número Inventario Entidad: </label>
								<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $info?$info[0]["numero_inventario"]:""; ?>" disabled >
							</div>
							<div class="col-sm-6">
								<label for="dependencia">Dependencia: </label>
								<input type="text" id="id_dependencia" name="id_dependencia" class="form-control" value="<?php echo $info?$info[0]["dependencia"]:""; ?>" disabled >
							</div>							
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="marca">Marca: </label>
								<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $info?$info[0]["marca"]:""; ?>" disabled >
							</div>
							<div class="col-sm-6">
								<label for="modelo">Modelo: </label>
								<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $info?$info[0]["modelo"]:""; ?>" disabled >
							</div>	
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Número Serial: </label>
								<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $info?$info[0]["numero_serial"]:""; ?>" disabled >
							</div>
							<div class="col-sm-6">
								<label for="from">Tipo Equipo: </label>
								<input type="text" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="<?php echo $info?$info[0]["tipo_equipo"]:""; ?>" disabled >
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Estado: </label>
								<input type="text" id="estado" name="estado" class="form-control" value="<?php echo $info[0]["estado_equipo"]==1?"Activo":"Inactivo"; ?>" disabled >
							</div>
							<div class="col-sm-6">
								<label for="observacion">Observación: </label>
								<textarea id="observacion" name="observacion" class="form-control" rows="3" disabled><?php echo $info?$info[0]["observacion"]:""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="fecha_inicio">Fecha de Inicio: </label>
								<input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control datePicker" placeholder="Fecha de Inicio" required >
							</div>
							<div class="col-sm-6">
								<label for="frecuencia">Frecuencia: </label>
								<select name="frecuencia" id="frecuencia" class="form-control" required>
									<option value=''>Select...</option>
									<option value=1>Diaria</option>
									<option value=2>Semanal</option>
									<option value=3>Quincenal</option>
									<option value=4>Mensual</option>
									<option value=5>Trimestral</option>
									<option value=6>Semestral</option>
									<option value=7>Anual</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label for="descripcion">Descripción: </label>
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
	</div>
</div>