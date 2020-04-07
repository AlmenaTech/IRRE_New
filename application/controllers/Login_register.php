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
        /*$this->load->library('google');
		$data['google_auth_url'] = $this->google->google_login('http://localhost/IRRE_New/login_register')['url'];
        */
        $this->load->library('twitter');
		$data['twitter_auth_url'] = $this->twitter->twitter_login()['twitter_login_url'];
        // echo "<pre>";
        
        // print_r($_SESSION['twitter_access_token']);
        // $data=array();
        session_destroy();
        
        $this->load->view('login_register_view',$data);
        
        
    }
}