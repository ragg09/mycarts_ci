<h1>Shopping Cart</h1>
<div id='pleft'>


<?php echo form_open('mycart/checkout'); ?>
<table border='1' cellspacing='0' cellpadding='5'>
<?php
$TOTALPRICE = $_SESSION['totalprice'];
if (count($_SESSION['cart'])){
foreach ($_SESSION['cart'] as $PID => $row){
$data = array(
'name' => "li_id[$PID]",
'value'=> $row['count'],
'id' => "li_id_$PID",
'size' => 5,
'class' => 'process'
);
echo " <tr valign='top' >\n";
echo " <td> ". form_input($data)." </td> \n";
echo " <td id='li_name_".$PID."' > ". $row['name']." </td> \n";
echo " <td id='li_price_".$PID."' > ". $row['price']." </td> \n";
echo " <td id='li_total_".$PID."' > ".$row['price'] * $row['count']." </td> \n";
echo " </tr> \n";
}
$total_data = array('name' => 'total', 'id'=> 'total', 'value' => $TOTALPRICE);
echo " <tr valign='top' >\n";
echo " <td colspan='3'> &nbsp; </td > \n";
echo " <td> $TOTALPRICE ".form_hidden($total_data)." </td> \n";
echo " </tr> \n";
echo " <tr valign='top' > \n";
echo " <td colspan='3' > &nbsp; </td> \n";
echo " <td> ".form_submit('submit', 'checkout')." </td> \n";
echo " </tr> \n";
}else{
//just in case!
echo " <tr> <td> No items to show here! </td> </tr > \n";
}//end outer if count
?>
</table>
</form>
</div>
