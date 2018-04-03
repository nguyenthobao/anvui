<?php 
 
 
	$image = $_GET['image'];
	$exp = explode('/',$image);
	$name = end($exp); 
	$part ='';
	$exp  = array('drugie','mobile');
	foreach ($exp as $key => $value) {
		if($value == $name ) continue;
		//$value =($value =='uploads')?'uploads1':$value;
		$part .= $value.'/';
		if(!is_dir($part))
		{
			mkdir($part);
			chmod($part, 0777);
		}
	}  
	$savefile = $part.$name.'_'.$_GET['mode'].$_GET['size'].'.jpg'; 


 
			
			 
require_once ( 'imageTransform.php' ); 
$imageTransform->view($savefile,$_GET['mode'], $image, $_GET['size']);
 
?>
