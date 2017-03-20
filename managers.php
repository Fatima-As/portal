<?php
	include("init.php");
	include("session.php");

	$current = 'managers';


	
$temprow = <<<TEMPROW
				<tr>
					<td>SNO</td>
					<td>USERNAME</td>
					<td>FULLNAME</td>
					<td>EMAIL</td>
					<td>
						<a href="manageredit.php?managerid=USERID" title="Edit"><button class="btn btn-info btn-sm">Edit</button></a>
						<button onClick="javascript: confdel('USERID');" class="btn btn-danger btn-sm">Delete</button>
					</td>
				</tr>
TEMPROW;
	
	include("header.php");
	
?>
<?php
	include("menu.php");
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Managers
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Managers</li>
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
                                        <b>Success!</b> The manager has been updated successfully.
                                    </div>
<?php elseif($_GET['success'] == 'passupdate'): ?>                        
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> The password has been changed successfully.
                                    </div>
<?php elseif($_GET['success'] == 'added'): ?>                        
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> The manager has been added successfully.
                                    </div>
<?php elseif($_GET['success'] == 'delete'): ?>                        
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Success!</b> The manager has been deleted successfully.
                                    </div>
<?php endif; ?>
                        
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Managers</h3>
                                    <div class="box-tools pull-right" >
                                        <div class="input-group" >
        																	<input type="button" value="Add New Manager" class="btn btn-sm btn-default" onclick='window.location = "manageradd.php";' style="width: 150px;" />

                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
<?php
	$sql = "select * from managers";
	$n = $start;
	$myrs = mysql_query($sql, $dbcon);
	while($row = mysql_fetch_array($myrs)){
		$n++;
		$newrow = $temprow;

		$newrow = str_replace("SNO", $n, $newrow);
		$newrow = str_replace("USERNAME", $row['username'] , $newrow);
		$newrow = str_replace("FULLNAME", $row['fullname'] , $newrow);
		$newrow = str_replace("EMAIL", $row['email'], $newrow);
		$newrow = str_replace('USERID', $row['id'], $newrow);

		echo $newrow;
	}
?>			
                                        
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>



                </section><!-- /.content -->
        </div><!-- ./wrapper -->

<script language="JavaScript">
<!--
function confdel(managerid){
	var cf = confirm('Are you sure to delete this Manager?');
	if(cf){
		window.location = 'managerdel.php?managerid=' + managerid;
	}
}
-->
</script>

<?php
	include("footer.php");

?>