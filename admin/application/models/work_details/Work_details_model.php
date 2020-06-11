<?php
class Work_details_model extends CI_Model 
{
    function get_students()
    {
        $query = $this->db->select('iud.user_id_pk,iud.fname,iud.mname,iud.lname')
                          ->from('irre_user_details as iud')
                          ->where(
                              array(
                                  'iud.active_status'   => 1,
                                  'iud.stake_id_fk'     => 5
                              )
                          )
                          ->get();
        return $query->result_array();
    }  
    function insert_work_details($final_insert_array)
    {
        $this->db->trans_begin();
        $this->db->insert_batch('irre_student_work_dtls',$final_insert_array);
        if($this->db->affected_rows()==count($final_insert_array))
        {
            $this->db->trans_commit();
            return 'true';
        }
        else
        {
            $this->db->trans_rollback();
            return 'false';
        }
    } 
    function get_work_list()
    {
        $stake_id_fk = $this->session->userdata('user_dtls')['stake_id_fk'];
        $user_id_pk = $this->session->userdata('user_dtls')['user_id_pk'];
        if($stake_id_fk==5)
        {
            $condition = array(
                'iswd.active_status'   => 1,
                'iud.active_status'   => 1,
                'iud.stake_id_fk'      => $stake_id_fk,
                'iud.user_id_pk'        => $user_id_pk
            );
        }
        else
        {
            $condition = array(
                'iswd.active_status'   => 1,
                'iud.active_status'   => 1
            );
        }
        $query = $this->db->select('iswd.work_title,iswd.work_file_blob,iud.fname,iud.mname,iud.lname,
                        iud.email_id')
                          ->from('irre_student_work_dtls as iswd')
                          ->join('irre_user_details as iud','iud.user_id_pk=iswd.student_id_pk','left')
                          ->where(
                              $condition
                          )
                          ->get();
        return $query->result_array();

    }
}
