<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Register extends IRRE_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
	}
	function index()
	{
		$this->load->library('form_validation');
		$data['stakes'] = $this->register_model->get_all_stakes();
		$config = array(
			array(
				'field'	=> 'stake_type',
				'label'	=> 'stake type',
				'rules'	=> 'trim|required|numeric'
			),
			array(
				'field'	=> 'fname',
				'label'	=> 'first name',
				'rules'	=> 'trim|required|regex_match[/^[a-zA-Z]+$/]'
			),
			array(
				'field'	=> 'mname',
				'label'	=> 'middle name',
				'rules'	=> 'trim|regex_match[/^[a-zA-Z]+$/]'
			),
			array(
				'field'	=> 'lname',
				'label'	=> 'last name',
				'rules'	=> 'trim|required|regex_match[/^[a-zA-Z]+$/]'
			),
			array(
				'field'	=> 'email',
				'label'	=> 'email',
				'rules'	=> 'trim|required|valid_email|regex_match[/^[-\/a-zA-Z0-9@#$%.&*!()]+$/]|callback_check_duplicate_mail'
			),
			array(
				'field'	=> 'password',
				'label'	=> 'password',
				'rules'	=> 'trim|required|regex_match[/^[-\/a-zA-Z0-9@#$%.&*!()]+$/]'
			)

		);
		$this->form_validation->set_rules($config);
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('registration_view',$data);
		}
		else
		{
			$arr['insert_arr_user_dtls'] = array(
				'fname'			=> $this->input->post('fname'),
				'mname'			=> $this->input->post('mname'),
				'lname'			=> $this->input->post('lname'),
				'email_id'		=> $this->input->post('email'),
				'entry_time'	=> date('Y-m-d H:i:s'),
				'entry_ip'		=> $this->input->ip_address(),
				'active_status'	=> 1,
				'stake_id_fk'	=> $this->input->post('stake_type'),
			);
			$arr['insert_login_arr'] = array(
				'login_id'	=> $this->input->post('email'),
				'stake_id_fk'	=> $this->input->post('stake_type'),
				'password'		=> $this->input->post('password'),
				'entry_time'	=> date('Y-m-d H:i:s'),
				'entry_ip'		=> $this->input->ip_address(),
				'active_status'	=> 1,
				'login_type'	=> 1
			);
			$insert_status = $this->register_model->register_user($arr);
			if($insert_status==='true')
			{
				$data['success_msg'] = "Congrats! You have registered successfully in our portal.";
			}
			else
			{
				$data['err_msg'] = "Something went wrong. Please try again later.";
			}
			$this->load->view('registration_view',$data);
		}
		
	}
	function check_duplicate_mail($email)
	{
		$duplicate_mail = $this->register_model->get_duplicate_mail($email);
		if($duplicate_mail>0)
		{
			$this->form_validation->set_message('check_duplicate_mail','mail id already exists.');
			return FALSE;

		}
		else
		{
			return TRUE;
		}
	}

}