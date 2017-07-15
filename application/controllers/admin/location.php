<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/location_model');
        $this->load->model('admin/admin_model');
        //Load database utility class
        $this->load->dbutil();
        $this->load->database();
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('pagination');
    }

    public function add_location_page() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $data['title'] = "Add Location";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/location_add', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function add_location() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $this->form_validation->set_rules('location[]', 'Location', 'required|trim');
            if ($this->form_validation->run() === FALSE) {
                $this->add_location_page();
            } else {
                $location = $this->input->post('location');
                //print_r($location);exit;
                foreach ($location as $loc) {
                    $this->db->set('location_name', $loc);
                    $this->db->insert('location');
                }
                $this->session->set_flashdata('success', 'Location added successfully');
                redirect('admin/location_detail');
            }
        }
    }

    public function location_detail() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $data['result'] = $this->location_model->getAllLocation();
            $data['title'] = "Add Locations";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/view_locations', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function view_location_sequence($location_id = '') {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $location_id = $this->uri->segment(3);

            $start = $this->uri->segment(4);
            if ($start <= 0)
                $start = 0;
            $config['total_rows'] = $this->admin_model->total('location_description', 'location_id', $location_id);

            $config['base_url'] = base_url() . 'admin/view_location/' . $location_id;
            $data['total_count'] = $config['total_rows'];
            $config['per_page'] = 5;
            $config["uri_segment"] = 4; //segment
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);

            //config for bootstrap pagination class integration
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            //$this->pagination->initialize($config);
            if (count($_GET) > 0)
                $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();



            $data['result'] = $this->location_model->getLocationById($location_id, $config['per_page'], $start);
            $data['location'] = $this->location_model->getLocationNameById($location_id);
            //print_r($data['result']);exit;
            $data['title'] = "Locations Description";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/location_detail_add_view', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function add_location_sequence() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $this->form_validation->set_rules('location_seq', 'Location Sequence', 'required|trim');
            $this->form_validation->set_rules('kube_name', 'Kube Name', 'required|trim');
            $this->form_validation->set_rules('exercise_name', 'Excercise Name', 'required|trim');
            $this->form_validation->set_rules('wgt_inc', 'Weight Increment', 'required|trim');
            if ($this->form_validation->run() === FALSE) {
                $this->view_location_sequence($this->input->post('location_id'));
            } else {
                $loc['location_id'] = $this->input->post('location_id');
                $loc['location_seq'] = $this->input->post('location_seq');
                $loc['kube_name'] = $this->input->post('kube_name');
                $loc['exercise_name'] = $this->input->post('exercise_name');
                $loc['wgt_inc'] = $this->input->post('wgt_inc');
                $loc['sort_order'] = $this->input->post('sort_order');

                $insert = $this->location_model->insertLocationDescription($loc);

                $this->session->set_flashdata('success', 'Location Sequence added successfully');
                redirect('admin/view_location/' . $this->input->post('location_id'));
            }
        }
    }

    public function edit_location($location_id = '') {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $location_id = $this->uri->segment(3);
            $data['result'] = $this->location_model->getLocationNameById($location_id); //print_r($data['result']);exit;
            $data['title'] = "Edit Location";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/location_edit', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function update_location() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $this->form_validation->set_rules('location_name', 'Location Name', 'required|trim|min_length[1]|max_length[3]');
            if ($this->form_validation->run() === FALSE) {
                $this->edit_location($this->uri->segment(3));
            } else {

                $loc['location_id'] = $this->uri->segment(3);
                $loc['location_name'] = $this->input->post('location_name');
                $update = $this->location_model->updateLocation($loc);

                $this->session->set_flashdata('success', 'Location updated successfully');
                redirect('admin/location_detail');
            }
        }
    }

    public function delete_location() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $location_id = $this->uri->segment(3);
            $delete = $this->location_model->deleteLocation($location_id);

            $this->session->set_flashdata('success', 'Location deleted successfully');
            redirect('admin/location_detail');
        }
    }

    public function edit_sequence($sequence_id='') {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $sequence_id = $this->uri->segment(3);

            $data['weight'] = $this->location_model->getSequenceById($sequence_id);
            $data['result'] = $this->location_model->getLocationNameById($data['weight']->location_id);
            $data['title'] = "Edit Sequence";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/sequence_edit', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function update_sequence() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {

            $this->form_validation->set_rules('exercise_name', ' Exercise name', 'required|trim');
            $this->form_validation->set_rules('location_seq', ' Location seq', 'required|trim');
            $this->form_validation->set_rules('wgt_inc[]', ' Weight Increment', 'required|trim');

            if ($this->form_validation->run() === FALSE) { 
               $this->edit_sequence($this->uri->segment(3));
               
            } else {
                $location_id = $this->input->post('location_id');;
                $description_id = $this->uri->segment(3);
                $data['location_seq'] = $this->input->post('location_seq');
                $data['kube_name'] = $this->input->post('kube_name');
                $data['exercise_name'] = $this->input->post('exercise_name');
                $data['sort_order'] = $this->input->post('sort_order');
                $data['wgt_inc'] = implode(',', $this->input->post('wgt_inc')); //print_r($data);die();

                $this->location_model->updateSequence($data,$description_id);
                $this->session->set_flashdata('success', 'Sequence Updated Successfully');
                redirect('admin/view_location/'.$location_id);
                
               
            }
        }
    }
    
    public function delete_sequence(){
        
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $location_id = $this->uri->segment(3);
            $description_id = $this->uri->segment(4);
            $delete = $this->location_model->deleteSequence($description_id);

            $this->session->set_flashdata('success', 'Sequence deleted successfully');
            redirect('admin/view_location/'.$location_id);
        }
    }

}

/*end class*/
