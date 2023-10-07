<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Staff_Login extends CI_Controller

{


    public function index()

    {
        // $admin = $this->session->userdata('admin');

        // if (!empty($admin)) {
        //     redirect(base_url() . 'admin/dashboard');
        // }
        $this->load->library('form_validation');

        $this->load->view('admin/staff_login');
    }



    public function authenticate()

    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if($this->form_validation->run()==TRUE)
            {
                $username=$this->input->post('username');
                $password=$this->input->post('password');

                $this->load->model('Admin_model');
                $this->Admin_model->checkPassword($email);
            }
        }
    }



    function logout()

    {
        $this->session->unset_userdata('admin');

        redirect(base_url() . 'admin/login/index');
    }
}
