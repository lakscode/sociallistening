<?php 

include("QueryString.php");
	
include("../db.php");
if($c_date =="")
{
$query = "SELECT LEFT(language, 2) as language, count(*) as langcount  FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  group by LEFT(language, 2) order by langcount desc  limit 0,10";
}
else
{
$query = "SELECT LEFT(language, 2) as language, count(*) as langcount  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  group by LEFT(language, 2) order by langcount desc  limit 0,10";
}

//echo $query;
	$rows=$mysql_conn->query($query);
  $num_rows=mysql_num_rows ($rows );

  $ar_total="";
  $categories="";
$cData="";

$ar_total = "[";
   while ($row = $rows->fetch_assoc())
   {
   $lang=$row['language'];
   if($lang =="")
   {
    $ar_total .= "['Unknown', " . $row['langcount'] . "],";
     // $categories .="'Unknown',";  
	  }
	  else
	  {
	   $ar_total .= "['". $row['language'] . "', " . $row['langcount'] . "],";
    // $categories .="'" . $row['language'] . "',";
	 }
  
  //$cData .=$row['langcount'] . ",";
	 
	  }		
   $ar_total=substr($ar_total, 0, -1);  
	$ar_total .= "]";
	echo $ar_total;
	
	/*$categories=substr($categories, 0, -1);
	$cData=substr($cData, 0, -1);
$categories = "[" . $categories . "]";
$cData = "[" . $cData . "]";
	echo $categories . "~" . $cData ; */
	
?>