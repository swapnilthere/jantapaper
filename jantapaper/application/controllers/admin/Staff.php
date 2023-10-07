<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller

{
    public function __construct()

    {

        parent::__construct();
        $admin = $this->session->userdata('admin');
        if (empty($admin)) {
            redirect(base_url('login'));
        }
    }

    public function index()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'staff';
        $data['subModule'] = 'viewStaff';

        $staff = $this->Global_model->executeCustomQuery("select * from user where user_type=2 or user_type=4");

        $data['staff'] = $staff;

        $this->load->view('admin/staff/list', $data);
    }



    public function create()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'staff';
        $data['subModule'] = 'viewStaff';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('staff_name', 'Username', 'trim|required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {
            $formArray['username'] = $this->input->post('staff_name');

            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['user_type'] = $_POST['user_type'];

            $this->Global_model->create('user', $formArray);

            $this->session->set_flashdata('success', 'Staff added successfully');

            redirect(base_url() . 'admin/staff/index');
        } else {

            $this->load->view('admin/staff/create');
        }
    }



    public function edit($id)

    {

        // echo $id;

        $this->load->model('Global_model');

        $staffData = $this->Global_model->getDataById('user', $id);

        $data['mainModule'] = 'staff';
        $data['subModule'] = '';

        if (empty($staffData)) {

            $this->session->set_flashdata('error', 'Staff not found');

            redirect(base_url() . 'admin/staff/index');
        }



        $this->load->library('form_validation');

        $this->form_validation->set_rules('staff_name', 'Name', 'trim|required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['username'] = $this->input->post('staff_name');

            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $formArray['user_type'] = $_POST['user_type'];
            $this->Global_model->update('user', $id, $formArray);

            $this->session->set_flashdata('success', 'Staff Updated successfully');

            redirect(base_url() . 'admin/staff/index');
        } else {

            $data['staffData'] = $staffData;

            $this->load->view('admin/staff/edit', $data);
        }
    }



    public function delete($id)
    {
        $this->load->model('Global_model');
        $category = $this->Global_model->getDataById('user', $id);

        if (empty($category)) {
            $this->session->set_flashdata('error', 'Staff not found');
            redirect(base_url() . 'admin/staff/index');
        }

        $this->Global_model->delete('user', $id);
        $this->session->set_flashdata('success', 'Staff deleted successfully');
        redirect(base_url() . 'admin/staff/index');
    }
}
