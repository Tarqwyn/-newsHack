<html>
<body>

	<?php
		echo "<h2>Simple Twitter API Test</h2>";

		
/*			require_once('PhpConsole.php');
	PhpConsole::start();
		// test
		debug('test message');
		//debug('SELECT * FROM users', 'sql');
		//unkownFunction($unkownVar);*/

		require_once('TwitterAPIExchange.php');
		
 
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		$settings = array(
		    'oauth_access_token' => "301349916-vAfxpgV9Rk6N0O1NZ5eFzdf36iyhXefNvrCzKRzw",
		    'oauth_access_token_secret' => "eml11egJ5yEnSf2ufXOHIXPpWWzSzuxbP3nbtSd8",
		    'consumer_key' => "mdWNVDFGYh5eewcydWtPQ",
		    'consumer_secret' => "WdN71hErcn50JhHAYFTKQ5RmyhyRM34vhZWcbDDQ"
		);

		$requestMethod = "GET";
		//$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
		//$url = "https://api.twitter.com/1.1/statuses/home_timeline.json";
		//$url = "https://api.twitter.com/1.1/search/tweets.json";
		$url = "https://api.twitter.com/1.1/friends/ids.json";
		
		//$getfield = '?screen_name=leimdorfer&count=20';
		//$getfield = '?q=Tottenham';
		$getfield = '?id=leimdorfer';



		$twitter = new TwitterAPIExchange($settings);
		
/*		echo $twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest();

		echo "<pre>";
		print_r($string);
		echo "</pre>";*/

		$string = json_decode($twitter->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest(),$assoc = TRUE);

		//var_dump($string);

		echo "<pre>";
		print_r($string);
		echo "</pre>";

/*		foreach($string as $items){

	        echo $items['created_at']."<br />";
	        echo $items['text']."<br />";

	    }*/

	?>

</body>
</html>