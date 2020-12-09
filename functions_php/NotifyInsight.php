
<?php
include("../db.php");

$searchword_cnt=0;
// Newly added
$notify_insight_date=0;
$total_posts=0;
$where_clause="";
if(isset($_GET['brand'])){
	if($_GET['brand'] != "")
	$where_clause=" WHERE brand like '%".  $_GET['brand'] ."%'";
}

$query ="SELECT distinct(brand) FROM brands "; // . $where_clause;
$rows=$mysql_conn->query($query);
//echo $query;
$competitors="";
while ($row = $rows->fetch_assoc())
{
   $searchwords_arr[$searchword_cnt]= $row["brand"];
	$searchword_cnt++;
}



$ar_sub="";

for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];
$clause ="";
$query ="SELECT brandid,keywords FROM brands where brand like '%" . $word . "%'";

//	echo '<br>' . $query . '<br>';
$rows=$mysql_conn->query($query);


$brandids="";
$clauses=array();
$clients=array();
while ($row = $rows->fetch_assoc())
{
//print_r($row);
$brandids .= $row['brandid'] . ",";
	$keywords_arr = explode(", ", $row["keywords"]);
	foreach($keywords_arr AS $key_word)
			{	
			
			$clauses[]="text LIKE '%" .  $key_word . "%'";
			}
			$clause1=implode(' OR ' ,$clauses);
			$clients[]= $clause1;
}
$clause1=implode(' OR ' ,$clients);
$brandids=substr($brandids, 0, -1);
if($clause1 != "")
$clause = " and (" . $clause1 . ")";


$ar_total = $word . "~" ."[";
$categories="";
$cData="";

$query ="SELECT DATE_FORMAT(DATE(published),'%Y-%c-%d')   as pDate, COUNT(*) as pCount FROM listeningdata WHERE  DATE( published ) > CURDATE( ) - INTERVAL 10 DAY " . $clause . " and brandid in (select brandid from brands where brand like '%" . $word ."%')    GROUP BY DATE(published) order by published";

$rows=$mysql_conn->query($query);
//	echo '<br>' . $query . '<br>';
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
//echo $WordDate[$word]."\n".strtotime($WordDate[$word]);
$notify_insight_date = strtotime($WordDate[$word]);
//echo strtotime($WordDate[$word]);

if($x %2 == 0)
$dir="left";
else
$dir="right";
//echo '<p class="triangle-border ' . $dir . '">' . $word . "<i> on</i> " . $WordDate[$word] . ", <i> Total Posts</i>:" . $WordCount[$word] ;
$total_posts = $WordCount[$word];
$ignorewords = file_get_contents('sentiment/ignorewords.txt', true);
$ignorewords_arr = explode(",", $ignorewords);

//// Finished finding which is the peak date and number of post **************************/

$query="SELECT text FROM `listeningdata` where DATE(published) = DATE('" . $WordDate[$word] ."') and brandid in (" . $brandids . ") " . $clause;

	//echo $query . '<br>';
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
			//echo '<br>' . $word ;
			if($word1!= "")
			{
				if (in_array(strtolower($word1), $ignorewords_arr) != false)
				{
				$count++;
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
echo  $word . "<i> on</i> " . $WordDate[$word] . ", <i> Total Posts</i>:" . $total_posts . ' <br> Trending words ';

//print_r($WordCount);
$iCnt = 0;
//echo '<br><i>Trending Words</i> : ';
foreach($WordCount AS $field=>$value)
{


$created_at = date("Y/m/d",strtotime($WordDate[$word]));

echo '<a href="#" onclick="getInsights(\''.  $created_at . '\', \'' .  $field . '\',\''. $word . '\')">' . $field  . "</a>:" . $value . ", ";
	$iCnt++;
	if ($iCnt >= 4) break;
}

echo '<br>';
$clauses=array();
$words=array();
$querystring="";
$iCnt=0;
foreach($WordCount AS $field=>$value)
{
$words[] = $field;
	$iCnt++;
	if ($iCnt > 2) break;
}
$clause=implode(' AND ' ,$clauses);

if($clause != "")
$clause = " and (" . $clause . ")";



// Above code is only needed so removed below code, check Insight.php for more info
}
?>