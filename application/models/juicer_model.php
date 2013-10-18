<?php

//http://localhost:8888/newshack/index.php/Welcome/news

class Juicer_model extends CI_Model {

	public function validate_hash_tag($jsonFeed) {

		$jsonFeed = json_decode($jsonFeed, true);

		$uriArr = array();

		foreach($jsonFeed as $tag){

			$url = 'http://bbc.api.mashery.com/juicer-ld-api/concepts/tagged?q=' . urlencode($tag["tag"]) .'&limit=20&api_key=pe83xdg9cbbbkbjzwu5k9hhc';

			//$data = @file_get_contents($url, false);

			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$data = curl_exec($ch);
			curl_close($ch);

			//Convert string into array
			$obj = json_decode($data, true);
			$arr = $obj[3];

			/*
			echo $url . ": ";
			var_dump($data);
			echo "<br />";
			*/

			// 0.5 secs
			usleep(500000);

			if($arr[0] != ''){

				$uri = $arr[0];

				$element = array("uri" => $uri, "tweets" => $tag['ids']);
				
				array_push($uriArr,$element);
			}

			if(count($uriArr) >= 15) {
				break;
			}
		}

		$articles = $this->get_articles_SPARQL($uriArr);
		return $articles;
	}

	function get_articles_SPARQL($uri){

		$articles = array();


		//echo "Should loop " . count($uri) . " times. <br />";

		foreach ($uri as $element) {

			$value = $element['uri'];
			$tweets = $element['tweets'];

			$url = "http://bbc.api.mashery.com/juicer-ld-api/articles.json?binding=url&limit=5&where=" . urlencode("?url cwork:tag <" . $value .">") . "&api_key=pe83xdg9cbbbkbjzwu5k9hhc";

			//$data = @file_get_contents($url, false);

			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$data = curl_exec($ch);
			curl_close($ch);

			//echo $data . "<br /><br />";
			//echo gettype($data);
			$obj = json_decode($data, true);
			
			/*
			echo "Raw data: ".htmlspecialchars($data) . " <br />";
			echo "<br />";
			echo "JSON: ".$obj;
			*/

			//echo "<br />OBJECT: <br />";
			//var_dump($obj);


			//echo count($obj["articles"]) . ' HOW BIG';

			//echo "TITLE = " . $obj["articles"][0]["title"] . "<br />";
			//echo "URL = " . $obj["articles"][0]["url"] . "<br />";


			// 0.5 secs
			usleep(500000);

			if($obj != '') {
				$img = $obj["articles"][0]["image"];
				//echo "IMG SRC = " . $img["src"]. "<br />";


				if(strpos($img['src'], "bbc.co.uk") !== false) {
					$img['src'] = str_replace("bbc.co.uk", "bbcimg.co.uk", $img['src']);

					$tagOne = ".co.uk/";
					$tagTwo = "/images";
					$replacement = "media";

					$text = $img['src'];

					$startTagPos = strrpos($text, $tagOne);
					$endTagPos = strrpos($text, $tagTwo);
					$tagLength = $endTagPos - $startTagPos + 1;

					$newText = substr_replace($text, $replacement, 
					    $startTagPos, $tagLength);

					$img['src'] = $newText;
					$img['src'] = str_replace("bbcimgmedia", "bbcimg.co.uk/media/", $img['src']);
				}

				//$tweets = array(1,2,3);
				$array = array(
					"headline" 	=> $obj["articles"][0]["title"],
					"url" 		=> $obj["articles"][0]["url"],
					"img" 		=> $img["src"],
					"tweets"	=> $tweets
				);
				 
				array_push($articles, $array);
			}
		}
/*
		var_dump($uri);
		echo "<br /><br /><br />";
		var_dump($articles);
		*/
		return json_encode($articles);
	} 
}