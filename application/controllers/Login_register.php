<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Login_register extends IRRE_Controller
{
    function __construct()
	{
		parent::__construct();
    }
    function index()
    {
        $this->load->view('login_register_view');
    }
}