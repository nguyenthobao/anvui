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
class Anvui extends iBNC{ 
	protected $uid = false;
	public function __construct(){ 
		global $_B;     
		$this->r = $_B['r']; 
		$sub = $this->r->get_string('sub','GET');  


		$this->data['bannerhome'] = $this->getModel('av_info')->where('id',9)->getOne();
		$this->data['bannertin'] = $this->getModel('av_info')->where('id',10)->getOne();


		$this->data['hottrip'] = $this->getHotTrip();
		$this->data['topnews'] = $this->topnews();

		$infoM = $this->getModel('av_info');
		$infoM->where('id',6);
		$this->data['footer'] = $infoM->getOne();

		$infoM = $this->getModel('av_info');
		$infoM->where('id',8);
		$this->data['adsdv'] = $infoM->getOne();

		$this->data['date'] = date('d-m-Y');
		if(method_exists($this, $sub)){
			$this->$sub();  
		}else if( file_exists(DIR_MOD.'home/'.$sub.'.php') ){
			include(DIR_MOD.'home/'.$sub.'.php');
		}else{ 
			$this->index();
		}
	}  
	function order(){
		$phoneNumber   = $this->r->get_string('phoneNumber', 'POST');
		$fullName   = $this->r->get_string('fullName', 'POST');
		
		$_POST['ticketStartDate'] = $_POST['getInTimePlan'];

		$rt = $this->PostAnvui('https://dobody-anvui.appspot.com/web/ticket-order',$_POST);
		header('Content-Type: application/json');
		echo json_encode($rt); 
		die;
	}
	function datvessl(){
		$tripId = $_GET['tripId']; 
		$scheduleId = $_GET['scheduleId'];
		$res = $this->GetAnvui('http://demo.nhaxe.vn/dat-ve?tripId='.$tripId.'&scheduleId='.$scheduleId); 
		header('Content-Type: application/json');
		echo json_encode($res); 
		die;
	}
	function test(){
		die;
		$web = $this->getModel('web')->orderBy('idw')->get();

		echo '<table>';
		foreach ($web as $key => $value) {
			echo '<tr> 
			<td>+84. '. $value['phone'] .'</td> 
			</tr>';
		}
		echo '</table>';
		die;
		// foreach ($web as $key => $value) {
		// 	$s_name = str_replace('(', '-', $value['s_name']);
		// 		$s_name = str_replace(')', '', $s_name);
		// 		// var_dump($value['idw']); die;
		// 		$this->getModel('web')->where('idw',$value['idw'])->update(array('s_name'=>$s_name));
		// }
		// die;
		// // http://nhaxe.vn/?mod=ajax&action=copyall&idw=1576&s_name=haquang
		// $web = $this->getModel('web')->where('idw',1576,'>')->get();

		// foreach ($web as $key => $value) { 
		// 	$url = 'http://nhaxe.vn/?mod=ajax&action=copyall&idw='.$value['idw'].'&s_name='.$value['s_name'];
		// 	file_get_contents($url);
		// 	// var_dump($url); die;
		// 	echo $url .' <br/>';
		// }

	}
	function test111(){
		die;
		$res = $this->GetAnvui('https://dobody-anvui.appspot.com/web/company-getlist-all?web=1&page=0&count=2000');

		$company = $res['results']['listCompany'];

		// echo '<pre>';
		foreach ($company as $key => $value) {
			$w = array();
 
			$w['s_name'] = $value['userContact']['userName'];
			$w['phone'] = $value['userContact']['phoneNumber'];
			$w['userId'] = $value['userId'];
			$w['anvui_id'] = $value['companyId'];
			$w['w_name'] = $value['companyName']; 

			// var_dump($w);
			// var_dump($value);
			 // die;
			$this->getModel('web1')->insert($w);
		} 

	}
	function newsdetail(){
		$id = $this->r->get_int('id');
		$infoM = $this->getModel('av_news');
		$infoM->where('id',$id);
		$this->data['new'] = $infoM->getOne();
		
		$this->data['new']['img'] = 'http://anvui.vn/cdn/'.$this->data['new']['img'];
		$this->data['new']['time'] = date("d/m/Y",$this->data['new']['time']);
		$this->data['new']['link'] = 'http://anvui.vn/'.fixtitle($this->data['new']['title']).'-'.$this->data['new']['id'].'.html';

		$this->send($this->data,'html','newsdetail');
	}
	function news(){
		$p = $this->r->get_int('p');
		$p = (empty($p))?1:$p;
		$limit = 10;
		$start = ($p-1)*$limit;

		$this->data['pagenow'] = $p;
		$this->data['pagenext'] = $p+1;

		if($p > 1)
			$this->data['pagepre'] = $p-1;

		$newsM = $this->getModel('av_news');
		$newsM->orderBy('id','DESC');
		$this->data['news'] = $newsM->get(null,array($start,$limit));


		if( count($this->data['news']) < 10 ){
			$this->data['pagenext'] = 0;
		}
		foreach ($this->data['news'] as $key => &$value) {
			$value['img'] = 'http://anvui.vn/cdn/'.$value['img'];
			$value['time'] = date("d/m/Y",$value['time']);
			$value['link'] = 'http://anvui.vn/'.fixtitle($value['title']).'-'.$value['id'].'.html';
		}

		$this->send($this->data,'html','news');
	} 
	function nhaxe(){
		global $_B;
		$p = $this->r->get_int('p');
		$p = (empty($p))?1:$p;
		$limit = 10;
		$start = ($p-1)*$limit;

		$this->data['pagenow'] = $p;
		$this->data['pagenext'] = $p+1;

		if($p > 1)
			$this->data['pagepre'] = $p-1;

		
		$webM = $this->getModel('web');
		$infoM = $this->getModel('vi_information','information');
		$templateM = $this->getModel('vi_logo','template');
		$webM->where('anvui_id',NULL, 'IS NOT');
		$webM->where('home_anvui',1);
		$webM->orderBy('idw','ASC');

		$this->data['webs'] = $webM->get(null,array($start,$limit));
 		
 		if( count($this->data['webs']) < 10 ){
			$this->data['pagenext'] = 0;
		}

 		foreach ($this->data['webs'] as $key => &$value) {
 			$infoM->where('idw',$value['idw']);

 			$info = $infoM->getOne();
 			$value['avatar'] = $_B['cdn'].$info['img'];

 			// $value['desc'] = 'Sàn quản lý vận tải ANVUI là đơn vị xây dựng giải pháp Công nghệ thông tin quản lý tổng thể cho doanh nghiệp vận tải với sứ mệnh: “Đưa công nghệ Hỗ trợ nhà vận tải nâng cao năng lực cạnh tranh để mỗi chuyến đi đều An Vui!”. Lần đầu tiên có mặt tại Việt Nam sàn vận tải ANVUI đang có rất nhiều các chính sách hỗ trợ và trợ giúp các nhà xe như: Tặng website chuyên nghiệp cho nhà xe, Tặng phần mềm quản lý bán vé, Hỗ trợ bán vé cho nhà xe…';
 			$value['desc'] = $info['meta_description'];
 			if( empty($value['w_name']) ) $value['w_name'] = 'Nhà xe: '.$value['s_name'];
 			 
 		}

		$this->send($this->data,'html','nhaxe');
	} 
	function topnews(){ 
		$newsM = $this->getModel('av_news');
		$newsM->orderBy('id','DESC');
		$news = $newsM->get(null,array(0,5));

		foreach ($news as $key => &$value) {
			$value['img'] = 'https://anvui.vn/cdn/'.$value['img'];
			$value['time'] = date("d/m/Y",$value['time']);
			$value['link'] = 'http://anvui.vn/'.fixtitle($value['title']).'-'.$value['id'].'.html';
		}

		return $news;
	} 
	function gioithieu(){
		$infoM = $this->getModel('av_info');
		$infoM->where('id',1);
		$this->data['info'] = $infoM->getOne();
		$this->send($this->data,'html','gioithieu');
	}  
	function phanmem(){
		$infoM = $this->getModel('av_info');
		$infoM->where('id',2);
		$this->data['info'] = $infoM->getOne();

		$this->send($this->data,'html','phanmem');
	} 
	function csbm(){
		$infoM = $this->getModel('av_info');
		$infoM->where('id',3);
		$this->data['info'] = $infoM->getOne();
		$this->send($this->data,'html','csbm');
	}
	function dksd(){
		$infoM = $this->getModel('av_info');
		$infoM->where('id',5);
		$this->data['info'] = $infoM->getOne();
		$this->send($this->data,'html','dksd');
	}
	function cshd(){
		$infoM = $this->getModel('av_info');
		$infoM->where('id',4);
		$this->data['info'] = $infoM->getOne();
		$this->send($this->data,'html','cshd');
	}
	function index(){ 
		global $_B;  
		$webM = $this->getModel('web');
		$infoM = $this->getModel('vi_information','information');
		$templateM = $this->getModel('vi_logo','template');

		// $web->join('vi_logo','web.idw = vi_logo','LEFT');

		$webM->where('anvui_id',NULL, 'IS NOT');
		$webM->where('home_anvui',1);
		$webM->orderBy('idw','DESC');

		$this->data['webs'] = $webM->get();
 		
 		foreach ($this->data['webs'] as $key => &$value) {
 			$info = array();
 			$infoM->where('idw',$value['idw']);

 			$info = $infoM->getOne();
 			$value['avatar'] = $_B['cdn'].$info['img'];
 			$value['info'] = $info;
 			// $value['desc'] = 'Sàn quản lý vận tải ANVUI là đơn vị xây dựng giải pháp Công nghệ thông tin quản lý tổng thể cho doanh nghiệp vận tải với sứ mệnh: “Đưa công nghệ Hỗ trợ nhà vận tải nâng cao năng lực cạnh tranh để mỗi chuyến đi đều An Vui!”. Lần đầu tiên có mặt tại Việt Nam sàn vận tải ANVUI đang có rất nhiều các chính sách hỗ trợ và trợ giúp các nhà xe như: Tặng website chuyên nghiệp cho nhà xe, Tặng phần mềm quản lý bán vé, Hỗ trợ bán vé cho nhà xe…';
 			$value['desc'] = $info['meta_description'];
 			if( empty($value['s_name']) ) $value['w_name'] = 'Nhà xe: '.$value['s_name'];
 			// $logo = $templateM->where('idw',$value['idw'])
 										// ->getOne();
 			// $value['avatar'] = $_B['cdn'].$logo['img'];
 		}

 		

		$this->send($this->data,'html','index');
	}
	function getHotTrip(){
		$tripM = $this->getModel('trip_city');
		$tripM->where('begin',0);
		$trip = $tripM->get();

		$rt = array();

		foreach ($trip as $key => $value) {
			$tripM->where('begin',$value['id']);
			$value['trip'] = $tripM->get();
			$rt[] = $value;

			// $res = $this->GetAnvui('https://dobody-anvui.appspot.com/web/route-getlist-by-province?page=0&count=10&startProvince='.urlencode($value['name']));
			// $res = $this->GetAnvui('https://dobody-anvui.appspot.com/web/route-getlist-by-province?page=0&count=10&start='.urlencode($value['name']));


			// echo '<pre>';
			// var_dump($res);
			// die;
			// $value['trip'] = $res['results']['route'];
			// if( count($value['trip']) > 0 ) $rt[]  = $value;


		}

		return $rt;
	}
	function datve(){

		$this->data['hottrip'] = $this->getHotTrip();
		$this->data['date']  = $this->r->get_string('date', 'GET');
		$this->data['startPointId']  = $this->r->get_string('startPointId', 'GET');
		$this->data['endPointId']  = $this->r->get_string('endPointId', 'GET');
		$this->data['endPoint']  = $this->r->get_string('endPoint', 'GET');
		$this->data['startPoint']  = $this->r->get_string('startPoint', 'GET');
		$this->data['begin'] = false;
		if(empty($this->data['date'])){
			$this->data['date'] = date('d-m-Y');
		}

		if(
			empty($this->data['startPoint'])
			&& empty($this->data['endPoint'])
			){

			$this->data['begin'] = true;
			return $this->send($this->data,'html','datve');
			die;
		} 



		$date = explode('-', $this->data['date']);
		$datetimestamp = (mktime(0,0,0,(int)$date[1],(int)$date[0],(int)$date[2]) + 60*60*24 ) * 1000;
		
		// var_dump($data); die;
		if(
			empty($this->data['startPointId'])
			|| empty($this->data['endPointId']) //lay tuyen theo tinh
			|| substr($this->data['startPointId'],0,2) != 'PT'
			|| substr($this->data['endPointId'],0,2) != 'PT'
		){
			
			$rt = $this->GetAnvui('https://dobody-anvui.appspot.com/web/find-schedule-like?page=0&count=10&start='.urlencode($this->data['startPoint']).'&end='.urlencode($this->data['endPoint']).'&date='.$datetimestamp);

			 

			// echo '<pre>'; var_dump($rt); die;
			$this->data['trips'] = $rt['results']['result'];

			$webM = $this->getModel('web');

			foreach ($this->data['trips'] as $key => &$value) {
				if($value['ticketPrice'] == -1) unset($this->data['trips'][$key]);
				$webM->where('anvui_id',$value['companyId']);
				$web = $webM->getOne();

				if(empty($web['s_name']) ){
					$web['s_name'] = 'demo';
				}
			
				$value['web'] ='http://'.$web['s_name'].'.nhaxe.vn/';
				$value['startTime'] = date('H:i',$value['getInTime']/1000);
				$value['endTime'] = date('H:i',$value['getOffTime']/1000);
				$value['processTime'] = date("H\hi",$value['time']/1000);
				$value['ticketPrice'] = number_format($value['ticketPrice']);
			}   

			// var_dump($this->data['trips']); die;
			return $this->send($this->data,'html','datve1');
			// end lay theo tinh
 		
		} else{ 
			$rt = $this->GetAnvui('https://dobody-anvui.appspot.com/web/find-schedule?page=0&count=10&startPointId='.$this->data['startPointId'].'&endPointId='.$this->data['endPointId'].'&date='.$datetimestamp.'&timeZone=7');
			// echo 'https://dobody-anvui.appspot.com/web/find-schedule?page=0&count=10&startPointId='.$this->data['startPointId'].'&endPointId='.$this->data['endPointId'].'&date='.$datetimestamp.'&timeZone=7';

			// echo '<pre>'; var_dump($rt); die;
			$this->data['trips'] = $rt['results']['result'];
		}
		$webM = $this->getModel('web');

		foreach ($this->data['trips'] as $key => &$value) {
				if($value['ticketPrice'] == -1) unset($this->data['trips'][$key]);
			$webM->where('anvui_id',$value['companyId']);
			$web = $webM->getOne();
			
			if(empty($web['s_name']) ){
					$web['s_name'] = 'demo';
				}

			$value['web'] ='http://'.$web['s_name'].'.nhaxe.vn/';
			$value['startTime'] = date('H:i',$value['getInTime']/1000);
			$value['endTime'] = date('H:i',$value['getOffTime']/1000);
			$value['processTime'] = date("H\hi",$value['time']/1000);
				$value['ticketPrice'] =  number_format($value['ticketPrice']);
		} 
		$this->send($this->data,'html','datve');
	}
	function point(){
		$q = $this->r->get_string('term');
		$rt = $this->GetAnvui('https://dobody-anvui.appspot.com/web/point-getlist?page=0&count=10&searchWord='.urlencode($q));
		$data = array();
		$i = 0;
		foreach ($rt['results']['result'] as $key => $value) {
			$i++;
			if($i > 10) break;
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
	function listSchedule(){
		$routeId = $this->r->get_string('routeId');
		$endPointId = $this->r->get_string('endPoint');
		$startPointId = $this->r->get_string('startPoint');
		$date = $this->r->get_string('timeStart');

 
 
		if(empty($date)){
			$date = date('d/m/Y');
		}
		$date = explode('-', $date);
		$datetimestamp = (mktime(0,0,0,(int)$date[1],(int)$date[0],(int)$date[2])  + 60*60*24 )* 1000;
 
		$url = 'https://dobody-anvui.appspot.com/web/find-schedule?page=0&count=10&timeZone=7&startPointId='.$startPointId.'&endPointId='.$endPointId.'&date='.$datetimestamp.'&routeId='.$routeId;
		 
		$rt= $this->GetAnvui($url);
		$data  = $rt['results']['result'];

		foreach ($data as $keysch => &$valuesch) {
			$valuesch['startTime'] = date('H:i d/m/Y',$valuesch['startTime']/1000);  
			$valuesch['link'] = 'http://'.$web['home'].'/dat-ve?tripId='.$valuesch['tripId']; 
			$valuesch['ticketPrice1'] = number_format($valuesch['ticketPrice']);
		}

		header('Content-Type: application/json');
		echo json_encode($data); 
		die; 
	}

    function listSchedule2(){
        $date = $_POST['date'];

        if(empty($date)){
            $date = date('d/m/Y');
        }
        $date = explode('-', $date);
        $_POST['date'] = (mktime(0,0,0,(int)$date[1],(int)$date[0],(int)$date[2]))* 1000;

        $url = 'https://dobody-anvui.appspot.com/schedule/find-schedule-for-user';

        $rt= $this->PostAnvui($url, $_POST, '', true);

        $data  = $rt['results']['result'];

        foreach ($data as $keysch => &$valuesch) {
            $valuesch['startTime'] = date('H:i d/m/Y',$valuesch['startTime']/1000);
            $valuesch['link'] = 'http://'.$web['home'].'/dat-ve?tripId='.$valuesch['tripId'];
            $valuesch['ticketPrice1'] = number_format($valuesch['ticketPrice']);
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        die;
    }

	function pointNX(){
		$routeId = $this->r->get_string('routeId');

		$beginOfDay = strtotime("midnight"); 
			$endOfDay   = strtotime("tomorrow", $beginOfDay) - 1;
			$res= $this->GetAnvui('https://dobody-anvui.appspot.com/web/route-view-by-id?page=0&count=10&routeId='.$routeId.'&startDate='.$beginOfDay.'&endDate='.$endOfDay);
	 		
	 		$rt['a1'] =$res['results']['listPoint'];
	 		$rt['a2'] =array_reverse($res['results']['listPoint']);
		 
	 		header('Content-Type: application/json');
		echo json_encode($rt); 
		die;
	}
	function chuyenAV(){ 

		$idAv = $this->r->get_string('idAV');
		$data['chuyen'] = $this->GetAnvui('https://dobody-anvui.appspot.com/web/route-getlist?page=0&count=10&companyId='.$idAv.'&version=0.1');
		$rt['chuyen'] = $data['chuyen']['results']['listRoute'];

	


		header('Content-Type: application/json');
		echo json_encode($rt); 
		die;
	}




	public function GetAnvuiDebug($url,$token){
        if(empty($token)){
            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ2IjowLCJkIjp7InVpZCI6IkFETTExMDk3Nzg4NTI0MTQ2MjIiLCJmdWxsTmFtZSI6IkFkbWluIHdlYiIsImF2YXRhciI6Imh0dHBzOi8vc3RvcmFnZS5nb29nbGVhcGlzLmNvbS9kb2JvZHktZ29ub3cuYXBwc3BvdC5jb20vZGVmYXVsdC9pbWdwc2hfZnVsbHNpemUucG5nIn0sImlhdCI6MTQ5MjQ5MjA3NX0.PLipjLQLBZ-vfIWOFw1QAcGLPAXxAjpy4pRTPUozBpw';
        }
        $request_header = [
            'Content-Type:application/json',
            sprintf('DOBODY6969: %s', $token)
        ];
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url.'&timeZone=7');
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_header);

        $response = curl_exec($ch);
        return $response;
    }
	public function GetAnvui($url,$token){
        if(empty($token)){
            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ2IjowLCJkIjp7InVpZCI6IkFETTExMDk3Nzg4NTI0MTQ2MjIiLCJmdWxsTmFtZSI6IkFkbWluIHdlYiIsImF2YXRhciI6Imh0dHBzOi8vc3RvcmFnZS5nb29nbGVhcGlzLmNvbS9kb2JvZHktZ29ub3cuYXBwc3BvdC5jb20vZGVmYXVsdC9pbWdwc2hfZnVsbHNpemUucG5nIn0sImlhdCI6MTQ5MjQ5MjA3NX0.PLipjLQLBZ-vfIWOFw1QAcGLPAXxAjpy4pRTPUozBpw';
        }
        $request_header = [
            'Content-Type:application/json',
            sprintf('DOBODY6969: %s', $token)
        ];
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url.'&timeZone=7');
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

    public function GetTW($url){
         
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30); 
 
        return $response;
    }

