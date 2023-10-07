<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller

{

    /*
    public function index()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'user';
        $data['subModule'] = 'viewUser';
        $categories = $this->Global_model->getData('user', array('user_type' => 3));

        $data['users'] = $categories;

        $this->load->view('admin/users/list', $data);
    }
*/

    public function authenticate()

    {

        $this->load->library('form_validation');

        $this->load->model('Global_model');



        $this->form_validation->set_rules('username', 'Username', 'trim|required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');



        if ($this->form_validation->run() == true) {

            $username = $this->input->post('username');

            $user = $this->Global_model->executeCustomQuery("select * from client where username='$username' limit 1");
            //echo "select * from client where username='$username' limit 1";
            //die();
            if (!empty($user)) {

                $password = $this->input->post('password');




                if (password_verify($password, $user[0]['password']) == true) {

                    $adminArray['admin_id'] = $user[0]['id'];

                    $adminArray['username'] = $user[0]['username'];
                    $adminArray['userType'] = "user";

                    $this->session->set_userdata('admin', $adminArray);

                    redirect(base_url() . 'home');
                } else {

                    $this->session->set_flashdata('msg', 'Either username or password is incorrect');

                    redirect(base_url() . 'userLogin');
                }
            } else {

                $this->session->set_flashdata('msg', 'Either username or password is incorrect');

                redirect(base_url() . 'userLogin');
            }
        } else {

            $this->load->view('users/login');
        }
    }


    public function login()
    {
        $admin = $this->session->userdata('admin');

        if (!empty($admin)) {
            redirect(base_url() . 'users/dashboard');
        }
        $this->load->library('form_validation');

        $this->load->view('users/login');
    }


    /* public function create()

    {

        $this->load->model('Global_model');

        $data['mainModule'] = 'user';
        $data['subModule'] = 'viewUser';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('staff_name', 'Username', 'trim|required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {
            $formArray['username'] = $this->input->post('staff_name');

            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $formArray['user_type'] = 3;

            $this->Global_model->create('user', $formArray);

            $this->session->set_flashdata('success', 'User added successfully');

            redirect(base_url() . 'admin/users/index');
        } else {

            $this->load->view('admin/users/create');
        }
    }



    public function edit($id)

    {

        // echo $id;

        $this->load->model('Global_model');

        $staffData = $this->Global_model->getDataById('user', $id);

        $data['mainModule'] = 'user';
        $data['subModule'] = '';

        if (empty($staffData)) {

            $this->session->set_flashdata('error', 'Staff not found');

            redirect(base_url() . 'admin/users/index');
        }



        $this->load->library('form_validation');

        $this->form_validation->set_rules('staff_name', 'Name', 'trim|required');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="invalid_feedback">', '</p>');



        if ($this->form_validation->run() == TRUE) {

            $formArray['username'] = $this->input->post('staff_name');

            $formArray['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);


            $this->Global_model->update('user', $id, $formArray);

            $this->session->set_flashdata('success', 'Staff Updated successfully');

            redirect(base_url() . 'admin/users/index');
        } else {

            $data['staffData'] = $staffData;

            $this->load->view('admin/users/edit', $data);
        }
    }



    public function delete($id)
    {
        $this->load->model('Global_model');
        $category = $this->Global_model->getDataById('user', $id);

        if (empty($category)) {
            $this->session->set_flashdata('error', 'User not found');
            redirect(base_url() . 'admin/users/index');
        }

        $this->Global_model->delete('user', $id);
        $this->session->set_flashdata('success', 'User deleted successfully');
        redirect(base_url() . 'admin/users/index');
    }*/
}
