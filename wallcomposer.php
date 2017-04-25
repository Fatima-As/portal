<?php
	//include('session.php');
	//include('init.php');
include('dbinc.php');
	$current = 'walls';
	//$page = $_GET['page'];

	include('header.php');
        
        
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> <!--position-->
<script type="text/javascript" src="bootstrap/js/jquery.js"></script><!--for confirm.-->
<script type="text/javascript" src="bootstrap/js/bootstrap-tooltip.js"></script><!--for confirm.-->
<script type="text/javascript" src="bootstrap/js/bootstrap-confirmation.js"></script><!--for confirm.-->
    <!-- for dialog modal-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"  ></script>  
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js" ></script>   
    <link rel="stylesheet" id="themeStyles" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"/> 
              
 
<script>
//$(document).ready(function(){
//    $("button").click(function(){
//        var scrrenN = document.getElementsByName("screens");
//        //alert(scrrenN[0].id);
//        for (var i=0; i<scrrenN.length; i++){
//        var x = $("#"+scrrenN[i].id).position();
//       // alert(i +" Top position: " + x.top + " Left position: " + x.left);
//    }
//    });
//});
</script>
<?php
	include("menu.php");
        function get_screens(){
		global $dbcon;
		$screens = array();
		$sql = "select * from screens order by name";
		$myrs = mysqli_query($dbcon,$sql);
		while($row = mysqli_fetch_assoc($myrs)){
			$screens[] = (object) $row;
		}
        
		return $screens;
	}

?>
<style>
.device {
	border:1px solid #666;
	background-color:#CCC;
	height:100px;
	margin:3px;
	
}

</style>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Wall Composer
                       
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="managers.php"> Video Walls</a></li>
                        <li class="active">Wall Composer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                <!--Line below the menu div id="toolbar" style="width:100%; height:40px; background:#fafafa; border:1px solid #ddd;  "-->
                  
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home"><label id="wallName" class="wallname">wall1</label></a></li>
                        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                    </ul>

                    
                    <!--button class="btn btn-primary" style="width:80px; height:32px; margin:3px 0 3px 3px;">Demo Wall</button>
                  <button class="btn btn-primary" style="width:32px; height:32px; margin:3px 0 3px 3px;"></button>
                  <button class="btn btn-primary" style="width:32px; height:32px; margin:3px 0 3px 3px;"></button>
                  <button class="btn btn-primary" style="width:32px; height:32px; margin:3px 0 3px 3px;"></button>
                  <button class="btn btn-primary" style="width:32px; height:32px; margin:3px 0 3px 3px;"></button-->
                  

                                </div><!-- /.box-header -->
                                <div class="box-body" style="height:450px;">
                                    <!--div class="tab-content"-->
                                        
                                      <!--div id="home" class="tab-pane fade in active">
                                         <div id="canvas" style="border:1px solid #ddd; background-color:#fafafa; width:800px; height:400px; float:left; position: relative;">
                             
                                                      

                                         </div>
                                      </div-->
                                      <input type="text"  id="xText" value=""/>
                                        <div id="results"></div>
                                    <!--/div--> <!--./tabcontent>
                                                
                                  <!-- text input -->
                                     <div id="composer">
			
                                        <div id="canvas" style="border:1px solid #ddd; background-color:#fafafa; width:800px; height:400px; float:left;">
                         
                                               	

                                        </div><!--canvas-->
      <div id="devices" style="margin-left:20px; padding:0px; border:1px solid #ddd; background-color:#fff; width:200px; height:400px; float:left; position: relative;">
      <?php $screens = get_screens(); ?>
        <?php foreach($screens as $screen) : ?>
        	<div class="screen" name="screens" id="screen<?php echo $screen->id; ?>" style="position: absolute; top:<?php echo $screen->Y; ?>px; left:<?php echo $screen->X; ?>px; border:1px solid #ddd; background-color:#fafaaa; width: <?php echo $screen->width * 2; ?>px; height: <?php echo $screen->height * 1.5; ?>px; ">
          	<?php echo $screen->name; ?><br />
            
                    <i class="fa fa-rotate-right rotate" data="#screen<?php echo $screen->id; ?>" style="cursor:pointer" onclick='javascript: rotate_screen("#screen<?php echo $screen->id; ?>");'></i>
                </div><!--./screen-->
          
             <?php 
             endforeach; ?>   
      </div> <!--devices-->
    
                                 <div style="clear:both;"></div>
                                      </div><!--composer-->
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <form name="form01" method="POST" enctype="multipart/form-data" >  
                                        <?php $screens = get_screens(); ?>
        <?php
        foreach($screens as $screen) : ?>
                                        <input type="text" class="screenid" name="screensid[]" id="s<?php echo $screen->id; ?>" value="<?php echo $screen->id; ?>"/>
                                        <input type="text" class="screenTop" name="screensTop[]" id="screenTop<?php echo $screen->id; ?>"/>
                                        <input type="text" class="screenLeft" name="screensLeft[]" id="screenLeft<?php echo $screen->id; ?>"/>
             <?php 
            
             endforeach; ?> 
                                     Wall Name:  <input type="text" id="textbox01" name="wallText"><br>   
                                     <input type="submit" value="submit" name="submit" onclick="sWall()"/>Save Wall
