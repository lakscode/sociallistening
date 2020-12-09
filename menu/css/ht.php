	<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>V-Listen</title>
  <link rel="stylesheet" href="js/jquery-ui-1.8.21.custom.css">
    <link rel="stylesheet" href="js/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
 <!-- <script src="js/jquery-1.9.1.min.js"></script> -->
  <script src="js/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/post.css">
	    <link rel="stylesheet" href="css/glyphicons.css">
	    <link rel="stylesheet" href="css/gradiants.css">
			    <link rel="stylesheet" href="css/config.css">
			    <link rel="stylesheet" href="css/callout.css">
			    <link rel="stylesheet" href="css/header.css">
			    <link rel="stylesheet" href="css/notification.css">
			    <link rel="stylesheet" href="css/tables.css">
    <script src="js/jquery.zindex.js"></script>
  <script>
  $(function() {
  $( "#container" ).draggable();
 $( "#subchart" ).draggable();
  });
  </script>

<script src="js/common.js"></script>
<script src="js/custom.js"></script>

</head>


<body class="bg" onload="graphDisplay('3')">
	<div class="pgheader">
<div class='cnt'>
<div style="float:left;height:100%; width:20%;display:table-cell; vertical-align:middle ">
<div style="width:40%;float:left;"> <a href="index.php" ><img src="images/icon1.png" style="width:100%;float:left;" /></a></div>

<div  style="width:50%;float:left;">
<img src="images/title.png" style="width:100%;" />
</div>

</div>
<div id='cntrls' style="float:right;height:100%;  width:20%;display:table-cell; vertical-align:middle">
<div style="float:right; display:inline;
width:20%;
height:100%;
right:0;
color: #afdefa;
padding:5%;">

<a id="showRight" width="100%" height="100%" style="margin:0 auto"><img src="images/menu-icon.png" style="margin:0 auto" width="75%" /></a>
</div>
<div style="width:25%;float:right; margin-right:1%;margin-top:5%; height:100%">
<img src="images/logo.png" style="width:100%;height:100%;" />
</div>
<div style="float:right; width:20%;margin-right:1%;height:100%">
<img src='images/user.png' id="show" style='margin-top:30%;width:50%;' />
</div>

<div id="divUser" class='divNotify'>  
     <p><strong>Lakshmi</strong> logged in as <b><em>CMO</em></b></p>
     <a href="#" onclick="functLogout()">Logout	</a>
</div> <div style="float:right; width:20%;margin-right:1%;height:100%">
<img src='images/bell1.png' id="noti" style='margin-top:30%;width:50%;' />
</div>

<div id="divNotify" class='divNotify'>
 	<!-- <div class="alert-box error"><span>error: </span>error message here.</div>
	<div class="alert-box success"><span>success: </span>success message here.</div>
	<div class="alert-box warning"><span>warning: </span> warning message here.</div>
	<div class="alert-box notice"><span>notice: </span>	 notice message here.</div> -->
	<div class="alert-box warning" id='negative_sentiment_notification'><span>warning: </span> .</div>
	<div class="alert-box notice" id='peak_word_notification'><span>notice: </span> 
Metlife<i> on</i> 2015-7-13, <i> Total Posts</i>:519 <br> Trending words <a href="#" onclick="getInsights('2015/07/13', 'metlife','Metlife')">metlife</a>:589, <a href="#" onclick="getInsights('2015/07/13', 'swift','Metlife')">swift</a>:285, <a href="#" onclick="getInsights('2015/07/13', 'taylor','Metlife')">taylor</a>:276, <a href="#" onclick="getInsights('2015/07/13', 'stadium','Metlife')">stadium</a>:255, Aviva<i> on</i> 2015-7-16, <i> Total Posts</i>:337 <br> Trending words <a href="#" onclick="getInsights('2015/07/16', 'aviva','Aviva')">aviva</a>:176, <a href="#" onclick="getInsights('2015/07/16', 'test','Aviva')">test</a>:18, <a href="#" onclick="getInsights('2015/07/16', 'strips','Aviva')">strips</a>:17, <a href="#" onclick="getInsights('2015/07/16', 'los','Aviva')">los</a>:16, Geico<i> on</i> 2015-7-09, <i> Total Posts</i>:359 <br> Trending words <a href="#" onclick="getInsights('2015/07/09', 'geico','Geico')">geico</a>:276, <a href="#" onclick="getInsights('2015/07/09', 'job','Geico')">job</a>:37, <a href="#" onclick="getInsights('2015/07/09', 'commercial','Geico')">commercial</a>:29, <a href="#" onclick="getInsights('2015/07/09', 'insurance','Geico')">insurance</a>:28, LIC<i> on</i> , <i> Total Posts</i>: <br> Trending words ICICI<i> on</i> , <i> Total Posts</i>: <br> Trending words .</div>
</div></div>

