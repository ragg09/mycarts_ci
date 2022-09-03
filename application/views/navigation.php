<?php
if (count($navlist)){
echo "<ul> ";
foreach ($navlist as $id => $name){
echo "<li>";
echo anchor("mycart/cat/$id",$name);
echo "</li> ";
}
echo "</ul> ";
}
