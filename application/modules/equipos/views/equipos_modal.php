<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Equipos
	<br><small>Adicionar/Editar Equipo</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_equipo"]:""; ?>"/>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="numero_inventario">No. Inventario Entidad: *</label>
					<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $information?$information[0]["numero_inventario"]:""; ?>" placeholder="No. Inventario Entidad" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="id_dependencia">Depedencia: *</label>
					<select name="id_dependencia" id="id_dependencia" class="form-control" required>
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($dependencias); $i++) { ?>
							<option value="<?php echo $dependencias[$i]["id_dependencia"]; ?>" <?php if($information && $information[0]["fk_id_dependencia"] == $dependencias[$i]["id_dependencia"]) { echo "selected"; }  ?>><?php echo $dependencias[$i]["dependencia"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="marca">Marca: *</label>
					<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $information?$information[0]["marca"]:""; ?>" placeholder="Marca" required >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="modelo">Modelo: *</label>
					<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $information?$information[0]["modelo"]:""; ?>" placeholder="Modelo" required >
				</div>
			</div>
		</div>

		<div class="row">
	
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="numero_serial">Número Serial: *</label>
					<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $information?$information[0]["numero_serial"]:""; ?>" placeholder="Número Serial" required >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="id_tipo_equipo">Tipo Equipo: *</label>
					<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required>
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
							<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($information && $information[0]["fk_id_tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>		
 
		</div>

<script>
	$( function() {
		$( "#fecha_adquisicion" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado: *</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value=''>Select...</option>
						<option value=1 <?php if($information && $information[0]["estado_equipo"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information && $information[0]["estado_equipo"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>	
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Fecha Adquisición: *</label>
					<input type="text" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" value="" placeholder="Fecha Adquisición" required />
				</div>
			</div>

		</div>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="valor_comercial">Valor Comercial: </label>
					<input type="text" id="valor_comercial" name="valor_comercial" class="form-control" value="<?php echo $information?$information[0]["valor_comercial"]:""; ?>" placeholder="Valor Comercial" >
				</div>
			</div>
			
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="observacion">Observación: </label>
					<textarea id="observacion" name="observacion" placeholder="Observación" class="form-control" rows="3"><?php echo $information?$information[0]["observacion"]:""; ?></textarea>
				</div>
			</div>

		</div>
						
		<div class="form-group">
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
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>