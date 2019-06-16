<?php
defined('BASEPATH') OR EXIT('No direct script access allowed');

//require(APPPATH.'/libraries/REST_Controller.php');
//use Restserver\Libraries\REST_Controller;

class User_model extends CI_Model{
	
	private $response;
	
	public function read(){
		$query = $this->db->query("SELECT * FROM tbl_user");
		
		return $query->result_array();
	}
	
	public function insert($data){
		$this->user_name = $data['name'];
		$this->user_password = $data['pass'];
		$this->user_type = $data['type'];
		
		$query = $this->db->insert('tbl_user', $this);
		
		if($query){
			$this->response['status_code'] = "200";
			$this->response['status_message'] = "Success";
			$this->response['error'] = false;
		}
		else{
			$this->response['status_code'] = "500";
			$this->response['status_message'] = $this->db->error();
			$this->response['error'] = true;
		}
		return $this->response;
		/*if($this->db->insert('tbl_user', $this)){
			return "Data is inserted successfully";
		}
		else{
			return "Error has occured";
		}*/
	}
	
	public function update($id, $data){
		$this->user_name = $data['name'];
		$this->user_password = $data['pass'];
		$this->user_type = $data['type'];
		
		$result = $this->db->update('tbl_user', $this, array('user_id' => $id ));
		
		if($result){
			return "Data is inserted successfully";
		}
		else{
			return "Error has occured";
		}
	}
	
	public function delete_user($id){
		$result = $this->db->query("DELETE FROM tbl_user WHERE user_id = $id");
		
		if($result){
			return "Data is deleted successfully.";
		}
		else{
			return "Error has occured.";
		}
	}
	
}

?>