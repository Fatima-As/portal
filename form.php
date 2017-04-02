<?php
	//include('session.php');
	//include('init.php');
include('dbinc.php');
	$current = 'walls';
	//$page = $_GET['page'];

	include('header.php');
        
?>
    <html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> <!--position-->
<script type="text/javascript" src="bootstrap/js/jquery.js"></script><!--for confirm.-->
<script type="text/javascript" src="bootstrap/js/bootstrap-tooltip.js"></script><!--for confirm.-->
<script type="text/javascript" src="bootstrap/js/bootstrap-confirmation.js"></script><!--for confirm.-->
    <!-- for dialog modal-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"  ></script>  
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js" ></script>   
    <link rel="stylesheet" id="themeStyles" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"/> 
     
               <form name="form1" method="post" enctype="multipart/form-data" >  
               <!-- Modal -->
   
      
            
           
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Input Form</h4>
                </div>
                <div class="modal-body">
                    Wall Name:  <input type="textbox" id="textbox1" name="wallText"><br>
                    X-Position: <input type="textbox" id="textbox2"/><br>
                    Y-Position: <input type="textbox" id="textbox3" /><br>

                    
                </div>
               
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveWall()">Save changes</button>
               
            
            
       
   
</form>
 <script>
function saveWall(){   
       <?php
     if(isset($_POST['wallText'])){
        $myname = $_POST['wallText'];}
  
       $myname= mysqli_real_escape_string($myname);
   
    $sql = "INSERT INTO walls (name, width, height) VALUES ('$myname', 65, 49)";
mysqli_query($dbcon,$sql); 
        if(mysqli_query($dbcon, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dbcon);
}?>
        
        }
        </script>
    </html>