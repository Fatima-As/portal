<?php
	include('session.php');
	include('init.php');

	$current = 'screens';

	$page = $_GET['page'];
	
	$search = mysql_real_escape_string($_GET['search']);
	$from = mysql_real_escape_string($_GET['from']);
	
	$str = preg_replace("/page=[0-9]+/",'',$_SERVER['QUERY_STRING']);
	
	$query_string = str_replace('&&', '&', $str);
	
	include('header.php');
	
	$whereclause = '';
	
	
	if($whereclause){
		$sql = "select count(*) from screens $whereclause";
	}
	else{
		$sql = "select count(*) from screens";
	}
	$myrs = mysql_query($sql);
    if($row = mysql_fetch_array($myrs)) {
		$total = $row[0];
	}
	if($page == 'showall'){
		$psize = 1000000;
	
	}
	else{
		$psize = 10;
	}
	
	if($page == ''){
		$page = 0;
	}
	$pages = ceil($total / $psize);
	$start = $page * $psize;
	if($total > $psize){
		if($page > 0){
			$nav = " <a href='screens.php?$query_string&page=".($page-1)."'><button type='button' class='btn btn-xs bg-blue'>Previous</button></a> ";
		}
		else{
			$nav .= "<button type='button' class='btn btn-xs'>Previous</button> ";
		}
		$nav .= "Page ".($page+1)." of ".$pages;
		if($page < $pages-1){
			$nav .= " <a href='screens.php?$query_string&page=".($page+1)."'><button type='button' class='btn btn-xs bg-blue'>Next</button></a> ";
		}
		else{
			$nav .= " <button type='button' class='btn btn-xs'>Next</button> ";
		}
	}			
	if($pages > 1){
		$dnav = "&nbsp;&nbsp;&nbsp;Goto Page: <select name='pn' class='selectbox' onChange='javascript:gotopage(this.value);'  style='font-size:14px;'>";
		for($d=0;$d < $pages;$d++){
			$dnav .= "<option value='$d' ";
			$dnav .= ($d == $page)?"selected":"";
			$dnav .= " >".($d+1)."</option>";
			
		}
		$dnav .= "</select>";
		$dnav .= "&nbsp;&nbsp;<a href='screens.php?$query_string&page=showall'><button type='button' class='btn btn-xs bg-blue'>Show All</button></a>&nbsp;&nbsp;";
	}
	elseif($page == 'showall'){
	   if($page=='')
	    $nav ='';
	   else
		$nav = '<a href="screens.php?page=0"><button type="button" class="btn btn-xs bg-blue">Show Pages</button></a>&nbsp;&nbsp;';
	}



$temprow = <<<TEMPROW
				<tr>
					<td>SNO</td>
					<td>SCREEN_NAME</td>
					<td>SCREEN_WIDTH</td>
					<td>SCREEN_HEIGHT</td>
					<td>SCREEN_ORIENTATION</td>
					<td class="options-width">
						<a href="screenedit.php?screenid=SCREEN_ID" title="Edit"><button class="btn btn-info btn-sm">Edit</button></a>
						<button onClick="javascript: confdel('SCREEN_ID');" class="btn btn-danger btn-sm">Delete</button>
					</td>
				</tr>
TEMPROW;

?>
<?php
	include("menu.php");
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Screens
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Screens</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
<?php if($_GET['success'] == 'update'): ?>                        
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> The screen has been updated successfully.
                                    </div>
<?php elseif($_GET['success'] == 'added'): ?>                        
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> The screen has been added successfully.
                                    </div>
<?php elseif($_GET['success'] == 'delete'): ?>                        
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> The screen has been deleted successfully.
                                    </div>
<?php endif; ?>
                        
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Screens</h3>
                                    <div class="box-tools pull-right" >
                                        <div class="input-group" >
        																	<input type="button" value="Add New Screen" class="btn btn-sm btn-default" onclick='window.location = "screenadd.php";' style="width: 150px;" />

                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
    	<p align="right"><?php echo $nav; ?> <?php echo $dnav; ?></p>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Width</th>
                                            <th>Height</th>
                                            <th>Orientation</th>
                                            <th>Actions</th>
                                        </tr>
<?php
	if($whereclause){
		$sql = "select * from screens $whereclause limit $start,$psize";
	}
	else{
		$sql = "select * from screens limit $start,$psize";
	}
	$n = $start;
	$myrs = mysql_query($sql, $dbcon);
	while($row = mysql_fetch_array($myrs)){
		$n++;
		$newrow = $temprow;

		$newrow = str_replace("SNO", $n, $newrow);
		$newrow = str_replace("SCREEN_NAME", $row['name'] , $newrow);
		$newrow = str_replace("SCREEN_WIDTH", $row['width'] , $newrow);
		$newrow = str_replace("SCREEN_HEIGHT", $row['height'] , $newrow); 
		$newrow = str_replace("SCREEN_ORIENTATION", $row['orientation'] , $newrow);
		$newrow = str_replace('SCREEN_ID', $row['id'], $newrow);

		echo $newrow;
	}
?>			
                                        
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
														    	<p align="right"><?php echo $nav; ?> <?php echo $dnav; ?></p>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>



                </section><!-- /.content -->
        </div><!-- ./wrapper -->

<script language="JavaScript">
function gotopage(pg){
	window.location.href = "screens.php?$query_string&page="+pg+"";
}


function confdel(screenid){
	var cf = confirm('Are you sure to delete this screen?');
	if(cf){
		window.location = 'screendel.php?page=<?php echo $page; ?>&screenid=' + screenid;
	}
}
-->
</script>

<?php
	include('footer.php');
?>

