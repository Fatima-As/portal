<?php
	include('session.php');
	include('init.php');


	$current = 'managers';

	$managerid = (int) $_GET['managerid'];

	if( $_POST['cmd']=='passposted'){
		$managerid = $_POST['managerid'];
		$txtusername = $_POST['txtusername'];
		$txtpassword = $_POST['txtpassword'];
		$txtrepassword = $_POST['txtrepassword'];
		if($txtpassword == '') {
			$error="Password is required.";
		}
		elseif($txtrepassword == '') {
			$error="Password Confirmation is required.";
		}
		elseif($txtpassword != $txtrepassword) {
			$error="Password and its confirmation must match.";
		}
		else {					
			$sql = "update managers set
									password = md5(md5(md5('$txtpassword')))
									where
									id = '$managerid'";
							
			mysql_query($sql,$dbcon);
			header("location:managers.php?success=passupdate");
		}
	
	}



	if($_POST['cmd']=='posted'){
		$managerid = $_POST['managerid'];
		$txtusername = $_POST['txtusername'];
		$txtfullname = $_POST['txtfullname'];
		$txtenabled = $_POST['txtenabled'];
		$txtemail = $_POST['txtemail'];

		if($txtusername == '') {
			$error = "Username cannot be left blank.";
		}
		elseif(!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$txtemail) && $txtemail != '') {
			$error = "Invalid Email Address.";
		}
		
		else {
			$sql1 = "select * from managers where username = '$txtusername' and id <> '$managerid'";
			$myrs1 = mysql_query($sql1,$dbcon);
			if(mysql_num_rows($myrs1) > 0) {
				$error = "Username already exists.";
			}
			else {
				$sql = "update managers set 
						username='$txtusername',fullname='$txtfullname',enabled='$txtenabled' ,email = '$txtemail'
						where id = '$managerid'";
				$myrs = mysql_query($sql,$dbcon);
				header ("location:managers.php?success=update");
				exit();
			}
		}
	}
	else {
		$sql = "select * from managers where id = '$managerid'";
		$myrs = mysql_query($sql,$dbcon);
		if ($row = mysql_fetch_array($myrs)) {
			$txtusername = $row['username'];
			$txtfullname = $row['fullname'];
			$txtenabled = $row['enabled'];
			$txtemail = $row['email'];
		}
		else {
			echo "<center>Invalid Manager Selected!<br><a href='managers.php'>Click here to go back.</a></center>";
			exit();
		}
	}
	
	if($txtenabled=='') {
		$txtenabled = 'Yes';
	}

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
                        Managers
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="managers.php"> Managers</a></li>
                        <li class="active">Edit Manager</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
<?php if($error): ?>                        
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo $error; ?>
                                    </div>
<?php endif; ?>

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Edit Manager</h3>
                                </div><!-- /.box-header -->
                                  <form role="form" method="post" action="manageredit.php" enctype="multipart/form-data">
                                  	<input type="hidden" name="cmd" value="posted" />
                                    <input type="hidden" name="managerid" value="<?php echo $managerid; ?>">
                                <div class="box-body">
                                  <!-- text input -->
                                  <div class="form-group">
                                      <label>Username *</label>
                                      <input type="text" class="form-control" style="width:200px;" name="txtusername" required="required" value="<?php echo $txtusername; ?>" />
                                  </div>
                                  <div class="form-group">
                                      <label>Full Name</label>
                                      <input type="text" class="form-control"  name="txtfullname" value="<?php echo $txtfullname; ?>" />
                                  </div>
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" class="form-control"  name="txtemail" value="<?php echo $txtemail; ?>" />
                                  </div>
                                  <div class="form-group">
                                      <label>Enabled</label>
                                        <select name="txtenabled" class="form-control" required="required" style="width:200px;">
                                        	<option value="Yes" <?php echo ($txtenabled == 'Yes')?'selected="selected"':''; ?> >Yes</option>
                                        	<option value="No" <?php echo ($txtenabled == 'No')?'selected="selected"':''; ?> >No</option>
                                        </select>
                                  </div>


                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                  </form>
                            </div><!-- /.box -->

                        </div>
                    </div>

										<a name="pass"></a>
                    <div class="row">
                        <div class="col-xs-12">
<?php if($error): ?>                        
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <?php echo $error; ?>
                                    </div>
<?php endif; ?>

                            <!-- general form elements disabled -->
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h3 class="box-title">Change Password</h3>
                                </div><!-- /.box-header -->
                                  <form role="form" method="post" action="manageredit.php#pass" enctype="multipart/form-data">
                                    <input type="hidden" name="cmd" value="passposted">
                                    <input type="hidden" name="managerid" value="<?php echo $managerid; ?>">
                                    <input type="hidden" name="txtusername" value="<?php echo $txtusername; ?>">
                                <div class="box-body">
                                  <!-- text input -->
                                  <div class="form-group">
                                      <label>Password *</label>
                                      <input type="password" class="form-control" style="width:200px;" name="txtpassword"  required="required" />
                                  </div>
                                  <div class="form-group">
                                      <label>Re-enter Password *</label>
                                      <input type="password" class="form-control" style="width:200px;" name="txtrepassword" required="required" />
                                  </div>

                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                  </form>
                            </div><!-- /.box -->

                        </div>
                    </div>

                </section><!-- /.content -->
        </div><!-- ./wrapper -->

<?php
	include("footer.php");

?>