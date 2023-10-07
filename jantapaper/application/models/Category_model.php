<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Category_model extends CI_Model

{

    public function create($formArray)

    {

        $this->db->insert('products', $formArray);
    }



    public function getCategories()

    {

        $result = $this->db->get('products')->result_array();

        return $result;
    }



    public function getCategory($id)

    {

        $this->db->where('id', $id);

        $category = $this->db->get('products')->row_array();

        return $category;
    }

    public function update($id, $formArray)

    {

        //$this->load->model('Category_model');

        $this->db->where('id', $id);

        $this->db->update('products', $formArray);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('products');
    }
}
