var zIndex=1;
window.onclick= function()
{
//alert('sdgg');
hideContextMenu();
}
function hideContextMenu()
{
$('#divMenu').hide();
$('#divMenuMain').hide();
}
function popupclose(id)
{
$('#divMenu').hide();
  document.getElementById(id).style.display="none";
  document.getElementById('fade').style.display='none';
}


jQuery.fn.center = function () {
    this.css("position","absolute");
	var vTop=Math.max(0, (($(window).height() - $(this).outerHeight()) / 2));

	var w = window.innerWidth;
    var h = window.innerHeight;

	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	vLeft=random;
	if(w < 700)
	vLeft=5;
	else if(vLeft < 80) vLeft = 80;

	if(h < 700)
	vTop = 40;

    this.css("top", vTop + "px");
    this.css("left",  vLeft + "px");
    return this;
}

function createOutline(divName, val, act_ins)
{

var id="temp" + divName + Math.floor((Math.random() * 10) + 1);
	var div = document.createElement('div');
	div.id=id;
	div.className="ui-widget-content divData";
	div.style.backgroundColor = '#334567';
	div.style.height = '80%';

	var w = window.innerWidth;
    var h = window.innerHeight;
	var wid="";
	var hei="";
	if(w < 700)
	{
	wid= w-30;
	hei= h-140;
	}
	else
	{
	wid= 500;
	hei= 445;
	}

	div.style.width = wid + "px";
	div.style.height = hei + "px";

	if(val == 1)
	{
	//$('#chartcontainer').style.cssFloat = "left";
		document.getElementById("chartcontainer").style.cssFloat = "left";
	//div.style.cssFloat = "left";
	div.style.marginLeft = "10px";
	div.style.marginTop = "10px";
	}
	else
	{
		div.style.top = '10%';
		div.style.left = '20%';
		$(div).center();
		div.style.position = "absolute";
	}
	$('#chartcontainer').append(div);
	document.getElementById(id).style.display="inline-block";
	var divTitle = document.createElement('div');
	divTitle.style.height = '30px';
	divTitle.id=id+"hdr";
	divTitle.style.backgroundColor = '#CCC';
	$('#'+id).append(divTitle);
	var temp = localStorage.getItem("brand");
	if(temp != "")
	temp = "<b>" + temp + "<b>";
	else
	temp ="";

	var ifunction = localStorage.getItem("ifunction");
	var itype = localStorage.getItem("itype");

	if(ifunction != "") temp += "-> <b>" + ifunction + "<b>";
	if(itype != "") temp += "-> <b>" + itype + "<b>";

	if(act_ins == 1)
	{
		$(divTitle).append('<div style="margin-top:0; float:right;right: 0;width:54px;height:24px;"><img src="images/close.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;margin-left:5px;" onclick="popupclose(\'' + id  + '\')" /><img src="images/insight.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;" onclick="createDynamicInsightChart(\'' + id  + '\')" /></div>');
	//<img src="images/filter.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;" onclick="createDynamicInsightChart(\'' + id  + '\')" />
	}
	else
	{
		$(divTitle).append('<div style="margin-top:0; float:right;right: 0;width:60px;height:24px;"><img src="images/close.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;margin-left:5px;" onclick="popupclose(\'' + id  + '\')" /></div>');
	}
	//<img src="images/filter.png"  title="Close" style="margin-top:0; width:24px;height:24px;margin-left:5px;" onclick="popupclose(\'' + id  + '\')" />

		if(temp == "" && act_ins == 1)
	{
			var ititle = localStorage.getItem("insightstitle");
		temp = "<b>" + ititle + "<b>";
		}



	$(divTitle).append('<span  style="margin-top:0; font-size:60%; float:left;left: 0;width:80%;height:24px;padding-top:4px; padding-left:5px;" >'  + temp +  '</span>');




	var div1 = document.createElement('div');
	div1.id=id+"sub";

	$("#" + id).append(div1);
		$("#" + id+"sub").draggable({ disabled: true });

		if(val == 1)
		{
			$("#" + id).draggable({ disabled: true });
		}
	else
		{
			$("#" + id).draggable({  containment: "window" });
		}


	return id;
}

