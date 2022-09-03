<?php
class Madmins extends CI_Model{
  public function __construct(){
        parent::__construct();
}

function getUser($id){
	$data = array();
	$options = array('id' => $id);
	$Q = $this->db->get_where('admins',$options,1);
	if ($Q->num_rows() > 0){
	$data = $Q->row_array();
	}
	$Q->free_result();
	return $data;
}

function getAllUsers(){
	$data = array();
	$Q = $this->db->get('admins');
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
			$data[] = $row;
		}
	}
	$Q->free_result();
	return $data;
}

function verifyUser($u,$pw){
		$this->db->select('id,username');
		$this->db->where('username',$u);
		$this->db->where('password', $pw);
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$Q = $this->db->get('admins');
		if ($Q->num_rows() > 0){
		$row = $Q->row_array();
		$_SESSION['userid'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		}else{
		$this->session->set_flashdata('error', 'Sorry, your username or password is
		incorrect!');
		}
	}

function addUser(){
	$data = array('username' => $_POST['username'],
	'email' => $_POST['email'],
	'status' => $_POST['status'],
	//'password' => $this->hash($_POST['password'])
	);
	$this->db->insert('admins',$data);
	}

function updateUser(){
	$data = array('username' => $_POST['username'],
	'email' => $_POST['email'],
	'status' => $_POST['status'],
	//'password' => $this->hash($_POST['password'])
	);
	$this->db->where('id',$_POST['id']);
	$this->db->update('admins',$data);
}

function deleteUser($id){
	$data = array('status' => 'inactive');
	$this->db->where('id', $id);
	$this->db->update('admins', $data);
}

// public function hash ($string){
// 	return hash('sha512', $string.config_item('encryption_key'));
// }



}
?>