<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Material extends CI_Controller

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

        $data['mainModule'] = 'material';
        $data['subModule'] = 'viewMaterial';

        $categories = $this->Global_model->getData('material_type', 'parent_id=0');

        $data['material_type'] = $categories;

        $this->load->view('admin/material/list', $data);
    }



    public function create()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'material';
        $data['subModule'] = 'viewMaterial';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('material', 'Material', 'trim|required');


        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['material'] = $this->input->post('material');
            $formArray['parent_id'] = 0;

            $this->Global_model->create('material_type', $formArray);

            $this->session->set_flashdata('success', 'Material added successfully');

            redirect(base_url() . 'admin/material/index');
        } else {

            $this->load->view('admin/material/create');
        }
    }



    public function edit($id)

    {

        // echo $id;

        $this->load->model('Global_model');

        $materialData = $this->Global_model->getDataById('material_type', $id);

        $data['mainModule'] = 'material';
        $data['subModule'] = '';

        if (empty($materialData)) {

            $this->session->set_flashdata('error', 'Material not found');

            redirect(base_url() . 'admin/material/index');
        }



        $this->load->library('form_validation');

        $this->form_validation->set_rules('material', 'material', 'trim|required');




        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['material'] = $this->input->post('material');
            $formArray['parent_id'] = 0;
            $this->Global_model->update('material_type', $id, $formArray);

            $this->session->set_flashdata('success', 'Stock Updated successfully');

            redirect(base_url() . 'admin/material/index');
        } else {

            $data['materialData'] = $materialData;

            $this->load->view('admin/material/edit', $data);
        }
    }



    public function delete($id)
    {
        $this->load->model('Global_model');
        $category = $this->Global_model->getDataById('material_type', $id);

        if (empty($category)) {
            $this->session->set_flashdata('error', 'Material not found');
            redirect(base_url() . 'admin/material/index');
        }

        $this->Global_model->delete('material_type', $id);
        $this->session->set_flashdata('success', 'Material deleted successfully');
        redirect(base_url() . 'admin/material/index');
    }
}
