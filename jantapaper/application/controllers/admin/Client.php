<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Client extends CI_Controller

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

        $categories = $this->Global_model->getData('client');

        $data['client'] = $categories;
        $data['mainModule'] = 'customer_master';
        $data['subModule'] = 'viewCustomermaster';


        $this->load->view('admin/client/list', $data);
    }



    public function create()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'customer_master';
        $data['subModule'] = 'viewCustomermaster';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('client_name', 'Name', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

        $this->form_validation->set_rules('pan', 'PAN', 'trim|required');

        $this->form_validation->set_rules('gst', 'GST', 'trim|required');


        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['username'] = $this->input->post('staff_name');

            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $formArray['client_name'] = $this->input->post('client_name');

            $formArray['email'] = $this->input->post('email');

            $formArray['address'] = $this->input->post('address');

            $formArray['phone'] = $this->input->post('phone');

            $formArray['pan'] = $this->input->post('pan');

            $formArray['gst'] = $this->input->post('gst');



            $this->Global_model->create('client', $formArray);



            $this->session->set_flashdata('success', 'Client added successfully');

            redirect(base_url() . 'admin/client/index');
        } else {

            $this->load->view('admin/client/create');
        }
    }



    public function edit($id)

    {

        // echo $id;

        $this->load->model('Global_model');

        $clientData = $this->Global_model->getDataById('client', $id);
        $data['mainModule'] = 'customer_master';
        $data['subModule'] = '';


        if (empty($clientData)) {

            $this->session->set_flashdata('error', 'Client not found');

            redirect(base_url() . 'admin/client/index');
        }



        $this->load->library('form_validation');

        $this->form_validation->set_rules('client_name', 'Name', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

        $this->form_validation->set_rules('pan', 'PAN', 'trim|required');

        $this->form_validation->set_rules('gst', 'GST', 'trim|required');



        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {
            $formArray['username'] = $this->input->post('staff_name');

            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $formArray['client_name'] = $this->input->post('client_name');

            $formArray['email'] = $this->input->post('email');

            $formArray['address'] = $this->input->post('address');

            $formArray['phone'] = $this->input->post('phone');

            $formArray['pan'] = $this->input->post('pan');

            $formArray['gst'] = $this->input->post('gst');

            $this->Global_model->update('client', $id, $formArray);

            $this->session->set_flashdata('success', 'Stock Updated successfully');

            redirect(base_url() . 'admin/client/index');
        } else {

            $data['clientData'] = $clientData;

            $this->load->view('admin/client/edit', $data);
        }
    }



    public function delete($id)
    {
        $this->load->model('Global_model');
        $category = $this->Global_model->getDataById('client', $id);

        if (empty($category)) {
            $this->session->set_flashdata('error', 'Client not found');
            redirect(base_url() . 'admin/client/index');
        }

        $this->Global_model->delete('client', $id);
        $this->session->set_flashdata('success', 'Client deleted successfully');
        redirect(base_url() . 'admin/client/index');
    }
}
