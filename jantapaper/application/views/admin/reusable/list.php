<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0 text-dark">Remaining Stock</h1>

            </div><!-- /.col -->

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>

                    <li class="breadcrumb-item active">Remaining Stock</li>

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

                <?php if ($this->session->flashdata('success') != '') { ?>

                    <div class="alert alert-success"> <?php echo $this->session->flashdata('success'); ?></div>

                <?php } ?>



                <?php if ($this->session->flashdata('error') != '') { ?>

                    <div class="alert alert-danger"> <?php echo $this->session->flashdata('error'); ?></div>

                <?php } ?>



                <div class="card">

                    <div class="card-body">

                        <table class="table" id="stockadd">

                            <thead>

                                <tr>

                                    <th>Id</th>

                                    <th>Material Type</th>

                                    <th>Material Sub-type</th>

                                    <th>Unit</th>

                                    <th>GSM</th>

                                    <th>SKU</th>

                                    <th>Quantity</th>

                                    <th>Width</th>

                                    <th>Height</th>

                                    <th>Brand</th>

                                    <th class="text-center">Mark as</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($categories)) {
                                    $i = 1;
                                    //echo '<pre>';
                                    //print_r($categories);
                                    //die();
                                ?>

                                    <?php foreach ($categories as $categoryRow) {

                                        if ($categoryRow['height'] > 0) {
                                            //echo '<pre>';
                                            //print_r($categoryRow);
                                            if ($categoryRow['conversion'] == $categoryRow['saleconversion']) {
                                                $w = $categoryRow['width'] - $categoryRow['width_inch'];
                                                $h = $categoryRow['height'] - $categoryRow['height_inch'];
                                            } else {
                                                //convert 
                                                if ($categoryRow['saleconversion'] == 1) {
                                                    $w = ($categoryRow['width'] * 2.54) - $categoryRow['width_inch'];
                                                    $h = ($categoryRow['height'] * 2.54) - $categoryRow['height_inch'];
                                                } else {
                                                    $w = ($categoryRow['width'] / 2.54) - $categoryRow['width_inch'];
                                                    $h = ($categoryRow['height'] / 2.54) - $categoryRow['height_inch'];
                                                }
                                            }


                                            if ($w == 0 && $h > 0)
                                                $w = $categoryRow['width'];

                                            else if ($h == 0 && $w > 0) {
                                                $h = $categoryRow['height'];
                                            } else if ($h == 0 && $w == 0) {
                                                continue;
                                            }
                                            // else continue;

                                    ?>

                                            <tr>

                                                <td class="text-center"><?php echo $i++ ?></td>

                                                <td class="text-center"><?php echo $categoryRow['material_type'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['mat_sub_type'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['unit'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['gsm'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['sku'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['quantity'] ?></td>

                                                <td class="text-center"><?php echo number_format($w, 3) ?></td>

                                                <td class="text-center"><?php echo number_format($h, 3) ?></td>

                                                <td class="text-center"><?php echo $categoryRow['brand'] ?></td>

                                                <td>

                                                    <a href="<?php echo base_url() . 'mark_as/' . $categoryRow['id']; ?>/2" class="btn btn-primary btn-sm">Waste</a>
                                                    <a href="<?php echo base_url() . 'mark_as/' . $categoryRow['id']; ?>/1" class="btn btn-danger btn-sm">Reusable</a>

                                                </td>

                                            </tr>

                                    <?php }
                                    } ?>

                                <?php } else { ?>

                                    <tr>

                                        <td colspan="12">Records Not Found</td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-lg-12">
                <div class="col-sm-6">

                    <h1 class="m-0 text-dark">Reusable</h1>

                </div><!-- /.col -->
            </div>
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">

                        <table class="table" id="stockWastage">

                            <thead>

                                <tr>

                                    <th>Id</th>

                                    <th>Material Type</th>

                                    <th>Material Sub-type</th>

                                    <th>Unit</th>

                                    <th>GSM</th>

                                    <th>SKU</th>

                                    <th>Quantity</th>

                                    <th>Width</th>

                                    <th>Height</th>

                                    <th>Brand</th>


                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($reusableProducts)) {
                                    $i = 1; ?>

                                    <?php foreach ($reusableProducts as $categoryRow) {
                                        if ($categoryRow['height'] > 0) {
                                            if ($categoryRow['conversion'] == $categoryRow['saleconversion']) {
                                                $w = $categoryRow['width'] - $categoryRow['width_inch'];
                                                $h = $categoryRow['height'] - $categoryRow['height_inch'];
                                            } else {
                                                //convert 
                                                if ($categoryRow['saleconversion'] == 1) {
                                                    $w = ($categoryRow['width'] * 2.54) - $categoryRow['width_inch'];
                                                    $h = ($categoryRow['height'] * 2.54) - $categoryRow['height_inch'];
                                                } else {
                                                    $w = ($categoryRow['width'] / 2.54) - $categoryRow['width_inch'];
                                                    $h = ($categoryRow['height'] / 2.54) - $categoryRow['height_inch'];
                                                }
                                            }

                                            if ($w == 0 && $h > 0)
                                                $w = $categoryRow['width'];
                                            else 
                                            if ($h == 0 && $w > 0) {
                                                $h = $categoryRow['height'];
                                            } else if ($h == 0 && $w == 0) {
                                                continue;
                                            }
                                    ?>

                                            <tr>

                                                <td class="text-center"><?php echo $i++ ?></td>

                                                <td class="text-center"><?php echo $categoryRow['material_type'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['mat_sub_type'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['unit'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['gsm'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['sku'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['quantity'] ?></td>

                                                <td class="text-center"><?php echo $w ?></td>

                                                <td class="text-center"><?php echo $h ?></td>

                                                <td class="text-center"><?php echo $categoryRow['brand'] ?></td>


                                            </tr>

                                    <?php }
                                    } ?>

                                <?php } else { ?>

                                    <tr>

                                        <td colspan="12">Records Not Found</td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

            <div class="col-lg-12">
                <div class="col-sm-6">

                    <h1 class="m-0 text-dark">Wastage</h1>

                </div><!-- /.col -->
            </div>
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">

                        <table class="table" id="stockWastage">

                            <thead>

                                <tr>

                                    <th>Id</th>

                                    <th>Material Type</th>

                                    <th>Material Sub-type</th>

                                    <th>Unit</th>

                                    <th>GSM</th>

                                    <th>SKU</th>

                                    <th>Quantity</th>

                                    <th>Width</th>

                                    <th>Height</th>

                                    <th>Brand</th>


                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($wasteProducts)) {
                                    $i = 1; ?>

                                    <?php foreach ($wasteProducts as $categoryRow) {
                                        if ($categoryRow['height'] > 0) {

                                            if ($categoryRow['conversion'] == $categoryRow['saleconversion']) {
                                                $w = $categoryRow['width'] - $categoryRow['width_inch'];
                                                $h = $categoryRow['height'] - $categoryRow['height_inch'];
                                            } else {
                                                //convert 
                                                if ($categoryRow['saleconversion'] == 1) {
                                                    $w = ($categoryRow['width'] * 2.54) - $categoryRow['width_inch'];
                                                    $h = ($categoryRow['height'] * 2.54) - $categoryRow['height_inch'];
                                                } else {
                                                    $w = ($categoryRow['width'] / 2.54) - $categoryRow['width_inch'];
                                                    $h = ($categoryRow['height'] / 2.54) - $categoryRow['height_inch'];
                                                }
                                            }
                                            if ($w == 0 && $h > 0)
                                                $w = $categoryRow['width'];
                                            else 
                                            if ($h == 0 && $w > 0) {
                                                $h = $categoryRow['height'];
                                            } else if ($h == 0 && $w == 0) {
                                                continue;
                                            }
                                    ?>

                                            <tr>

                                                <td class="text-center"><?php echo $i++ ?></td>

                                                <td class="text-center"><?php echo $categoryRow['material_type'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['mat_sub_type'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['unit'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['gsm'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['sku'] ?></td>

                                                <td class="text-center"><?php echo $categoryRow['quantity'] ?></td>

                                                <td class="text-center"><?php echo number_format($w, 2) ?></td>

                                                <td class="text-center"><?php echo number_format($h, 2) ?></td>

                                                <td class="text-center"><?php echo $categoryRow['brand'] ?></td>


                                            </tr>

                                    <?php }
                                    } ?>

                                <?php } else { ?>

                                    <tr>

                                        <td colspan="12">Records Not Found</td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

            <!-- /.col-md-6 -->

        </div>

        <!-- /.row -->

    </div><!-- /.container-fluid -->

</div>

</div>

<!-- /.content -->

<?php $this->load->view('admin/footer'); ?>

<script>
    <?php if (!empty($categories)) { ?>
        $(document).ready(function() {

            $('#stockadd').DataTable({

                dom: 'Bfrtip',

                buttons: [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

            });

        });
    <?php } ?>
</script>
<script>
    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete category?")) {
            // alert(id);
            window.location.href = '<?php echo base_url() . 'admin/category/delete/'; ?>' + id
        }
    }
</script>