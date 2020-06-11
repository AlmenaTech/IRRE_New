<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload_student_work extends IRRE_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(2);
        $this->load->model('work_details/work_details_model');
        $this->css_head = array(
            1 => 'assets/plugins/select2/css/select2.min.css',
            2 => 'assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
            3 => 'assets/components/css/upload-file.css',
            4 => 'assets/components/css/button.css',
            5 => 'assets/work_details/css/work-dtls.css',
        );
        $this->js_foot = array(
            1 => 'assets/plugins/select2/js/select2.full.min.js',
            2 => 'assets/work_details/js/work_details.js',
            3 => 'assets/components/js/upload-file.js',
        );
    }
    function index()
    {
        $this->load->library('form_validation');
        $data['students'] = $this->work_details_model->get_students();
        $config = array(
            array(
                'field'	=> 'work_title',
                'label'	=> 'title',
                'rules'	=> 'trim|required|regex_match[/^[-\/ a-zA-Z0-9()]+$/]'
				
            ),
            array(
                'field'	=> 'student[]',
                'label'	=> 'student',
                'rules'	=> 'trim|required|numeric|regex_match[/^[0-9]+$/]'
				
            ),
            array(
                'field'	=> 'work_doc',
                'label'	=> 'document',
                'rules'	=> 'callback_file_check'
				
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('work_details/add_student_work_dtls_view',$data);
        }
        else
        {
            $final_insert_array = array();
            $student_ids = $this->input->post('student');
            // processing the file
            $work_file = $_FILES['work_doc']['tmp_name'];
            $uploading_file=base64_encode(file_get_contents($work_file));
            // processing the db insert array
            foreach($student_ids as $studs)
            {
                $insert_array = array(
                    'student_id_pk' => $studs,
                    'work_file_blob'    => $uploading_file,
                    'work_title'        => $this->input->post('work_title'),
                    'active_status'     => 1,
                    'entry_ip'          => $this->input->ip_address()
                );
                array_push($final_insert_array,$insert_array);
            }
            // echo "<pre>";
            // print_r($final_insert_array);die;
            // insert in DB
            $insert_status = $this->work_details_model->insert_work_details($final_insert_array);
            if($insert_status==='true')
            {
                $data['success_msg'] = "Successfully added";
            }
            else
            {
                $data['error_msg'] = "Something went wrong";
            }
            $this->load->view('work_details/add_student_work_dtls_view',$data);
        }
        
    }
    function file_check($str){
        $allowed_mime_type_arr = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword','application/pdf');
        
        if(isset($_FILES['work_doc']['name']) && $_FILES['work_doc']['name']!="" ){
            $mime = get_mime_by_extension($_FILES['work_doc']['name']);
				if(in_array($mime, $allowed_mime_type_arr)  && $_FILES['work_doc']['size'] <=  '5242880'){
					return true;
				}
				else if($_FILES['work_doc']['size'] >  '5242880' )
				{
						$this->form_validation->set_message('file_check', 'file size can not exceed 5 MB');
					return false;
				}
				else{
					$this->form_validation->set_message('file_check', 'Please select only .docx / .pdf file');
					return false;
				}
		}
		
		else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload');
            return false;
        }
    }
}
