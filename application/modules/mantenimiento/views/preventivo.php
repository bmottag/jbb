<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/buscarPreventivo.js"); ?>"></script>
<script>
$(function(){
	$(".btn-primary").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'mantenimiento/cargarModalPreventivo',
			data: {'idPreventivo': 'x'},
            cache: false,
            success: function (data) {
                $('#tablaDatos').html(data);
            }
        });
	});
	$(".btn-success").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'mantenimiento/cargarModalPreventivo',
            data: {'idPreventivo': oID},
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
		<div class="col-lg-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-search"></i> <strong>BUSCAR MANTENIMIENTOS PREVENTIVOS</strong>
				</div>
				<div class="panel-body">
					<form name="formBuscar" id="formBuscar" role="form" method="post" class="form-horizontal" >
						<div class="form-group">
							<div class="col-sm-6">
								<label class="control-label" for="from">Tipo Equipo</label>
								<select name="tipo_equipo" id="tipo_equipo" class="form-control" >
									<option value="">Seleccione...</option>
									<?php for ($i = 0; $i < count($tipoEquipo); $i++) { ?>
										<option value="<?php echo $tipoEquipo[$i]["id_tipo_equipo"]; ?>" <?php if($_POST && $_POST["tipo_equipo"] == $tipoEquipo[$i]["id_tipo_equipo"]) { echo "selected"; }  ?>><?php echo $tipoEquipo[$i]["tipo_equipo"]; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-6">
								<br>
								<div class="form-group">
									<div class="row" align="center">
										<div style="width80%;" align="center">
										<button type="submit" class="btn btn-info" id='btnBuscar' name='btnBuscar'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar </button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal" id="x">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Mantenimiento Preventivo
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">
				<i class="fa fa-truck"></i> <?php echo $tituloListado; ?>
				</div>
				<div class="panel-body">	
				<br>
				<?php
					if(!$infoPreventivo){
						echo '<div class="col-lg-12">
						<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
						</div>';
					} else {
				?>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Tipo Equipo</th>
								<th class="text-center">Frecuencia</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Descripción</th>
								<th class="text-center">Editar</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoPreventivo as $lista):
								echo "<tr>";
								echo "<td>" . $lista['tipo_equipo'] . "</td>";
								echo "<td>" . $lista['frecuencia'] . "</td>";
								echo "<td>" . $lista['name'] . "</td>";
								echo "<td class='text-center'>";
								switch ($lista['estado']) {
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
								echo "<td>" . $lista['descripcion'] . "</td>";
								echo "<td class='text-center'>";
								?>
								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_preventivo']; ?>" >
									Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
								</button>
								<?php
								echo "</td>";
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
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">
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