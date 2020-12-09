<?php
require_once('../lib/Phirehose.php');
require_once('../lib/OauthPhirehose.php');

/**
 * Example of using Phirehose to display a live filtered stream using track words 
 */
class FilterTrackConsumer extends OauthPhirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process. 
     */
    $data = json_decode($status, true);
	//print_r($data);
	foreach($data as $tweet) {
	print_r($tweet);
	echo '<br><br>';
	}
    if (is_array($data) && isset($data['user']['screen_name'])) {
      print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "<br><br>";
    }
  }
}

// The OAuth credentials you received when registering your app at Twitter
define("TWITTER_CONSUMER_KEY", "aO6ThWBUi6szZmPsdICDqpetf");
define("TWITTER_CONSUMER_SECRET", "IOKz9GjkaL13TViuuFzkiQokoQKFliCpcHicklnou6TUWZ1KZ6");


// The OAuth data for the twitter account
define("OAUTH_TOKEN", "2431817262-tHj3yozpWmI1gW2vxrfVeXjbfSMi0E0gIqwDpE9");
define("OAUTH_SECRET", "BiMTg8Si6e9emlKwWSPtBU0Vha4mB74lzXUQLVdwYR2Ib");

// Start streaming
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->setTrack(array('metlife', 'metlife insurance'));
$sc->consume();
