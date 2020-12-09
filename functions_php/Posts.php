<?php 

$querystring="";
include("QueryString.php");
include("../db.php");

if($c_date =="")
{
if( $_SESSION['fixed_data'] == "")
	{
		$query = "SELECT  * FROM listeningdata WHERE DATE( published ) > CURDATE( ) - INTERVAL 15 DAY   " .  $querystring . $clause . "  order by published desc limit 0,100";
	}
	else
	{
		$query = "SELECT  * FROM listeningdata WHERE " . $_SESSION['fixed_data'] .  $querystring . $clause . "  order by published desc limit 0,100";
	}
}
else
{
	$query = "SELECT  *  FROM listeningdata WHERE DATE( published ) = '" .  $c_date . "' " .  $querystring . $clause . "  order by published desc  limit 0,100";
}
//echo $query;
	$rows=$mysql_conn->query($query);
	$num_rows=mysql_num_rows ($rows );
	$rOut="<div id='tweet_column' style='overflow: scroll;  height:390px' class='display-post'>";
   while ($row = $rows->fetch_assoc())
   {
   //$rOut .="<div class='display-post'><p>" . $row['title'] . "</p></div>";
   $img= $row["author_img"];
      if($img == "")
   $img = "images/user.png";
   
   $imgtype ="images/tw.png";
   
   if($row["site_type"] == "news")
   $imgtype = "images/news_icon.png";
   if($row["site_type"] == "blogs")
   $imgtype = "images/blog_icon.png";
   if($row["site_type"] == "discussions")
   $imgtype = "images/discussion_icon.png";   
   
    if($row["site_type"] == "twitter")
    {
		$imga='<a target="_blank"  href="https://twitter.com/' . $row["author"]. '" 
		title="' . $row["author"]. '"> 
		<img src="' . $img . '" width="48" height="48"></a>	';
		
		$i_type = '<a target="_blank"  href="https://twitter.com/' . $row["author"]. '"><img src="' . $imgtype . '" width="24" height="24"></a>	';
	}
	else
	{
		$imga='<img src="' . $img . '" width="48" height="48">';
		$i_type = '<a target="_blank"  href="' . $row["link"]. '"><img src="' . $imgtype . '" width="24" height="24"></a>'; 
	 }
	 
   if(strlen( $row["text"] ) >140)
   $t_text=substr(  $row["text"], 0, 140 ) . "<a target='_blank' href='" .$row["link"]. "'>...</a>";
   else
   $t_text= $row["text"];
   
   if($row["site_type"] == "twitter")
   $t_author=  '<a target="_blank"  href="http://twitter.com/' . $row["author"] . '/status/' . $row["id_str"] . '" title="">' . $row["user_screen_name"] . '</a> ';
   else
     $t_author=  '<a target="_blank"  href="' . $row["link"] . '" title="">' . $row["author"] . '</a> ';

    $rOut .='<div class="tweet">
  <div class="tweet_id hidden">' . $row["id_str"] . '</div>
  <div class="tweet_image">
    ' . $imga . '		
  </div>
  <div class="tweet_right">

    <div class="tweet_screen_name">' . $t_author .  $i_type .'
     
    </div>
	 
    <div class="tweet_text">' . $t_text . '	</div>
	       <div class="tweet_date">
        <a target="_blank" href="#" 
          title="">' . $row["published"] . '</a>
      </div>
  </div>
</div><hr>';
   }		
 $rOut .= "</div>";
echo $rOut;

?>