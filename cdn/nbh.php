<?php

/**
 * @Project BNC v2 -> Delete Image
 * @File /nbh.php
 * @Author Ba Huong Nguyen (nguyenbahuong156@gmail.com)
 * @Createdate 2014/12/17, 11:16 [ AM]
 */
$username = 'banlamgiday';
$pass     = 'toimuonxoaanh@123!';
$json = array('status'=>false);
if (!(isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'] == $username && $_SERVER['PHP_AUTH_PW'] == $pass)) {
    header("WWW-Authenticate: Basic realm=\"Than ai va chao quyet thang\"");
    header("HTTP/1.0 401 Unauthorized");
    $json['error'] = 'Dien thong tin tai khoan va mat khau de truy cap';
}else{
	$links = base64_decode($_POST['link']);
	$links = json_decode($links);
	
	if (is_array($links)) {
		foreach ($links as $v) {
			@unlink($v);
		}
	}else{
		@unlink($links);
	}
	$json['status'] = true;
	// $file_log = 'web/1/1/log.php';
	// $file_log = 'uploadv2/logs/'.$file_log;
	// include_once('log.php');
	// writeLog($file_log,$mess);
	
}

header('Content-type: application/json');
exit($json);