<script type="text/javascript" src="<?php echo base_url("assets/js/validate/equipos/foto.js"); ?>"></script>

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
				<a href="<?php echo base_url('equipos/foto/' . $info[0]['id_equipo']); ?>" class="btn btn-warning btn-block">
					<i class="fa fa-photo"></i> Foto Equipo
				</a>
				<a href="<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-thumb-tack"></i> Localización
				</a>
				<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="btn btn-outline btn-default btn-block">
					<i class="fa fa-tint"></i> Control Combustible
				</a>
			</div>

		</div>

		<div class="col-lg-9">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<i class="fa fa-image"></i> <strong>FOTO EQUIPO</strong>
				</div>
				<div class="panel-body">
					<div class="col-lg-7">
						<p class="text-success">
							<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
							<strong>Nota:</strong> Subir foto del equipo
						</p>
					
						<form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("equipos/do_upload_equipo"); ?>">

							<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>
							<div class="form-group">
								<div class="col-sm-5">
									 <input type="file" name="userfile" />
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
					
					<div class="col-lg-5">
						<div class="alert alert-danger">
								<strong>Nota :</strong><br>
								Formato permitido: gif - jpg - png<br>
								Tamaño máximo: 3000 KB<br>
								Ancho máximo: 2024 pixels<br>
								Altura máxima: 2008 pixels<br>
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
					<th class="text-center">Eliminar</th>
				</tr>
				<?php
					foreach ($fotosEquipos as $data):
						echo "<tr>";					
						echo "<td class='text-center'><center>";

?>
<img src="<?php echo base_url($data['equipo_foto']); ?>" class="img-rounded" alt="Foto usuario" width="150" height="150" />
<?php 

						echo "</center></td>";
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