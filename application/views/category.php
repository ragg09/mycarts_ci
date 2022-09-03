<div id='pleft' >
<?php
echo "<h2> ".$category['name']." </h2 > \n";
echo "<p> ".$category['shortdesc'] . "</p> \n";
foreach ($listing as $key => $list){
echo "<img src='".$list['thumbnail']."' border='0' align='left'/> \n";
echo "<h4> ";
switch($level){
case "1":
echo anchor('mycart/cat/'.$list['id'],$list['name']);
break;
case "2":
echo anchor('mycart/product/'.$list['id'],$list['name']);
break;
}
echo "</h4> \n";
echo "<p> ".$list['shortdesc']." </p> <br style='clear:both'/> ";
}
?>
</div>
