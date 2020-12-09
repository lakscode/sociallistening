<?php 

include("QueryString.php");
	
include("../db.php");
if($c_date =="")
{
$query = "SELECT sentiment, count(*) as sentimentcount  FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  group by sentiment order by sentimentcount desc  limit 0,10";
}
else
{
$query = "SELECT sentiment, count(*) as sentimentcount  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  group by sentiment order by sentimentcount desc  limit 0,10";
}

//echo $query;
	$rows=$mysql_conn->query($query);
  $num_rows=mysql_num_rows ($rows );

 // $ar_total="";
  $categories="";
$cData="";
$ar_total = "[";
//$ar_total = "[";
   while ($row = $rows->fetch_assoc())
   {
    $senti = "Neutral";
   if($row['sentiment'] == -1)  $senti="Negative";
   if($row['sentiment'] == 1)  $senti="Positive";
	  $ar_total .= "['". $senti . "', " . $row['sentimentcount'] . "],";
	  }	
	  
	  	  
	$ar_total=substr($ar_total, 0, -1);
	$categories=substr($categories, 0, -1);
	$cData=substr($cData, 0, -1);
$categories = "[" . $categories . "]";
$cData = "[" . $cData . "]";
	//echo $categories . "~" . $cData ;
	$ar_total .= "]";
	echo $ar_total;
	
?>