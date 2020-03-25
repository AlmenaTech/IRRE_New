<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Login extends IRRE_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}
	function index()
	{
		if($this->session->userdata('user_dtls'))
		{
			// echo $this->session->userdata('user_dtls')['stake_holder_login_pk'];
			print_r($this->session->userdata('user_dtls')); // change in future
		}
		else
		{
			$this->load->library('form_validation');
			$config = array(
				array(
					'field'	=> 'login_id',
					'label'	=> 'Login id',
					'rules'	=> 'trim|required|regex_match[/^[-\/a-zA-Z0-9@#$%.&*!()]+$/]'
				),
				array(
					'field'	=> 'user_pass',
					'label'	=> 'password',
					'rules'	=> 'trim|required|regex_match[/^[-\/a-zA-Z0-9@#$%.&*!()]+$/]'
				)
			);
			$this->form_validation->set_rules($config);
			
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
			if($this->form_validation->run()==FALSE)
			{
				
				$this->load->view('login_view');
			}
			else
			{
				$login_id = $this->input->post('login_id');
				$password = $this->input->post('user_pass');
				$check_login = $this->login_model->check_login($login_id,$password);
				if(count($check_login)==1)
				{
					$sess_arr = array(
						'stake_holder_login_pk'	=> $check_login[0]['stake_holder_login_pk'],
						'login_id'				=> $check_login[0]['login_id'],
						'stake_id_fk'			=> $check_login[0]['stake_id_fk']
					);
					$this->session->set_userdata('user_dtls',$sess_arr);
					print_r($this->session->userdata('user_dtls')); // change in future
				}
				else
				{
					$data['error_msg'] = "Invalid login credentials.";
					$this->load->view('login_view',$data);
				}
			}
		}
		
		
	}
	function logout()
	{
		$this->session->unset_userdata('user_dtls');
		return redirect(base_url().'login');
	}
}