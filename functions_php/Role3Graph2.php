<?php 
include("../db.php");

$querystring="";
include("QueryString.php");

$fixed_brand = Source_Brand(); 


$searchwords_arr[]="";
$searchword_cnt=0;

	$searchwords_arr[$searchword_cnt]= "New Insurance Leads";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Reinsurance leads";
	$searchword_cnt++;

	
$ar_sub="";
    $max_date="";
$min_date="";
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

if($word == "New Insurance Leads")
{
$search_words="new, need advice on insurance, want new insurer, insurance help, looking for insurance, new car insurance, new life insurance, better, insurance rates, premium amount, property & casualty, p&C, auto, life, car, vehicle, life insurance, lifetime, span, generation, X death, viability, group life, liveliness, essence, activity, growth, death insurance, death, health, healthcare, disease, not well, sick, hospitalized, hospital, group insurance, group plan, coinsurance, co-insurance, car, vehicle, passenger car, motor car, truck insurance, MUV, SUV, wheels, four wheeler, motor car, sedan, pickup truck, convertible, sports car, bus, van, crop insurance, underwrite";
$search_words2="";
$not_include_words="";
}

if($word == "Reinsurance leads")
{
$search_words="reinsurance, reinsure, want to extend, extend insurance, increase term, extend term, property & casualty, p&C, auto, life, car, vehicle, life insurance, lifetime, span, generation, X death, viability, group life, liveliness, essence, activity, growth, death insurance, death, health, healthcare, disease, car, vehicle, passenger car, motor car, truck insurance, MUV, SUV, wheels, four wheeler, crop insurance, risk, broker, agent, underwrite, original insurer, credit rating insurance, travel insurance business, home insurance business, loan interest, loan for premiums, insurance rates, motor insurance, healthcare insurance, reinsurance, job listing, hiring, car insurance, coverage, category, underwriting, dental insurance, term insurance, life insurance, medical insurance";
$search_words2="";
$not_include_words="";
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


if( $_SESSION['fixed_data']  == "")
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 7 DAY  " . $fixed_brand . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";  
}
else
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE   " . $_SESSION['fixed_data'] . $fixed_brand . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";  
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
