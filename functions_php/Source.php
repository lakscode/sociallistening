<?php 

include("QueryString.php");
	
include("../db.php");
if($c_date =="")
{
$query = "SELECT site_type, count(*) as site_typecount  FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  group by site_type order by site_typecount desc  limit 0,10";
}
else
{
$query = "SELECT site_type, count(*) as site_typecount  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  group by site_type order by site_typecount desc  limit 0,10";
}

//echo $query;
	$rows=mysql_query($query);
  $num_rows=mysql_num_rows ($rows );

 // $ar_total="";
  $categories="";
$cData="";

//$ar_total = "[";
   while ($row = mysql_fetch_array($rows))
   {
   $site_type=$row['site_type'];
   if($site_type =="")
      $categories .="'Unknown',";  
	  else
     $categories .="'" . ucfirst($row['site_type']) . "',";
  
  $cData .=$row['site_typecount'] . ",";
	//  $ar_total .= "['". $row['site_type'] . "', " . $row['site_typecount'] . "],";
	  }		
   // $ar_total=substr($ar_total, 0, -1);  
	//$ar_total .= "]";
	//echo $ar_total;
	
	$categories=substr($categories, 0, -1);
	$cData=substr($cData, 0, -1);
$categories = "[" . $categories . "]";
$cData = "[" . $cData . "]";
	echo $categories . "~" . $cData ;
	
?>