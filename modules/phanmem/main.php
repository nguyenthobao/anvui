<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors',1);  
ini_set('display_startup_errors',1); 
/**
 * @Project ID BNC
 * @File /modules/home/main.php
 * @Author Quang Chau Tran (quangchauvn@gmail.com)
 * @Createdate 09/04/2014, 02:19 PM
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
} 

class Phanmem extends iBNC{ 
	public $u = array();
	public function __construct(){
	global $_B;  
		$_B['theme']				= 'admin';
		$_B['home_theme']			= '/themes/'.$_B['theme'].'/';  

		$this->data = array(); 
		$this->r = $_B['r'];         
		$sub = $this->r->get_string('sub','GET');

		$this->checkLogin();

		if( isset($_B['token']) ) 
			$this->token = $_B['token'];   


		if(empty($_B['u'])){
			$this->login();
		}
		elseif(method_exists($this, $sub)){ 
			$this->u = $_B['u'];
			$this->$sub();
		}
		else{
			$this->index();
		}
	} 
	function checkLogin(){
		global $_B;
		if(isset($_COOKIE['adminanvui'])){

			$cookie = decode($_COOKIE['adminanvui'],'qcvn');
			$cookie = base64_decode($cookie);
			$cookie = json_decode($cookie,1);

			// var_dump($cookie); die;
			if(
				isset($cookie['userId'])
			){
				$_B['u'] = $cookie;
				$_B['token'] = $_COOKIE['tokenapi'];
			}
		}
	}
	function thoat(){
		setcookie("adminanvui",'');
		header("Location: /");
	}

	///xe
	function themxe(){ 
		$act = $this->r->get_string('act');

		if(!empty($act)){
			$action  = 'themxe_'.$act;
			return $this->$action();
		}

		$this->data['type'] = $this->PostAnvui('https://dobody-anvui.appspot.com/seatmap/getlist',array('page'=>0,'count'=>10),$this->token);
		$this->data['type'] = $this->data['type']['results']['result'];

		// var_dump($this->data['type']); die;

		$this->send($this->data,'html','xe_add'); 
	}
	function suaxe(){ 
		$act = $this->r->get_string('act');

		if(!empty($act)){
			$action  = 'themxe_'.$act;
			return $this->$action();
		}

		$id = $this->r->get_string('id');
 
		$this->data['type'] = $this->PostAnvui('https://dobody-anvui.appspot.com/seatmap/getlist',array('page'=>0,'count'=>10),$this->token);
		$this->data['type'] = $this->data['type']['results']['result'];
 		
 		$res = $this->PostAnvui('https://dobody-anvui.appspot.com/vehicle/getlist',array('page'=>0,'count'=>100),$this->token);
		$listxe = $res['results']['result'];

		foreach ($listxe as $key => $value) {
			if( $value['vehicleId'] == $id ){
				$this->data['xe'] = $value;
			}
		}


		$this->send($this->data,'html','xe_edit'); 
	}
	function themxe_add(){
		$d['numberPlate'] = $this->r->get_string('numberPlate');
		$d['vehicleName'] = $this->r->get_string('vehicleName');
		$d['numberOfSeats'] = $this->r->get_int('numberOfSeats');
		$d['seatMapId'] = $this->r->get_string('seatMapId');

		// var_dump($d); die;

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/vehicle/create',$d,$this->token);
		
		// var_dump($rt); die;
		header("Location: /xe");
	}
	function themxe_edit(){
		$d['numberPlate'] = $this->r->get_string('numberPlate');
		$d['vehicleName'] = $this->r->get_string('vehicleName');
		$d['numberOfSeats'] = $this->r->get_int('numberOfSeats');
		$d['seatMapId'] = $this->r->get_string('seatMapId');
		$d['vehicleId'] = $this->r->get_string('vehicleId');

		// var_dump($d); die;

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/vehicle/update',$d,$this->token);
		
		// var_dump($rt); die;
		header("Location: /xe");
	}
	function xe(){
		$this->data['type1'] = $this->PostAnvui('https://dobody-anvui.appspot.com/vehicletype/getlist',array('page'=>0,'count'=>10),$this->token);
		$this->data['type1'] = $this->data['type1']['results']['result'];

		$this->data['type'] = array();

		foreach ($this->data['type1'] as $key => $value) {
			$this->data['type'][$value['vehicleTypeId']] = $value;
		}


		$this->data['map'] = $this->PostAnvui('https://dobody-anvui.appspot.com/seatmap/getlist',array('page'=>0,'count'=>10),$this->token);
		$this->data['map'] = $this->data['map']['results']['result'];
 


		$this->data['xe'] = $this->PostAnvui('https://dobody-anvui.appspot.com/vehicle/getlist',array('page'=>0,'count'=>10),$this->token);
		$this->data['xe'] = $this->data['xe']['results']['result'];
		$this->send($this->data,'html','xe_home'); 
	}
	///xe
	///tuyen
	function themben_add(){
		$d['pointName'] = $this->r->get_string('pointName'); 
		$d['address'] = $this->r->get_string('address'); 
		$d['latitude'] = $this->r->get_string('latitude'); 
		$d['longitude'] = $this->r->get_string('longitude'); 
		$d['pointType'] = $this->r->get_string('pointType'); 
		$d['province'] = $this->r->get_string('province'); 

		// var_dump($d); die;

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/point/create',$d,$this->token);
		
		// var_dump($rt); die;
		header("Location: /ben");
	}
	function themtuyenadd(){
		$d['listPointId'] = $this->r->get_array('listPointId');  
		$d['listTimeIntend'] = $this->r->get_array('listTimeIntend');  
		$d['listVehicleType'] = $this->r->get_array('listVehicleType');  
		$d['listPriceByVehicleType'] = $this->r->get_array('listPriceByVehicleType');  
		$d['routeName'] = $this->r->get_string('routeName');  
		$d['childrenTicketRatio'] = $this->r->get_string('childrenTicketRatio');  
		$d['mealPrice'] = $this->r->get_int('mealPrice');  

		if($d['mealPrice'] == 0){
			$d['mealPrice'] = -1;
		} 
		// var_dump($d); die;

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/route/create',$d,$this->token);
		
		var_dump($rt); die;
		header("Location: /ben");
	}
	function themben(){ 
		$act = $this->r->get_string('act');

		if(!empty($act)){
			$action  = 'themben_'.$act;
			return $this->$action();
		}
		$this->send($this->data,'html','tuyen_themben');
	}
	function themtuyen(){
		$act = $this->r->get_string('act');

		if(!empty($act)){
			$action  = 'themtuyen_'.$act;
			return $this->$action();
		}
		$this->send($this->data,'html','tuyen_themtuyen');
	}
	function listpoint(){
		$q = $this->r->get_string('term');
		$rt = $this->GetAnvui('https://dobody-anvui.appspot.com/web/point-getlist?page=0&count=10&searchWord='.urlencode($q));
		$data = array();
		foreach ($rt['results']['result'] as $key => $value) {
			$data[] = array(
				'label' => $value['pointName'],
				'value' => $value['pointName'],
				'id' => $value['pointId']
			); 
		}
		header('Content-Type: application/json');
		echo json_encode($data); 
		die;
	}
	function listxe(){
		$q = $this->r->get_string('term');

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/vehicletype/getlist',array('page'=>0,'count'=>10),$this->token);
		// $this->data['xe'] = $this->data['xe']['results']['result'];

		$data = array();
		foreach ($rt['results']['result'] as $key => $value) {
			$data[] = array(
				'label' => $value['vehicleTypeName'],
				'value' => $value['vehicleTypeName'],
				'id' => $value['vehicleTypeId']
			); 
		}
		header('Content-Type: application/json');
		echo json_encode($data); 
		die;
	}
	function tuyen(){ 
		// https://dobody-anvui.appspot.com/route/getlist
		$res = $this->PostAnvui('https://dobody-anvui.appspot.com/route/getlist',array('page'=>0,'count'=>100),$this->token);
		$this->data['tuyen'] = $res['results']['result'];
		$this->send($this->data,'html','tuyen_home'); 
	}
	function ben(){ 
		// var_dump($this->u); die;
		$res = $this->PostAnvui('https://dobody-anvui.appspot.com/point/getlist',array('page'=>0,'count'=>10),$this->token);
		$this->data['ben'] = $res['results']['result'];
 
		$this->send($this->data,'html','tuyen_ben'); 
	}
	///tuyen 
	///laixe 
	function adduser(){
		$act = $this->r->get_string('act');

		if(!empty($act)){
			$action  = 'adduser_'.$act;
			return $this->$action();
		}

		$this->send($this->data,'html','laixe_add'); 
	}
	function edituser(){
		$act = $this->r->get_string('act');
		$id = $this->r->get_string('id');

		if(!empty($act)){
			$action  = 'edituser_'.$act;
			return $this->$action();
		}
		$res = $this->PostAnvui('https://dobody-anvui.appspot.com/user/getuserinfo',array('userId'=>$id),$this->token);
		$this->data['user'] = $res['results']['userInfo'];

		$this->send($this->data,'html','laixe_edi'); 
	}
	function edituser_edit(){
		$d['stateCode'] = $this->r->get_string('stateCode');  
		$d['userType'] = $this->r->get_int('userType');  
		$d['phoneNumber'] = $this->r->get_string('phoneNumber');  
		$d['userName'] = $this->r->get_string('userName');  
		$d['fullName'] = $this->r->get_string('fullName');  
		$d['password'] = $this->r->get_string('password');  
		if($d['password']){
			usset($d['password']);
		}
		$d['userId'] = $this->r->get_string('userId');  

		// var_dump($d); die;

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/user/updateinfo',$d,$this->token);
		
		if( $rt['code'] == 500 ){
			// var_dump($rt); die;
			$_SESSION['error'] = $rt['results']['error']['propertyName'];
			header("Location: /edituser?id=".$d['userId']);
		}
		else
		{
			// var_dump($rt); die;
			header("Location: /laixe");
		}
		
	}
	function adduser_add(){
		$d['stateCode'] = $this->r->get_string('stateCode');  
		$d['userType'] = $this->r->get_int('userType');  
		$d['phoneNumber'] = $this->r->get_string('phoneNumber');  
		$d['userName'] = $this->r->get_string('userName');  
		$d['fullName'] = $this->r->get_string('fullName');  
		$d['password'] = $this->r->get_string('password');  

		// var_dump($d); die;

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/user/staff-register',$d,$this->token);
		
		if( $rt['code'] == 500 ){
			// var_dump($rt); die;
			$_SESSION['error'] = $rt['results']['error']['propertyName'];
			header("Location: /adduser");
		}
		else
		{
			// var_dump($rt); die;
			header("Location: /laixe");
		}
		
	}

	function laixe(){
		
		$res = $this->PostAnvui('https://dobody-anvui.appspot.com/user/getlist',array('userType'=>2),$this->token);
		$this->data['laixe'] = $res['results']['result'];

		// var_dump($this->data['laixe']); die;
		$this->send($this->data,'html','laixe_home'); 

	}
	///laixe 
	function index(){
		$this->send($this->data,'html','home'); 	
	}
	function login(){
		$act = $this->r->get_string('act');

		if($act == 'login'){

			$d['userName'] = $this->r->get_string('userName');
	        $d['password'] = $this->r->get_string('password');
	        $rt = $this->PostAnvui('https://dobody-anvui.appspot.com/user/rlogin',$d);
 
	        if($rt['code'] == 200 ){ 
	        	setcookie("adminanvui",encode(base64_encode(json_encode($rt['results']['userInfo'])),'qcvn'));
	        	setcookie("tokenapi",$rt['results']['token']['tokenKey']);
	            // var_dump($rt['results']['userInfo']);
	        } else { 
	            $this->data['error']  = 'Thông tin không chính xác';
	        }
		}

		$this->send($this->data,'html','login');
		
	}
	public function PostAnvui($url,$data,$token=null){
        if(empty($token)){
            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ2IjowLCJkIjp7InVpZCI6IkFETTExMDk3Nzg4NTI0MTQ2MjIiLCJmdWxsTmFtZSI6IkFkbWluIHdlYiIsImF2YXRhciI6Imh0dHBzOi8vc3RvcmFnZS5nb29nbGVhcGlzLmNvbS9kb2JvZHktZ29ub3cuYXBwc3BvdC5jb20vZGVmYXVsdC9pbWdwc2hfZnVsbHNpemUucG5nIn0sImlhdCI6MTQ5MjQ5MjA3NX0.PLipjLQLBZ-vfIWOFw1QAcGLPAXxAjpy4pRTPUozBpw';
        }
        $request_header = [
            'Content-Type:text/plain',
            sprintf('DOBODY6969: %s', $token)
        ];

        $ch = curl_init();

     
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_header);
 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);

        curl_close ($ch); 
        // return  $response;
        return json_decode($response,1);
    }
    public function GetAnvui($url,$token=null){
        if(empty($token)){
            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ2IjowLCJkIjp7InVpZCI6IkFETTExMDk3Nzg4NTI0MTQ2MjIiLCJmdWxsTmFtZSI6IkFkbWluIHdlYiIsImF2YXRhciI6Imh0dHBzOi8vc3RvcmFnZS5nb29nbGVhcGlzLmNvbS9kb2JvZHktZ29ub3cuYXBwc3BvdC5jb20vZGVmYXVsdC9pbWdwc2hfZnVsbHNpemUucG5nIn0sImlhdCI6MTQ5MjQ5MjA3NX0.PLipjLQLBZ-vfIWOFw1QAcGLPAXxAjpy4pRTPUozBpw';
        }
        $request_header = [
            'Content-Type:application/json',
            sprintf('DOBODY6969: %s', $token)
        ];
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_header);

        $response = curl_exec($ch);
        return json_decode($response,1);
    }
}