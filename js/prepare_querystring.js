	function prepareQuerystring()
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
		var Role1Graph2 = localStorage.getItem("Role1Graph2");
		var Role1Graph3=	localStorage.getItem("Role1Graph3");
		var Role1Graph4 = localStorage.getItem("Role1Graph4");
		var Role2Graph1 = localStorage.getItem("Role2Graph1");
		var Role2Graph2 = localStorage.getItem("Role2Graph2");
		var Role3Graph1 = localStorage.getItem("Role3Graph1");
		var Role3Graph2=	localStorage.getItem("Role3Graph2");
		var Role4Graph1=	localStorage.getItem("Role4Graph1");
		var Role4Graph2=	localStorage.getItem("Role4Graph2");	
		var n_sentiment=	localStorage.getItem("n_sentiment");
		var notify_date=	localStorage.getItem("notify_date");		
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
		if(Role1Graph2 != "") querystring += "&Role1Graph2='" + Role1Graph2 + "'";
		if(Role1Graph3 != "") querystring += "&Role1Graph3='" + Role1Graph3 + "'";
		if(Role1Graph4 != "") querystring += "&Role1Graph4='" + Role1Graph4 + "'";
		if(Role2Graph1 != "") querystring += "&Role2Graph1='" + Role2Graph1 + "'";
		if(Role2Graph2 != "") querystring += "&Role2Graph2='" + Role2Graph2 + "'";
		if(Role3Graph1 != "") querystring += "&Role3Graph1='" + Role3Graph1 + "'";
		if(Role3Graph2 != "") querystring += "&Role3Graph2='" + Role3Graph2 + "'";
		if(Role4Graph1 != "") querystring += "&Role4Graph1='" + Role4Graph1 + "'";		
		if(Role4Graph2 != "") querystring += "&Role4Graph2='" + Role4Graph2 + "'";	
		if(n_sentiment != "") querystring += "&n_sentiment=" + n_sentiment ;	
		if(notify_date != "") querystring += "&notify_date=" + notify_date ;		
		return querystring;
	}
	
	
	
	
function getData(url, id, fName)
{
var querystring= prepareQuerystring();
url = url + querystring;
//alert(url);
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

		if(fName == "semicircle") {	dynamicSemiCircleChart(id+"sub", res); }

		if(fName == "column") { dynamicColumnChart(id+"sub", res); }

		if(fName == "site") { dynamicSiteChart(id+"sub", res); }

		if(fName == "lang") { dynamicLangChart(id+"sub", res); 	}

		if(fName == "sentiment") { dynamicSentimentPieChart(id+"sub", res); }

		if(fName == "source") {dynamicSourceChart(id+"sub", res); }

		if(fName == "words") {dynamicTopWordsChart(id+"sub", res); }

		if(fName == "posts") { dynamicPosts(id+"sub", res); }
		
		if(fName == "wordcloud") { dynamicWordCloud(id+"sub", res); }
		
		

		if(fName == "cmpt") { Competition(id+"sub", res); }

		if(fName == "itype") { DefaultType(id+"sub", res); }

		if(fName == "ifunct") { DefaultFunct(id+"sub", res); }

		if(fName == "insight") { dynamicInsights(id+"sub", res); }

		if(fName == "peak") { dynamicPosts(id+"sub", res); }
		

		if(fName == "Role1Graph2") {Role1Graph2(id+"sub", res); }

		if(fName == "Role1Graph3") {Role1Graph3(id+"sub", res); }

		if(fName == "Role1Graph4") {Role1Graph4(id+"sub", res); }

		if(fName == "Role2Graph1") {Role2Graph1(id+"sub", res); }

		if(fName == "Role2Graph2") {Role2Graph2(id+"sub", res); }

		if(fName == "Role3Graph1") {Role3Graph1(id+"sub", res); }

		if(fName == "Role3Graph2") {Role3Graph2(id+"sub", res); }
		
		if(fName == "Role4Graph1") {Role4Graph1(id+"sub", res) };
			
		if(fName == "Role4Graph2") {Role4Graph2(id+"sub", res) };
    }
  }

xmlhttp.open("GET",url,true);
xmlhttp.send();
}

