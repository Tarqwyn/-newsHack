<?php

class Juicer_model extends CI_Model {

	function validate_hash_tag() {

		$jsonFeed = json_decode('[{"tag":"cssmasking","ids":[388596909650493440]},{"tag":"B BC Mars","ids":[360027773592539136]},{"tag":"nails","ids":[390792882854305792]},{"tag":"miltoncourt","ids":[390585317348376576]},{"tag":"Delo","ids":[374840201329139712]},{"tag":"joker","ids":[386191862157299712]},{"tag":"Android Design","ids":[388356521400467456]},{"tag":"twat","ids":[253932001915183104]},{"tag":"strictly","ids":[390858130516897792]},{"tag":"spacegeeks","ids":[367213090376806400]},{"tag":"data","ids":[390781507943804928]},{"tag":"minorannoyances","ids":[382927844315504640]},{"tag":"royalbabygift","ids":[355356168895471617]},{"tag":"sigh","ids":[390494917195079682]},{"tag":"yahoohack","ids":[328137007727517696]},{"tag":"job","ids":[388603141387583488]},{"tag":"Sydenham","ids":[388239326397874176]},{"tag":"newsrw","ids":[388275304583933952]},{"tag":"mozfest","ids":[390074782995075072]},{"tag":"mcflythemusical","ids":[390798778992963585]},{"tag":"Thug Life","ids":[389843244487413760]},{"tag":"poetrylives","ids":[388630126944321538]},{"tag":"newsHACK","ids":[390835151015804929]},{"tag":"Stars","ids":[388989832737087488]},{"tag":"dudley","ids":[354313175967076354]},{"tag":"Barack Obama","ids":[354313175967076300]}]', true);

		$uriArr = array();

		//die('test die');
		//var_dump($jsonFeed);
		foreach($jsonFeed as $tag){
			//echo $tag;
			//var_dump($tag);

			$url = 'http://bbc.api.mashery.com/juicer-ld-api/concepts/tagged?q=' . $tag["tag"] .'&limit=20&api_key=pe83xdg9cbbbkbjzwu5k9hhc';

			$data = @file_get_contents($url, false);

			//echo $data . "<br /><br />";
			//echo gettype($data);
			
			//Convert string into array
			$obj = json_decode($data);
			//var_dump($obj[3]); //All the URI's
			$arr = $obj[3];

			if($arr[0] != ''){
				//echo $arr[0] . ' POS';
				//echo gettype($arr) . '... THE TYPE';
	
				$uri = $arr[0];
				
				array_push($uriArr,$uri);

				echo $uri . "<hr />";
			}
		}
		
		//Using Find Tagged Concepts 
		//Search the API for the tag - bbc.api.mashery.com/juicer-ld-api/concepts/tagged?q=roone&limit=20&api_key=pe83xdg9cbbbkbjzwu5k9hhc
		//If results from the tagged contents is found 
			//Extract the URI from the third array, pos [2] use first URI?!
			//Get the article content from - Find articles using SPARQL API feed 
		//Else 
			// Return no results found	


					
		$this->get_articles_SPARQL($uriArr);
	}

	function get_articles_SPARQL($uri){

		//API URL example - http://bbc.api.mashery.com/juicer-ld-api/articles.json?binding=url&limit=5&where=?url cwork:tag <http://dbpedia.org/resource/Barack_Obama>.?url cwork:primaryFormat cwork:VideoFormat. ?url bbc:product bbc:NewsWeb.&api_key=pe83xdg9cbbbkbjzwu5k9hhc

		//Using the data from the SPARQL feed get the article content 
		//var_dump($uri);

		//echo count($uri) . " COUNT ";

		foreach ($uri as $key => $value) {
			# code...
			echo  '<br />' . $value;


			//$url = 'http://bbc.api.mashery.com/juicer-ld-api/articles.json?binding=url&limit=5&where=?url cwork:tag <'.$value.'>.?url cwork:primaryFormat cwork:VideoFormat. ?url bbc:product bbc:NewsWeb.&api_key=pe83xdg9cbbbkbjzwu5k9hhc';

			$url = "http://bbc.api.mashery.com/juicer-ld-api/articles.json?binding=url&limit=5&where=?thing%20rdf:type%20<http://dbpedia.org/ontology/Company>%20.%20?thing%20<http://dbpedia.org/ontology/industry>%20<http://dbpedia.org/resource/Aerospace>%20.%20?url%20cwork:tag%20?thing%20.&api_key=pe83xdg9cbbbkbjzwu5k9hhc";

			$data = @file_get_contents($url, false);

			//echo $data . "<br /><br />";
			//echo gettype($data);
			
			//Convert string into array
			//$obj = json_decode($data);
			//var_dump($obj); //

			//echo count($obj["articles"]) . " COUNT <br />";

			//echo '<hr />' . $obj[$key] . "<hr />";

		}
	} 
}