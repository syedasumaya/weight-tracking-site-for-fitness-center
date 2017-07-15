<?php

class admin_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function chkLogin($data) {
        $this->db->limit(1);
        $query = $this->db->get_where("admin_users", array('username' => $data['username'], 'password' => $data['password']));
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }

        return false;
    }
    //new
    public function update_admin_password($id,$data){
        
        $this->db->set('password', $data['new_pass']);
        $this->db->where('id', $id);
        $this->db->update('admin_users');
    }

    public function getMembers($limit,$start) {
        $this->db->select('*');
        $this->db->limit($limit,$start);
        $this->db->order_by("memberid","desc");
        $query = $this->db->get('users');
		//echo $this->db->last_query(); exit();
        return $query->result();
    }

    public function getMembers_sortBy($limit,$start,$exp) {
        $this->db->select('*');
        $this->db->limit($limit,$start);
        $this->db->order_by($exp[0],$exp[1]);
        $query = $this->db->get('users');
		//echo $this->db->last_query(); exit();
        return $query->result();
    }

    public function getMemberInfo($id) {
        $query = $this->db->get_where('users', array('userid' => $id));
        return $query->row();
    }

    public function update_member($id, $data) {
        $this->db->update('users', $data, array('userid' => $id));
    }

    public function deleteMember($id) {
        $this->db->delete('users', array('userid' => $id));
    }

    public function insert($info) {
        $this->db->insert('users', $info);
    }

		/*--------Start of admin--------*/
    //new
	 public function insertAdmin($info) {
        $this->db->insert('admin_users', $info);
    }
	public function getAdminDetails() {

        $this->db->select('*');
        $this->db->from('admin_users');
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
	
    //new
	public function getAdminInfo($id) {
        $query = $this->db->get_where('admin_users', array('id' => $id));
        return $query->row();
    }
	
	public function update_admin($id, $data) {
        $this->db->update('admin_users', $data, array('id' => $id));
    }
	
	 public function deleteAdmin($id) {
        $this->db->delete('admin_users', array('id' => $id));
    }
	
	/*--------End of admin--------*/ 

    public function FetchData($table, $condition) {
        if ($condition == "")
            $sql = $this->db->get($table);
        else
            $sql = $this->db->get_where($table, $condition);

        if ($sql->num_rows() > 0) {

            return $data = $sql->result();
        } else {
            return false;
        }
    }

    public function FetchDataRow($table, $condition) {
        if ($condition == "")
            $sql = $this->db->get($table);
        else
            $sql = $this->db->get_where($table, $condition);

        if ($sql->num_rows() > 0) {

            return $data = $sql->row();
        } else {
            return false;
        }
    }

    /* kubex admin panel import data */

    public function check_duplicate($data) {
        $query = $this->db->get_where("users", array('memberid' => $data['memberid']));
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public function total($table, $condition, $offset) {
        if ($condition == "" AND $offset == "")
            return $this->db->count_all($table);
        else {
            $this->db->where($condition, $offset);
            $this->db->from($table);
            return $this->db->count_all_results();
        }
    }
    
    public function total_filterRows($data){
                //print_r($data);exit;
       if (is_numeric($data['kubeid'])) {
            $query = $this->db->query("SELECT users.firstname,users.lastname,weight.location,weight.sequence,weight.kube_name,weight.userweight,weight.date,location_description.exercise_name FROM weight INNER JOIN users ON users.userid = weight.userid INNER JOIN location ON location.location_name = weight.location INNER JOIN location_description ON location_description.location_id = location.location_id WHERE weight.userid = '" . $data['userid'] . "' AND weight.location ='" . $data['location'] . "' AND weight.kube_name ='" . $data['kubeid'] . "' AND weight.sequence ='" . $data['sequence'] . "'");
        } else {
           $query = $this->db->query("SELECT users.firstname,users.lastname,weight.location,weight.sequence,weight.kube_name,weight.userweight,weight.date,location_description.exercise_name FROM weight INNER JOIN users ON users.userid = weight.userid INNER JOIN location ON location.location_name = weight.location INNER JOIN location_description ON location_description.location_id = location.location_id WHERE weight.userid = '" . $data['userid'] . "' AND weight.location ='" . $data['location'] . "' AND weight.sequence ='" . $data['sequence'] . "'");
        }
        //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }

    public function getUserDetails($limit,$start,$userid) {
        $query = $this->db->query("SELECT users.firstname,users.lastname,weight.location,weight.sequence,weight.kube_name,weight.userweight,weight.date,location_description.exercise_name FROM weight INNER JOIN users ON users.userid = weight.userid INNER JOIN location ON location.location_name = weight.location INNER JOIN location_description ON location_description.location_id = location.location_id WHERE weight.userid = '" .$userid . "'LIMIT $start,$limit");
         if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function search_weight($limit,$start,$data) {
        
        //$query = $this->db->query("SELECT * FROM weight WHERE userid = '".$data['userid']."' AND location ='".$data['location']."' AND kubeid ='".$data['kubeid']."' AND sequence ='".$data['sequence']."'");
        if (is_numeric($data['kubeid'])) {
            $query = $this->db->query("SELECT users.firstname,users.lastname,weight.location,weight.sequence,weight.kube_name,weight.userweight,weight.date,location_description.exercise_name FROM weight INNER JOIN users ON users.userid = weight.userid INNER JOIN location ON location.location_name = weight.location INNER JOIN location_description ON location_description.location_id = location.location_id WHERE weight.userid = '" . $data['userid'] . "' AND weight.location ='" . $data['location'] . "' AND weight.kube_name ='" . $data['kubeid'] . "' AND weight.sequence ='" . $data['sequence'] . "' LIMIT $start,$limit");
        } else {
            $query = $this->db->query("SELECT users.firstname,users.lastname,weight.location,weight.sequence,weight.kube_name,weight.userweight,weight.date,location_description.exercise_name FROM weight INNER JOIN users ON users.userid = weight.userid INNER JOIN location ON location.location_name = weight.location INNER JOIN location_description ON location_description.location_id = location.location_id WHERE weight.userid = '" . $data['userid'] . "' AND weight.location ='" . $data['location'] . "' AND weight.sequence ='" . $data['sequence'] . "' LIMIT  $start,$limit");
        }

        //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            //print_r($query); die();
            return $query->result();
        }
    }
	
	/*-------settings------*/
    
    public function getsettingsInfo() {
        $this->db->select('*');
        $this->db->from('settings');
        $query_result = $this->db->get();
        $result = $query_result->result();
        $setresult = array();
        foreach ($result as $k => $v) {
           // $setresult[$v->key] = $v->value;
             $setresult[$v->location][$v->key] =  $v->value;
             $setresult[$v->location]['location'] =  $v->location;
             
        }

        return $setresult;
    }
   
    public function getsettingsInfoById($location){
        
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('location',$location);
        $query_result = $this->db->get();
        $result = $query_result->result();
        
        $setresult = array();
        foreach ($result as $k => $v) {
           // $setresult[$v->key] = $v->value;
             $setresult[$v->location][$v->key] =  $v->value;
             $setresult[$v->location]['location'] =  $v->location;
             
        }
        //print_r($setresult);exit;
        return $setresult;
        
    }
  
    
    public function update_settings($newval,$location) {
        foreach($newval as $key => $value){//echo $key.' '.$value;
          $this->db->query("UPDATE `settings` SET `value` = '".$value."' WHERE `key` =  '".$key."' AND `location` = '".$location."'"); 
        }//exit;
        //echo $this->db->last_query();exit;
        return TRUE;
    }
    
    //new
    public function insert_settings($newval){
        
        $this->db->set('location',$newval['location']);
        $this->db->set('key','total_kube');
        $this->db->set('value',$newval['total_kube']);
        $this->db->insert('settings');
        
        $this->db->set('location',$newval['location']);
        $this->db->set('key','total_seq');
        $this->db->set('value',$newval['total_seq']);
        $this->db->insert('settings');
        
        return true;
        
    }
    
    //new
     public function checkLocationExistOrNot($location_name){
     
     $query = $this->db->get_where("settings", array('location' => $location_name));
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return false;
        }else{
            return true;
        }
 }
 
   //new
    public function deleteSettings($location){
     
         $this->db->where('location', $location);
         $this->db->delete('settings'); 
         return true;
  }
  
  //search user
   public function count_all_UserSearchResult($search){
        $sql = $this->db->query("SELECT COUNT(*) AS total FROM `users` WHERE `memberid` = '".$search."' OR `firstname` LIKE '%".$search."' OR `lastname` LIKE '".$search."%' OR concat(firstname,' ',lastname) LIKE '%".$search."%'");
        return $sql->num_rows();

    }
     public function getUserSearchResult($search,$limit,$start) {
        
        $sql = $this->db->query("SELECT * FROM `users` WHERE `memberid` = '".$search."' OR `firstname` LIKE '%".$search."' OR `lastname` LIKE '".$search."%' OR concat(firstname,' ',lastname) LIKE '%".$search."%' LIMIT $start,$limit");
              
         return $sql->result();
       
    }
    
    /*--------------------------------Admin Settings-------------------------------------------*/
     
    public function insert_admin_settings($newval,$admin_id){
        
        foreach ($newval as $key => $value) { 
        $this->db->set('admin_id',$admin_id);
        $this->db->set('key',$key);
        $this->db->set('value',$value);
        $this->db->insert('admin_settings');
        }
        
        //echo $this->db->last_query();exit;
        return true;
        
    }
    
    public function getAdminsettingsInfo() {
        $this->db->select('*');
        $this->db->from('admin_settings');
        $query_result = $this->db->get();
        $result = $query_result->result();
        $setresult = array();
        foreach ($result as $k => $v) {
           // $setresult[$v->key] = $v->value;
             $setresult[$v->admin_id][$v->key] =  $v->value;
             $setresult[$v->admin_id]['admin_id'] =  $v->admin_id;
             
        }

        return $setresult;
    }
    
     public function getAdminsettingsInfoById($admin_id){
        
        $this->db->select('*');
        $this->db->from('admin_settings');
        $this->db->where('admin_id',$admin_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        
        $setresult = array();
        foreach ($result as $k => $v) {
           // $setresult[$v->key] = $v->value;
             $setresult[$v->admin_id][$v->key] =  $v->value;
             $setresult[$v->admin_id]['admin_id'] =  $v->admin_id;
             
        }
        //print_r($setresult);exit;
        return $setresult;
        
    }
    
   
    public function update_admin_settings($newval,$admin_id){
        
        foreach ($newval as $key => $value) {        
        $this->db->set('value',$value);
        $this->db->where('key',$key);
        $this->db->where('admin_id',$admin_id);
        $this->db->update('admin_settings');
        }
        
        //echo $this->db->last_query();exit;
        return true;
    }
    
    

}



?>