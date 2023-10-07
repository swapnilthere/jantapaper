<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0 text-dark">Place Order</h1>

            </div><!-- /.col -->

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>

                    <li class="breadcrumb-item active">Place Order</li>

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
                            Place order for customer "<?php echo $customerInfo[0]['client_name'] ?>"
                        </div>

                    </div>
                    <form action="<?php echo base_url('placeOrder') . '/' . $customerInfo[0]['id']; ?>" name="clientForm" id="clientForm" method="post">
                        <div class="card-body">
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Invoice Number</label>
                                        <input type="text" name="invoice_number" id="invoice_number" class="form-control <?php echo (form_error('invoice_number') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('invoice_number'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">BHD</label>
                                        <input type="text" name="bhd" id="bhd" class="form-control <?php echo (form_error('bhd') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('bhd'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Transportation Charges</label>
                                        <input type="text" name="transportation_charges" id="transportation_charges" class="form-control <?php echo (form_error('transportation_charges') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('transportation_charges'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Vehicle Number</label>
                                        <input type="text" name="vehicle_num" id="vehicle_num" class="form-control <?php echo (form_error('vehicle_num') != "") ? 'is-invalid' : ''; ?>">
                                        <?php echo form_error('vehicle_num'); ?>
                                    </div>
                                </div>

                            </div>
-->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Product</th>
                                                <th>Dimension</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($products as $row) {

                                            ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row['material_type'] . " (" . $row['mat_sub_type'] . ")" ?></td>
                                                    <td>
                                                        <?php if ($row['conversion'] == 1) { ?>
                                                            <?= number_format($row['width_inch'] * 2.54, 2) . 'x' . number_format($row['height_inch'] * 2.54, 2) ?>
                                                        <?php } else {
                                                        ?>
                                                            <?= $row['width_inch'] . 'x' . $row['height_inch'] ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= $row['quantity'] ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="card-footer">
                                <button class="btn  btn-primary mr-4" name="submit" type="submit" value='place_order'>Place Order</button>
                                <a href="<?php echo base_url('cart'); ?>" class="btn btn-secondary">Back</a>
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


<!-- /.content -->

<?php $this->load->view('admin/footer'); ?>