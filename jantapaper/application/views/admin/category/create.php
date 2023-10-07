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

                    <li class="breadcrumb-item active">Add New Stock</li>

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

                            Add new stock

                        </div>

                    </div>

                    <form action="<?php echo base_url() . 'admin/category/create' ?>" name="categoryForm" id="categoryForm" method="post">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Material</label>
                                        <select name='name' id='name' class="form-control form-select <?php echo (form_error('name') != "") ? 'is-invalid' : ''; ?>" onchange="pullSubCat(this.value)">
                                            <option value=''>Select</option>
                                            <?php
                                            foreach ($materials as $row) {
                                                $selected = ($row['id'] == $this->input->post('name')) ? 'selected' : '';
                                            ?>
                                                <option value='<?= $row['id'] ?>' <?php echo $selected ?>><?= $row['material'] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <?php echo form_error('name'); ?>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Material Sub Type</label>
                                        <select name='qtype' id='qtype' class="form-control form-select <?php echo (form_error('qtype') != "") ? 'is-invalid' : ''; ?>">
                                            <option value=''></option>
                                        </select>
                                        <?php echo form_error('qtype'); ?>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Unit</label>

                                        <input type="text" name="unit" onblur="calculateWeight()" id="unit" value="<?php echo set_value('unit'); ?>" class="form-control <?php echo (form_error('unit') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('unit'); ?>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Location</label>

                                        <input type="text" name="location" id="location" value="<?php echo set_value('location'); ?>" class="form-control <?php echo (form_error('location') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('qtype'); ?>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">GSM</label>

                                        <input type="text" name="gsm" onblur="calculateWeight()" id="gsm" value="<?php echo set_value('gsm'); ?>" class="form-control <?php echo (form_error('gsm') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('gsm'); ?>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">SKU</label>

                                        <input type="text" name="sku" id="sku" value="<?php echo set_value('sku'); ?>" class="form-control <?php echo (form_error('sku') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('sku'); ?>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Quantity</label>

                                        <input type="text" name="quantity" onblur="calculateWeight()" id="quantity" value="<?php echo set_value('quantity'); ?>" class="form-control <?php echo (form_error('quantity') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('quantity'); ?>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Select Measurement</label>
                                        <select name='diamensions' id='diamensions' onchange="calculateWeight()" class=" form-control <?php echo (form_error('diamensions') != "") ? 'is-invalid' : ''; ?>">
                                            <option value='' selected disabled>Select</option>
                                            <option value='0'>Inches</option>
                                            <option value='1'>Centimeter</option>
                                        </select>
                                        <?php echo form_error('name'); ?>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Height</label>

                                        <input type="text" onblur="calculateWeight()" name="hinch" id="hinch" value="<?php echo set_value('hinch'); ?>" class="form-control <?php echo (form_error('hinch') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('hinch'); ?>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Width</label>

                                        <input type="text" onblur="calculateWeight()" name="winch" id="winch" value="<?php echo set_value('winch'); ?>" class="form-control <?php echo (form_error('winch') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('winch'); ?>

                                    </div>

                                </div>

                            </div>
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Brand</label>

                                        <input type="text" name="brand" id="brand" value="<?php echo set_value('brand'); ?>" class="form-control <?php echo (form_error('brand') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('brand'); ?>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="">Weight</label>

                                        <input type="text" disabled name="weight" id="weight" value="<?php echo set_value('weight'); ?>" class="form-control <?php echo (form_error('weight') != "") ? 'is-invalid' : ''; ?>">

                                        <?php echo form_error('weight'); ?>

                                    </div>

                                </div>

                            </div>

                            <div class="card-footer">

                                <button class="btn  btn-primary mr-4" name="submit" type="submit">Submit</button>

                                <a href="<?php echo base_url() . 'admin/category/index'; ?>" class="btn btn-secondary">Back</a>

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
<script>
    function getVal(element) {
        if (jQuery(element).val() > 0)
            return jQuery(element).val();
        return 0;
    }

    function calculateWeight() {
        var gsm = getVal("#gsm");
        var w = getVal("#winch");
        var h = getVal("#hinch");
        var qty = getVal("#quantity");
        var unit = getVal("#unit");

        var multiplier = (jQuery("#diamensions").val() == 0) ? 0.000000645161290322581 : (1 / 10000000);

        var weight = gsm * w * h * qty * unit * multiplier;
        jQuery("#weight").val(weight.toFixed(2));
    }

    function pullSubCat(val) {
        jQuery.ajax({
            url: '<?= base_url('admin/subMaterial/ajaxSubMaterial') ?>?id=' + val,
            method: 'GET',
            dataType: 'json', // Expected data type
            success: function(response) {
                // Handle the successful response
                var htmlBuild = "<option value=''>Select</option>";
                for (var i = 0; i < response.length; i++) {
                    htmlBuild += "<option value='" + response[i].id + "'>" + response[i].material + "</option>";
                }
                console.log(htmlBuild);
                jQuery("#qtype").html(htmlBuild);

            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.log('AJAX request error:', error);
            }
        });
    }
</script>