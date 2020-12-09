	<?php 
	include("../db.php");
	include("QueryString.php");
	$querystring="";
	$client="";
	if(isset($_GET['brand']))
	{
	//$querystring=" and brandid in (select brandid from brands where brand like '%" .  $_GET['brand'] ."%') ";

	
	$query ="SELECT keywords FROM brands where brand like '%" . $_GET['brand'] . "%'";   
$rows=mysql_query($query);
$clients=array();
while ($row = mysql_fetch_array($rows))
{
			$keywords_arr = explode(", ", $row["keywords"]);
			foreach($keywords_arr AS $key_word)
			{	
			
			$clauses[]="text LIKE '%" .  $key_word . "%'";
			}
			$clause1=implode(' OR ' ,$clauses);
			$clients[]= $clause1;
}
	$client1=implode(' OR ' ,$clients);


if($client1 != "")
$client = " and (" . $client1 . ") ";	
$querystring .= $client; 
}
	
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


	//echo " and company like '%" . $_GET['company'] . "%'";
	$searchwords_arr[]="";
	$searchword_cnt=0;

		$searchwords_arr[$searchword_cnt]= "General Surgery";
		$searchword_cnt++;

		$searchwords_arr[$searchword_cnt]= "Cardiology";
		$searchword_cnt++;

		$searchwords_arr[$searchword_cnt]= "Orthopedics";
		$searchword_cnt++;	

		$searchwords_arr[$searchword_cnt]= "Urology";
		$searchword_cnt++;	

		$searchwords_arr[$searchword_cnt]= "ENT";
		$searchword_cnt++;	

		$searchwords_arr[$searchword_cnt]= "Gynecology";
		$searchword_cnt++;	

		$searchwords_arr[$searchword_cnt]= "Emergency";
		$searchword_cnt++;			
		
	$ar_sub="";
$max_date="";
$min_date="";
for ($x = 0; $x < $searchword_cnt; $x++) {
$word =$searchwords_arr[$x];
	


$search_words="";
$search_words2="";
$not_include_words="";
$clause_keywords="";

if($word == "General Surgery")
{
$search_words="critical, general, invasive, stabilize, intensive, specialty, improve, major, minor, removal, repair, surgical, proficient, trained, expert, lower, perform, complex, survive, competitive, failure, malignant, experience, skill, superior, well, good, bad, delayed, late, loss, excellent, superb, diagnose, fear, mistake, benefit, brilliant";
$search_words2="surgery, gastric, general, procedure, surgeon, hospital, trauma center, nursing home, healthcare center, medicine, laparoscopic, abdominal, oxygen, transplant, implant, blood, needle, procedures, hemorrhoids, laser, bladder, dentistry, liposuction, death, operation theater, kidney, cataract, shoulder, stitches, surgical equipment, gloves, scissors, surgeries, artery, fiber, Lasik, birth, surgery screws, preparation, anesthesia, fissure, colon, abdominal, pancreas, soft tissue, bowel, liver, clinical, tumor";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events, tablets, color, ride";
}


if($word == "Cardiology")
{
$search_words="implant, invasive, blockage, preventive, rupture, prolapsed, pump, failure, attack, arrest, syndrome, expert, competitive, lower, well, diagnose, painful, fear, mistake, appreciate, poor, graft, disappointed, exhaustive, benefit, proficient, critical, intensive, superior, malignant, transplant, benefit, brilliant, excellent, swelling, superb
";
$search_words2="palpitation, cardiology, heart, transcription, cholesterol, cardiologist, blood, cardiac, pacemaker, cardiovascular, valve, veinous, ECG, electrocardiogram, tachycardia, sonographer, hospital, nursing home, trauma center, healthcare center, medicine, hydraulic, pulmonary, congenital heart disease, cardiomyopathy, chest, myocardium, amyloid, myxoma, coronary, cholesterol, cardiopulmonary, sinoatrial, angina, systole, cardiothoracic, echocardiography, cardionetics, artery, heartbeat, ectopic, ventricle, hypertrophic, valsalva, pulse, stent, polycythemia, atherectomy, aneurysm, pericardium, clot, hematologist, atrium, ventricular, atrial, fibrillation, defibrillation, stenosis, by pass, restenosis, aortic";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events, tablets, color, ride, shape";
}

if($word == "Orthopedics")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";
$search_words2="orthopedic, neck, massage, arthroscopy, x-rays, surgeon, tendon, chiropractor, femur, nursing home, hospital, healthcare center, medicine, trauma center, muscle, osteoclast, osteopathy, intramedullary, hip replacement, laminectomy, tear, meniscectomy, ulna, knee, deformities, fracture, joints, muscoskeletal, shoulder, limbs, swelling, meloxicam, scoliosis, ankle, disc, wrist, vertebrae, calcium, bone, spine, foot, rheumatoid, implants, arthroplasty, podiatrist, osteogenesis, elbow, tendonitis, arthritis, cervical, ortho, lumbar, physiotherapy, radiograph, cervical";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Urology")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";
$search_words2="urology, circumcision, prostate, circumcise, genital, endocrinology, vasectomy, urinary tract infection, genitourinary, urothelium, hydrocil, epididymitis, catheter, catheterization, endourology, urine routine, urine culture, hydrocephalus, urofluometery, testosterone, urethra, urine, bladder, bedwetting, hernia, convulsions, sensitivity, kidney stone, enuresis, testicles, cryptorchidism, urolithiasis, cystitis, menopause, dilatation, urinanalysis, reflux, inflammation, stricture, prostatectomy, ureter, urethra, urethral, testicular, lithotripsy";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "ENT")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";

