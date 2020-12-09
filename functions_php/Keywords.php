<?php
function ($word_type, $word)
{
$search_words="";
$search_words2="";
$not_include_words="";
if($word_type== 'instype')
{
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

}
}
?>

