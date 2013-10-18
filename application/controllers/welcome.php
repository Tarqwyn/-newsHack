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
	public function index($news) {
		/*
			$news needs to have the following JSON format:

			news = array(
				array(
					"headline" => "headline",
					"img" => "img",
					"url" => "url",
					"tweets" => array(1,2,3,4),
				),
				array(
					"headline" => "headline",
					"img" => "img",
					"url" => "url",
					"tweets" => array(1,2,3,4),
				)
			);
		*/
		$_POST["news"] = $news;
		$this->load->view('welcome_message');
	}

	public function news() {
		// get search terms based on who user follows
		$this->load->model("tags_model");
		$tags = $this->tags_model->tags($this->input->post('username'));
		// convert search terms to news articles
		$news = $this->juicer_model->convert($tags);
		// display results
		$this->index($news);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */