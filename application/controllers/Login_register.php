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
        $this->load->model('login_register_model');
    }
    function index()
    {
        $this->load->library('google');
        $this->load->library('twitter');
        $data['google_auth'] = $this->google->google_login('http://localhost/IRRE_New/login_register');
        
        $data['twitter_auth'] = $this->twitter->twitter_login('http://localhost/IRRE_New/login_register');
        if($data['google_auth']['status']==2 && $data['twitter_auth']['status']==2) // checking user already logged in with google / twiiter or not
        {
            $this->load->view('login_register_view',$data);
        }
        else if($data['google_auth']['status']==1) // if user log in with google id
        {
            $user_data['name'] = $_SESSION['token_data']['name'];
            $user_data['email'] = $_SESSION['token_data']['email'];
            $user_data['email_verified'] = $_SESSION['token_data']['email_verified'];
            $user_data['picture'] = $_SESSION['token_data']['picture'];
            $user_data['picture'] = $_SESSION['token_data']['picture'];
            session_destroy();
            $fname = '';
            $mname = '';
            $lname = '';
            $name_arr = explode(' ',$user_data['name']);
            if(count($name_arr)==2)
            {
                $fname = $name_arr[0];
                $lname = $name_arr[1];
            }
            else if(count($name_arr)==3)
            {
                $fname = $name_arr[0];
                $mname = $name_arr[1];
                $lname = $name_arr[2];
            }
            $login_registration_check = $this->login_register_model->login_registration_check($user_data['email'],2);
            if($login_registration_check['count']>0) // login the user
            {
                $user_dtls = $this->login_register_model->get_user_dtls($user_data['email'],2);
                $user_login_dtls = array(
                    'email'                 => $user_dtls['email'],
                    'name'                  => $user_dtls['name'],
                    'stake_holder_login_pk' => $user_dtls['stake_holder_login_pk'],
                    'stake_id_fk'           => $user_dtls['stake_id_fk']
                );
                $this->session->set_userdata('user_dtls',$user_login_dtls);
                return redirect('login_register/user_admin');
            }
            else // register the user and log in
            {
                $arr['user_dtls_arr'] = array(
                    'fname'                 => $fname,
                    'mname'                 => $mname,
                    'lname'                 => $lname,
                    'email_id'              => $user_data['email'],
                    'entry_time'            => date('Y-m-d H:i:s'),
                    'entry_ip'              => $this->input->ip_address(),
                    'active_status'         => 1,
                    'email_verify_status'   => $user_data['email_verified']
                );
                $arr['user_login_arr'] = array(
                    'login_id'              => $user_data['email'],
                    'entry_time'            => date('Y-m-d H:i:s'),
                    'entry_ip'              => $this->input->ip_address(),
                    'active_status'         => 1,
                    'login_type'            => 2
                );
                $insert_status = $this->login_register_model->insert_login_credentials($arr);
                if($insert_status['status']==='true') // db transaction is OK then user data will store in session and redirect to their login
                {
                    $user_login_dtls = array(
                        'email'                 => $user_data['email'],
                        'name'                  => $user_data['name'],
                        'stake_holder_login_pk' => $insert_status['stake_holder_login_pk'],
                        'stake_id_fk'           => NULL
                    );
                    $this->session->set_userdata('user_dtls',$user_login_dtls);
                    return redirect('login_register/user_admin');
                }
                else // db transaction is failed then error message will display
                {
                    $this->session->set_flashdata('login_err_msg',"Something went wrong.Please try again later.");
                    return redirect('login_register');
                }
            }
        }
        else if($data['twitter_auth']['status']==1)
        {
            echo "<pre>";
            print_r($_SESSION);
        }
        
        
        
    }
   
}