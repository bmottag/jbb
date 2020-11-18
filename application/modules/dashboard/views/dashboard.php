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
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
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
                                    <div>Time Stamp</div>
                                </div>
                            </div>
                        </div>
						
                        <a href="#anclaPayroll">
                            <div class="panel-footer">
                                <span class="pull-left">Last Payroll Records</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-amarello">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-life-saver fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">20</div>
                                    <div>FLHA</div>
                                </div>
                            </div>
                        </div>

                        <a href="#anclaSafety">
                            <div class="panel-footer">
                                <span class="pull-left"> Last FLHA Records </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-purpura">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-briefcase fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">30</div>
                                    <div>JOBS</div>
                                </div>
                            </div>
                        </div>

                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"> Jobs Info </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-truck fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">100</div>
                                    <div>.</div>
                                </div>
                            </div>
                        </div>

                        <a href="<?php echo base_url('dashboard/hauling'); ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Last Hauling Records </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

			</div>
			
			<div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">7</div>
                                    <div>Pickups & Trucks Inspections</div>
                                </div>
                            </div>
                        </div>
						<a href="<?php echo base_url('dashboard/pickups_inspection'); ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Last Inspections</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-search fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">29</div>
                                    <div>Construction Equipment Inspections</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo base_url('dashboard/construction_equipment_inspection'); ?>">
                            <div class="panel-footer">
                                <span class="pull-left"> Last Inspections </span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
            </div>
            <!-- /.row -->
            <div class="row">

<a name="anclaPayroll" ></a>			
				<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-book fa-fw"></i> Last Payroll Records
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


<a class="btn btn-default btn-circle" href="#anclaUp"><i class="fa fa-arrow-up"></i> </a>

					
				</div>
				<!-- /.panel-body -->
			</div>

		</div>
	
</div>		


