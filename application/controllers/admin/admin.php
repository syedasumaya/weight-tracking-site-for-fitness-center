<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
        //Load database utility class
        $this->load->dbutil();
        $this->load->database();
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('pagination');
    }

    public function profile() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $id = $this->uri->segment(3);

            $data['result'] = $this->admin_model->getAdminInfo($id);

            $data['title'] = "Edit Profile";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/admin_profile', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function change_pass($id = 0) {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $id = $this->uri->segment(3);

            $data['result'] = $this->admin_model->getAdminInfo($id);

            $data['title'] = "Change Password";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/change_pass', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function update_pass() {

        $id = $this->uri->segment(3);

        $this->form_validation->set_rules('current_pass', 'Current password', 'required|trim');
        $this->form_validation->set_rules('new_pass', 'New password', 'required|trim');
        $this->form_validation->set_rules('retype_new_pass', 'Retype new password', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->change_pass($id);
        } else {
            $data['current_pass'] = md5($this->input->post('current_pass'));
            $data['new_pass'] = md5($this->input->post('new_pass'));
            $data['retype_new_pass'] = md5($this->input->post('retype_new_pass'));

            $data['result'] = $this->admin_model->getAdminInfo($id);
            //print_r($data['result']->password);exit;
            if ($data['current_pass'] == $data['result']->password) {
                if ($data['new_pass'] == $data['retype_new_pass']) {
                    $this->admin_model->update_admin_password($id, $data);
                } else {
                    $this->session->set_flashdata('validation_err', 'Wrong Retype New Password!!! Please type correctly.');
                    redirect('admin/change_pass/' . $id);
                }
            } else {
                $this->session->set_flashdata('validation_err', 'Wrong Current Password!!! Please type correctly.');
                redirect('admin/change_pass/' . $id);
            }
            $this->session->set_flashdata('success', 'Password updated successfully');
            redirect('admin/change_pass/' . $id);
        }
    }

    public function adminAddPage() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        }
        $this->load->view('admin/common/header');
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/admin_add');
        $this->load->view('admin/common/footer');
    }

    public function addadmin() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $this->form_validation->set_rules('username', 'User Name', 'required|trim');
            $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('phone', 'phone', 'required|trim');
            $this->form_validation->set_rules('date_added', 'Date_added');
            $this->form_validation->set_rules('type', 'Type', 'required|trim');


            $data['title'] = "Add Admin";

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/common/header', $data);
                $this->load->view('admin/common/left_sidebar');
                $this->load->view('admin/admin_add');
                $this->load->view('admin/common/footer');
            } else {
                unset($data);
                $date = date("Y-m-d");
                $data['username'] = strip_tags($this->input->post('username'));
                $data['firstname'] = strip_tags($this->input->post('firstname'));
                $data['lastname'] = strip_tags($this->input->post('lastname'));
                $data['email'] = strip_tags($this->input->post('email'));
                $data['password'] = md5($this->input->post('password'));
                $data['phone'] = strip_tags($this->input->post('phone'));
                $data['date_added'] = $date;
                $data['type'] = strip_tags($this->input->post('type'));
                $this->admin_model->insertAdmin($data);
                $admin_id = $this->db->insert_id();

                $data1['add_edit_admin'] = $this->input->post('add_edit_admin');
                $data1['view_admin'] = $this->input->post('view_admin');
                $data1['add_edit_member'] = $this->input->post('add_edit_member');
                $data1['view_member'] = $this->input->post('view_member');
                $data1['add_edit_location'] = $this->input->post('add_edit_location');
                $data1['view_location'] = $this->input->post('view_location');
                $data1['add_edit_settings'] = $this->input->post('add_edit_settings');
                $data1['view_settings'] = $this->input->post('view_settings');
                $data1['export_import_members'] = $this->input->post('export_import_members');
                $this->admin_model->insert_admin_settings($data1, $admin_id);
                // print_r($data1);exit;

                $this->session->set_flashdata('success', 'Admin added successfully');
                redirect('admin/admin/detail');
            }
        }
    }

    public function view_admindetail() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $userid = $this->uri->segment(4);

            $data['result'] = $this->admin_model->getAdminDetails(); 
            //$data['settings'] = $this->admin_model->getAdminsettingsInfo(); //print_r($data['settings']);exit;
            // $data = array();
            //$data['result'] = $this->admin_model->getUserDetails($userid);
            $data['title'] = "Members";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/admins_view', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function edit($id = 0) {
        if ($id <= 0)
            $id = $this->uri->segment(3);

        $data['result'] = $this->admin_model->getAdminInfo($id);
        $data['settings'] = $this->admin_model->getAdminsettingsInfoById($id); //print_r($data['settings']);exit;
        $data['title'] = "Admin Update";
        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/admin_edit', $data);
        $this->load->view('admin/common/footer');
    }

    public function update() {
        $id = $this->uri->segment(4);

        $this->form_validation->set_rules('username', ' username', 'required|trim');
        $this->form_validation->set_rules('firstname', 'firstname', 'required|trim');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
        $this->form_validation->set_rules('phone', 'phone', 'required|trim');
        //$this->form_validation->set_rules('type', 'type', 'required|trim');


        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $data['username'] = strip_tags($this->input->post('username'));
            $data['firstname'] = strip_tags($this->input->post('firstname'));
            $data['lastname'] = strip_tags($this->input->post('lastname'));
            $data['email'] = strip_tags($this->input->post('email'));
            $data['phone'] = strip_tags($this->input->post('phone'));
            $data['type'] = strip_tags($this->input->post('type'));
            //print_r($data);exit;
            $this->admin_model->update_admin($id, $data);

            $data1['add_edit_admin'] = $this->input->post('add_edit_admin');
            $data1['view_admin'] = $this->input->post('view_admin');
            $data1['add_edit_member'] = $this->input->post('add_edit_member');
            $data1['view_member'] = $this->input->post('view_member');
            $data1['add_edit_location'] = $this->input->post('add_edit_location');
            $data1['view_location'] = $this->input->post('view_location');
            $data1['add_edit_settings'] = $this->input->post('add_edit_settings');
            $data1['view_settings'] = $this->input->post('view_settings');
            $data1['export_import_members'] = $this->input->post('export_import_members');
            
            if($this->input->post('hidden_val') == 0){
               $this->admin_model->insert_admin_settings($data1, $id);
            }else{
               $this->admin_model->update_admin_settings($data1, $id);
            }
           
            $this->session->set_flashdata('success', 'Admin Successfully Updated');

            redirect('admin/admin/detail');
        }
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->admin_model->deleteAdmin($id);
        $this->session->set_flashdata('success', 'Successfully Admin deleted');
        //$this->load->view('admin/admins_view');
        redirect('admin/admin/detail');
    }

}
