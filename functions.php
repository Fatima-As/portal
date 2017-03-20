<?php

	function format_date($time, $full = false){
		if($full){
			return date("Ymd H:i:s", $time);
		}
		else{
			return date("Ymd", $time);
		}
	}

	function ymd2dmy($date){
		$dt = explode('-', $date);
		$year = $dt[0];
		$month = $dt[1];
		$day = $dt[2];
		$newdate = $day . '-' . $month . '-' . $year;
		return $newdate;
	}

	function dmy2ymd($date){
		$dt = explode('-', $date);
		$year = $dt[2];
		$month = $dt[1];
		$day = $dt[0];
		$newdate = $year . '-' . $month . '-' . $day;
		return $newdate;
	}

	function getrealpath($path){
		$real_path = realpath ($path);
		global $HTTP_ENV_VARS;
		if(	$HTTP_ENV_VARS["OS"] == 'Windows_NT'){
			$real_path = str_replace("\\","\\\\",$real_path);
			$real_path .= "\\\\";
		}
		else{
			$real_path .= "/";
		}
		return $real_path;		
	}

 	
	function get_manager_fullname($managerid){
		global $dbcon;
		$sql = "select fullname from managers where id = '$managerid'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return $row['fullname' ];
		}
		else{
			return false;
		}
	}
	
	function get_mailinglist_title($mailinglistid){
		global $dbcon;
		$sql = "select title from mailinglists where id = '$mailinglistid'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return $row['title' ];
		}
		else{
			return false;
		}
	}
	
	
	
	function get_user_fullname($user_id){
		global $dbcon;
		$sql = "select firstname, lastname from users where id = '$user_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return trim($row['firstname' ] . ' ' . $row['lastname']);
		}
		else{
			return false;
		}
	}
	
	function get_screens(){
		global $dbcon;
		$screens = array();
		$sql = "select * from screens order by name";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_assoc($myrs)){
			$screens[] = (object) $row;
		}
		return $screens;
	}

	function get_banner_sizes(){
		global $dbcon;
		$bannersizes = array();
		$sql = "select * from bannersizes order by bannersize";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_assoc($myrs)){
			$bannersizes[] = $row['bannersize'];
		}
		return $bannersizes;
	}

	function get_user_subscriptions($userid){
		global $dbcon;
		$subscriptions = array();
		$sql = "select categoryid from subscriptions where userid = '$userid'";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_assoc($myrs)){
			$subscriptions[] = $row['categoryid'];
		}
		return $subscriptions;
	}
	
	
	function get_category_name($category_id){
		global $dbcon;
		$sql = "select name from categories where id = '$category_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return $row['name'];
		}
		else{
			return false;
		}
	}

	function get_article_title($article_id){
		global $dbcon;
		$sql = "select title from articles where id = '$article_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return $row['title'];
		}
		else{
			return false;
		}
	}
	
	function gen_article_key($title){
		global $dbcon;
		
		$urlkey = preg_replace('/[^a-zA-Z0-9\']/', '-', $title);
		$urlkey = str_replace("'", '', $urlkey);
		$urlkey = strtolower($urlkey);

		$sql = "select count(*) from articles where urlkey = '$urlkey'";
		$myrs = mysqli_query($sql,$dbcon);
		if($row = mysqli_fetch_array($myrs)){
			$rc = $row[0];
		}
		mysqli_free_result($myrs);
		if($rc > 0){
			$urlkey = $urlkey."-".$rc;
		}
		return $urlkey;
	}

	function gen_news_key($title){
		global $dbcon;
		
		$urlkey = preg_replace('/[^a-zA-Z0-9\']/', '-', $title);
		$urlkey = str_replace("'", '', $urlkey);
		$urlkey = strtolower($urlkey);

		$sql = "select count(*) from news where urlkey = '$urlkey'";
		$myrs = mysqli_query($sql,$dbcon);
		if($row = mysqli_fetch_array($myrs)){
			$rc = $row[0];
		}
		mysqli_free_result($myrs);
		if($rc > 0){
			$urlkey = $urlkey."-".$rc;
		}
		return $urlkey;
	}

	function gen_category_key($category, $category_id){
		global $dbcon;
		
		$urlkey = preg_replace('/[^a-zA-Z0-9\']/', '-', $category);
		$urlkey = str_replace("'", '', $urlkey);
		$urlkey = strtolower($urlkey);

		$sql = "select count(*) from categories where urlkey = '$urlkey'";
		$myrs = mysqli_query($sql,$dbcon);
		if($row = mysqli_fetch_array($myrs)){
			$rc = $row[0];
		}
		mysqli_free_result($myrs);
		if($rc > 0){
			$urlkey = $urlkey."-".$rc;
		}
		return $urlkey;
	}


	function gen_urlkey($title){
		$urlkey = preg_replace('/[^a-zA-Z0-9\']/', '-', $title);
		$urlkey = str_replace("'", '', $urlkey);
		$urlkey = strtolower($urlkey);
		return $urlkey;
	}



	function get_subcategory_count($category_id){
		global $dbcon;
		$subcats = 0;
		$sql = "select count(*) as subcats from categories where parentid = '$category_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			$subcats = $row['subcats'];
		}
		return $subcats;
	}

