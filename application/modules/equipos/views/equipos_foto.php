<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/foto.js"); ?>"></script>

<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-3 col-md-3">
		
			<?php if($info[0]["qr_code_img"]){ ?>
				<div class="form-group">
					<div class="row" align="center">
						<img src="<?php echo base_url($info[0]["qr_code_img"]); ?>" class="img-rounded" width="150" height="150" alt="QR CODE" />
					</div>
				</div>
			<?php } ?>

			<div class="form-group">
				<div class="row" align="center">
						<?php echo '<strong>No. Inventario:</strong> ' . $info[0]['numero_inventario']; ?>
				</div>
			</div>
		
			<div class="list-group">
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tag"></i> Información General
				</a>
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tags"></i> Información Específica
				</a>
				<a href="<?php echo base_url('equipos/foto/' . $info[0]['id_equipo']); ?>" class="btn btn-warning btn-block">
					<i class="fa fa-photo"></i> Foto Equipo
				</a>
				<a href="<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-thumb-tack"></i> Localización
				</a>
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tint"></i> Seguimiento Operación
				</a>
				<a href="<?php echo base_url('equipos/poliza/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-book"></i> Pólizas
				</a>
				<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-wrench"></i> Mantenimiento Correctivo
				</a>
				<a href="<?php echo base_url('inspection/set_vehicle/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-book"></i> Diagnóstico Periódico
				</a>
			</div>

		</div>

		<div class="col-lg-9 col-md-9">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<i class="fa fa-image"></i> <strong>FOTO EQUIPO</strong>
				</div>
				<div class="panel-body">
					<div class="col-lg-8">

						<div class="form-group">
							<div class="col-lg-12">
								<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> 
									<strong>Subir</strong> foto del equipo
								</p>
							</div>
						</div>
					
						<form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("equipos/do_upload_equipo"); ?>">

							<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>
							<div class="form-group">
								<label class="col-sm-3" for="comments">Foto:</label>
								<div class="col-sm-5">
									 <input type="file" name="userfile" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3" for="descripcion">Descripción:</label>
								<div class="col-sm-8">
								<input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripción" required >
								</div>
							</div>
							
							<div class="form-group">
								<div class="row" align="center">
									<div style="width:50%;" align="center">							
										<button type="submit" id="btnFoto" name="btnFoto" class="btn btn-warning" >
											Enviar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
										</button> 
									</div>
								</div>
							</div>
								
							<?php if($error){ ?>
							<div class="alert alert-danger">
								<?php 
									echo "<strong>Error :</strong>";
									pr($error); 
								?><!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
							</div>
							<?php } ?>
						</form>
					</div>
					
					<div class="col-lg-4">
						<div class="alert alert-warning">
								<strong>Nota :</strong><br>
								Formato permitido: gif - jpg - png<br>
								Tamaño máximo: 3000 KB<br>
								Ancho máximo: 2024 pixels<br>
								Altura máxima: 2008 pixels
						</div>
					</div>
								
				</div>
			</div>
			<!--INICIO FOTOS -->
			<?php 
				if($fotosEquipos){
			?>
			<table class="table table-bordered table-striped table-hover table-condensed">
				<tr class="dafault">
					<th class="text-center">Foto</th>
					<th class="text-center">Usuario</th>
					<th class="text-center">Descripción</th>
					<th class="text-center">Eliminar</th>
				</tr>
				<?php
					foreach ($fotosEquipos as $data):
						echo "<tr>";					
						echo "<td class='text-center'>";

?>
 <a href="<?php echo base_url($data['equipo_foto']); ?>" target="_blank"> 
	<img src="<?php echo base_url($data['equipo_foto']); ?>" class="img-rounded" alt="Foto Equipo" width="60" height="60" />
</a>
<?php 

						echo "</td>";
						echo "<td class='text-center'>" . $data['name'] . "</td>";
						echo "<td >" . $data['descripcion'] . "</td>";
						echo "<td class='text-center'><small>";
				?>					
			<button type="button" id="<?php echo $data['id_equipo_foto']; ?>" class='btn btn-danger' title="Eliminar">
					<i class="fa fa-trash-o"></i>
			</button>
				<?php
						echo "</small></td>";                     
						echo "</tr>";
					endforeach;
				?>
			</table>
			<?php } ?>
			<!--FIN FOTOS -->

		</div>
		

		
	</div>
	
</div>
<!-- /#page-wrapper -->