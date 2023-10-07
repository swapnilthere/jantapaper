<?php

defined('BASEPATH') or exit('No direct script access allowed');



class SubMaterial extends CI_Controller

{

    public function __construct()

    {

        parent::__construct();

        $admin = $this->session->userdata('admin');

        if (empty($admin)) {

            $this->session->set_flashdata('msg', 'Your sessionn has been expired');

            redirect(base_url() . 'login');
        }
    }


    public function index()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'submaterial';
        $data['subModule'] = 'viewSubmaterial';

        $categories = $this->Global_model->executeCustomQuery("select material_type.*,b.material as parent  from material_type,material_type b where material_type.parent_id>0 and  b.id=material_type.parent_id");


        // $categories = $this->Global_model->getData('material_type', 'parent_id>0');

        $data['material_type'] = $categories;

        $this->load->view('admin/submaterial/list', $data);
    }



    public function create()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'submaterial';
        $data['subModule'] = 'viewSubmaterial';

        $categories = $this->Global_model->getData('material_type', 'parent_id=0');

        $data['material_type'] = $categories;

        $this->load->library('form_validation');

        $this->form_validation->set_rules('material', 'Material', 'trim|required');
        $this->form_validation->set_rules('parent_id', 'Parent Material', 'trim|required');


        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['material'] = $this->input->post('material');
            $formArray['parent_id'] = $this->input->post('parent_id');

            $this->Global_model->create('material_type', $formArray);

            $this->session->set_flashdata('success', 'Material added successfully');

            redirect(base_url() . 'admin/subMaterial/index');
        } else {

            $this->load->view('admin/submaterial/create', $data);
        }
    }



    public function edit($id)

    {

        // echo $id;
        $data['mainModule'] = 'submaterial';
        $data['subModule'] = '';

        $this->load->model('Global_model');

        $materialData = $this->Global_model->getDataById('material_type', $id);
        $categories = $this->Global_model->getData('material_type', 'parent_id=0');

        $data['material_type'] = $categories;

        if (empty($materialData)) {

            $this->session->set_flashdata('error', 'Material not found');

            redirect(base_url() . 'admin/submaterial/index');
        }



        $this->load->library('form_validation');

        $this->form_validation->set_rules('material', 'material', 'trim|required');
        $this->form_validation->set_rules('parent_id', 'Parent Material', 'trim|required');




        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['material'] = $this->input->post('material');
            $formArray['parent_id'] = $this->input->post('parent_id');
            $this->Global_model->update('material_type', $id, $formArray);

            $this->session->set_flashdata('success', 'Stock Updated successfully');

            redirect(base_url() . 'admin/subMaterial/index');
        } else {

            $data['materialData'] = $materialData;

            $this->load->view('admin/submaterial/edit', $data);
        }
    }



    public function delete($id)
    {
        $this->load->model('Global_model');
        $category = $this->Global_model->getDataById('material_type', $id);

        if (empty($category)) {
            $this->session->set_flashdata('error', 'Material not found');
            redirect(base_url() . 'admin/submaterial/index');
        }

        $this->Global_model->delete('material_type', $id);
        $this->session->set_flashdata('success', 'Material deleted successfully');
        redirect(base_url() . 'admin/subMaterial/index');
    }

    public function ajaxSubMaterial()
    {
        $this->load->model('Global_model');
        $parentId = $_REQUEST['id'];
        $material_type = $this->Global_model->getData('material_type', 'parent_id=' . $parentId);

        die(json_encode($material_type));
    }
}
