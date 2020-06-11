<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends IRRE_Controller {

	function __construct()
	{
		parent::__construct();
		parent::check_privilege();
	}
	public function index()
	{
		$this->load->view('dashboard_view');
		// print_r($this->session->userdata('user_dtls'));
	}
}
