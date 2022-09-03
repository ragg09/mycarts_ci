<div id='pleft' >
<h2 > Search Results </h2 >
<?php
if (count($results)){
foreach ($results as $key => $list){
echo " <img src='".$list['thumbnail']."' border='0' align='left'/> \n";
echo " <h4> ";
echo anchor('mycart/product/'.$list['id'],$list['name']);
echo " </h4> \n";
echo " <p> ".$list['shortdesc']." <p> <br style='clear:both'/> ";
}
}else{
echo " <p> Sorry, no records were found to match your search term. </p> ";
}
?>
</div >
