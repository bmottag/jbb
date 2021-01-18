<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/inspeccion_vehiculos.js"); ?>"></script>


<?php 	 
	$idEquipo = $vehicleInfo[0]["id_equipo"];
?>

<div id="page-wrapper">
	<br>
	
<form  name="form" id="form" class="form-horizontal" method="post" >
	<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_inspection_vehiculos"]:""; ?>"/>
	<input type="hidden" id="hddIdVehicle" name="hddIdVehicle" value="<?php echo $idEquipo; ?>"/>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<i class="fa fa-search"></i><strong> DIAGNÓSTICO PERIÓDICO</strong>
				</div>
				<div class="panel-body">

<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="col-lg-12">	
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
	</div>
    <?php
}
?> 

 

					<?php if($fotosEquipos[0]["equipo_foto"]){ ?>
						<div class="form-group">
							<div class="row" align="center">
								<img src="<?php echo base_url($fotosEquipos[0]["equipo_foto"]); ?>" class="img-rounded" alt="Vehicle Photo" />
							</div>
						</div>
					<?php } ?>
				
					<strong>Número Inventario: </strong><?php echo $vehicleInfo[0]['numero_inventario']; ?><br><br>
					

<!-- INICIO Firma del conductor -->					
<?php 
if($information)
{ 
	//si ya esta la firma entonces se muestra mensaje que ya termino el reporte
	if($information[0]["signature"]){ 
?>
			<div class="col-lg-12">	
				<div class="alert alert-success ">
					<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					El diagnóstico esta completo.
				</div>
			</div>
<?php   }  ?>
				<div class="col-lg-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> Firma responsable diagnóstico
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							<div class="form-group">
								<div class="row" align="center">
									<div style="width:70%;" align="center">
										 
<?php 								
	$class = "btn-primary";						
	if($information[0]["signature"]){ 
		$class = "btn-default";
?>
		
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" >
	<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver firma
</button>

<div id="myModal" class="modal fade" role="dialog">  
	<div class="modal-dialog">
		<div class="modal-content">      
			<div class="modal-header">        
				<button type="button" class="close" data-dismiss="modal">×</button>        
				<h4 class="modal-title">Firma responsable diagnóstico</h4>      </div>      
			<div class="modal-body text-center"><img src="<?php echo base_url($information[0]["signature"]); ?>" class="img-rounded" alt="Management/Safety Advisor Signature" width="304" height="236" />   </div>      
			<div class="modal-footer">        
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>     
			</div>  
		</div>  
	</div>
</div>

<?php } ?>

<a class="btn <?php echo $class; ?>" href="<?php echo base_url("inspection/add_signature/vehiculos/" . $information[0]["id_inspection_vehiculos"]); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Firma </a>

									</div>
								</div>
							</div>
					
						</div>
						<!-- /.panel-body -->
					</div>
				</div>
<?php } ?>
<!-- FIN Firma del conductor -->

					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">					
					<strong>HORAS O KILOMETROS</strong>
				</div>
				<div class="panel-body">
					<div class="form-group">									
						<label class="col-sm-4 control-label" for="hours">Horas o Kilometros actuales <small class="text-primary"> </small></label>
						<div class="col-sm-5">
							<input type="text" id="hours" name="hours" class="form-control" value="<?php if($information){ echo $information[0]["horas_actuales_vehiculo"]; }?>" placeholder="Horas o Kilometros actuales" required >
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA REFRIGERACIÓN</strong>
				</div>
				<div class="panel-body">
				
					<div class="form-group">
						<label class="col-sm-4 control-label" for="radiador">Radiador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="radiador" id="radiador1" value=0 <?php if($information && $information[0]["radiador"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="radiador" id="radiador2" value=1 <?php if($information && $information[0]["radiador"] == 1) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="radiador" id="radiador3" value=99 <?php if($information && $information[0]["radiador"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tapa">Tapa </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tapa" id="tapa1" value=0 <?php if($information && $information[0]["tapa"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa" id="tapa2" value=1 <?php if($information && $information[0]["tapa"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa" id="tapa3" value=99 <?php if($information && $information[0]["tapa"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nivel_refrigeracion">Nivel de Refrigeración </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_refrigeracion" id="nivel_refrigeracion1" value=0 <?php if($information && $information[0]["nivel_refrigeracion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_refrigeracion" id="nivel_refrigeracion2" value=1 <?php if($information && $information[0]["nivel_refrigeracion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_refrigeracion" id="nivel_refrigeracion3" value=99 <?php if($information && $information[0]["nivel_refrigeracion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tension_correa_ventilacion">Tensión de la correa de ventilación </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tension_correa_ventilacion" id="tension_correa_ventilacion1" value=0 <?php if($information && $information[0]["tension_correa_ventilacion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tension_correa_ventilacion" id="tension_correa_ventilacion2" value=1 <?php if($information && $information[0]["tension_correa_ventilacion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tension_correa_ventilacion" id="tension_correa_ventilacion3" value=99 <?php if($information && $information[0]["tension_correa_ventilacion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="manometro_temperatura">Manómetro de temperatura </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="manometro_temperatura" id="manometro_temperatura1" value=0 <?php if($information && $information[0]["manometro_temperatura"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="manometro_temperatura" id="manometro_temperatura2" value=1 <?php if($information && $information[0]["manometro_temperatura"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="manometro_temperatura" id="manometro_temperatura3" value=99 <?php if($information && $information[0]["manometro_temperatura"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="persiana">Persiana </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="persiana" id="persiana1" value=0 <?php if($information && $information[0]["persiana"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="persiana" id="persiana2" value=1 <?php if($information && $information[0]["persiana"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="persiana" id="persiana3" value=99 <?php if($information && $information[0]["persiana"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
				
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE ALIMENTACIÓN</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="headLamps">Tanque de combustible</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="headLamps" id="headLamps1" value=0 <?php if($information && $information[0]["head_lamps"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="headLamps" id="headLamps2" value=1 <?php if($information && $information[0]["head_lamps"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="headLamps" id="headLamps3" value=99 <?php if($information && $information[0]["head_lamps"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="hazardLights">Indicador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="hazardLights" id="hazardLights1" value=0 <?php if($information && $information[0]["hazard_lights"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="hazardLights" id="hazardLights2" value=1 <?php if($information && $information[0]["hazard_lights"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="hazardLights" id="hazardLights3" value=99 <?php if($information && $information[0]["hazard_lights"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="bakeLights">Tubería de baja presión</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bakeLights" id="bakeLights1" value=0 <?php if($information && $information[0]["bake_lights"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bakeLights" id="bakeLights2" value=1 <?php if($information && $information[0]["bake_lights"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bakeLights" id="bakeLights3" value=99 <?php if($information && $information[0]["bake_lights"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="workLights">Grifo</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="workLights" id="workLights1" value=0 <?php if($information && $information[0]["work_lights"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="workLights" id="workLights2" value=1 <?php if($information && $information[0]["work_lights"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="workLights" id="workLights3" value=99 <?php if($information && $information[0]["work_lights"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Vaso de sedimentación</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Filtro de aire</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Filtros de combustible</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Prefiltro</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Filtro de aire tipo seco</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Pre-calentador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Acelerador manual</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Acelerador de aire</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Ahogador estrangulador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Consumo ACPM</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals3" value=99 <?php if($information && $information[0]["turn_signals"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE LUBRICACIÓN</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nuts">Ajuste del tapón del cárter</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nuts" id="nuts1" value=0 <?php if($information && $information[0]["nuts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nuts" id="nuts2" value=1 <?php if($information && $information[0]["nuts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nuts" id="nuts3" value=99 <?php if($information && $information[0]["nuts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="glass">Nivel de aceite del motor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="glass" id="glass1" value=0 <?php if($information && $information[0]["glass"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="glass" id="glass2" value=1 <?php if($information && $information[0]["glass"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="glass" id="glass3" value=99 <?php if($information && $information[0]["glass"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="cleanExterior">Bayoneta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="cleanExterior" id="cleanExterior1" value=0 <?php if($information && $information[0]["clean_exterior"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="cleanExterior" id="cleanExterior2" value=1 <?php if($information && $information[0]["clean_exterior"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="cleanExterior" id="cleanExterior3" value=99 <?php if($information && $information[0]["clean_exterior"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="wipers">Presión de aceite del motor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="wipers" id="wipers1" value=0 <?php if($information && $information[0]["wipers"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="wipers" id="wipers2" value=1 <?php if($information && $information[0]["wipers"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="wipers" id="wipers3" value=99 <?php if($information && $information[0]["wipers"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="backupBeeper">Indicador de presión</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="backupBeeper" id="backupBeeper1" value=0 <?php if($information && $information[0]["backup_beeper"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="backupBeeper" id="backupBeeper2" value=1 <?php if($information && $information[0]["backup_beeper"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="backupBeeper" id="backupBeeper3" value=99 <?php if($information && $information[0]["backup_beeper"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="Buen EstadoengerDoor">Tapa de drenaje de la caja</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor1" value=0 <?php if($information && $information[0]["Buen Estadoenger_door"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor2" value=1 <?php if($information && $information[0]["Buen Estadoenger_door"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor3" value=99 <?php if($information && $information[0]["Buen Estadoenger_door"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="Buen EstadoengerDoor">Bombillo de tablero en todos los puntos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor1" value=0 <?php if($information && $information[0]["Buen Estadoenger_door"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor2" value=1 <?php if($information && $information[0]["Buen Estadoenger_door"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor3" value=99 <?php if($information && $information[0]["Buen Estadoenger_door"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="Buen EstadoengerDoor">Nivel de aceite de la dirección</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor1" value=0 <?php if($information && $information[0]["Buen Estadoenger_door"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor2" value=1 <?php if($information && $information[0]["Buen Estadoenger_door"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor3" value=99 <?php if($information && $information[0]["Buen Estadoenger_door"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="Buen EstadoengerDoor">Depósito de la bomba hidráulica</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor1" value=0 <?php if($information && $information[0]["Buen Estadoenger_door"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor2" value=1 <?php if($information && $information[0]["Buen Estadoenger_door"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="Buen EstadoengerDoor" id="Buen EstadoengerDoor3" value=99 <?php if($information && $information[0]["Buen Estadoenger_door"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA ELÉCTRICO</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Batería</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Nivel de electrolito</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Bornes de la batería</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Terminales de Iso cables</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Seguro de batería</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="driverSeat">Caja</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat1" value=0 <?php if($information && $information[0]["driver_seat"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat2" value=1 <?php if($information && $information[0]["driver_seat"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat3" value=99 <?php if($information && $information[0]["driver_seat"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Tapa para las celdas</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE CARGA</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Conexiones del alternador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Regulador de corriente</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Indicador del tablero</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Luz testigo</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Horómetro</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE ARRANQUE</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Interruptor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Conexiones farolas delanteras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Farolas traseras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>					
					
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE EMBRAGUE</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Pedal de embrague</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Tolerancia del pedal</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Engrase del sistema</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE TRANSMISIÓN</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Nivel de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Palanca de baja</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Palanca de alta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Selector de velocidad</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Esfera de la palanca</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>										
					
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE TDF</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Palanca</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Barra de tiro, ajuste de partes</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>										
					
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA DE DIFERENCIAL</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Bloqueador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Nivel de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Bayoneta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Soporte y pesas delanteras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Pesas traseras y ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="driverSeat">Pernos delanteros y ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat1" value=0 <?php if($information && $information[0]["driver_seat"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat2" value=1 <?php if($information && $information[0]["driver_seat"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat3" value=99 <?php if($information && $information[0]["driver_seat"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>SISTEMA HIDRÁULICO</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Palanca de control de posición de ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Palanca de control automático de ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Nivel de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Bayoneta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Tubería de conducción</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="driverSeat">Radiador enfriado de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat1" value=0 <?php if($information && $information[0]["driver_seat"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat2" value=1 <?php if($information && $information[0]["driver_seat"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat3" value=99 <?php if($information && $information[0]["driver_seat"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Brazos de levante</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Cadenas tensoras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Mangueras para control remoto</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Tornillo nivelados</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

		<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>CARROCERÍA</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Guardafangos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Asiento y cojines</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Capot - ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Caja de la dirección - ajuste </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Brazo de la dirección - ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="driverSeat">Barra principal de la dirección</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat1" value=0 <?php if($information && $information[0]["driver_seat"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat2" value=1 <?php if($information && $information[0]["driver_seat"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat3" value=99 <?php if($information && $information[0]["driver_seat"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Soporte delantero - ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Tolerancia de los frenos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Freno de mano</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Tapas de rueda delantera en grasa</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Rines traseros ajuste y estado</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Rines delanteros ajuste y estado</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>COMENTARIOS</strong>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-4 control-label" for="comments">Comentarios</label>
						<div class="col-sm-5">
						<textarea id="comments" name="comments" placeholder="Comentarios" class="form-control" rows="3"><?php echo $information?$information[0]["comments"]:""; ?></textarea>
						</div>
					</div>				
				</div>
			</div>
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
	
</form>	
	
</div>
<!-- /#page-wrapper -->