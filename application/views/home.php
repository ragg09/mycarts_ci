<div id='pleft' >
<?php

echo " <img src='".$mainf['image']."' border='0' align='left'/> \n";
echo " <h2> ".$mainf['name']." </h2> \n";
echo " <p> ".$mainf['shortdesc'] . " <br/> \n";
echo anchor('mycart/product/'.$mainf['id'],'see details') . " <br/> \n";
echo anchor('mycart/cart/'.$mainf['id'],'buy now') . " </p> \n";
?>
</div>
<div id='pright' >
<?php
foreach ($sidef as $key => $list){
echo " <img src='".$list['thumbnail']."' border='0 	' align='left'/> \n";
echo " <h4> ".$list['name']." </h4> \n";
echo " <p > ";
echo anchor('mycart/product/'.$list['id'],'see details') . " <br/> \n";
echo anchor('mycart/cart/'.$list['id'],'buy now') . " </p> \n";
}
?>
</div >
