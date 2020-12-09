<?php
$querystring="";
include("QueryString.php");
include("../db.php");
$filename = "listeningdata";        
if($c_date =="")
{
$query = "SELECT  id, author, text, link, site_type, published FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  order by published desc limit 0,1000";
}
else
{
$query = "SELECT  id, author, text, link, site_type, published  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  order by published desc  limit 0,1000";
}
//echo $query;
$result = mysql_query($query) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = "xls";
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
$sep = "\t";
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert = preg_replace('/(\r\n|\r|\n)/s',"\n",$schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>