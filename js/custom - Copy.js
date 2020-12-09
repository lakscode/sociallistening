function popupclose(id)
{
$('#divMenu').hide();
  document.getElementById(id).style.display="none";
  document.getElementById('fade').style.display='none';
}


jQuery.fn.center = function () {
    this.css("position","absolute");
	var vTop=Math.max(0, (($(window).height() - $(this).outerHeight()) / 2));
	if(vTop < 130) vTop = 140;
    this.css("top", vTop + "px");
	
	var vLeft = Math.max(0, (($(window).width() - $(this).outerWidth()) / 2));
	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	vLeft=random;
	
	if(vLeft < 80) vLeft = 80;
    this.css("top", vTop + "px");
	
    this.css("left",  vLeft + "px");
    return this;
}

function viewMenu(e, val)
	{
	  $('#divMenuMain').hide();
//	alert( "pageX: " + e.pageX + ", pageY: " + e.pageY );
    $('#divMenu').show();
	$("#divMenu").css( {position:"relative", top:e.pageY-100, left:e.pageX});
	document.getElementById("btnLang").onclick = function() {createDynamicLangChart(val);	$('#divMenu').hide();};

	document.getElementById("btnSite").onclick = function() {createDynamicSiteChart(val);	$('#divMenu').hide();};
	
	document.getElementById("btnPosts").onclick = function() {createDynamicPosts(val);	$('#divMenu').hide();};	
	
	document.getElementById("btnSentiment").onclick = function() {createDynamicSentimentChart(val);	$('#divMenu').hide();};	
		
	document.getElementById("btnSource").onclick = function() {	createDynamicSourceChart(val);	$('#divMenu').hide();};


	}

function viewMainMenu(e, val)
	{

	//$('#divMenu').hide();
    $('#divMenuMain').show();
	$("#divMenuMain").css( {position:"relative", top:e.pageY-100, left:e.pageX});
	
	document.getElementById("btnType").onclick = function() {
	localStorage.setItem("ifunction_date", "");
	localStorage.setItem("itype_date", "");
							// localStorage.setItem("itype_date", val);
							 createDynamicInsTypeChart(val);	$('#divMenuMain').hide();};

	document.getElementById("btnFunctions").onclick = function() {
	//localStorage.setItem("ifunction_date", val);
		localStorage.setItem("ifunction_date", "");
	localStorage.setItem("itype_date", "");
	createDynamicInsFunctChart(val);	
	$('#divMenuMain').hide();
	};
	


	}
	
	
	
$(function () {
localStorage.setItem("company", "");
localStorage.setItem("itype", "");
localStorage.setItem("ifunction", "");
 localStorage.setItem("ifunction_date", "");
 createDynamicCompetitionChart("");
	
});

function createOutline(divName)
{
var id="temp" + divName + Math.floor((Math.random() * 10) + 1);
	var div = document.createElement('div');
	div.id=id;
	div.className="ui-widget-content divData";
	div.style.backgroundColor = '#334567';
	div.style.height = '445px';
	$(div).center();
	$('#chartcontainer').append(div);
	document.getElementById(id).style.display="block";
	var divTitle = document.createElement('div');
	divTitle.style.height = '30px';
	divTitle.id=id+"hdr";
	divTitle.style.backgroundColor = '#CCC';
	$('#'+id).append(divTitle);
	var temp = localStorage.getItem("company");
	if(temp != "")
	temp = "<b>" + temp + "<b>";
	else
	temp ="";

	var ifunction = localStorage.getItem("ifunction");
	var itype = localStorage.getItem("itype");

	if(ifunction != "")
	temp += "-> <b>" + ifunction + "<b>";


	if(itype != "")
	temp += "-> <b>" + itype + "<b>";	
	
	$(divTitle).append('<span  style="margin-top:0; float:left;left: 0;width:80%;height:24px;padding-top:4px; padding-left:5px;" >'  + temp +  '</span>');
	
	$(divTitle).append('<img src="images/close.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;" onclick="popupclose(\'' + id  + '\')" />');

	var div1 = document.createElement('div');
	div1.id=id+"sub";

	$("#" + id).append(div1);
		$("#" + id+"sub").draggable({ disabled: true });
	$("#" + id).draggable({  containment: "window" });
	return id;
}
	
	function createDynamicCompetitionChart(val)
	{

	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	var id= createOutline("cmpt"+random);
	var url="functions_php/Competition.php";
	var fName="cmpt";
	getData(url, id, fName);
	}
	
	function createDynamicInsTypeChart(val)
	{

		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");
	
	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	var id= createOutline("itype"+random);
	var url="functions_php/InsType.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
	var fName="itype";
	//alert(url);
	getData(url, id, fName);
	}

	function createDynamicInsFunctChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");
		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("ifunct"+random);
		var url="functions_php/InsFunct.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		//alert(url);
		var fName="ifunct";
		getData(url, id, fName);
	}

	function createDynamicLangChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");
		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("lang" +random);
		var url="functions_php/Lang.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		var fName="lang";
		//alert(url);
		getData(url, id, fName);
	}	
	
	function createDynamicSiteChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");
		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("site"+random);
		var url="functions_php/Site.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		var fName="site";
		getData(url, id, fName);
	}
	
	
	function createDynamicWordChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("pie"+random);
		var url="functions_php/Site.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		var fName="pie";
		getData(url, id, fName);
	}
	

	
	function createDynamicWordsChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");			
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("word"+random);
		var url="functions_php/Topwords.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		var fName="word";
		getData(url, id, fName);
	}
	
	


	function createDynamicSourceChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");	
		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("source"+random);
		var url="functions_php/Source.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		var fName="source";
		getData(url, id, fName);
	
	}	
	
	function createDynamicSentimentChart(val)
	{
	
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
			var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");	
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("senti"+random);
		var url="functions_php/Sentiment.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype + "&itdate=" + itype_date + "&ifdate=" + ifunction_date;
		//alert(url);
		var fName="sentiment";
		getData(url, id, fName);
	
	}	
	
	function createDynamicDatewiseChart(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("datewise" +random);
		var url="functions_php/Datewise.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype;
		var fName="datewise";
		getData(url, id, fName);
	
	}	
	
	function createDynamicPosts(val)
	{
		var company = localStorage.getItem("company");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("posts" + random);
		var url="functions_php/Posts.php?company=" +company + "&ifunction=" + ifunction + "&itype=" + itype;
		var fName="posts";
		getData(url, id, fName);
	
	}	
	
	
	/**************** Get data from php service ***************************/
	
function getData(url, id, fName)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

		var res=xmlhttp.responseText;
		//dynamicLineChart(id+"sub", res);
	
		if(fName == "semicircle") {	dynamicSemiCircleChart(id+"sub", res); }
	
		if(fName == "column") { dynamicColumnChart(id+"sub", res); }
		
		if(fName == "site") { dynamicSiteChart(id+"sub", res); }
		
		if(fName == "lang") { dynamicLangChart(id+"sub", res); 	}
		
		if(fName == "sentiment") { dynamicSentimentPieChart(id+"sub", res); } 
		
		if(fName == "source") {dynamicSourceChart(id+"sub", res); }
		
		if(fName == "datewise") {dynamicDatewiseChart(id+"sub", res); }
		
		if(fName == "posts") { dynamicPosts(id+"sub", res); }
		
		if(fName == "cmpt") { dynamicCompetitionChart(id+"sub", res); }
		
		if(fName == "itype") { dynamicInsTypesChart(id+"sub", res); }	
		
		if(fName == "ifunct") { dynamicInsFunctChart(id+"sub", res); }			
		
	
	
    }
  }
 
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
