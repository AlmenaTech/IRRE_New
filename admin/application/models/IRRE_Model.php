<?php 
class IRRE_Model extends CI_Model{
    function get_stake_privilege_menu()
    {
        $query = $this->db->select('ishp.privilege_url,ishp.privilege_name,
                          ishp.stake_holder_privilege_id_pk,ishp.parent_privilege_id,ishp.icon')
                          ->from('irre_stake_holder_privilege as ishp')
                          ->join('irre_admin_privilege_map as iapm',
                            'iapm.stake_holder_privilege_id_fk=ishp.stake_holder_privilege_id_pk','left')
                          ->join('irre_stake_holder_master as ishm',
                            'ishm.irre_stake_id_pk=iapm.stake_holder_id_fk','left')
                            ->where(
                                array(
                                   'ishp.active_status' => 1,
                                   'iapm.active_status' => 1, 
                                   'ishm.active_status' => 1,
                                   'ishp.parent_privilege_id' => 0,
                                   'iapm.stake_holder_id_fk'  => $this->session->userdata('user_dtls')['stake_id_fk']
                                )
                            )
                            ->get();
        return $query->result_array();
    }
    function get_stake_privilege_sub_menu($privilege_id_pk)
    {
      $query = $this->db->select('ishp.privilege_url,ishp.privilege_name,
                          ishp.stake_holder_privilege_id_pk,ishp.parent_privilege_id,ishp.icon')
                          ->from('irre_stake_holder_privilege as ishp')
                          ->join('irre_admin_privilege_map as iapm',
                            'iapm.stake_holder_privilege_id_fk=ishp.stake_holder_privilege_id_pk','left')
                          ->join('irre_stake_holder_master as ishm',
                            'ishm.irre_stake_id_pk=iapm.stake_holder_id_fk','left')
                            ->where(
                                array(
                                   'ishp.active_status' => 1,
                                   'iapm.active_status' => 1, 
                                   'ishm.active_status' => 1,
                                   'ishp.parent_privilege_id' => $privilege_id_pk,
                                   'iapm.stake_holder_id_fk'  => $this->session->userdata('user_dtls')['stake_id_fk']
                                )
                            )
                            ->get();
        return $query->result_array();
    }
    function get_privilege_count($stake_id_fk,$privilege_id_pk)
    {
      $query = $this->db->select('count(ishp.stake_holder_privilege_id_pk) as privilege_count')
                        ->from('irre_stake_holder_privilege as ishp')
                        ->join('irre_admin_privilege_map as iapm',
                            'iapm.stake_holder_privilege_id_fk=ishp.stake_holder_privilege_id_pk','left')
                          ->join('irre_stake_holder_master as ishm',
                            'ishm.irre_stake_id_pk=iapm.stake_holder_id_fk','left')
                            ->where(
                                array(
                                   'ishp.active_status' => 1,
                                   'iapm.active_status' => 1, 
                                   'ishm.active_status' => 1,
                                   'iapm.stake_holder_id_fk'  => $stake_id_fk,
                                   'ishp.stake_holder_privilege_id_pk'  => $privilege_id_pk
                                )
                            )
                            ->get();
      return $query->result_array();
    }
}