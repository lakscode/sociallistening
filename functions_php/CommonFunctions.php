<?php


function include_words($include_words)
{
$parts = explode(", ",trim($include_words));
$clauses=array();
foreach ($parts as $part){
    //function_description in my case ,  replace it with whatever u want in ur table
  //  $clauses[]="text LIKE '% " . mysql_real_escape_string($part) . "%'";
	//$clauses[]="text LIKE '" . mysql_real_escape_string($part) . " %'";	
	//$clauses[]="text LIKE '% " . mysql_real_escape_string($part) . "'";	
	$clauses[]="text LIKE '%" . $part . "%'";	
}
$result_querystring=implode(' OR ' ,$clauses);		
return $result_querystring;
}

function not_include_words($not_include_words)
{
$parts = explode(", ",trim($not_include_words));
$clauses=array();
foreach ($parts as $part){
    //function_description in my case ,  replace it with whatever u want in ur table
    $clauses[]="text NOT LIKE '%" . $part . "%'";
}
$result_querystring=implode(' AND ' ,$clauses);		
return $result_querystring;
}


function ConvertDate($t_date)
{
	//$arr_temp = split(',', $row['pDate']);
	$arr_temp = split(',', $t_date);
	$temp=(int) $arr_temp[1];
	$temp=$temp-1;
	$t_date1= $arr_temp[0] . "," . $temp . "," . $arr_temp[2] ;
	return $t_date1;
}

function FormatChartData($word, $rows)
{
$ar_total = $word ."~[";	
	while ($row = $rows->fetch_assoc())
	{
		if($max_date < $row['pDate'])
		$max_date=$row['pDate'];
		
		if($min_date > $row['pDate'])
		$min_date=$row['pDate'];
		
		
	   $ar_total .= "[Date.UTC(". ConvertDate($row['pDate']) . "), " . $row['pCount'] . "],";
	}		

	$ar_total=substr($ar_total, 0, -1);  
	if($ar_total == $word ."~")
	{
		$created_at = date("Y,n,d", strtotime("-1 month"));
		//	if($min_date != "")
		//	$ar_total = $word . "~" . "[[Date.UTC(" . ConvertDate($min_date) . "),0]";	
		//	else if($max_date != "")
		//	$ar_total = $word . "~" . "[[Date.UTC(" . ConvertDate($max_date) . "),0]";
		//	else
			$ar_total = $word . "~" . "[[Date.UTC(" . $created_at . "),0]";
		
	}

	return $ar_total;
}

function Source_Brand()
{
	
	include("../db.php");
	
	
	$global_fixed_brand="";
	$query ="SELECT keywords FROM brands where brand like '%Mayo Clinic%'";   
	$rows=$mysql_conn->query($query);
	$clients=array();
	while ($row = $rows->fetch_assoc())
	{
	$keywords_arr = explode(", ", $row["keywords"]);
	foreach($keywords_arr AS $key_word)
	{	
	
	$clients[]="text LIKE '%" .  $key_word . "%'";
	}

	}
	$client=implode(' OR ' ,$clients);

	if($client != "")
	$client = " and (" . $client . ") ";	
	$global_fixed_brand = $client;
	return $global_fixed_brand;
}

function get_brand_id($brandname)
{
$query ="SELECT brandid, keywords FROM brands where brand like '%" . $brandname . "%'"; 
	//	echo $query;
		$rows=$mysql_conn->query($query);
		
		$clients=array();
		
		while ($row = $rows->fetch_assoc())
		{
		$brandid .= $row["brandid"] . ",";
		}
			$brandid=substr($brandid, 0, -1);
return $brandid;
}

?>