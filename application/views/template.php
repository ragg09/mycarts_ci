<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head >
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title> <?php echo $title; ?> </title>
<link href=" <?= base_url();?>css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
</script>
<style>
/* default css */
body{
background-color:white;
font-family: Arial, Verdana, sans-serif;
margin:0;
padding:0;
}
#wrapper{
width:1000px;
margin:10px auto;
padding:10px;
background-color:#f1f1f1;
border:2px solid #ccc;
}
#nav{
float:left;
width:135px;
height:auto;
}
#main{
float:right;
margin-left:150px;
width:800px;
height:auto;
}
#header{
font-size:12px;
margin-bottom:10px;
}
#footer{
clear:both;
padding-top:40px;
font-size:9px;
}

</style>
</head>
<body>
<div id="wrapper" >
<div id="header" >
<?php $this->load->view('header');?>
</div >
<div id="nav" >
<?php $this->load->view('navigation');?>
</div >
<div id="main" >
<?php $this->load->view($main);?>
</div >
<div id="footer" >
<?php $this->load->view('footer');?>
</div>
</div>
</body>
</html>
