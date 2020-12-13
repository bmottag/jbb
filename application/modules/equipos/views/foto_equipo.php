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
				<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="list-group-item">
					<i class="fa fa-tag"></i> Información General
				</a>
				<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="list-group-item">
					<i class="fa fa-tags"></i> Información Específica
				</a>
				<a href="<?php echo base_url('equipos/foto/' . $info[0]['id_equipo']); ?>" class="list-group-item">
					<i class="fa fa-photo"></i> Foto Equipo
				</a>
			</div>

		</div>

		<div class="col-lg-5">
			<div class="panel panel-info">
				<div class="panel-heading">
					<i class="fa fa-image"></i> <strong>FOTO EQUIPO</strong>
				</div>
				<div class="panel-body">
		
					<?php 
						if($info[0]["foto_equipo"]){
							$URLimagen = base_url($info[0]["foto_equipo"]);
						}else{ 
							$URLimagen = base_url('images/avatar.png');
						}
					?>
					
					<div class="form-group">
						<div class="row" align="center">
							<img src="<?php echo $URLimagen; ?>" class="img-rounded" alt="Foto Equipo" width="200" height="200" />
						</div>
					</div>
								
			
					<form  name="form" id="form" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("equipos/do_upload"); ?>">

						<input type="hidden" id="hddId" name="hddId" value="<?php echo $info[0]['id_equipo']; ?>"/>
						<div class="form-group">
							<div class="col-sm-5">
								 <input type="file" name="userfile" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">							
									<button type="submit" id="btnFoto" name="btnFoto" class="btn btn-info" >
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
						<div class="alert alert-danger">
								<strong>Nota :</strong><br>
								Formato permitido: gif - jpg - png<br>
								Tamaño máximo: 3000 KB<br>
								Ancho máximo: 2024 pixels<br>
								Altura máxima: 2008 pixels<br>

						</div>
						
					</form>
			
				</div>
			</div>

		</div>
		
	</div>
	
</div>
<!-- /#page-wrapper -->