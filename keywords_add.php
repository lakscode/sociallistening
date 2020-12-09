<?php include("include.php"); ?>
<body class="bg">
<?php include("header.php");?>

<div id="configContainer" class="customContainer grayLinear">
<div id="subContainer" class="subContainer chartContainer" width="100%">
<form action="" method="post">
<div style="float:right;">
  <input type="submit" id="btnSave" name="btnSave" value="Save" onclick="validate()" />
<input type="button" value="Back" onclick="javascript:window.location.href='chart_config.php';" id="btnClientSave" name="btnClientSave"  />
</div>
<h3>Chart Details Settings</h3>



<div class="ui-widget">
<label class="config-label" for="domain">Charts: </label>

<select id="selRoleFunction" onchange="getCharts(this.value, 'divCharts');" name="selRoleFunction" class="style-1">
<option value="">Select</option>
<?php
include("db.php");
$query = "SELECT * FROM charts";
//echo $query;
$rows=mysql_query($query);
while ($row = mysql_fetch_array($rows))
{
	echo '<option value="' . $row['chartid'] . '">' . $row['chartname'] . '</option>';
}
?>		   
</select>

</div>

<div id="divCharts">
</div>

<div style="clear:both"></div>

<?php
if(isset($_POST['btnSave']))
{
include("db.php");

$selRoleFunction=$_POST['selRoleFunction'];
$txtChartCategory=$_POST['txtChartCategory'];
$txtKeyset1=$_POST['txtKeyset1'];
$txtKeyset2=$_POST['txtKeyset2'];
$txtKeyset3=$_POST['txtKeyset3'];
	$created_at = date('Y-m-d H:i:s');

	
	foreach( $txtChartCategory as $key => $n ) {
  print "The name is ".$n." and email is ".$txtKeyset2[$key].", thank you\n";
  $cat= $txtChartCategory[$key];
  $key1= $txtKeyset1[$key];
  $key2= $txtKeyset2[$key];
  $key3= $txtKeyset3[$key];
  $query = "Insert into role_functions_keywords (keywordsName, keywords_set1, keywords_set2, do_not_include, rf_id,created_at) Values('$cat','$key1','$key2', '$key3', '$selRoleFunction','$created_at')";
	echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		
		
		
}

/*
$c_query = "SELECT * FROM role_functions where title='$txtChartTitle' and roles_id='$selRole'";
	//echo $c_query;
$result=mysql_query($c_query);
	$rn=mysql_num_rows($result);
	if($rn<=0)
	{

	$query = "Insert into role_functions (title,description, roles_id,active,chart_type,created_at) Values('$txtChartTitle','$txtChartDesc','$selRole', '1', '$selGraphType','$created_at')";
	//echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		
		
	echo '<p class="success">Inserted the Graph Description</p>';

	}
	*/
}
?>


</form>


</div>
</div>
<script>

var counter = 1;
var limit = 14;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('tr');
		  newdiv.id="ch" + (counter +1);
		  newdiv.innerHTML = ' <td><input id="txtChartTitle' + (counter +1) + '" name="txtChartTitle[]" class="style-1"/></td>' +
		  '<td><textarea id="txtKeyset1' + (counter +1) +'" name="txtKeyset1[]" class="style-2"></textarea></td>' +
		 '<td><textarea id="txtKeyset2' + (counter +1) +'" name="txtKeyset2[]" class="style-2"></textarea></td>' +
		  '<td><textarea id="txtKeyset3' + (counter +1)+ '" name="txtKeyset3[]" class="style-2"></textarea></td>' +
		  '<td><input type="button" value="-" onclick="removeElement(\'dynamicInput\', \'ch' + (counter +1) + '\')"</input></td>';
          document.getElementById(divName).appendChild(newdiv);
          counter++;
		   document.getElementById("txtcount")=counter;
		  
     }
}

function removeElement(parentDiv, childDiv){
alert(parentDiv);
//alert(childDiv);
     if (counter == 1) {
          alert("The parent div cannot be removed.");
     }
     else if (document.getElementById(childDiv)) {     
          var child = document.getElementById(childDiv);
          var parent = document.getElementById(parentDiv);
          parent.removeChild(child);
     }
     else {
          alert("Child div has already been removed or does not exist.");
          return false;
     }
	 counter--;
	  document.getElementById("txtcount")=counter;
	  
}

</script>


</body>
</html>