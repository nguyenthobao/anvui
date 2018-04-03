<?php 
/**
 * @Project iBNC
 * @File /index.php
 * @Author Quang Chau Tran (quangchauvn@gmail.com)
 * @Createdate 29/07/2015
 */    
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1); 
 

header("Access-Control-Allow-Origin: *"); 
define('BNC_CODE', TRUE);
define('DIR_ROOT',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('DIR_CONFIG',DIR_ROOT.'config/');
define('DIR_TMP',DIR_ROOT.'tmp/');
define('DIR_THEME',DIR_ROOT.'themes/');
define('DIR_CLASS',DIR_ROOT.'includes/class/');
define('DIR_BK',DIR_ROOT.'includes/baokim/');
define('DIR_MODEL',DIR_ROOT.'model/');
define('DIR_DATA',DIR_ROOT.'includes/data/');
define('DIR_MOD',DIR_ROOT.'modules/'); 
define('DIR_LANG',DIR_ROOT.'lang/');
define('DIR_FUNS',DIR_ROOT.'includes/functions/');
define('DIR_HELPER',DIR_ROOT.'includes/helper/');
define('DIR_VENDOR',DIR_ROOT.'includes/vendor/');
define('DIR_HELPER_UPLOAD',DIR_HELPER.'upload.helper/upload.client.php');
//End Define PATH
include(DIR_ROOT.'includes/global.php');
