<?php
	//include('session.php');
	include('init.php');


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
.screen {
	margin: 5px; border:1px solid #ddd; background-color:#fafaaa;	
	width: 100px;
    height: 25px;
    min-height: 25px;
    min-width: 25px;
    cursor: move;
		position:absolute;
}
</style>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body" style="height:450px;">
                                  <!-- text input -->
			
			<div id="canvas" style="border:1px solid #ddd; background-color:#fafafa; width:800px; height:400px; float:left;">

			</div>
      <div id="devices" style="margin-left:20px; border:1px solid #ddd; background-color:#fff; width:200px; height:400px; float:left;">
      	<?php $screens = get_screens(); ?>
        <?php foreach($screens as $screen) : ?>
        	<div class="screen" id="#screen<?php echo $screen->id; ?>" 
          			style=" width:<?php echo $screen->width * 2; ?>px; height:<?php echo $screen->height * 1.5; ?>px;
                position:relative;
                ">
          	<?php echo $screen->name; ?><br />
            
            <i class="fa fa-rotate-right" style="cursor:pointer" onclick='javascript: rotate_screen("#screen<?php echo $screen->id; ?>");'></i>
          </div>
        
        <?php endforeach; ?>
        
      </div>
      <div style="clear:both;"></div>
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
			
			var currentParent;
			
			$("#canvas").droppable({
				
				accept:'.screen',
        drop: function(event,ui){
            if (currentParent != $(this).attr('id')){
              $(ui.draggable).appendTo($(this));
							$(ui.draggable).css("left","100px");
							$(ui.draggable).css("top","100px");
            }
        }				
			});
			$("#devices").droppable({
				
				accept:'.screen',
        drop: function(event,ui){
            if (currentParent != $(this).attr('id')){
              $(ui.draggable).appendTo($(this));
							
            }
        }				
			});
			$(".screen").draggable({
				snap: ".screen",
				grid: [5,5],
				revert: 'invalid',
				start: function(){
					currentParent = $(this).parent().attr('id');
					
				}				
			});
		//	$("#devices").sortable();
		});
		
		function rotate_screen(scn){
			alert(scn);
			alert($("#screen1").css("background-color"));  
//			var w = $(screen).css("width");
//			var h = $(screen).css("height");
//			$(screen).css("width", h);
//			$(screen).css("height", W);
		}
  </script>
