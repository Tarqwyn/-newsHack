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
	public function index() {
		//$this->get_followers();
		$this->load->view('welcome_message');
		debug("hi");
	}

	public function news() {
		//$this->load->model("tags_model");
		$this->load->model("juicer_model");
		$this->juicer_model->validate_hash_tag();
		//$tags = $this->tags_model->tags($this->input->post('username'));
		//var_dump($tags);
		die("end");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */