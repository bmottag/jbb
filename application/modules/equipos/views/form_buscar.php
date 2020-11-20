<script type="text/javascript" src="<?php echo base_url("assets/js/validate/workorder/search_v2.js"); ?>"></script>

<div id="page-wrapper">

	<br>	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<i class="fa fa-truck"></i> <strong>EQUIPOS</strong>
				</div>
				<div class="panel-body">
					
					<div class="col-lg-12">
						<p class="text-info"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span> Seleccione una de las siguientes opciones.</p>
					</div>
					
					<form  name="form" id="form" role="form" method="post" class="form-horizontal" >
				
						<div class="form-group">
							<div class="col-sm-5 col-sm-offset-1">
								<label for="from">Nombre Equipo: </label>
								<input type="text" id="workOrderNumberFrom" name="workOrderNumberFrom" class="form-control" placeholder="Nombre Equipo" >
							</div>
							
							<div class="col-sm-5">
								<label for="from">Fabricante: </label>
								<input type="text" id="workOrderNumberTo" name="workOrderNumberTo" class="form-control" placeholder="Fabricante" >
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
			<div class="panel panel-danger">
				<div class="panel-heading">
					<i class="fa fa-bell fa-fw"></i> Notifications Panel - Word Orders <?php echo date("Y"); ?>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="list-group">


					</div>
					<!-- /.list-group -->

				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->

		</div>
		<!-- /.col-lg-4 -->

	</div>
	<!-- /.row -->
	
</div>
<!-- /#page-wrapper -->

<!-- Tables -->
<script>
$(document).ready(function() {
	$('#dataTables').DataTable({
		responsive: true,
		"ordering": true,
		paging: false,
		"info": false
	});
});
</script>