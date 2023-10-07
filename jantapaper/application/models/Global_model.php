<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Global_model extends CI_Model

{

    public function create($table, $formArray)
    {
        $this->db->insert($table, $formArray);
    }



    public function getData($table, $where = "")
    {

        if ($where != "") {
            $this->db->where($where);
        }
        $result = $this->db->get($table)->result_array();

        return $result;
    }

    public function deleteCustomQuery($sql)
    {
        $this->db->query($sql);
    }
    public function executeCustomQuery($sql)
    {
        $result = $this->db->query($sql);

        return $result->result_array();
    }



    public function getDataById($table, $id)
    {
        $this->db->where('id', $id);

        $category = $this->db->get($table)->row_array();

        return $category;
    }

    public function update($table, $id, $formArray)

    {

        //$this->load->model('Category_model');

        $this->db->where('id', $id);

        $this->db->update($table, $formArray);
    }

    public function delete($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
}
