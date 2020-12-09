<?php
session_start();
?>
<h3>Webhose Listening </h3>
		<form action="" method="post">
		Company<input type="text" id="txtCompany" name="txtCompany" /><br>		
		Word<input type="text" id="txtKeyword" name="txtKeyword" /><br>

		<input type="submit" name="Search" id="Search" value="Search" />
</form>

<?php
if(isset($_POST['Search']))
{
include("../db.php");


$brand=$_POST['txtCompany'];

$keywords=$_POST['txtKeyword'];

$parts = explode(", ",trim($keywords));
$clause=implode(' OR ' ,$parts);

echo $clause;

if($brand != "")
$_SESSION['brand']=$company;

if($keywords != "")
$_SESSION['keywords']=$keywords;

if($keywords == "")
$keywords="CSC OR @CSC OR Computer Sciences Corporation";

	$created_at = date('Y-m-d H:i:s');
	$c_query = "SELECT * FROM brands where brand='$brand' and keywords = '$keywords'";
	echo $c_query;
$result=$mysql_conn->query($c_query);
print_r($result);
$_SESSION['brandid']="";
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into brands (brand, keywords,competitors,active,created_at) Values('$brand', '$keywords', '', '1', '$created_at')";
		echo '<br><br>' . $query .'<br><br>';
		$result=$mysql_conn->query($query);
		echo '<br><br>result of insert query is ' . $result;
		
		$result=$mysql_conn->query("SELECT brandid FROM brands where brand='$brand' and keywords = '$keywords'");

		 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   	   echo $row["brandid"];
		   }
		}
		else
		{
		$result=$mysql_conn->query("SELECT brandid FROM brands where brand='$brand' and keywords = '$keywords'");

		 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   echo $row["brandid"];
		   }
		}
		
	$today_at = date('Y-m-d');
		   
		echo 'brand id ' . $_SESSION['brandid'] . '<br>';
		$t_query='SELECT * FROM schedule where brandid=4 and active=1 and source="webhose" and date(created_at)=date("' . $today_at . '")';
		$result=$mysql_conn->query($t_query);
			 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['next_url']=$row['next_url'];
		
		   }

		

echo $keywords;
$cntr=0;
$url = "https://webhose.io/search?token=3fea5ee7-1981-4011-bfce-9b19af00e201&format=json&q=" . $clause;

x:
$counter=0;
$body = file_get_contents($url);
print_r($body);
$json = json_decode($body);
echo $url;
foreach($json->posts as $post) {
$counter++;
echo $counter . ' - ';
//print_r($post);
echo '<br><br>';

$url=$post->thread->url;
$site_full=$post->thread->site_full;
$site=$post->thread->site;
$site_section=$post->thread->site_section;

$section_title=$post->thread->section_title;
//$section_title = fixtags($section_title);
$section_title=mysql_real_escape_string($section_title);

$title=$post->thread->title;
//$title = fixtags($title);
$title=mysql_real_escape_string($title);

$title_full=$post->thread->title_full;
//$title_full = fixtags($title_full);
$title_full=mysql_real_escape_string($title_full);

$published=$post->thread->published;
$replies_count=$post->thread->replies_count;
$participants_count=$post->thread->participants_count;
$site_type=$post->thread->site_type;
$spam_score=$post->thread->spam_score;
$ord_in_thread=$post->ord_in_thread;
$author=$post->author;
$text=htmlspecialchars($post->text);
//$text = fixtags($text);
$text=mysql_real_escape_string($text);
$language=$post->language;
$crawled=$post->crawled;
$location=$post->thread->country;
$created_at = date('Y-m-d H:i:s');
//print_r($text);
if($text != "")
	{
	$c_query="SELECT * FROM listeningdata where link='$url'";
	echo $c_query;
		$result=$mysql_conn->query($c_query);
		$rn=mysql_num_rows($result);
		echo $rn;
		if($rn<=0)
		{
		$query = "Insert into listeningdata (brandid, text, date_created, language, author, published, link, title,  site_full, site, site_section, section_title, title_full, replies_count, participants_count, site_type, spam_score, ord_in_thread,crawled,location) Values(" . $_SESSION['brandid'] . ",'$text', '$created_at', '$language', '$author','$published','$url','$title', '$site_full','$site','$site_section','$section_title','$title_full',$replies_count,$participants_count,'$site_type',$spam_score,$ord_in_thread,'$crawled','$location')";
		echo '<br><br>' . $query .'<br><br>';

		if( $result == 1)
		{
		echo '<br><br>result of insert query is ' . $result;
				$result=$mysql_conn->query($query);
		}
		}
	}
}


$cntr++;


echo $cntr . "<br><br>";
if($json->next != "" && $cntr <10)
{
$url="https://webhose.io" . $json->next;
goto x;
}
else
{
echo $json->next;
$next=$json->next;
echo 'Next url - ' . $next . '<br>';
if($next != "")
	{
	
			$t_query="SELECT * FROM schedule where brandid=" . $_SESSION['brandid'] . " and active=1 and source='webhose'";
		$result=$mysql_conn->query($t_query);
			 while ($row = $result->fetch_assoc())
		   {
		   $query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='webhose'" ;
		   $result=$mysql_conn->query($query);


		   }
		   
		$created_at = date('Y-m-d H:i:s');
		$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'webhose', '$next', 1, '$created_at')";
		echo $query . '<br>';
		 $result=$mysql_conn->query($query);
	 }
	} 

function fixtags($text){

$text = htmlspecialchars($text,ENT_QUOTES);
$text = htmlspecialchars($text);
$text = htmlentities($text, ENT_QUOTES, "UTF-8");
$text=mysql_real_escape_string($text);
return $text;
}

}
?>