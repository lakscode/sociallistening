<?php
session_start();
?>

<?php
	include("../db.php");

	$created_at = date('Y-m-d H:i:s');
	$c_query = "SELECT * FROM `auto_share`.`listeningdata` where company_id=5 and date(published)=date('2015-06-23')";
	echo $c_query;
	$result=mysql_query($c_query);
while ($row = mysql_fetch_array($result))
   {
   print_r($row);
   $id_str= $row["id_str"];
   $brandid= $row["brandid"];
	$text= $row["text"];
	$user_name= $row["author"];
	$user_screen_name= $row["user_screen_name"];
	$follower_count= $row["follower_count"];
	$friends_count= $row["friends_count"];
	$favourites_count= $row["favourites_count"];
	$statuses_count= $row["statuses_count"];
	$language= $row["language"];
	$profile_image_url= $row["link"];
	$retweet_count= $row["retweet_count"];
	$favorite_count= $row["favorite_count"];
	$published = $row["published"];
	$created_at = $row["date_created"];
	$user_id_str= $row["user_id_str"];
	
		if($text != "")
	{
		$result=mysql_query("SELECT * FROM `listening`.`listeningdata` where company_id=5 and date(published)=date('2015-06-23') and id_str='$id_str' and text='" . $text . "'");
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into `listening`.listeningdata (id_str, brandid, text, date_created, language, author, published, link, author_img, 
		user_id_str, user_screen_name, follower_count, friends_count, favourites_count, statuses_count, retweet_count, favorite_count, site_type) Values('$id_str', " .$brandid .", '$text', '$created_at', '$language','$user_screen_name','$published','$profile_image_url', '$profile_image_url', '$user_id_str', '$user_name', '$follower_count', '$friends_count', '$favourites_count', '$statuses_count', '$retweet_count', '$favorite_count','twitter')";
//		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		
		if( $result == 1)
		{
		echo '<br><br>result of insert query is ' . $result;
				echo $query; 
				
				
		}
		
		}
	}
	}
	
	
		

  ?>
