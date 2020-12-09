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


$company=$_POST['txtCompany'];

$keywords=$_POST['txtKeyword'];

$parts = explode(", ",trim($keywords));
$clause=implode(' OR ' ,$parts);

echo $clause;

if($company != "")
$_SESSION['company']=$company;

if($keywords != "")
$_SESSION['keywords']=$keywords;

if($keywords == "")
$keywords="CSC OR @CSC OR Computer Sciences Corporation";

	$created_at = date('Y-m-d H:i:s');
	$c_query = "SELECT * FROM company where company='$company' and keywords = '$keywords'";
	echo $c_query;
$result=mysql_query($c_query);
		$rn=mysql_num_rows($result);
		if($rn<=0)
		{
		$query = "Insert into company (company, keywords,competitors,active,created_at) Values('$company', '$keywords', '', '1', '$created_at')";
		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		echo '<br><br>result of insert query is ' . $result;
		
		$_SESSION['companyid']=mysql_insert_id();
		}
		else
		{
		$result=mysql_query("SELECT id FROM company where company='$company'");

		 while ($row = mysql_fetch_array($rows))
		   {
		   $_SESSION['companyid']=$row['id'];
		   }
		}
		
		echo 'company id ' . $_SESSION['companyid'] . '<br>';
		
		
		echo 'company id ' . $_SESSION['companyid'] . '<br>';
		
		$_SESSION['next_url']="";

		$t_query="SELECT * FROM schedule where company_id=" . $_SESSION['companyid'] . " and active=1  and source='webhose'";
		$result=mysql_query($t_query);
			 while ($row = mysql_fetch_array($result))
		   {
		   $_SESSION['next_url']=$row['next_url'];
		   $query = "update schedule set active=0 where company_id= " . $_SESSION['companyid'] . " and source='webhose'" ;
		   $result=mysql_query($query);


		   }
		   
 echo 'next url ' . $_SESSION['next_url'] . '<br>';
 
 
		
$company="Geico";
$keywords="geico";
echo $keywords;
if( $_SESSION['next_url'] == "")
{

$cntr=0;
$url = "https://webhose.io/search?token=3fea5ee7-1981-4011-bfce-9b19af00e201&format=json&q=" . $clause;
print_data($url);
}
else
{
 echo 'next url ' . $_SESSION['next_url'] . '<br>';
$next=$_SESSION['next_url'] ;
if(substr($next,0,1) == "?")
{
$next=print_data($url);
$glf++;
}
if($next != "" && $glf <10)
{ 
	$next=print_data($url);
}
else
{
	if($next != "")
	{
		$created_at = date('Y-m-d H:i:s');
		$query = "Insert into schedule (company_id, source, next_url,active,created_at) Values(" . $_SESSION['companyid'] .", 'webhose', '$next', 1, '$created_at')";
		 $result=mysql_query($query);
	 }
}
}

print_data($url)
{

x:
$counter=0;
$body = file_get_contents($url);
//print_r($body);
$json = json_decode($body);
echo $url;
foreach($json->posts as $post) {
$counter++;
echo $counter . ' - ';
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
$created_at = date('Y-m-d H:i:s');
print_r($text);
if($text != "")
	{
	$c_query="SELECT * FROM listeningdata where link='$link'";
	echo $c_query;
		$result=mysql_query($c_query);
		$rn=mysql_num_rows($result);
		echo $rn;
		if($rn<=0)
		{
		$query = "Insert into listeningdata (company_id, text, date_created, language, author, published, link, title,  site_full, site, site_section, section_title, title_full, replies_count, participants_count, site_type, spam_score, ord_in_thread,crawled) Values(" . $_SESSION['companyid'] . ",'$text', '$created_at', '$language', '$author','$published','$url','$title', '$site_full','$site','$site_section','$section_title','$title_full',$replies_count,$participants_count,'$site_type',$spam_score,$ord_in_thread,'$crawled')";
		echo '<br><br>' . $query .'<br><br>';
		$result=mysql_query($query);
		echo '<br><br>result of insert query is ' . $result;
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
return $json->next;

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