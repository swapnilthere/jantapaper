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

                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>

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
                <div class="card">
                    <div class="card-header">
                        <h3>Dimension</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-check">

                            <input class="form-check-input" onclick="setUnits(this)" type="radio" name="dimension" value="0" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Inches
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" onclick="setUnits(this)" type="radio" value='1' name="dimension" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                CMS
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-lg-12">


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filter By</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="gsm-input" placeholder="GSM">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="sizeH-input" placeholder="Height">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="sizeW-input" placeholder="Width">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="quantity-input" placeholder="Quantity">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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

                                    <th>Presentation Type</th>

                                    <th>Quantity Type</th>

                                    <th>Unit</th>

                                    <th>Location</th>

                                    <th>GSM</th>

                                    <th>SKU</th>

                                    <th>Quantity</th>

                                    <th>Width</th>

                                    <th>Height</th>

                                    <th>Brand</th>
                                    <th>Weight</th>

                                    <th class="text-center">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($categories)) {
                                    $i = 1; ?>

                                    <?php foreach ($categories as $categoryRow) { ?>

                                        <tr>

                                            <td class="text-center"><?php echo $i++ ?>
                                                <textarea style='display:none' id='row_dt_<?= $categoryRow['id'] ?>'><?= json_encode($categoryRow) ?></textarea>
                                            </td>

                                            <td class="text-center"><?php echo $categoryRow['material_type'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['mat_sub_type'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['unit'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['location'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['gsm'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['sku'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['quantity'] ?></td>

                                            <td class="text-center row_w"><?= ($categoryRow['conversion'] == 0) ? $categoryRow['width'] : number_format($categoryRow['width'] / 2.54, 2) ?></td>

                                            <td class="text-center row_h"><?= ($categoryRow['conversion'] == 0) ? $categoryRow['height'] : number_format($categoryRow['height'] / 2.54, 2) ?></td>

                                            <td class="text-center"><?php echo $categoryRow['brand'] ?></td>
                                            <td class="text-center"><?php
                                                                    if ($categoryRow['conversion'] == 0)
                                                                        $weight = ($categoryRow['width'] * $categoryRow['height'] * $categoryRow['gsm'] * 0.000000645161290322581);
                                                                    else $weight = ($categoryRow['width'] * $categoryRow['height'] * $categoryRow['gsm']) / 10000000;
                                                                    echo number_format($weight *  $categoryRow['quantity'] * $categoryRow['unit'], 2);


                                                                    ?></td>

                                            <td>
                                                <?php if ($categoryRow['quantity'] > 0) { ?>

                                                    <a href='javascript:void(0)' onclick="SetPopupData(<?= $categoryRow['id'] ?>)" data-toggle="modal" data-target=".myModal" class="btn btn-primary btn-sm"><i title="Add To Cart" class="fa fa-cart-plus"></i></a>
                                                <?php } ?>

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
                        <?php $admin = $this->session->userdata('admin');
                        if ($admin['userType'] != 'user') {
                        ?>

                            <div class="form-group">


                                <label for="">Customer</label>
                                <select name='customer' class="form-control form-select data-customer" onchange="fetchAddress()">
                                    <option value=''>Select</option>
                                    <?php foreach ($client as $row) { ?>
                                        <option value='<?= $row['id'] ?>'><?= $row['client_name'] ?></option>
                                    <?php } ?>

                                </select>



                            </div>
                        <?php } else {
                        ?>
                            <input type='hidden' class='data-customer' name='customer' value="<?= $admin['admin_id'] ?>" /><?php
                                                                                                                        } ?> <div class=" form-group">
                            <label>Shipping Address (Change if necessary)</label>
                            <textarea class="form-control cust_address"></textarea>
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

                    <div class="col-md-12 dimension_in" <?php if ($admin['userType'] == 'user') echo "style='display:none'"; ?>>
                        <label>Dimension in </label>
                        <input type='radio' name='dimension_in' attr="dim_0" value='0' onclick="ConvertToInches(this.checked)" checked /> Inches
                        <input type='radio' name='dimension_in' attr="dim_1" value='1' onclick="ConvertToCMS(this.checked)" /> CMs
                    </div>
                    <div class="col-md-12 dimension_in" <?php if ($admin['userType'] == 'user') echo "style='display:none'"; ?>>
                        <label>Customization Required </label>
                        <input type='checkbox' id='req_customization' />
                    </div>

                    <div class="col-md-6 dimension_in" <?php if ($admin['userType'] == 'user') echo "style='display:none'"; ?>>
                        <div class="form-group">
                            <label for="">Width</label>
                            <input type="number" step='0.01' onblur="checkMax(this)" name="width_inch" id="width_inch" value="" class="form-control minMaxText">
                        </div>

                    </div>
                    <div class="col-md-6 dimension_in" <?php if ($admin['userType'] == 'user') echo "style='display:none'"; ?>>

                        <div class="form-group">

                            <label for="">Height</label>
                            <input type="number" step='0.01' onblur="checkMax(this)" name="height_inch" id="height_inch" value="" class="form-control minMaxText">



                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="">Quantity</label>
                            <input type="number" onblur="checkMax(this)" name="quantity" step='1' id="quantity" value="1" class="form-control minMaxText">
                        </div>

                    </div>




                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearPopupData()">Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addToCart()">Add To Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- /.content -->

<?php $this->load->view('admin/footer'); ?>

<script>
    var defaultVal = 0;
    /*
    function convertToCms(value) {
        return value * 2.54;
    }

    function convertToInch(value) {
        return value / 2.54;
    }
    */
    function ConvertToCMS(obj) {
        if (obj && defaultVal == 0) {
            defaultVal = 1;
            var valW = jQuery("#width_inch").val();
            var valH = jQuery("#height_inch").val();

            var valInCMS = convertToCms(valW);
            jQuery("#width_inch").attr("max", valInCMS);
            jQuery("#width_inch").val(valInCMS);


            valInCMS = convertToCms(valH);
            jQuery("#height_inch").attr("max", valInCMS);
            jQuery("#height_inch").val(valInCMS);


        }
    }

    function ConvertToInches(obj) {

        if (obj && defaultVal == 1) {
            defaultVal = 0;
            var valW = jQuery("#width_inch").val();
            var valH = jQuery("#height_inch").val();

            var valInInch = convertToInch(valW);

            jQuery("#width_inch").attr("max", valInInch);
            jQuery("#width_inch").val(valInInch);


            valInInch = convertToInch(valH);
            jQuery("#height_inch").attr("max", valInInch);
            jQuery("#height_inch").val(valInInch);

        }
    }

    function checkMax(obj) {
        var maxVal = jQuery(obj).attr("max");


        if (parseInt(obj.value) > maxVal) {
            obj.value = maxVal;
        }
    }
    var tableObj;
    <?php if (!empty($categories)) { ?>
        $(document).ready(function() {
            $(".minMaxText").on("input", function() {
                var value = parseInt($(this).val());
                var min = parseInt($(this).attr("min"));
                var max = parseInt($(this).attr("max"));

                if (value < min) {
                    $(this).val(min);
                } else if (value > max) {
                    $(this).val(max);
                }
            });
            tableObj = $('#stockadd').DataTable({

                dom: 'Bfrtip',

                buttons: [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

            });

            $('#gsm-input, #sizeH-input, #sizeW-input, #quantity-input').on('keyup', function() {
                console.log("Trigger Change");
                tableObj.columns(5).search($('#gsm-input').val());
                tableObj.columns(9).search($('#sizeH-input').val());
                tableObj.columns(8).search($('#sizeW-input').val());
                tableObj.columns(7).search($('#quantity-input').val());
                tableObj.draw();
            });
        });
    <?php } ?>
</script>
<script>
    var active = 0;

    function fetchCustomerAddress(custId) {
        jQuery.ajax({
            url: '<?= base_url('fetchAddress/') ?>' + custId,
            method: 'get',

            dataType: 'json', // Expected data type
            success: function(response) {
                console.log(response);
                jQuery(".cust_address").val(response.address);

            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.log('AJAX request error:', error);
            }
        });
    }
    <?php if ($admin['userType'] == 'user') { ?>
        jQuery(function() {
            fetchCustomerAddress(<?= $admin['admin_id'] ?>);
        })
    <?php } ?>

    function fetchAddress() {
        var custId = jQuery(".data-customer").val();
        fetchCustomerAddress(custId);
    }

    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete category?")) {
            // alert(id);
            window.location.href = '<?php echo base_url() . 'admin/category/delete/'; ?>' + id
        }
    }

    var selectedCustomer = "";
    var address = "";

    function clearPopupData() {
        defaultVal = 0;
        setFieldValue(".material_type-data", '');
        setFieldValue(".material_sub_type-data", '');
        setFieldValue(".location-data", '');
        setFieldValue(".brand-data", '');
        setFieldValue(".gsm-data", '');
        setFieldValue(".sku-data", '');

        jQuery("#prod_id").val('');
        jQuery("#height_inch").val('');
        jQuery("#width_inch").val('');

        <?php if ($admin['userType'] == 'user') { ?>
            jQuery(".dimension_in").hide();
        <?php } ?>

    }

    function SetPopupData(recId) {
        var jsonString = jQuery("#row_dt_" + recId).html();
        var data = JSON.parse(jsonString);

        console.log(data);
        if (selectedCustomer != "") {
            jQuery(".data-customer").attr("disabled", "disabled");
            jQuery(".cust_address").attr("disabled", "disabled");
            jQuery(".cust_address").val(address);

        }





        <?php if ($admin['userType'] == 'user') { ?>
            if (data.mat_sub_type.toLowerCase().indexOf('roll') != -1) {

                jQuery(".dimension_in").show();
            }
        <?php } ?>

        setFieldValue(".material_type-data", data.material_type);
        setFieldValue(".material_sub_type-data", data.mat_sub_type);
        setFieldValue(".location-data", data.location);
        setFieldValue(".brand-data", data.brand);
        setFieldValue(".gsm-data", data.gsm);
        setFieldValue(".sku-data", data.sku);

        jQuery("#prod_id").val(data.id);
        jQuery("#height_inch").attr("max", data.height);
        jQuery("#height_inch").val(data.height);
        jQuery("#width_inch").val(data.width);
        jQuery("#width_inch").attr("max", data.width);
        jQuery("#quantity").attr("max", data.quantity);

        if (data.conversion == 1) {
            defaultVal = 1;


        } else {
            defaultVal = 0;

        }
        if (active == 0) {

            if (data.conversion == 1) {
                jQuery("input[attr='dim_0']").attr("checked", "checked");
                jQuery("input[attr='dim_1']").removeAttr("checked");
                console.log("Convert to inch");
                ConvertToInches(jQuery("input[attr='dim_0']"));
            } else {
                console.log("In else part");
                jQuery("input[attr='dim_1']").attr("checked", "checked");
                jQuery("input[attr='dim_0']").removeAttr("checked");
            }
            //ConvertToInches
        } else {
            if (data.conversion == 0) {
                jQuery("input[attr='dim_0']").attr("checked", "checked");
                jQuery("input[attr='dim_1']").removeAttr("checked");

                ConvertToInches(jQuery("input[attr='dim_1']"));
            } else {

                console.log("In else part 2");
                jQuery("input[attr='dim_1']").attr("checked", "checked");
                jQuery("input[attr='dim_0']").removeAttr("checked");
            }
            //ConvertToCMS
        }

    }

    function addToCart() {
        var productId = jQuery("#prod_id").val();
        selectedCustomer = jQuery(".data-customer").val();
        var height_inch = (jQuery("#height_inch").val() == "") ? jQuery("#height_inch").attr("max") : jQuery("#height_inch").val();
        var width_inch = (jQuery("#width_inch").val() == "") ? jQuery("#width_inch").attr("max") : jQuery("#width_inch").val();
        var quantity = jQuery("#quantity").val();
        var conversion = jQuery("input[name='dimension_in']:checked").val()
        address = jQuery(".cust_address").val();
        jQuery.ajax({
            url: '<?= base_url('order/addToCart') ?>',
            method: 'POST',
            data: {
                'productId': productId,
                'selectedCustomer': selectedCustomer,
                'height_inch': height_inch,
                'width_inch': width_inch,
                'address': address,
                'conversion': conversion,
                'req_customization': jQuery("#req_customization:checked").length,
                'quantity': quantity
            },
            dataType: 'json', // Expected data type
            success: function(response) {
                jQuery(".badge.badge-success").html(response.badge);
                jQuery("#cart_url").attr("href", '<?= base_url('cart') ?>');
                // Handle the successful response
                ///enable cart badge
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

    function convertToCms(value) {
        return (value * 2.54).toFixed(2);
    }

    function convertToInch(value) {
        return (value / 2.54).toFixed(2);
    }

    function processElementsConversion(obj) {
        for (var i = 0; i < obj.length; i++) {
            var val = jQuery(obj[i]).html();
            if (active == 0) {
                val = convertToInch(val)
            } else if (active == 1) {
                val = convertToCms(val);
            }
            jQuery(obj[i]).html(val);
        }
    }

    function setUnits(obj) {
        if (obj.checked) {
            var w = jQuery(".row_w");
            var h = jQuery(".row_h");
            if (obj.value == 0 && active == 1) {
                active = 0;
                //console.log("Inch");
                processElementsConversion(w);
                processElementsConversion(h);

            } else if (active == 0 && obj.value == 1) {
                active = 1;
                console.log("CM");
                var val = 1 * 2.54;
                processElementsConversion(w);
                processElementsConversion(h);
            }

        }

    }
</script>