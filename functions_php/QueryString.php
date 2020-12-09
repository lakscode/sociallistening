<?php
include("../db.php");
include("CommonFunctions.php");
	$querystring="";
	$client="";
	
	if(isset($_GET['brand']))
	{
	
		$query ="SELECT keywords FROM brands where brand like '%" . $_GET['brand'] . "%'"; 
		//echo $query;
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
			
			//$clients[]="text LIKE '%" . mysql_real_escape_string($row["keywords"]) . "%'";
			$clients[]= $clause1;
			
		}
		$client1=implode(' OR ' ,$clients);

		if($client1 != "")
		$client = " and (" . $client1 . ") ";
		
		$querystring .= $client;
		
		//echo $client;
	}

	if(isset($_GET['sentiment']))
		$querystring .=" and sentiment = " . $_GET['sentiment'] ." ";

	if(isset($_GET['n_sentiment']))
		$querystring .=" and sentiment = " . $_GET['n_sentiment'];
	
	if(isset($_GET['source']))
		$querystring .=" and site_type like '%" . $_GET['source'] ."%' ";

	if(isset($_GET['lang']))
		$querystring .=" and language like '" . $_GET['lang'] ."%' ";

		
	if(isset($_GET['site']))
	{
		if($_GET['site'] != "")
		{
			$site=str_replace("'", "",$_GET['site']);
			$querystring .=" and site like '%" . $site ."%' ";
		}
	}
	
	if(isset($_GET['words']))
	{
		if($_GET['words'] != "")
		{
			$words=$_GET['words'];
			$querystring .=" and (text like '% " . $words ."%' OR text like '%#" . $words ."%' OR text like '%@" . $words ."%') ";
		}
	}	

	if(isset($_GET['peakWord']))
	{
		if($_GET['peakWord'] != "")
		{
			$words=$_GET['peakWord'];
			$querystring .=" and (text like '% " . $words ."%' OR text like '%#" . $words ."%' OR text like '%@" . $words ."%') ";
		}
	}	

	
	if(isset($_GET['peakBrand']))
	{
		if($_GET['peakBrand'] != "")
		{
			$words=$_GET['peakBrand'];
			
			$querystring .=" and (brandid in (" . get_brand_id($words) . ")) ";
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
		$c_date=$_GET['peakDate'];
	}
}
if(isset($_GET['notify_date']))	
{
	if($_GET['notify_date'] !="")
	{
		//$mil = $_GET['notify_date'];
		//$seconds = $mil / 1000;
		//$c_date=date("Y-m-d", $mil);
		$c_date=$_GET['notify_date'];
	}
}
	
