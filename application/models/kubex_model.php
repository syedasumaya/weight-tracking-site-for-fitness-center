<?php

class kubex_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function checkLocationExistOrNot($location_name) {

        $query = $this->db->get_where("location", array('location_name' => $location_name));
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllLocation() {
        $this->db->select('*');
        $this->db->from('location');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_location_id($location){
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('location_name',$location);
        $query = $this->db->get();        //print_r($query->row());exit;
        $info = $query->row();
        $id = $info->location_id;
        return $id;
        
    }
    
     public function getWeightByDate($data){
         
        $query=$this->db->query("SELECT userweight FROM weight WHERE location = " ."'".$data['location']."'". " AND sequence = " .$data['sequence']. " AND userid = ".$data['userid']." AND kube_name = '".$data['kube_name']."' ORDER BY id DESC LIMIT 1");
        $row = $query->row();
               return $row;
    }

}

?>