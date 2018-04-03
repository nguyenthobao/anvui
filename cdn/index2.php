<?php
/**
 * @Project BNC v2 -> Upload
 * @File /index2.php
 * @Author Ba Huong Nguyen (nguyenbahuong156@gmail.com)
 * @Createdate 16/12/2014, 11:49 [AM]
 */

$mtime = explode(' ', microtime());  
$_QC['timestamp'] = $mtime[1];

$data = $_GET['data'];
$data = base64_decode($data);
$data = json_decode($data,true);
$_NBH['part'] = 'upload/';
$return = array(
	'status'=>false
	);
//$data['idw'] = $_GET['w'];
if (!empty($data['idw'])) {
	$mods = array('image','flash','audio','document');
	$mod = $data['type_file'];
	if ($data['type_file']=='audio'||$data['type_file']=='flash') {
		$_NBH['part'] .= 'media/'.$data['type_file'].'/'.$data['idw'];
		if (!is_dir($_NBH['part'])) {
			mkdir($_NBH['part']);
			chmod($_NBH['part'],0775);
		}
		$_NBH['part'] .= '/';
	}
	else if($data['type_file']=='img'){
		$first = substr($data['idw'],0,2);
		$date = date("Y/m/d/h/i");
		$_NBH['part'] .= 'web/' . $first .'/'. $data['idw'] .'/'. $data['module'] .'/'. $date;
		$mod = 'imagev2';
	}
	
	if(empty($mod) || !in_array($mod, $mods))
		$mod = 'imagev2';
	include 'mod/'.$mod.'.php';
	//name field upload

} else
$return['error'] = 'no idw'; 


$json = json_encode($return);
header('Content-type: application/json');
exit($json);

