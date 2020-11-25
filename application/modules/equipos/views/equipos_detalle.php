<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/equipo.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-3">
		
			<?php if($info[0]["qr_code_img"]){ ?>
				<div class="form-group">
					<div class="row" align="center">
						<img src="<?php echo base_url($info[0]["qr_code_img"]); ?>" class="img-rounded" width="200" height="200" alt="QR CODE" />
					</div>
				</div>
			<?php } ?>
		
			<div class="list-group">
				<a href="<?php echo base_url('equipos'); ?>" class="list-group-item">
					<i class="fa fa-comment fa-reply-all"></i> Regresar
				</a>
				<a href="#" class="list-group-item">
					<i class="fa fa-twitter fa-wrench"></i> Mantenimientos
					<span class="pull-right text-muted small"><em>12</em>
					</span>
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-truck"></i> <strong>INFORMACIÓN DEL EQUIPO</strong>
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
				
					<form  name="form" id="form" class="form-horizontal" method="post"  >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Nombre Equipo: </label>
								<input type="text" id="nombre_equipo" name="nombre_equipo" class="form-control" value="<?php echo $info?$info[0]["nombre_equipo"]:""; ?>" placeholder="Nombre Equipo" required >
							</div>

							<div class="col-sm-6">
								<label for="from">Número Unidad: </label>
								<input type="text" id="numero_unidad" name="numero_unidad" class="form-control" value="<?php echo $info?$info[0]["numero_unidad"]:""; ?>" placeholder="Número Unidad" required >
							</div>							
						</div>
												
						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Fabricante: </label>
								<input type="text" id="fabricante" name="fabricante" class="form-control" value="<?php echo $info?$info[0]["fabricante"]:""; ?>" placeholder="Fabricante" required >
							</div>
							
							<div class="col-sm-6">
								<label for="modelo">Modelo: </label>
								<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $info?$info[0]["modelo"]:""; ?>" placeholder="Modelo" required >
							</div>	
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="from">Número Serial: </label>
								<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $info?$info[0]["numero_serial"]:""; ?>" placeholder="Número Serial" required >
							</div>
							
							<div class="col-sm-6">
								<label for="from">Estado: </label>
								<select name="estado" id="estado" class="form-control" required>
									<option value=''>Select...</option>
									<option value=1 <?php if($info && $info[0]["estado_equipo"] == 1) { echo "selected"; }  ?>>Activo</option>
									<option value=2 <?php if($info && $info[0]["estado_equipo"] == 2) { echo "selected"; }  ?>>Inactivo</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="observacion">Observación: </label>
								<textarea id="observacion" name="observacion" placeholder="Observación" class="form-control" rows="3"><?php echo $info?$info[0]["observacion"]:""; ?></textarea>
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
			</div>
		</div>
		
					
	</div>
	
</div>
<!-- /#page-wrapper -->