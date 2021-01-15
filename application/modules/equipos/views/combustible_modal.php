<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/control_combustible.js"); ?>"></script>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">SEGUIMIENTO DE OPERACIÓN DE EQUIPO </h4>
</div>

<div class="modal-body">
	<form  name="formCombustible" id="formCombustible" role="form" method="post" >
		<input type="hidden" id="hddidEquipo" name="hddidEquipo" value="<?php echo $idEquipo; ?>"/>
		<input type="hidden" id="hddidControlCombustibler" name="hddidControlCombustibler" value="<?php echo $information?$information[0]["id_equipo_control_combustible"]:""; ?>"/>
				
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label for="kilometros_actuales">Kilometros Actuales: *</label>
					<input type="text" id="kilometros_actuales" name="kilometros_actuales" class="form-control" value="<?php echo $information?$information[0]["kilometros_actuales"]:""; ?>" placeholder="Kilometros Actuales" >
				</div>
			</div>
		
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label for="cantidad">Cantidad: *</label>
					<input type="text" id="cantidad" name="cantidad" class="form-control" value="<?php echo $information?$information[0]["cantidad"]:""; ?>" placeholder="Cantidad" >
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label for="valor">Valor: *</label>
					<input type="text" id="valor" name="valor" class="form-control" value="<?php echo $information?$information[0]["valor"]:""; ?>" placeholder="Valor" >
				</div>
			</div>

			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label for="observacion">Labor realizada: *</label>
					<textarea id="observacion" name="observacion" placeholder="Labor realizada" class="form-control" rows="3"><?php echo $information?$information[0]["observacion"]:""; ?></textarea>
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
					<button type="button" id="btnSubmitCombustible" name="btnSubmitCombustible" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
		
	</form>
</div>