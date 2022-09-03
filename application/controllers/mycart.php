<?php
class mycart extends CI_Controller{
	  public function __construct(){
	        parent::__construct();
	  }
	function index(){
	//use this for your home page
		$data['title'] = "Welcome to My Shop";
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$data['mainf'] = $this->MProducts->getMainFeature();	
		$skip = $data['mainf']['id'];
		$data['sidef'] = $this->MProducts->getRandomProducts(3, $skip);
		$data['main'] = 'home';
 		var_dump($skip);
		var_dump($data);
		$this->load->vars($data);
		$this->load->view('template'); 	
	}
	function cat($id){
		$cat = $this->MCats->getCategory($id);
		if (!count($cat)){
		redirect('mycart/index','refresh');
		}
		$data['title'] = "My shop | ". $cat['name'];
		if ($cat['parentid'] < 1){
		//show other categories
		$data['listing'] = $this->MCats->getSubCategories($id);
		$data['level'] = 1;
		}else{
		//show products
		$data['listing'] = $this->MProducts->getProductsByCategory($id);
		$data['level'] = 2;
		}
		$data['category'] = $cat;
		$data['main'] = 'category';
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template');
	}


	function subcat(){
	//use this for the subcategory view
	}

	function product($id){
		$product = $this->MProducts->getProduct($id);
		if (!count($product)){
			redirect('mycart/index','refresh');
		}
		$data['grouplist'] = $this->MProducts->getProductsByGroup(3,$product['grouping'],$id);
		$data['product'] = $product;
		$data['title'] = "My shop | ".$product['name'];
		$data['main'] = 'product';
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template');
	}

	function cart($productid=0){
		if ($productid > 0){
		$productid = $this->uri->segment(3);
		$fullproduct = $this->MProducts->getProduct($productid);
		$this->Morders->updateCart($productid,$fullproduct);
		redirect('mycart/product/'.$productid, 'refresh');
		}
		else
		{
			$data['title'] = "my cart| Shopping Cart";
			if(count($_SESSION['cart']) == true){
				$data['main'] = '';
				$data['navlist'] = $this->Mcats->getCategoriesNav();
				$this->load->vars($data);
				$this->load->view('template');
			}
			else{
				redirect('mycart/index','refresh');
			}
		}
	}

	function search(){
		if ($this->input->post('term')){
		$data['results'] = $this->MProducts->search($this->input->post('term'));
		}else{
		redirect('mycart/index','refresh');
		}
		$data['main'] = 'search';
		$data['title'] = "My shop | Search Results";
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template',$data);
	}

	function about_us(){
	//use this for the about_us page
	}
	function contact (){
	//use this for the contact page
	}
	function privacy(){
	//use this for the privacy page
	}

	function verify(){
		if ($this->input->post('username')){
		$u = $this->input->post('username');
		$pw = $this->input->post('password');
		$this->Madmins->verifyUser($u,$pw);
		if ($_SESSION['userid'] > 0){
		redirect('admin/dashboard','refresh');
		}
		}
		$data['main'] = 'login';
		$data['title'] = "My cart| Admin Login";
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template',$data);
	}

}
