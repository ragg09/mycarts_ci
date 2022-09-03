<h1> <?php echo $title;?> </h1>
<p> <?php echo anchor("admin/products/create", "Create new product");?> </p>
<?php
//if ($this-> session-> flashdata('message')){
//echo " <div class='message'> ".$this-> session-> flashdata('message')." </div> ";
if (count($products)){
echo " <table border='1' cellspacing='0' cellpadding='3' width='400'> \n";
echo " <tr valign='top'> \n";
echo " <th> ID </th> \n <th> Name </th> <th> Status </th> <th> Actions </th> \n";
echo " </tr> \n";
foreach ($products as $key => $list){
echo " <tr valign='top'> \n";
echo " <td> ".$list['id']." </td> \n";
echo " <td> ".$list['name']." </td> \n";
echo " <td align='center'> ".$list['status']." </td> \n";
echo " <td align='center'> ";
echo anchor('admin/products/edit/'.$list['id'],'edit');
echo " | ";
echo anchor('admin/products/delete/'.$list['id'],'delete');
echo " </td> \n";
echo " </tr> \n";
}
echo " </table> ";
}
?>
