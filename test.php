<?php
 include("db.php");

  $cntr=1;
  $query="select rolesid, rolename from roles ";
  //echo $query;
  $rows=$mysql_conn->query($query);
$context="";
if(mysql_num_rows($rows) > 0) {
	#start the list
	echo '<ul>';
	while ($row = $rows->fetch_assoc())
{
		#print the item, you can also make links out of these
		echo '<li id="child_node_1_' . $row['rolesid'] .'">'.$row['rolename'];
		#recursive function(made in next step) for getting all the subs by passing id of main item
		get_children($row['rolesid'], 1);
		echo '</li>';
	}
	#end the list
	echo '</ul>';
}
#some message if the database is empty
else echo 'No Items';

function get_children($parent, $level = 1) {
$query="select * from role_functions where roles_id=" .(int)$parent;
//echo $query;
	$result = $mysql_conn->query($query);
	
	#for avoiding some errors
	if(mysql_num_rows($result) > 0) {
		#start the list
		echo '<ul>';
		while ($row = $result->fetch_assoc())
{
			#print the item, you can also make links out of these
			echo '<li id="child_node_2_' . $row['rf_id'] .'">' . $row['rf_name'];
			#this is similar to our last code
			#this function calls it self, so its recursive
			get_children1($row['rf_id'], 2);
			echo '</li>';
		}
		#close the list
		echo '</ul>';
	}
}

function get_children1($parent, $level = 2) {
$query="select * from role_functions_keywords where  rf_id=" .(int)$parent;
//echo $query;
	$result = $mysql_conn->query($query);

	#for avoiding some errors
	if(mysql_num_rows($result) > 0) {
		#start the list
		echo '<ul>';
		while ($row = $result->fetch_assoc())
		{
			#print the item, you can also make links out of these
			echo '<li id="child_node_3_' . $row['keywordsid'] .'">'.$row['keywordsName'];
			#this is similar to our last code
			#this function calls it self, so its recursive
			get_children2($row['keywordsid'], 3);
			echo '</li>';
		}
		#close the list
		echo '</ul>';
	}
}

function get_children2($parent, $level = 3) {
$query="select * from role_functions_keywords_set where keywordsid=" .(int)$parent;
//echo $query;
	$result = $mysql_conn->query($query);

	#for avoiding some errors
	if(mysql_num_rows($result) > 0) {
		#start the list
		echo '<ul>';
		while ($row = $result->fetch_assoc())
{
			#print the item, you can also make links out of these
			echo '<li id="child_node_4_' . $row['keywordsSetID'] .'">'. $row['keywordsSetName'].'</li>';
			#this is similar to our last code
			#this function calls it self, so its recursive
			//get_children($row['keywordsSetid'], $level+1);
		}
		#close the list
		echo '</ul>';
	}
}




?>