<?php 
class Register_model extends CI_Model
{
    function get_all_stakes()
    {
        $query = $this->db->select('irre_stake_id_pk,stake_name')
                          ->from('irre_stake_holder_master')
                          ->where(
                              array(
                                'active_status'   => 1,
                                'irre_stake_id_pk !='  => 4
                              )
                          )
                          ->get();
        return $query->result_array();
    }
    function register_user($arr)
    {
        $this->db->trans_begin();
        $this->db->insert('irre_user_details',$arr['insert_arr_user_dtls']);
        $last_insert_id_user_dtls = $this->db->insert_id();
        $user_dtls_affected_rows = $this->db->affected_rows();

        $this->db->insert('irre_stake_holder_login',$arr['insert_login_arr']);
        $last_insert_id_user_login = $this->db->insert_id();
        $user_login_affected_rows = $this->db->affected_rows();

        $this->db->set(
                    array(
                        'stake_details_id_fk'   => $last_insert_id_user_dtls,
                        'update_time'	        => date('Y-m-d H:i:s'),
				        'update_ip'		        => $this->input->ip_address(),
                    )
                )
                 ->where(
                     array(
                         'stake_holder_login_pk'    => $last_insert_id_user_login
                     )
                 )
                 ->update('irre_stake_holder_login');
        $user_login_update_affected_rows = $this->db->affected_rows();
        if($user_dtls_affected_rows==1 && $user_login_affected_rows==1 && $user_login_update_affected_rows==1)
        {
            $this->db->trans_commit();
            return 'true';
        }
        else{
            $this->db->trans_rollback();
            return 'false';
        }
    }
    function get_duplicate_mail($email)
    {
        $query = $this->db->select('count(stake_holder_login_pk) as mail_duplicate_count')
                          ->from('irre_stake_holder_login')
                          ->where(
                              array(
                                  'login_id'    => $email
                              )
                          )
                          ->get();
        return $query->result_array()[0]['mail_duplicate_count'];
    }
}