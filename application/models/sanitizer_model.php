<?php

class Sanitizer_model extends CI_Model {

	public function sanitize($input) {
		// #BarrackObama -> BarrackObama
		$input = $this->remove_hashtags($input);
		// BarrackObama -> Barrack Obama
		$input = $this->remove_camelcase($input);

		$input = $input[0];

		// remove trailing whitespace before/after string
		//$input = trim($input);

		$input = str_replace('.', '', $input);
		$input = strtolower($input);
		return $input;
	}

	public function remove_hashtags($string){
		return str_replace('#', '', $string);
	}

	public function remove_camelcase($string){
		return preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $string);
	}


}
