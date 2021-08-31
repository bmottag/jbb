<div class="col-lg-3">
	<!-- IMAGEN DEL EQUIPO -->
	<?php 
	$imagen = FALSE;
	if($fotosEquipos){ 
		$imagen = base_url($fotosEquipos[0]["equipo_foto"]);
	}elseif($info[0]["qr_code_img"]){
		$imagen = base_url($info[0]["qr_code_img"]);
	}
	if($imagen){
		?>
		<div class="form-group">
			<div class="row" align="center">
				<img src="<?php echo $imagen; ?>" class="img-rounded" width="150" height="150" alt="Imagen Equipo" />
			</div>
		</div>
	<?php } ?>
	<!-- FIN IMAGEN DEL EQUIPO -->
	<div class="form-group">
		<div class="row" align="center">
			<strong>No. Inventario: </strong><?php echo $info[0]['numero_inventario']; ?>
			<br>
			<strong>Tipo Equipo: </strong><?php echo  $info[0]['tipo_equipo']; ?>
			<?php 
			if($info[0]['horas_kilometros_actuales']){ 
				echo "<br><strong>Kilometos/Horas actuales: </strong>" . number_format($info[0]['horas_kilometros_actuales']);
			}
			?>
		</div>
	</div>

	<?php
		$classInactivo = "btn btn-outline btn-default btn-block";
		$classActivo = "btn btn-info btn-block";
	?>

	<div class="list-group">
		<a href="<?php echo base_url('equipos/detalle/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN1)?$classActivo:$classInactivo; ?>">
			<i class="fa <?php echo $info[0]['icono']; ?>"></i> Información General
		</a>
		<a href="<?php echo base_url('equipos/especifico/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN2)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-tags"></i> Información Específica
		</a>
		<a href="<?php echo base_url('equipos/foto/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN3)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-photo"></i> Foto Equipo
		</a>
		<a href="<?php echo base_url('equipos/localizacion/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN4)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-thumb-tack"></i> Localización
		</a>
		<a href="<?php echo base_url('equipos/combustible/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN5)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-tint"></i> Seguimiento Operación
		</a>
		<a href="<?php echo base_url('equipos/documento/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN6)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-book"></i> Documentos
		</a>
		<a href="<?php echo base_url('mantenimiento/correctivo/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN7)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-wrench"></i> Mantenimiento Correctivo
		</a>
		<a href="<?php echo base_url('mantenimiento/preventivo_equipo/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN8)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-wrench"></i> Mantenimiento Preventivo
		</a>
		<a href="<?php echo base_url('ordentrabajo/listar_ot/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN9)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-briefcase"></i> Ordenes de Trabajo
		</a>
		<a href="<?php echo base_url('equipos/diagnostico/' . $info[0]['id_equipo']); ?>" class="<?php echo isset($activarBTN10)?$classActivo:$classInactivo; ?>">
			<i class="fa fa-tasks"></i> Diagnóstico Periódico
		</a>
	</div>
</div>