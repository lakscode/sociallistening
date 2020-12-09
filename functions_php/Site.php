<?php 

include("QueryString.php");
	
include("../db.php");
if($c_date =="")
{
$query = "SELECT site, count(*) as sitecount  FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  group by site order by sitecount desc  limit 0,10";
}
else
{
$query = "SELECT site, count(*) as sitecount  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  group by site order by sitecount desc  limit 0,10";
}

//echo $query;

	$rows=mysql_query($query);
  $num_rows=mysql_num_rows ($rows );
//echo 'Title:Site Trend~';
  $ar_total="";
$ar_total = "[";
$categories="";
$cData="";
   while ($row = mysql_fetch_array($rows))
   {
   $lang=$row['site'];
   if($lang =="")
      $categories .="'twitter.com',";  
	  else
     $categories .="'" . $row['site'] . "',";
	 
	 
  // $categories .="'" . $row['site'] . "',";
   $cData .=$row['sitecount'] . ",";
	  $ar_total .= '["'. $row['site'] . '", ' . $row['sitecount'] . '],';
	  }		
    $ar_total=substr($ar_total, 0, -1);  
	$ar_total .= "]";
	$categories=substr($categories, 0, -1);
	$cData=substr($cData, 0, -1);
$categories = "[" . $categories . "]";
$cData = "[" . $cData . "]";
	echo $categories . "~" . $cData ;
?>