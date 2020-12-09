<?php 

$querystring="";
if(isset($_GET['brand']))
$brand=$_GET['brand'];
if($brand != "")
{	
include("../db.php");

$query = "SELECT * FROM brands where brand in (select brand from brands where brandid=" . $company . ")";

//echo $query;
 
$rows=mysql_query($query);

$cnt=0;
   while ($row = mysql_fetch_array($rows))
   {
   $cnt++;
?>
<div style="float:left">
<span class="lbl">Keywords: </span>
<input name="id<?php echo $cnt;?>" id="id<?php echo $cnt;?>" type='hidden' value='<?php echo $row["id"]; ?>' />
<input name="key<?php echo $cnt;?>" id="key<?php echo $cnt;?>" type='text' class="style-1" value='<?php echo $row["keywords"]; ?>' />
</div>


<?php
   }
?>
<div style="clear:both"></div><br>
<span class="lbl">Domain: </span>
<select name="selDomain" id="selDomain" onchange="getSubKeywords()" size="4">
  <option value="insurance">Insurance</option>
  <option value="healthcare">Healthcare</option>
  <option value="finance">Finance</option>
  <option value="retail">Retail</option>
</select>
<div id="result_sub" >
</div>

<?php   

echo "<input type='hidden' name='keywordsCnt' id='keywordsCnt' value='" . $cnt . "' />";
}
else
{
echo "No Keywords for the brands";
}
?>