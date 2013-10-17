<?php

class Sanitizer {

	public function remove_hashtags($string){
	    return preg_replace('/#(?=[\w-]+)/', '', 
	        preg_replace('/(?:#[\w-]+\s*)+$/', '', $string));
	}

	public function remove_camelcase($string){
		return preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $string);
	}


}
