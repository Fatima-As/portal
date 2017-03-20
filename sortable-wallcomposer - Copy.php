<?php
	//include('session.php');
	//include('init.php');


	$current = 'walls';

	$page = $_GET['page'];

	include('header.php');
?>
<?php
	include("menu.php");
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Wall Composer
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="managers.php"> Video Walls</a></li>
                        <li class="active">Wall Composer</li>
                    </ol>
                </section>
<style>
.device {
	border:1px solid #666;
	background-color:#CCC;
	height:100px;
	margin:3px;
	float:left;
	
}

</style>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-2">

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Input Devices</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <!-- text input -->

	<div id="input-devices" class="connect1" style=" height:300px; width:100%">
  	<div class="device col-xs-12">3</div>
  	<div class="device col-xs-12">4</div>
  	<div class="device col-xs-12">5</div>
  	<div class="device col-xs-12">6</div>
  </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                </div>
                            </div><!-- /.box -->

                        </div>
                    
                        <div class="col-xs-8">

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body" style="height:400px;">
                                  <!-- text input -->
                                  <div id="layer2" style="height:300px; width:500px; opacity:0.5;  background-color:#0c0; position:absolute; " class="connect2">
                                  
                                  </div>
                                  <div id="layer1" style="height:300px; width:500px; opacity:0.5;  background-color:#CC0; position:absolute; z-index:-1" class="connect1">
                                  
                                  </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                </div>
                            </div><!-- /.box -->

                        </div>
                        <div class="col-xs-2">

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Output Devices</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                  <!-- text input -->

	<div id="output-devices" class="connect2" style=" height:300px; width:100%">
  	<div class="device col-xs-6">3</div>
  	<div class="device col-xs-6">4</div>
  	<div class="device col-xs-6">5</div>
  	<div class="device col-xs-6">6</div>
  </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                </div>
                            </div><!-- /.box -->

                        </div>
                    </div>

                </section><!-- /.content -->
        </div><!-- ./wrapper -->

<?php
	include("footer.php");

?>
  <script>
	$(document).ready(function(){
		$("#input-devices, #layer1").sortable({
			connectWith: ".connect1"
		}).disableSelection();
		$("#output-devices, #layer2").sortable({
			connectWith: ".connect2"
		}).disableSelection();
	});
	$(".connect2").mousedown(	function() {
  	$("#layer1").css("z-index", 5);
	});
	$(".connect2").mouseup(function() {
  	$("#layer1").css("z-index", -1);
	});
  </script>
