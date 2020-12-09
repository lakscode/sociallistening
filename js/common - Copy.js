	/**************** Get data from php service ***************************/
	
function getKeywords()
{
//alert("getjkeywrds function");
	var selectBox = document.getElementById("selClient");
    var selectedValue = selectBox.value;
if(selectedValue != "")
{
var url = "functions_php/GetKeywords.php?brand=" + selectedValue;
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
	document.getElementById('res').style.display="block";

var res=xmlhttp.responseText;
document.getElementById('result').innerHTML=res;
//alert(res);
document.getElementById('btnsave').disabled=false;


		 return xmlhttp.responseText;

    }
  }
 
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
else
{
alert("Please select a Client");
}
}

function getSubKeywords()
{
document.getElementById('result_sub').innerHTML="";
var selectBox = document.getElementById("selDomain");
    var selectedValue = selectBox.value;
    if(selectedValue == "")
    {
    alert("Please select a domain");
    return false;
    }
	//alert(selectedValue);
if(selectedValue != "")
{
var url = "functions_php/GetDomainKeywords.php?domain=" + selectedValue;
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
	document.getElementById('res').style.display="block";

	
	
var res=xmlhttp.responseText;
document.getElementById('result_sub').innerHTML=res;

 return xmlhttp.responseText;

    }
  }
 
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
else
{
alert("Please select a Domain");
}
}



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
document.getElementById(div).innerHTML=res;

 return true;

    }
  }
 
xmlhttp.open("GET",url,true);
xmlhttp.send();

}


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


function functLogout()
{
initStorageItems();
window.location.href="index.php";
}




