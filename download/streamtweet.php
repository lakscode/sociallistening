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

$company=$_POST['txtCompany'];

$keywords=$_POST['txtKeyword'];

if($company != "")
$_SESSION['company']=$company;

if($keywords != "")
$_SESSION['keywords']=$keywords;


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


 $tweets = $connection->get("https://stream.twitter.com/1.1/statuses/filter.json?track=$keywords");
print_r($connection);
$counter=0;

print_r($tweets);
}
?>
