
<?php 
include("../db.php");
$where_clause="";
if(isset($_GET['brand']))
{
if($_GET['brand'] != "")
$where_clause=" where brand like '%" .  $_GET['brand'] . "%'";
}
	$searchword_cnt=0;
	$query ="SELECT distinct(brand) FROM brands " . $where_clause;   
$rows=$mysql_conn->query($query);
echo $query;
$competitors="";
while ($row = $rows->fetch_assoc())
{
   $searchwords_arr[$searchword_cnt]= $row["brand"];
	$searchword_cnt++;
}		



$ar_sub="";
  
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

	$query ="SELECT brandid,keywords FROM brands where brand like '%" . $word . "%'";   
	echo $query;
$rows=$mysql_conn->query($query);
$brandids="";
$clauses=array();
while ($row = $rows->fetch_assoc())
{
$brandids .= $row['brandid'] . ",";
	$clauses[]="text LIKE '% " . mysql_real_escape_string($row["keywords"]) . " %'";
	$clauses[]="text LIKE '" . mysql_real_escape_string($row["keywords"]) . " %'";	
	$clauses[]="text LIKE '% " . mysql_real_escape_string($row["keywords"]) . "'";		
    $clauses[]="text LIKE '%@" . mysql_real_escape_string($row["keywords"]) . " %'";
	$clauses[]="text LIKE '%#" . mysql_real_escape_string($row["keywords"]) . " %'";
}
$clause=implode(' OR ' ,$clauses);
$brandids=substr($brandids, 0, -1);  
if($clause != "")
$clause = " and (" . $clause . ")";	

 	
$ar_total = $word . "~" ."[";	
$categories="";
$cData="";

$query ="SELECT DATE_FORMAT(DATE(published),'%Y-%c-%d')   as pDate, COUNT(*) as pCount FROM listeningdata WHERE  DATE( published ) > CURDATE( ) - INTERVAL 7 DAY " . $clause . " and sentiment = -1    GROUP BY DATE(published) order by pCount desc";  

$rows=$mysql_conn->query($query);
	echo $query;
$WordCount = array();	
$WordDate = array();	
while ($row = $rows->fetch_assoc())
{
if($WordCount[$word] < $row['pCount'])
{
$WordCount[$word]=$row['pCount'];
$WordDate[$word]=$row['pDate']; 
}

}		
if($x %2 == 0)
$dir="left";
else
$dir="right";
echo '<p class="triangle-border ' . $dir . '">' . $word . "<i> on</i> " . $WordDate[$word] . ", <i> Total Posts</i>:" . $WordCount[$word] ;
$ignorewords = file_get_contents('sentiment/ignorewords.txt', true);
$ignorewords_arr = explode(",", $ignorewords);

//// Finished finding which is the peak date and number of post **************************/

$query="SELECT text FROM `listeningdata` where DATE(published) = DATE('" . $WordDate[$word] ."') and brandid in (" . $brandids . ") and text like '%" . $word ."%'";

//	echo $query . '<br>';
$results = $mysql_conn->query($query);

$WordCount = array();

while ($Messages = mysql_fetch_array($results))
{
$count=0;
	$Words = explode(' ',$Messages["text"]);
	foreach($Words AS $word1)
	{	
	
	$word1 = preg_replace("/[^ \w]+/", "", $word1);
			$word1 = preg_replace("/^[0-9]+/", "", $word1);
			$word1=strtolower(trim($word1));
			if($word1!= "")
			{
				if (in_array(strtolower($word1), $ignorewords_arr) != false)
				{
				$count++;
				}
				else if(strlower($word1) == strlower($word))
				{
				}
				else if(strlen($word1) <= 2)
				{
				
				}
				else
				{
					$WordCount[$word1]++;
				}
			
			}

	}
	
	//echo 'Count' . $count . '<br>';
}

arsort($WordCount);
//print_r($WordCount);
$iCnt = 0;
echo '<br><i>Trending Words</i> : ';
foreach($WordCount AS $field=>$value)
{

 
$created_at = date("Y/m/d",strtotime($WordDate[$word]));

echo '<a href="#" onclick="getInsights(\''.  $created_at . '\', \'' .  $field . '\',\''. $word . '\')">' . $field  . "</a>:" . $value . ", ";
	$iCnt++;
	if ($iCnt >= 4) break;
}

echo '</p>';
$clauses=array();
$words=array();
$querystring="";
$iCnt=0;
foreach($WordCount AS $field=>$value)
{
$words[] = $field;
	$clauses[]=" text LIKE '% " . mysql_real_escape_string($part) . " %'";
	$clauses[]=" text LIKE '" . mysql_real_escape_string($part) . " %'";	
	$clauses[]=" text LIKE '% " . mysql_real_escape_string($part) . "'";	
    $clauses[]=" text LIKE '%#" . mysql_real_escape_string($part) . " %'";
    $clauses[]=" text LIKE '%@" . mysql_real_escape_string($part) . " %'";	
	
	$iCnt++;
	if ($iCnt > 2) break;
}
$clause=implode(' AND ' ,$clauses);

if($clause != "")
$clause = " and (" . $clause . ")";

}
?>


