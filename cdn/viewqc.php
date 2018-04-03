<?php 

if (substr($_GET['image'], 0, 7) == 'uploads' ) {
	//for original file in sv bnc
	$img =  $_GET['image'];
	$image = 'http://static1.webbnc.vn/'.$img;
	$exp = explode('/', $img);
	$name = end($exp); 
	$part ='';
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


}else{
	//for original file in sv uplaod 

	$savefile = $_GET['image'].'_'.$_GET['mode'].$_GET['size'].'.jpg'; 
	$image = 'http://static1.webbnc.vn/'.$_GET['image'];
}
			
			 
require_once ( 'imageTransform1.php' ); 
$imageTransform->view($savefile,$_GET['mode'], $image, $_GET['size']);
 
?>
