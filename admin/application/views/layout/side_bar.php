<?php 
  function set_active_menu($privilege_url)
  {
    $active_menu_flag = 0;
    $current_url = current_url(); 
    $current_url_arr = explode('/',$current_url);
    if(!in_array($privilege_url,$current_url_arr))
    {
      $active_menu_flag = 0;
      echo $active_menu_flag;
    }
    else
    {
      $active_menu_flag = 1;
      echo $active_menu_flag;
    }
  }
  
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" 
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light">IRRE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <p class="site-welcome-text"><span>Welcome</span></p>
          <a href="javascript:void(0)" class="d-block">
          <?php echo ucwords($this->session->userdata('user_dtls')['fname'].' '.$this->session->userdata('user_dtls')['mname'].' '.$this->session->userdata('user_dtls')['lname']); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Dashboard 
              </p>
            </a>
          </li>
          <?php if(isset($this->menus)){ ?>
            <?php foreach($this->menus as $menu){ ?> 
              <li class="nav-item has-treeview <?php if(set_active_menu($menu[0]['privilege_url'])==1){ ?> menu-open <?php } ?>">
                <a href="<?php echo $menu[0]['privilege_url']; ?>" 
                  class="nav-link <?php if(set_active_menu($menu[0]['privilege_url'])==1){ ?> active <?php } ?>">
                  <i class="nav-icon fas <?php echo $menu[0]['icon']; ?>"></i>
                  <p>
                  <?php echo $menu[0]['privilege_name']; ?>
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php foreach($menu[1] as $sub_menu){ ?>
                  <li class="nav-item">
                    <a href="<?php echo $sub_menu['privilege_url'] ?>" 
                      class="nav-link <?php if(set_active_menu($sub_menu['privilege_url'])==1){ ?> active <?php } ?>">
                      <i class="fa <?php echo $sub_menu['icon']; ?> nav-icon"></i>
                      <p><?php echo $sub_menu['privilege_name'] ?></p>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </li>
            <?php } ?>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>