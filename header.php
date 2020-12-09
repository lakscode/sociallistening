	<?php error_reporting(0);
	session_start();

if($_SESSION['userid'] == "")
echo '<script>window.location.href="index.php";</script>';

	?>
<div class="pgheader">
<div class='cnt'>
<div style="float:left;height:100%; width:20%;display:table-cell; vertical-align:middle ">
<div style="width:25%;float:left;"> <a href="index.php" ><img src="images/icon1.png" style="width:100%;float:left;" /></a></div>

<div  style="width:50%;float:left;">
<!--<img src="images/title.png" style="width:100%;" />-->
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
<!--<div style="width:25%;float:right; margin-right:1%;margin-top:5%; height:100%">
<img src="images/logo.png" style="width:100%;height:100%;" />
</div>-->
<?php include('header_user.php'); ?>
<?php include('header_notify.php'); ?>
</div>

</div>

<div style="clear:both"></div>
<?php
  include("db.php");
 include("menu.php");?>

</div>

<div style="clear:both"></div>

<script type="text/javascript" >
(function() {
getSentiments('Mayo Clinic','negative_sentiment_notification');
getPeakWords('Mayo Clinic','peak_word_notification');

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
	};

	document.getElementById('negative_sentiment_notification').onclick = function(e) {
	//alert(localStorage.getItem("sourcebrand"));
	var cont=document.getElementById('negative_sentiment_notification').innerHTML;
	var t_dt=cont.split(",")
	var lastFive = t_dt[0].substr(t_dt[0].length - 9); 
		localStorage.setItem("peakDate",'');
		localStorage.setItem("peakWord", '');
		localStorage.setItem("peakBrand", '');
		localStorage.setItem("notify_date", lastFive);
		localStorage.setItem("n_sentiment","-1");
		localStorage.setItem("brand", localStorage.getItem("sourcebrand"));
		createDynamicPosts(localStorage.getItem("sourcebrand"));
		
	};

})();
</script>