function get_submenu_count($menu_id){
		global $dbcon;
		$submenus = 0;
		$sql = "select count(*) as submenus from menus where parentid = '$menu_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			$submenus = $row['submenus'];
		}
		return $submenus;
	}

function get_menu_title($menu_id){
		global $dbcon;
		$sql = "select title from menus where id = '$menu_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return $row['title'];
		}
		else{
			return false;
		}
	}

	function get_article_count($category_id){
		global $dbcon;
		$nums = 0;
		$sql = "select count(*) as nums from articles where category_id = '$category_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			$nums = $row['nums'];
		}
		return $nums;
	}


	function getparent($id = 0){
		if($id == 0){
			echo "<a href='categories.php'>Main</a>";
			return;
		}
		else{
			global $dbcon;
			$sql = "select * from categories where id='$id'";
			$myrs = mysqli_query($sql, $dbcon);
			if($row = mysqli_fetch_assoc($myrs)){
				$pid = $row['parentid'];
				getparent($pid)	;
				echo "&nbsp;&nbsp;>&nbsp;&nbsp;"."<a href='categories.php?categoryid=".$row['id']."'>".$row['name']."</a>";
			}
		}
	}

	function get_menu_scrumm($id = 0){
		if($id == 0){
			echo "<a href='menus.php'>Main</a>";
			return;
		}
		else{
			global $dbcon;
			$sql = "select * from menus where id='$id'";
			$myrs = mysqli_query($sql, $dbcon);
			if($row = mysqli_fetch_assoc($myrs)){
				$pid = $row['parentid'];
				get_menu_scrumm($pid)	;
				echo "&nbsp;&nbsp;>&nbsp;&nbsp;"."<a href='menus.php?menuid=".$row['id']."'>".$row['title']."</a>";
			}
		}
	}


	function get_categories_options($selectedid, $category_id = 0){
		global $dbcon;
		$categories = array();
		$sql = "select * from categories where status = 'Enabled' and parentid = '$category_id'";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_assoc($myrs)){
			
			$option =  '<option value="' . $row['id'] . '"';
			if($row['id'] == $selectedid){
				$option .= ' selected="selected" ';
			}
			$option .= '>' . str_pad('', 4 * ($row['levelid'] - 1), "-", STR_PAD_LEFT) . $row['name'] . '</option>
			';
		
			echo $option;
			get_categories_options($selectedid, $row['id']);
		}
	}

	function get_categories_tree($selectedid, $category_id = 0){
		global $dbcon;
		
		$sql = "select * from categories where status = 'Enabled' and parentid = '$category_id'";
		$myrs = mysqli_query($sql, $dbcon);
		echo "<ul>\r\n";
		while($row = mysqli_fetch_assoc($myrs)){
			
			$item =  '<li>' . $row['name'] . '</li>
			';
		
			echo $item;
			get_categories_options($selectedid, $row['id']);
		}
		echo "</ul>\r\n";
	}

	function get_categories_tree_array($category_id = 0){
		global $dbcon;
		$categories = array();
		$sql = "select * from categories where status = 'Enabled' and parentid = '$category_id'";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_assoc($myrs)){
			$category['id'] = $row['id'];
			$category['name'] = $row['name'];
			$subcategories = get_categories_tree($row['id']);
			if(count($subcategories) > 0){
				$category['categories'] = $subcategories;
			}
			$categories[] = $category;			
		}
		if(count($categories))
			return $categories;
	}



	
	function get_project($project_id){
		global $dbcon;
		$sql = "select * from projects where id = '$project_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return (object) $row;
		}
		else{
			return false;
		}
	}

	function get_sources($sourceid){
		global $dbcon;
		
		$sql = "select * from sources where id =". $sourceid;
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return (object) $row;
		}
		else{
			return false;
		}
	}


	function get_sources_detail(){
		global $dbcon;
		
		$sources = array();
		$sql = "select * from sources";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_array($myrs)){
			$sources[] = $row;
		}
		return $sources;
	}

	function get_categories_list(){
		global $dbcon;
		
		$categories = array();
		$sql = "select * from categories where status = 'Enabled'";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_array($myrs)){
			$categories[] = $row;
		}
		return $categories;
	}

	function get_recall_categories($recallid){
		global $dbcon;
		
		$categories = array();
		$sql = "select categoryid from recallcategories where recallid =".$recallid;
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_array($myrs)){
			$categories[] = $row;
		}
		return $categories;
	}

	
	function get_authors(){
		global $dbcon;
		
		$authors = array();
		$sql = "select id, firstname, lastname, username from users where status = 'Active'";
		$myrs = mysqli_query($sql, $dbcon);
		while($row = mysqli_fetch_assoc($myrs)){
			$authors[] = (object) $row;
		}
		return $authors;
	}
	
	
	function check_password($username, $password){
		global $dbcon;
		$sql = "select id from users where password = md5(md5(md5('$password'))) and username = '$username' ";
		$myrs = mysqli_query($dbcon, $sql);
		if($row = mysqli_fetch_assoc($myrs)){
			return $row['id'];
		}
		else{
			return false;
		}
	}
	

	function get_user($user_id){
		global $dbcon;
		$sql = "select * from users where id = '$user_id'";
		$myrs = mysqli_query($sql, $dbcon);
		if($row = mysqli_fetch_assoc($myrs)){
			return (object) $row;
		}
		else{
			return false;
		}
	}


	function gen_username($projectid){
		global $dbcon;
		
		$sql = "select code, usercount from projects where id = '$projectid'";
		$myrs = mysqli_query($sql, $dbcon);
		
		if($row = mysqli_fetch_assoc($myrs)){
			$projectcode = $row['code'];
			$usercount = (int) $row['usercount'];
		}
		else{
			$projectcode = '';
		}

		if($projectcode){
			$usercount++;
			
			$sql = "update projects set usercount = '$usercount' where id = '$projectid'";
			mysqli_query($sql, $dbcon);
			
			$username = strtolower($projectcode) . sprintf("%03d", $usercount);
			
			$sql = "select id from users where username = '$username'";
			$myrs = mysqli_query($sql, $dbcon);
			
			if(mysqli_num_rows($myrs) > 0){
				$username = gen_username($projectid);
			}
			
			return $username;
		}
		else{
			return false;
		}
	}
	
	function gen_password(){
		$password = '';
		
		$chrs = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789";
		
		for($i = 0; $i < 8; $i++){
			$password .= substr($chrs, rand(0, strlen($chrs) - 1), 1);
		}
		return $password;
	}
	
	function send_newuser_email($userid, $password){
		global $dbcon;
		
		$user = get_user($userid);
		
		if($user){
			
			$subject = "Welcome to ON Project Management";
			
			$to = $user->fullname . "<" . $user->email . ">";
			
			$from = $from_name . "<" . $from_email . ">";
			
			include("emailtemplates.php");
			
			if($user->usertype == 'IPPM'){
				$body = $ippmemailtemplate;
			}
			else{
				$body = $staffemailtemplate;
			}

			$body = str_replace('USER_USERNAME', $user->username, $body);
			$body = str_replace('USER_PASSWORD', $password, $body);
			$body = str_replace('USER_FULLNAME', $user->fullname, $body);

			mail($to, $subject, $body, $headers);

		}
		
	}
	
	function hours_minutes($seconds){
		$hrs =  floor($seconds / 3600);
		$mins = floor(($seconds - ($hrs * 3600)) / 60) ;
		return sprintf("%02d", $hrs) . ':' . sprintf("%02d", $mins);
	}
	

	function currency_sign($currency){
		$signs = array(
			'USD' => '$',
			'GBP' => '&pound;',
			'CAD' => 'CAD',
			'EUR' => '&euro;'
		);
		return $signs[$currency];
	}
	
	function decimal_hours($seconds){
		$hrs =  floor($seconds / 3600);
		$mins = floor(($seconds - ($hrs * 3600)) / 60) ;
		return $hrs + ($mins / 60) ;
	}
?>