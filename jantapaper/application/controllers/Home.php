<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Home extends CI_Controller

{

    public function __construct()

    {

        parent::__construct();

        $admin = $this->session->userdata('admin');

        if (empty($admin)) {

            $this->session->set_flashdata('msg', 'Your session has expired');

            redirect(base_url() . '/login');
        }
    }



    public function index()

    {
        $data['mainModule'] = 'dashboard';
        $data['subModule'] = 'viewDashboard';
        $this->load->model('Global_model');
        $admin = $this->session->userdata('admin');
        $whereClause = "";

        if ($admin['userType'] == 'user')
            $whereClause = " where client_id=" . $admin['admin_id'];

        $totalOrders = $this->Global_model->executeCustomQuery("select count(id) as cnt from  orders $whereClause limit 1");
        $totalStock = $this->Global_model->executeCustomQuery("select sum(quantity) as cnt from  products limit 1");
        $totalCustomer = $this->Global_model->executeCustomQuery("select count(id) as cnt from  client limit 1");
        $totalStaff = $this->Global_model->executeCustomQuery("select count(id) as cnt from  user where user_type=2 limit 1");


        $data['totalOrders'] = $totalOrders[0]['cnt'];
        $data['totalStock'] = $totalStock[0]['cnt'];
        $data['totalCustomer'] = $totalCustomer[0]['cnt'];
        $data['totalStaff'] = $totalStaff[0]['cnt'];

        $this->load->view('admin/dashboard', $data);
    }
}
