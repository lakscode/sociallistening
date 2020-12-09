<?php
$where_clause="";
if(isset($_GET['rf_id']))
{
$rf_id=$_GET['rf_id'];
$where_clause=" where rf_id=" . $rf_id;
}

include("../db.php");
$sql="SELECT * FROM role_functions_keywords " . $where_clause;
//echo $sql;
$result=mysql_query($sql);


?>
<div class="ui-widget">
  <label class="config-label" for="selRFKeywords">Functions Keywords: </label>
  <label class="sel">
  <select id="selRFKeywords" onchange="loadKeywordsSet()" name="selRFKeywords" class="style-1">
  <option value="">Select Functions</option>
  <?php
		 while ($row = mysql_fetch_array($result))
		   {
		   echo '<option value="' . $row['keywordsid'] . '">' . $row['keywordsName'] . '</option>';
		   }
?>		   </select>
</label>
</div>