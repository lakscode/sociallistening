<?php 

$querystring="";
$domain="";
if(isset($_GET['domain']))
$domain=$_GET['domain'];

if($domain != "")
{	
include("../db.php");

$query = "SELECT * FROM subdomain where brandid in (select brandid from brands where domainid='" . $domain . "') and usergroupid='" . $_SESSION['usergroupid'] . "' and domainid='" . $domain . "'";


$query = "SELECT * FROM subdomain where domainid='" . $domain . "' and usergroupid='0'";


echo $query;
 //
	$rows=$mysql_conn->query($query);

$cnt=0;
   while ($row = $rows->fetch_assoc())
   {
//   print_r($row);
   $cnt++;
   ?>
   <div style="float:left;margin-right:5px">

  <label class="config-label" for="keywords">Keywords: </label>
	<input name="subid<?php echo $cnt;?>" id="subid<?php echo $cnt;?>" type='hidden' value='<?php echo $row["subdomainid"]; ?>' />
	<input type='text' class='style-5' name = "sd_name<?php echo $cnt;?>" id = "sd_name<?php echo $cnt;?>" value='<?php echo $row["sd_name"]; ?>'</input>
	<input type="checkbox" id='subchk<?php echo $cnt;?>'  name='subchk<?php echo $cnt;?>'/><br>
	<textarea name="subkey<?php echo $cnt;?>" id="subkey<?php echo $cnt;?>" type='text' class="style-1"><?php echo $row["sd_keywords"]; ?></textarea>
	</div>
<?php
   }
?>
<?php   

echo "<input type='hidden' name='domainCnt' id='domainCnt' value='" . $cnt . "' />";
}
else
{
echo "No Keywords for the brand";
}
?>