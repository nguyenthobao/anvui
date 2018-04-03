<?php 


if (substr($_GET['image'], 0, 6) == 'upload' ) {
	$image = $_GET['image'];
	$size = $_GET['size'];
	$exp = explode('/', $image);
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
	
	$typeImageSS = array('png','jpg','jpeg','gif','PNG','JPG','JPEG','PNG','GIF');
	$typeImage = end(explode('.',$name));
	$nameImage = str_replace('.'.$typeImage,"",$name);
	if (!in_array($typeImage,$typeImageSS)) {
		$typeImage = '.png';
	}
	$savefile = $part.$nameImage.'_'.$_GET['mode'].'_'.$size.'.'.$typeImage; 

///view.php?image=upload/web/1/1/product/2015/01/06/04/41/1420562498_babymama.png&mode=crop&size=300x200
}

if(file_exists($savefile))
			{
					header("Content-type: image/jpeg");
					header('Content-Disposition: inline; filename="'.$image.'"');
					echo file_get_contents($savefile);
					exit();
			}			
			 
require_once ( 'imageTransform.php' ); 
$imageTransform->view($savefile,$_GET['mode'], $image, $_GET['size']);
 
?>
