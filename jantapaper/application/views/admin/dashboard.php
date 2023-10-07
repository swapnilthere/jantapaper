<?php $this->load->view('admin/header'); ?>

<!-- Content Header (Page header) -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 class="m-0 text-dark">Dashboard</h1>

            </div><!-- /.col -->

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="#">Home</a></li>

                    <li class="breadcrumb-item active">Dashboard</li>

                </ol>

            </div><!-- /.col -->

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->
<style>
    .pointer_cursor {
        cursor: pointer;
    }
</style>
<script>
    function goToPage(page) {
        window.location = "<?php echo base_url() ?>" + page;
    }
</script>
<?php $admin = $this->session->userdata('admin'); ?>
<!-- Main content -->

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <?php if ($admin['userType'] != 'user') { ?>
                <div class="col-lg-3 col-6 pointer_cursor" onclick="goToPage('view_order')">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalOrders ?></h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6 pointer_cursor" onclick="goToPage('view_order')">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalStock > 0 ? $totalStock : "0" ?><sup style="font-size: 20px"></sup></h3>
                            <p>Total Stock</p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-signal" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6 pointer_cursor" onclick="goToPage('client')">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $totalCustomer ?></h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6 pointer_cursor" onclick="goToPage('staff')">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= $totalStaff ?></h3>
                            <p>Total Staff</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-lg-12 col-12">
                    <label>Welcome :</label> <?= $admin['username'] ?>
                </div>
                <div class="col-lg-3 col-6 pointer_cursor" onclick="goToPage('view_order')">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $totalOrders ?></h3>
                            <p>Your Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $totalStock > 0 ? $totalStock : "0" ?><sup style="font-size: 20px"></sup></h3>
                            <p>Our Stock</p>

                        </div>
                        <div class="icon">
                            <i class="fa fa-signal" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</section>

<!-- /.content -->

</div>

<!-- /.content-wrapper -->

<?php $this->load->view('admin/footer'); ?>