<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kubex extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('front_model');
        $this->load->model('kubex_model');
         $this->load->library('session');
    }

    /*sumaya sameweight */
    public function index() {

       // $this->session->unset_userdata('frontuserid');
        $data['locations'] = $this->kubex_model->getAllLocation();       
        $this->load->view('front/common/header_without_seq');
        $this->load->view('front/error',$data);
        $this->load->view('front/common/footer');
    }

    //new  step 1
    public function location() {

        if ($this->uri->segment(1) == '') {
            $this->index();
        } else {
            $location_name = $this->uri->segment(1);
            $location_exist = $this->kubex_model->checkLocationExistOrNot($location_name);
            if ($location_exist) {
                $this->select_sequence($location_name);
            } else {
                $this->index();
            }
        }
    }
    
     //AJAX CALLS  /*step 2*/
    public function set_initial_data() {
        if ($seq = $this->input->post('sequence')) {
            $data = array('success' => 1);
            $this->session->set_userdata('kubeseq', $seq);
            $location = $this->session->userdata('kubelocation');
            $location_id = $this->kubex_model->get_location_id($location);//print_r($location_id);exit;
            //get default kube from model
    
            $kube = $this->front_model->get_initial_kube($seq,$location_id); //print_r($kube);exit;
            if (count($kube)) {
                $this->session->set_userdata('locationid', $location_id);
                $this->session->set_userdata('kubeid', $kube[0]->kube_name);
                $this->session->set_userdata('sortorder', $kube[0]->sort_order);
                $this->session->set_userdata('exercise_name', $kube[0]->exercise_name);
            }
        }
        echo json_encode($data);
    }


    //new step 3
    public function select_sequence($location_name) {

        $total_sequence = $this->front_model->getLocation($location_name);

        foreach ($total_sequence as $k => $v) {
            $seq[$v->key] = $v->key;
            $seq[$v->key] = $v->value;
        }
        //print_r($seq);exit;
        $this->session->set_userdata('kubelocation', strtoupper($location_name));

        $this->load->view('front/common/header_without_seq');
        if ($seq['total_seq'] % 2 == 0) {
            $this->load->view('front/enter_even_sequence', $seq);
        } else {
            $this->load->view('front/enter_odd_sequence', $seq);
        }
        $this->load->view('front/common/footer');
    }
    
    // step 4
    public function enter_pin() {
        $this->load->view('front/common/header');
        $this->load->view('front/home');
        $this->load->view('front/common/footer');
    }
    
    // step 5
     public function areyou() {
        $frontuserid = $this->session->userdata('frontuserid'); 
        $kube_sequence = $this->session->userdata('kubeseq');
        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            $data['frontuserid'] = $frontuserid;
            $data['name'] = $this->session->userdata('name');
            $data['weight'] = $this->session->userdata('userweight');
            $this->load->view('front/common/header');
            $this->load->view('front/areyou', $data);
            $this->load->view('front/common/footer');
        } else {
            redirect('');
        }
    }
    
    /*sumaya sameweight step 6*/
    public function sameweight() { 
       $kube_name = $this->session->userdata('kubeid');
       $exercise_name = $this->session->userdata('exercise_name');
       $kube_sequence = $this->session->userdata('kubeseq'); 
//echo $this->session->userdata('name');
      $frontuserid = $this->session->userdata('frontuserid'); 
        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            $data['userid'] = $frontuserid;
            $data['name'] = $this->session->userdata('name');
            $data['location'] = $this->session->userdata('kubelocation');
            $data['sequence'] = $kube_sequence;
            $data['kube_name'] = $kube_name;
            $data['exercise_name'] = $exercise_name;

            $data['weight'] = $this->kubex_model->getWeightByDate($data);
           // print_r($data); die();

            $this->load->view('front/common/header', $data);
            $this->load->view('front/sameweight', $data);
            $this->load->view('front/common/footer');
        }
    }
    /*ADVANCE button click step : 7*/
     public function save_current_weight() {
        $frontuserid = $this->session->userdata('frontuserid');
        $kube_sequence = $this->session->userdata('kubeseq');
        $kube_name = $this->session->userdata('kubeid'); //exit;
        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            $data['userweight'] = $this->input->post('weight');
            $data['userid'] = $frontuserid;
            $data['location'] = $this->session->userdata('kubelocation');
            $data['sequence'] = $kube_sequence;
            $data['kube_name'] = $kube_name;
            $data['date'] = date("Y-m-d h:i:s");
            // print_r($data); die(); 
            $save_weight = $this->front_model->save_weight($data);

            $json_data = array();
            $json_data['success'] = 1;
            $json_data['kube_complete'] = '';

            $location_id = $this->session->userdata('locationid');
            if ($save_weight == true) {
                $nextkube = $this->front_model->get_sequence($kube_sequence, $this->session->userdata('sortorder'), $location_id);
                //print_r($nextkube);exit;
                if (count($nextkube) > 0) {
                    $json_data['newkube'] = 'newkube';
                    $this->session->set_userdata('kubeid', $nextkube[0]->kube_name);
                    $this->session->set_userdata('sortorder', $nextkube[0]->sort_order);
                    $this->session->set_userdata('exercise_name', $nextkube[0]->exercise_name);
                } else {
                    $json_data['kube_complete'] = 'kube_complete';
                    //sequence complete
                }
            }
            echo json_encode($json_data);
        }
    }
    
  /*BACK button click step : 7*/  
    public function prev_weight() {

        $frontuserid = $this->session->userdata('frontuserid');
        $kube_sequence = $this->session->userdata('kubeseq');
        $kube_name = $this->session->userdata('kubeid');
        $exercise_name = $this->session->userdata('exercise_name');

        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            $data['userweight'] = $this->input->post('weight');
            $data['userid'] = $frontuserid;
            $data['location'] = $this->session->userdata('kubelocation');
            $data['sequence'] = $kube_sequence;
            $data['kube_name'] = $kube_name;
            $data['date'] = date("Y-m-d h:i:s");
            // print_r($data); die(); 
            $save_weight = $this->front_model->save_weight($data);

            $json_data = array();
            $json_data['success'] = 1;
            $json_data['kube_complete'] = '';

            $location_id = $this->session->userdata('locationid');

            if ($save_weight == true) {
                $prevkube = $this->front_model->get_prev_sequence($kube_sequence, $this->session->userdata('sortorder'), $location_id);
                //print_r($nextkube);exit;
                if (count($prevkube) > 0) {
                    $json_data['newkube'] = 'newkube';

                    $this->session->set_userdata('kubeid', $prevkube[0]->kube_name);
                    $this->session->set_userdata('sortorder', $prevkube[0]->sort_order);
                    $this->session->set_userdata('exercise_name', $prevkube[0]->exercise_name);
                } else {
                    $json_data['kube_complete'] = 'kube_complete';
                    //sequence complete
                }
            }
            echo json_encode($json_data);
        }
    }


    public function get_location() {
        $json = array();
        $location = $this->uri->segment(2);

        $check_messages = $this->front_model->getLocation($location);


        foreach ($check_messages as $k => $v) {
            $json[$v->key] = $v->key;
            $json[$v->key] = $v->value;
        }

        echo json_encode($json);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('');
    }

   

    public function show_weight() {
        $kube_name = $this->session->userdata('kubeid');
        $exercise_name = $this->session->userdata('exercise_name');
        $kube_sequence = $this->session->userdata('kubeseq');

        $frontuserid = $this->session->userdata('frontuserid');
        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            $data['frontuserid'] = $frontuserid;
            $data['name'] = $this->session->userdata('name');
            $data['location'] = $this->session->userdata('kubelocation');
            $data['sequence'] = $kube_sequence;
            $data['kube_name'] = $kube_name;
            $data['exercise_name'] = $exercise_name;
            $data['weight'] = $this->front_model->getWeightByDate($data);

            $this->load->view('front/common/header', $data);
            $this->load->view('front/weight', $data);
            $this->load->view('front/common/footer');
        }
    }

    

    public function enter_weight() {

        $kube_name = $this->session->userdata('kubeid');
        $exercise_name = $this->session->userdata('exercise_name');
        $kube_sequence = $this->session->userdata('kubeseq');
        $frontuserid = $this->session->userdata('frontuserid');
        $kube_location = $this->session->userdata('kubelocation'); 
        $kube_locationid = $this->session->userdata('locationid');

        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            $data['userid'] = $frontuserid;
            $data['name'] = $this->session->userdata('name');
            $data['location'] = $kube_location; 
            $data['sequence'] = $kube_sequence;
            $data['kube_name'] = $kube_name; 
            $data['exercise_name'] = $exercise_name;
            $data['current_weight'] = $this->front_model->getWeightByDate($data);

            $data['weight_range_inc'] = $this->front_model->getWeightRangeIncRate($kube_name,$kube_sequence,$kube_locationid);
            //print_r($data['weight_range_inc']);die();
            $this->load->view('front/common/header', $data);
            $this->load->view('front/enter_weight', $data);
            $this->load->view('front/common/footer');
        } else {
            redirect('');
        }
    }
    public function complete() {
        $frontuserid = $this->session->userdata('frontuserid');
        $data['next'] = strtolower($this->session->userdata('kubelocation'));
        if ($frontuserid > 0 && is_numeric($frontuserid)) {
            //$this->session->set_userdata('kubeid', $kube_SGU);
            $this->load->view('front/common/header');
            $this->load->view('front/complete', $data);
            $this->load->view('front/common/footer');
        } else {
            redirect('logout');
        }
    }


    public function checkpin() {
        $pin = $this->input->post('pin');
        $data = array();
        $data['success'] = 0;
        if ($pin != '' && is_numeric($pin)) {
            $userinfo = $this->front_model->getUserByPin($pin); 
            if ($userinfo) { 
             

                $data['name'] = $userinfo->firstname . " " . $userinfo->lastname;
                $data['frontuserid'] = $userinfo->userid;
                $data['success'] = 1;  
  
                //Put data in Session
                $session = array(
                    'frontuserid' => $data['frontuserid'],
                    'name' => $data['name']
                );
                $this->session->set_userdata($session);
   
            }
        }
        echo json_encode($data);
    }

    public function error() {
        $this->load->view('front/common/header');
        $this->load->view('front/error');
        $this->load->view('front/common/footer');
    }

    
}
