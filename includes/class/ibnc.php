<?php
/**
 * @Project iBNC
 * @File /includes/class/ibnc.php
 * @Author Quang Chau Tran (quangchauvn@gmail.com)
 * @Createdate 29/07/2015
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
class iBNC{
	protected $r;
	protected $input = array();
	protected $output = array();
	protected $output_type;
	protected $output_view;
	protected $mysql_db = null;
	protected $mysql_models = array();
	public $name_cookie = 'ttatgt';
	public $status = array(
		0 => 'Mới đặt lịch',
		1 => 'Đã xác minh khách hàng',
		2 => 'Đã thực hiện dịch vụ',
		3 => 'Đã huỷ dịch vụ'
	);
	public function __construct(){   
	}
	/**
	 * Gửi dữ liệu để trả về cho client
	 */
	protected function send($output=array(),$output_type='html',$output_view='index'){
		$this->output_type = $output_type;
		$this->output_view = $output_view;
		$this->output = $output;
	}


	protected function Model($name){
		$class = $name.'Class';
		if (!class_exists($class)) {
		    include(DIR_MODEL .$name . '.php');
		} 
		return new $class();
	}
 
	/**
	 * Tra ve Model
	 */
	protected function getModel($name,$db_name='df',$type='mysql'){
		$type_model = 'getModel_'.$type;
		return $this->$type_model($name,$db_name);
	}
	/**
	 * Tra ve Model Mysql
	 */
	private function getModel_mysql($name,$db_name){ 
		if( !isset($this->mysql_db[$db_name]) || $this->mysql_db[$db_name] == null){
			$this->mysql_db[$db_name] = db_connect($db_name);
		} 

		if( isset($this->mysql_models[$db_name]) && array_key_exists($name,$this->mysql_models[$db_name]) ){
			return $this->mysql_models[$db_name][$name];
		}
		else{
			$this->mysql_models[$db_name][$name] = new Model($this->mysql_db[$db_name],$name);
			return $this->mysql_models[$db_name][$name];
		} 
	}
	/**
	 * Nơi cuối con đường 
	 */
	public function end(){
		global $_B;
		switch ($this->output_type) {
			case 'html':
				$common = $this->getCommon(); 
				$data = $this->output; 
				$temp = new Template();
				include $temp->load($this->output_view);
				break;
			case 'js':
				header("Content-Type: application/javascript");
				$common = $this->getCommon(); 
				$data = $this->output; 
				$temp = new Template();
				include $temp->load($this->output_view);
				break;
			case 'json':
				$common = $this->getCommon(); 
				$data = $this->output; 
				header('Content-Type: application/json');
				echo json_encode($data); 
				break;
			
			default:
				// die();
				break;
		}
		if( isset($_B['id_log']) && $_B['id_log'] != 0){
			$log = $this->getModel('log');
			$log->where('id',$_B['id_log']);
			$d['response'] = json_encode($data);
			$d['error'] = $_B['errormes'];
			$log->update($d);
		}

		die();
		//cache or anything here :))))
	}
	private function getCommon(){ 
		return array();
	} 
	 
	protected function error($mess,$code=99999){ 
		$this->data = array(
			'status'=>false,
			'code'=>$code,
			'mes'=>$mess
		); 
		$this->send($this->data,'json');
		$this->end();
	}
	protected function success($data){
		$this->data = array(
			'status'=>true, 
			'response'=>$data
		);
		$this->send($this->data,'json'); 
		$this->end();
	}  

	public function getContent()
	{ 
	   parse_str(file_get_contents('php://input'), $content);  
	  return $content;
	}
	protected function validate($value,$type='email'){
		if( is_array($type) ){
			foreach ($type as $k => $v) {
				if( $this->validateType($value,$v) )
					return true;
			}
			return false;
		}
		else
		{
			return $this->validateType($value,$type);

		}
	}
	protected function curl_post($url,$data){
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		return curl_exec($handle); 
	}
}









