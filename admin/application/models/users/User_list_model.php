<?php 

class User_list_model extends CI_Model
{
    function get_all_users()
    {
        $query = $this->db->select('isd.fname,isd.mname,isd.lname,isd.mobile_no,isd.email_id,ishm.stake_name')
                          ->from('irre_user_details as isd')
                          ->join('irre_stake_holder_master as ishm','ishm.irre_stake_id_pk=isd.stake_id_fk','left')
                          ->get();
        return $query->result_array();
    }
}
