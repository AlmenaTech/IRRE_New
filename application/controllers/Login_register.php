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
        if($this->session->userdata('user_dtls'))
        {
            return redirect('login_register/user_admin');
        }
        else
        {
            $this->load->library('google');
            $this->load->library('twitter');
            $data['google_auth'] = $this->google->google_login('http://localhost/IRRE_New/login_register');
            
            $data['twitter_auth'] = $this->twitter->twitter_login('http://localhost/IRRE_New/login_register');
            $user_data = array();
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
                // echo $user_data['email'];die;
                unset($_SESSION['token_data']);
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
                // print_r($login_registration_check);die;
                if($login_registration_check['count']>0) // login the user
                {
                    $user_dtls = $this->login_register_model->get_user_dtls($user_data['email'],2);
                    // print_r($user_dtls);die;
                    $user_login_dtls = array(
                        'email'                 => $user_dtls[0]['email_id'],
                        'stake_holder_login_pk' => $user_dtls[0]['stake_holder_login_pk'],
                        'stake_id_fk'           => $user_dtls[0]['stake_id_fk'],
                        'fname'                 => $fname,
                        'mname'                 => $mname,
                        'lname'                 => $lname,
                        'user_id_pk'            => $user_dtls[0]['user_id_pk']
                    );
                    $this->session->set_userdata('user_dtls',$user_login_dtls);
                    // print_r($this->session->userdata('user_dtls'));
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
                            'stake_holder_login_pk' => $insert_status['stake_holder_login_pk'],
                            'stake_id_fk'           => NULL,
                            'fname'                 => $fname,
                            'mname'                 => $mname,
                            'lname'                 => $lname,
                            'user_id_pk'            => $insert_status['user_id_pk']
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
                $user_data['name'] = $_SESSION['token_data']->name;
                $user_data['email'] = $_SESSION['token_data']->email; 
                unset($_SESSION['token_data']);
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
                $login_registration_check = $this->login_register_model->login_registration_check($user_data['email'],3);
                if($login_registration_check['count']>0) // login the user
                {
                    $user_dtls = $this->login_register_model->get_user_dtls($user_data['email'],3);
                    $user_login_dtls = array(
                        'email'                 => $user_dtls[0]['email_id'],
                        'stake_holder_login_pk' => $user_dtls[0]['stake_holder_login_pk'],
                        'stake_id_fk'           => $user_dtls[0]['stake_id_fk'],
                        'fname'                 => $fname,
                        'mname'                 => $mname,
                        'lname'                 => $lname,
                        'user_id_pk'            => $user_dtls[0]['user_id_pk']
                    );
                    $this->session->set_userdata('user_dtls',$user_login_dtls);
                    // print_r($this->session->userdata('user_dtls'));
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
                    );
                    $arr['user_login_arr'] = array(
                        'login_id'              => $user_data['email'],
                        'entry_time'            => date('Y-m-d H:i:s'),
                        'entry_ip'              => $this->input->ip_address(),
                        'active_status'         => 1,
                        'login_type'            => 3
                    );
                    $insert_status = $this->login_register_model->insert_login_credentials($arr);
                    if($insert_status['status']==='true') // db transaction is OK then user data will store in session and redirect to their login
                    {
                        $user_login_dtls = array(
                            'email'                 => $user_data['email'],
                            'stake_holder_login_pk' => $insert_status['stake_holder_login_pk'],
                            'stake_id_fk'           => NULL,
                            'fname'                 => $fname,
                            'mname'                 => $mname,
                            'lname'                 => $lname,
                            'user_id_pk'            => $insert_status['user_id_pk']
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
        }
        
        
    }
    function user_admin()
    {
       
        if($this->session->userdata('user_dtls'))
        {
            if($this->session->userdata('user_dtls')['stake_id_fk']=='' || $this->session->userdata('user_dtls')['stake_id_fk']==NULL)
            {
                $data['stakes'] = $this->login_register_model->get_all_stakes();
                $this->load->view('choose_stake_view',$data);
            }
            else
            {
                // redirect to user login
                return redirect(base_url().'admin');
            }
        }
        else
        {
            return redirect('login_register');
        }
        
    }
    function setup_profile()
    {
        $stake_type = $this->input->post('stake_type');
        $user_dtls = $this->login_register_model->get_user_login_details();
        if($stake_type=='' || $stake_type==NULL)
        {
            $this->session->set_flashdata('err_msg',"Please choose a role.");
                $this->user_admin();
        }
        else
        {
            $update_arr  = array(
                'stake_id_fk'   => $stake_type
            );
            $update_status = $this->login_register_model->update_user_profile($update_arr,$user_dtls[0]['stake_details_id_fk']);
            if($update_status==='true')
            {
                $_SESSION['user_dtls']['stake_id_fk'] = $stake_type;
                
                return redirect(base_url().'user');
                
            }
            else
            {
                $this->session->set_flashdata('err_msg',"Something went wrong.Please try again later");
                $data['stakes'] = $this->login_register_model->get_all_stakes();
                $this->load->view('choose_stake_view',$data);
            }
        }
    }
   
}