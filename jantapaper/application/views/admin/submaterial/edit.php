<?php $this->load->view('admin/header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Sub Material</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'admin/subMaterial/index'; ?>">Sub Material</a></li>
                    <li class="breadcrumb-item active">Edit Sub Material</li>
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
                            Edit sub material "<?php echo $materialData['material'] ?>"
                        </div>

                    </div>
                    <form action="<?php echo base_url() . 'admin/subMaterial/edit/' . $materialData['id']; ?>" name="clientForm" id="clientForm" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Parent Material</label>
                                        <select name="parent_id" class="form-control <?php echo (form_error('parent_id') != "") ? 'is-invalid' : ''; ?>">
                                            <option value=''>Select</option>
                                            <?php
                                            foreach ($material_type as $row) { ?>
                                                <option <?php if ($materialData['parent_id'] == $row['id']) echo 'selected'; ?> value='<?= $row['id'] ?>'><?= $row['material'] ?></option>
                                            <?php }
                                            ?>
                                        </select>

                                        <?php echo form_error('parent_id'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Sub Material</label>
                                        <input type="text" name="material" id="material" value="<?php echo set_value('material', $materialData['material']); ?>" class="form-control <?php echo (form_error('material') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('material'); ?>
                                    </div>
                                </div>

                            </div>



                            <div class="card-footer">
                                <button class="btn  btn-primary mr-4" name="submit" type="submit">Submit</button>
                                <a href="<?php echo base_url() . 'admin/subMaterial/index'; ?>" class="btn btn-secondary">Back</a>
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