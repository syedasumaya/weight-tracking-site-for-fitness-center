<?php
class front_model extends CI_Model {

    function __construct()
    {
        
        parent::__construct();
    }

    public function getWeightRangeIncRate($kubename,$sequence,$kube_locationid){
        
        $query = $this->db->query("
                 SELECT * FROM location_description WHERE kube_name ='".$kubename."' AND location_seq = '".$sequence."' AND location_id = '".$kube_locationid."'
                ");
        return $query->row();	
    }
    
	public function get_initial_kube($seq,$location){
		$query=$this->db->query("SELECT * FROM location_description WHERE location_id='".$location."' and location_seq ='".$seq."' ORDER BY sort_order ASC LIMIT 1");
		//echo $this->db->last_query();exit;
                return $query->result();	
	}
	
    public function get_sequence($kube_sequence, $sortorder, $location){
    	//echo "SELECT * FROM location_description WHERE location_id=$location and location_seq =".$kube_sequence." AND kube_name>'".$kubeid."' ORDER BY sort_order ASC LIMIT 1";
		$query=$this->db->query("SELECT * FROM location_description WHERE location_id=$location and location_seq =".$kube_sequence." AND sort_order>".$sortorder." ORDER BY sort_order ASC LIMIT 1");
		return $query->result();
    }

        public function get_prev_sequence($kube_sequence, $sortorder, $location){
	    $query=$this->db->query("SELECT * FROM location_description WHERE location_id=$location and location_seq =".$kube_sequence." AND sort_order<".$sortorder." ORDER BY sort_order DESC LIMIT 1");
		return $query->result();
	}
	
	public function get_kube_name($kube_sequence){
		$this->db->select('*');
        $this->db->from('location_description');
        $this->db->where('location_seq',$kube_sequence);
		$query = $this->db->get();
		return $query->result();
	}
	
    function getUserByPin($pin){
            $this->db->limit(1);	
            $query=$this->db->get_where("users",array('memberid'=>$pin));
            if($query->num_rows()>0){
                $row = $query->row();
                return $row;
            }

            return false;
    }
	public function getLocation($location){
		$query=$this->db->query("SELECT * FROM settings WHERE location ="."'".$location."'"."");
		return $query->result();
	}
        
        //changed
    public function getWeightByDate($data){
        $query=$this->db->query("SELECT userweight FROM weight WHERE location = " ."'".$data['location']."'". " AND sequence = " .$data['sequence']. " AND userid = ".$data['userid']." AND kube_name = '".$data['kube_name']."' ORDER BY id DESC LIMIT 1");
        $row = $query->row();
               return $row;
    }

	public function getMembers(){
		$this->db->select('*');
		$this->db->from('users');
		$query =$this->db->get();
		return $query->result();
	}		
	
	public function getMemberInfo($id){
		$query =$this->db->get_where('users',array('userid'=>$id));
		return $query->row();
	}

	public function update_member($id, $data){
		$this->db->update('users',$data,array('userid'=>$id));			
	}

	public function deleteMember($id){
		$this->db->delete('users', array('userid'=>$id));
	}

	public function insert($info){
		$this->db->insert('users',$info);
	
	}
	
	public function getcarcategory(){
		$query = $this->db->get('categories');
		if($query->num_rows()>0){
			return $query->result();
		}
	}
	public function getcaroption(){
		$query = $this->db->get('options');
		if($query->num_rows()>0){
			return $query->result();
		}
	}
	public function getmakes(){
	$this->db->order_by("Make", "asc"); 
		$query = $this->db->get('makes');
		if($query->num_rows()>0){
			return $query->result();
		}
	}
	
	function get_it_model($id){

		$this->db->where('MakeID', $id);
		$this->db->order_by("Model", "asc"); 
		$query = $this->db->get('models');

		if($query->result()){
			$result = $query->result();

			foreach($result as $row)
			{
				$options[$row->ModelID] = $row->Model;
			}   
			return $options;
		} 
	}
	public function get_carmodeldata($id){
		$this->db->select('*');
		$this->db->from('cars');
		$this->db->join('models', 'models.ModelID = cars.ModelID');
		$this->db->where('models.MakeID', $id);
		$query = $this->db->get();
		if($query->result()){
			$result = $query->result();

			foreach($result as $row)
			{
				$options[$row->ModelID] = $row->Model;
			}   
			return $options;
		} 
	}
	
	public function vehicleinsert($info){
		$insert = $this->db->insert('cars',$info);
		if($insert==true){
		 return $this->db->insert_id();
		}
	}
	
	public function vehiclephoto($info){
		$this->db->insert('carsimages',$info);
	}
	
	public function getcarInfo($field,$order){
		$userid=$this->session->userdata('userid');
		$this->db->select('*');
		$this->db->from('cars');
		$this->db->join('categories', 'categories.CategoryID = cars.CategoryID');
		$this->db->join('makes', 'makes.MakeID = cars.MakeID');
		$this->db->join('models', 'models.ModelID = cars.ModelID');
		if($field!='' && $order!=''){
		$this->db->order_by($field,$order); 
		}
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
	}
	
	public function getcarInfoById($id){
		$this->db->select('*');
		$this->db->where('cars.CarID',$id); 
		$query = $this->db->get('cars');
		if($query->num_rows()>0){
			return $query->row();
		}
	}
	
	public function vehicleUpdate($data,$id){
		$this->db->update('cars',$data,array('CarID'=>$id));
		$this->session->set_flashdata('success', 'Successfully data Updated');
			redirect('admin/editvehicle/'.$id);
	}
	public function Imagesdelete($vehicleid,$imgid){
	 $this->db->delete('carsimages', array('imageid' => $imgid,'car_id' => $vehicleid)); 
		redirect('admin/vehicleImages/'.$vehicleid);
	}
	public function v_profileimg($imgid,$v_id,$data,$info){
		$this->db->update('carsimages',$data,array('car_id'=>$v_id));
		$this->db->update('carsimages',$info,array('car_id'=>$v_id,'imageid'=>$imgid));
	}
	public function  vehicledeleteid($vehicleid){
		  $this->db->delete('cars', array('CarID' => $vehicleid)); 
		 $this->db->delete('carsimages', array('car_id' => $vehicleid)); 
	}
	
	public function  updatethisvehicle($vid,$data){
		$this->db->update('cars',$data,array('CarID'=>$vid));
		return true;
	}
	
	public function getmakesmodels(){
		$this->db->select('*');
		$this->db->from('makes');
		$this->db->join('models', 'models.MakeID = makes.MakeID');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}
	}
	
