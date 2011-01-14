<?php

class Dropbox extends Controller
{
	function Dropbox()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$data = new stdClass();
		
		$this->load->view('dropbox', $data);
	}
}