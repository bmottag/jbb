<script type="text/javascript" src="<?php echo base_url("assets/js/validate/ordentrabajo/ordentrabajo_estado.js"); ?>"></script>
<script>
$(document).ready(function () {	
    $('#estado').change(function () {
        $('#estado option:selected').each(function () {
            var estado = $('#estado').val();

            if ((estado > 0 || estado != '') ) {
				$("#div_costo").css("display", "none");
                $('#costo_mantenimiento').val("");
				if(estado==2){
					$("#div_costo").css("display", "inline");
				}
            }
        });
    });
});
</script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Adicionar Información Orden de Trabajo	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddIdOrdenTrabajo" name="hddIdOrdenTrabajo" value="<?php echo $idOrdenTrabajo; ?>"/>
		<input type="hidden" id="hddtipoMantenimiento" name="hddtipoMantenimiento" value="<?php echo $information[0]['tipo_mantenimiento']; ?>"/>
		<input type="hidden" id="hddIdMantenimiento" name="hddIdMantenimiento" value="<?php echo $information[0]['fk_id_mantenimiento']; ?>"/>
		<input type="hidden" id="hddUsarContrato" name="hddUsarContrato" value="<?php echo $information[0]['usar_contrato']; ?>"/>
		<input type="hidden" id="hddSaldoContrato" name="hddSaldoContrato" value="<?php echo $info[0]['saldo_contrato']; ?>"/>
		<input type="hidden" id="hddIdContratoMantenimiento" name="hddIdContratoMantenimiento" value="<?php echo $info[0]['fk_id_contrato_mantenimiento']; ?>"/>

		<?php
			if($information[0]['usar_contrato'] == 1 ){
				$maxCosto = 'max=' . $info[0]['saldo_contrato'];
			}else{
				$maxCosto = "";
			}
		?>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="estado">Estado: *</label>
					<select name="estado" id="estado" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information && $information[0]["estado_actual"] == 1) { echo "selected"; }  ?>>Asignada</option>
						<option value=2 <?php if($information && $information[0]["estado_actual"] == 2) { echo "selected"; }  ?>>Solucionada</option>
						<option value=3 <?php if($information && $information[0]["estado_actual"] == 3) { echo "selected"; }  ?>>Cancelada</option>
					</select>
				</div>
			</div>

			<div class="col-sm-6" id="div_costo" style="display:none">
				<div class="form-group text-left">
					<label class="control-label" for="costo_mantenimiento">Costo Mantenimiento: *</label>
					<input type="number" id="costo_mantenimiento" name="costo_mantenimiento" class="form-control" placeholder="Costo Mantenimiento" <?php echo $maxCosto; ?>  >
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="informacion">Información Adicional: *</label>
					<textarea id="informacion" name="informacion" placeholder="Información Adicional" class="form-control" rows="3" ></textarea>
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