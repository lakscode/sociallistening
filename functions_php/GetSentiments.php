<?php
include("../db.php");
include("CommonFunctions.php");
$where_clause="";
if(isset($_GET['brand']))
{
if($_GET['brand'] != "")
$where_clause=" where brand like '%" .  $_GET['brand'] . "%'";
}
	$searchword_cnt=0;
	$query ="SELECT distinct(brand) FROM brands " . $where_clause;   
$rows=mysql_query($query);
//echo $query;
$competitors="";
while ($row = mysql_fetch_array($rows))
{
   $searchwords_arr[$searchword_cnt]= $row["brand"];
	$searchword_cnt++;
}		

$ar_sub="";
  
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

	$query ="SELECT brandid,keywords FROM brands where brand like '%" . $word . "%'";   
	//echo $query . '<br>';
$rows=mysql_query($query);
$brandids="";
$clauses=array();
while ($row = mysql_fetch_array($rows))
{
$brandids .= $row['brandid'] . ",";

$keywords_arr = explode(", ", $row["keywords"]);
	foreach($keywords_arr AS $key_word)
			{	
			
			$clauses[]="text LIKE '%" .  $key_word . "%'";
			}
			$clause1=implode(' OR ' ,$clauses);
			$clients[]= $clause1;
}
$clause=implode(' OR ' ,$clauses);
$brandids=substr($brandids, 0, -1);  
if($clause != "")
$clause = " and (" . $clause . ")";	

 	
$ar_total = $word . "~" ."[";	
$categories="";
$cData="";

$query ="SELECT DATE_FORMAT(DATE(published),'%Y-%c-%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE  DATE( published ) > CURDATE( ) - INTERVAL 7 DAY " . $clause . " and sentiment = -1    GROUP BY DATE(published) order by pCount desc";  
//echo '<br>' . $query . '<br>';
$rows=mysql_query($query);

$WordCount = array();	
$WordDate = array();	
while ($row = mysql_fetch_array($rows))
{
if($WordCount[$word] < $row['pCount'])
{
$WordCount[$word]=$row['pCount'];
$WordDate[$word]=$row['pDate']; 
}

}

echo  $word . "<i> on</i> " . $WordDate[$word] . ", <i> Total Posts</i>:" . $WordCount[$word] . ' with Negative sentiments ' ;

}
?>