<?php
class Dashboard extends CI_Controller{
	  public function __construct(){
	        parent::__construct();
	        
	  }

function index(){
	//use this for your home page
		$data['title'] = "Dashboard Home";
		$data['main'] = 'admin_home';
		$this->load->vars($data);
		$this->load->view('dashboard'); 	
}

function logout(){
	unset($_SESSION['userid']);
	unset($_SESSION['username']);
	$this->session->set_flashdata('error',"You've been logged out!");
	redirect('mycart/verify','refresh');
}
}
?>