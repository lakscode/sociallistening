<div style="float:right; width:20%;margin-right:1%;height:100%">
<img src='images/bell1.png' id="noti" style='margin-top:30%;width:50%;' />
</div>

<div id="divNotify" class='divNotify'>
 	<!-- <div class="alert-box error"><span>error: </span>error message here.</div>
	<div class="alert-box success"><span>success: </span>success message here.</div>
	<div class="alert-box warning"><span>warning: </span> warning message here.</div>
	<div class="alert-box notice"><span>notice: </span>	 notice message here.</div> -->
	<div class="alert-box warning" id='negative_sentiment_notification'><span>warning: </span> <?php include("functions_php/GetSentiments.php"); ?>.</div>
	<div class="alert-box notice" id='peak_word_notification'><span>notice: </span> <?php include("functions_php/NotifyInsight.php"); ?>.</div>
</div>