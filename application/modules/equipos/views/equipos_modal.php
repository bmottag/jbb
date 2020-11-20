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
					<label class="control-label" for="nombre_equipo">Nombre Equipo: *</label>
					<input type="text" id="nombre_equipo" name="nombre_equipo" class="form-control" value="<?php echo $information?$information[0]["nombre_equipo"]:""; ?>" placeholder="Nombre Equipo" required >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="numero_unidad">Número Unidad: *</label>
					<input type="text" id="numero_unidad" name="numero_unidad" class="form-control" value="<?php echo $information?$information[0]["numero_unidad"]:""; ?>" placeholder="Número Unidad" required >
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fabricante">Fabricante: *</label>
					<input type="text" id="fabricante" name="fabricante" class="form-control" value="<?php echo $information?$information[0]["fabricante"]:""; ?>" placeholder="Fabricante" required >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="modelo">Modelo: *</label>
					<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $information?$information[0]["modelo"]:""; ?>" placeholder="Make" required >
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
					<label class="control-label" for="estado">Estado: *</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value=''>Select...</option>
						<option value=1 <?php if($information && $information[0]["estado_equipo"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information && $information[0]["estado_equipo"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>			
 
		</div>
		
		<div class="form-group text-left">
			<label class="control-label" for="observacion">Observación: *</label>
			<textarea id="observacion" name="observacion" placeholder="Observación" class="form-control" rows="3"><?php echo $information?$information[0]["observacion"]:""; ?></textarea>
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