<?php

class Sanitizer {

	public function sanitize($input) {
		$input = $this->remove_hashtags($input);
		$input = $this->remove_camelcase($input);
		return $input;
	}

	public function remove_hashtags($string){
		return str_replace('#', '', $string);
	}

	public function remove_camelcase($string){
		return preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $string);
	}


}
