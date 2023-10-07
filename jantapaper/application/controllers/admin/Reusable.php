<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Reusable extends CI_Controller

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


        $orders = $this->Global_model->executeCustomQuery("select order_details.quantity,order_details.conversion as saleconversion,products.conversion,material_type.material as material_type,b.material as mat_sub_type,products.gsm,products.unit,products.location,products.sku,products.brand,(products.width) as width,order_details.width_inch,products.height, order_details.height_inch, 0 as weight,order_details.id from order_details,products,material_type,material_type b where products.id=order_details.product_id  and order_details.mark_status=0 and products.material_type=material_type.id and products.`mat_sub_type`=b.id order by order_details.order_id desc");

        $reusableProducts = $this->Global_model->executeCustomQuery("select order_details.quantity,order_details.conversion as saleconversion,products.conversion,material_type.material as material_type,b.material as mat_sub_type,products.gsm,products.unit,products.location,products.sku,products.brand,(products.width) as width,order_details.width_inch,products.height,order_details.height_inch, 0 as weight,order_details.id from order_details,products,material_type,material_type b where products.id=order_details.product_id  and order_details.mark_status=1 and products.material_type=material_type.id and products.`mat_sub_type`=b.id order by order_details.order_id desc");
        $wasteProducts = $this->Global_model->executeCustomQuery("select order_details.quantity,order_details.conversion as saleconversion,products.conversion,material_type.material as material_type,b.material as mat_sub_type,products.gsm,products.unit,products.location,products.sku,products.brand,(products.width) as width,order_details.width_inch,products.height,order_details.height_inch, 0 as weight,order_details.id from order_details,products,material_type,material_type b where products.id=order_details.product_id  and order_details.mark_status=2 and products.material_type=material_type.id and products.`mat_sub_type`=b.id order by order_details.order_id desc");

        //Remaining Stock
        $data['categories'] = $orders;

        $data['reusableProducts'] = $reusableProducts;
        $data['wasteProducts'] = $wasteProducts;

        $data['mainModule'] = 'reusable';
        $data['subModule'] = 'viewReusable';

        $this->load->view('admin/reusable/list', $data);
    }

    public function mark_as($id, $action)
    {
        //mark this record as $action
        $this->load->model('Global_model');
        $sql = "update order_details set mark_status=$action where id=$id";

        $formArray['mark_status'] = $action;
        $this->Global_model->update('order_details', $id, $formArray);
        redirect(base_url() . 'reusable');
    }
}
