<script type="text/javascript" src="<?php echo base_url("assets/js/validate/mantenimiento/buscarCorrectivo.js"); ?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){ 
	$(".btn-success").click(function () {
		var oID = $(this).attr("id");
        $.ajax ({
            type: 'POST',
			url: base_url + 'mantenimiento/equipoCorrectivo',
            data: {'id_correctivo': oID},
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
					<i class="fa fa-search"></i> BUSCAR MANTENIMIENTOS CORRECTIVOS
				</div>
				<div class="panel-body">
					<div class="col-lg-12">
						<p class="text-info"><span class="glyphicon glyphicon-pushpin " aria-hidden="true"></span> Seleccione por lo menos una opción</p>
					</div>
					<form name="formBuscar" id="formBuscar" role="form" method="post" class="form-horizontal" >
						<script>
							$( function() {
								$("#fecha_inicio").datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat: 'yy-mm-dd'
								});
							});
						</script>
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="fecha_inicio">Fecha de Inicio</label>
								<input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control" value="" placeholder="Fecha de Inicio" >
							</div>
							<div class="col-sm-5">
								<label for="numero_inventario">Número Inventario Entidad</label>
								<input type="text" id="numero_inventario" name="numero_inventario" class="form-control" placeholder="Número Inventario Entidad" >
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
		<div class="col-lg-4">
			<a class="btn btn-success btn-block" href='<?php echo base_url('mantenimiento/equipoCorrectivo'); ?>'>
				<span class="glyphicon glyphicon-plus " aria-hidden="true"> </span> Programar Mantenimiento Correctivo
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
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
								<th class="text-center">Id Mantenimiento</th>
								<th class="text-center">Fecha Inicio</th>
								<th class="text-center">No. Inventario Entidad</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Descripción</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
								echo "<tr>";
								echo "<td class='text-center'>" . $lista['id_correctivo'] . "</td>";
								echo "<td>" . $lista['fecha_inicio'] . "</td>";
								echo "<td>" . $lista['numero_inventario'] . "</td>";
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