<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0 text-dark">Order List</h1>

            </div><!-- /.col -->

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>

                    <li class="breadcrumb-item active">Orders</li>

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

                    <div class="card-header">


                    </div>

                    <div class="card-body">

                        <table class="table" id="stockadd">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Status</th>
                                    <th>Invoice Number</th>
                                    <th>BHD</th>
                                    <th>Transportation Charges</th>
                                    <th>Client Name</th>
                                    <th>Date</th>
                                    <th class="text-center">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($orders)) {
                                    $i = 1; ?>

                                    <?php foreach ($orders as $ordersRow) { ?>

                                        <tr>

                                            <td class="text-center"><?php echo $i++ ?></td>
                                            <td class="text-center"><?php echo $ordersRow['status'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['invoice_number'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['bhd'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['transportation_charges'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['client_name'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['date'] ?></td>
                                            <td>
                                                <a href='<?= base_url('order_details') . "/" . $ordersRow['id'] ?>' class="btn btn-primary btn-sm"><i title='View Details' class='fa fa-eye'></i> Details</a>

                                            </td>

                                        </tr>

                                    <?php } ?>

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
<div class="modal myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Product to cart</h4>
                <button type="button" class="close close_add_to_cart" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12">
                        <input type='hidden' id='prod_id' />
                        <div class="form-group">

                            <label for="">Customer</label>
                            <select name='customer' class="form-control form-select data-customer">
                                <option value=''>Select</option>
                                <?php foreach ($client as $row) { ?>
                                    <option value='<?= $row['id'] ?>'><?= $row['client_name'] ?></option>
                                <?php } ?>

                            </select>



                        </div>

                    </div>


                </div>
                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Material</label>
                            <span class="material_type-data"></span>



                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Sub Type</label>
                            <span class="material_sub_type-data"></span>

                        </div>

                    </div>

                </div>

                <div class="row">


                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Location</label>
                            <span class="location-data"></span>

                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Brand</label>
                            <span class="brand-data"></span>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">GSM</label>
                            <span class="gsm-data"></span>


                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">SKU</label>
                            <span class="sku-data"></span>


                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">
                        <label>Dimension in </label>
                        <input type='radio' name='dimension_in' value='inch' /> Inches
                        <input type='radio' name='dimension_in' value='cms' /> CMs
                    </div>
                    <div class="col-md-12">
                        <label>Customization Required </label>
                        <input type='checkbox' id='req_customization' />
                    </div>



                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Width in Inches</label>
                            <input type="number" step='0.01' name="width_inch" id="width_inch" value="" class="form-control">


                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Height in Inches</label>
                            <input type="number" step='0.01' name="height_inch" id="height_inch" value="" class="form-control">



                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Quantity</label>
                            <input type="number" name="quantity" step='1' id="quantity" value="" class="form-control">



                        </div>

                    </div>




                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addToCart()">Add To Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- /.content -->

<?php $this->load->view('admin/footer'); ?>

<script>
    <?php if (!empty($orders)) { ?>
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

    var selectedCustomer = "";

    function SetPopupData(recId) {
        var jsonString = jQuery("#row_dt_" + recId).html();
        var data = JSON.parse(jsonString);
        console.log(data);
        if (selectedCustomer != "") {
            jQuery(".data-customer").attr("disabled", "disabled");
        }
        setFieldValue(".material_type-data", data.material_type);
        setFieldValue(".material_sub_type-data", data.mat_sub_type);
        setFieldValue(".location-data", data.location);
        setFieldValue(".brand-data", data.brand);
        setFieldValue(".gsm-data", data.gsm);
        setFieldValue(".sku-data", data.sku);

        jQuery("#prod_id").val(data.id);
        jQuery("#height_inch").attr("max", data.height);
        jQuery("#width_inch").attr("max", data.width);
        jQuery("#quantity").attr("max", data.quantity);


    }

    function addToCart() {
        var productId = jQuery("#prod_id").val();
        selectedCustomer = jQuery(".data-customer").val();
        var height_inch = (jQuery("#height_inch").val() == "") ? jQuery("#height_inch").attr("max") : jQuery("#height_inch").val();
        var width_inch = (jQuery("#width_inch").val() == "") ? jQuery("#width_inch").attr("max") : jQuery("#width_inch").val();
        var quantity = jQuery("#quantity").val();


        jQuery.ajax({
            url: '<?= base_url('order/addToCart') ?>',
            method: 'POST',
            data: {
                'productId': productId,
                'selectedCustomer': selectedCustomer,
                'height_inch': height_inch,
                'width_inch': width_inch,
                'req_customization': jQuery("#req_customization:checked").length,
                'quantity': quantity
            },
            dataType: 'json', // Expected data type
            success: function(response) {
                // Handle the successful response
                alert('Product added to cart');

            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.log('AJAX request error:', error);
            }
        });
    }

    function setFieldValue(field, value) {
        jQuery(field).html(value);
    }
</script>