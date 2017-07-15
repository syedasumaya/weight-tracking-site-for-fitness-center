<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

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

    public function display() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $data = array();
            $data['result'] = $this->admin_model->getsettingsInfo();
            $data['title'] = "Settings";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/settings_display', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function update() {
        //echo 123; exit();
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else { 
            $this->form_validation->set_rules('total_kube', 'Total Kube', 'required|trim');
            $this->form_validation->set_rules('total_kube', ' Total Sequence', 'required|trim');

            if ($this->form_validation->run() === FALSE) {
                $this->edit_settings($this->uri->segment(3));
            } else {
                $newval['total_kube'] = $this->input->post('total_kube', true);
                $newval['total_seq'] = $this->input->post('total_seq', true);
                $location = $this->input->post('location', true);
                //print_r($newval); exit();
                $this->admin_model->update_settings($newval, $location);
                $this->session->set_flashdata('success', 'Settings updated successfully');
                redirect('admin/settings');
            }
        }
    }

    public function edit_settings($location='') {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $location = $this->uri->segment(3);
            $data['result'] = $this->admin_model->getsettingsInfoById($location); //print_r($data['result']);exit;
            $data['title'] = "Update Settings";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/edit_settings', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function add_settings_page() {
        //if ($this->session->userdata('userid') == '') {
            //redirect('admin/logout');
       // } else {
        $data['title'] = "Add More Location Info";
        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/add_settings', $data);
        $this->load->view('admin/common/footer');
       // }
    }

    public function new_settings_add() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
        $newval['location'] = $this->input->post('location', true);
        $newval['total_kube'] = $this->input->post('total_kube', true);
        $newval['total_seq'] = $this->input->post('total_seq', true);
        
        $check = $this->admin_model->checkLocationExistOrNot($newval['location']); 
        if($check){
        $this->admin_model->insert_settings($newval);
        $this->session->set_flashdata('success', 'New Settings added successfully');
        redirect('admin/settings');
        }else{
            $this->session->set_flashdata('loginerr', 'Settings for "'.$newval['location'].'" already exist!!!');
            redirect('admin/add_settings');
        }
      }
    }
    
    public function delete_settings(){
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $location = $this->uri->segment(3);
            $delete = $this->admin_model->deleteSettings($location);

            $this->session->set_flashdata('success', 'Setting deleted successfully');
            redirect('admin/settings');
        }
    }

}
