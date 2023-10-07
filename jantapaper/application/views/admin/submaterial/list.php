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

                    <li class="breadcrumb-item"><a href="#">Home</a></li>

                    <li class="breadcrumb-item active">Sub Material</li>

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

                        <div class="card-tools">

                            <a href="<?php echo base_url() . 'admin/subMaterial/create' ?>" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Add Sub Material</a>

                        </div>

                    </div>

                    <div class="card-body">

                        <table class="table" id="stockadd">

                            <thead>

                                <tr>

                                    <th class="text-center">Id</th>
                                    <th class="text-center">Parent</th>

                                    <th class="text-center">Material</th>



                                    <th class="text-center">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($material_type)) {
                                    $i = 1; ?>

                                    <?php foreach ($material_type as $categoryRow) {
                                    ?>

                                        <tr>

                                            <td class="text-center"><?php echo $i++ ?></td>
                                            <td class="text-center"><?php echo $categoryRow['parent'] ?></td>

                                            <td class="text-center"><?php echo $categoryRow['material'] ?></td>
                                            </td>

                                            <td class="text-center">

                                                <a href="<?php echo base_url() . 'admin/subMaterial/edit/' . $categoryRow['id']; ?>" class="btn btn-primary btn-sm"><i title='Edit' class='fa fa-edit'></i></a>

                                                <a href="javascript:void();" onclick="deleteClient(<?php echo $categoryRow['id']; ?>)" class="btn btn-danger btn-sm"><i title='Delete' class='fa fa-trash'></i></a>

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
    <?php if (!empty($material_type)) { ?>
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
    function deleteClient(id) {
        if (confirm("Are you sure you want to delete sub material?")) {
            // alert(id);
            window.location.href = '<?php echo base_url() . 'admin/subMaterial/delete/'; ?>' + id
        }
    }
</script>