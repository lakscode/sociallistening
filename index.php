<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>V-Listen</title>
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/login.css">

  </head>
	<?php 
	error_reporting(0); 
	session_start(); ?>
	<?php include("db.php"); ?>
	<?php 
	$_SESSION['userid']=""; 
	$_SESSION['username']=""; 
	$_SESSION['usergroupid']=""; 
	?>

  <body>


    <div class="wrapper">
	<div class="container">
		<h1>V-Listen</h1>

		<form class="form" method="post">
			<input type="text" placeholder="Username" name="txtname" id="txtname" >
			<input type="password" placeholder="Password" name="txtpass" id="txtpass">
			<!-- <button type="submit" id="login-button">Login</button> -->
			<input name="submit" type="submit" id="submit" value="Login" class="bg-button" />
		<!--	<input name="register" type="button" id="register" value="Register" class="bg-button" /> -->
		</form>
		<?php
			if(isset($_POST['submit'])){
			//echo '<script>alert("Here... ")</script>';
				$i=0;
				$txtname=$_POST['txtname'];
				$txtpass=$_POST['txtpass'];
				$query="SELECT * from users where status =1 and username='" . $txtname . "' and password='" . $txtpass . "'";
				$query="SELECT u.*, ug.usergroupid from users u, user_group_mapping ugm, usergroup ug where status =1 and username='" . $txtname . "' and password='" . $txtpass . "' and u.userid=ugm.userid and ugm.usergroupid= ug.usergroupid";
				echo $query;
				$result=$mysql_conn->query($query);
				
			//	echo $result;
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$i++;
						$_SESSION['userid']=$row['userid'];						
						$_SESSION['username']=$row['username'];
						$_SESSION['firstname']=$row['firstname'];
						$_SESSION['rolesid']=$row['rolesid'];
						$_SESSION['usergroupid']=$row['usergroupid'];
						echo '<script>window.location.href="home.php";</script>';
					}
				}
				if($i==0){
					echo 'Check for credentials';
				}
			}
			if(isset($_POST['register'])){
				//echo '<script>alert("Here... ")</script>';
				$txtname=$_POST['txtname'];
				$txtpass=$_POST['txtpass'];
				if($txtname=="" || $txtpass==""){
					echo 'Please enter valid credentials to register';
				}else{
				$query="SELECT * from users where status =1 and username='" . $txtname . "' and password='" . $txtpass . "'";
				$result=$mysql_conn->query($query);
				if($result->num_rows > 0){
					while($row=$result->fetch_assoc()){
					
					}
					}
					$userRole=1;// for now default to zero (active status)
					//$userStatus=1;// for now default to one for active, not required to send as database default is one
					$userFirstName=$txtname;// for now use same userid
					$userCreated_at=date('Y-m-d H:i:s');
					$query="INSERT INTO users (username, password, firstname, created, role) VALUES ('$txtname','$txtpass','$userFirstName','$userCreated_at',$userRole)";
					//echo $query;
					$mysql_conn->query($query) or die("No connection is there".mysql_error());
					echo 'Registered successfully';
					//if(mysql_errno()){echo 'Registered successfully';}
				}
			}
		?>
	</div>

	<ul class="bg-bubbles">
		<li><img width="100%" src='images/icons/twitter.png' /></li>
		<li><img width="100%" src='images/icons/bloggr.png' /></li>
		<li><img width="100%" src='images/icons/google-plus.png' /></li>
		<li><img width="100%" src='images/icons/youtube.png' /></li>
		<li><img width="100%" src='images/icons/news.png' /></li>
		<li><img width="100%" src='images/icons/google-plus.png' /></li>
		<li><img width="100%" src='images/icons/bloggr.png' /></li>
		<li><img width="100%" src='images/icons/twitter.png' /></li>
		<li><img width="100%" src='images/icons/youtube.png' /></li>
		<li><img width="100%" src='images/icons/news.png' /></li>
	</ul> 
</div>
    <script src='js/jquery-1.9.1.min.js'></script>





  </body>
</html>
