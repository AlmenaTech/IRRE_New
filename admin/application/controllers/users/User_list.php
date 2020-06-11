<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class User_list extends IRRE_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(5);
        $this->load->model('users/user_list_model');
        $this->css_head = array(
            1 => 'assets/common/css/dataTable/dataTable.bootstrap.min.css',
            // 2 => 'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            3 => 'assets/components/css/upload-file.css',
            4 => 'assets/components/css/button.css',
            5 => 'assets/work_details/css/work-dtls.css',
        );
        $this->js_foot = array(
            1 => 'assets/common/js/dataTable/jquery.dataTables.min.js',
            2 => 'assets/common/js/dataTable/dataTables.bootstrap4.min.js',
            // 3 => 'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js',
            // 4 => 'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
            5 => 'assets/users/js/user_list.js'
        );
    }
    function index()
    {
        $data['users'] = $this->user_list_model->get_all_users();
        $this->load->view('users/user_list_view',$data);
    }
}