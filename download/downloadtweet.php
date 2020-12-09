<?php
session_start();
?>
<h3>Twitter Listening </h3>
		<form action="" method="post">
		Company<input type="text" id="txtCompany" name="txtCompany" /><br>		
		Word<input type="text" id="txtKeyword" name="txtKeyword" /><br>
		<input type="submit" name="Search" id="Search" value="Search" />
</form>

<?php
if(isset($_POST['Search']))
{

include("../db.php");
//$since=$_POST['txtSince'];
$since = "";
if($since == "")
$since = "2014-12-10";

$until = "";
//$until=$_POST['txtUntil'];
if($until == "")
$until="2014-12-11";

$company=$_POST['txtCompany'];

$keywords=$_POST['txtKeyword'];

if($company != "")
$_SESSION['company']=$company;

if($keywords != "")
$_SESSION['keywords']=$keywords;

$parts = explode(", ",trim($keywords));
$clauses=array();
foreach ($parts as $part){
    //function_description in my case ,  replace it with whatever u want in ur table
    $clauses[]='"' . $part . '"';
}
$clause=implode(' OR ' ,$clauses);

echo $clause;

if($keywords == "")
$keywords="CSC OR @CSC OR Computer Sciences Corporation";

	$created_at = date('Y-m-d H:i:s');
	$c_query = "SELECT * FROM brands where brand='$company' and keywords = '$keywords'";
	echo $c_query;
$result=$mysql_conn->query($c_query);
		$rn=$result->num_rows; //mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into brands (brand, keywords,competitors,active,created_at) Values('$company', '$keywords', '', '1', '$created_at')";
		echo '<br><br>' . $query .'<br><br>';
		$result=$mysql_conn->query($query);
		echo '<br><br>result of insert query is ' . $result;
		$result=$mysql_conn->query("SELECT brandid FROM brands where brand='$company' and keywords = '$keywords'");

		 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   }
		}
		else
		{
		$result=$mysql_conn->query("SELECT brandid FROM brands where brand='$company' and keywords = '$keywords'");

		 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   }
		}
		
		echo 'company id ' . $_SESSION['brandid'] . '<br>';
		
		$_SESSION['nexturl_twi']="";

		$t_query="SELECT * FROM schedule where brandid=" . $_SESSION['brandid'] . " and active=1  and source='twitter'";
		$result=$mysql_conn->query($t_query);
			while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['nexturl_twi']=$row['next_url'];
		   $query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
		   echo $query . '<br>';
		   $result=$mysql_conn->query($query);


		   }
		   
 echo 'next url ' . $_SESSION['nexturl_twi'] . '<br>';
	
	$_SESSION['nexturl_twi'] ="";

require_once("../twitteroauth/twitteroauth.php"); //Path to twitteroauth library

$notweets = 100;

$consumerkey = "5ytaHT8j4inQgJuW6YAWuxzSY";
$consumersecret = "Iwggq9OSUZE7JvTKPA2KE0glfqSeCwAKSZjQAxNXzaiQRz0I7K";
$accesstoken = "2431817262-NFcyx6FT7zjFwKNKQjrGXJjkHTJyLsFp3GNlIm6";
$accesstokensecret = "zPLkzcDSmqnh43L30al3q8ln5d1sihl8bOMzdNuXX2TEb";
  
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
   
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
print_r($connection);
if( $_SESSION['nexturl_twi'] == "")
{
 echo 'Fresh start<br>';
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=$keywords since:2014-01-01&count=100");
$counter=0;

//print_r($tweets);
//$tweets = json_decode($response, true);
 echo '<table>';
printTweet($tweets->statuses,$company, $keywords);
$glf=0;
$next = $tweets->search_metadata->next_results;
a:
if(substr($next,0,1) == "?")
{
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json" . $next );
printTweet($tweets->statuses,$screenname, $keywords);
//$next = $tweets->search_metadata->next_results;
echo  $next;

if($next !="")
{
		   $query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
		   $result=$mysql_conn->query($query);
		   
$created_at = date('Y-m-d H:i:s');
	$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'twitter', '$next', 1, '$created_at')";
	echo $query;
	 $result=$mysql_conn->query($query);
	 
	 }
$glf++;
}
if($next != "" && $glf <5)
{ goto a;
}
else
{
	if($next != "")
	{
		$query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
		$result=$mysql_conn->query($query);
		$created_at = date('Y-m-d H:i:s');
		$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'twitter', '$next', 1, '$created_at')";
		echo $query;
		$result=$mysql_conn->query($query);
	 }
	 
}
echo '</table>';
}
else
{
echo '<br>Next url ' . $_SESSION['nexturl_twi'] . '<br>';
$next=$_SESSION['nexturl_twi'] ;
if(substr($next,0,1) == "?")
{
	$query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
	$result=$mysql_conn->query($query);
	$created_at = date('Y-m-d H:i:s');
	$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'twitter', '$next', 1, '$created_at')";
	$result=$mysql_conn->query($query);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json" . $next );
	printTweet($tweets->statuses,$screenname, $keywords);
	$next = $tweets->search_metadata->next_results;
	echo  $tweets->search_metadata->next_results;
	$glf++;
}
if($next != "" && $glf <10)
{ 
goto a;
}

}

}

function printTweet($tweets,$company, $keywords)
{
echo '<br> ' . $keywords . '<br>';
$counter =0;
foreach($tweets as $tweet1) {
$counter++;
	print_r($tweet1);
	$id_str= $tweet1->id_str;
	$text= $tweet1->text;
	$user_id_str= $tweet1->user->id_str;
	$user_name= $tweet1->user->name;
	$user_screen_name= $tweet1->user->screen_name;
	$follower_count= $tweet1->follower_count;
	$friends_count= $tweet1->friends_count;
	$favourites_count= $tweet1->favourites_count;
	$statuses_count= $tweet1->statuses_count;
	$language= $tweet1->lang;
	$profile_image_url= $tweet1->user->profile_image_url;
	$retweet_count= $tweet1->retweet_count;
	$favorite_count= $tweet1->favorite_count;
	$published = date('Y-m-d H:i:s',strtotime($tweet1->created_at));
	$created_at = date('Y-m-d H:i:s');

	if($text != "")
	{
		$result=$mysql_conn->query("SELECT * FROM listeningdata where id_str='$id_str'");
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into listeningdata (id_str, brandid, text, date_created, language, author, published, link, author_img, 
		user_id_str, user_screen_name, follower_count, friends_count, favourites_count, statuses_count, retweet_count, favorite_count, site_type) Values('$id_str', " . $_SESSION['brandid'] .", '$text', '$created_at', '$language','$user_screen_name','$published','$profile_image_url', '$profile_image_url', '$user_id_str', '$user_name', '$follower_count', '$friends_count', '$favourites_count', '$statuses_count', '$retweet_count', '$favorite_count','twitter')";
		echo '<br><br>' . $query .'<br><br>';
		$result=$mysql_conn->query($query);
		echo '<br><br>result of insert query is ' . $result;
		}
	}
}
}


  ?>
