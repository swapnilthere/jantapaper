<?php
$CI = &get_instance();
$CI->load->model('Global_model');
$userCart = $CI->Global_model->getData('user_cart');

$admin = $this->session->userdata('admin');

?>
<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="x-ua-compatible" content="ie=edge">



    <title>Janta Paper</title>

    <link rel="icon" href="<?php echo base_url() ?>public/admin/dist/img/jp_logo.png" type="image/x-icon">

    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css">

    <!-- Google Font: Source Sans Pro -->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- datatable css -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">



</head>

<style>
    .nav_color {
        color: white;
        font-weight: 700;
    }

    i.fa.fa-cart-arrow-down.fa-2x {
        color: black;
    }

    span.badge.badge-success {
        border-radius: 2rem;
        position: absolute;
        width: 1.5rem;
        height: 1.5rem;
        padding: 0.3rem;
    }

    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active,
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus,
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
        background-color: rgb(252 134 29);
        color: #343a40;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: rgb(252 134 29);
        color: #fff;
    }
</style>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">



        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #0093E9;background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">

            <!-- Left navbar links -->
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: white;"></i></a>


            <!-- Right navbar links -->

            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->



                <!-- Notifications Dropdown Menu -->
                <a id='cart_url' href="<?= count($userCart) > 0 ? base_url('cart') : 'javascript:void(0)' ?>" style="margin: 4px 34px 0px 0px;">
                    <i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i>
                    <span class="badge badge-success"><?= count($userCart) ?></span>
                </a>
                <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="#">

                        Welcome, <strong><?= ucfirst($admin['username']) ?></strong>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>

                        <a href="<?php echo base_url() . 'admin/login/logout'; ?>" class="dropdown-item">

                            Logout

                        </a>
                    </div>

                </li>

            </ul>

        </nav>

        <!-- /.navbar -->



        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #0093E9;background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);">

            <!-- Brand Logo -->

            <a href="<?php echo base_url() ?>" class="brand-link bg-white">

                <img src="<?php echo base_url() ?>public/admin/dist/img/jp_logo.png" alt="AdminLTE Logo" class="brand-image elevation-3 bg-white">

                <span class="brand-text ml-4"><strong>Janta Paper</strong></span>

            </a>



            <!-- Sidebar -->

            <div class="sidebar">



                <!-- Sidebar Menu -->

                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->

                        <li class="nav-item">

                            <a href="<?php echo base_url() ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "dashboard" && !empty($subModule) && $subModule == "viewDashboard") ? 'active' : '' ?>">

                                <i class="fas fa-tachometer-alt"></i>

                                <p class="nav_color">

                                    Dashboard

                                </p>

                            </a>

                        </li>

                        <?php if ($admin['userType'] != 'user') { ?>
                            <li class="nav-item has-treeview <?php echo (!empty($mainModule) && $mainModule == "category") ? 'menu-open' : '' ?>">

                                <a href="#" class="nav-link">

                                    <i class="fas fa-layer-group"></i>

                                    <p class="nav_color">

                                        Stock

                                        <i class="right fas fa-angle-left"></i>

                                    </p>

                                </a>

                                <ul class="nav nav-treeview ">

                                    <?php if ($admin['user_type'] != 4) { ?>
                                        <li class="nav-item">

                                            <a href="<?php echo base_url() . 'admin/category/create'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "category" && !empty($subModule) && $subModule == "createStock") ? 'active' : '' ?>">

                                                <i class="far fa-circle nav-icon"></i>

                                                <p class="nav_color">Add Stock</p>

                                            </a>

                                        </li>
                                    <?php } ?>

                                    <li class="nav-item">

                                        <a href="<?php echo base_url() . 'admin/category/index'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "category" && !empty($subModule) && $subModule == "viewCategory") ? 'active' : '' ?>">

                                            <i class=" far fa-circle nav-icon"></i>

                                            <p class="nav_color">View Stock</p>

                                        </a>

                                    </li>

                                </ul>
                                <?php if ($admin['user_type'] != 4) { ?>
                            <li class="nav-item">

                                <a href="<?php echo base_url() . 'client'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "customer_master" && !empty($subModule) && $subModule == "viewCustomermaster") ? 'active' : '' ?>">

                                    <i class="fas fa-user-friends"></i>

                                    <p class="nav_color">

                                        Customer Master

                                    </p>

                                </a>

                            </li>
                    <?php }
                            } ?>

                    <?php if ($admin['userType'] == 'admin') { ?>
                        <li class="nav-item">

                            <a href="<?php echo base_url() . 'staff'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "staff" && !empty($subModule) && $subModule == "viewStaff") ? 'active' : '' ?>">

                                <i class="fas fa-user"></i>

                                <p class="nav_color">

                                    Staff

                                </p>

                            </a>

                        </li>


                        <li class="nav-item">

                            <a href="<?php echo base_url() . 'admin/material'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "material" && !empty($subModule) && $subModule == "viewMaterial") ? 'active' : '' ?>">

                                <i class="fa fa-folder" aria-hidden="true"></i>

                                <p class="nav_color">

                                    Add Material

                                </p>

                            </a>

                        </li>
                        <li class="nav-item">

                            <a href="<?php echo base_url() . 'admin/subMaterial'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "submaterial" && !empty($subModule) && $subModule == "viewSubmaterial") ? 'active' : '' ?>">

                                <i class="fa fa-clone" aria-hidden="true"></i>

                                <p class="nav_color">

                                    Add Sub-Material

                                </p>

                            </a>

                        </li>
                    <?php } ?>
                    <li class="nav-item">

                        <a href="<?php echo base_url() . 'view_order'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "orders" && !empty($subModule) && $subModule == "viewOrders") ? 'active' : '' ?>">

                            <i class="fa fa-street-view" aria-hidden="true"></i>

                            <p class="nav_color">

                                View Orders

                            </p>

                        </a>

                    </li>
                    <?php if ($admin['userType'] != 'user') { ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url() . 'reusable'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "reusable" && !empty($subModule) && $subModule == "viewReusable") ? 'active' : '' ?>">
                                <i class="fa fa-recycle" aria-hidden="true"></i>

                                <p class="nav_color">

                                    Reusable / Wastage

                                </p>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">

                        <a href="<?php echo base_url() . 'order'; ?>" class="nav-link <?php echo (!empty($mainModule) && $mainModule == "place_order" && !empty($subModule) && $subModule == "viewPlaceorder") ? 'active' : '' ?>">

                            <i class="fa fa-certificate" aria-hidden="true"></i>

                            <p class="nav_color">

                                Place Order

                            </p>

                        </a>

                    </li>

                    </ul>

                </nav>

                <!-- /.sidebar-menu -->

            </div>

            <!-- /.sidebar -->

        </aside>



        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">