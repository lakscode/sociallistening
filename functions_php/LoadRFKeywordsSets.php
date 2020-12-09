<?php
$where_clause="";
if(isset($_GET['keywordsid']))
{
$keywordsid=$_GET['keywordsid'];
$where_clause=" where keywordsid=" . $keywordsid;
}

include("../db.php");
$sql="SELECT * FROM role_functions_keywords_set " . $where_clause;
//echo $sql;
$result=mysql_query($sql);


?>

<div id='ControlsGroup'>
<?php
$cntr=1;
 while ($row = mysql_fetch_array($result))
		   {
		   //echo '<option value="' . $row['keywordsid'] . '">' . $row['keywordsName'] . '</option>';
		 
	echo '<div id="Controls1" style="margin-top:10px">
		<input class="clsText" type="hidden" name="txtId' . $cntr . '" id="txtId' . $cntr . '" value ="' . $row['keywordsid']  . '" >
		<input class="clsText" type="text" name="textbox' . $cntr . '" id="textbox' . $cntr . '" value ="' . $row['keywordsSetName']  . '" >
		<textarea class="clsText" style="vertical-align: middle;width:600px" type="text" id="keywords' . $cntr . '" name="keywords' . $cntr . '" >' . $row['keywords']  . '</textarea> 
	</div>';
	}
	?>
	
</div>
<div style="margin-top:10px">
<a href="#"  id='addButton' style='vertical-align: middle;width:75px; margin-right:15px'>Add Row </a>
<a href="#"  id='removeButton'  style='vertical-align: middle;' width='50px'>Remove Row</a>
</div>
<input type="hidden" id='cntrolCnt' name='cntrolCnt' value='1' />

