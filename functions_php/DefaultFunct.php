<?php 
include("../db.php");
	include("QueryString.php");
	$querystring="";
	$client="";
	if(isset($_GET['brand']))
	{
	$querystring="and brandid in (select brandid from brands where brand like '%" .  $_GET['brand'] ."%') ";
	
	$query ="SELECT keywords FROM brands where brand like '%" . $_GET['brand'] . "%'";   
$rows=$mysql_conn->query($query);
$clients=array();
while ($row = $rows->fetch_assoc())
{
$keywords_arr = explode(", ", $row["keywords"]);
			foreach($keywords_arr AS $key_word)
			{	
			
			$clauses[]="text LIKE '%" .  $key_word . "%'";
			}
			$clause1=implode(' OR ' ,$clauses);
			$clients[]= $clause1;
}
$client=implode(' OR ' ,$clients);

if($client != "")
$client = " and (" . $client . ") ";	
$querystring .= $client; 
}

	$searchwords_arr[]="";
	$searchword_cnt=0;

	$searchwords_arr[$searchword_cnt]= "Emergency";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Health Insurance";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Hospital Operations";
	$searchword_cnt++;	
	
	$searchwords_arr[$searchword_cnt]= "Patient Experience";
	$searchword_cnt++;	

	$searchwords_arr[$searchword_cnt]= "Health Checkup Packages";
	$searchword_cnt++;	
	

$ar_sub="";
  $max_date="";
$min_date="";
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

if($word == "Emergency")
{
$search_words="urgent, help, immediate, deadly, fast, quick, sudden, major, on  time, save, rescue, care, risk, important, concern, situation, on call, support, recover, worse, prevent, avert";
$search_words2="accident, ambulance, disease, ICU, doctor, hospitalization, 24x7, SOS, clinical, patient, critical, bleeding, heart attack, breakdown, medicine, hospital, nursing home, trauma center, healthcare center, medical, fire, unconscious, fatal, fracture, 911, first aid, resuscitation, suicide, epidemic, collapse, breathlessness, poison, casualty, outbreak, cardiac arrest";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Health Insurance")
{
$search_words="coverage, provider, medicare, treatment, rider, wellness, secure, claim, approval, rejection, expensive, affordable, good, not worth, ideal, inappropriate, misleading, counterproductive, beneficial, necessary, essential, refer, recommend, enroll, avail";
$search_words2="health, insurance, settlement, disease, blood, ICU, hospitalization, clinical, patient, heart attack, breakdown, medicine, hospital, nursing home, trauma center, healthcare center, doctor, medical, TPA, mediclaim, claim, billing, invoice, approval, rejection, cashless, disability, beneficiary, critical illness, third party, premium, plan, policy, cost, health expenses";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Hospital Operations")
{
$search_words="late, Delay, unacceptable, unfriendly, disappointed, Need better service, unresponsive, poor, excellent, awesome, good, appreciate, thank you, praise, quick response, damage, broken, fault, mistake, fail, rude, friendly, unhygienic, tidy, sue, legal action, compliment, hygienic, competitive, organized";
$search_words2="health, insurance, settlement, disease, blood, ICU, doctor, hospitalization, clinical, patient, medicine, hospital, nursing home, trauma center, healthcare center, medical, billing, ward, hospital bed, operation theatre, laboratory, pathology, diagnostic, dietician, physician, records, training, blood bank, casualty, housekeeping, parking, admission, discharge, operation theatre, trauma center maintenance, helpdesk, equipment, customer service, complaint, OPD, food, fraud";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Patient Experience")
{
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, impressed, best, indebted, always recommend, grateful, thankful, admiration, outstanding , courteous, understanding, kind, smart, first-class, superb, fine, exceptional, wonderful, feedback, friendly, excellent, great, flawless, interested, thankful, trust, faith, obliged, blessed, savior, life saving, placebo, sympathetic, kudos, good, awesome, innovative, experts, favorite, fantastic, wishes, thanks, humility, negligence, carelessness, scam, friendly, delayed, cleanliness, hygiene";
$search_words2="health, insurance, blood bank, ICU, doctor, hospitalization, patient, medicine, hospital, nursing home, trauma center, healthcare center, medical, billing, ward, hospital bed, operation theatre, laboratory, pathology, diagnostic, dietician, physician, records, training, blood bank, casualty, housekeeping, parking, admission, discharge, operation theatre, trauma center maintenance, helpdesk, equipment, customer service, online, consultation, food";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Health Checkup Packages")
{
$search_words="Bad, good, very helpful, recommend, poor, beneficial, include, exclude, waste, economical, not helpful, ideal, extend, additional, extensive, full, free, complimentary";
$search_words2="packages, checkup, coupons, eye camp, diabetic camp, advertisements, polio drops, vaccination, personalized, preventive, pediatric, liver checkup, kidney checkup, master health check, senior citizens health check, basic heart checkup, advanced heart check, platinum health check, gold health check, bronze health check, dental checkup, cancer awareness, cervical camp, coverage, add on, top up plan, renewal, disease";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
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
if($_SESSION['fixed_data'] == "")
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 7 DAY  " . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";  
}
else
{

$query ="SELECT DATE_FORMAT(DATE(published), '%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE " . $_SESSION['fixed_data'] . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";  
}

//	echo $query . '<br>';
$rows=$mysql_conn->query($query);

$ar_total = FormatChartData($word, $rows);


$ar_sub .=$ar_total . "]~";
$ar_total = "";
}
	  $ar_sub=substr($ar_sub, 0, -1);  

	 echo $ar_sub;
?>