<!--                                     <button  type="button" name="saveWw" class="btn btn-primary" onclick="saveWall()">Save Wall</button>-->
                                    <button>Return the top and left position of the p element</button>
                                    </form>
                                </div><!--footer -->
                                
                            </div><!-- /.box -->
                            

                        </div><!--./col-->
                    </div><!--./Row-->

                </section><!-- /.content -->
             </div><!-- ./wrapper -->
            <form name="form1" method="POST" enctype="multipart/form-data" >  
               <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            
           
            <div class="modal-content">
<!--                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Input Form</h4>
                </div>-->
                <div class="modal-body">
<!--                   // Wall Name:  <input type="text" id="textbox1" name="wallText"><br>-->
                    X-Position: <input type="text" id="textbox2" disabled/><br>
                    Y-Position: <input type="text" id="textbox3" disabled/><br>

                    
                </div>
<!--                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" name="wall" class="btn btn-primary" onclick="saveWall()">Save changes</button>
                </div>-->
            </div>
            
        </div>
    </div>
</form>  

<!--             <form>
                     Wall Name:  <input type="text" id="textbox1" name="wallText"><br>
                    X-Position: <input type="text" id="textbox2" disabled/><br>
                    Y-Position: <input type="text" id="textbox3" disabled/><br>
             </form>-->
<?php
	include("footer.php");
        
 
?>
  <script>

    var coordinates = function(element) {
    element = $(element);
    var top = element.position().top;
    var left = element.position().left;
   document.getElementById('textbox2').value=" "+left;
   document.getElementById('textbox3').value=" "+top;
    $('#results').text('X: ' + left + ' ' + 'Y: ' + top);
};
$("#canvas").droppable();

$('.screen').draggable({
    start: function() {
        coordinates('.screen');
    },
    stop: function() {
        coordinates('.screen');
    }
});

function  sWall(){
   
      var scrrenN = document.getElementsByName("screens");
        //alert(scrrenN[0].id);
       
        for (var i=0; i<scrrenN.length; i++){
        var x = $("#"+scrrenN[i].id).position();
       // alert(i +" Top position: " + x.top + " Left position: " + x.left);
        document.getElementById('screenTop'+scrrenN[i].id.toString().substring(6)).value=" "+x.left;
        document.getElementById('screenLeft'+scrrenN[i].id.toString().substring(6)).value=" "+x.top;
        
    }
        
  


}

    

		$(document).ready(function(){
                	$("#devices").sortable();
			$("#canvas").droppable();
			$(".screen").draggable({
				snap: ".screen",
				grid: [3,3],
				containment: "#composer"
			});
			//$("#devices").sortable();
		
		
		});
		
                
                
		$(".rotate").click(function(){
			var w = $(this).parent().width();
			var h = $(this).parent().height();
			$(this).parent().width(h);
			$(this).parent().height(w);
		});
		
		
	
  </script>

             <?php 
 
  if(isset($_POST["submit"])){
      
       $ids = $_POST[screensid];
       $tops = $_POST[screensTop];
       $lefts = $_POST[screensLeft];
        
       for($i=0; $i<count($ids);$i++){
           $sid = $ids[$i];
           $stop = $tops[$i];
           $sleft = $lefts[$i];
        $sql = "UPDATE screens SET X=$sleft,Y=$stop WHERE id=$sid";
         mysqli_query($dbcon,$sql); 
       }
       
 //     if(isset($_POST["saveW"])){
//        $myname = $_POST["wallText"];
//  
//       $myname= mysqli_real_escape_string($dbcon,$myname);
//    $sql = "INSERT INTO walls (name, width, height) VALUES ('$myname', 65, 49)";
//mysqli_query($dbcon,$sql); 
//        if(mysqli_query($dbcon, $sql)){
//    echo "Records inserted successfully.";
//} else{
//    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbcon);
//     }}

}


 ?>
