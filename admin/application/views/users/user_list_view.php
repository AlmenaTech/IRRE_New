<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/side_bar'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header card-header-top-border">
            <h3 class="card-title">User List</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- <div class="row"> -->
              <table class="table table-bordered table-striped " id="work-dtls-table">
                <thead>
                  <tr>
                    <th class="text-center">Sl NO</th>
                    <th class="text-center">Student Name</th>
                    <th class="text-center">Email Id</th>
                    <th class="text-center">Contact No</th>
                    <th class="text-center">Role</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach($users as $list){ ?> 
                    <tr>
                      <td class="text-center"><?php echo $i; ?></td>
                      <td><?php echo ucwords($list['fname'].' '.$list['mname'].' '.$list['lname']); ?></td>
                      <td><?php echo $list['email_id']; ?></td>
                      <td><?php echo $list['mobile_no']; ?></td>
                      <td class="text-center"><?php echo $list['stake_name']; ?></td>
                    </tr>
                    
                    
                  <?php $i++;} ?> 
                </tbody>
              </table>
              
            <!-- </div> -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php $this->load->view('layout/footer'); ?>