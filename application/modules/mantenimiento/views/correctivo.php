<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/buscar.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'equipos/cargarModalEquipo',
            data: {'idEquipo': oID},
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
					<form  name="formBuscar" id="formBuscar" role="form" method="post" class="form-horizontal" >

						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="numero_inventario">Número Inventario Entidad</label>
								<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $_POST?$this->input->post('numero_inventario'):""; ?>" placeholder="Número Inventario Entidad" >
							</div>
							
							<div class="col-sm-5">
								<label for="marca">Marca </label>
								<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $_POST?$this->input->post('marca'):""; ?>" placeholder="Marca" >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="modelo">Modelo</label>
								<input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $_POST?$this->input->post('modelo'):""; ?>" placeholder="Modelo" >
							</div>
							
							<div class="col-sm-5">
								<label for="numero_serial">Número Serial</label>
								<input type="text" id="numero_serial" name="numero_serial" class="form-control" value="<?php echo $_POST?$this->input->post('numero_serial'):""; ?>" placeholder="Número Serial" >
							</div>
						</div>
						
						<div class="row"></div><br>
						<div class="form-group">
							<div class="row" align="center">
								<div style="width80%;" align="center">
									
								 <button type="submit" class="btn btn-primary" id='btnBuscar' name='btnBuscar'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar </button>
									
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				<?php
					$deshabilitar = 'disabled';
					$userRol = $this->session->rol;
					
					if($userRol == 99 || $userRol == 4){
						$deshabilitar = '';
					}
				?>			
				<i class="fa fa-truck"></i> <?php echo $tituloListado; ?>
				</div>
				<div class="panel-body">				
				<br>
				<?php 										
					if(!$info){ 
						echo '<div class="col-lg-12">
						<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
						</div>';
					} else {
				?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">No. Inventario Entidad</th>
								<th class="text-center">Dependencia</th>
								<th class="text-center">Marca</th>
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
						
						<a href='<?php echo base_url('mantenimiento/detalleCorrectivo/' . $lista['id_equipo']); ?>'>
		  				<?php echo $lista['numero_inventario'] ?>
						</a>
						<?php
							if(!$deshabilitar){
						?>	
							<br>
							<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_equipo']; ?>" >
							Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
							</button>
						<?php
							}
							echo "</td>";
							echo "<td class='text-center'>" . $lista['dependencia'] . "</td>";
							echo "<td>" . $lista['marca'] . "</td>";
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
			</div>
		</div>
	</div>
</div>
		
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