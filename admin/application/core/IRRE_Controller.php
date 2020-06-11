<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class IRRE_Controller extends CI_Controller{
     public $menus ;
     public $js_foot = array();
     public $css_head = array();
    function __construct()
    {
        parent::__construct();
        $this->load->model('irre_model');
    }
    function check_privilege($privilege_id_pk=NULL)
    {
        if($this->session->userdata('user_dtls'))
        {
            $stake_id_fk = $this->session->userdata('user_dtls')['stake_id_fk'];
            if($privilege_id_pk==NULL)
            {
                $this->set_menus();
            }
            else
            {
                $privilege_count = $this->irre_model->get_privilege_count($stake_id_fk,$privilege_id_pk);
                if($privilege_count[0]['privilege_count']==0)
                {
                    show_404();
                }
                else
                {
                    $this->set_menus();
                }
            }
            
        }
        else
        {
            redirect('login');
        }
    }
    function set_menus()
    {
        
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $stake_id_fk = $this->session->userdata('user_dtls')['stake_id_fk'];
        if(!$this->cache->get('admin/privilege/menus_'.$stake_id_fk.'.json'))
        {
            
            $final_menu_arr = array();
            $parent_menus = $this->irre_model->get_stake_privilege_menu();
            foreach($parent_menus as $menu)
            {
                $menu_arr = array();
                $sub_menus = $this->irre_model->get_stake_privilege_sub_menu($menu['stake_holder_privilege_id_pk']);
                $menu_arr[0] = $menu;
                array_push($menu_arr,$sub_menus );
                array_push($final_menu_arr,$menu_arr );
            }
            
            $this->cache->save('admin/privilege/menus_'.$stake_id_fk.'.json',$final_menu_arr,60*60*24);
             
        }
       
        $this->menus = $this->cache->get('admin/privilege/menus_'.$stake_id_fk.'.json');
        
         
    }
}