function viewMenu(e, val)
	{

	localStorage.setItem("peakDate", "");
	localStorage.setItem("peakWord", "");
	localStorage.setItem("peakBrand", "");

	$('#divMenuMain').hide();

	$("#divMenu").css( {position:"absolute", top:e.pageY-0, left:e.pageX});
	$('#divMenu').show();
	document.getElementById("btnLang").onclick = function() {createDynamicLangChart(val);	$('#divMenu').hide();};

	document.getElementById("btnSite").onclick = function() {createDynamicSiteChart(val);	$('#divMenu').hide();};

	document.getElementById("btnPosts").onclick = function() {createDynamicPosts(val);	$('#divMenu').hide();};

	document.getElementById("btnSentiment").onclick = function() {createDynamicSentimentChart(val);	$('#divMenu').hide();};

	document.getElementById("btnSource").onclick = function() {	createDynamicSourceChart(val);	$('#divMenu').hide();};

	document.getElementById("btnWords").onclick = function() {	createDynamicTopWordsChart(val);	$('#divMenu').hide();};

	/*document.getElementById("btnTopWords").onclick = function() {	createDynamicWordCloud(val);	$('#divMenu').hide();}; */


	}

function viewMainMenu(e, val)
	{

	$("#divMenuMain").css( {position:"absolute", top:e.pageY-0, left:e.pageX});
		$('#divMenuMain').show();
	document.getElementById("btnType").onclick = function() {
	localStorage.setItem("ifunction_date", "");
	localStorage.setItem("itype_date", "");
	 createDynamicInsTypeChart(val);
	 $('#divMenuMain').hide();
	 };

	document.getElementById("btnFunctions").onclick = function() {
	localStorage.setItem("ifunction_date", "");
	localStorage.setItem("itype_date", "");
	createDynamicInsFunctChart(val);
	$('#divMenuMain').hide();
	};



	}

function initStorageItems()
{
 	localStorage.setItem("brand","");
	localStorage.setItem("ifunction","");
	localStorage.setItem("itype","");
	localStorage.setItem("ifunction_date","");
	localStorage.setItem("itype_date","");
	localStorage.setItem("sentiment","");
	localStorage.setItem("source","");
	localStorage.setItem("lang","");
	localStorage.setItem("site","");
	localStorage.setItem("words","");
	localStorage.setItem("insightstitle", '');
	localStorage.setItem("custops", '');
	localStorage.setItem("claimsops", '');
	localStorage.setItem("revops",'');
	localStorage.setItem("iccustops",'');
	localStorage.setItem("indview",'');
	localStorage.setItem("brandandmarket",'');
	localStorage.setItem("salesandmarket",'');
	localStorage.setItem("techtrends",'');
}

function graphDisplay(opt)
{
if(opt == 1)
{
	initStorageItems();
	createDynamicCompetitionChart("");
}
else if(opt == 3)
{
	initStorageItems();
	createDynamicBrandAndMarketChart(1);
	createDynamicSalesAndMarketChart(1);
}
else if(opt == 4)
{

	initStorageItems();							
	createDynamicTechTrendsChart(1);
	createDynamicCustExpChart(1);
}
else if(opt == 5)
{
	initStorageItems();
	createDynamicCompetitionChart(1);
	createDynamicCustOperationsChart(1);
	createDynamicClaimsOperationsChart(1);
	createDynamicRevenueOperationsChart(1);
}
else if(opt == 6)
{
	initStorageItems();
	//createDynamicCompetitionChart(1);
	createDynamicInsCustOperationsChart(1);
	createDynamicIndustryViewChart(1);
}

}



	function createDynamicCompetitionChart(val)
	{

	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	var id= createOutline("cmpt"+random, val, 1);
	var url="functions_php/Competition.php?";
	var fName="cmpt";
	getData(url, id, fName);
	}

	function createDynamicInsightChart(val)
	{
	localStorage.setItem("insightstitle", 'Insights by Brands');
	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	var id= createOutline("insight"+random, val,0);
	var url="functions_php/Insight.php?";
	var fName="insight";
	getData(url, id, fName);
	}


	function createDynamicInsTypeChart(val)
	{
	localStorage.setItem("insightstitle","");
	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	var id= createOutline("itype"+random, val,0);
	var url="functions_php/InsType.php?";
	var fName="itype";
	getData(url, id, fName);
	}
	function createDynamicInsFunctChart(val)
	{
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("ifunct"+random, val,0);
		var url="functions_php/InsFunct.php?";
		var fName="ifunct";
		getData(url, id, fName);
	}

	function createDynamicCustOperationsChart(val)
	{
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("custops"+random, val,0);
		var url="functions_php/CustOperations.php?";
		var fName="custops";
		getData(url, id, fName);
	}

