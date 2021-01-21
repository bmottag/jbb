<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-3">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-search"></i> BUSCAR EQUIPOS
				</div>
				<div class="panel-body">

					<form  name="formBuscar" id="formBuscar" role="form" method="post" class="form-horizontal" >

						<div class="form-group">
							<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> 
									<strong>Seleccionar</strong> mínimo una opción
								</p>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label for="numero_serial">Tipo Equipo:</label>
								<select name="id_tipo_equipo" id="id_tipo_equipo" class="form-control" >
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
										<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($_POST && $_POST["id_tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>	
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" value="<?php echo $_POST?$this->input->post('numero_inventario'):""; ?>" placeholder="Número Inventario Entidad" >
							</div>
						</div>

						<div class="form-group">	
							<div class="col-sm-12">
								<input type="text" id="marca" name="marca" class="form-control" value="<?php echo $_POST?$this->input->post('marca'):""; ?>" placeholder="Marca" >
							</div>
						</div>
													
						<div class="form-group">
							<div class="col-sm-12">
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
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->

		<div class="col-lg-9">
			<div class="panel panel-success">
				<div class="panel-heading">
					<?php $dashboardURL = $this->session->userdata("dashboardURL"); ?>
					<a class="btn btn-success btn-xs" href="<?php echo base_url($dashboardURL); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
<?php
	//DESHABILITAR EDICION
	$deshabilitar = 'disabled';
	$userRol = $this->session->rol;
	
	if($userRol == 99 || $userRol == 4){
		$deshabilitar = '';
	}
?>			
					
					<i class="fa fa-truck"></i> <?php echo $tituloListado; ?>
				</div>
				<div class="panel-body">	
				
			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Equipo
			</button><br>

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
						
<a href='<?php echo base_url('equipos/detalle/' . $lista['id_equipo']); ?>'>
		  <?php echo $lista['numero_inventario'] ?>
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
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
		
				
<!--INICIO Modal para adicionar EQUIPOS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar EQUIPOS -->

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