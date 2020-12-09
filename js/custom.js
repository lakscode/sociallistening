	var zIndex=1;
window.onclick= function()
{
//alert('sdgg');
hideContextMenu();
}
function hideContextMenu()
{
//$('#divUser').hide();
//$('#divNotify').hide();
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
	div.style.backgroundColor = '#334567'; //'#A0A0A0'; //
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
	div.style.minWidth = "400px";
	div.style.minHeight =  "345px";
	
	div.style.width = wid + "px";
	div.style.height = hei + "px";
	
	var t_maxWidth= w * .6;
	var t_maxHeight= h * .7;
	//	alert(t_maxWidth);
	div.style.maxWidth ="600px";
	div.style.maxHeight = "545px";

	
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
	$(div).click(function() { divOnTop("#" + id);});
	
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
	var res = divName.substr(0, 4);
	//alert(res);
	var t_controls="";
	t_controls='<div style="margin-top:0; float:right;right: 0;width:84px;height:24px;"><img src="images/close.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;margin-left:5px;" onclick="popupclose(\'' + id  + '\')" />	';
	
//	t_controls +='<img src="images/min.png" id="m' + id + '" title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;margin-left:5px;" onclick="min_maximize(\'m' + id + '\',\'' + id  + '\')" />';
	
	if(res == "peak" || res == "post") // || res=="ityp" || res == "ifun")
	{
		t_controls +='<img src="images/export.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;" onclick="downloadData(\'' + id  + '\')" /></div>'
	}
	else if(act_ins == 1)
	{
		t_controls +='<img src="images/insight.png"  title="Close" style="margin-top:0; float:right;right: 0;width:24px;height:24px;" onclick="createDynamicInsightChart(\'' + id  + '\')" /></div>';
	}
	t_controls +='</div>';

	$(divTitle).append(t_controls);

	
	
	if(temp == "" && act_ins == 0)
	{
		var ititle = localStorage.getItem("insightstitle");
		temp = "<b>" + ititle + "<b>";
		}



	$(divTitle).append('<span  style="margin-top:0; font-size:40%; float:left;left: 0;width:60%;height:24px;padding-top:4px; padding-left:5px;" >'  + temp +  '</span>');

$(divTitle).click(function() { divOnTop("#" + id);});
var div1 = document.createElement('div');
div1.id=id+"sub";
div1.style.width="100%";
div1.style.height="90%";
		$("#" + id).append(div1);
		$("#" + id+"sub").draggable({ disabled: true });
		$("#" + id).draggable({  containment: "window" });
		$("#" + id).ondrag=function(){divOnTop("#" + id);};
		$("#" + id).resizable({   alsoResize: "#" + id + "sub" });
	    $("#" + id+"sub").resizable();
		
		$("#" + id+"sub").click(function() { divOnTop("#" + id);});
		$("#" + id).on('resize', function (e) {
        var chart = $("#" + id+"sub").highcharts();
		chart.setSize( $("#" + id).width()-10, 
       $("#" + id).height()-30,false);
	   divOnTop("#" + id);
       
    });
	
	
	return id;
}

