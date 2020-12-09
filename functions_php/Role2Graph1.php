<?php 
include("../db.php");

$querystring="";
include("QueryString.php");
$fixed_brand = Source_Brand(); 
	
$searchwords_arr[]="";
$searchword_cnt=0;

	$searchwords_arr[$searchword_cnt]= "Patient Urgency";
	$searchword_cnt++;

	$searchwords_arr[$searchword_cnt]= "Patient Complaints & Issues";
	$searchword_cnt++;	

	$searchwords_arr[$searchword_cnt]= "Patient Wellness";
	$searchword_cnt++;	

	$searchwords_arr[$searchword_cnt]= "Hospital Services";
	$searchword_cnt++;
	
$ar_sub="";
$max_date="";
$min_date="";
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];

if($word == "Hospital Services")
{
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, inexcusable, refusing to pay, fraud, loss, at loss, going to lawyer, legal notice, see you in court, delayed, disappointed, inexperience, careless, expensive, unavailable, unacceptable, painful, good, up to mark, commendable, friendly, impressed, outstanding, remarkable, helpful, praise worthy, affordable, excellent ";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "Patient Urgency")
{
$search_words="late, delayed, delay, late phase delay, over a month, submitted late, insurance pending, beyond SLA, unduly long, too much time, pending, overdue, constant delay, what is sla, undue time taken, time waste, setback, slowdown, retard, postpone, defer, waiting period, time delay, untimely, late admission";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "Patient Complaints & Issues")
{
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, dissatisfied, expensive, late, Delay, unacceptable, unfriendly, Not helpful, disappointed, deny, Need better service, Fear, Never,  unresponsive, sue, legal action, legal notice, inexcusable, not helping ";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($word == "Positive and addressed")
{
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, easy process, impressed, best, saved time, affordable, inexpensive, faster, better, benefits, highly recommended, best, thank you, thanks, gratitude, indebted, always recommend, grateful, thankful, outstanding , courteous, understanding, kind, smart, affordable, superb, fine, exceptional, wonderful ";
$search_words2="mediclaim, insurance, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, TPA, disease management, blood bank, ambulance, healthcare campaigns, security, nursing staff, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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
$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d')    as pDate, COUNT(*) as pCount FROM listeningdata WHERE " . $_SESSION['fixed_data'] . $fixed_brand . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";  
}

//echo $query . '<br>';
$rows=$mysql_conn->query($query);

$ar_total = FormatChartData($word, $rows);

$ar_sub .=$ar_total . "]~";
$ar_total = "";
}
	  $ar_sub=substr($ar_sub, 0, -1);  

	 echo $ar_sub;
?>
