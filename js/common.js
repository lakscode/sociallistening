function message()
{
	if(document.body.clientWidth < 320)
	{
		document.body.style.fontSize = "1.0em";
	}
	else if(document.body.clientWidth >=320 && document.body.clientWidth < 480 )
	{
		document.body.style.fontSize = "1.2em";
	}
	else if(document.body.clientWidth >=480 && document.body.clientWidth < 600 )
	{
		document.body.style.fontSize = "1.4em";
	}
	else if(document.body.clientWidth >=600 && document.body.clientWidth < 800 )
	{
		document.body.style.fontSize = "1.6em";
	}
	else if(document.body.clientWidth >=800)
	{
		document.body.style.fontSize = "1.8em";
	}
}
window.onload=message;
window.onresize=message;
window.load=message;

$(document).ready(function() {
 //   message();
});


	/**************** Get data from php service ***************************/


function getLayout(url, div)
{
document.getElementById(div).innerHTML="";

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
	document.getElementById(div).style.display="block";

	var res=xmlhttp.responseText;
	//alert(res);
	document.getElementById(div).innerHTML=res;

 return true;

    }
  }

xmlhttp.open("GET",url,true);
xmlhttp.send();

}


$(window).load(function() {
 //   message();
});


function functLogout()
{
initStorageItems();
window.location.href="index.php";
}


function getSentiments(brand,div)
{
initStorageItems();
document.getElementById(div).innerHTML="";
var url="functions_php/GetSentiments.php";
if(brand != "")
url = url + "?brand=" + brand;
getLayout(url, div)
}

function getPeakWords(brand,div)
{
initStorageItems();
document.getElementById(div).innerHTML="";
var url="functions_php/NotifyInsight.php";
if(brand != "")
url = url + "?brand=" + brand;
getLayout(url, div)
}

function validate()
{
var brand=document.getElementById('brand').value;
var dateStart=document.getElementById('dateStart').value;
var dateEnd=document.getElementById('dateEnd').value;
var keywords=document.getElementById('keywords').value;
var selDomain = document.getElementById("selDomain").value;
if(selDomain !="")
{
var domainCnt=document.getElementById('domainCnt').value;
for(var i=1; i<=domainCnt; i++)
{
var subid=document.getElementById('subid'+i).value;
var subchk = document.getElementById("subchk"+i).checked;
var subkey = document.getElementById("subkey"+i).value;
}
}
if(brand == "" && keywords== "" && selDomain == "")
{
alert("Please enter details");
return false;
}
else
return true;
}

function functConfigBrandAdd(){
	window.location.href="config_brands_add.php";
}

function editPersonaFunctions(rfid)
{
//alert(rfid);
window.location.href="config_persona_edit.php?rfid=" + rfid;
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


