<?php
/*
 * Upload for BNC
 * @version   1.0
 * @author    Quang Chau <quangchauvn@gmail.com>
 */

// config
$_QC['part'] = ($_GET['c']==1)?'upload/common':'upload/web';  
$mtime = explode(' ', microtime());  
$_QC['timestamp'] = $mtime[1];

$return = array(
	'status'=>false
	);
$data = $_GET['data'];
$data = base64_decode($data);
$data = json_decode($data,true);
//$data['idw'] = $_GET['w'];
if (!empty($data['idw'])) {
	//set data fo part
	$firt = substr($data['idw'],0,2);
	$module = (!empty($data['module']))?$data['module']:'common';
	$date = date("Y/m/d/h/i");  

	//set part
	$_QC['part'] .= '/' . $firt .'/'. $data['idw'] .'/'. $module .'/'. $date;

	$_QC['url'] = $_QC['part']. '/';

	 

	//default type upload
	$mods = array('image','file');
	$mod = $_GET['mod'];

	if(empty($mod) || !in_array($mod, $mods))
		$mod = 'image';

	//name field upload
	$name_field = (!empty($data['field']))?$data['field']:'file';

	include('mod/'.$mod.'.php');
} else
$return['error'] = 'no idw'; 


$json = json_encode($return);
header('Content-type: application/json');
exit($json);