     public function PostAnvui($url,$data,$token,$isJson){
     	$data['timeZone'] = 7;
        if(empty($token)){
            $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ2IjowLCJkIjp7InVpZCI6IkFETTExMDk3Nzg4NTI0MTQ2MjIiLCJmdWxsTmFtZSI6IkFkbWluIHdlYiIsImF2YXRhciI6Imh0dHBzOi8vc3RvcmFnZS5nb29nbGVhcGlzLmNvbS9kb2JvZHktZ29ub3cuYXBwc3BvdC5jb20vZGVmYXVsdC9pbWdwc2hfZnVsbHNpemUucG5nIn0sImlhdCI6MTQ5MjQ5MjA3NX0.PLipjLQLBZ-vfIWOFw1QAcGLPAXxAjpy4pRTPUozBpw';
        }
        if($isJson) {
            $request_header = [
                'Content-Type:application/json',
                sprintf('DOBODY6969: %s', $token)
            ];
            $data = json_encode($data);
        } else {
            $request_header = [
                'Content-Type:application/x-www-form-urlencoded',
                sprintf('DOBODY6969: %s', $token)
            ];
            $data = http_build_query($data);
        }

        $ch = curl_init();

     
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_header);
 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec ($ch);

        curl_close ($ch); 
        return json_decode($response,1);
    }
}