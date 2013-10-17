<?php

class Tags_model extends CI_Model {


	private $twitter;
	private $tags = array();

	public function tags($username) {
		// get the twitter hook
		$this->initialiseTwitter();
		// get ids of who the user follows
		$following = $this->get_following($username);
		// set the $tags array populated from this function
		$this->get_tags($following);
		// done
		return $this->tags;
	}

	private function initialiseTwitter() {

		require_once APPPATH.'/libraries/TwitterAPIExchange.php';
 
		/* 
		 Set access tokens here - see: https://dev.twitter.com/apps/ 
		 Switch between the two settings if we get a "too many requests" error.
		*/
		$settingsAndy = array(
		    'oauth_access_token' => "301349916-vAfxpgV9Rk6N0O1NZ5eFzdf36iyhXefNvrCzKRzw",
		    'oauth_access_token_secret' => "eml11egJ5yEnSf2ufXOHIXPpWWzSzuxbP3nbtSd8",
		    'consumer_key' => "mdWNVDFGYh5eewcydWtPQ",
		    'consumer_secret' => "WdN71hErcn50JhHAYFTKQ5RmyhyRM34vhZWcbDDQ"
		);
		$settingsChris = array(
		    'oauth_access_token' => "479521185-W6etJQWwU1K0xDiO4yEumaXM6aAueOk00BSEMyJr",
		    'oauth_access_token_secret' => "Bd8FCIzpu85Ur6rCsdQeaL4LHHdvEZcimVWzdmgY",
		    'consumer_key' => "CRDO2mZHoHrNu2vG2oQ",
		    'consumer_secret' => "vjyrlJvDUNO328NxMmrbNTv6J6kzuBjVwWWjgIDetPI"
		);

		$this->twitter = new TwitterAPIExchange($settingsChris);
	}

	private function get_following($username) {

		$requestMethod = "GET";
		$url = "https://api.twitter.com/1.1/friends/ids.json";
		
		$getfield = '?id='.$username;

		$following = $this->twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

        $this->queryCheck($following);

		return $following;

	}

	/**
	 * Dies if request was forbidden due to too many requests.
	 *
	 * @param $output string 	The output of the request (JSON)
	 */
	private function queryCheck($output) {
		if($output == '{"errors":[{"message":"Rate limit exceeded","code":88}]}') {
			die("Request limit reached. Please switch to other authorisation details, or wait a few minutes.");
		}
	}

	/**
	 * Gets the latest tweet from every single person the user follows. Scans those tweets
	 * for hashtags. Returns to 
	 *
	 *
	 */
	private function get_tags($following) {
		// convert json data to associative array
		$following = json_decode($following, true);
		$following = $following["ids"];
		
		// prepare sanitizer for converting hashtags to keywords
		$this->load->model("sanitizer_model");

		// limit to 100 users per request
		$queries = array();
		$index = 0;
		for($i = 0; $i < count($following); $i++) {
			if($i == 0 || ($i % 100 == 0) ) {
				if($i > 0) { $index++; }
				$queries[$index] = $following[$i];
			} else {
				$queries[$index] = $queries[$index] . "," . $following[$i]; 
			}
		}

		// make the requests for user's latest tweets
		foreach($queries as $userIDs) {
			// get user's latest tweets
			$url = "https://api.twitter.com/1.1/users/lookup.json";
			$getfield = '?include_entities=true&user_id='.$userIDs;

			$tweets = $this->twitter->setGetfield($getfield)
			->buildOauth($url, "GET")
			->performRequest();
	    	$this->queryCheck($tweets);
			$tweets = json_decode($tweets, true);

			foreach($tweets as $tweet) {
				// get tweet ID, status, and hashtags
				$tweetID = @$tweet["id"];
				$tweetStatus = @$tweet["status"]["text"];
				preg_match_all('/#[^\s]*/i', $tweetStatus, $hashtags);

				// if tweet has hashtag(s), add to array
				if(count($hashtags[0]) > 0) {
					foreach($hashtags as $hashtag) {
						// sanitize the tag
						$sanitized = $this->sanitizer_model->sanitize($hashtag);
						// add to array
						$this->add_tag($sanitized, $tweetID);
					}
				}
			}
		}

		// sort into trending order, if any
		// TODO - move this out into a function
		$temp = $this->tags;
		$sortedArray = array();

		for($j = 0; $j < count($temp); $j++) {
			$mostSoFar = 0; 
			$index = 0;
			for($i = 0; $i < count($temp); $i++) {
				$count = count($temp[$i]["ids"]);

				if($count > $mostSoFar) {
					$mostSoFar = $count;
					$index = &$temp[$i];
				}
			}

			// add highest so far to sorted array
			array_push($sortedArray, $index);
			// remove from old array
			$index = array("tag" => "", "ids" => array());
		}

		// update private tags array with the sorted array
		$this->tags = json_encode($sortedArray);
	}

	/**
	 * Adds a tag to the JSON representation of tags.
	 * Eventual output after multiple calls to this function:
	 *
	 *  $tags = array(
	 *	 	array(
	 *	 		"tag" => "myHashtag",
	 *	 		"ids" => array(1,2,3,4)
	 *	 	),
	 *	 	array(
	 *	 		"tag" => "myHashtag",
	 *	 		"ids" => array(1,2,3,4)
	 *	 	)
	 *	);
	 *
	 * @param $tagToAdd string 	The tag to add to the array
	 * @param $idToAdd int 		Tweet ID to associate with the tag
	 */
	private function add_tag($tagToAdd, $idToAdd) {

		// loop through existing tags
		$added = false;
		for($i = 0; $i < count($this->tags); $i++) {
			// if we have this tag already
			if($this->tags[$i]["tag"] === $tagToAdd) {

				// add tweet id to array
				$count = count($this->tags[$i]["ids"]);
				$this->tags[$i]["ids"][$count] = $idToAdd;

				$added = true;
				break;
			}
		}

		if(!$added) {
			$this->tags[] = array(
				"tag" => $tagToAdd,
				"ids" => array($idToAdd)
			);
		}
	}

}