function min_maximize(obj, divN)
{
	
 if($('#' + obj).attr('src') == "images/min.png")
 {
 	var divApp = document.getElementById(divN);
	var mHeight=$('#' + divN).height();
	var mWidth=$('#' + divN).width();	
	localStorage.setItem(divN+'h',mHeight );
	localStorage.setItem(divN+'w',mWidth );
	$('#' + obj).attr("src","images/max.png");
	$("#" + divN + "sub").hide(); 
	divApp.style.width='180px';
	divApp.style.height='30px';
	divApp.style.top='0px';
	divApp.style.left='0px';
	divApp.style.minWidth = "0px";
	divApp.style.minHeight =  "0px";	
	divApp.style.marginLeft = "10px";
	$('#chartMinWindows').append(divApp);
	$('#chartcontainer').remove(divApp);
    }
    else{
	//alert(divN);
	var divApp = document.getElementById(divN);
	$('#' + obj).attr("src","images/min.png");
	var mHeight=localStorage.getItem(divN+'h');
	var mWidth=localStorage.getItem(divN+'w');		
	$("#" + divN).height(mHeight)
	$("#" + divN).width(mWidth)
	divApp.style.minWidth = "400px";
	divApp.style.minHeight =  "345px";
	    divApp.style.top='10%';
		divApp.style.left='20%';
		//$("#" + divN).center();		
		$('#chartcontainer').append(divApp);
		$("#" + divN + "sub").show(); 
		$('#chartMinWindows').remove(divApp);
	
    }




}
function divOnTop(id) {
	//alert(id);
   $(id).zindex('up');
}

 
function viewMenu(e, val)
	{

	localStorage.setItem("peakDate", "");
	localStorage.setItem("peakWord", "");
	localStorage.setItem("peakBrand", "");

	$('#divMenuMain').hide();
	$("#divMenu").zindex('up');
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
 $("#divMenuMain").zindex('up');
	$("#divMenuMain").css( {position:"absolute", top:e.pageY-0, left:e.pageX});
		$('#divMenuMain').show();
	document.getElementById("btnType").onclick = function() {
	localStorage.setItem("ifunction_date", "");
	localStorage.setItem("itype_date", "");
	 createDynamicTypeChart(val);
	 $('#divMenuMain').hide();
	 };

	document.getElementById("btnFunctions").onclick = function() {
	localStorage.setItem("ifunction_date", "");
	localStorage.setItem("itype_date", "");
	createDynamicFunctChart(val);
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
	localStorage.setItem("Role1Graph2", '');
	localStorage.setItem("Role1Graph3", '');
	localStorage.setItem("Role1Graph4",'');
	localStorage.setItem("Role2Graph1",'');
	localStorage.setItem("Role2Graph2",'');
	localStorage.setItem("Role3Graph1",'');
	localStorage.setItem("Role3Graph2",'');
	localStorage.setItem("Role4Graph1",'');
	localStorage.setItem("Role4Graph2",'');	
	localStorage.setItem("peakDate",'');
	localStorage.setItem("peakWord",'');
	localStorage.setItem("peakBrand",'');	
	localStorage.setItem("n_sentiment",'');	
localStorage.setItem("sourcebrand","Mayo Clinic");
	localStorage.setItem("notify_date","");
}

function graphDisplay(opt)
{

	if(opt >=0 && opt <=2)
	{

		initStorageItems();
		createCompetitionChart("");
	}
	else if(opt == 3)
	{
	
		initStorageItems();
		createCompetitionChart(1);
		createRoleGraphChart(1, "Role3Graph1");
	//	createRoleGraphChart(1, "Role3Graph2");		
	}
	else if(opt == 4)
	{
		initStorageItems();		
		createCompetitionChart(1);
		createRoleGraphChart(1, "Role4Graph1");		
		createRoleGraphChart(1, "Role4Graph2");			
	}
	else if(opt == 5)
	{
		initStorageItems();
		
		createCompetitionChart(1);
		createRoleGraphChart(1, "Role1Graph2");	
		createRoleGraphChart(1, "Role1Graph3");	
		createRoleGraphChart(1, "Role1Graph4");		
	}
	else if(opt == 6)
	{

		initStorageItems();
		createCompetitionChart(1);
		createRoleGraphChart(1, "Role2Graph1");			
		createRoleGraphChart(1, "Role2Graph2");	
	}
}

	function createCompetitionChart(val)
	{
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("cmpt"+random, val, 1);
		var url="functions_php/Competition.php?";
		var fName="cmpt";
		getData(url, id, fName);
	}

	function createDynamicInsightChart(val)
	{
		localStorage.setItem("insightstitle", 'Insights by Hospitals');
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("insight"+random, val,0);
		var url="functions_php/Insight.php?";
		var fName="insight";
		getData(url, id, fName);
	}


	function createDynamicTypeChart(val)
	{
	//alert('Ins type');
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("itype"+random, val,0);
		var url="functions_php/DefaultType.php?";
		var fName="itype";
		getData(url, id, fName);
	}
	
	function createDynamicFunctChart(val)
	{
		localStorage.setItem("insightstitle","");
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("ifunct"+random, val,0);
		var url="functions_php/DefaultFunct.php?";
		var fName="ifunct";
		getData(url, id, fName);
	}

		function createRoleGraphChart(val, t_graph)
	{
			localStorage.setItem("ifunction_date", "");	
			localStorage.setItem("insightstitle","");
			var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
			var id= createOutline(t_graph+random, val,0);
			var url="functions_php/" + t_graph + ".php?"; 
			var fName=t_graph;
			getData(url, id, fName);
	}
	
	function getInsights(dt, word, brand)
	{
	dt = dt.replace(/-/g,'/');
		var d = new Date(dt);
		var n = d.getTime();
		initStorageItems();
			
		localStorage.setItem("peakDate",dt);
		localStorage.setItem("peakWord", word);
		localStorage.setItem("peakBrand", brand);
		localStorage.setItem("insightstitle", 'Insights by Brands ->' + brand);
		var random = Math.floor(Math.random() * 550 - 50 + 1) + 50;
		var id= createOutline("peak" + random, 0,0);
		var url="functions_php/Posts.php?"
		var fName="peak";
		getData(url, id, fName);
	}


/**************** Get data from php service ***************************/

function downloadData(val)
{
var querystring= prepareQuerystring();
var url = "functions_php/export_xls.php?" + querystring;
//alert(url);
window.location.href=  url;
}

function selectCompetitors(obj, txt)
{
	var old_Compt_id = document.getElementById('hid'+ txt).value;	
	var old_Compt = document.getElementById(txt).value;	
	var old_arr=old_Compt_id.split(", ");
	var str="",i;
	var index;
	var str_name="";
	var found=0;
	for (i=0;i<obj.options.length;i++) 
	{
		if (obj.options[i].selected) 
		{
			found=0;
			for	(index = 0; index < old_arr.length; index++) 
			{
				if(obj.options[i].value == old_arr[index])
				found=1;
			}
			if(found == 0)
			{
					str = str + obj.options[i].value + ", ";
					str_name = str_name + obj.options[i].text + ", ";		
			
			}
		}
	}
	str=str.substring(0, str.length - 2);
	str_name=str_name.substring(0, str_name.length - 2);
	if(str != "")
	{
		if(old_Compt_id != "")
		{
			document.getElementById('hid'+ txt).value=old_Compt_id + ", " + str;	
			document.getElementById(txt).value=old_Compt + ", " + str_name;	
		}
		else
		{
			document.getElementById('hid'+ txt).value= str;	
			document.getElementById(txt).value= str_name;	
		}
	}
}


function loadRoleFunctions()
{
	var div = "divFunctions";
	var selectBox = document.getElementById("selPersonas");
    var selectedValue = selectBox.value;
    if(selectedValue == "")
    {
		alert("Please select a Role");
		return false;
    }
	if(selectedValue != "")
	{
		var url = "functions_php/LoadRoleFunctions.php?roleid=" + selectedValue;
		alert(url);
		document.getElementById(div).innerHTML="";
		getLayout(url, div)
	}

}

function loadRFKeywords()
{
	var div = "divRFKeywords";
	var selectBox = document.getElementById("selFunctions");
    var selectedValue = selectBox.value;
    if(selectedValue == "")
    {
		alert("Please select a Function");
		return false;
    }
	if(selectedValue != "")
	{
		var url = "functions_php/LoadRFKeywords.php?rf_id=" + selectedValue;
		alert(url);
		document.getElementById(div).innerHTML="";
		getLayout(url, div)
	}

}

function loadKeywordsSet()
{
	var div = "divRFKeywordsSets";
	var selectBox = document.getElementById("selRFKeywords");
    var selectedValue = selectBox.value;
    if(selectedValue == "")
    {
    alert("Please select a Keyword");
    return false;
    }
	if(selectedValue != "")
	{
	var url = "functions_php/LoadRFKeywordsSets.php?keywordsid=" + selectedValue;
	alert(url);
	document.getElementById(div).innerHTML="";
	getLayout(url, div)
	}

}



/********************* Fuctions to load layout **************/