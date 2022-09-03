<?php
class Products extends CI_Controller{
	  public function __construct(){
	        parent::__construct();
	  }

function index(){
$data['title'] = "Manage Products";
$data['main'] = 'admin_product_home';
$data['products'] = $this->MProducts->getAllProducts();
$this->load->vars($data);
$this->load->view('dashboard');
}

function create(){
	if ($this->input->post('name')){
		$this->MProducts->addProduct();
		//$this->session->set_flashdata('message','Product created');
		redirect('admin/products/index','refresh');
	}else{
		$data['title'] = "Create Product";
		$data['main'] = 'admin_product_create';
		$data['categories'] = $this->MCats->getCategoriesDropDown();
		$this->load->vars($data);
		$this->load->view('dashboard');
	}

}


function edit($id=0){
	if ($this->input->post('name')){
	$this->MProducts->updateProduct();
	$this->session->set_flashdata('message','Product updated');
	redirect('admin/products/index','refresh');
	}else{
	$data['title'] = "Edit Product";
	$data['main'] = 'admin_product_edit';
	$data['product'] = $this->Mproducts->getProduct($id);
	$data['categories'] = $this->Mcats->getCategoriesDropDown();
	$this->load->vars($data);
	$this->load->view('dashboard');
	}
}

function delete($id){
	$this->MProducts->deleteProduct($id);
	$this->session->set_flashdata('message','Product deleted');
	redirect('admin/products','refresh');
 }






}
?>