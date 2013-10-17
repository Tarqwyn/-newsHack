<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		//$this->get_followers();
		$this->load->view('welcome_message');
		debug("hi");
	}

	public function tags() {
		$followers = $this->get_followers();
		//die(var_dump($followers));
		$hashtags = $this->get_tags($followers);
		$tags = $this->sanitize($hashtags);
		return $tags;
	}

	private function get_followers()
	{
		
		require_once APPPATH.'/libraries/TwitterAPIExchange.php';
 
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
		$inputUserHandle = $this->input->post('username');
		$getfield = '?id='.$inputUserHandle;
		//'+$inputUserHandle;

		$twitter = new TwitterAPIExchange($settings);
		//var_dump($twitter);
		//exit();

		//debug($twitter);

		$followers = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
		
		return $followers;

		// $string = json_decode($twitter->setGetfield($getfield)
		// 	->buildOauth($url, $requestMethod)
		// 	->performRequest(),$assoc = TRUE);

		//$this->load->view('result');

		//debug($string);

		// echo "<pre>";
		// print_r($string);
		// echo "</pre>";

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */