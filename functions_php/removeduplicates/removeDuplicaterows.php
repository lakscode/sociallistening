<?php
ini_set('max_execution_time', 600); //300 seconds = 5 minutes

include("../../db.php");
$cntr=1;
    $result=$mysql_conn->query("select id,text,author,link,published,count(*) from listeningdata group by text,author,link,published having count(*)>1");
    while($row=$result->fetch_assoc()){
	echo $cntr . '<br>';
print_r($row);
echo '<br>';
       $cntr++;
	   $sql="delete from listeningdata where id=" . $row['id'] ;
	   $mysql_conn->query($sql);
    }
	echo 'finished';
?>