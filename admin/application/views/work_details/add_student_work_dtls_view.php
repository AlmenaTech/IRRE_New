<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/side_bar'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Upload Work</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload Work</li>
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
            <h3 class="card-title">Upload Work</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php echo form_open_multipart('admin/work_details/upload_student_work',array("autocomplete"=>"off")); ?>
            <div class="row">
              <!-- Error messages -->
              <div class="col-md-10">
                <?php if(isset($success_msg)){ ?> 
                  <p class="alert alert-success"><?php echo $success_msg; ?></p>
                <?php } ?>
                <?php if(isset($error_msg)){ ?> 
                  <p class="alert alert-danger"><?php echo $error_msg; ?></p>
                <?php } ?>
              </div>
              <!-- Error messages -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Work Title</label>
                  <input type="text" name="work_title" class="form-control" placeholder="Work title" 
                    value="<?php echo set_value('work_title'); ?>"/>
                  <span class="text-danger text-bold"><?php echo form_error('work_title'); ?></span>
                </div>
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                <label>Choose Student</label>
                  <div class="select2-purple">
                    <select class="form-control select2" multiple="multiple" name="student[]" style="width: 100%;">
                      <option value="">--- Choose ---</option>
                      <?php foreach($students as $stu){ ?>
                      <option value="<?php echo $stu['user_id_pk']; ?>" 
                        <?php echo set_select('student[]',$stu['user_id_pk']); ?>>
                        <?php echo ucwords($stu['fname'].' '.$stu['mname'].' '.$stu['lname']); ?></option>
                      <?php } ?>
                    </select>
                    <span class="text-danger text-bold"><?php echo form_error('student[]'); ?></span>
                  </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                  <label for="work_doc" class="upload-file-space upload-file-text-align">
                    Upload Document (.docx or .pdf file only)<br/>
                    <span class="file-no-text text-danger text-bold"><?php echo form_error('work_doc'); ?></span><br/>
                  <input type="file" name="work_doc" id="work_doc" class="form-control upload-file-input-field" />
                </div>
              </div>
              <div class="col-md-12 work-dtls-add-form">
                <button type="submit"  class=" button-style-1">Add</button>
              </div>
            </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php $this->load->view('layout/footer'); ?>