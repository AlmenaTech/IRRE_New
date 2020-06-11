<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/side_bar'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <?php if($this->session->userdata('user_dtls')['stake_id_fk']==5){ ?> 
            <h1>Work List</h1>
            <?php }else{ ?> 
              <li class="breadcrumb-item active">Student Work Details</li>
            <?php } ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <?php if($this->session->userdata('user_dtls')['stake_id_fk']==5){ ?> 
              <li class="breadcrumb-item active">Work List</li>
              <?php }else{ ?> 
                <li class="breadcrumb-item active">Student Work Details</li>
              <?php } ?>
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
          <?php if($this->session->userdata('user_dtls')['stake_id_fk']==5){ ?> 
            <h3 class="card-title"> Work List</h3>
            <?php }else{ ?> 
                <li class="breadcrumb-item active">Student Work Details</li>
          <?php } ?>

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
                    <th class="text-center">Work Title</th>
                    <th class="text-center">Student Name</th>
                    <th class="text-center">Email Id</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;foreach($work_list as $list){ ?> 
                    <tr>
                      <td class="text-center"><?php echo $i; ?></td>
                      <td class="text-center"><?php echo $list['work_title']; ?></td>
                      <td><?php echo ucwords($list['fname'].' '.$list['mname'].' '.$list['lname']); ?></td>
                      <td><?php echo $list['email_id']; ?></td>
                      <td class="text-center">
                        <?php $file_type = mime_content_type('data:application/pdf;base64,'.$list['work_file_blob']); ?>
                    
                        <a href="data:<?php echo $file_type; ?>;base64,<?php  echo $list['work_file_blob']; ?>" 
                            download><i class="fa fa-download"></i></a>
                      </td>
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