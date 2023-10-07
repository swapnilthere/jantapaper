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

                    <li class="breadcrumb-item active">Stock</li>

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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Filter By</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="gsm-input" placeholder="GSM">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="sizeH-input" placeholder="Height">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="sizeW-input" placeholder="Width">
                                </div>
                            </div>
                            <div class="col-md-3">
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

                    <div class="card-tools">

                        <a href="<?php echo base_url() . 'admin/category/create' ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Add Stock</a>

                    </div>

                </div>

                <div class="card-body">

                    <table class="table" id="stockadd">

                        <thead>

                            <tr>

                                <th>Id</th>

                                <th>Material Type</th>

                                <th>Material Sub-type</th>

                                <th>Unit</th>

                                <th>Location</th>

                                <th>GSM</th>

                                <th>SKU</th>

                                <th>Quantity</th>

                                <th>Width</th>

                                <th>Height</th>

                                <th>Brand</th>
                                <th>Weight</th>

                                <th class="text-center" style='width:150px'>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($categories)) {
                                $i = 1; ?>

                                <?php foreach ($categories as $categoryRow) {
                                ?>

                                    <tr>

                                        <td class="text-center"><?php echo $i++ ?></td>

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
                                                                //if ($categoryRow['conversion'] == 0)
                                                                //    $weight = ($categoryRow['width'] * $categoryRow['height'] * $categoryRow['gsm'] * 0.00064516258) / 10;
                                                                //else $weight = ($categoryRow['width'] * $categoryRow['height'] * $categoryRow['gsm']) / 10000;
                                                                if ($categoryRow['conversion'] == 0)
                                                                    $weight = ($categoryRow['width'] * $categoryRow['height'] * $categoryRow['gsm'] * 0.000000645161290322581);
                                                                else $weight = ($categoryRow['width'] * $categoryRow['height'] * $categoryRow['gsm']) / 10000000;
                                                                echo number_format($weight *  $categoryRow['quantity'] * $categoryRow['unit'], 2);
                                                                ?></td>

                                        <td>

                                            <a href="<?php echo base_url() . 'admin/category/edit/' . $categoryRow['id']; ?>" class="btn btn-primary btn-sm"><i title='Edit' class='fa fa-edit'></i></a>

                                            <a href="javascript:void();" onclick="deleteCategory(<?php echo $categoryRow['id']; ?>)" class="btn btn-danger btn-sm"><i title='Delete' class='fa fa-trash'></i></a>

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

<!-- /.content -->

<?php $this->load->view('admin/footer'); ?>

<script>
    <?php if (!empty($categories)) { ?>
        var tableObj;
        $(document).ready(function() {

            tableObj = $('#stockadd').DataTable({

                dom: 'Bfrtip',

                buttons: [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

            });


            searchBy('#gsm-input', 5);
            searchBy('#sizeH-input', 9);
            searchBy('#sizeW-input', 8);
            searchBy('#quantity-input', 7);


            // $('#gsm-input, #sizeH-input, #sizeW-input, #quantity-input').on('keyup', function() {
            //     console.log("Trigger Change");



            //     tableObj.columns(5).search($('#gsm-input').val());
            //     tableObj.columns(9).search($('#sizeH-input').val());
            //     tableObj.columns(8).search($('#sizeW-input').val());
            //     tableObj.columns(7).search($('#quantity-input').val());
            //     tableObj.draw();
            // });

        });

        function searchBy(obj, index) {
            $(obj).on('keyup', function() {
                var inputValue = $(this).val();

                if (inputValue === '') {
                    // Remove the custom filter if input is empty
                    $.fn.dataTable.ext.search.pop();
                } else {
                    searchValue = parseFloat(inputValue);

                    // Apply a custom search filter function
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        var columnValue = parseFloat(data[index]); // Change 5 to the appropriate column index
                        console.log(columnValue);
                        if (!isNaN(columnValue) && columnValue >= searchValue) {
                            return true; // Include row in search results
                        }
                        return false; // Exclude row from search results
                    });
                }
                tableObj.draw();
            });
        }

        // function searchTable() {
        //     var gsmValue = $('#gsm-input').val();
        //     var sizeHValue = $('#sizeH-input').val();
        //     var sizeWValue = $('#sizeW-input').val();
        //     var quantityValue = $('#quantity-input').val();

        //     $('#stockadd tbody tr').hide();
        //     $('#stockadd tbody tr').each(function() {
        //         var gsm = $(this).find('td:eq(5)').text();
        //         var sizeW = $(this).find('td:eq(9)').text();
        //         var sizeH = $(this).find('td:eq(10)').text();

        //         var quantity = $(this).find('td:eq(4)').text();

        //         if (gsm === gsmValue && sizeW === sizeWValue && sizeH === sizeHValue && quantity === quantityValue) {
        //             $(this).show();
        //         }

        //     });
        // }
    <?php } ?>
</script>
<script>
    var active = 0;

    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete category?")) {
            // alert(id);
            window.location.href = '<?php echo base_url() . 'admin/category/delete/'; ?>' + id
        }
    }

    function convertToCms(value) {
        return value * 2.54;
    }

    function convertToInch(value) {
        return value / 2.54;
    }

    function processElementsConversion(obj) {
        for (var i = 0; i < obj.length; i++) {
            var val = jQuery(obj[i]).html();
            if (active == 0) {
                val = convertToInch(val)
            } else if (active == 1) {
                val = convertToCms(val);
            }
            jQuery(obj[i]).html(val.toFixed(2));
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
            tableObj.destroy();
            tableObj = $('#stockadd').DataTable({

                dom: 'Bfrtip',

                buttons: [

                    'copy', 'csv', 'excel', 'pdf', 'print'

                ]

            });


            searchBy('#gsm-input', 5);
            searchBy('#sizeH-input', 9);
            searchBy('#sizeW-input', 8);
            searchBy('#quantity-input', 7);
        }

    }
</script>