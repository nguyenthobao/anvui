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

class Admin extends iBNC{ 
	public function __construct(){ 
		global $_B;
		$config1['admin_username'] = "anvui";
		$config1['admin_password'] = "homnaytroidep";

		      
		if (!($_SERVER['PHP_AUTH_USER'] == $config1['admin_username'] && $_SERVER['PHP_AUTH_PW'] == $config1['admin_password']) ) {
		    header("WWW-Authenticate: Basic realm=\"anvui.vn\"");
		    header("HTTP/1.0 401 Unauthorized");
		    echo 'Dien thong tin tai khoan va mat khau de truy cap'; 
		    exit();
		}
		$this->data = array();

		$infoM = $this->getModel('av_info');
		$this->data['info'] = $infoM->get();


		$this->r = $_B['r'];      
		$sub = $this->r->get_string('sub','GET');
		if(method_exists($this, $sub)){
			$this->$sub();
		}
		else{
			$this->index();
		}
	}
	public function index(){ 
		$this->send($this->data,'html','admin_index');
	}
	public function media(){
		$data = array();

		$this->send($data,'html','admin_media');
	}
	 
	 public function banner(){

	 	$this->send($data,'html','admin_banner');
	 }
	//news
	public function news(){  
		global $_B;

		$news = $this->getModel('av_news'); 
		$news->orderBy('id','DESC');
		$start = 0;
		$limit = 20;

		$page = $this->r->get_int('p','GET');
		if($page){ 
			$start = ($page - 1) * $limit;
			$this->data['page'] = $page;
		}
		$this->data['start'] = $start;
		$this->data['pages'] = array(1,2,3,4,5,6,7,8,9,10);
		$this->data['news'] = $news->get(null,array($start,$limit));
		foreach ($this->data['news'] as $key => &$value) {
			$value['link'] = $_B['home'].fixTitle($value['title']).'-'.$value['id'].'.html';
		}
		$this->send($this->data,'html','admin_news');
	}
	public function addnews(){ 
		$id = $this->r->get_int('id');

		if(isset($_POST['act']) && $_POST['act'] == 'add' ){
			$this->add_news();
			header("Location: http://anvui.vn/admin/news");
		}  
		if(isset($_POST['act']) && $_POST['act'] == 'edit' ){
			$this->edit_news();
			header("Location: http://anvui.vn/admin/news");
		}  
		if($id){
			$a = $this->getModel('av_news');
			$a->where('id',$id);
			$this->data['news'] = $a->getOne(); 
		} 
		$this->send($this->data,'html','admin_addnews');
	} 
	public function newsdel(){
		$id = $this->r->get_int('id');

		if($id){
			$a = $this->getModel('av_news');
			$a->where('id',$id);
			$a->delete();
		}
		
		header("Location: /admin/news");
		
	}
	private function edit_news(){ 
 

		include(DIR_HELPER_UPLOAD); 
		$upload = new BncUpload();
		$id = $this->r->get_int('id','POST'); 
		$img_old = $this->r->get_string('img_old','POST');

		$img = $upload->upload(1,'adv','img');  

 	 
		$data['brief_content'] = $this->r->get_string('brief_content','POST'); 
		$data['title'] = $this->r->get_string('title','POST'); 
		$data['content'] = $this->r->get_string('content','POST');   
		if($img){ 
	 		$data['img'] = $img;  
		}
		else
		{ 
			$data['img'] = $img_old; 
		} 
		if($id){
			$adv = $this->getModel('av_news');
			$adv->where('id',$id); 
			$adv->update($data); 
		}
		

	} 
	private function add_news(){
		include(DIR_HELPER_UPLOAD); 
		$upload = new BncUpload(); 
		$img1 = $upload->upload(1,'adv','img');  
		 


		$data['title'] = $this->r->get_string('title','POST');
		$data['brief_content'] = $this->r->get_string('brief_content','POST'); 
		$data['content'] = $this->r->get_string('content','POST');   
		$data['time'] = time();  
 		$data['img'] = $img1;  

		 

			
	
		$adv = $this->getModel('av_news');
		$adv->insert($data);  

	}
	public function newsadd(){ 
		$id = $this->r->get_int('id');

		if(isset($_POST['act']) && $_POST['act'] == 'edit' ){
			$this->news_edit();
			header("Location: http://anvui.vn/admin/newsadd?id=".$id);
		}   
		if($id){
			$a = $this->getModel('av_info');
			$a->where('id',$id);
			$this->data['news'] = $a->getOne(); 
		} 
		$this->send($this->data,'html','admin_newsadd');
	}   
	private function news_edit(){ 
 

		include(DIR_HELPER_UPLOAD); 
		$upload = new BncUpload();
		$id = $this->r->get_int('id','POST'); 
		$img_old = $this->r->get_string('img_old','POST');

		$img = $upload->upload(1,'adv','img');  

 	 
		$data['desc'] = $this->r->get_string('desc','POST'); 
		$data['link'] = $this->r->get_string('link','POST'); 
		$data['content'] = $this->r->get_string('content','POST');  
		 

	 

 

		if($img){ 
	 		$data['avatar'] = $img;  
		}
		else
		{ 
			$data['avatar'] = $img_old; 
		}

	 
		if($id){
			$adv = $this->getModel('av_info');
			$adv->where('id',$id); 
			$adv->update($data); 
		}
		

	} 

}