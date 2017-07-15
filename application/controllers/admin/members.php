<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/admin_model');
         $this->load->model('admin/location_model');
        //Load database utility class
        $this->load->dbutil();
        $this->load->database();
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->library('session');
        $this->load->library('pagination');
    }
    
     public function dashboard(){
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $data['title'] = "Dashboard";
        $data['profile'] = $this->admin_model->getAdminInfo($this->session->userdata('userid'));
        $data['admin'] = $this->admin_model->getAdminDetails(); 
        $data['member'] = $this->db->count_all_results('users');
        $data['location'] = $this->db->count_all_results('location');
        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/common/footer');
        }
    }

    public function index() {

      
        $data = array();
        //$config = array();
        $config["base_url"] = base_url() . 'admin/members';
        $config["total_rows"] = $this->db->count_all_results('users');
        $config["per_page"] = 100;
        $config["uri_segment"] = 3;
        $start = $this->uri->segment(3);

        if ($start <= 0)
            $start = 0;

        $data['total_count'] = $config['total_rows'];

        //echo $config["uri_segment"]; exit();
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        //$config["num_links"] = 2;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'FIRST';
        $config['last_link'] = 'LAST';
        //$config['display_pages'] = FALSE;
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

     
     
        $data['result'] = $this->admin_model->getMembers($config['per_page'], $start);
        //print_r($data['result']); die();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
       


        $data['title'] = "Members";

        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/members', $data);
        $this->load->view('admin/common/footer');
    }

    public function sortby(){
      
     if($this->uri->segment(4) == ''){
        $sort_value = $this->input->get('sort_by');
     }else{
         $sort_value = $this->uri->segment(4);
    }
       $exp = explode('_',$sort_value,2);  
       
       $data = array();
        //$config = array();
        $config["base_url"] = base_url() . 'admin/members/sortby/'.$sort_value;
        $config["total_rows"] = $this->db->count_all_results('users');
        $config["per_page"] = 100;
        $config["uri_segment"] = 5;

        

       if ($this->uri->segment(5)) {
            $page = ($this->uri->segment(5));
        } else {
            $page = 1;
        }
        $start = $page;

        $data['total_count'] = $config['total_rows'];

        //echo $config["uri_segment"]; exit();
        $choice = $config["total_rows"] / $config["per_page"];
       
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'FIRST';
        $config['last_link'] = 'LAST';
        //$config['display_pages'] = FALSE;
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

      
      

        $data['result'] = $this->admin_model->getMembers_sortBy($config['per_page'], $start, $exp);
        //print_r($data['result']); die();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();


        $data['title'] = "Members";

        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/members', $data);
        $this->load->view('admin/common/footer');
    }

    public function edit($id = 0) {
        if ($id <= 0)
            $id = $this->uri->segment(3);

        $data['result'] = $this->admin_model->getMemberInfo($id);
        $data['title'] = "User Update";
        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/member_edit', $data);
        $this->load->view('admin/common/footer');
    }

    public function update() {
        $id = $this->uri->segment(4);

        $this->form_validation->set_rules('memberid', ' memberid', 'required|trim||min_length[6]|max_length[6]');
        $this->form_validation->set_rules('firstname', 'firstname', 'required|trim');
        $this->form_validation->set_rules('lastname', 'lastname', 'required|trim');
 


        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $data['firstname'] = strip_tags($this->input->post('firstname'));
            $data['lastname'] = strip_tags($this->input->post('lastname'));
            $data['memberid'] = strip_tags($this->input->post('memberid'));
            $this->admin_model->update_member($id, $data);
            $this->session->set_flashdata('success', 'Member Successfully Updated');
            redirect('admin/members');
        }
    }

    public function addmember() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');  
            $this->form_validation->set_rules('memberid', ' Member Id', 'required|trim||min_length[6]|max_length[6]|is_unique[users.memberid]');
            

            $data['title'] = "Add member";

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/common/header', $data);
                $this->load->view('admin/common/left_sidebar');
                $this->load->view('admin/member_add');
                $this->load->view('admin/common/footer');
            } else {
                unset($data);
                $data['firstname'] = strip_tags($this->input->post('firstname'));
                $data['lastname'] = strip_tags($this->input->post('lastname'));
                $data['memberid'] = strip_tags($this->input->post('memberid')); 
                $this->admin_model->insert($data); 
                $this->session->set_flashdata('success', 'Member Successfully Added');
                redirect('admin/members');
            }
        }
    }

    public function delete() {
        $id = $this->uri->segment(4);
        $this->admin_model->deleteMember($id);
        $this->session->set_flashdata('success', 'Successfully users deleted');
        redirect('admin/members');
    }

    public function export() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $data['title'] = "Export Members";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/export', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function export_members() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $query = $this->db->get('users');
            // Create CSV output
            $data = $this->dbutil->csv_from_result($query);
            if (!write_file('./user_info/user.csv', $data)) {
                $this->session->set_flashdata('err', 'Unable to write the file!!!');
                redirect('admin/members/export');
            } else {
                $this->session->set_flashdata('success', 'User Information exported successfully!!!');
                redirect('admin/members/export');
            }
        }
    }

    public function download_export_data() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            if (file_get_contents("./user_info/user.csv")) {
                $data = file_get_contents("./user_info/user.csv");
                $name = 'user.csv';
                force_download($name, $data);
                $this->session->set_flashdata('success', 'User Information downloaded successfully!!!');
                redirect('admin/members/export');
            }
        }
    }

    public function import() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $data['title'] = "Import Members";
            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/import', $data);
            $this->load->view('admin/common/footer');
        }
    }

    public function import_members() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $error_items = array();
            $total_error = 0;
            $fp = fopen($_FILES['user']['tmp_name'], 'r') or die("can't open file");

            $i = 0;
            
            while ($csv_line = fgetcsv($fp, 1024)) {

                $data = array(
                    'firstname' => $csv_line[1],
                    'lastname' => $csv_line[2],
                    'memberid' => $csv_line[3]
                );

                $check_duplicate = $this->admin_model->check_duplicate($data);
                if ($check_duplicate == true) {
                    $this->db->insert('users', $data);                
                } else {
                    $total_error++;
                }

                $i++;
            }
            fclose($fp) or die("can't close file");
            if ($total_error >= 1) {
                $error_items[0] = 'Duplicate Items : ' . $total_error;
                $this->session->set_flashdata("err", $error_items);
            }

            redirect('admin/members/import');
        }
    }
    
   

    public function view_userdetail() {
        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
            $userid = $this->uri->segment(4);

            $start = $this->uri->segment(5);
            if ($start <= 0)
                $start = 0;
            $config['total_rows'] = $this->admin_model->total('weight', 'userid', $userid);

            $config['base_url'] = base_url() . 'admin/membersview/detail/' . $userid;
            $data['total_count'] = $config['total_rows'];
            $config['per_page'] = 100;
            $config["uri_segment"] = 5; //segment
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

            $data['result'] = $this->admin_model->getUserDetails($config['per_page'], $start, $userid);
            
            $data['location'] = $this->location_model->getAllLocation();
            $data['kube'] = $this->location_model->getHighestKube();
            $data['seq'] = $this->location_model->getHighestSeq();
            
            // $data = array();
            //$data['result'] = $this->admin_model->getUserDetails($userid);
            $data['title'] = "Members";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/user_detail', $data);
            $this->load->view('admin/common/footer');
        }
    }
    
     public function filter() {

        if ($this->session->userdata('userid') == '') {
            redirect('admin/logout');
        } else {
           
            $res = array();
            $res['userid'] = $this->uri->segment(4);
            $res['location'] = $this->input->get('location');
            $res['kubeid'] = $this->input->get('kubeid');
            $res['sequence'] = $this->input->get('sequence');
            //print_r($res);exit;
            $data = array();
            
             $start = $this->uri->segment(5);
            if ($start <= 0)
                $start = 0;
            
            $config['base_url'] = base_url() .'admin/membersfil/filter/'.$res['userid'];
            $config['suffix'] = '?'.http_build_query($_GET, '', "&"); 
            
            $config['per_page'] = 50;
            $config['total_rows'] = $this->admin_model->total_filterRows($res);
          
            $data['total_count'] = $config['total_rows'];
            $config["uri_segment"] = 5; //segment
            $choice = $config["total_rows"] / $config["per_page"];
            $config["num_links"] = floor($choice);
           
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

          
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
          
            $data['result'] = $this->admin_model->search_weight($config['per_page'], $start, $res);
            
            $data['location'] = $this->location_model->getAllLocation();
            $data['kube'] = $this->location_model->getHighestKube();
            $data['seq'] = $this->location_model->getHighestSeq();
            
            $data['title'] = "Members";

            $this->load->view('admin/common/header', $data);
            $this->load->view('admin/common/left_sidebar');
            $this->load->view('admin/user_detail', $data);
            $this->load->view('admin/common/footer');
        }
    }


    public function search() {

        $data = array();

        $search = $this->input->post('search');


        $config["base_url"] = base_url() . 'admin/members/search';
        $config["total_rows"] = $this->admin_model->count_all_UserSearchResult($search);
        $config["per_page"] = 100;
        $config["uri_segment"] = 3;
        $start = $this->uri->segment(3);

        if ($start <= 0)
            $start = 0;

        $data['total_count'] = $config['total_rows'];

        //echo $config["uri_segment"]; exit();
        $choice = $config["total_rows"] / $config["per_page"];
        //$config["num_links"] = floor($choice);
        $config["num_links"] = 2;

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'FIRST';
        $config['last_link'] = 'LAST';
        //$config['display_pages'] = FALSE;
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

        $data['result'] = $this->admin_model->getUserSearchResult($search, $config['per_page'], $start);
        //print_r($data['result']); die();
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        //print_r($data);exit;

        $data['title'] = "Members";

        $this->load->view('admin/common/header', $data);
        $this->load->view('admin/common/left_sidebar');
        $this->load->view('admin/members', $data);
        $this->load->view('admin/common/footer');
    }
    
    
    
}
