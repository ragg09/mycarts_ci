<?php
class Admins extends CI_Controller{
	  public function __construct(){
	        parent::__construct();
	  }

function index(){
	$data['title'] = "Manage Users";
	$data['main'] = 'admin_admins_home';
	$data['admins'] = $this->Madmins->getAllUsers();
	$this->load->vars($data);
	$this->load->view('dashboard');
}

function create(){
	if ($this->input->post('username')){
	$this->Madmins->addUser();
	//$this->session->set_flashdata('message','User created');
	redirect('admin/admins/index','refresh');
	}else{
	$data['title'] = "Create User";
	$data['main'] = 'admin_admins_create';
	$this->load->vars($data);
	$this->load->view('dashboard');
	}
}

function edit($id=0){
if ($this->input->post('username')){
$this->Madmins->updateUser();
//$this->session->set_flashdata('message','User updated');
redirect('admin/admins','refresh');
}else{
$data['title'] = "Edit User";
$data['main'] = 'admin_admins_edit';
$data['admin'] = $this->Madmins->getUser($id);
$this->load->vars($data);
$this->load->view('dashboard');
}
}

function delete($id){
$this->Madmins->deleteUser($id);
//$this->session->set_flashdata('message','User deleted');
redirect('admin/admins','refresh');
}



}
?>