<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Category extends CI_Controller

{
    public function __construct()

    {

        parent::__construct();

        $admin = $this->session->userdata('admin');

        if (empty($admin)) {

            $this->session->set_flashdata('msg', 'Your sessionn has been expired');

            redirect(base_url() . '/login');
        }
    }

    public function index()

    {

        $this->load->model('Global_model');




        $categories = $this->Global_model->executeCustomQuery("select products.`id`,products.conversion, material_type.material as material_type, b.material as mat_sub_type, products.`location`, products.`gsm`, products.`sku`, products.`quantity`, products.`unit`,products.`width`, products.`height`, products.`brand`,products.weight from products,material_type,material_type b where products.`material_type`=material_type.id and products.`mat_sub_type`=b.id and products.`quantity`>0");

        $data['categories'] = $categories;

        $data['mainModule'] = 'category';
        $data['subModule'] = 'viewCategory';

        $this->load->view('admin/category/list', $data);
    }



    public function create()

    {

        $this->load->model('Category_model');
        $this->load->model('Global_model');

        $materials = $this->Global_model->getData('material_type', 'parent_id=0');
        $submaterial = $this->Global_model->getData('material_type', 'parent_id>0');

        $data['mainModule'] = 'category';
        $data['subModule'] = 'createStock';

        $data['materials'] = $materials;
        $data['submaterial'] = $submaterial;

        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        $this->form_validation->set_rules('qtype', 'Quantity type', 'trim|required');

        $this->form_validation->set_rules('unit', 'Unit', 'trim|required');

        $this->form_validation->set_rules('location', 'Location', 'trim|required');

        $this->form_validation->set_rules('gsm', 'GSM', 'trim|required');

        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');

        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');

        $this->form_validation->set_rules('winch', 'Width', 'trim|required');

        $this->form_validation->set_rules('hinch', 'Height', 'trim|required');

        $this->form_validation->set_rules('brand', 'Brand', 'trim|required');

        // $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        //$this->form_validation->set_rules('dimensions', 'Dimension', 'trim|required');


        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['material_type'] = $this->input->post('name');

            $formArray['mat_sub_type'] = $this->input->post('qtype');

            $formArray['unit'] = $this->input->post('unit');

            $formArray['location'] = $this->input->post('location');

            $formArray['gsm'] = $this->input->post('gsm');

            $formArray['sku'] = $this->input->post('sku');

            $formArray['quantity'] = $this->input->post('quantity');

            $formArray['width'] = $this->input->post('winch');

            $formArray['height'] = $this->input->post('hinch');

            $formArray['brand'] = $this->input->post('brand');

            $formArray['weight'] = $this->input->post('weight');
            $formArray['conversion'] = $this->input->post('diamensions');

            $this->Category_model->create($formArray);



            $this->session->set_flashdata('success', 'Stock added successfully');

            redirect(base_url() . 'admin/category/index');
        } else {

            $this->load->view('admin/category/create', $data);
        }
    }



    public function edit($id)

    {

        $data['mainModule'] = 'category';
        $data['subModule'] = '';

        $this->load->model('Category_model');
        $this->load->model('Global_model');

        $materials = $this->Global_model->getData('material_type', 'parent_id=0');

        $data['materials'] = $materials;

        $category = $this->Category_model->getCategory($id);



        if (empty($category)) {

            $this->session->set_flashdata('error', 'Category not found');

            redirect(base_url() . 'admin/category/index');
        }



        $this->load->model('Category_model');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|required');

        $this->form_validation->set_rules('qtype', 'Quantity type', 'trim|required');

        $this->form_validation->set_rules('unit', 'Unit', 'trim|required');

        $this->form_validation->set_rules('location', 'Location', 'trim|required');

        $this->form_validation->set_rules('gsm', 'GSM', 'trim|required');

        $this->form_validation->set_rules('sku', 'SKU', 'trim|required');

        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');

        $this->form_validation->set_rules('winch', 'Width', 'trim|required');

        $this->form_validation->set_rules('hinch', 'Height', 'trim|required');

        $this->form_validation->set_rules('brand', 'Brand', 'trim|required');

        //        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');





        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');


        if (@$this->form_validation->run() == TRUE) {

            $formArray['material_type'] = $this->input->post('name');

            $formArray['mat_sub_type'] = $this->input->post('qtype');

            $formArray['unit'] = $this->input->post('unit');

            $formArray['location'] = $this->input->post('location');

            $formArray['gsm'] = $this->input->post('gsm');

            $formArray['sku'] = $this->input->post('sku');

            $formArray['quantity'] = $this->input->post('quantity');

            $formArray['width'] = $this->input->post('winch');

            $formArray['height'] = $this->input->post('hinch');

            $formArray['brand'] = $this->input->post('brand');

            $formArray['weight'] = $this->input->post('weight');
            $formArray['conversion'] = $this->input->post('diamensions');


            $this->Category_model->update($id, $formArray);

            $this->session->set_flashdata('success', 'Stock Updated successfully');

            redirect(base_url() . 'admin/category/index');
        } else {

            $data['category'] = $category;

            $this->load->view('admin/category/edit', $data);
        }
    }



    public function delete($id)
    {
        $this->load->model('Category_model');
        $category = $this->Category_model->getCategory($id);

        if (empty($category)) {
            $this->session->set_flashdata('error', 'Category not found');
            redirect(base_url() . 'admin/category/index');
        }

        $this->Category_model->delete($id);
        $this->session->set_flashdata('success', 'Category deleted successfully');
        redirect(base_url() . 'admin/category/index');
    }
}