	public function FetchData($table , $condition)
	  {
		if($condition == "") $sql = $this->db->get($table);
		else  $sql = $this->db->get_where($table, $condition);
		   
		   if($sql->num_rows() > 0){
				
				return $data = $sql->result();
		   }
		   else {
			   return false;
		   }
	  }
	  
	  public function FetchDataRow($table , $condition)
	  {
		if($condition == "") $sql = $this->db->get($table);
		else  $sql = $this->db->get_where($table, $condition);
		   
		   if($sql->num_rows() > 0){
				
				return $data = $sql->row();
		   }
		   else {
			   return false;
		   }
	  }
	  
	
	public function editBasicInfoCheckBox($string, $name, $table, $offset,$input){

			$ref_name = $this->FetchData($table, "");

			$opendiv = '<div class="checkbox col-md-4">';
			$closediv = '</div>';
			if($ref_name){
				
			 $str = explode(",",$string);
				
			  foreach($ref_name as $val){
				  
				  $display_name = $val->$name;
				  $found_id = $val->$offset;

				if(in_array($found_id , $str)){
						
				   $checked = "checked=\"checked\"";
				 }
				 else  $checked = ""; 
			  echo $opendiv ;
			  echo '<input type="checkbox" name="'.$input.'"  value="'.$val->$offset.'"  '.$checked.'> 
			  &nbsp;&nbsp;'.stripcslashes($display_name).'&nbsp;&nbsp;';
			  echo $closediv ;
			  

			  }
		 }
	}
	public function updatevechicleCount($id){
		$sql="UPDATE  cars set  imgdownloadcount =imgdownloadcount + 1 WHERE CarID =".$id ;
		$this->db->query($sql);
	}
        
        public function save_weight($data){
            $save_data=$this->db->insert('weight', $data); 
            return true;
        }
}
?>