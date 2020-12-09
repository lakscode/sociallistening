<?php 
include("../db.php");
$querystring="";
include("QueryString.php");
$fixed_brand = Source_Brand(); 
$searchwords_arr[]="";
$searchword_cnt=0;

	$searchwords_arr[$searchword_cnt]= "Quality of Health Services";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Patient Health Management";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Health Insurance";
	$searchword_cnt++;	

	
$ar_sub="";
   $max_date="";
$min_date="";
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

if($word == "Quality of Health Services")
{
$search_words="worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, sick, negative, worse, penalties, inexcusable, fraud, dishonest, loss, at loss, legal notice, delayed, disappointed, inexperience, careless, expensive, unavailable, cost effective, unacceptable, painful, safe, well trained, efficient, competitive, compliant, world class";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($word == "Patient Health Management")
{
$search_words="late, delayed, delay, late phase delay, over a month, unduly long, too much time, pending, overdue, what is sla, undue time taken, time waste, setback, retard, postpone, defer, time delay, untimely, late admission, competitive, world class, friendly, timely, excellent, exceptional, qualitative, recommend, impressed, refer, superior, helpful, beneficial";
$search_words2="mediclaim, insurance, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "Health Insurance")
{
$search_words="persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, bad service, pathetic service, dissatisfied, expensive, unacceptable, unfriendly, disappointed, deny, Need better service, never, refusing to pay, penalty, affordable, adequate,, good, superb, excellent features, appropriate";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, hospitalization, helpdesk, risk management, billing issue, customer transaction, process improvement, TPA, emergency, patient satisfaction, service enhancement, rejection, insurer, critical illness, approval, cashless, mediclaim settlement, network hospitals, policy, medical expenses, health insurance premium, co-payment, coinsurance, disease management, lifetime health cover, medicare surcharge, insurance medicine";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, nfl tickets, intern, concert, motor racing";
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
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 7 DAY " . $fixed_brand . $clause ." " . $querystring ." GROUP BY DATE(published) order by published"; 
}
else
{
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE  "  . $_SESSION['fixed_data'] . $fixed_brand . $clause ." " . $querystring ." GROUP BY DATE(published) order by published"; 
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
