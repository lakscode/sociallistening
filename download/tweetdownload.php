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
$baseURL="https://api.twitter.com/1.1/search/tweets.json";
$_SESSION["baseURL"] =$baseURL;
include("../db.php");
$since=$_POST['txtSince'];
if($since == "")
$since = "2014-12-10";


$until=$_POST['txtUntil'];
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
    $clauses[]='"' . mysql_real_escape_string($part) . '"';
}
$clause=implode(' OR ' ,$clauses);

echo $clause;

if($keywords == "")
$keywords="CSC OR @CSC OR Computer Sciences Corporation";

	$created_at = date('Y-m-d H:i:s');
	$c_query = "SELECT * FROM brands where brand='$company' and keywords = '$keywords'";
	echo $c_query;
$result=mysql_query($c_query);
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into brands (brand, keywords,competitors,active,created_at) Values('$company', '$keywords', '', '1', '$created_at')";
		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		echo '<br><br>result of insert query is ' . $result;
		$result=mysql_query("SELECT brandid FROM brands where brand='$company' and keywords = '$keywords'");

		 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['companyid']=$row['brandid'];
		   }
		}
		else
		{
		$result=mysql_query("SELECT brandid FROM brands where brand='$company' and keywords = '$keywords'");

		 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['companyid']=$row['brandid'];
		   }
		}
		
		echo 'company id ' . $_SESSION['companyid'] . '<br>';
		
		$_SESSION['next_url']="";

		$t_query="SELECT * FROM schedule where brandid=" . $_SESSION['companyid'] . " and active=1  and source='twitter'";
		$result=mysql_query($t_query);
			while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['next_url']=$row['next_url'];
		   $query = "delete * from schedule where brandid= " . $_SESSION['companyid'] . " and source='twitter'" ;
		   echo $query . '<br>';
		   $result=mysql_query($query);
		   }
		   
 echo 'next url ' . $_SESSION['next_url'] . '<br>';

 if($_SESSION['next_url'] != "")
 $url=  $_SESSION["baseURL"] . $_SESSION['next_url'];
 else
 $url=$_SESSION["baseURL"] . "?q=$keywords since:2014-01-01&count=100";
	

require_once("../twitteroauth/twitteroauth.php"); //Path to twitteroauth library

$notweets = 100;

$consumerkey = "0r1RRTprLMGmD7VK7arn8kfWS";
$consumersecret = "kJFMLxjwkDqX0tOjBgYBGAc13h2Kw2a8CxkPi6VNzvxZamy9z1";
$accesstoken = "569103480-ljz3Sde5dRcZZFB1I5TOxHe7DNiNWG9euRKt1DTz";
$accesstokensecret = "NJbjO9BgYHGuIyS4mWvR8UQiE5jA04Gh7t5VzRDncU40Y";
  
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
   
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$tweets = $connection->get($url);
$counter=0;
//print_r($tweets);

 echo '<table>';
printTweet($tweets->statuses,$company, $keywords);
$glf=0;
$next = $tweets->search_metadata->next_results;
a:
if(substr($next,0,1) == "?")
{
$tweets = $connection->get($_SESSION["baseURL"] . $next );
printTweet($tweets->statuses,$screenname, $keywords);
echo  '<br>Next URL ' . $next . '<br>';

if($next !="")
{
		   $query = "delete * from schedule where brandid= " . $_SESSION['companyid'] . " and source='twitter'" ;
		   $result=mysql_query($query);
		   
$created_at = date('Y-m-d H:i:s');
	$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['companyid'] .", 'twitter', '$next', 1, '$created_at')";
	echo $query;
	 $result=mysql_query($query);
	 
	 }
$glf++;
}
if($next != "" && $glf <5)
{ goto a;
}

echo '</table>';


}

function printTweet($tweets,$company, $keywords)
{
echo '<br> ' . $keywords . '<br>';

foreach($tweets as $tweet1) {
$counter++;
	//print_r($tweet1);
	$id_str= $tweet1->id_str;
	$text= mysql_real_escape_string($tweet1->text);
	$user_id_str= $tweet1->user->id_str;
	$user_name= mysql_real_escape_string($tweet1->user->name);
	$user_screen_name= mysql_real_escape_string($tweet1->user->screen_name);
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
		$result=mysql_query("SELECT * FROM listeningdata where id_str='$id_str'");
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into listeningdata (id_str, brandid, text, date_created, language, author, published, link, author_img, 
		user_id_str, user_screen_name, follower_count, friends_count, favourites_count, statuses_count, retweet_count, favorite_count, site_type) Values('$id_str', " . $_SESSION['companyid'] .", '$text', '$created_at', '$language','$user_screen_name','$published','$profile_image_url', '$profile_image_url', '$user_id_str', '$user_name', '$follower_count', '$friends_count', '$favourites_count', '$statuses_count', '$retweet_count', '$favorite_count','twitter')";
		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		echo '<br><br>result of insert query is ' . $result;
		}
	}
}
}

function fixtags($text){

$text = htmlspecialchars($text,ENT_QUOTES);
$text = htmlspecialchars($text);
$text = htmlentities($str, ENT_QUOTES, "UTF-8");
$text=mysql_real_escape_string($text);
return $text;
}
  ?>
