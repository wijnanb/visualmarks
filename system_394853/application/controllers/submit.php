<?php

class Submit extends Controller
{
	function Submit()
	{
		parent::Controller();	
	}
	
	function chrome()
	{
		$data = new stdClass();
		$data->url = $this->input->post('url');
		$data->slug = md5( $data->url . now() );
		
		$this->db->insert('bookmarks', $data); 
		
		
		$this->load->view('submit_chrome', $data);
	}
}