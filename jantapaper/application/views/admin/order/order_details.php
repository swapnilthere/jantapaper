<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0 text-dark">Order Details</h1>

            </div><!-- /.col -->

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>

                    <li class="breadcrumb-item active">Order Details</li>

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

                <?php }
                $admin = $this->session->userdata('admin'); ?>


                <div class="card">
                    <div class="card-header">
                        Order Status
                    </div>
                    <div class="card-body">
                        <div class="container">

                            <table>
                                <tr>
                                    <th>Order Date </th>
                                    <td>:</td>
                                    <td><?= $orderStatus[0]['date'] ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>
                                        <?php if ($orderStatus[0]['status'] == "Dispatched" || $orderStatus[0]['status'] == 'Cancelled' || $admin['userType'] == "user") {
                                            echo $orderStatus[0]['status'];
                                        } else { ?>
                                            <select id='order_status' onchange="toggleOrderAction(this.value)">
                                                <option <?php if ($orderStatus[0]['status'] == "Pending") echo 'selected'; ?> value='Pending'>Pending</option>
                                                <option <?php if ($orderStatus[0]['status'] == "Received") echo 'selected'; ?> value='Received'>Received</option>
                                                <option <?php if ($orderStatus[0]['status'] == "Dispatched") echo 'selected'; ?> value='Dispatched'>Dispatched</option>
                                                <option <?php if ($orderStatus[0]['status'] == "Cancelled") echo 'selected'; ?> value='Cancelled'>Rejected</option>

                                            </select>
                                        <?php } ?>
                                </tr>
                                <tr>
                                    <th>Address </th>
                                    <td>:</td>
                                    <td><?= $orderStatus[0]['address'] ?></td>
                                </tr>
                                <?php if ($orderStatus[0]['status'] !== "Cancelled") { ?>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <br />
                                            <form method='post'>
                                                <input type='hidden' name='order_submit' value='1' />
                                                <input type='hidden' name='oStatus' value='Received' />
                                                <input id='btnChangeOrdStatusRec' style="display:none" type='submit' value='Change Order Status' />
                                            </form>
                                            <input id='btnChangeOrdStatus' style="display:none" type='button' onclick="ChangeOrderStatus()" data-toggle="modal" data-target=".myModal" value='Change Order Status' />
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-header">
                        <?php

                        if ($orderStatus[0]['status'] == 'Dispatched') { ?>
                            <a class="btn btn-primary" href="<?= base_url('deliveryChalan') . '/' . $orderId ?>" target="_blank">Delivery Chalan</a>
                        <?php } ?>

                    </div>

                    <div class="card-body">


                        <table class="table" id="stockadd">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">SKU</th>
                                    <th class="text-center">Dimension</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Quantity Type</th>
                                    <th class="text-center">GSM</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Weight</th>
                                    <th class="text-center">Brand</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($orders)) {
                                    $i = 1; ?>

                                    <?php foreach ($orders as $ordersRow) { ?>

                                        <tr>

                                            <td class="text-center"><?php echo $i++ ?></td>
                                            <td class="text-center"><?php echo $ordersRow['material'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['sku'] ?></td>
                                            <td class="text-center">
                                                <?php $width = $ordersRow['width_inch'];
                                                $height = $ordersRow['height_inch'];
                                                if ($ordersRow['conversion'] == 1) {
                                                    $width = number_format($width * 2.54, 2);
                                                    $height = number_format($height * 2.54, 2);
                                                }
                                                echo $width . "x" . $height
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo $ordersRow['quantity'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['products_material_type'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['gsm'] ?></td>
                                            <td class="text-center"><?php echo $ordersRow['unit'] ?></td>
                                            <td class="text-center"><?php
                                                                    $weight = ($ordersRow['width_inch'] * $ordersRow['height_inch'] * $ordersRow['gsm'] * 0.000000645161290322581);
                                                                    // $weight = ($ordersRow['width_inch'] * $ordersRow['height_inch'] * $ordersRow['gsm'] * 0.00064516258) / 10;
                                                                    echo number_format($weight * $ordersRow['quantity'] * $ordersRow['unit'], 2); ?></td>
                                            <td class="text-center"><?php echo $ordersRow['brand'] ?></td>
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

<!-- /.content -->

<div class="modal myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change Order Status to <span class='oStatus'></span></h4>
                <button type="button" class="close close_add_to_cart" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" id='frm_change_order'>
                    <input type='hidden' name='orderId' value='<?= $orderId ?>' id='oID' />
                    <input type='hidden' name='oStatus' value='' id='oStatus' />
                    <div class="row order-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Invoice Number</label>
                                <input type="text" name="invoice_number" id="invoice_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">BHD</label>
                                <input type="text" name="bhd" id="bhd" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row order-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Customers Own Transport</label>
                                <input type='checkbox' id='own_transport' onclick="UpdateTransportCharges(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row order-data">

                        <div class="col-md-6 transportrequired">

                            <div class="form-group">

                                <label for="">Transportation Charges</label>
                                <input value='0' type="text" name="transportation_charges" id="transportation_charges" class="form-control" />
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="">Vehicle Number</label>
                                <input type="text" name="vehicle_num" id="vehicle_num" class="form-control">


                            </div>

                        </div>

                    </div>
                    <input type='hidden' name='order_submit' value='1'>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close()">Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="changeOrderStatus()">Change Order Status</button>
            </div>
        </div>
    </div>
</div>
<form method="post" id='orderCancel'>
    <input type='hidden' name='orderId' value='<?= $orderId ?>' id='oID2' />
    <input type='hidden' name='ordStatus' value='' id='ordStatus' />
</form>
<?php $this->load->view('admin/footer'); ?>


<script>
    function toggleOrderAction(val) {
        if (val == 'Dispatched' || val == 'Cancelled') {
            document.getElementById('btnChangeOrdStatus').style.display = 'block';
            document.getElementById('btnChangeOrdStatusRec').style.display = 'none';
        } else if (val == 'Received') {
            document.getElementById('btnChangeOrdStatus').style.display = 'none';
            document.getElementById('btnChangeOrdStatusRec').style.display = 'block';
        } else {
            document.getElementById('btnChangeOrdStatus').style.display = 'none';
            document.getElementById('btnChangeOrdStatusRec').style.display = 'none';
        }

    }

    function changeOrderStatus() {
        document.getElementById('frm_change_order').submit();
    }

    function ChangeOrderStatus() {
        if (jQuery("#order_status").val() == "Cancelled") {
            jQuery(".order-data").hide();
            jQuery(".oStatus").html(jQuery("#order_status").val());
            jQuery("#oStatus").val(jQuery("#order_status").val());
            // document.getElementById('ordStatus').value = 'Cancelled';
            // document.getElementById('orderCancel').submit();
        } else if (jQuery("#order_status").val() != "Cancelled" && jQuery("#order_status").val() != "Received") {
            jQuery(".order-data").show();
            jQuery(".oStatus").html(jQuery("#order_status").val());
            jQuery("#oStatus").val(jQuery("#order_status").val());
            document.getElementById("own_transport").checked = false;
            jQuery(".transportrequired").show();
        }

    }
    $(document).ready(function() {

        $('#stockadd').DataTable({

            dom: 'Bfrtip',

            buttons: [

                'copy', 'csv', 'excel', 'pdf', 'print'

            ]

        });

    });
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

    function UpdateTransportCharges(obj) {
        if (obj.checked) {
            jQuery(".transportrequired").hide();
            jQuery("#transportation_charges").val("0");
        } else {
            jQuery(".transportrequired").show();
        }

    }

    function setFieldValue(field, value) {
        jQuery(field).html(value);
    }
</script>