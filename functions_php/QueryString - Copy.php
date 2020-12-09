<?php
include("../db.php");
include("CommonFunctions.php");
	$querystring="";
	$client="";
	if(isset($_GET['brand']))
	{
	//$querystring="and brandid in (select brandid from brands where brand like '%" .  $_GET['brand'] ."%') ";

	
	$query ="SELECT keywords FROM brands where brand like '%" . $_GET['brand'] . "%'";   
	//echo $query;
	$rows=mysql_query($query);
	$clients=array();
	while ($row = mysql_fetch_array($rows))
	{
	$clients[]="text LIKE '% " . mysql_real_escape_string($row["keywords"]) . " %'";
	$clients[]="text LIKE '" . mysql_real_escape_string($row["keywords"]) . " %'";	
	$clients[]="text LIKE '% " . mysql_real_escape_string($row["keywords"]) . "'";		
    $clients[]="text LIKE '%@" . mysql_real_escape_string($row["keywords"]) . " %'";
	$clients[]="text LIKE '%#" . mysql_real_escape_string($row["keywords"]) . " %'";
	}
	$client=implode(' OR ' ,$clients);

	if($client != "")
	$client = " and (" . $client . ") ";	
	$querystring .= $client;
	//echo $client;
	}

	
	if(isset($_GET['sentiment']))
	$querystring .=" and sentiment = " .  $_GET['sentiment'] ." ";

	if(isset($_GET['n_sentiment']))
	$querystring .=" and sentiment = " .  $_GET['n_sentiment'];
	
	
	if(isset($_GET['source']))
	$querystring .=" and site_type like '%" .  $_GET['source'] ."%' ";

	if(isset($_GET['lang']))
	$querystring .=" and language like '" .  $_GET['lang'] ."%' ";

	if(isset($_GET['site']))
	{
	if($_GET['site'] != "")
	{
	$site=str_replace("'", "",$_GET['site']);
	$querystring .=" and site like '%" .  $site ."%' ";
	}
	}
	
	if(isset($_GET['words']))
	{
	if($_GET['words'] != "")
	{
		$words=$_GET['words'];
		$querystring .=" and (text like '% " .  $words  ."%' OR text like '%#" .  $words  ."%' OR text like '%@" .  $words  ."%') ";
	}
	}	

	if(isset($_GET['peakWord']))
	{
	if($_GET['peakWord'] != "")
	{
		$words=$_GET['peakWord'];
		$querystring .=" and (text like '% " .  $words  ."%' OR text like '%#" .  $words  ."%' OR text like '%@" .  $words  ."%') ";
	}
	}	

	
	if(isset($_GET['peakBrand']))
	{
	if($_GET['peakBrand'] != "")
	{
	$words=$_GET['peakBrand'];
	$querystring .=" and text like '%" .  $words  ."%' ";
	}
	}
	
///////////////////////////// New code /////////////////////////////////////
	
	
$c_date="";
if(isset($_GET['ifdate']))	
{
if($_GET['ifdate'] !="")
	{
	$mil = $_GET['ifdate'];
$seconds = $mil / 1000;
$c_date= date("Y-m-d", $seconds);
}
}

if(isset($_GET['itdate']))	
{
if($_GET['itdate'] !="")
	{
	$mil = $_GET['itdate'];
$seconds = $mil / 1000;
$c_date=date("Y-m-d", $seconds);
}
}
	
if(isset($_GET['peakDate']))	
{
if($_GET['peakDate'] !="")
	{
	$mil = $_GET['peakDate'];
$seconds = $mil / 1000;
$c_date=date("Y-m-d", $seconds);
}
}
	
