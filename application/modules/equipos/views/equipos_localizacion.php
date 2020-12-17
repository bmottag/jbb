<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/localizacion.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tag"></i> Información General
				</a>
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tags"></i> Información Específica
				</a>
				<a href="<?php echo base_url('equipos/foto/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-photo"></i> Foto Equipo
				</a>
				<a href="<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo']); ?>" class="btn btn-danger btn-block">
					<i class="fa fa-thumb-tack"></i> Localización
				</a>
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tint"></i> Control Combustible
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-tag"></i> <strong>LOCALIZACIÓN DEL EQUIPO</strong>
				</div>
				<div class="panel-body">

<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="col-lg-12">
		<p class="text-success">
			<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
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
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoLocalizacion?$infoLocalizacion[0]["id_equipo_localizacion"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>

<script>
	$( function() {
		$( "#fecha" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
						<div class="form-group">
							<div class="col-sm-2">
								<label for="fecha">Fecha: *</label>
								<input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $infoLocalizacion?$infoLocalizacion[0]["fecha_localizacion"]:""; ?>" placeholder="Fecha" required />
							</div>
						
							<div class="col-sm-8">
								<label for="localizacion">Localización: *</label>
								<input type="text" id="localizacion" name="localizacion" class="form-control" value="<?php echo $infoLocalizacion?$infoLocalizacion[0]["localizacion"]:""; ?>" placeholder="Localización" required >
							</div>
							
							<div class="col-sm-2">
								<div class="row" align="center">
									<div style="width:100%;" align="center">
										<br>
										<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-danger btn-xs'>
											Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
										</button>
									</div>
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
			
			<!--INICIO TABLA LOCALIZACIÓN -->
			<?php 
				if($listadoLocalizacion){
			?>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tr class="dafault">
					<th class="text-center">Fecha</th>
					<th class="text-center">Localización</th>
					<th class="text-center">Editar</th>
				</tr>
				<?php
					foreach ($listadoLocalizacion as $data):
						echo "<tr>";					
						echo "<td class='text-center'>" . $data['fecha_localizacion'] . "</td>";
						echo "<td>" . $data['localizacion'] . "</td>";
						echo "<td class='text-center'>";
				?>					
						<a class='btn btn-danger btn-xs' href='<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo'] . '/' . $data['id_equipo_localizacion']); ?>'>
							Editar <span class="fa fa-edit" aria-hidden="true">
						</a>
				<?php
						echo "</td>";                     
						echo "</tr>";
					endforeach;
				?>
			</table>
			<?php } ?>
			<!--FIN TABLA LOCALIZACIÓN -->
			
		</div>
		
	</div>
	
</div>
<!-- /#page-wrapper -->