<?php

class MProducts extends CI_Model{
  public function __construct(){
        parent::__construct();
  }


function getProduct($id){
	$data = array();
	$options = array('id' => $id);
	$Q = $this->db->get_where('products',$options,1);
	if ($Q->num_rows() > 0){
		$data = $Q->row_array();
	}
	$Q->free_result();
	return $data;
}
function getAllProducts(){
	$data = array();
	$Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
		foreach ($Q-> result_array() as $row){
			$data[] = $row;
		}
	}
	$Q->free_result();
	return $data;
	}

function getMainFeature(){
	$data = array();
	$this->db->select('id,name,shortdesc,image');
	$this->db->where('featured','true');
	$this->db->where('status', 'active');
	$this->db->order_by("rand()");
	$this->db->limit(1);
	$Q = $this->db->get('products');
	echo $this->db->last_query();
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
		$data = array(
		"id" => $row['id'],
		"name" => $row['name'],
		"shortdesc" => $row['shortdesc'],
		"image" => $row['image']
		);
		}
	}
	$Q->free_result();
	return $data;
}

function getRandomProducts($limit,$skip){
	$data = array();
	$temp = array();
	if ($limit == 0){
	$limit=3;
	}
	$this->db->select("id,name,thumbnail,category_id");
	$this->db->where('id !=', $skip);
	$this->db->where('status', 'active');
	$this->db->order_by("category_id","asc");
	$this->db->limit(100);
	$Q = $this->db->get('products');
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
		$temp[$row['category_id']] = array(
		"id" => $row['id'],
		"name" => $row['name'],
		"thumbnail" => $row['thumbnail']
		);
		}
	}
	shuffle($temp);
	if (count($temp)){
	for ($i=1;$i <=$limit;$i++){
	$data[] = array_shift($temp);
	}
	}
	$Q->free_result();
	return $data;
}

function search($term){
$data = array();
$this->db->select('id,name,shortdesc,thumbnail');
$this->db->like('name',$term);
$this->db->or_like('shortdesc',$term);
$this->db->or_like('longdesc',$term);
$this->db->order_by('name','asc');
$this->db->where('status','active');
$this->db->limit(50);
$Q = $this->db->get('products');
if ($Q->num_rows() > 0){
foreach ($Q->result_array() as $row){
$data[] = $row;
}
}
$Q->free_result();
return $data;
}

function getProductsByCategory($catid){
$data = array();
$this->db->select('id,name,shortdesc,thumbnail');
$this->db->where('category_id', $catid);
$this->db->where('status', 'active');
$this->db->order_by('name','asc');
$Q = $this->db->get('products');
if ($Q->num_rows() > 0){
foreach ($Q->result_array() as $row){
$data[] = $row;
}
}
$Q->free_result();
return $data;
}

function getProductsByGroup($limit,$group,$skip){
$data = array();
if ($limit == 0){
$limit=3;
}
$this->db->select('id,name,shortdesc,thumbnail');
$this->db->where('grouping', $group);
$this->db->where('status', 'active');
$this->db->where('id !=',$skip);
$this->db->order_by('name','asc');
$this->db->limit($limit);
$Q = $this->db->get('products');
if ($Q->num_rows() > 0){
foreach ($Q->result_array() as $row){
$data[] = $row;
}
}
$Q->free_result();
return $data;
}

function addProduct(){
		$data = array(
		'name' => $_POST['name'],
		'shortdesc' => $_POST['shortdesc'],
		'longdesc' => $_POST['longdesc'],
		'status' => $_POST['status'],
		'grouping' => $_POST['grouping'],
		'category_id' => $_POST['category_id'],
		'featured' => $_POST['featured'],
		'price' => $_POST['price']
		);
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200';
		$config['remove_spaces'] = true;
		$config['overwrite'] = false;
		$config['max_width'] = '0';
		$config['max_height'] = '0';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('image')){
		$this->upload->display_errors();
		exit();
		}
		$image = $this->upload->data();
		if ($image['file_name']){
		$data['image'] = "/images/".$image['file_name'];
		}
		if(!$this->upload->do_upload('thumbnail')){
		$this->upload->display_errors();
		exit();
		}
		$thumb = $this->upload->data();
		if ($thumb['file_name']){
		$data['thumbnail'] = "/images/".$thumb['file_name'];
		}
		$this->db->insert('products', $data);
}

function updateProduct(){
	$data = array(
	'name' => $_POST['name'],
	'shortdesc' => $_POST['shortdesc'],
	'longdesc' => $_POST['longdesc'],
	'status' => $_POST['status'],
	'grouping' => $_POST['grouping'],
	'category_id' => $_POST['category_id'],
	'featured' => $_POST['featured'],
	'price' => $_POST['price']
	);
	$config['upload_path'] = './images/';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size'] = '200';
	$config['remove_spaces'] = true;
	$config['overwrite'] = false;
	$config['max_width'] = '0';
	$config['max_height'] = '0';
	$this->load->library('upload', $config);
	if(!$this->upload->do_upload('image')){
	$this->upload->display_errors();
	exit();
	}
	$image = $this->upload->data();
	if ($image['file_name']){
	$data['image'] = "images/".$image['file_name'];
	}
	if(!$this->upload->do_upload('thumbnail')){
	$this->upload->display_errors();
	exit();
	}
	$thumb = $this->upload->data();
	if ($thumb['file_name']){
	$data['thumbnail'] = "images/".$thumb['file_name'];
	}
	$this->db->where('id', $_POST['id']);
	$this->db->update('products', $data);
}

function deleteProduct($id){
$data = array('status' => 'inactive');
$this->db->where('id', $id);
$this->db->update('products', $data);
}










}