function createDynamicClaimsOperationsChart(val)
{
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("claimsops"+random, val,0);
		var url="functions_php/ClaimsOperations.php?";
		var fName="claimsops";
		getData(url, id, fName);
}

	function createDynamicBrandAndMarketChart(val){
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("brandandmarket"+random, val,0);
		var url="functions_php/BrandAndMarket.php?";
		var fName="brandandmarket";
		getData(url, id, fName);
	}


	function createDynamicSalesAndMarketChart(val){
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("salesandmarket"+random, val,0);
		var url="functions_php/SalesAndMarket.php?";
		var fName="salesandmarket";
		getData(url, id, fName);
	}

function createDynamicRevenueOperationsChart(val)
{
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("revops"+random, val,0);
		var url="functions_php/RevenueOperations.php?";
		var fName="revops";
		getData(url, id, fName);
}

function createDynamicInsCustOperationsChart(val)
{
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("iccustops"+random, val,0);
		var url="functions_php/InsClaimsCustOperations.php?";
		var fName="iccustops";
		getData(url, id, fName);
}

function createDynamicIndustryViewChart(val)
{
		localStorage.setItem("ifunction_date", "");
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("indview"+random, val,0);
		var url="functions_php/IndustryView.php?";
		var fName="indview";
		getData(url, id, fName);
}

	function createDynamicTechTrendsChart(val)
	{
			localStorage.setItem("ifunction_date", "");	
			localStorage.setItem("insightstitle","");
			var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
			var id= createOutline("techtrends"+random, val,0);
			var url="functions_php/TechTrends.php?"; 
			var fName="techtrends";
			getData(url, id, fName);
	}
	
	function createDynamicCustExpChart(val)
	{
			localStorage.setItem("ifunction_date", "");	
			localStorage.setItem("insightstitle","");
			var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
			var id= createOutline("custexp"+random, val,0);
			var url="functions_php/CustExperience.php?"; 
			var fName="custexp";
			getData(url, id, fName);
	}
	
	function createDynamicLangChart(val)
	{

		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("lang" +random, val,0);
		var url="functions_php/Lang.php?";
		var fName="lang";
		//alert(url);
		getData(url, id, fName);
	}

	function createDynamicSiteChart(val)
	{

		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("site"+random, val,0);
		var url="functions_php/Site.php?";
		var fName="site";
		getData(url, id, fName);
	}



	function createDynamicTopWordsChart(val)
	{
	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("words"+random, val,0);
		var url="functions_php/Topwords.php?";
		var fName="words";
		getData(url, id, fName);
	}




	function createDynamicSourceChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("source"+random, val,0);
		var url="functions_php/Source.php?";
		var fName="source";
		getData(url, id, fName);

	}

	function createDynamicSentimentChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("senti"+random, val,0);
		var url="functions_php/Sentiment.php?";
		var fName="sentiment";
		getData(url, id, fName);

	}

	function getInsights(dt, word, brand)
	{

	var d = new Date(dt);
	var n = d.getTime();
	localStorage.setItem("peakDate", n);
	localStorage.setItem("peakWord", word);
	localStorage.setItem("peakBrand", brand);

	localStorage.setItem("insightstitle", 'Insights by Brands ->' + brand);

	var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
	var id= createOutline("peak" + random, val,1);
	var url="functions_php/Posts.php?"
	var fName="peak";
	getData(url, id, fName);

	}

	function createDynamicPosts(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("posts" + random, val,0);
		var url="functions_php/Posts.php?"
		var fName="posts";
		getData(url, id, fName);

	}


	function createDynamicWordCloud(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("wordcloud" + random, val,0);
		var url="functions_php/WordCloud.php?"
		var fName="wordcloud";
		getData(url, id, fName);

	}

	/**************** Get data from php service ***************************/

