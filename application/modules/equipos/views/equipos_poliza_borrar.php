<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/poliza.js"); ?>"></script>
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
				<a href="<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-thumb-tack"></i> Localización
				</a>
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tint"></i> Control Combustible
				</a>
				<a href="<?php echo base_url('equipos/poliza/' . $info[0]['id_equipo']); ?>" class="btn btn-violeta btn-block">
					<i class="fa fa-book"></i> Pólizas
				</a>
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-violeta">
				<div class="panel-heading">
					<i class="fa fa-book"></i> <strong>PÓLIZAS DEL EQUIPO</strong>
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
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $infoPoliza?$infoPoliza[0]["id_equipo_poliza"]:""; ?>"/>
						<input type="hidden" id="hddIdEquipo" name="hddIdEquipo" value="<?php echo $info[0]['id_equipo']; ?>"/>

<script>
$( function() {
var dateFormat = "mm/dd/yy",
from = $( "#fecha_inicio" )
.datepicker({
changeMonth: true,
changeYear: true
})
.on( "change", function() {
to.datepicker( "option", "minDate", getDate( this ) );
}),
to = $( "#fecha_vencimiento" ).datepicker({
changeMonth: true,
changeYear: true
})
.on( "change", function() {
from.datepicker( "option", "maxDate", getDate( this ) );
});

function getDate( element ) {
var date;
try {
date = $.datepicker.parseDate( dateFormat, element.value );
} catch( error ) {
date = null;
}

return date;
}
});
</script>


<?php 

if($infoPoliza){
	$fechaInicio = date('m/d/Y', strtotime($infoPoliza[0]['fecha_inicio']));
	$fechaVencimiento = date('m/d/Y', strtotime($infoPoliza[0]['fecha_vencimiento']));
}

?>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="fecha_inicio">Fecha Inicio: </label>
								<input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $infoPoliza?$fechaInicio:""; ?>" placeholder="Fecha Inicio" />
							</div>
						
							<div class="col-sm-6">
								<label for="fecha_inicio">Fecha Vencimieno: </label>
								<input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $infoPoliza?$fechaVencimiento:""; ?>" placeholder="Fecha Vencimiento" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero_poliza">No. Póliza: </label>
								<input type="text" class="form-control" id="numero_poliza" name="numero_poliza" value="<?php echo $infoPoliza?$infoPoliza[0]["numero_poliza"]:""; ?>" placeholder="No. Póliza" />
							</div>
						
							<div class="col-sm-6">
								<label for="estado">Estado: </label>
								<select name="estado" id="estado" class="form-control" required>
									<option value=''>Select...</option>
									<option value=1 <?php if($infoPoliza && $infoPoliza[0]["estado_poliza"] == 1) { echo "selected"; }  ?>>Activo</option>
									<option value=2 <?php if($infoPoliza && $infoPoliza[0]["estado_poliza"] == 2) { echo "selected"; }  ?>>Inactivo</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<label for="descripcion">Descripción: </label>
								<textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" rows="3"><?php echo $infoPoliza?$infoPoliza[0]["descripcion"]:""; ?></textarea>
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
						
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:100%;" align="center">							
									<button type="button" id="btnSubmit" name="btnSubmit" class='btn btn-violeta'>
										Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button>
								</div>
							</div>
						</div>
															
					</form>

				</div>
			</div>
			
			<!--INICIO TABLA CONTROL COMBUSTIBLE -->
			<?php 
				if($listadoPolizas){
			?>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tr class="dafault">
					<th class="text-center">Fecha Inicio</th>
					<th class="text-center">Fecha Vencimiento</th>
					<th class="text-center">No. Póliza</th>
					<th class="text-center">Descripción</th>
<!--					<th class="text-center">Proveedor</th> -->
					<th class="text-center">Editar</th>
				</tr>
				<?php
					foreach ($listadoPolizas as $data):
						echo "<tr>";					
						echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($data['fecha_inicio'])) . "</td>";
						echo "<td class='text-center'>" . strftime("%B %d, %G",strtotime($data['fecha_vencimiento'])) . "</td>";
						echo "<td class='text-center'>" . $data['numero_poliza'] . "</td>";
						echo "<td>" . $data['descripcion'] . "</td>";
						echo "<td class='text-center'>";
				?>					
						<a class='btn btn-danger btn-xs' href='<?php echo base_url('equipos/poliza/' . $info[0]['id_equipo'] . '/' . $data['id_equipo_poliza']); ?>'>
							Editar <span class="fa fa-edit" aria-hidden="true">
						</a>
				<?php
						echo "</td>";                     
						echo "</tr>";
					endforeach;
				?>
			</table>
			<?php } ?>
			<!--FIN TABLA CONTROL COMBUSTIBLE -->
			
		</div>
		
	</div>
	
</div>
<!-- /#page-wrapper -->