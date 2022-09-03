<?php
class MOrders extends CI_Model{
public function __construct(){
        parent::__construct();
		}
function updateCart($productid,$fullproduct){
//pull in existing cart first!
$cart = $_SESSION['cart'];
$totalprice = 0;
if (count($fullproduct)){
if (isset($cart[$productid])){
$prevct = $cart[$productid]['count'];
$prevname = $cart[$productid]['name'];
$prevprice = $cart[$productid]['price'];
$cart[$productid] = array(
'name' => $prevname,
'price' => $prevprice,
'count' => $prevct + 1
);
}else{
$cart[$productid] = array(
'name' => $fullproduct['name'],
'price' => $fullproduct['price'],
'count' => 1
);
}
foreach ($cart as $id => $product){
$totalprice += $product['price'] * $product['count'];
}
$_SESSION['totalprice'] = $totalprice;
$_SESSION['cart'] = $cart;
$this->session->set_flashdata('conf_msg', "We've added this product to your
cart.");
}
}
}//end class
?>
