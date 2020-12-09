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
$since=$_POST['txtSince'];
if($since == "")
$since = "2014-12-10";


$until=$_POST['txtUntil'];
if($until == "")
$until="2014-12-11";

$brand=$_POST['txtCompany'];

$keywords=$_POST['txtKeyword'];

if($brand != "")
$_SESSION['brand']=$brand;

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
	$c_query = "SELECT * FROM brands where brand='$brand' and keywords = '$keywords'";
	echo $c_query;
$result=mysql_query($c_query);
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into brands (brand, keywords,competitors,active,created_at) Values('$brand', '$keywords', '', '1', '$created_at')";
		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		echo '<br><br>result of insert query is ' . $result;
		$result=mysql_query("SELECT brandid FROM brands where brand='$brand'");

		 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   }
	//	$_SESSION['companyid']=mysql_insert_id();
		}
		else
		{
		$result=mysql_query("SELECT brandid FROM brands where brand='$brand'");

		 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   }
		}
		
		echo 'brand id ' . $_SESSION['brandid'] . '<br>';
		
		$_SESSION['next_url']="";
// $t_query="SELECT * FROM schedule where company_id=" . $_SESSION['companyid'] . " and active=1 and source='twitter'";
		
		$today_at = date('Y-m-d');
		
		$t_query='SELECT * FROM schedule where brandid=4 and active=1 and source="twitter" and date(created_at)=date("' . $today_at . '")';
		$result=mysql_query($t_query);
			 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['next_url']=$row['next_url'];
		
		   }

	
	if($_SESSION['brandid'] != "")
	{

require_once("../twitteroauth/twitteroauth.php"); //Path to twitteroauth library

$notweets = 100;

$consumerkey = "aO6ThWBUi6szZmPsdICDqpetf";
$consumersecret = "IOKz9GjkaL13TViuuFzkiQokoQKFliCpcHicklnou6TUWZ1KZ6";
$accesstoken = "2431817262-tHj3yozpWmI1gW2vxrfVeXjbfSMi0E0gIqwDpE9";
$accesstokensecret = "BiMTg8Si6e9emlKwWSPtBU0Vha4mB74lzXUQLVdwYR2Ib";
  
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
   
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
print_r($connection);
//$tweets = $connection->get("https://api.twitter.com/1.1/users/show.json?screen_name=" . $screenname . "&include_entities=true");
 
//$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=CSC&count=100");
//$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=$screenname since:2014-12-11&count=100&until=2014-12-13");
if( $_SESSION['next_url'] == "")
{
 echo 'Fresh start<br>';
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=$keywords since:2014-01-01&count=100");
$counter=0;

//print_r($tweets);
//$tweets = json_decode($response, true);
 echo '<table>';
printTweet($tweets->statuses,$brand, $keywords);


 
$glf=0;
$next = $tweets->search_metadata->next_results;
a:
if(substr($next,0,1) == "?")
{
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json" . $next );
printTweet($tweets->statuses,$screenname, $keywords);
$next = $tweets->search_metadata->next_results;
echo  $tweets->search_metadata->next_results;
$glf++;
}
echo 'Next url - ' . $next . '<br>';
if($next != "" && $glf <10)
{ 
goto a;
}
else
{
echo 'Next url - ' . $next . '<br>';
if($next != "")
{

echo '<br>brand id - ' . $_SESSION['brandid'] . '<br>';
		$t_query="SELECT * FROM schedule where brandid=" . $_SESSION['brandid'] . " and active=1 and source='twitter'";
		echo $t_query;
		$result=mysql_query($t_query);
			 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['next_url']=$row['next_url'];
		   $query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
		   echo $query;
		   $result=mysql_query($query);


		   }
		   
 echo 'next url ' . $_SESSION['next_url'] . '<br>';
 
	$created_at = date('Y-m-d H:i:s');
	$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'twitter', '$next', 1, '$created_at')";
	echo $query;
	 $result=mysql_query($query);
	// $_SESSION['next_url']=$next;
	 echo "Insert url for next schedule";
	 }
	 
}
echo '</table>';
}
else
{
 echo 'next url ' . $_SESSION['next_url'] . '<br>';
$next=$_SESSION['next_url'] ;
if(substr($next,0,1) == "?")
{
$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json" . $next );
printTweet($tweets->statuses,$screenname);
$next = $tweets->search_metadata->next_results;
echo  $tweets->search_metadata->next_results;
$glf++;
}
if($next != "" && $glf <10)
{ 
goto a;
}
else
{
echo 'Next url - ' . $next . '<br>';
if($next != "")
{
		   $_SESSION['next_url']=$next;	
		   
		   $t_query="SELECT * FROM schedule where brandid=" . $_SESSION['brandid'] . " and active=1 and source='twitter'";
		$result=mysql_query($t_query);
			 while ($row = mysql_fetch_array($result))
		   {
	
		   $query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
		   $result=mysql_query($query);


		   }
		   
	$created_at = date('Y-m-d H:i:s');
	$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'twitter', '$next', 1, '$created_at')";
		echo $query . '<br>';
	 $result=mysql_query($query);
	 
	 echo "Insert url for next schedule";

	 }
}
}
}
}

function printTweet($tweets,$company, $keywords)
{

 
echo '<br> ' . $keywords . '<br>';
//print_r($tweets);
foreach($tweets as $tweet1) {
$counter++;
	print_r($tweet1);
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
	$location= $tweet1->user->location;
	$twitter_client= mysql_real_escape_string($tweet1->source);
	
	$profile_image_url= $tweet1->user->profile_image_url;
	$retweet_count= $tweet1->retweet_count;
	$favorite_count= $tweet1->favorite_count;
	$published = date('Y-m-d H:i:s',strtotime($tweet1->created_at));
	$created_at = date('Y-m-d H:i:s');


	if($text != "")
	{
		$result=mysql_query("SELECT * FROM listeningdata where id_str='$id_str' and text='" . $text . "'");
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into listeningdata (id_str, brandid, text, date_created, language, author, published, link, author_img, 
		user_id_str, user_screen_name, follower_count, friends_count, favourites_count, statuses_count, retweet_count, favorite_count, site_type, location, twitter_client) Values('$id_str', " . $_SESSION['brandid'] .", '$text', '$created_at', '$language','$user_screen_name','$published','$profile_image_url', '$profile_image_url', '$user_id_str', '$user_name', '$follower_count', '$friends_count', '$favourites_count', '$statuses_count', '$retweet_count', '$favorite_count','twitter', '$location','$twitter_client')";
//		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		
		if( $result == 1)
		{
		echo '<br><br>result of insert query is ' . $result;
				$result=mysql_query($query);
		}
		
		}
	}
	//echo '<br><br><br>';
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
