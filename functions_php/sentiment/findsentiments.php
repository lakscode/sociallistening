<?php 
$negativewords = file_get_contents('negativewords.txt', true);
$negativewords_arr = explode(",", $negativewords);
$positivewords = file_get_contents('positivewords.txt', true);
$positivewords_arr = explode(",", $positivewords);
//print_r($positivewords_arr);
include("../../db.php");
$result=mysql_query("SELECT id, text FROM listeningdata where Date(published)>date('2015-06-27')");
 
while ($row = mysql_fetch_array($result))
   {
	$neg=0; $pos=0; $neu=0;
	   $text = $row['text'];
	   mb_regex_encoding( "utf-8" );
	   $words = mb_split(' +', $text );
	   foreach ($words as $word)
			{
			$word = preg_replace("/[^ \w]+/", "", $word);
			$word = preg_replace("/^[0-9]+/", "", $word);
			$word=strtolower(trim($word));
			//echo '<br>' . $word ;
			if($word!= "")
			{
			$fnd=0;
			if (in_array(strtolower($word), $negativewords_arr) != false)
			{
					 $neg++;
					 $fnd=1;
			}
			else if (in_array(strtolower($word), $positivewords_arr) != false)
			{			
					 $pos++;
					 $fnd=1;					 
			}
			else
			$neu++;
			}
			//echo ' - ' . $pos . ' - ' . $neg . ' - ' . $neu . '<br>';
			}
			$total=count($words);
			$sentiment=0;
			/* echo $text . '<br>';
			echo 'Negative words' . (float)$neg/(float)$total;
			echo '<br>';
			echo 'Positive words' . (float)$pos/(float)$total;
			echo '<br>';
			echo 'Neutral words' . (float)$neu/(float)$total;
			echo '<br>';	 */
			if($neg > $pos)
			$sentiment= -1;
			if($pos > $neg)
			$sentiment= 1;	
					echo '<br> sentiment of the post is ' . $sentiment . '<br>';	
					
				$update_query="update listeningdata set sentiment=" . $sentiment . " where id=" . $row['id'];
				echo $update_query;
				$res=mysql_query($update_query)  or die("No connection is there".mysql_error());
				echo $res; 

		 
			
			
	} 

		   
?>