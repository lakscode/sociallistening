    <link rel="stylesheet" href="multi/multiple-select.css" />
	

        <select id="ms" multiple="multiple">
					
<?php
	include("db.php");
		$sql_Competitors ="SELECT brandid, brand FROM brands where active=1 group by brand ";
		//echo $query;
		$competitors="";
		$rows=mysql_query($sql_Competitors);
		while ($row = mysql_fetch_array($rows)){
		echo " <option value='" . $row['brandid'] . "'>" . $row['brand'] . "</option>";
		}
		?>
          

        </select>
   
<script src="multi/jquery.multiple.select.js"></script>
<script>
    $(function() {
        $('#ms').change(function() {
           // console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
    });
</script>