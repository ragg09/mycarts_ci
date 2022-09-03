<div id='pleft' >
<?php
echo " <img src='".$product['image']."' border='0' align='left'/ > \n";
echo " <h2> ".$product['name']." </h2> \n";
echo " <p> ".$product['longdesc'] . " <br/> \n";
echo "Colors: <br/> \n";
echo "Sizes: <br/> \n";
echo anchor('mycart/cart/'.$product['id'],'buy now') . " </p> \n";
?>
</div>
<div id='pright' >
<?php
foreach ($grouplist as $key => $list){
echo " <img src='".$list['thumbnail']."' border='0' align='left'/> \n";
echo " <h4> ".$list['name']." </h4> \n";
echo " <p> ";
echo anchor('mycart/product/'.$list['id'],'see details') . " <br/> \n";
echo anchor('mycart/cart/'.$list['id'],'buy now') . " </p> \n";
}
?>
</div>
