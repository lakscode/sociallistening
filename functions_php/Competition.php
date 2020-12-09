<?php 
include("../db.php");
include("CommonFunctions.php");
	$searchword_cnt=0;
	$query ="SELECT distinct(brand) FROM brands where active=1"; 
$rows=mysql_query($query);
//echo $query;
$competitors="";
while ($row = mysql_fetch_array($rows))
{
$competitors .= $row["brand"] . ", ";
 $searchwords_arr[$searchword_cnt]= $row["brand"];
	$searchword_cnt++;
}		
$competitors=substr($competitors, 0, -1); 


$ar_sub="";
 
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

	$query ="SELECT keywords FROM brands where brand like '%" . $word . "%'"; 
$rows=mysql_query($query);
$competitors="";
$clauses=array();
while ($row = mysql_fetch_array($rows))
{
$keywords_arr = explode(", ", $row["keywords"]);
	foreach($keywords_arr AS $key_word)
	{	
	
	$clauses[]="text LIKE '%" .  $key_word . "%'";
	}
}
$clause=implode(' OR ' ,$clauses);

if($clause != "")
$clause = " and (" . $clause . ")";	

 	
$ar_total = $word . "~" ."[";	
$categories="";
$cData="";
if($_SESSION['fixed_data'] == "")
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 7 DAY " . $clause . " and brandid in (select brandid from brands where brand like '%" . $word ."%') GROUP BY DATE(pDate) order by published"; 
}
else
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE " . $_SESSION['fixed_data'] . $clause . " and brandid in (select brandid from brands where brand like '%" . $word ."%') GROUP BY DATE(pDate) order by published"; 
}
$rows=mysql_query($query);
	//echo $query . '<br>';
while ($row = mysql_fetch_array($rows))
{
 $ar_total .= "[Date.UTC(". ConvertDate($row['pDate']) . "), " . $row['pCount'] . "],";
}		
//echo $ar_total;
$ar_total=substr($ar_total, 0, -1); 
if($ar_total == $word . "~")
{
$created_at = date("Y,n,d", strtotime("-1 month"));
$ar_total = $word . "~" . "[[Date.UTC(" . $created_at . "),0]";
}

$ar_sub .=$ar_total . "]~";
$ar_total = "";
}
$ar_sub=substr($ar_sub, 0, -1); 
echo $ar_sub;

?>