</div>

<div style="clear:both"></div>

		<link rel="stylesheet" type="text/css" href="menu/css/component.css" />
		<script src="menu/js/modernizr.custom.js"></script>


		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<!--<h3>Menu</h3> -->
			<ul>
			<li><a href="home.php">Home</a>	</li>		
			<li><a href="reporting.php">Reporting</a></li>	
			<li><a href="#">Listening</a></li>	
			
			<li><a href="#">Settings</a>
				  <ul>
					<li><a href="config_brands.php">Brands</a></li>
					<li><a href="config_persona.php">Persona based Keywords</a></li>
				  </ul>
			</li>	
			<li><a href="#">Notifications</a></li>			
			</ul>
		</nav>
	
		<script src="menu/js/classie.js"></script>
		<script>
			var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				body = document.body;

		
			showRight.onclick = slideMenuOnClick;
			
			function slideMenuOnClick()
			{
			$('#divUser').hide();  
$('#divNotify').hide(); 
				classie.toggle( this, 'active' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRight' );
			}
		

			function disableOther( button ) {
			
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
				
			}
		</script>
	
</div>

<div style="clear:both"></div>

<script type="text/javascript" >
(function() {
getSentiments('metlife','negative_sentiment_notification');
getPeakWords('metlife','peak_word_notification');

$('#divUser').hide();
$('#divNotify').hide();
document.getElementById('show').onclick = function(e) {
//var x=slideMenuOnClick();

var id='cbp-spmenu-s2';
var myClassName=" cbp-spmenu-open"; //must keep a space before class name
var d;
d=document.getElementById(id);
d.className=d.className.replace(myClassName,"");

   var w = window.innerWidth;
 	 		var parentPos = document.getElementById('cntrls').offsetLeft;
		var t= document.getElementById('show').offsetTop;
		var ht = document.getElementById('show').height;
		var options = {};
		var wd='18%';
			if(w < 700)
			{
			parentPos= parentPos-100;
			wd='40%';
			}

		$("#divUser").css( {position:"absolute", width:wd, top:ht+t+1,left:parentPos});
		$( "#divUser" ).toggle( 'blind', options, 500 );
		$('#divNotify').hide();
    };

document.getElementById('noti').onclick = function(e) {
//var x=slideMenuOnClick();
var id='cbp-spmenu-s2';
var myClassName=" cbp-spmenu-open"; //must keep a space before class name
var d;
d=document.getElementById(id);
d.className=d.className.replace(myClassName,"");


		var t= document.getElementById('noti').offsetTop;
		var ht = document.getElementById('noti').height;
		var options = {};
		var parentPos = document.getElementById('cntrls').offsetLeft;
		   var w = window.innerWidth;
			var wd='18%';
			if(w < 700)
			{
			parentPos= parentPos-100;
			wd='40%';
			}

		$("#divNotify").css( {position:"absolute", width:wd, top:ht+t+1,left:parentPos});
		$("#divNotify" ).toggle( 'blind', options, 500 );
		$('#divUser').hide();

    };

	document.getElementById('peak_word_notification').onclick = function(e) {
		$('#divNotify').hide();
		
		//var cont=document.getElementById('peak_word_notification').innerHTML;
		//alert(cont);
		//var t_dt=cont.split(",")
		//alert(t_dt[0]);
		//var lastFive = t_dt[0].substr(t_dt[0].length - 9); 
		//alert(lastFive);
		//lastFive = lastFive.replace(/-/g,'/');
		//var date = new Date(lastFive);
		//alert(date);
		//var modifiedDate = date.getTime();
		//alert(modifiedDate);
		//var unixdate = new Date(modifiedDate);
		//alert(unixdate);
		
		//localStorage.setItem("ifunction_date", modifiedDate);
		//localStorage.setItem("brand", 'metlife');
		//createDynamicPosts("metlife");

		// $word(0); -- not sure why it is required
		//createDynamicInsightFromNotify();
	};

	document.getElementById('negative_sentiment_notification').onclick = function(e) {
	var cont=document.getElementById('negative_sentiment_notification').innerHTML;
	//alert(cont);
	var t_dt=cont.split(",")
	//alert(t_dt[0]);
	var lastFive = t_dt[0].substr(t_dt[0].length - 9); 
	
	//alert(lastFive);
	lastFive = lastFive.replace(/-/g,'/');
		$('#divNotify').hide();
		var date = new Date(lastFive);
		
		//alert(date.getFullYear()+"-" +(date.getMonth()+1)+"-"+date.getDate()); // add one to month as Jan starts from zero
		//date.setDate(date.getDate() - 9);// pusing to one date below
		//alert(date.getFullYear()+"-" +(date.getMonth()+1)+"-"+date.getDate());
		var modifiedDate = date.getTime(); //= (new Date(date.getFullYear()+"-" +(date.getMonth())+"-"+date.getDate()).getTime());
		
		alert(modifiedDate);
		
		localStorage.setItem("ifunction_date", modifiedDate);
		localStorage.setItem("n_sentiment","-1");
		localStorage.setItem("brand", 'Metlife');
			createDynamicPosts("metlife");

		
			
		
	};

})();
</script>

<div id="chartcontainer">

	
</div>

<div style="clear:both"></div>
<div id="divMenu" style="display:none">
<a id="btnLang">View by Language</a>
<a id="btnPosts">View Posts</a>
<a id="btnSite">View by Site</a>
<a id="btnSource">View by Source</a>
<a id="btnSentiment">View by Sentiment</a> 
<a id="btnWords">View by Top Words</a> 
<!--<a id="btnTopWords">Word Cloud</a> -->
</div><div id="chartMinWindows">

</div>

<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/highcharts-more.js"></script>
<!--<script src="js/modules/exporting.js"></script> -->
<script src="js/modules/funnel.js"></script>

<!--
<script src="exporting-server/export-csv.js"></script>

<script src="js/modules/canvas-tools.js"></script>
<script type="application/javascript" src="exporting-server/jspdf.min.js"></script> -->
<!-- Export Client-Side module -->
<!--<script src="exporting-server/highcharts-export-clientside.js"></script>
-->



<script src="js/custom_default.js"></script>
<script src="js/custom_instype.js"></script>
<script src="js/custom_insfunct.js"></script>

<script src="js/custom_lang.js"></script>
<script src="js/custom_site.js"></script>
<script src="js/custom_sentiment_pie.js"></script>
<script src="js/custom_source.js"></script>
<script src="js/custom_posts.js"></script>
<script src="js/custom_words.js"></script>
<script src="js/custom_theme.js"></script> 
<script src="js/jquery.awesomeCloud-0.2.js"></script>
<script src="js/custom_wordcloud.js"></script>
<script src="js/custom_insight.js"></script>
<script src="js/custom_custops.js"></script>
<script src="js/custom_claimsops.js"></script>
<script src="js/custom_custacq.js"></script>
<script src="js/custom_iccustsops.js"></script>
<script src="js/custom_industryview.js"></script>
<script src="js/custom_brandandmarket.js"></script>
<script src="js/custom_salesandmarket.js"></script>

<script src="js/custom_techtrends.js"></script>
<script src="js/custom_custexp.js"></script>

<div style="clear:both"></div>
<div id="divMenu" style="display:none">
<a id="btnLang">View by Language</a>
<a id="btnPosts">View Posts</a>
<a id="btnSite">View by Site</a>
<a id="btnSource">View by Source</a>
<a id="btnSentiment">View by Sentiment</a> 
<a id="btnWords">View by Top Words</a> 
<!--<a id="btnTopWords">Word Cloud</a> -->
</div><div id="divMenuMain" style="display:none">
<!--
<input type="button" id="btnLang" value="View by Language" />
<input type="button" id="btnRegion" value="View by Region" />
<input type="button" id="btnPosts" value="View Posts" />
<input type="button" id="btnSite" value="View by Site" />
<input type="button" id="btnTrend" value="Datewise Trend" />
<input type="button" id="btnSource" value="View by Source" />
<input type="button" id="btnSentiment" value="View by Sentiment" /> 
-->
<a id="btnType">View by Insurance Types</a>
<a id="btnFunctions">View by Insurance Functions </a>

</div></body>
</html>