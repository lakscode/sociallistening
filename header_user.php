<div style="float:right; width:20%;margin-right:1%;height:100%">
<img src='images/user.png' id="show" style='margin-top:30%;width:50%;' />
</div>

<div id="divUser" class='divNotify'>  
<?php
include("db.php");
$query="SELECT * from roles where rolesid='" . $_SESSION['rolesid'] ."'";
			//	echo $query;
				$rolename="";
				$result=mysql_query($query);

					while($row=mysql_fetch_array($result)){
					//print_r($row);
						$rolename=$row['rolename'];	
						}
					//echo $rolename;

?>
     <p><strong><?php echo ucfirst($_SESSION['firstname']);?></strong> logged in as <b><em><?php echo ucfirst($rolename);?></em></b></p>
     <a href="#" onclick="functLogout()">Logout	</a>
</div> 