<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* DEPENDENCIES */
require("sanitizer.php");

class Welcome extends CI_Controller {

	private $twitter;
	private $tags = array();

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		//$this->get_followers();
		$this->load->view('welcome_message');
		debug("hi");
	}

	public function tags() {
		$this->initialiseTwitter();
		$following = $this->get_following();
		$tags = $this->get_tags($following);
		return $tags;
	}

	private function initialiseTwitter() {

		require_once APPPATH.'/libraries/TwitterAPIExchange.php';
 
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
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

	private function get_following() {

		$requestMethod = "GET";
		$url = "https://api.twitter.com/1.1/friends/ids.json";
		
		$inputUserHandle = $this->input->post('username');
		$getfield = '?id='.$inputUserHandle;

		$followers = $this->twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

        $this->queryCheck($followers);

		return $followers;

	}

	/**
	 * Dies if request was forbidden due to too many requests.
	 *
	 * @param $output string 	The output of the request (JSON)
	 */
	private function queryCheck($output) {
		if($output == '{"errors":[{"message":"Rate limit exceeded","code":88}]}') {
			die("Request limit reached. Please wait a few minutes.");
		}
	}


	private function get_tags($following) {
		// convert json data to associative array
		$following = json_decode($following, true);
		$following = $following["ids"];
		
		// prepare sanitizer for converting hashtags to keywords
		$sanitizer = new Sanitizer();

		// loop through each person the user is following
		$count = 0;
		foreach($following as $userID) {

			// get user's latest tweets
			$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
			$getfield = '?include_entities=true&user_id='.$userID;
			$tweets = $this->twitter->setGetfield($getfield)
			->buildOauth($url, "GET")
			->performRequest();
        	$this->queryCheck($tweets);
			$tweets = json_decode($tweets, true);

			// loop through tweets
			foreach($tweets as $tweet) {

				// check if tweet contains hashtag
				if(count($tweet["entities"]["hashtags"]) > 0) {

					// TODO - probably skipping over hashtags here.
					// store hashtag in array
					$hashtag = $tweet["entities"]["hashtags"][0]["text"];

					// sanitize the tag
					$sanitized = $sanitizer->sanitize($hashtag);
					// add to array
					$this->add_tag($sanitized, $tweet["id"]);
				}
			}

			if(++$count > 5) {
				break;
			}
		}
		die(var_dump($this->tags));
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
		foreach($this->tags as $tag) {
			// if we have this tag already
			if($tag["tag"] == $tagToAdd) {
				$tag["ids"][] = $idToAdd;
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */