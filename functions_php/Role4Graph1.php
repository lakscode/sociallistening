<?php 
include("../db.php");
$fixed_brand = "";

$querystring="";

include("QueryString.php");

$searchwords_arr[]="";
$searchword_cnt=0;

	$searchwords_arr[$searchword_cnt]= "Healthcare Technology Trends";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Healthcare Competition Technology Trends";
	$searchword_cnt++;


$ar_sub="";
    $max_date="";
$min_date="";

for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

if($word == "Healthcare Technology Trends")
{
$search_words = "disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring, safe, secure, bad, poor, risk, defective, boon, positive, negative";
$search_words2="global payment, emergency, hospitalization, pathology, trauma center, disease management, process improvement, disease management, patient care, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, healthcare system, clinical research, medical education, radiology, clinical data, medication history, hospital measurement, biosurveillance, health information, hospital data, hospital security, accident investigation, equipment maintenance";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "Healthcare Competition Technology Trends")
{
$search_words = "disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring, safe, secure, bad, poor, risk, defective, boon, positive, negative";
$search_words2="global payment, emergency, hospitalization, pathology, trauma center, disease management, process improvement, disease management, patient care, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, healthcare system, clinical research, medical education, radiology, clinical data, medication history, hospital measurement, biosurveillance, health information, hospital data, hospital security, accident investigation, equipment maintenance";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($search_words != "")
{
	$res=include_words($search_words);	

	if($res != "")
	$clause = " and (" . $res . ") ";
}

if($search_words2 != "")
{
	$res=include_words($search_words2);	

	if($res != "")
	$clause .= " and (" . $res . ") ";
}

if($not_include_words != "")
{
	$res=not_include_words($not_include_words);	

	if($res != "")
	$clause .= " and (" . $res . ") ";
}


$ar_total = $word ."~[";	
$categories="";
$cData="";


if( $_SESSION['fixed_data'] == "")
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 7 DAY  " . $fixed_brand . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";  
}
else
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE  " . $_SESSION['fixed_data'] . $fixed_brand . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published"; 
}

//echo $query . '<br>';
$rows=mysql_query($query);

$ar_total = FormatChartData($word, $rows);

$ar_sub .=$ar_total . "]~";
$ar_total = "";
}
	  $ar_sub=substr($ar_sub, 0, -1);  

	 echo $ar_sub;
?>
