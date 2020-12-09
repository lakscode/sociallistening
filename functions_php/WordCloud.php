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

	$rows=$mysql_conn->query($query);
  $num_rows=mysql_num_rows ($rows );
//echo 'Title:Site Trend~';
  $ar_total="";
$ar_total = "[";
$categories="";
$cData="";
   while ($row = $rows->fetch_assoc())
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

$clauses=array();
$querystring="";
$iCnt=0;
$content="";
$cnt=48;
foreach($WordCount AS $field=>$value)
{
$rnd=rand(15, 30);
$content .='<span data-weight="' . $cnt . '">'. $field . '</span>';
	     $categories .="'" . $field . "',";
		$cData .=$value . ",";
	  $ar_total .= '["'. $field . '", ' . $value. '],';

	  if($cnt > 35)
	   $cnt -=2;
	    else 
	   $cnt -=1;


		
	$iCnt++;
	if ($iCnt > 30) break;
}
?>
<style type="text/css">
.wordcloud {
background:#FFF;
border: 1px solid #036;
height: 390px;
margin: 10px auto;
padding: 0;
page-break-after: always;
page-break-inside: avoid;
width: 450px;
}
</style>
<div id="wordcloud1" class="wordcloud"> <?php echo $content; ?> </div>


<script>
			$(document).ready(function(){
				$("#wordcloud1").awesomeCloud({
				"size" : {
						"grid" : 9,
						"factor" : 1
					},
					"options" : {
						"color" : "random-dark",
						"rotationRatio" : 0.35
					},
					"font" : "'Times New Roman', Times, serif",
					"shape" : "circle"
				});
	
			});
		</script> 
		