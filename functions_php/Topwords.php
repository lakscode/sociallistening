<?php 

include("QueryString.php");
	$ignorewords = file_get_contents('sentiment/ignorewords.txt', true);
$ignorewords_arr = explode(",", $ignorewords);

include("../db.php");
if($c_date =="")
{
$query = "SELECT distinct(text)   FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  order by published desc  limit 0,100";
}
else
{
$query = "SELECT distinct(text)  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  order by published desc  limit 0,100";
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
   	$Words = explode(' ',$row["text"]);
	foreach($Words AS $word)
	{	
	
	$word = preg_replace("/[^ \w]+/", "", $word);
			$word = preg_replace("/^[0-9]+/", "", $word);
			$word=strtolower(trim($word));
			//echo '<br>' . $word ;
			if($word!= "")
			{
				if (in_array(strtolower($word), $ignorewords_arr) != false)
				{
				$count++;
				}
				else if(strlen($word) <= 2)
				{
				}
				else
				{
					$WordCount[$word]++;
				}
			
			}

	}
   }
   
   
arsort($WordCount);
$iCnt = 0;
foreach($WordCount AS $field=>$value)
{
//	echo $field  . " occurs . " . $value . " <br/>";
	$iCnt++;
	if ($iCnt >= 15) break;
}
$clauses=array();
$querystring="";
$iCnt=0;
foreach($WordCount AS $field=>$value)
{
	     $categories .="'" . $field . "',";
		$cData .=$value . ",";
	  $ar_total .= '["'. $field . '", ' . $value. '],';
	  
	$iCnt++;
	if ($iCnt > 10) break;
}
	$categories=substr($categories, 0, -1);
	$cData=substr($cData, 0, -1);
$categories = "[" . $categories . "]";
$cData = "[" . $cData . "]";
	echo $categories . "~" . $cData ;
?>