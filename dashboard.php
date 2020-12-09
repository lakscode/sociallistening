<?php include("include.php"); ?>
<body class="bg">
<?php include("header.php");?>

<div id="configContainer" class="customContainer grayLinear">
<div id="subContainer" class="subContainer">
<form action="" method="post">
<h3>Dashboard Settings</h3>
 <div style="float:right;"> 
 <input type="submit" value="Save Settings" id="btnDBSave" name="btnDBSave"  />
</div> 

  <div style="clear:both"></div>
	<?php
	include("multiselect.php");
	$clauses=array();
		include("db.php");
		$sql_Competitors ="SELECT brandid, brand FROM brands where active=1 group by brand ";
		//echo $query;
		$competitors="";
		$rows=$mysql_conn->query($sql_Competitors);
		while ($row = $rows->fetch_assoc()){
		$clauses[$row['brandid']] = $row['brand'];
			$competitors .="<option value='" . $row['brandid'] . "'>" . $row['brand'] . "</option>";
			}
		$query ="SELECT b.brandid, b.brand, b.keywords, b.competitors, b.created_at, b.domainid, b.active, b.dashboard, d.domain FROM brands b, domain d where b.domainid=d.domainid order by brandid ";
		//echo $query;
		$rows=$mysql_conn->query($query);
		
	?>
	<?php
		$temp="";
		$cnt=0;
		echo '<table class="tasklist">';
		echo "<th width='5%'>Sl. No</th>";
		echo "<th width='10%'>Brand</th>";
		echo "<th width='20%'>Keywords</th>";
		echo "<th style='vertical-align:top' width='30%'>Competitors</th>";		
		echo "<th width='15%'>Creation Date</th>";
		echo "<th width='2%'>Domain</th>";
		echo "<th width='5%'>Status</th>";
		while ($row = $rows->fetch_assoc()){
		$str_comp="";
			$Words = explode(', ',$row["competitors"]);
	foreach($Words AS $word)
	{
	$str_comp .= $clauses[$word] . ", ";
	}
	if($str_comp !="")
	{
		$str_comp=substr($str_comp, 0, -1);
		$str_comp=substr($str_comp, 0, -1);
	}
			$cnt++;
			if($cnt % 2 == 0)
			echo '<tr class="dark">';
			else
			echo '<tr class="light">';
			echo '<td>' . $cnt .'</td>';
			echo '<td>' . $row["brand"] .'</td>';
			echo '<td>' . $row["keywords"] .'</td>';		
			echo "<td style='vertical-align:middle;'>
			<select style='vertical-align:middle;' name='sel_". $row["brandid"] ."' id='sel_". $row["brandid"] ."' onclick='selectCompetitors(this, \"comptetitor". $row["brandid"] . "\")' class='style-1' multiple>" . $competitors ."</select>
			<input readonly style='vertical-align:middle;' class='style-1'  name='comptetitor". $row["brandid"] ."' id='comptetitor". $row["brandid"] ."' value='". $str_comp ."' type='text' />
			<input style='vertical-align:middle;' class='style-1'  name='hidcomptetitor". $row["brandid"] ."' id='hidcomptetitor". $row["brandid"] ."' value='". $row["competitors"] ."' type='hidden' />

			</td>";	
			echo '<td>' . $row["created_at"] .'</td>';
			echo '<td>' . $row["domain"] .'</td>';
			if($row["dashboard"] == 1){
				echo '<td>' . "<input name='chkDB[]' value='". $row["brandid"] ."' type='checkbox' checked />" .'</td>';
			}else{
				echo '<td>' . "<input name='chkDB[]' value='". $row["brandid"] ."' type='checkbox' />" .'</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	
	?>
<?php
function getCompetitors($competitors_id)
{

}
if(isset($_POST['btnDBSave']))
{
	
  $chkDB = $_POST['chkDB'];
  if(empty($chkDB)) 
  {
    echo("You didn't select any brands.");
  } 
  else
  {
    $N = count($chkDB);
//  echo("You have selected $N brands(s): <br> ");
    for($i=0; $i < $N; $i++)
    {
		// echo($chkDB[$i] . " ");
		$cntrl='hidcomptetitor' . $chkDB[$i];
		$comp = $_POST[$cntrl];
	  
		include("db.php");
		$query ="update brands set dashboard=1, competitors='" . $comp . "' where brandid=" . $chkDB[$i];
		// echo $query;
		$rows=$mysql_conn->query($query);
    }
  }
}
?>

</div>
</form>
</div>


</body>
</html>