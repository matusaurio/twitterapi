<?php
echo "<link rel='stylesheet' type='text/css' href='style.css' />"; 
echo "<div class='header'>"; 
echo "<img src='Twitter_logo_blue.png' id='logo' >";
echo "<h2>Twitter API</h2>";
echo "</div>";
require_once('TwitterAPIExchange.php');
 
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "162608195-4QPEOdoLRI5fzmQmjyaFft3uVwpwhR4FwvNWbrAb",
    'oauth_access_token_secret' => "GMBaG70dYehJbcoTGpP3MU91aBBq4BKIzJdKbpAGTIacf",
    'consumer_key' => "lRnwNaTwB2T8SguyELX26aunb",
    'consumer_secret' => "3jPmhYarQ1boticpESUTYGmCXcEDzWYkdLS78cTDNgovMp8kI3"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";

if (isset($_GET['user'])) {$user = $_GET['user'];} else {$user = "sdbcmh";}
if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 20;}
$getfield = "?screen_name=$user&count=$count";
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
//if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
foreach($string as $items)
    {
    	echo "<div class='twitter-tweet'>";
        echo "Día y Hora del Tweet: ".$items['created_at']."<br />";
        echo "<h3>Tweet: ". $items['text']."</h3><br />";
        echo "Tweeted by: ". $items['user']['name']."<br />";
        echo "Screen name: ". $items['user']['screen_name']."<br />";
        echo "Seguidores: ". $items['user']['followers_count']."&nbsp &nbsp";
        echo "Siguiendo: ". $items['user']['friends_count']."&nbsp &nbsp";
        echo "Listas: ". $items['user']['listed_count']."<br /><hr />";
        echo "</div><br/>	";
    }
?>