<?php
class Categories extends CI_Controller{
  public function __construct(){
        parent::__construct();
		
		//session_start();
}

function index(){
	$data['title'] = "Manage Categories";
	$data['main'] = 'admin_cat_home';
	$data['categories'] = $this->MCats->getAllCategories();
	$this->load->vars($data);
	$this->load->view('dashboard');
}

function create(){
	if ($this->input->post('name')){
		$this->MCats->addCategory();
		//$this->session->set_flashdata('message','Category created');
		redirect('admin/categories/index','refresh');
		}else{
		$data['title'] = "Create Category";
		$data['main'] = 'admin_cat_create';
		$data['categories'] = $this->MCats->getTopCategories();
		$this->load->vars($data);
		$this->load->view('dashboard');
	}
}

function edit($id=0){
	if ($this->input->post('name')){
		$this->MCats->updateCategory();
		//$this->session->set_flashdata('message','Category updated');
		redirect('admin/categories/index','refresh');
		}else{
		$data['title'] = "Edit Category";
		$data['main'] = 'admin_cat_edit';
		$data['category'] = $this->MCats->getCategory($id);
		$data['categories'] = $this->MCats->getTopCategories();
		$this->load->vars($data);
		$this->load->view('dashboard');
	}
}

function delete($id){
	$data = array('status' => 'inactive');
	$this->db->where('id', $id);
	$this->db->update('categories', $data);
	redirect('admin/categories/index','refresh');

	// if ($this->db->where('id',$id,"active")){
	// 	$data = array('status' => 'inactive');
	// 	$this->db->where('id', $id);
	// 	$this->db->update('categories', $data);
	// 	// $data = "";
	// }
	// else{
	// 	$data2 = array('status' => 'active');
	// 	$this->db->where('id', $id);
	// 	$this->db->update('categories', $data2);
	// 	// $data = "";

	// 	}	
	// redirect('admin/categories/index','refresh');
}


}
?>
