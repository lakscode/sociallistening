<?php
session_start();
?>
<h3>Twitter Listening </h3>
		<form action="" method="post">
		Brand<input type="text" id="txtBrand" name="txtBrand" /><br>		
		Word<input type="text" id="txtKeyword" name="txtKeyword" /><br>
		<input type="submit" name="Search" id="Search" value="Search" />
</form>

<?php
if(isset($_POST['Search']))
{

$baseURL="https://api.twitter.com/1.1/search/tweets.json";
$_SESSION["baseURL"]=$baseURL;
include("../db.php");
$since=$_POST['txtSince'];
if($since == "")
$since = "2014-12-10";


$until=$_POST['txtUntil'];
if($until == "")
$until="2014-12-11";

$brand=$_POST['txtBrand'];

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

echo mysql_real_escape_string($clause);

if($keywords == "")
$keywords="CSC OR @CSC OR Computer Sciences Corporation";
$_SESSION['brandid']="";
	$created_at = date('Y-m-d H:i:s');
	$c_query = "SELECT * FROM brands where brand='$brand' and keywords = '$keywords'";
	echo $c_query;
	$result=$mysql_conn->query($c_query);
	$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into brands (brand, keywords,competitors,active,created_at) Values('$brand', '$keywords', '', '1', '$created_at')";
		echo '<br><br>' . $query .'<br><br>';
		$result=$mysql_conn->query($query);
		echo '<br><br>result of insert query is ' . $result;
		$result=$mysql_conn->query("SELECT brandid FROM brands where brand='$brand'");

		 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   }

		}
		else
		{
		$result=$mysql_conn->query("SELECT brandid FROM brands where brand='$brand'");

		 while ($row = $result->fetch_assoc())
		   {
		   $_SESSION['brandid']=$row['brandid'];
		   }
		}
		echo 'brand id ' . $_SESSION['brandid'] . '<br>';
		
		
	$_SESSION['next_url']="";
		$t_query="SELECT * FROM schedule where brandid=" . $_SESSION['brandid'] . " and active=1 and source='twitter'";
		$result=$mysql_conn->query($t_query);
		while ($row = $result->fetch_assoc())
		   {
			$_SESSION['next_url']=$row['next_url'];
		   }
echo '<br>Starting connection.. <br>';
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

echo 'Fresh start<br>';
 $url="";
 $today_at = date('Y-m-d');
 
 if(  $_SESSION['next_url'] != "")
 $url=  $_SESSION["baseURL"] . $_SESSION['next_url'];
 else
 {
 	$since_date = date('Y-m-d');
 $url=  $_SESSION["baseURL"] . "?q=$keywords since:2015-06-29&count=100";
 }
 echo '<br>URL - ' . $url . ' <br>';
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
$next = $tweets->search_metadata->next_results;

$t_query="SELECT * FROM schedule where brandid=" . $_SESSION['brandid'] . " and active=1 and source='twitter'";
		echo $t_query;
		$result=$mysql_conn->query($t_query);
		 while ($row = $result->fetch_assoc())
		   {
		   $query = "delete from schedule where brandid= " . $_SESSION['brandid'] . " and source='twitter'" ;
		   echo $query;
		   $result=$mysql_conn->query($query);


		   }
	$_SESSION['next_url']=	   $next;
 echo 'next url ' . $_SESSION['next_url'] . '<br>';
 
	$created_at = date('Y-m-d H:i:s');
	$query = "Insert into schedule (brandid, source, next_url,active,created_at) Values(" . $_SESSION['brandid'] .", 'twitter', '" . $next . "', 1, '$created_at')";
	echo $query;
	 $result=$mysql_conn->query($query);
	 echo "Insert url for next schedule";
	 
echo  $tweets->search_metadata->next_results;
$glf++;
}
echo 'Next url - ' . $next . '<br>';
if($next != "" && $glf <10)
{ goto a;
}
echo '</table>';

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
		$m_query="SELECT * FROM listeningdata where id_str='" . $id_str . "'";
		$result=$mysql_conn->query($m_query);
		echo $m_query;
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into listeningdata (id_str, brandid, text, date_created, language, author, published, link, author_img, 
		user_id_str, user_screen_name, follower_count, friends_count, favourites_count, statuses_count, retweet_count, favorite_count, site_type, location, twitter_client) Values('$id_str', " . $_SESSION['brandid'] .", '$text', '$created_at', '$language','$user_screen_name','$published','$profile_image_url', '$profile_image_url', '$user_id_str', '$user_name', '$follower_count', '$friends_count', '$favourites_count', '$statuses_count', '$retweet_count', '$favorite_count','twitter', '$location','$twitter_client')";

		$result=$mysql_conn->query($query);
		
		if( $result == 1)
		{
			echo '<br><br>' . $query .'<br><br>';
		echo '<br><br>result of insert query is ' . $result;
				$result=$mysql_conn->query($query);
		}
		
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