$search_words2="hear, deaf, hearing, tinnitus, sleep, throat, nose, ear, otorhinolaryngologists, apnea, otology, depression, auditory, eardrum, Eustachian, neurotology, cochlear, acoustic, mastoiditis, otitis, esophagus, rhinitis, nasal, browlift, salivary, palate, genioplasty, mandible, thyroid, adenoidectomy, polyps, spasmodic, dysphonia, pituitary, decannulation, deafness, laryngomalacia, mitochondrial, dizziness, mumps, tonsillitis, velopalatine, vascular, swallowing, mouth ulcer";

$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Gynecology")
{
$search_words="painful, swelling, diagnose, fear, removal, improve, drastic, bad, good, overcome, perform, recommend, apply, brilliant, disappointed, setback, benefit, expert, competitive, superior, proficient, intensive, well, poor, implant, transplant, rupture, failure, invasive, mistake, graft, excellent, syndrome, critical, lower, superb, malignant, good, bad, loss";
$search_words2="fertility, pregnant, sperm, reproductive, fallopian, uterus, vagina, pregnancy,, contraceptive, embryo, catheter, hysterectomy, restoration, tightening, hymen, gynaecology, hymenoplasty, labiaplasty, labia, vaginoplasty, bleeding, hymen, obstetrics, womb, childbirth, progestogen, caesarean, curettage, ovulation, gynography, ovarian, dysmenorrhoea, oophorectomy, amenorrhoea, menorrhagia, infertility, vaginitis, abortion, swelling, conceive, miscarriages, abdomen, puberty, premature, endometriosis";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events";
}

if($word == "Emergency")
{
$search_words="urgent, help, immediate, deadly, fast, quick, sudden, major, on  time, save, rescue, care, risk, important, concern, situation, on call, support, recover, worse, prevent, avert , rupture, intensive, critical";
$search_words2="accident, ambulance, disease, ICU, doctor, hospitalization, 24x7, SOS, clinical, patient, critical, bleeding, heart attack, breakdown, medicine, hospital, nursing home, trauma center, healthcare center, medical, fire, unconscious, fatal, fracture, 911, first aid, resuscitation, suicide, epidemic, collapse, breathlessness, poison, casualty, outbreak, cardiac arrest";
$not_include_words="tyres, spaceships, manufacturers, mission, buses, images,  vehicles, pipes, prism, plastics, cosmetics, Stadium, ticket, going, seating arrangement, celebrities, catwalk, super bowl, fuck, fucking, row, meet up, apply, job, Olympic, hiring, summer event, winter event, event, father’s day, floor, show, intern, concert, motor racing, sports events";
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
$query ="";
if($c_date =="")
{
	if( $_SESSION['fixed_data'] == "")
	{
		$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 7 DAY  " . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";
	}
	else
	{
		$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE " . $_SESSION['fixed_data'] . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published"; 
	}
}
else
{
	$query ="SELECT DATE_FORMAT(DATE(published),'%Y,%c,%d') as pDate, COUNT(*) as pCount FROM listeningdata WHERE DATE(published) = '" .  $c_date . "' " . $clause ." " . $querystring ."  GROUP BY DATE(published) order by published";   
}

//echo $word . '<br>' .  $query . '<br>';

	$rows=mysql_query($query);

	$ar_total = FormatChartData($word, $rows);
	
	$ar_sub .=$ar_total . "]~";
	$ar_total = "";
	}
		
	$ar_sub=substr($ar_sub, 0, -1);  

	echo $ar_sub;
	?>