// Insurance Functions
	if(isset($_GET['ifunction']))
	{
		if($_GET['ifunction'] !="")
		{
			$word=$_GET['ifunction'];
			
			
if($word == "'Emergency'")
{
$search_words="urgent, help, immediate, deadly, fast, quick, sudden, major, on  time, save, rescue, care, risk, important, concern, situation, on call, support, recover, worse, prevent, avert";
$search_words2="accident, ambulance, disease, ICU, doctor, hospitalization, 24x7, SOS, clinical, patient, critical, bleeding, heart attack, breakdown, medicine, hospital, nursing home, trauma center, healthcare center, medical, fire, unconscious, fatal, fracture, 911, first aid, resuscitation, suicide, epidemic, collapse, breathlessness, poison, casualty, outbreak, cardiac arrest";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "'Health Insurance'")
{
$search_words="coverage, provider, medicare, treatment, rider, wellness, secure, claim, approval, rejection, expensive, affordable, good, not worth, ideal, inappropriate, misleading, counterproductive, beneficial, necessary, essential, refer, recommend, enroll, avail";
$search_words2="health, insurance, settlement, disease, blood, ICU, hospitalization, clinical, patient, heart attack, breakdown, medicine, hospital, nursing home, trauma center, healthcare center, doctor, medical, TPA, mediclaim, claim, billing, invoice, approval, rejection, cashless, disability, beneficiary, critical illness, third party, premium, plan, policy, cost, health expenses";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "'Hospital Operations'")
{
$search_words="late, Delay, unacceptable, unfriendly, disappointed, Need better service, unresponsive, poor, excellent, awesome, good, appreciate, thank you, praise, quick response, damage, broken, fault, mistake, fail, rude, friendly, unhygienic, tidy, sue, legal action, compliment, hygienic, competitive, organized";
$search_words2="health, insurance, settlement, disease, blood, ICU, doctor, hospitalization, clinical, patient, medicine, hospital, nursing home, trauma center, healthcare center, medical, billing, ward, hospital bed, operation theatre, laboratory, pathology, diagnostic, dietician, physician, records, training, blood bank, casualty, housekeeping, parking, admission, discharge, operation theatre, trauma center maintenance, helpdesk, equipment, customer service, complaint, OPD, food, fraud";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "'Patient Experience'")
{
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, impressed, best, indebted, always recommend, grateful, thankful, admiration, outstanding , courteous, understanding, kind, smart, first-class, superb, fine, exceptional, wonderful, feedback, friendly, excellent, great, flawless, interested, thankful, trust, faith, obliged, blessed, savior, life saving, placebo, sympathetic, kudos, good, awesome, innovative, experts, favorite, fantastic, wishes, thanks, humility, negligence, carelessness, scam, friendly, delayed, cleanliness, hygiene";
$search_words2="health, insurance, blood bank, ICU, doctor, hospitalization, patient, medicine, hospital, nursing home, trauma center, healthcare center, medical, billing, ward, hospital bed, operation theatre, laboratory, pathology, diagnostic, dietician, physician, records, training, blood bank, casualty, housekeeping, parking, admission, discharge, operation theatre, trauma center maintenance, helpdesk, equipment, customer service, online, consultation, food";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "'Health Checkup Packages'")
{
$search_words="Bad, good, very helpful, recommend, poor, beneficial, include, exclude, waste, economical, not helpful, ideal, extend, additional, extensive, full, free, complimentary";
$search_words2="packages, checkup, coupons, eye camp, diabetic camp, advertisements, polio drops, vaccination, personalized, preventive, pediatric, liver checkup, kidney checkup, master health check, senior citizens health check, basic heart checkup, advanced heart check, platinum health check, gold health check, bronze health check, dental checkup, cancer awareness, cervical camp, coverage, add on, top up plan, renewal, disease";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($search_words != "")
{
	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ") ";
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


		}
	}

// Insurance Types
	
if(isset($_GET['itype']))
{
	if($_GET['itype'] !="")
			
	$word = $_GET['itype'];
	
		
$search_words="";
$search_words2="";
$not_include_words="";
$clause_keywords="";


if($word == "General Surgery")
{
$search_words="critical, general, invasive, stabilize, intensive, specialty, improve, major, minor, removal, repair, surgical, proficient, trained, expert, lower, perform, complex, survive, competitive, failure, malignant, experience, skill, superior, well, good, bad, delayed, late, loss, excellent, superb, diagnose, fear, mistake, benefit, brilliant";
$search_words2="surgery, gastric, general, procedure, surgeon, hospital, trauma center, nursing home, healthcare center, medicine, laparoscopic, abdominal, oxygen, transplant, implant, blood, needle, procedures, hemorrhoids, laser, bladder, dentistry, liposuction, death, operation theater, kidney, cataract, shoulder, stitches, surgical equipment, gloves, scissors, surgeries, artery, fiber, Lasik, birth, surgery screws, preparation, anesthesia, fissure, colon, abdominal, pancreas, soft tissue, bowel, liver, clinical, tumor";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events, tablets, color, ride";
}


if($word == "Cardiology")
{
$search_words="implant, invasive, blockage, preventive, rupture, prolapsed, pump, failure, attack, arrest, syndrome, expert, competitive, lower, well, diagnose, painful, fear, mistake, appreciate, poor, graft, disappointed, exhaustive, benefit, proficient, critical, intensive, superior, malignant, transplant, benefit, brilliant, excellent, swelling, superb
";
$search_words2="palpitation, cardiology, heart, transcription, cholesterol, cardiologist, blood, cardiac, pacemaker, cardiovascular, valve, veinous, ECG, electrocardiogram, tachycardia, sonographer, hospital, nursing home, trauma center, healthcare center, medicine, hydraulic, pulmonary, congenital heart disease, cardiomyopathy, chest, myocardium, amyloid, myxoma, coronary, cholesterol, cardiopulmonary, sinoatrial, angina, systole, cardiothoracic, echocardiography, cardionetics, artery, heartbeat, ectopic, ventricle, hypertrophic, valsalva, pulse, stent, polycythemia, atherectomy, aneurysm, pericardium, clot, hematologist, atrium, ventricular, atrial, fibrillation, defibrillation, stenosis, by pass, restenosis, aortic";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events, tablets, color, ride, shape";
}

if($word == "Orthopedics")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";
$search_words2="orthopedic, neck, massage, arthroscopy, x-rays, surgeon, tendon, chiropractor, femur, nursing home, hospital, healthcare center, medicine, trauma center, muscle, osteoclast, osteopathy, intramedullary, hip replacement, laminectomy, tear, meniscectomy, ulna, knee, deformities, fracture, joints, muscoskeletal, shoulder, limbs, swelling, meloxicam, scoliosis, ankle, disc, wrist, vertebrae, calcium, bone, spine, foot, rheumatoid, implants, arthroplasty, podiatrist, osteogenesis, elbow, tendonitis, arthritis, cervical, ortho, lumbar, physiotherapy, radiograph, cervical";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Urology")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";
$search_words2="urology, circumcision, prostate, circumcise, genital, endocrinology, vasectomy, urinary tract infection, genitourinary, urothelium, hydrocil, epididymitis, catheter, catheterization, endourology, urine routine, urine culture, hydrocephalus, urofluometery, testosterone, urethra, urine, bladder, bedwetting, hernia, convulsions, sensitivity, kidney stone, enuresis, testicles, cryptorchidism, urolithiasis, cystitis, menopause, dilatation, urinanalysis, reflux, inflammation, stricture, prostatectomy, ureter, urethra, urethral, testicular, lithotripsy";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "ENT")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";

$search_words2="hear, deaf, hearing, tinnitus, sleep, throat, nose, ear, otorhinolaryngologists, apnea, otology, depression, auditory, eardrum, Eustachian, neurotology, cochlear, acoustic, mastoiditis, otitis, esophagus, rhinitis, nasal, browlift, salivary, palate, genioplasty, mandible, thyroid, adenoidectomy, polyps, spasmodic, dysphonia, pituitary, decannulation, deafness, laryngomalacia, mitochondrial, dizziness, mumps, tonsillitis, velopalatine, vascular, swallowing, mouth ulcer";

$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Gynecology")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";
$search_words2="fertility, pregnant, sperm, reproductive, fallopian, uterus, vagina, pregnancy,, contraceptive, embryo, catheter, hysterectomy, restoration, tightening, hymen, gynaecology, hymenoplasty, labiaplasty, labia, vaginoplasty, bleeding, hymen, obstetrics, womb, childbirth, progestogen, caesarean, curettage, ovulation, gynography, ovarian, dysmenorrhoea, oophorectomy, amenorrhoea, menorrhagia, infertility, vaginitis, abortion, swelling, conceive, miscarriages, abdomen, puberty, premature, endometriosis";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Emergency")
{
$search_words="urgent, help, immediate, deadly, fast, quick, sudden, major, on  time, save, rescue, care, risk, important, concern, situation, on call, support, recover, worse, prevent, avert , rupture, intensive, critical";
$search_words2="accident, ambulance, disease, ICU, doctor, hospitalization, 24x7, SOS, clinical, patient, critical, bleeding, heart attack, breakdown, medicine, hospital, nursing home, trauma center, healthcare center, medical, fire, unconscious, fatal, fracture, 911, first aid, resuscitation, suicide, epidemic, collapse, breathlessness, poison, casualty, outbreak, cardiac arrest";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, intern, concert, motor racing, sports events";
}

if($search_words != "")
{
	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ") ";
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

}

// Customer Operations

if(isset($_GET['Role1Graph2']))
{
if($_GET['Role1Graph2'] !="")
			
$word = $_GET['Role1Graph2'];

if($word == "'Hospital Services'")
{
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, inexcusable, refusing to pay, fraud, loss, at loss, going to lawyer, legal notice, see you in court, delayed, disappointed, inexperience, careless, expensive, unavailable, unacceptable, painful, good, up to mark, commendable, friendly, impressed, outstanding, remarkable, helpful, praise worthy, affordable, excellent";

$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";

$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";

}
if($word == "'Patient Urgency'")
{
$search_words="late, delayed, delay, late phase delay, over a month, submitted late, insurance pending, beyond SLA, unduly long, too much time, pending, overdue, constant delay, what is sla, undue time taken, time waste, setback, slowdown, retard, postpone, defer, waiting period, time delay, untimely, late admission";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";

}
if($word == "'Patient Complaints and Issues'")
{
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, dissatisfied, expensive, late, Delay, unacceptable, unfriendly, Not helpful, disappointed, deny, Need better service, Stuck, Painful, Mess, Fear, Never, unresponsive";

$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";

}

if($word == "'Patient Wellness'")
{
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, easy process, impressed, best, saved time, affordable, inexpensive, faster, better, benefits, highly recommended, best, thank you, thanks, gratitude, indebted, always recommend, grateful, thankful, outstanding , courteous, understanding, kind, smart, affordable, superb, fine, exceptional, wonderful";

$search_words2="mediclaim, insurance, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, TPA, disease management, blood bank, ambulance, healthcare campaigns, security, nursing staff, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";

$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

// Claims Operations
if(isset($_GET['Role1Graph3']))
{
	if($_GET['Role1Graph3'] !="")
			
	$word = $_GET['Role1Graph3'];



if($word == "'Quality of Health Services'")
{
$search_words="worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, sick, negative, worse, penalties, inexcusable, fraud, dishonest, loss, at loss, legal notice, delayed, disappointed, inexperience, careless, expensive, unavailable, cost effective, unacceptable, painful, safe, well trained, efficient, competitive, compliant, world class";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($word == "'Patient Health Management'")
{
$search_words="late, delayed, delay, late phase delay, over a month, unduly long, too much time, pending, overdue, what is sla, undue time taken, time waste, setback, retard, postpone, defer, time delay, untimely, late admission, competitive, world class, friendly, timely, excellent, exceptional, qualitative, recommend, impressed, refer, superior, helpful, beneficial";
$search_words2="mediclaim, insurance, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Health Insurance'")
{
$search_words="persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, bad service, pathetic service, dissatisfied, expensive, unacceptable, unfriendly, disappointed, deny, Need better service, never, refusing to pay, penalty, affordable, adequate,, good, superb, excellent features, appropriate";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, hospitalization, helpdesk, risk management, billing issue, customer transaction, process improvement, TPA, emergency, patient satisfaction, service enhancement, rejection, insurer, critical illness, approval, cashless, mediclaim settlement, network hospitals, policy, medical expenses, health insurance premium, co-payment, coinsurance, disease management, lifetime health cover, medicare surcharge, insurance medicine";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

// Customer Acquisition

if(isset($_GET['Role1Graph4']))
{
if($_GET['Role1Graph4'] !="")
			
$word = $_GET['Role1Graph4'];
	
$search_words="";
$search_words2="";
$not_include_words="";


if($word == "'Healthcare Business Generation'")
{
	$search_words="pathetic, loss, at loss, disappointed, inexperience, cost effective, world class, innovative, competitive, customer centric, crowd pulling, favorable, economical, competitive, efficient, result oriented, patient friendly, visionary, good, superb, exceptional, amazing, affordable";

	$search_words2="mediclaim, insurance, global payment, coordination of benefits, billing issue, customer transaction, customer rating, healthcare package, healthcare campaigns, partnership, joint venture, tie ups, commercial health plan, contracting, incentive distribution, referral, innovation, market share, return business, physician partnership, growth, marketing clinical programs, local healthcare providers, operating income, revenue";

	$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";

}

if($word == "'Healthcare Packages and Offers'")
{
	$search_words="competitive, world class, excellent, exceptional, recommend, impressed, refer, patient friendly, expensive, cost effective, good, suggest, not worth, competitive, crowd pulling, lack features, exhaustive, disappointed, below expectation, above expectation, better service, certified, compliant";

	$search_words2="checkup, disease management, healthcare package, healthcare campaigns, partnership, preventive, personalized, basic, advanced, heart checkup, liver checkup, kidney checkup, polio drop, cataract, eye checkup, family checkup, cardiac package, senior citizens health checkup, master health checkup, child health checkup, coupons, offers, vouchers, online, full body package";

	$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($word == "'Hospital Administration'")
{
	$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, inexcusable, refusing to pay, fraud, loss, at loss, going to lawyer, legal notice, see you in court, delayed, disappointed, inexperience, careless, expensive, unavailable, unacceptable, painful, good, up to mark, commendable, friendly, impressed, outstanding, remarkable, helpful, praise worthy, affordable, excellent, poor service, timely";

	$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, billing issue, customer transaction, vaccination, hygiene, checkup, disease management, healthcare package, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, intensive care, housekeeping, nursing staff, compliance, parking, patient records";

	$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

// Insurance & Claims Customer Operations

if(isset($_GET['Role2Graph1']))
{
	if($_GET['Role2Graph1'] !="")
	$word = $_GET['Role2Graph1'];

	
if($word == "'Hospital Services'")
{
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, inexcusable, refusing to pay, fraud, loss, at loss, going to lawyer, legal notice, see you in court, delayed, disappointed, inexperience, careless, expensive, unavailable, unacceptable, painful, good, up to mark, commendable, friendly, impressed, outstanding, remarkable, helpful, praise worthy, affordable, excellent ";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Patient Urgency'")
{
$search_words="late, delayed, delay, late phase delay, over a month, submitted late, insurance pending, beyond SLA, unduly long, too much time, pending, overdue, constant delay, what is sla, undue time taken, time waste, setback, slowdown, retard, postpone, defer, waiting period, time delay, untimely, late admission";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Patient Complaints & Issues'")
{
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, dissatisfied, expensive, late, Delay, unacceptable, unfriendly, Not helpful, disappointed, deny, Need better service, Fear, Never,  unresponsive, sue, legal action, legal notice, inexcusable, not helping ";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($word == "'Positive and addressed'")
{
$search_words="happy, very fast, appreciate, amazing, brilliant, excellent, great, fast, glad, seamless, fast processing, easy process, impressed, best, saved time, affordable, inexpensive, faster, better, benefits, highly recommended, best, thank you, thanks, gratitude, indebted, always recommend, grateful, thankful, outstanding , courteous, understanding, kind, smart, affordable, superb, fine, exceptional, wonderful ";
$search_words2="mediclaim, insurance, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, TPA, disease management, blood bank, ambulance, healthcare campaigns, security, nursing staff, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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


if(isset($_GET['Role2Graph2']))
{
	if($_GET['Role2Graph2'] !="")
			
	$word = $_GET['Role2Graph2'];

if($word == "'Healthcare Trends'")
{
$search_words="disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, painful, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring";
$search_words2="mediclaim, insurance, global payment, emergency, hospitalization, pathology, trauma center, risk management, coordination of benefits, customer transaction, customer rating, disease management, healthcare package, process improvement, disease management, healthcare campaign , emergency service, patient care, organ donation, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, revenue generation, healthcare system, research, medical education, project BOOST";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}

if($word == "'Healthcare Competition Trends'")
{
$search_words="disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, painful, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring";
$search_words2="mediclaim, insurance, global payment, emergency, hospitalization, pathology, trauma center, risk management, coordination of benefits, customer transaction, customer rating, disease management, healthcare package, process improvement, disease management, healthcare campaign , emergency service, patient care, organ donation, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, revenue generation, healthcare system, research, medical education, project BOOST";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

/************* Role 3 ****************/

if(isset($_GET['Role3Graph1']))
{
	if($_GET['Role3Graph1'] !="")
			
	$word = $_GET['Role3Graph1'];

if($word == "'Hospital Administration'")
{
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, inexcusable, refusing to pay, fraud, loss, at loss, going to lawyer, legal notice, see you in court, delayed, disappointed, inexperience, careless, expensive, unavailable, unacceptable, painful, good, up to mark, commendable, friendly, impressed, outstanding, remarkable, helpful, praise worthy, affordable, excellent, poor service, timely";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, billing issue, customer transaction, vaccination, hygiene, checkup, disease management, healthcare package, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, intensive care, housekeeping, nursing staff, compliance, parking, patient records";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Patient Complaints & Issues'")
{
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, dissatisfied, expensive, late, Delay, unacceptable, unfriendly, Not helpful, disappointed, deny, Need better service, Stuck, Painful, Mess, Fear, Never, unresponsive";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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



if(isset($_GET['Role3Graph2']))
{
	if($_GET['Role3Graph2'] !="")
			
	$word = $_GET['Role3Graph2'];

if($word == "'Hospital Administration'")
{
$search_words="sue, legal action, worst service, disappointed, unhappy, sucks, pathetic, disgusted, lost patience, inexcusable, refusing to pay, fraud, loss, at loss, going to lawyer, legal notice, see you in court, delayed, disappointed, inexperience, careless, expensive, unavailable, unacceptable, painful, good, up to mark, commendable, friendly, impressed, outstanding, remarkable, helpful, praise worthy, affordable, excellent, poor service, timely";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, billing issue, customer transaction, vaccination, hygiene, checkup, disease management, healthcare package, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, intensive care, housekeeping, nursing staff, compliance, parking, patient records";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Patient Complaints & Issues'")
{
$search_words="poor customer service, persistent complaint, never addressed, exhausted with complaining, constant battle, persistent issues, not happy, complaint, issue, bad, bad service, pathetic service, dissatisfied, expensive, late, Delay, unacceptable, unfriendly, Not helpful, disappointed, deny, Need better service, Stuck, Painful, Mess, Fear, Never, unresponsive";
$search_words2="mediclaim, insurance, global payment, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, coordination of benefits, billing issue, customer transaction, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, joint venture, referral, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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
/*********** Role 3 ends ***************/

/*********** Role 4 ***************/


if(isset($_GET['Role4Graph1']))
{
	if($_GET['Role4Graph1'] !="")
	$word = $_GET['Role4Graph1'];


if($word == "'Healthcare Technology Trends'")
{
$search_words = "disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring, safe, secure, bad, poor, risk, defective, boon, positive, negative";
$search_words2="global payment, emergency, hospitalization, pathology, trauma center, disease management, process improvement, disease management, patient care, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, healthcare system, clinical research, medical education, radiology, clinical data, medication history, hospital measurement, biosurveillance, health information, hospital data, hospital security, accident investigation, equipment maintenance";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Healthcare Competition Technology Trends'")
{
$search_words = "disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring, safe, secure, bad, poor, risk, defective, boon, positive, negative";
$search_words2="global payment, emergency, hospitalization, pathology, trauma center, disease management, process improvement, disease management, patient care, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, healthcare system, clinical research, medical education, radiology, clinical data, medication history, hospital measurement, biosurveillance, health information, hospital data, hospital security, accident investigation, equipment maintenance";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

if(isset($_GET['Role4Graph2']))
{
	if($_GET['Role4Graph2'] !="")
			
	$word = $_GET['Role4Graph2'];

if($word == "'Customer Experience Trends'")
{
//$must_words = "Metlife";
$search_words="insurance, digital, social media, platform, tech, mobility, mobile, solution, architecture, system, CRM system, response system, application, apps, cyber attack, cybersecurity, insurance app, analytics, insurance analytics, gadgets, robots, data encryption, system, core systems, core modernization, innovation";
}

	$res=include_words($search_words);	

	if($res != "")
	$clause .= " and (" . $res . ")";

}



if(isset($_GET['Role4Graph1']))
{
	if($_GET['Role4Graph1'] !="")
	$word = $_GET['Role4Graph1'];


if($word == "'Healthcare Technology Trends'")
{
$search_words = "disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring, safe, secure, bad, poor, risk, defective, boon, positive, negative";
$search_words2="global payment, emergency, hospitalization, pathology, trauma center, disease management, process improvement, disease management, patient care, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, healthcare system, clinical research, medical education, radiology, clinical data, medication history, hospital measurement, biosurveillance, health information, hospital data, hospital security, accident investigation, equipment maintenance";
$not_include_words="Stadium, Joy,  seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
}
if($word == "'Healthcare Competition Technology Trends'")
{
$search_words = "disappointed, unhappy, pathetic, inexcusable, loss, at loss, innovative, good, outstanding, efficient, eye opener, beneficial, customer centric, focused, affordable, inexperience, expensive, unavailable, unacceptable, helpful, thank, insightful, aware, effective, cure, boost, manage, rewarding, profitable, patient friendly, caring, safe, secure, bad, poor, risk, defective, boon, positive, negative";
$search_words2="global payment, emergency, hospitalization, pathology, trauma center, disease management, process improvement, disease management, patient care, service enhancement, intensive care, drug innovation, industry analysis, DIY health options, affordable care, digital, electronic medical record, healthcare system, clinical research, medical education, radiology, clinical data, medication history, hospital measurement, biosurveillance, health information, hospital data, hospital security, accident investigation, equipment maintenance";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

if(isset($_GET['Role4Graph2']))
{
	if($_GET['Role4Graph2'] !="")
	$word = $_GET['Role4Graph2'];


if($word == "'Patient Health Management'")
{
$search_words="late, delayed, delay, late phase delay, over a month, unduly long, too much time, pending, overdue, what is sla, undue time taken, time waste, setback, retard, postpone, defer, time delay, untimely, late admission, competitive, world class, friendly, timely, excellent, exceptional, qualitative, recommend, impressed, refer, superior, helpful, beneficial";
$search_words2 = "mediclaim, insurance, emergency, OPD, doctor, hospitalization, pathology, trauma center, helpdesk, risk management, customer rating, vaccination, hygiene, checkup, disease management, healthcare package, process improvement, TPA, disease management, blood bank, ambulance, healthcare campaigns, partnership, security, nursing staff, emergency, hospital amenity, patient satisfaction, organ donation, service enhancement, intensive care";
$not_include_words="Stadium, Joy, seating, seat, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father�s day, floor, show, nfl tickets, intern, concert, motor racing";
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

/*********** Role 4 ends ***************/


?>