function getData(url, id, fName)
{
		var brand = localStorage.getItem("brand");
		var ifunction = localStorage.getItem("ifunction");
		var itype = localStorage.getItem("itype");
		var ifunction_date = localStorage.getItem("ifunction_date");
		var itype_date = localStorage.getItem("itype_date");
		var sentiment = localStorage.getItem("sentiment");
		var isource = localStorage.getItem("source");
		var ilang = localStorage.getItem("lang");
		var isite = localStorage.getItem("site");
		var words =localStorage.getItem("words");

		var peakDate=localStorage.getItem("peakDate");
		var peakWord = localStorage.getItem("peakWord");
		var peakBrand = localStorage.getItem("peakBrand");
		var custops = localStorage.getItem("custops");
		var claimsops=	localStorage.getItem("claimsops");
		var revops = localStorage.getItem("revops");
		var iccustops = localStorage.getItem("iccustops");
		var indview = localStorage.getItem("indview");
		var brandandmarket = localStorage.getItem("brandandmarket");
		var salesandmarket=	localStorage.getItem("salesandmarket");
		var techtrends=	localStorage.getItem("techtrends");
		var custexp=	localStorage.getItem("custexp");		
		
		var querystring = "";
		if(brand != "") querystring = "brand=" + brand;
		if(ifunction != "") querystring += "&ifunction=" + ifunction;
		if(itype != "") querystring += "&itype=" + itype;
		if(ifunction_date != "") querystring += "&ifdate=" + ifunction_date;
		if(itype_date != "") querystring += "&itdate=" + itype_date;
		if(sentiment != "") querystring += "&sentiment=" + sentiment;
		if(isource != "") querystring += "&source=" + isource;
		if(ilang != "") querystring += "&lang=" + ilang;
		if(isite != "") querystring += "&site='" + isite + "'";
		if(words != "") querystring += "&words=" + words ;
		if(peakDate != "") querystring += "&peakDate=" + peakDate ;
		if(peakWord != "") querystring += "&peakWord=" + peakWord ;
		if(peakBrand != "") querystring += "&peakBrand=" + peakBrand ;
		if(custops != "") querystring += "&custops='" + custops + "'";
		if(claimsops != "") querystring += "&claimsops='" + claimsops + "'";
		if(revops != "") querystring += "&revops='" + revops + "'";
		if(iccustops != "") querystring += "&iccustops='" + iccustops + "'";
		if(indview != "") querystring += "&indview='" + indview + "'";
		if(brandandmarket != "") querystring += "&brandandmarket='" + brandandmarket + "'";
		if(salesandmarket != "") querystring += "&salesandmarket='" + salesandmarket + "'";
		if(techtrends != "") querystring += "&techtrends='" + techtrends + "'";		
		if(custexp != "") querystring += "&custexp='" + custexp + "'";		
		

		url = url + querystring;
		//	alert(url);
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

		if(fName == "words") {dynamicTopWordsChart(id+"sub", res); }

		if(fName == "posts") { dynamicPosts(id+"sub", res); }

		if(fName == "wordcloud") { dynamicWordCloud(id+"sub", res); }

		if(fName == "cmpt") { dynamicCompetitionChart(id+"sub", res); }

		if(fName == "itype") { dynamicInsTypesChart(id+"sub", res); }

		if(fName == "ifunct") { dynamicInsFunctChart(id+"sub", res); }

		if(fName == "insight") { dynamicInsights(id+"sub", res); }

		if(fName == "peak") { dynamicPosts(id+"sub", res); }

		if(fName == "custops") {dynamicCustOperationsChart(id+"sub", res); }

		if(fName == "claimsops") {dynamicClaimsOperationsChart(id+"sub", res); }

		if(fName == "revops") {dynamicRevenueOperationsChart(id+"sub", res); }

		if(fName == "iccustops") {dynamicInsClaimsCustOperationsChart(id+"sub", res); }

		if(fName == "indview") {dynamicIndustryViewChart(id+"sub", res); }

		if(fName == "brandandmarket") {dynamicBrandAndMarketChart(id+"sub", res); }

		if(fName == "salesandmarket") {dynamicSalesAndMarketChart(id+"sub", res); }
		
		if(fName == "techtrends") {dynamicTechTrendsChart(id+"sub", res) };
		
	if(fName == "custexp") {dynamicCustExpChart(id+"sub", res) };
					

    }
  }

xmlhttp.open("GET",url,true);
xmlhttp.send();
}



