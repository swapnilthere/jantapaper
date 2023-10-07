<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Admin_model extends CI_Model

{

    public function getByUsername($username)

    {

        $this->db->where('username', $username);

        $admin = $this->db->get('user')->row_array();

        return $admin;
    }

    public function getByStaffname($password,$username)
    {
        $this->db->query("SELECT * from staff WHERE password='$password' AND username='$username'");
        
        if($query->num_rows()==1)
        {
            return $query->row();
        } else
        {
            return false;
        }
    }
}