//Complaints
	if(isset($_GET['ifunction']))
	{
		if($_GET['ifunction'] !="")
		{
			$word=$_GET['ifunction'];
			
			if($word == "Complaints")
			$search_words="complaint, issue, bad, bad service, pathetic service, Unsatisfied, Expensive, Late, Delay, Unacceptable, Unfriendly, Not helpful, Disappointed, Deny, Need better service, Stuck, Painful, Wish, Mess, Fear, No closure, Never";

			if($word == "Payments")
			$search_words="payment, copayment, co-payment, premium, hike, increase premium, extra service charge, reneval, deductions";

			if($word == "Claims")
			$search_words="claim, approval, approved, co-insurance, coinsurance, settlement, not satisfactory, not satisfied, dissatisfied, delay, unnecessary delay, authorising, authorisation, issue, unnecessary documents required, documents, amount settled, amount paid, unjustified deduction, deduction, claim settlement, claim processing";

			$res=include_words($search_words);	
			if($res != "")
			$clause .= " and (" . $res . ")";
		}
	}
	
	
	if(isset($_GET['itype']))
	{
	if($_GET['itype'] !="")
			
	$word = $_GET['itype'];
	
	if($word == "Life")
	$search_words="life insurance, lifetime, span, generation, X death, viability, group life, liveliness, essence, activity, growth, death insurance, death";

	if($word == "Health")
	$search_words="health, healthcare, disease, not well, sick, hospitalized, hospital, group insurance, group plan, coinsurance, co-insurance";


	if($word == "Auto")
	$search_words="car, vehicle, passenger car, motor car, truck insurance, MUV, SUV, wheels, four wheeler, motor car, sedan, pick up truck, convertible, sports car, bus, van";

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ") ";

}

	if(isset($_GET['custops']))
	{
	if($_GET['custops'] !="")
			
	$word = $_GET['custops'];

if($word == "'Damaging Content'")
{
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, sick, negative, worse, late insurance, going to court, mess, penalties, inexcusable, refusing to pay, late disclaimer, fraud, dishonest, conned, con, dead, loss, at loss, going to lawyer, legal notice, see you in court, delayed, uninsurable";

$search_words2="Claim, insurance, payment, insurance help, insurance, vehicle insurance, life insurance, commercial insurance, business insurance, disaster insurance, risk management, payout, disability insurance, credit insurance, annuities, pet insurance, insurance quote, credit rating insurance, travel insurance business, home insurance business, loan interest, loan for premiums, insurance rates, motor insurance, healthcare insurance, reinsurance, insurance bill, micro lending, Coordination of benefits, insurance, reimbursement, billing issue, customer transactions, credit rating , customer rating";

$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern, concert, motor racing";

}
if($word == "'Delayed Response'")
{
$search_words="Late, late, delayed, long overdue, delay, resubmit, late-term, late phase delay, over a month, over a year, submitted late, insurance pending, months pending, beyond SLA, unduly long, too much time, pending, overdue, constant delay, what is sla, undue time taken, time waste, setback, slowdown, retard, postpone, defer, waiting period, time delay, untimely";
$search_words2="Claim, insurance, payment, insurance help, insurance, vehicle insurance, life insurance, commercial insurance, business insurance, disaster insurance, risk management, payout, disability insurance, credit insurance, annuities, pet insurance, insurance quote, credit rating insurance, travel insurance business, home insurance business, loan interest, loan for premiums, insurance rates, motor insurance, healthcare insurance, reinsurance, customer follow up, insurance bill, claim number, co-insurance, micro lending , Coordination of benefits, insurance reimbursement, billing issue , customer transactions, credit rating , customer rating";
$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern, concert, motor racing";

}
if($word == "'Unaddressed Issues'")
{
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, Unsatisfied, Expensive, Late, Delay, Unacceptable, Unfriendly, Not helpful, Disappointed, Deny, Need better service, Stuck, Painful, Wish, Mess, Fear, No closure, Never , unresponsive";

$search_words2="Claim, insurance, payment, insurance help, insurance, vehicle insurance, life insurance, commercial insurance, business insurance, disaster insurance,  risk management, payout, disability insurance, credit insurance, annuities, pet insurance, insurance quote, credit rating insurance, travel insurance business, home insurance business, loan interest, loan for premiums, insurance rates, motor insurance, healthcare insurance, reinsurance, claims management, customer follow up, insurance bill, insurance benefits, claim number, co-insurance , micro lending , Coordination of benefits, insurance reimbursement, billing issue , customer transactions, credit rating , customer rating";
$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern,concert, motor racing";

}

if($word == "'Positive and addressed'")
{
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, claims process, easy process, impressed, best, saved time, affordable, inexpensive, faster, better, benefits, highly recommended, best,  thank you, thanks, gratitude, indebted, always recommend, grateful, thankful, admiration, outstanding , courteous, understanding, kind, smart, first-class, superb, fine, exceptional, wonderful";

$search_words2="Claim, insurance, payment, insurance help, insurance, vehicle insurance, life insurance, commercial insurance, business insurance, disaster insurance, risk management, payout, disability insurance, credit insurance, annuities, pet insurance, insurance quote, credit rating insurance, travel insurance business, home insurance business, loan interest, loan for premiums, insurance rates, motor insurance, healthcare insurance, reinsurance, claims , billing issue management, insurance bill, insurance benefits , claim number, co-insurance , micro lending, Coordination of benefits, insurance reimbursement, customer transactions, credit rating , customer rating";

$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern,concert, motor racing";
}

if($search_words != "")
{
	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
}

if($search_words2 != "")
{
	$res=include_words($search_words2);	

	if($res != "")
	$clause .= " and (" . $res . ")";
}

if($not_include_words != "")
{
	$res=not_include_words($not_include_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
}


}


	if(isset($_GET['claimsops']))
	{
	if($_GET['claimsops'] !="")
			
	$word = $_GET['claimsops'];


	if($word == "'Pending Claims'")
	$search_words="pending claims, delayed claims, long overdue, delay, resubmit claim, late-term, late phase delay, over a month, over a year, submitted late, claim pending, 6months pending, beyond SLA, what is sla, painful, wait";

	if($word == "'New Claims'")
	$search_words="put in a claim, payout claim, how to claim, need help to claim, want to claim, help to claim, process claim, how to claim";

	if($word == "'Claim Complaints'")
	$search_words="delayed claims, not happy, unhappy, poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, Unsatisfied, Expensive, Late, Delay, Unacceptable, Unfriendly, Not helpful, Disappointed, Deny, Need better service, Stuck, Painful, Wish, Mess, Fear, No closure, Never";

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
	
	}

if(isset($_GET['custacq']))
{
	if($_GET['custacq'] !="")
			
	$word = $_GET['custacq'];

	
$search_words="";
$search_words2="";
$not_include_words="";

if($word == "'New Insurance Leads'")
{
$search_words="expensive, cost, costly, cheap, booking, submit, exclusive, include, exclude, premium,  coverage,   delay, term, bill, generate, reach, quick, feedback, survey, friendly, reach, fail, success, submit, regenerate, transaction, complete, tedious, user friendly, insurance rates,  fast, processing, annuities, customer follow up, 
meeting, quick, duplicate, replica, fake, model, original, carbon copy, print, copy, evaluate, check, verify, clone, photocopy, address, pickup, delivery, key in, capture, input, vague, limit, assumptions, assume, prior history, paper work, referral";

$search_words2="New  quote, quotation, how much,  offer, agent, contact, leads, price, general insurance, vehicle insurance,  motor insurance,   life insurance, commercial insurance, business insurance, disaster insurance, risk management, disability insurance, credit insurance, pet insurance,  insurance, travel insurance business, home insurance business, loan for premiums, motor insurance, healthcare insurance, reinsurance, insurance reimbursement, payment, credit rate, rating, rank, feedback, online, private, customer, service, credit history,  premium, payment, annuities, renew, proof, verification, billing issue";

$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern, concert, motor racing";

}

if($word == "'Type of Insurance Leads'")
{
$search_words="Type, kind, category, variety, class, different, same, old, new,  launch, exclusive, include, exclude, coverage,  copy, fake, model, original, carbon copy, mock, clone, same type, together, combine, related, special, specific, exact, explicit, definite, certain, identifiable, particular, vague, general, limit, gender, male, female, child, vehicle, motor, car, automobile, travel, health, reinsurance, renew, referral";
$search_words2="new, quote, quotation, how much,  offer, agent, contact, leads, price, general insurance, vehicle insurance,  motor insurance,   life insurance, commercial insurance, business insurance, disaster insurance, risk management, disability insurance, credit insurance, pet insurance,  insurance, travel insurance business, home insurance business, loan for premiums, motor insurance, healthcare insurance, reinsurance, insurance reimbursement, payment, credit rate, rating, rank, feedback, online, private, customer, service, credit history,  premium, insurance rates,   payment, annuities, renew, verification, proof, billing issue";
$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern, concert, motor racing";
}

if($word == "'Administration'")
{
$search_words="administration, supervise,  staff, office, location, near, friendly, building, site down, customer service, mismanagement, close, terminate, great, treat, verify, poor response,  management, pathetic, poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, Unsatisfied, Expensive, late, delay, unacceptable, unfriendly, not helpful, disappointed, deny, need better service, stuck, painful, wish, mess, fear, no closure, never , unresponsive, reach, disappointed, fail, poor response, process, individual, deliver, result,  pickup, relate";
$search_words2="new, quote, quotation, how much,  offer, agent, contact, leads, price, vehicle insurance,  motor insurance,   life insurance, commercial insurance, business insurance, disaster insurance, risk management, disability insurance, credit insurance, pet insurance,  insurance, travel insurance business, home insurance business, loan for premiums, motor insurance, healthcare insurance, reinsurance, insurance reimbursement, payment, credit rate, rating, rank, feedback, online, private, customer, service, credit history,  premium, insurance rates,   payment, annuities, renew, verification, proof
";
$not_include_words="Stadium, OTRA METLIFE, METLIFE SQUAD, MetLife stadium, ticket, going, MetLife tickets, new York giants, Taylor Swift, Vance Joy,  Shawn Mendes, seating, seat, seating arrangement, celebrities, catwalk, taylor, superbowl, fuck, fucking, new england patriots, row, meetup, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, MetLife date,  MetLife expo, nfl tickets, intern, concert, motor racing";
}


if($search_words != "")
{
	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
}

if($search_words2 != "")
{
	$res=include_words($search_words2);	

	if($res != "")
	$clause .= " and (" . $res . ")";
}

if($not_include_words != "")
{
	$res=not_include_words($not_include_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
}


}


if(isset($_GET['iccustops']))
{
	if($_GET['iccustops'] !="")
			
	$word = $_GET['iccustops'];

if($word == "'Damaging Content'")
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, sick, negative, worse, late insurance, going to court, mess, penalties, inexcusable, refusing to pay, late disclaimer, fraud, dishonest, conned, con, dead, loss, at loss, going to lawyer, legal notice, see you in court";

if($word == "'Delayed Response'")
$search_words="late, delayed, long overdue, delay, resubmit, late-term, late phase delay, over a month, over a year, submitted late, insurance pending, 6months pending, beyond SLA, unduly long, too much time, pending, overdue, constant delay, what is sla, undue time taken, time waste";

if($word == "'Unaddressed Issues'")
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, Unsatisfied, Expensive, Late, Delay, Unacceptable, Unfriendly, Not helpful, Disappointed, Deny, Need better service, Stuck, Painful, Wish, Mess, Fear, No closure, Never , unresponsive ";

if($word == "'Positive and Addressed'")
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, claims process, easy process, impressed, best, saved time, affordable, inexpensive, faster, better, benefits, highly recommended, best, thank you, thanks, gratitude, indebted, always recommend";

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";

}


if(isset($_GET['techtrends']))
{
	if($_GET['techtrends'] !="")
			
	$word = $_GET['techtrends'];

if($word == "'Brand Technology Trends'")
{
$search_words = "Metlife";
$search_words2="insurance, digital, social media, platform, tech, mobility, mobile, solution, architecture, system, CRM system, response system, application, apps, cyber attack, cybersecurity,   insurance app, analytics, insurance analytics, gadgets, robots , data encryption, system, core systems, core modernization,  innovation";
}
if($word == "'Competitor Technology Trends'")
{
$search_words = "Aviva, Geico";
$search_words2="insurance, digital, social media, tech, technology, mobility, solution, architecture, system, CRM system, response system, application, apps, cyber-attack, cybersecurity,   insurance app, analytics, insurance analytics , gadgets, data encryption, robots, tech skills, system , core systems, core modernization ";
}

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";

/***************** for must words ****************/

	$res=include_words($search_words2);	

	if($res != "")
	$clause .= " and (" . $res . ")";
/***************** for must words ****************/

}

if(isset($_GET['custexp']))
{
	if($_GET['custexp'] !="")
			
	$word = $_GET['custexp'];

if($word == "'Customer Experience Trends'")
{
//$must_words = "Metlife";
$search_words="insurance, digital, social media, platform, tech, mobility, mobile, solution, architecture, system, CRM system, response system, application, apps, cyber attack, cybersecurity, insurance app, analytics, insurance analytics, gadgets, robots, data encryption, system, core systems, core modernization, innovation";
}

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";

}


if(isset($_GET['indview']))
{
	if($_GET['indview'] !="")
			
	$word = $_GET['indview'];

$must_words="";
if($word == "'Brand trend'")
{
$must_words="Metlife";
$search_words="insurance trends, premium, global, market trends, features, list, insurance discounts, study, published, white paper, research, market study, market opportunity, market value, market research, strategy, planning, plan, analysis, market analysis, industry analysis, Gartner, Forrester, Celent, risk management, vendors, insurer, reinsurance, economy, analysts, stocks, ratings, review, sales, revenue, underwriting, fund, finance, market share, credit rating, partnership, commercial";
}

if($word == "'Competition trends'")
{
$must_words="Aviva, Geico";
$search_words="insurance trends, premium, global, market trends, features, list, insurance discounts, study, published, white paper, research, market study, market opportunity, market value, market research, strategy, planning, plan, analysis, market analysis, industry analysis, Gartner, Forrester, Celent, risk management, vendors, insurer, reinsurance, economy, analysts, stocks, ratings, review, sales, revenue, underwriting, fund, finance, market share, credit rating, partnership, commercial";
}

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
	
/***************** for must words ****************/
//echo $must_words;

	$res=include_words($must_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";
/***************** for must words ****************/

}


?>
