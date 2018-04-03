<?php
/**
 * @Project ID BNC
 * @File /includes/global.php
 * @Author Quang Chau Tran (quangchauvn@gmail.com)
 * @Createdate 09/03/2014, 10:43 AM
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
include(DIR_ROOT.'config/config.php'); 
include(DIR_CLASS."model.php");    
include(DIR_CLASS."db/mysqliDB.php");  
include(DIR_CLASS."request.php");    
include(DIR_CLASS."template.php");
include(DIR_CLASS."ibnc.php");                     
// include(DIR_CLASS."cache.php");                       
include(DIR_CLASS."MobileDetect.php");                       
include(DIR_FUNS."global.php");        
//default time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');   
session_start();  
ob_start(); 

$_B['url'] 		= curPageURL();  
$iBNC 			= new iBNC();   
$_B['time'] 	= time();  
 
$page 	= $_B['r']->get_string('page','GET'); 

if( empty($page)){
	$page = 'anvui'; 
}
if( $_SERVER['HTTP_HOST'] == 'admin.anvui.vn'){
	$page = 'phanmem'; 
}

$_B['ios'] = $_B['android'] = false;
$detect = new Mobile_Detect;
if($detect->isMobile()){
	if( $detect->isIphone() ){
		$_B['ios'] = true; 
	}
	else
	{
		$_B['android'] = true; 
	}
} 

include(DIR_MOD.$page.'/main.php'); 

$iBNC = new $page();
$iBNC->end();