<script type="text/javascript" src="<?php echo base_url("assets/js/validate/inspection/vehicle_inspection_v2.js"); ?>"></script>

<?php
/**
 * If it is an ADMIN user, show date 
 * @author BMOTTAG
 * @since  11/5/2017
 */
$userRol = $this->session->rol;
if($userRol==99){
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php } ?>

<?php 	 
	$idEquipo = $vehicleInfo[0]["id_equipo"];

	$inspectionType = $vehicleInfo[0]["fk_id_tipo_equipo"];
	$truck = FALSE; //cargo bandera para utilizarla en los campos que son para TRUCK -> inpection type 3
	$tituloHorn = "Electrical Horn";
	$tituloHours = "KILOMETERS";
	$tituloSmallHours = "Current Kilometers";
	$tituloShort = " km";
	if($inspectionType == 3){
		$truck = TRUE;
		$tituloHorn = "Electrical & Air Horn";
		$tituloHours = "HOURS";	
		$tituloSmallHours = "Current Hours";	
		$tituloShort = " hours";
	}
?>

<div id="page-wrapper">
	<br>
	
<form  name="form" id="form" class="form-horizontal" method="post" >
	<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_inspection_daily"]:""; ?>"/>
	<input type="hidden" id="hddIdVehicle" name="hddIdVehicle" value="<?php echo $idEquipo; ?>"/>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<i class="fa fa-search"></i><strong>
					<?php 
						if($truck){
							echo " DUMP & HIGHWAY TRUCKS INSPECTION - II";//#2
						}else{
							echo " INSPECCIÓN DE VEHÍCULOS";//#1
						} 
					?> 
					</strong>
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
				
					<strong>Número Inventario: </strong><?php echo $vehicleInfo[0]['numero_inventario']; ?><br>
					

<!-- INICIO Firma del conductor -->					
<?php if($information){ 

		//si ya esta la firma entonces se muestra mensaje que ya termino el reporte
		if($information[0]["signature"]){ 
?>
				<div class="col-lg-12">	
					<div class="alert alert-success ">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						Thanks you have finish your Inspection Report.
					</div>
				</div>
<?php   }  ?>
				<div class="col-lg-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> Driver Signature
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
	<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Signature
</button>

<div id="myModal" class="modal fade" role="dialog">  
	<div class="modal-dialog">
		<div class="modal-content">      
			<div class="modal-header">        
				<button type="button" class="close" data-dismiss="modal">×</button>        
				<h4 class="modal-title">Daily Inspection Signature</h4>      </div>      
			<div class="modal-body text-center"><img src="<?php echo base_url($information[0]["signature"]); ?>" class="img-rounded" alt="Management/Safety Advisor Signature" width="304" height="236" />   </div>      
			<div class="modal-footer">        
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>     
			</div>  
		</div>  
	</div>
</div>

<?php } ?>

<a class="btn <?php echo $class; ?>" href="<?php echo base_url("inspection/add_signature/daily/" . $information[0]["id_inspection_daily"]); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Signature </a>

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
					<strong>KILOMETROS</strong>
				</div>
				<div class="panel-body">
					<div class="form-group">									
						<label class="col-sm-4 control-label" for="hours">Kilometros actuales <small class="text-primary"> </small></label>
						<div class="col-sm-5">
							<input type="text" id="hours" name="hours" class="form-control" value="<?php if($information){ echo $vehicleInfo[0]["hours"]; }?>" placeholder="Kilometros actuales" required >
						</div>
					</div>
					
<?php
/**
 * If it is an ADMIN user, show date 
 * @author BMOTTAG
 * @since  11/5/2017
 */
