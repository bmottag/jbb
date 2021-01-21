<a name="anclaUp"></a>

<div id="page-wrapper">
    <div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						DASHBOARD
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
    </div>
								
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-success ">
				<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
				<strong><?php echo $this->session->userdata("firstname"); ?></strong> <?php echo $retornoExito ?>		
			</div>
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}
?> 
			
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">10</div>
                            <div>Ordenes de Trabajo</div>
                        </div>
                    </div>
                </div>
				
                <a href="#anclaPayroll">
                    <div class="panel-footer">
                        <span class="pull-left">Últimos registros</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-life-saver fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $noVehiculos; ?></div>
                            <div>Vehículos</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="1" placeholder="Número Inventario Entidad" >
                            <button type="submit" class="btn btn-link btn-xs" id='btnBuscar' name='btnBuscar'>
                                    <span class="pull-right"> Ver registros <i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                            </button>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-briefcase fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $noBombas; ?></div>
                            <div>Bombas</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="2" placeholder="Número Inventario Entidad" >
                            <button type="submit" class="btn btn-link btn-xs" id='btnBuscar' name='btnBuscar'>
                                    <span class="pull-right"> Ver registros <i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                            </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">0</div>
                            <div>Maquinas</div>
                        </div>
                    </div>
                </div>

                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">NO HAY REGISTROS </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

	</div>

</div>