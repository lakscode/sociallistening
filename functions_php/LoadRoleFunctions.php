<?php
$where_clause="";
if(isset($_GET['roleid']))
{
$roleid=$_GET['roleid'];
$where_clause=" where roles_id=" . $roleid;
}

include("../db.php");
$sql="SELECT * FROM role_functions" . $where_clause;
//echo $sql;
$result=mysql_query($sql);


?>
<div class="ui-widget">
  <label class="config-label" for="selFunctions">Functions: </label>
  <label class="sel">
  <select id="selFunctions" onchange="loadRFKeywords()" name="selFunctions" class="style-1">
  <option value="">Select Functions</option>
  <?php
		 while ($row = mysql_fetch_array($result))
		   {
		   echo '<option value="' . $row['rf_id'] . '">' . $row['rf_name'] . '</option>';
		   }
?>		   </select>
</label>
</div>