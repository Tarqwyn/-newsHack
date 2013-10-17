<?php

class Users_model extends CI_Model {

	function validate()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$queryusers = $this->db->get('users');

		if ($queryusers->num_rows == 1) //username and password validate
		{

			$row = $queryusers->row_array();

			$this->db->where('user_id', $row['user_id']);
			$this->db->order_by('rating_id', 'desc');
			$queryratings = $this->db->get('ratings');  //get ratings for this user_id
			
			
			if ($queryratings->num_rows > 0) // There are some ratings
			{

				$user_and_ratings = array(
					'ratings_array' => $queryratings->result_array(),
					'user_id' => $row['user_id'],
				);
				
				//Now return user id and ratings to the controller and render the view from this list!
				return $user_and_ratings;

			} else return false;
			
		}
		
	}
	
	function create_user()
	{
		
		// check to see if the username and/or email is taken if so return message ---- TO DO (MVP)

		//else create new user:

		$new_user_insert_data = array(
			'email_address' => $this->input->post('email_address'),			
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))						
		);
		
		$insert = $this->db->insert('users', $new_user_insert_data);

		// Now get the new user_id to create default ratings:

		$this->db->where('username', $this->input->post('username'));
		$query_user_id = $this->db->get('users');

		if ($query_user_id->num_rows == 1) //we should only get back the row we just created
		{

			$row = $query_user_id->row_array();
			$new_user_id = $row['user_id'];

			return $new_user_id;
		
		}
	}
}