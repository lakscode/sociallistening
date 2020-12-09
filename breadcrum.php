			<?php
$url=$_SERVER['REQUEST_URI'];
$aHome=""; $aReport=""; $aListening=""; $aConfig="";
if(stristr($url,'home') == TRUE)
	{
		$aHome="active";
	}
if(stristr($url,'reporting') == TRUE)
	{
		$aReport="active";
	}	
if(stristr($url,'listening') == TRUE)
	{
		$aListening="active";
	}		
	
if(stristr($url,'configuration') == TRUE)
	{
		$aConfig="active";
	}		
	if($aReport=="" && $aListening=="" && $aConfig=="")
	{
	$aHome="active";
	}
	
?>

<div id="breadcrumContainer" class="breadCrum">

	<link rel='stylesheet' href='css/breadcrumb.css'>
	
	<style>
	
	* { margin: 0; padding: 0; }
body { font: 14px Georgia, serif; }

article, aside, figure, footer, header, hgroup,
menu, nav, section { display: block; }

#page-wrap { width: 960px; margin: 60px auto; }

h1 { font: normal 32px Helvetica, Arial, Sans-Serif; letter-spacing: -1px; margin: 0 0 15px 0; }
	.breadCrum
{
 border:2px solid #a0a0a0;
height:60px;
padding:10px;
position:fixed;
top:80px;
background: #47a3da;
display:block;
margin:0 auto;
width:100%;
 background: #FFF;
  font-family: Arial;
  color: #000;
  text-decoration: none;
  
}

	
		.breadcrumb { 
			list-style: none; 
			overflow: hidden; 
			font: 18px Helvetica, Arial, Sans-Serif;
		}
		.breadcrumb li { 
			float: left; 
		}
		.breadcrumb li a {
			color: white;
			text-decoration: none; 
			padding: 10px 0 10px 55px;
			background: brown;                   /* fallback color */
			background: hsla(243, 100%, 24%, 1); 
			position: relative; 
			display: block;
			float: left;
		}
		.breadcrumb li a:after { 
			content: " "; 
			display: block; 
			width: 0; 
			height: 0;
			border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
			border-bottom: 50px solid transparent;
			border-left: 30px solid hsla(243, 100%, 24%, 1);
			position: absolute;
			top: 50%;
			margin-top: -50px; 
			left: 100%;
			z-index: 2; 
		}	
		.breadcrumb li a:before { 
			content: " "; 
			display: block; 
			width: 0; 
			height: 0;
			border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
			border-bottom: 50px solid transparent;
			border-left: 30px solid white;
			position: absolute;
			top: 50%;
			margin-top: -50px; 
			margin-left: 1px;
			left: 100%;
			z-index: 1; 
		}	
		.breadcrumb li:first-child a {
			padding-left: 10px;
		}
		.breadcrumb li:nth-child(2) a       { background:        hsla(243, 100%, 30%, 1); }
		.breadcrumb li:nth-child(2) a:after { border-left-color: hsla(243, 100%, 30%, 1); }
		.breadcrumb li:nth-child(3) a       { background:        hsla(243, 100%, 38%, 1); }
		.breadcrumb li:nth-child(3) a:after { border-left-color: hsla(243, 100%, 38%, 1); }
		.breadcrumb li:nth-child(4) a       { background:        hsla(243, 100%, 49%, 1); }
		.breadcrumb li:nth-child(4) a:after { border-left-color: hsla(243, 100%, 49%, 1); }
		.breadcrumb li:nth-child(5) a       { background:        hsla(243, 100%, 64%, 1); }
		.breadcrumb li:nth-child(5) a:after { border-left-color: hsla(243, 100%, 64%, 1); }
		.breadcrumb li:last-child a {
		
			background: white !important;
			color: black;
			pointer-events: none;
 			cursor: default;
			
		}
		.breadcrumb li:last-child a:after { border: 0; }
		.breadcrumb li a:hover { background: hsla(243, 100%, 76%, 1); }
		.breadcrumb li a:hover:after { border-left-color: hsla(243, 100%, 76%, 1) !important; }
		
	</style>
	
		<ul class="breadcrumb">
			<li href="#" class="<?php echo $aHome;?>"><a href="#">Home</a></li>
	<?php if($aReport !="")  { ?>
	<li href="#" class="<?php echo $aReport;?>"><a href="#">Reporting</a></li>
	<li href="#" class="<?php echo $aReport;?>"><a href="#">View</a></li>
	<?php  	} 	?>
	<?php if($aListening !="") { ?>
	<li href="#" class="<?php echo $aListening;?>"><a href="#">Listening</a></li> 
	<?php  } 	?>
	
	<?php if($aConfig !="") { ?>	
	<li href="#" class="<?php echo $aConfig;?>"><a href="#">Configuration</a></li>
	<?php  } 	?>	
	
		<!--	<li><a href="#">Home</a></li>
			<li><a href="#">Configuration</a></li>
			<li><a href="#">Listening</a></li>
			<li><a href="#">Reporting</a></li> -->
		</ul>



</div>

