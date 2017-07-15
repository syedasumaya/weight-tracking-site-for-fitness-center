<?php

class location_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getAllLocation() {
        $this->db->select('*');
        $query = $this->db->get('location');
        return $query->result();
    }

    public function getLocationNameById($location_id) {
        $this->db->select('*');
        $this->db->where('location_id', $location_id);
        $query = $this->db->get('location');
        //echo $this->db->last_query();exit;
        return $query->row();
    }

    public function getLocationById($location_id, $start, $limit) {
        $this->db->select('*');
        $this->db->where('location_id', $location_id);
        $this->db->order_by('description_id', 'desc');
        $this->db->limit($start, $limit);
        $query = $this->db->get('location_description');
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    public function insertLocationDescription($loc) {

        $this->db->set('location_id', $loc['location_id']);
        $this->db->set('location_seq', $loc['location_seq']);
        $this->db->set('kube_name', $loc['kube_name']);
        $this->db->set('exercise_name', $loc['exercise_name']);
        $this->db->set('wgt_inc', $loc['wgt_inc']);
        $this->db->set('sort_order', $loc['sort_order']);
        $this->db->insert('location_description');
        return true;
    }

    public function updateLocation($loc) {

        $this->db->where('location_id', $loc['location_id']);
        $this->db->set('location_name', $loc['location_name']);
        $this->db->update('location');
        // echo $this->db->last_query();exit;
        return true;
    }

    public function deleteLocation($location_id) {

        $this->db->where('location_id', $location_id);
        $this->db->delete('location');

        $this->db->where('location_id', $location_id);
        $this->db->delete('location_description');

        return true;
    }

    public function getSequenceById($sequence_id) {

        $query = $this->db->query("
                   SELECT * FROM location_description WHERE description_id =" . $sequence_id . " 
                ");
        $row = $query->row();
        return $row;
    }

    public function updateSequence($data, $description_id) {
        $this->db->update('location_description', $data, array('description_id' => $description_id));
        //echo $this->db->last_query(); exit;
        return true;
    }

    public function deleteSequence($description_id) {

        $this->db->where('description_id', $description_id);
        $this->db->delete('location_description');

        return true;
    }

    public function getHighestKube() {
       
        $query = $this->db->query("SELECT MAX(value) as total FROM `settings` WHERE `key` = 'total_kube'");
        //echo $this->db->last_query();exit;
        return $query->row();
    }

    public function getHighestSeq() {
        
        $query = $this->db->query("SELECT MAX(value) as total FROM `settings` WHERE `key` = 'total_seq'");
        //echo $this->db->last_query();exit;
        return $query->row();
    }

}

?>