<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weight extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/weight_model');
        //Load database utility class
        $this->load->dbutil();
        $this->load->database();
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('pagination');
    }

    public function wgt_increment() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        }

        $data['title'] = "Weight Increment";

        $location = $this->uri->segment(2);
        if ($location == 'sgu_weight') {
            $data['sgu'] = $this->weight_model->get_allSGU();
        } else {
            $data['ogd'] = $this->weight_model->get_allOGD();
        }
        //print_r($data); die();
        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/weight_increment', $data);
        $this->load->view('admin/common/footer');
    }

    public function edit() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        }
        $data['title'] = "Edit Weight Increment";

        $location = $this->uri->segment(2);
        $id = $this->uri->segment(3);
        if ($location == 'edit_sgu') {
            $data['weight'] = $this->weight_model->get_allSGU_by_id($id);
        } else {
            $data['weight'] = $this->weight_model->get_allOGD_by_id($id);
        }
        //print_r($data['weight']->location_seq);die();
        if(($location == 'edit_sgu')&&((($data['weight']->location_seq == 1)&& ($data['weight']->kube_name == 10 ||$data['weight']->kube_name == 21 || $data['weight']->kube_name == 26 || $data['weight']->kube_name == 28) || ($data['weight']->location_seq == 2)&& ($data['weight']->kube_name == 8 ||$data['weight']->kube_name == 11 || $data['weight']->kube_name == 27) || ($data['weight']->location_seq == 3)&& ($data['weight']->kube_name == 10 || $data['weight']->kube_name == 26 || $data['weight']->kube_name == 27)))){
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/edit_another_weight_increment', $data);
            $this->load->view('admin/common/footer');
        }else{
        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/edit_weight_increment', $data);
        $this->load->view('admin/common/footer');
        }
    }

    public function update() {

        $id = $this->uri->segment(3);
        $location_id = $this->input->post('location_id');
        //$kube_name = $this->input->post('kube_name');

        $this->form_validation->set_rules('exercise_name', ' exercise_name', 'required|trim');
        $this->form_validation->set_rules('location_seq', ' location_seq', 'required|trim');
        $this->form_validation->set_rules('low_wgt_range', ' low_wgt_range', 'required|trim');
        $this->form_validation->set_rules('high_wgt_range', ' high_wgt_range', 'required|trim');
        $this->form_validation->set_rules('wgt_inc[]', ' wgt_inc', 'required|trim');

        if ($this->form_validation->run() === FALSE) { //echo 123; exit;
            if ($location_id == 1) {
                //redirect('admin/edit_sgu/'.$id);
                $data['weight'] = $this->weight_model->get_allSGU_by_id($id);
            } else {
                //redirect('admin/edit_ogd/'.$id);
                $data['weight'] = $this->weight_model->get_allOGD_by_id($id);
            }
            $data['title'] = "Edit Weight Increment";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/edit_weight_increment', $data);
            $this->load->view('admin/common/footer');
        } else {
            $data['exercise_name'] = $this->input->post('exercise_name');
            $data['location_seq'] = $this->input->post('location_seq');
            $data['low_wgt_range'] = $this->input->post('low_wgt_range');
            $data['high_wgt_range'] = $this->input->post('high_wgt_range');
            $data['wgt_inc'] = implode(',',$this->input->post('wgt_inc')); //print_r($data['wgt_inc']);die();

            $data['end_range_1'] = '';
            $data['start_range_2'] = '';
            $data['wgt_inc_2'] = '';

            $this->weight_model->updateWeight($data,$id);
            $this->session->set_flashdata('success', 'Weight Updated Successfully');
            if ($location_id == 1) {
                redirect('admin/sgu_weight');
            } else {
                redirect('admin/ogd_weight');
            }
        }
    }
    
    public function another_update(){
        
        $id = $this->uri->segment(3);
        $location_id = $this->input->post('location_id');
        $kube_name = $this->input->post('kube_name');

        $this->form_validation->set_rules('exercise_name', ' exercise_name', 'required|trim');
        $this->form_validation->set_rules('location_seq', ' location_seq', 'required|trim');
        $this->form_validation->set_rules('low_wgt_range', ' low_wgt_range', 'required|trim');
        $this->form_validation->set_rules('high_wgt_range', ' high_wgt_range', 'required|trim');
        $this->form_validation->set_rules('wgt_inc', ' wgt_inc', 'required|trim');
        $this->form_validation->set_rules('end_range_1', ' end_range_1', 'required|trim');
        $this->form_validation->set_rules('start_range_2', ' start_range_2', 'required|trim');
        $this->form_validation->set_rules('wgt_inc_2', ' wgt_inc_2', 'required|trim');

        if ($this->form_validation->run() === FALSE) { //echo 123; exit;
         
                //redirect('admin/edit_sgu/'.$id);
                $data['weight'] = $this->weight_model->get_allSGU_by_id($id);
            
            $data['title'] = "Edit Weight Increment";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/edit_another_weight_increment', $data);
            $this->load->view('admin/common/footer');
        } else {
            $data['exercise_name'] = $this->input->post('exercise_name');
            $data['location_seq'] = $this->input->post('location_seq');
            $data['low_wgt_range'] = $this->input->post('low_wgt_range');
            $data['high_wgt_range'] = $this->input->post('high_wgt_range');
            $data['wgt_inc'] = $this->input->post('wgt_inc'); //print_r($data['wgt_inc']);die();
            $data['end_range_1'] = $this->input->post('end_range_1');
            $data['start_range_2'] = $this->input->post('start_range_2');
            $data['wgt_inc_2'] = $this->input->post('wgt_inc_2');

            $this->weight_model->updateWeight($data,$id);
            $this->session->set_flashdata('success', 'Weight Updated Successfully');
            if ($location_id == 1) {
                redirect('admin/sgu_weight');
            } else {
                redirect('admin/ogd_weight');
            }
        }
    }

}