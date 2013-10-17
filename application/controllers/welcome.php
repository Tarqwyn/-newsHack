<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	private $twitter;

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
		$settings = array(
		    'oauth_access_token' => "301349916-vAfxpgV9Rk6N0O1NZ5eFzdf36iyhXefNvrCzKRzw",
		    'oauth_access_token_secret' => "eml11egJ5yEnSf2ufXOHIXPpWWzSzuxbP3nbtSd8",
		    'consumer_key' => "mdWNVDFGYh5eewcydWtPQ",
		    'consumer_secret' => "WdN71hErcn50JhHAYFTKQ5RmyhyRM34vhZWcbDDQ"
		);

		$this->twitter = new TwitterAPIExchange($settings);
	}

	private function get_following() {

		$requestMethod = "GET";
		$url = "https://api.twitter.com/1.1/friends/ids.json";
		
		$inputUserHandle = $this->input->post('username');
		$getfield = '?id='.$inputUserHandle;

		$followers = $this->twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

		return $followers;

	}

	private function get_tags($following) {

		$tags = array();

		$following = json_decode($following, true);
		$following = $following["ids"];

		foreach($following as $userID) {
			$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
			$getfield = '?include_entities=true&user_id='.$userID;

			// get user's latest tweet
			$tweet = $this->twitter->setGetfield($getfield)
			->buildOauth($url, "GET")
			->performRequest();

			// look for hashtags
			$tweets = json_decode($tweet, true);

			foreach($tweets as $tweet) {
				var_dump($tweet);
				die();

				// add hashtags to array
				if(count($tweet["entities"]["hashtags"]) > 0) {
					foreach($tweet["entities"]["hashtags"] as $hashtag) {

						$sanitized = $hashtag;//sanitize($hashtag);
						$tag = array(
							"id" => $tweet["id"],
							"tag" => $sanitized
						);
						array_push($tags, $tag);
					}
				}
			}
		}

		if(count($tags) >= 1) {
			var_dump($tags);
			die();
		} else {
			die("no hashtags");
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */