<?php $this->load->view('admin/header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Stock</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/client/index'; ?>">Client</a></li>
                    <li class="breadcrumb-item active">Add New Client</li>
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
                            Add new client
                        </div>

                    </div>
                    <form action="<?php echo base_url() . 'admin/client/create' ?>" name="categoryForm" id="categoryForm" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Client Name</label>
                                        <input type="text" name="client_name" id="client_name" value="" class="form-control <?php echo (form_error('client_name') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('client_name'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="email" value="" class="form-control <?php echo (form_error('email') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" name="address" id="address" value="" class="form-control <?php echo (form_error('address') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('address'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" id="phone" value="" class="form-control <?php echo (form_error('phone') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('phone'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">PAN</label>
                                        <input type="text" name="pan" id="pan" value="" class="form-control <?php echo (form_error('pan') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('pan'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">GST</label>
                                        <input type="text" name="gst" id="gst" value="" class="form-control <?php echo (form_error('gst') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('gst'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="staff_name" id="staf_name" value="" class="form-control <?php echo (form_error('staf_name') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('staf_name'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="password" id="password" value="" class="form-control <?php echo (form_error('password') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('password'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn  btn-primary mr-4" name="submit" type="submit">Submit</button>
                                <a href="<?php echo base_url() . 'admin/client/index'; ?>" class="btn btn-secondary">Back</a>
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