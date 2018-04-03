<?php  
$img = $_GET['img'];  

$savefile = 'thumb/'.$_GET['mode'].'/'.$_GET['size'].'/'.md5($img).'.jpg'; 

 
if(file_exists($savefile))
{  
  header('Location: http://cdn.topmenu.vn/'.$savefile);
  die;  
}  


if(!is_dir('thumb/'.$_GET['mode'].'/'.$_GET['size'].'/'))
{
	mkdir('thumb/'.$_GET['mode'].'/'.$_GET['size'].'/');
	chmod('thumb/'.$_GET['mode'].'/'.$_GET['size'].'/', 0775);
} 


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $img);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec ($ch);
curl_close ($ch); 
 
$file = fopen($savefile, "w+");
fputs($file, $data);
fclose($file);


    

require_once ( 'class.image.php' ); 
$imageTransform->view($savefile,$_GET['mode'], $savefile, $_GET['size']);
 
?>
