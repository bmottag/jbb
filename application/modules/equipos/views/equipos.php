<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/buscar.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'equipos/cargarModalEquipo',
                data: {'idVehicle': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>


<div id="page-wrapper">
	<br>	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-search"></i> BUSCAR EQUIPOS
				</div>
				<div class="panel-body">
					<div class="col-lg-12">
						<p class="text-info"><span class="glyphicon glyphicon-pushpin " aria-hidden="true"></span> Seleccione por lo menos una opción</p>
					</div>
					<form  name="form" id="form" role="form" method="post" class="form-horizontal" >

						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="numero_unidad">Número Unidad</label>
								<input type="text" id="numero_unidad" name="numero_unidad" class="form-control" placeholder="Número Unidad" >
							</div>
							
							<div class="col-sm-5">
								<label for="fabricante">Fabricante </label>
								<input type="text" id="fabricante" name="fabricante" class="form-control" placeholder="Fabricante" >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="modelo">Modelo</label>
								<input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo" >
							</div>
							
							<div class="col-sm-5">
								<label for="numero_serial">Número Serial</label>
								<input type="text" id="numero_serial" name="numero_serial" class="form-control" placeholder="Número Serial" >
							</div>
						</div>
						
						<div class="row"></div><br>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width80%;" align="center">
									
								 <button type="submit" class="btn btn-primary" id='btnSubmit' name='btnSubmit'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar </button>
									
								</div>
							</div>
						</div>
						
					</form>

				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
		
		<div class="col-lg-4">

			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Equipo
			</button><br>
			
			<a class='btn btn-outline btn-danger btn-block' href='<?php echo base_url('equipos/inactivos'); ?>'>
					<span class="glyphicon glyphicon-remove " aria-hidden="true"> </span>  Equipos Inactivos
			</a>

		</div>
		<!-- /.col-lg-4 -->

	</div>
	<!-- /.row -->
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				
<?php
	//DESHABILITAR EDICION
	$deshabilitar = 'disabled';
	$userRol = $this->session->rol;
	
	if($userRol == 99 || $userRol == 4){
		$deshabilitar = '';
	}
?>			
					
					<i class="fa fa-truck"></i> ÚLTIMOS EQUIPOS REGISTRADOS
				</div>
				<div class="panel-body">	
				
<br>


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

<?php 										
	if(!$info){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
			
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Nombre Equipo</th>
								<th class="text-center">Número Unidad</th>
								<th class="text-center">Fabricante</th>
								<th class="text-center">Modelo</th>
								<th class="text-center">Número Serial</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Observación</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
							
									echo "<tr>";
									echo "<td class='text-center'>";
						?>
						
<a href='<?php echo base_url('equipos/detalle/' . $lista['id_equipo']); ?>'>
		  <?php echo $lista['nombre_equipo'] ?>
</a>

						<?php
									
									
									if(!$deshabilitar){
						?>			<br>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
						<?php
									}
									echo "</td>";

									echo "<td class='text-center'>" . $lista['numero_unidad'] . "</td>";
									echo "<td>" . $lista['fabricante'] . "</td>";
									echo "<td>" . $lista['modelo'] . "</td>";
									echo "<td class='text-center'>" . $lista['numero_serial'] . "</td>";
									echo "<td class='text-center'>";
									switch ($lista['estado_equipo']) {
										case 1:
											$valor = 'Activo';
											$clase = "text-success";
											break;
										case 2:
											$valor = 'Inactivo';
											$clase = "text-danger";
											break;
									}
									echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
									echo "</td>";
									echo "<td>" . $lista['observacion'] . "</td>";
									
									echo "</tr>";

							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		paging: false,
		"searching": false,
		"pageLength": 25
	});
});
</script>