<?php 
class Login_register_model extends CI_Model
{
    function login_registration_check($email,$login_type)
    {
        $query = $this->db->select('count(shl.stake_holder_login_pk)')
                          ->from('irre_stake_holder_login as shl')
                          ->join('irre_user_details as ud','ud.user_id_pk=shl.stake_details_id_fk','left')
                          ->where(
                              array(
                                  'shl.login_id'    => $email,
                                  'ud.email_id'     => $email,
                                  'shl.login_type'  => $login_type
                              )
                          )
                          ->get();
        return $query->result_array()[0];
    }
    function insert_login_credentials($arr)
    {
        $this->db->trans_begin();
        $this->db->insert('irre_user_details',$arr['user_dtls_arr']);
        $user_dtls_affected_rows = $this->db->affected_rows();
        $user_dtls_insert_id = $this->db->insert_id();

        $this->db->insert('irre_stake_holder_login',$arr['user_login_arr']);
        $login_affected_rows = $this->db->affected_rows();
        $login_insert_id = $this->db->insert_id();

        $this->db->set(
                    array(
                        'stake_details_id_fk'   => $user_dtls_insert_id
                    )
                )
                ->where(
                    array(
                        'stake_holder_login_pk' => $login_insert_id
                    )
                )
                ->update('irre_stake_holder_login');
        $login_update_affected_rows = $this->db->affected_rows();

        if($user_dtls_affected_rows==1 && $login_affected_rows==1 && $login_update_affected_rows==1)
        {
            $this->db->trans_commit();
            return array('status'=>'true','stake_holder_login_pk'=>$login_insert_id);
        }
        else
        {
            $this->db->trans_rollback();
            return array('status'=>'false');
        }
    }
    function get_user_dtls($email,$login_type)
    {
        $query = $this->db->select('ud.email_id,shl.login_id,shl.stake_holder_login_pk,shl.stake_id_fk')
                          ->from('irre_stake_holder_login as shl')
                          ->join('irre_user_details as ud','ud.user_id_pk=shl.stake_details_id_fk','left')
                          ->where(
                              array(
                                  'shl.login_id'    => $email,
                                  'ud.email_id'     => $email,
                                  'shl.login_type'  => $login_type
                              )
                          )
                          ->get();
        return $query->result_array();
    }
}