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
						<label class="col-sm-4 control-label" for="tanque_combustible">Tanque de combustible</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tanque_combustible" id="tanque_combustible1" value=0 <?php if($information && $information[0]["tanque_combustible"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tanque_combustible" id="tanque_combustible2" value=1 <?php if($information && $information[0]["tanque_combustible"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tanque_combustible" id="tanque_combustible3" value=99 <?php if($information && $information[0]["tanque_combustible"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="indicador">Indicador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="indicador" id="indicador1" value=0 <?php if($information && $information[0]["indicador"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="indicador" id="indicador2" value=1 <?php if($information && $information[0]["indicador"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="indicador" id="indicador3" value=99 <?php if($information && $information[0]["indicador"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tuberia_baja_presion">Tubería de baja presión</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tuberia_baja_presion" id="tuberia_baja_presion1" value=0 <?php if($information && $information[0]["tuberia_baja_presion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tuberia_baja_presion" id="tuberia_baja_presion2" value=1 <?php if($information && $information[0]["tuberia_baja_presion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tuberia_baja_presion" id="tuberia_baja_presion3" value=99 <?php if($information && $information[0]["tuberia_baja_presion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="grifo">Grifo</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="grifo" id="grifo1" value=0 <?php if($information && $information[0]["grifo"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="grifo" id="grifo2" value=1 <?php if($information && $information[0]["grifo"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="grifo" id="grifo3" value=99 <?php if($information && $information[0]["grifo"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="vaso_sedimentacion">Vaso de sedimentación</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="vaso_sedimentacion" id="vaso_sedimentacion1" value=0 <?php if($information && $information[0]["vaso_sedimentacion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="vaso_sedimentacion" id="vaso_sedimentacion2" value=1 <?php if($information && $information[0]["vaso_sedimentacion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="vaso_sedimentacion" id="vaso_sedimentacion3" value=99 <?php if($information && $information[0]["vaso_sedimentacion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="filtro_aire">Filtro de aire</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="filtro_aire" id="filtro_aire1" value=0 <?php if($information && $information[0]["filtro_aire"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="filtro_aire" id="filtro_aire2" value=1 <?php if($information && $information[0]["filtro_aire"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="filtro_aire" id="filtro_aire3" value=99 <?php if($information && $information[0]["filtro_aire"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="filtro_combustible">Filtros de combustible</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="filtro_combustible" id="filtro_combustible1" value=0 <?php if($information && $information[0]["filtro_combustible"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="filtro_combustible" id="filtro_combustible2" value=1 <?php if($information && $information[0]["filtro_combustible"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="filtro_combustible" id="filtro_combustible3" value=99 <?php if($information && $information[0]["filtro_combustible"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="prefiltro">Prefiltro</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="prefiltro" id="prefiltro1" value=0 <?php if($information && $information[0]["prefiltro"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="prefiltro" id="prefiltro2" value=1 <?php if($information && $information[0]["prefiltro"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="prefiltro" id="prefiltro3" value=99 <?php if($information && $information[0]["prefiltro"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="filtro_aire_tipo_seco">Filtro de aire tipo seco</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="filtro_aire_tipo_seco" id="filtro_aire_tipo_seco1" value=0 <?php if($information && $information[0]["filtro_aire_tipo_seco"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="filtro_aire_tipo_seco" id="filtro_aire_tipo_seco2" value=1 <?php if($information && $information[0]["filtro_aire_tipo_seco"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="filtro_aire_tipo_seco" id="filtro_aire_tipo_seco3" value=99 <?php if($information && $information[0]["filtro_aire_tipo_seco"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="pre_calentador">Pre-calentador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="pre_calentador" id="pre_calentador1" value=0 <?php if($information && $information[0]["pre_calentador"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pre_calentador" id="pre_calentador2" value=1 <?php if($information && $information[0]["pre_calentador"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pre_calentador" id="pre_calentador3" value=99 <?php if($information && $information[0]["pre_calentador"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="acelerador_manual">Acelerador manual</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="acelerador_manual" id="acelerador_manual1" value=0 <?php if($information && $information[0]["acelerador_manual"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="acelerador_manual" id="acelerador_manual2" value=1 <?php if($information && $information[0]["acelerador_manual"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="acelerador_manual" id="acelerador_manual3" value=99 <?php if($information && $information[0]["acelerador_manual"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="acelerador_aire">Acelerador de aire</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="acelerador_aire" id="acelerador_aire1" value=0 <?php if($information && $information[0]["acelerador_aire"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="acelerador_aire" id="acelerador_aire2" value=1 <?php if($information && $information[0]["acelerador_aire"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="acelerador_aire" id="acelerador_aire3" value=99 <?php if($information && $information[0]["acelerador_aire"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="ahogador">Ahogador estrangulador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="ahogador" id="ahogador1" value=0 <?php if($information && $information[0]["ahogador"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="ahogador" id="ahogador2" value=1 <?php if($information && $information[0]["ahogador"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="ahogador" id="ahogador3" value=99 <?php if($information && $information[0]["ahogador"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="consumo_acpm">Consumo ACPM</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="consumo_acpm" id="consumo_acpm1" value=0 <?php if($information && $information[0]["consumo_acpm"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="consumo_acpm" id="consumo_acpm2" value=1 <?php if($information && $information[0]["consumo_acpm"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="consumo_acpm" id="consumo_acpm3" value=99 <?php if($information && $information[0]["consumo_acpm"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="tapon_carter">Ajuste del tapón del cárter</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tapon_carter" id="tapon_carter1" value=0 <?php if($information && $information[0]["tapon_carter"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapon_carter" id="tapon_carter2" value=1 <?php if($information && $information[0]["tapon_carter"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapon_carter" id="tapon_carter3" value=99 <?php if($information && $information[0]["tapon_carter"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nivel_aceite_motor">Nivel de aceite del motor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_motor" id="nivel_aceite_motor1" value=0 <?php if($information && $information[0]["nivel_aceite_motor"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_motor" id="nivel_aceite_motor2" value=1 <?php if($information && $information[0]["nivel_aceite_motor"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_motor" id="nivel_aceite_motor3" value=99 <?php if($information && $information[0]["nivel_aceite_motor"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="bayoneta">Bayoneta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bayoneta" id="bayoneta1" value=0 <?php if($information && $information[0]["bayoneta"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bayoneta" id="bayoneta2" value=1 <?php if($information && $information[0]["bayoneta"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bayoneta" id="bayoneta3" value=99 <?php if($information && $information[0]["bayoneta"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="presion_aceite_motor">Presión de aceite del motor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="presion_aceite_motor" id="presion_aceite_motor1" value=0 <?php if($information && $information[0]["presion_aceite_motor"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="presion_aceite_motor" id="presion_aceite_motor2" value=1 <?php if($information && $information[0]["presion_aceite_motor"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="presion_aceite_motor" id="presion_aceite_motor3" value=99 <?php if($information && $information[0]["presion_aceite_motor"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="indicador_presion">Indicador de presión</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="indicador_presion" id="indicador_presion1" value=0 <?php if($information && $information[0]["indicador_presion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="indicador_presion" id="indicador_presion2" value=1 <?php if($information && $information[0]["indicador_presion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="indicador_presion" id="indicador_presion3" value=99 <?php if($information && $information[0]["indicador_presion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tapa_drenaje_caja">Tapa de drenaje de la caja</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tapa_drenaje_caja" id="tapa_drenaje_caja1" value=0 <?php if($information && $information[0]["tapa_drenaje_caja"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa_drenaje_caja" id="tapa_drenaje_caja2" value=1 <?php if($information && $information[0]["tapa_drenaje_caja"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa_drenaje_caja" id="tapa_drenaje_caja3" value=99 <?php if($information && $information[0]["tapa_drenaje_caja"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="bombillo_tablero">Bombillo de tablero en todos los puntos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bombillo_tablero" id="bombillo_tablero1" value=0 <?php if($information && $information[0]["bombillo_tablero"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bombillo_tablero" id="bombillo_tablero2" value=1 <?php if($information && $information[0]["bombillo_tablero"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bombillo_tablero" id="bombillo_tablero3" value=99 <?php if($information && $information[0]["bombillo_tablero"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="nivel_aceite_direccion">Nivel de aceite de la dirección</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_direccion" id="nivel_aceite_direccion1" value=0 <?php if($information && $information[0]["nivel_aceite_direccion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_direccion" id="nivel_aceite_direccion2" value=1 <?php if($information && $information[0]["nivel_aceite_direccion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_direccion" id="nivel_aceite_direccion3" value=99 <?php if($information && $information[0]["nivel_aceite_direccion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="bomba_hidraulica">Depósito de la bomba hidráulica</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bomba_hidraulica" id="bomba_hidraulica1" value=0 <?php if($information && $information[0]["bomba_hidraulica"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bomba_hidraulica" id="bomba_hidraulica2" value=1 <?php if($information && $information[0]["bomba_hidraulica"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bomba_hidraulica" id="bomba_hidraulica3" value=99 <?php if($information && $information[0]["bomba_hidraulica"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="bateria">Batería</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bateria" id="bateria1" value=0 <?php if($information && $information[0]["bateria"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bateria" id="bateria2" value=1 <?php if($information && $information[0]["bateria"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bateria" id="bateria3" value=99 <?php if($information && $information[0]["bateria"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nivel_electrolito">Nivel de electrolito</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_electrolito" id="nivel_electrolito1" value=0 <?php if($information && $information[0]["nivel_electrolito"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_electrolito" id="nivel_electrolito2" value=1 <?php if($information && $information[0]["nivel_electrolito"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_electrolito" id="nivel_electrolito3" value=99 <?php if($information && $information[0]["nivel_electrolito"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="bornes_bateria">Bornes de la batería</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bornes_bateria" id="bornes_bateria1" value=0 <?php if($information && $information[0]["bornes_bateria"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bornes_bateria" id="bornes_bateria2" value=1 <?php if($information && $information[0]["bornes_bateria"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bornes_bateria" id="bornes_bateria3" value=99 <?php if($information && $information[0]["bornes_bateria"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="terminales">Terminales de Iso cables</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="terminales" id="terminales1" value=0 <?php if($information && $information[0]["terminales"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="terminales" id="terminales2" value=1 <?php if($information && $information[0]["terminales"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="terminales" id="terminales3" value=99 <?php if($information && $information[0]["terminales"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="seguro_bateria">Seguro de batería</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="seguro_bateria" id="seguro_bateria1" value=0 <?php if($information && $information[0]["seguro_bateria"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seguro_bateria" id="seguro_bateria2" value=1 <?php if($information && $information[0]["seguro_bateria"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="seguro_bateria" id="seguro_bateria3" value=99 <?php if($information && $information[0]["seguro_bateria"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="caja">Caja</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="caja" id="caja1" value=0 <?php if($information && $information[0]["caja"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="caja" id="caja2" value=1 <?php if($information && $information[0]["caja"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="caja" id="caja3" value=99 <?php if($information && $information[0]["caja"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tapa_celdas">Tapa para las celdas</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tapa_celdas" id="tapa_celdas1" value=0 <?php if($information && $information[0]["tapa_celdas"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa_celdas" id="tapa_celdas2" value=1 <?php if($information && $information[0]["tapa_celdas"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa_celdas" id="tapa_celdas3" value=99 <?php if($information && $information[0]["tapa_celdas"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="conexiones_alternador">Conexiones del alternador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="conexiones_alternador" id="conexiones_alternador1" value=0 <?php if($information && $information[0]["conexiones_alternador"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="conexiones_alternador" id="conexiones_alternador2" value=1 <?php if($information && $information[0]["conexiones_alternador"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="conexiones_alternador" id="conexiones_alternador3" value=99 <?php if($information && $information[0]["conexiones_alternador"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="regulador_corriente">Regulador de corriente</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="regulador_corriente" id="regulador_corriente1" value=0 <?php if($information && $information[0]["regulador_corriente"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="regulador_corriente" id="regulador_corriente2" value=1 <?php if($information && $information[0]["regulador_corriente"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="regulador_corriente" id="regulador_corriente3" value=99 <?php if($information && $information[0]["regulador_corriente"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="indicador_tablero">Indicador del tablero</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="indicador_tablero" id="indicador_tablero1" value=0 <?php if($information && $information[0]["indicador_tablero"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="indicador_tablero" id="indicador_tablero2" value=1 <?php if($information && $information[0]["indicador_tablero"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="indicador_tablero" id="indicador_tablero3" value=99 <?php if($information && $information[0]["indicador_tablero"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="luz_testigo">Luz testigo</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="luz_testigo" id="luz_testigo1" value=0 <?php if($information && $information[0]["luz_testigo"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="luz_testigo" id="luz_testigo2" value=1 <?php if($information && $information[0]["luz_testigo"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="luz_testigo" id="luz_testigo3" value=99 <?php if($information && $information[0]["luz_testigo"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="horometro">Horómetro</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="horometro" id="horometro1" value=0 <?php if($information && $information[0]["horometro"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horometro" id="horometro2" value=1 <?php if($information && $information[0]["horometro"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="horometro" id="horometro3" value=99 <?php if($information && $information[0]["horometro"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="interruptor">Interruptor</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="interruptor" id="interruptor1" value=0 <?php if($information && $information[0]["interruptor"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="interruptor" id="interruptor2" value=1 <?php if($information && $information[0]["interruptor"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="interruptor" id="interruptor3" value=99 <?php if($information && $information[0]["interruptor"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="farolas_delanteras">Conexiones farolas delanteras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="farolas_delanteras" id="farolas_delanteras1" value=0 <?php if($information && $information[0]["farolas_delanteras"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="farolas_delanteras" id="farolas_delanteras2" value=1 <?php if($information && $information[0]["farolas_delanteras"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="farolas_delanteras" id="farolas_delanteras3" value=99 <?php if($information && $information[0]["farolas_delanteras"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="farolas_traseras">Farolas traseras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="farolas_traseras" id="farolas_traseras1" value=0 <?php if($information && $information[0]["farolas_traseras"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="farolas_traseras" id="farolas_traseras2" value=1 <?php if($information && $information[0]["farolas_traseras"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="farolas_traseras" id="farolas_traseras3" value=99 <?php if($information && $information[0]["farolas_traseras"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="pedal_embrague">Pedal de embrague</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="pedal_embrague" id="pedal_embrague1" value=0 <?php if($information && $information[0]["pedal_embrague"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pedal_embrague" id="pedal_embrague2" value=1 <?php if($information && $information[0]["pedal_embrague"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pedal_embrague" id="pedal_embrague3" value=99 <?php if($information && $information[0]["pedal_embrague"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tolerancia_pedal">Tolerancia del pedal</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tolerancia_pedal" id="tolerancia_pedal1" value=0 <?php if($information && $information[0]["tolerancia_pedal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tolerancia_pedal" id="tolerancia_pedal2" value=1 <?php if($information && $information[0]["tolerancia_pedal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tolerancia_pedal" id="tolerancia_pedal3" value=99 <?php if($information && $information[0]["tolerancia_pedal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="engrase_sistema">Engrase del sistema</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="engrase_sistema" id="engrase_sistema1" value=0 <?php if($information && $information[0]["engrase_sistema"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="engrase_sistema" id="engrase_sistema2" value=1 <?php if($information && $information[0]["engrase_sistema"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="engrase_sistema" id="engrase_sistema3" value=99 <?php if($information && $information[0]["engrase_sistema"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="nivel_aceite">Nivel de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite" id="nivel_aceite1" value=0 <?php if($information && $information[0]["nivel_aceite"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite" id="nivel_aceite2" value=1 <?php if($information && $information[0]["nivel_aceite"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite" id="nivel_aceite3" value=99 <?php if($information && $information[0]["nivel_aceite"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="palanca_baja">Palanca de baja</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="palanca_baja" id="palanca_baja1" value=0 <?php if($information && $information[0]["palanca_baja"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_baja" id="palanca_baja2" value=1 <?php if($information && $information[0]["palanca_baja"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_baja" id="palanca_baja3" value=99 <?php if($information && $information[0]["palanca_baja"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="palanca_alta">Palanca de alta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="palanca_alta" id="palanca_alta1" value=0 <?php if($information && $information[0]["palanca_alta"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_alta" id="palanca_alta2" value=1 <?php if($information && $information[0]["palanca_alta"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_alta" id="palanca_alta3" value=99 <?php if($information && $information[0]["palanca_alta"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="selector_velocidad">Selector de velocidad</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="selector_velocidad" id="selector_velocidad1" value=0 <?php if($information && $information[0]["selector_velocidad"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="selector_velocidad" id="selector_velocidad2" value=1 <?php if($information && $information[0]["selector_velocidad"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="selector_velocidad" id="selector_velocidad3" value=99 <?php if($information && $information[0]["selector_velocidad"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="esfera_palanca">Esfera de la palanca</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="esfera_palanca" id="esfera_palanca1" value=0 <?php if($information && $information[0]["esfera_palanca"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="esfera_palanca" id="esfera_palanca2" value=1 <?php if($information && $information[0]["esfera_palanca"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="esfera_palanca" id="esfera_palanca3" value=99 <?php if($information && $information[0]["esfera_palanca"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="palanca">Palanca</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="palanca" id="palanca1" value=0 <?php if($information && $information[0]["palanca"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca" id="palanca2" value=1 <?php if($information && $information[0]["palanca"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca" id="palanca3" value=99 <?php if($information && $information[0]["palanca"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="barra_tiro">Barra de tiro, ajuste de partes</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="barra_tiro" id="barra_tiro1" value=0 <?php if($information && $information[0]["barra_tiro"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="barra_tiro" id="barra_tiro2" value=1 <?php if($information && $information[0]["barra_tiro"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="barra_tiro" id="barra_tiro3" value=99 <?php if($information && $information[0]["barra_tiro"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="bloqueador">Bloqueador</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bloqueador" id="bloqueador1" value=0 <?php if($information && $information[0]["bloqueador"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bloqueador" id="bloqueador2" value=1 <?php if($information && $information[0]["bloqueador"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bloqueador" id="bloqueador3" value=99 <?php if($information && $information[0]["bloqueador"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nivel_aceite_diferencial">Nivel de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_diferencial" id="nivel_aceite_diferencial1" value=0 <?php if($information && $information[0]["nivel_aceite_diferencial"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_diferencial" id="nivel_aceite_diferencial2" value=1 <?php if($information && $information[0]["nivel_aceite_diferencial"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_diferencial" id="nivel_aceite_diferencial3" value=99 <?php if($information && $information[0]["nivel_aceite_diferencial"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="bayoneta_diferencial">Bayoneta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bayoneta_diferencial" id="bayoneta_diferencial1" value=0 <?php if($information && $information[0]["bayoneta_diferencial"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bayoneta_diferencial" id="bayoneta_diferencial2" value=1 <?php if($information && $information[0]["bayoneta_diferencial"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bayoneta_diferencial" id="bayoneta_diferencial3" value=99 <?php if($information && $information[0]["bayoneta_diferencial"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="pesas_delanteras">Soporte y pesas delanteras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="pesas_delanteras" id="pesas_delanteras1" value=0 <?php if($information && $information[0]["pesas_delanteras"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pesas_delanteras" id="pesas_delanteras2" value=1 <?php if($information && $information[0]["pesas_delanteras"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pesas_delanteras" id="pesas_delanteras3" value=99 <?php if($information && $information[0]["pesas_delanteras"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="pesas_traseras">Pesas traseras y ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="pesas_traseras" id="pesas_traseras1" value=0 <?php if($information && $information[0]["pesas_traseras"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pesas_traseras" id="pesas_traseras2" value=1 <?php if($information && $information[0]["pesas_traseras"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pesas_traseras" id="pesas_traseras3" value=99 <?php if($information && $information[0]["pesas_traseras"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="pernos_delanteros">Pernos delanteros y ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="pernos_delanteros" id="pernos_delanteros1" value=0 <?php if($information && $information[0]["pernos_delanteros"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pernos_delanteros" id="pernos_delanteros2" value=1 <?php if($information && $information[0]["pernos_delanteros"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="pernos_delanteros" id="pernos_delanteros3" value=99 <?php if($information && $information[0]["pernos_delanteros"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="palanca_control_posicion">Palanca de control de posición de ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="palanca_control_posicion" id="palanca_control_posicion1" value=0 <?php if($information && $information[0]["palanca_control_posicion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_control_posicion" id="palanca_control_posicion2" value=1 <?php if($information && $information[0]["palanca_control_posicion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_control_posicion" id="palanca_control_posicion3" value=99 <?php if($information && $information[0]["palanca_control_posicion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="palanca_control_automatico">Palanca de control automático de ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="palanca_control_automatico" id="palanca_control_automatico1" value=0 <?php if($information && $information[0]["palanca_control_automatico"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_control_automatico" id="palanca_control_automatico2" value=1 <?php if($information && $information[0]["palanca_control_automatico"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="palanca_control_automatico" id="palanca_control_automatico3" value=99 <?php if($information && $information[0]["palanca_control_automatico"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="nivel_aceite_hidraulico">Nivel de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_hidraulico" id="nivel_aceite_hidraulico1" value=0 <?php if($information && $information[0]["nivel_aceite_hidraulico"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_hidraulico" id="nivel_aceite_hidraulico2" value=1 <?php if($information && $information[0]["nivel_aceite_hidraulico"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="nivel_aceite_hidraulico" id="nivel_aceite_hidraulico3" value=99 <?php if($information && $information[0]["nivel_aceite_hidraulico"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="bayoneta_hidraulico">Bayoneta</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="bayoneta_hidraulico" id="bayoneta_hidraulico1" value=0 <?php if($information && $information[0]["bayoneta_hidraulico"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bayoneta_hidraulico" id="bayoneta_hidraulico2" value=1 <?php if($information && $information[0]["bayoneta_hidraulico"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="bayoneta_hidraulico" id="bayoneta_hidraulico3" value=99 <?php if($information && $information[0]["bayoneta_hidraulico"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="tuberia_conduccion">Tubería de conducción</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tuberia_conduccion" id="tuberia_conduccion1" value=0 <?php if($information && $information[0]["tuberia_conduccion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tuberia_conduccion" id="tuberia_conduccion2" value=1 <?php if($information && $information[0]["tuberia_conduccion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tuberia_conduccion" id="tuberia_conduccion3" value=99 <?php if($information && $information[0]["tuberia_conduccion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="radiador_enfriado">Radiador enfriado de aceite</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="radiador_enfriado" id="radiador_enfriado1" value=0 <?php if($information && $information[0]["radiador_enfriado"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="radiador_enfriado" id="radiador_enfriado2" value=1 <?php if($information && $information[0]["radiador_enfriado"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="radiador_enfriado" id="radiador_enfriado3" value=99 <?php if($information && $information[0]["radiador_enfriado"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brazos_levante">Brazos de levante</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brazos_levante" id="brazos_levante1" value=0 <?php if($information && $information[0]["brazos_levante"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brazos_levante" id="brazos_levante2" value=1 <?php if($information && $information[0]["brazos_levante"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brazos_levante" id="brazos_levante3" value=99 <?php if($information && $information[0]["brazos_levante"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="cadenas_tensoras">Cadenas tensoras</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="cadenas_tensoras" id="cadenas_tensoras1" value=0 <?php if($information && $information[0]["cadenas_tensoras"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="cadenas_tensoras" id="cadenas_tensoras2" value=1 <?php if($information && $information[0]["cadenas_tensoras"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="cadenas_tensoras" id="cadenas_tensoras3" value=99 <?php if($information && $information[0]["cadenas_tensoras"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="mangueras">Mangueras para control remoto</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="mangueras" id="mangueras1" value=0 <?php if($information && $information[0]["mangueras"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="mangueras" id="mangueras2" value=1 <?php if($information && $information[0]["mangueras"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="mangueras" id="mangueras3" value=99 <?php if($information && $information[0]["mangueras"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="tonillo_nivelados">Tornillo nivelados</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tonillo_nivelados" id="tonillo_nivelados1" value=0 <?php if($information && $information[0]["tonillo_nivelados"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tonillo_nivelados" id="tonillo_nivelados2" value=1 <?php if($information && $information[0]["tonillo_nivelados"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tonillo_nivelados" id="tonillo_nivelados3" value=99 <?php if($information && $information[0]["tonillo_nivelados"] == 99) { echo "checked"; }  ?>>N/A
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
						<label class="col-sm-4 control-label" for="guardafangos">Guardafangos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="guardafangos" id="guardafangos1" value=0 <?php if($information && $information[0]["guardafangos"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="guardafangos" id="guardafangos2" value=1 <?php if($information && $information[0]["guardafangos"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="guardafangos" id="guardafangos3" value=99 <?php if($information && $information[0]["guardafangos"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="asiento">Asiento y cojines</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="asiento" id="asiento1" value=0 <?php if($information && $information[0]["asiento"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="asiento" id="asiento2" value=1 <?php if($information && $information[0]["asiento"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="asiento" id="asiento3" value=99 <?php if($information && $information[0]["asiento"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="capot">Capot - ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="capot" id="capot1" value=0 <?php if($information && $information[0]["capot"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="capot" id="capot2" value=1 <?php if($information && $information[0]["capot"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="capot" id="capot3" value=99 <?php if($information && $information[0]["capot"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="caja_direccion">Caja de la dirección - ajuste </label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="caja_direccion" id="caja_direccion1" value=0 <?php if($information && $information[0]["caja_direccion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="caja_direccion" id="caja_direccion2" value=1 <?php if($information && $information[0]["caja_direccion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="caja_direccion" id="caja_direccion3" value=99 <?php if($information && $information[0]["caja_direccion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="brazo_direccion">Brazo de la dirección - ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="brazo_direccion" id="brazo_direccion1" value=0 <?php if($information && $information[0]["brazo_direccion"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brazo_direccion" id="brazo_direccion2" value=1 <?php if($information && $information[0]["brazo_direccion"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="brazo_direccion" id="brazo_direccion3" value=99 <?php if($information && $information[0]["brazo_direccion"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
										
					<div class="form-group">
						<label class="col-sm-4 control-label" for="barra_principal">Barra principal de la dirección</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="barra_principal" id="barra_principal1" value=0 <?php if($information && $information[0]["barra_principal"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="barra_principal" id="barra_principal2" value=1 <?php if($information && $information[0]["barra_principal"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="barra_principal" id="barra_principal3" value=99 <?php if($information && $information[0]["barra_principal"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-4 control-label" for="soporte_delantero">Soporte delantero - ajuste</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="soporte_delantero" id="soporte_delantero1" value=0 <?php if($information && $information[0]["soporte_delantero"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="soporte_delantero" id="soporte_delantero2" value=1 <?php if($information && $information[0]["soporte_delantero"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="soporte_delantero" id="soporte_delantero3" value=99 <?php if($information && $information[0]["soporte_delantero"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="tolerancia_frenos">Tolerancia de los frenos</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tolerancia_frenos" id="tolerancia_frenos1" value=0 <?php if($information && $information[0]["tolerancia_frenos"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tolerancia_frenos" id="tolerancia_frenos2" value=1 <?php if($information && $information[0]["tolerancia_frenos"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tolerancia_frenos" id="tolerancia_frenos3" value=99 <?php if($information && $information[0]["tolerancia_frenos"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="freno_mano">Freno de mano</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="freno_mano" id="freno_mano1" value=0 <?php if($information && $information[0]["freno_mano"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="freno_mano" id="freno_mano2" value=1 <?php if($information && $information[0]["freno_mano"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="freno_mano" id="freno_mano3" value=99 <?php if($information && $information[0]["freno_mano"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="tapa_rueda_delantera">Tapas de rueda delantera en grasa</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="tapa_rueda_delantera" id="tapa_rueda_delantera1" value=0 <?php if($information && $information[0]["tapa_rueda_delantera"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa_rueda_delantera" id="tapa_rueda_delantera2" value=1 <?php if($information && $information[0]["tapa_rueda_delantera"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="tapa_rueda_delantera" id="tapa_rueda_delantera3" value=99 <?php if($information && $information[0]["tapa_rueda_delantera"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="rines_traseros">Rines traseros ajuste y estado</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="rines_traseros" id="rines_traseros1" value=0 <?php if($information && $information[0]["rines_traseros"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="rines_traseros" id="rines_traseros2" value=1 <?php if($information && $information[0]["rines_traseros"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="rines_traseros" id="rines_traseros3" value=99 <?php if($information && $information[0]["rines_traseros"] == 99) { echo "checked"; }  ?>>N/A
							</label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-4 control-label" for="rines_delanteros">Rines delanteros ajuste y estado</label>
						<div class="col-sm-5">
							<label class="radio-inline">
								<input type="radio" name="rines_delanteros" id="rines_delanteros1" value=0 <?php if($information && $information[0]["rines_delanteros"] == 0) { echo "checked"; }  ?>>Mal Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="rines_delanteros" id="rines_delanteros2" value=1 <?php if($information && $information[0]["rines_delanteros"] == 1) { echo "checked"; }  ?>>Buen Estado
							</label>
							<label class="radio-inline">
								<input type="radio" name="rines_delanteros" id="rines_delanteros3" value=99 <?php if($information && $information[0]["rines_delanteros"] == 99) { echo "checked"; }  ?>>N/A
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