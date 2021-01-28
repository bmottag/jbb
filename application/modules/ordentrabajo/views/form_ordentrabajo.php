<script type="text/javascript" src="<?php echo base_url("assets/js/validate/ordentrabajo/ordentrabajo.js"); ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-wrench"></i> <strong>FORMULARIO ORDEN DE TRABAJO</strong>
				</div>
				<div class="panel-body">
				
					<form  name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddtipoMantenimiento" name="hddtipoMantenimiento" value="<?php echo $tipoMantenimiento; ?>"/>
						<input type="hidden" id="hddIdMantenimiento" name="hddIdMantenimiento" value="<?php echo $infoMantenimiento[0]['id_correctivo']; ?>"/>
						<input type="hidden" id="hddIdOrdenTrabajo" name="hddIdOrdenTrabajo" value="<?php echo $information?$information[0]["id_orden_trabajo"]:""; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Encargado </label>
								<select name="id_encargado" id="id_encargado" class="form-control" required>
									<option value=''>Seleccione...</option>
									<?php for ($i = 0; $i < count($listaEncargados); $i++) { ?>
										<option value="<?php echo $listaEncargados[$i]["id_user"]; ?>" <?php if($information && $information[0]["fk_id_user_encargado"] == $listaEncargados[$i]["id_user"]) { echo "selected"; }  ?>><?php echo $listaEncargados[$i]["first_name"] . ' ' . $listaEncargados[$i]["last_name"]; ?></option>		
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-6">
								<label for="from">Información Adicional </label>
								<textarea id="informacion" name="informacion" placeholder="Información Adicional" class="form-control" rows="3" ><?php echo $information?$information[0]["informacion_adicional"]:""; ?></textarea>
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
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-violeta'>
										Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button>
								</div>
							</div>
						</div>
							
					</form>

				</div>
			</div>
		</div>
	
		<div class="col-lg-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-automobile"></i> <strong>INFORMACIÓN DEL EQUIPO</strong>
				</div>
				<div class="panel-body">

					<?php if($fotosEquipos){ ?>
						<div class="form-group">
							<div class="row" align="center">
								<img src="<?php echo base_url($fotosEquipos[0]["equipo_foto"]); ?>" class="img-rounded" width="150" height="150" alt="Photo" />
							</div>
						</div>
					<?php } ?>
				
					<strong>No. Inventario Entidad: </strong><?php echo $infoEquipo[0]['numero_inventario']; ?><br>
					<strong>Marca: </strong><?php echo $infoEquipo[0]['marca']; ?><br>
					<strong>Modelo: </strong><?php echo $infoEquipo[0]['modelo']; ?><br>
					<strong>No. Serial: </strong><?php echo $infoEquipo[0]['numero_serial']; ?><br>
					<strong>Tipo Equipo: </strong><?php echo $infoEquipo[0]['tipo_equipo']; ?>					
					
				</div>
			</div>
			
			<div class="panel panel-success">
				<div class="panel-heading">
					<i class="fa fa-wrench"></i> <strong>INFORMACIÓN DEL MANTENIMIENTO</strong>
				</div>
				<div class="panel-body">

					<strong>Fecha Registro: </strong><?php echo $infoMantenimiento[0]['fecha']; ?><br>
					<strong>Descripción Falla: </strong><?php echo $infoMantenimiento[0]['descripcion']; ?><br>
					<strong>Consideración: </strong><?php echo $infoMantenimiento[0]['consideracion']; ?>
					
				</div>
			</div>
		</div>
					
	</div>	
</div>
<!-- /#page-wrapper -->