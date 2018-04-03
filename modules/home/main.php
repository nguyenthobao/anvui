<?php
/**
 * @Project ID BNC
 * @File /modules/home/main.php
 * @Author Quang Chau Tran (quangchauvn@gmail.com)
 * @Createdate 09/04/2014, 02:19 PM
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
class Home extends iBNC{ 
	protected $uid = false;
	public function __construct(){ 
		global $_B;     
		$this->r = $_B['r']; 
		$sub = $this->r->get_string('sub','GET');  
		if(method_exists($this, $sub)){
			$this->$sub();  
		}else if( file_exists(DIR_MOD.'home/'.$sub.'.php') ){
			include(DIR_MOD.'home/'.$sub.'.php');
		}else{ 
			$this->index();
		}
	}   
	function index(){   
		$this->send($data,'html','index');
	}
}