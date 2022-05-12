<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo_v2.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<!-- Start of menu -->
		<?php
			$this->load->view('menu_equipos');
		?>
		<!-- End of menu -->
		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa <?php echo $info[0]['icono']; ?>"></i> <strong>INFORMACIÓN GENERAL DEL EQUIPO</strong>
					<div class="pull-right">
						<div class="btn-group">
	                        <form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/infoEquipoPDF"); ?>" target="_blank">
	                            <input type="hidden" class="form-control" id="idEquipo" name="idEquipo" value="<?php echo $info[0]['id_equipo']; ?>" />
	                            <button type="submit" class="btn btn-info btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
	                                Descargar Listado PDF <span class="fa fa-file-pdf-o" aria-hidden="true" />
	                            </button>
	                        </form>
						</div>
					</div>
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
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_inventario">Número Inventario Entidad: </label>
								<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $info?$info[0]["numero_inventario"]:""; ?>" placeholder="Número Inventario Entidad" required <?php echo $deshabilitar; ?>>
							</div>

							<div class="col-sm-6">
								<label for="dependencia">Área Responsable: </label>
								<select name="id_dependencia" id="id_dependencia" class="form-control" required <?php echo $deshabilitar; ?>>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($dependencias); $i++) { ?>
										<option value="<?php echo $dependencias[$i]["id_dependencia"]; ?>" <?php if($info && $info[0]["fk_id_dependencia"] == $dependencias[$i]["id_dependencia"]) { echo "selected"; }  ?>><?php echo $dependencias[$i]["dependencia"]; ?></option>	
									<?php } ?>
								</select>
							</div>							
						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="marca">Marca: </label>
								<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $info?$info[0]["marca"]:""; ?>" placeholder="Marca" required <?php echo $deshabilitar; ?>>
							</div>
							
							<div class="col-sm-6">
								<label for="modelo">Modelo: </label>
								<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $info?$info[0]["modelo"]:""; ?>" placeholder="Modelo" required <?php echo $deshabilitar; ?>>
							</div>	
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Número Serial: </label>
								<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $info?$info[0]["numero_serial"]:""; ?>" placeholder="Número Serial" required <?php echo $deshabilitar; ?>>
							</div>
							
							<div class="col-sm-6">
								<label for="from">Tipo Equipo: </label>
								<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" required <?php echo $deshabilitar; ?>>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
										<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($info && $info[0]["fk_id_tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Contrato de Mantenimiento: *</label>
								<select name="id_contrato" id="id_contrato" class="form-control" required>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($contratosMantenimiento); $i++) { ?>
										<option value="<?php echo $contratosMantenimiento[$i]["id_contrato_mantenimiento"]; ?>" <?php if($info && $info[0]["fk_id_contrato_mantenimiento"] == $contratosMantenimiento[$i]["id_contrato_mantenimiento"]) { echo "selected"; }  ?>><?php echo $contratosMantenimiento[$i]["numero_contrato"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						
							<div class="col-sm-6">
								<label for="placa">Placa: </label>
								<input type="text" id="placa" name="placa" class="form-control" value="<?php echo $info?$info[0]["placa"]:""; ?>" placeholder="Placa" <?php echo $deshabilitar; ?>>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="valor_comercial">Valor Comercial: </label>
								<input type="text" id="valor_comercial" name="valor_comercial" class="form-control" value="<?php echo $info?$info[0]["valor_comercial"]:""; ?>" placeholder="Valor Comercial" <?php echo $deshabilitar; ?>>
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
							<div class="col-sm-6">
								<label for="fecha_adquisicion">Fecha Adquisición: </label>
								<input type="text" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" value="<?php echo $info?$info[0]["fecha_adquisicion"]:""; ?>" placeholder="Fecha Adquisición" <?php echo $deshabilitar; ?>/>
							</div>

						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="id_responsable">Responsable del Equipo: *</label>
								<select name="id_responsable" id="id_responsable" class="form-control" required <?php echo $deshabilitar; ?>>
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($listaUsuarios); $i++) { ?>
										<option value="<?php echo $listaUsuarios[$i]["id_user"]; ?>" <?php if($info && $info[0]["fk_id_responsable"] == $listaUsuarios[$i]["id_user"]) { echo "selected"; }  ?>><?php echo $listaUsuarios[$i]["first_name"] . ' ' . $listaUsuarios[$i]["last_name"]; ?></option>		
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-6">
								<label for="from">Estado: </label>
								<select name="estado" id="estado" class="form-control" required <?php echo $deshabilitar; ?>>
									<option value=''>Select...</option>
									<option value=1 <?php if($info && $info[0]["estado_equipo"] == 1) { echo "selected"; }  ?>>Activo</option>
									<option value=2 <?php if($info && $info[0]["estado_equipo"] == 2) { echo "selected"; }  ?>>Inactivo</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label for="observacion">Observación: </label>
								<textarea id="observacion" name="observacion" placeholder="Observación" class="form-control" rows="3" <?php echo $deshabilitar; ?>><?php echo $info?$info[0]["observacion"]:""; ?></textarea>
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
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-info'>
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