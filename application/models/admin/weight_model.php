<?php

class weight_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }
    
    public function get_allSGU(){
        
        $query = $this->db->query("
                   SELECT * FROM location_description WHERE location_id = 1 ORDER BY sort_order
                "); 
        //echo $this->db->last_query(); exit;
        $result = $query->result();
        //print_r($result);
        return $result;
    }
    
    public function get_allOGD(){
        
        $query = $this->db->query("
                   SELECT * FROM location_description WHERE location_id = 2 ORDER BY sort_order
                "); 
        //echo $this->db->last_query(); exit;
        $result = $query->result();
        //print_r($result);
        return $result;
    }
    
    public function get_allSGU_by_id($id){
        
        $query = $this->db->query("
                   SELECT * FROM location_description WHERE description_id =".$id." 
                "); 
        //echo $this->db->last_query(); exit;
        $row = $query->row();
        //print_r($result);
        return $row;
    }
    
    public function get_allOGD_by_id($id){
        
        $query = $this->db->query("
                   SELECT * FROM location_description WHERE description_id =".$id." 
                "); 
        //echo $this->db->last_query(); exit;
        $row = $query->row();
        //print_r($result);
        return $row;
    }
    
    public function updateWeight($data,$id){
        $this->db->update('location_description', $data, array('description_id' => $id));
        //echo $this->db->last_query(); exit;
    }
}    