if($userRol==99){
?>				
<script>
	$( function() {
		$( "#date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
					<div class="form-group">									
						<label class="col-sm-4 control-label" for="date">Date of Issue</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="date" name="date" value="<?php echo $information?$information[0]["date_issue"]:""; ?>" placeholder="Date of Issue" />
						</div>
					</div>
<?php } ?>

				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">				
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>MOTOR</strong>
				</div>
				<div class="panel-body">
				
					<div class="form-group">
						<label class="col-sm-4 control-label" for="belt">Correas/Mangueras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="belt" id="belt1" value=0 <?php if($information && $information[0]["belt"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="belt" id="belt2" value=1 <?php if($information && $information[0]["belt"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="belt" id="belt3" value=99 <?php if($information && $information[0]["belt"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="powerSteering">Líquido de dirección asistida </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="powerSteering" id="powerSteering1" value=0 <?php if($information && $information[0]["power_steering"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="powerSteering" id="powerSteering2" value=1 <?php if($information && $information[0]["power_steering"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="powerSteering" id="powerSteering3" value=99 <?php if($information && $information[0]["power_steering"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="oil">Nivel de aceite </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="oil" id="oil1" value=0 <?php if($information && $information[0]["oil_level"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="oil" id="oil2" value=1 <?php if($information && $information[0]["oil_level"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="oil" id="oil3" value=99 <?php if($information && $information[0]["oil_level"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="coolantLevel">Nivel de liquido refrigerante </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="coolantLevel" id="coolantLevel1" value=0 <?php if($information && $information[0]["coolant_level"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="coolantLevel" id="coolantLevel2" value=1 <?php if($information && $information[0]["coolant_level"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="coolantLevel" id="coolantLevel3" value=99 <?php if($information && $information[0]["coolant_level"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="waterLeaks">Fugas de Refrigerante/Aceite </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="waterLeaks" id="waterLeaks1" value=0 <?php if($information && $information[0]["water_leaks"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="waterLeaks" id="waterLeaks2" value=1 <?php if($information && $information[0]["water_leaks"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="waterLeaks" id="waterLeaks3" value=99 <?php if($information && $information[0]["water_leaks"] == 99) { echo "checked"; }  ?>>N/A
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
					<strong>LUCES</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="headLamps">Luces delanteras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="headLamps" id="headLamps1" value=0 <?php if($information && $information[0]["head_lamps"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="headLamps" id="headLamps2" value=1 <?php if($information && $information[0]["head_lamps"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="headLamps" id="headLamps3" value=99 <?php if($information && $information[0]["head_lamps"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="hazardLights">Luces intermitentes</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="hazardLights" id="hazardLights1" value=0 <?php if($information && $information[0]["hazard_lights"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="hazardLights" id="hazardLights2" value=1 <?php if($information && $information[0]["hazard_lights"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="hazardLights" id="hazardLights3" value=99 <?php if($information && $information[0]["hazard_lights"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="bakeLights">Luces traseras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bakeLights" id="bakeLights1" value=0 <?php if($information && $information[0]["bake_lights"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="bakeLights" id="bakeLights2" value=1 <?php if($information && $information[0]["bake_lights"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="bakeLights" id="bakeLights3" value=99 <?php if($information && $information[0]["bake_lights"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="workLights">Luces de reversa</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="workLights" id="workLights1" value=0 <?php if($information && $information[0]["work_lights"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="workLights" id="workLights2" value=1 <?php if($information && $information[0]["work_lights"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="workLights" id="workLights3" value=99 <?php if($information && $information[0]["work_lights"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="turnSignals">Direccionales</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals1" value=0 <?php if($information && $information[0]["turn_signals"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="turnSignals" id="turnSignals2" value=1 <?php if($information && $information[0]["turn_signals"] == 1) { echo "checked"; }  ?>>Pass
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
					<strong>EXTERIOR</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nuts">Llantas/Tuercas/Presion</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nuts" id="nuts1" value=0 <?php if($information && $information[0]["nuts"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="nuts" id="nuts2" value=1 <?php if($information && $information[0]["nuts"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="nuts" id="nuts3" value=99 <?php if($information && $information[0]["nuts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="glass">Vidrios y espejos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="glass" id="glass1" value=0 <?php if($information && $information[0]["glass"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="glass" id="glass2" value=1 <?php if($information && $information[0]["glass"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="glass" id="glass3" value=99 <?php if($information && $information[0]["glass"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="cleanExterior">Limpieza exterior</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="cleanExterior" id="cleanExterior1" value=0 <?php if($information && $information[0]["clean_exterior"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="cleanExterior" id="cleanExterior2" value=1 <?php if($information && $information[0]["clean_exterior"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="cleanExterior" id="cleanExterior3" value=99 <?php if($information && $information[0]["clean_exterior"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="wipers">Limpiaparabrisas</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="wipers" id="wipers1" value=0 <?php if($information && $information[0]["wipers"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="wipers" id="wipers2" value=1 <?php if($information && $information[0]["wipers"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="wipers" id="wipers3" value=99 <?php if($information && $information[0]["wipers"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="backupBeeper">Pito de reversa</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="backupBeeper" id="backupBeeper1" value=0 <?php if($information && $information[0]["backup_beeper"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="backupBeeper" id="backupBeeper2" value=1 <?php if($information && $information[0]["backup_beeper"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="backupBeeper" id="backupBeeper3" value=99 <?php if($information && $information[0]["backup_beeper"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="passengerDoor">Puerta de conductor y pasajero</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="passengerDoor" id="passengerDoor1" value=0 <?php if($information && $information[0]["passenger_door"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="passengerDoor" id="passengerDoor2" value=1 <?php if($information && $information[0]["passenger_door"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="passengerDoor" id="passengerDoor3" value=99 <?php if($information && $information[0]["passenger_door"] == 99) { echo "checked"; }  ?>>N/A
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
					<strong>SERVICIOS</strong>
				</div>
				<div class="panel-body">
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brakePedal">Pedal de freno</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal1" value=0 <?php if($information && $information[0]["brake_pedal"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal2" value=1 <?php if($information && $information[0]["brake_pedal"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="brakePedal" id="brakePedal3" value=99 <?php if($information && $information[0]["brake_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="emergencyBrake">Freno de emergencia</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake1" value=0 <?php if($information && $information[0]["emergency_brake"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake2" value=1 <?php if($information && $information[0]["emergency_brake"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="emergencyBrake" id="emergencyBrake3" value=99 <?php if($information && $information[0]["emergency_brake"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="gauges">Indicadores: Voltios / Combustible / Temperatura / Aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges1" value=0 <?php if($information && $information[0]["gauges"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges2" value=1 <?php if($information && $information[0]["gauges"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="gauges" id="gauges3" value=99 <?php if($information && $information[0]["gauges"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horn">Pito</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn1" value=0 <?php if($information && $information[0]["horn"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn2" value=1 <?php if($information && $information[0]["horn"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="horn" id="horn3" value=99 <?php if($information && $information[0]["horn"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seatbelts">Cinturon de seguridad</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts1" value=0 <?php if($information && $information[0]["seatbelts"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts2" value=1 <?php if($information && $information[0]["seatbelts"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="seatbelts" id="seatbelts3" value=99 <?php if($information && $information[0]["seatbelts"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="driverSeat">Asiento del conductor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat1" value=0 <?php if($information && $information[0]["driver_seat"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat2" value=1 <?php if($information && $information[0]["driver_seat"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="driverSeat" id="driverSeat3" value=99 <?php if($information && $information[0]["driver_seat"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="insurance">Información del seguro</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance1" value=0 <?php if($information && $information[0]["insurance"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance2" value=1 <?php if($information && $information[0]["insurance"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="insurance" id="insurance3" value=99 <?php if($information && $information[0]["insurance"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="registration">Registro</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="registration" id="registration1" value=0 <?php if($information && $information[0]["registration"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="registration" id="registration2" value=1 <?php if($information && $information[0]["registration"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="registration" id="registration3" value=99 <?php if($information && $information[0]["registration"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="cleanInterior">Limpieza interior</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="cleanInterior" id="cleanInterior1" value=0 <?php if($information && $information[0]["clean_interior"] == 0) { echo "checked"; }  ?>>Fail
							</label>
							<label class="radio-inline">
								<input type="radio" name="cleanInterior" id="cleanInterior2" value=1 <?php if($information && $information[0]["clean_interior"] == 1) { echo "checked"; }  ?>>Pass
							</label>
							<label class="radio-inline">
								<input type="radio" name="cleanInterior" id="cleanInterior3" value=99 <?php if($information && $information[0]["clean_interior"] == 99) { echo "checked"; }  ?>>N/A
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