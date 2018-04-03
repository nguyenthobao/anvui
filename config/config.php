<?php
/**
 * @Project ID BNC
 * @File /config/config.php
 * @Author Quang Chau Tran (quangchauvn@gmail.com)
 * @Createdate 09/03/2014, 10:49 AM
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}

$_B = array();

$_B['DB']['df']['db_host']				= '127.0.0.1';
$_B['DB']['df']['db_user']  			= 'sql_anvui';
$_B['DB']['df']['db_password'] 	 		= 'JPs2gdCcquRV7WpR_4jP';
$_B['DB']['df']['db_charset'] 			= 'utf8';
$_B['DB']['df']['db_name']  			= 'db_anvui';
$_B['DB']['df']['db_port']				=  3306; 

$_B['DB']['info']['db_host']				= '127.0.0.1';
$_B['DB']['info']['db_user']  			= 'sql_anvui';
$_B['DB']['info']['db_password'] 	 		= 'JPs2gdCcquRV7WpR_4jP';
$_B['DB']['info']['db_charset'] 			= 'utf8';
$_B['DB']['info']['db_name']  			= 'db_anvui_info';
$_B['DB']['info']['db_port']				=  3306; 

$_B['DB']['template']['db_host']     = '127.0.0.1';
$_B['DB']['template']['db_user']     = 'sql_anvui';
$_B['DB']['template']['db_password'] = 'JPs2gdCcquRV7WpR_4jP';
$_B['DB']['template']['db_charset']  = 'utf8';
$_B['DB']['template']['db_name']     = 'db_anvui_template';
$_B['DB']['template']['db_port']     = 3306;

$_B['DB']['information']['db_host']     = '127.0.0.1';
$_B['DB']['information']['db_user']     = 'sql_anvui';
$_B['DB']['information']['db_password'] = 'JPs2gdCcquRV7WpR_4jP';
$_B['DB']['information']['db_charset']  = 'utf8';
$_B['DB']['information']['db_name']     = 'db_anvui_Ad';
$_B['DB']['information']['db_port']     = 3306;


$_B['home'] 				= 'https://anvui.vn/';  
$_B['cdn'] 				= 'https://cdn.anvui.vn/';  
$_B['theme']				= '1';
$_B['home_theme']			= '/themes/'.$_B['theme'].'/';  
$_B['langs']				= array('vi','en');
$_B['lang_default']			= 'vi';   

?>