<?php
class MCats extends CI_Model 
{
  public function __construct(){
        parent::__construct();
  }


function getCategory($id){
	$data = array();
	$options = array('id' => $id);
	$Q = $this->db->get_where('categories',$options,1);
	if ($Q->num_rows() > 0){
		$data = $Q->row_array();
	}
	$Q->free_result();
	return $data;
}

function getAllCategories(){
	$data = array();
	$Q = $this->db->get('categories');
	if ($Q-> num_rows() > 0){
		foreach ($Q->result_array() as $row){
			$data[] = $row;
		}
	}
	$Q->free_result();
	return $data;
}

function getCategoriesNav(){
	$data = array();
	$Q = $this->db->get('categories');
	if ($Q->num_rows() > 0){
		foreach ($Q->result() as $row){
			$data[$row->id] = $row->name;
		}
	}
	$Q->free_result();
	return $data;
}

function getSubCategories($catid){
	$data = array();
	$this->db->select('id,name,shortdesc');
	$this->db->where('parentid', $catid);
	$this->db->where('status', 'active');
	$this->db->order_by('name','asc');
	$Q = $this->db->get('categories');
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
			$Q2 = $this->db->query("select thumbnail as src from products where category_id=".$row['id']. "
			order by rand() limit 1");
			if($Q2->num_rows() > 0){
				$thumb = $Q2->row_array();
				$THUMB = $thumb['src'];
			}else{
				$THUMB = '';
			}

			$Q2->free_result();
			$data[] = array(
			'id' => $row['id'],
			'name' => $row['name'],
			'shortdesc' => $row['shortdesc'],
			'thumbnail' => $THUMB
			);
		}
	}
	$Q->free_result();
	return $data;
}

function getTopCategories(){
	$data[0] = 'root';
	$this->db->where('parentid',0);
	$Q = $this->db->get('categories');
	if ($Q->num_rows() > 0){
		foreach ($Q->result_array() as $row){
			$data[$row['id']] = $row['name'];
		}
	}
	$Q->free_result();
	return $data;
}

function addCategory(){
	$data = array(
	'name' => $_POST['name'],
	'shortdesc' => $_POST['shortdesc'],
	'longdesc' => $_POST['longdesc'],
	'status' => $_POST['status'],
	'parentid' => $_POST['parentid']
	);
	$this->db->insert('categories', $data);
}

function updateCategory(){
	$data = array(
	'name' => $_POST['name'],
	'shortdesc' => $_POST['shortdesc'],
	'longdesc' => $_POST['longdesc'],
	'status' => $_POST['status'],
	'parentid' => $_POST['parentid']
	);
	$this->db->where('id', $_POST['id']);
	$this->db->update('categories', $data);
}

function getCategoriesDropDown(){
     $data = array();
     $this->db->select('id,name');
     $this->db->where('parentid !=',0);
     $Q = $this->db->get('categories');
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[$row['id']] = $row['name'];
       }
    }
    $Q->free_result();  
    return $data; 
 }

}
?>

