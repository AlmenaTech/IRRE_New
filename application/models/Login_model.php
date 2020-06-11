<?php 
class Login_model extends CI_Model
{
    function check_login($login_id,$password)
    {
        $query = $this->db->select('shl.stake_holder_login_pk,shl.login_id,shl.stake_id_fk,isd.fname,isd.mname,
                        isd.lname,isd.user_id_pk')
                          ->from('irre_stake_holder_login as shl')
                          ->join('irre_user_details as isd','isd.user_id_pk=shl.stake_details_id_fk','left')
                          ->where(
                              array(
                                  'shl.login_id'        => $login_id,
                                  'shl.password'        => $password,
                                  'shl.active_status'   => 1,
                                  'isd.active_status'   => 1
                              )
                          )
                          ->get();
        return $query->result_array();
    }
}