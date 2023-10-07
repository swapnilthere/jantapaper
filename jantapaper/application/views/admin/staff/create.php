<?php $this->load->view('admin/header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Staff</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/staff/index'; ?>">Staff</a></li>
                    <li class="breadcrumb-item active">Add New Staff</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Add new staff
                        </div>

                    </div>
                    <form action="<?php echo base_url() . 'admin/staff/create' ?>" name="categoryForm" id="categoryForm" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">User Type</label>
                                        <select name="user_type" class="form-control">
                                            <option value='2'>Manager</option>
                                            <option value='4'>Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="staff_name" id="staf_name" value="" class="form-control <?php echo (form_error('staf_name') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('staf_name'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="password" id="password" value="" class="form-control <?php echo (form_error('password') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn  btn-primary mr-4" name="submit" type="submit">Submit</button>
                                <a href="<?php echo base_url() . 'admin/staff/index'; ?>" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('admin/footer'); ?>