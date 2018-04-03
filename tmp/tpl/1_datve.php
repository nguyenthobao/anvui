<?php 
/**
 * @Project BNC v2 -> Adminuser
 * @File /data/www/superweb/anvui/tmp/tpl/1_datve.php 
 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AnVui.vn -  Đi an về vui</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="quangchauvn@gmail.com">
 <meta property="og:image" content="http://anvui.vn/cdn/media/1/AnhSEO/InfoANVUI.png">
 <meta property="og:description" content="Phần mềm quản lý điều hành bán vé thông minh hàng đầu tại Việt Nam lọt TOP 10 Nhân tài đất Việt 2017. Nhà xe tăng từ 10% đến 20% doanh thu bán vé sau khi hợp tác cùng AN VUI. Hotline: 19007034.">
 <meta property="og:image:type" content="image/png">
 <meta property="og:image:width" content="1200">
 <meta property="og:image:height" content="630">
 <meta property="og:image:alt" content="AnVui.vn - Đi an về vui">

        <!-- ================= Favicon ================== -->
        <!-- Standard -->
        <link rel="shortcut icon" href="favicon.png?v=1">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="favicon.png?v=1">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="favicon.png?v=1">
        <!-- Standard iPad Touch Icon--> 
        <link rel="apple-touch-icon" sizes="72x72" href="favicon.png?v=1">
        <!-- Standard iPhone Touch Icon--> 
        <link rel="apple-touch-icon" sizes="57x57" href="favicon.png?v=1">
    <!--CSS--> 
    <link href="<?=$_B['home_theme']?>libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="<?=$_B['home_theme']?>plugins/owl-carousel/carousel.css" rel="stylesheet" type="text/css"> 
    <link href="<?=$_B['home_theme']?>css/common.css?v=<?php echo time() ?>" rel="stylesheet" type="text/css">
    <link href="<?=$_B['home_theme']?>css/style.css" rel="stylesheet" type="text/css">
    <link href="<?=$_B['home_theme']?>css/mobile.css" rel="stylesheet" type="text/css">
     <script src="<?=$_B['home_theme']?>libs/jquery/1.12.3/jquery-1.12.3.min.js" type="text/javascript"></script>

     <style type="text/css">
#header{
    position: relative; 
    background: #000 url(<?=$_B['home']?>cdn/<?=$data['bannerhome']['avatar']?>);
    background-position: center top; 
}
     </style>
<?php if($_SERVER['HTTP_HOST'] == 'app.anvui.vn') { ?>
     <script type="text/javascript">

setTimeout(function(){
  <?php if($_B['ios']) { ?>
    window.location.href = 'https://itunes.apple.com/us/app/anvui-mua-v%C3%A9-xe-kh%C3%A1ch-online/id1263904326?mt=8';
  <?php } elseif($_B['android']) { ?>
    window.location.href = 'https://play.google.com/store/apps/details?id=vn.dobody.anvuicustomer&hl=en'; 
  <?php } ?>
}, 100);
</script>
<?php } ?>
    <link href="<?=$_B['home_theme']?>css/sub.css?v=<?php echo time() ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="wrapper">
        <div class="">
            <header id="header">
                <div class="container">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="logo">
                            <a href="/"><img class="img-responsive" src="<?=$_B['home_theme']?>imgs/logo.png"></a>
                        </div>
                        <div class="menu">
                            <ul>
                                <li>
                                    <a href="/" aria-hidden="true">
                                        Trang chủ
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="/tim-ve" class="" aria-hidden="true">
                                        Tìm vé
                                    </a>
                                </li>
                                <li>
                                    <a href="/gioi-thieu" class="" aria-hidden="true">
                                        Giới thiệu
                                    </a>
                                </li>
                                <li>
                                    <a href="/phan-mem" class="" aria-hidden="true">
                                        Phần mềm nhà xe
                                    </a>
                                </li> 
                                <li>
                                    <a href="/news" class="" aria-hidden="true">
                                        Tin tức
                                    </a>
                                </li> 
                            </ul>
                        </div>
                        <div class="menu-mobile">
                            <section class="button_menu_mobile">
                                <div id="nav_list">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </div>
                            </section>
                            <nav class="menutop">
                                <div class="menu-top-custom">
                                    <div class="navbar-collapse pushmenu pushmenu-left">
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <a class="txt" href="/">Trang chủ</a>
                                            </li> 
                                            <li class="active">
                                                <a class="txt" href="/tim-ve">Tìm kiếm vé</a>
                                            </li> 
                                            <li>
                                                <a class="txt" href="/gioi-thieu">Giới thiệu</a>
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 hidden-xs">
                        <div class="account">
                            <a href="http://nhaxe.vn" target="_blank"> 
                                <span>Tạo website nhà xe</span>
                            </a> 
                        </div>
                    </div>
                    <div class="box-search col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       
                        
                        <div class="box-search-body">
                            <form id="fly-search" action="/tim-ve" method="get">
                                <input type="hidden" name="startPointId" id="startPointId" value="<?=$data['startPointId']?>">
                                <input type="hidden" name="endPointId" id="endPointId" value="<?=$data['endPointId']?>">
                                <div class="row fly-search-inner">
                                    <div class="fly-search-item col-md-3 col-sm-6 col-xs-12">
                                        <input type="text" id="startPoint" name="startPoint" value="<?=$data['startPoint']?>" placeholder="Nơi đi" class="startPoint form-control form-filter">
                                        <div tabindex="0" class="icon-change"></div>
                                    </div>
                                    <div class="fly-search-item col-md-3 col-sm-6 col-xs-12">
                                        <input type="text" id="endPoint" name="endPoint" value="<?=$data['endPoint']?>" placeholder="Nơi đến" class="endPoint form-control form-filter">
                                    </div>
                                    <div class="fly-search-item date col-md-3 col-sm-6 col-xs-12">
                                        <div class="icon" aria-label="Calendar icon" data-proxy-click="">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 17.5" fill="currentColor">
                                                <rect y="6.5" width="16" height="1"></rect>
                                                <rect x="11" y="-0.5" width="1" height="5"></rect>
                                                <rect x="4" y="-0.5" width="1" height="5"></rect>
                                                <path d="M14,2.47a1,1,0,0,1,1,1v12a1,1,0,0,1-1,1H2a1,1,0,0,1-1-1V3.5a1,1,0,0,1,1-1H14m0-1H2a2,2,0,0,0-2,2v12a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V3.5a2,2,0,0,0-2-2h0Z"></path>
                                            </svg>
                                        </div>
                                        <input type='text' name="date" value="<?=$data['date']?>" class="form-control" id='datetimepicker' />
                                    </div>
                                    <div class="fly-search-item">
                                        <label> &nbsp;</label>
                                        <button class="BNC-search-product btn btn-danger">Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                       <script type="text/javascript">
 $(document).ready(function() {
 

 
                        $('.icon-change').click(function(){
                            var startPointId = $('#startPointId').val();
                            var endPointId = $('#endPointId').val();
                            var startPoint = $('#startPoint').val();
                            var endPoint = $('#endPoint').val();

                            $('#startPointId').val(endPointId);
                            $('#endPointId').val(startPointId);
                            $('#startPoint').val(endPoint);
                            $('#endPoint').val(startPoint);

                        }); 


});
</script>
                    </div>
                </div>
            </header>
            <style type="text/css">
            .listchuyen .thoigianchuyen div{
            	color: #084983;
            	font-size: 12px;
            	text-align: center;
            }
            .listchuyen .thoigianchuyen div h4{
            	color: #000; 
            }
            .listchuyen .datve{
            	text-align: center;
            }
            .btn-book {
    color: #fff;
    background-color: #ff690f;
    border-color: #ff690f;
    padding: 10px 20px;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
    border-radius: 0px;
}
.btn-book i{
margin-right: 10px;
}
.listchuyen .datve p{
            	font-size: 15px;
            	color: #000;
            	padding-top: 8px;
            }
            .listchuyen .info{
            	    text-align: center;
    padding-top: 20px;
    color: #084983;
            }
            .listchuyen .thoigianchuyen {

    padding-top: 20px;
            }
            .listchuyen .icon{
            	text-align: center;
            	padding-top: 26px;
            }
            </style>
            <div class="content home-box">
                <div class="container">
                     <?php if(count($data['trips']) > 0 ) { ?>
                     <?php $i =0 ?>
                     <?php $a = rand(0,count($data['trips']) -1) ?> 
                     <?php if(is_array($data['trips'])) { foreach($data['trips'] as $k => $v) { ?>
                     


                     <div class="row listchuyen">
                     	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 icon hidden-xs">
                     		<img src="<?=$_B['home']?>themes/icon/iConAnVuiVang.png" style="width: 68px;"/>
                     	</div>
                     	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 info">
                     			<p>Nhà xe</p>
                     		<h4><?=$v['companyName']?></h4>
                     		<p><?=$v['numberPlate']?></p>

                     	</div>
                     	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 thoigianchuyen">
                     		<div class="row">
                     			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 batdau">
                     				<h4><?=$v['startTime']?></h4>
                     				<?=$v['getInPointName']?>
                     			</div>
                     			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 quatrinh">
                     				<h4><i class="fa fa-long-arrow-right" aria-hidden="true"></i></h4>
                     				<?=$v['processTime']?>
                     			</div>
                     			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 kethuc">
                     				<h4><?=$v['endTime']?></h4>
                     				<?=$v['getOffPointName']?>
                     			</div>
                     		</div> 
                     	</div> 
                     	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 datve">
                     		<p><b><?=$v['ticketPrice']?></b> <i>đ</i></p>
  
                            <?php if($v['companyStatus'] == 2) { ?>
 
                            
                     		<a target="_blank" href="<?=$v['web']?>dat-ve?routeId=<?=$v['routeId']?>&startPointId=<?=$data['startPointId']?>&endPointId=<?=$data['endPointId']?>&date=<?=$data['date']?>&scheduleId=<?=$v['scheduleId']?>&tripIdHome=<?=$v['tripId']?>&companyId=<?=$v['companyId']?>">
                     			<button type="button" class="btn btn-danger btn-book"><i class="fa fa-bus" aria-hidden="true"></i> Đặt vé</button>
                     		</a>
                            <?php } else { ?>

                            <a target="_blank" href="call:19007034">
                                <button type="button" class="btn btn-danger btn-book">Gọi 19007034</button>
                            </a>


                            <?php } ?>
                     	</div>
                     </div> 
                     <?php if($i == $a) { ?>
                     <div class="row listchuyen">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="<?=$data['adsdv']['link']?>"><img src="http://anvui.vn/cdn/<?=$data['adsdv']['avatar']?>" style="width: 100%"/></a>
                        </div>
                    </div>
                     <?php } ?>
                     <?php $i++ ?>
                     <?php } } ?>
                     <?php } elseif(!$data['begin']) { ?>
                      <center><h2>Không tìm thấy chuyến nào!</h2></center>
                     <?php } else { ?> 
                      <center><h2>Hãy chọn Điểm đi, Điểm đến và thời gian!</h2></center>
                     <?php } ?>


                     <hr>
                        <div class="content-inner">
    <h2>Đặt xe từ các thành phố</h2>
                            <div class="clearfix">
                                 <!-- Nav tabs -->
                                <ul class="nav nav-tabs clearfix" role="tablist">
                                    <?php if(is_array($data['hottrip'])) { foreach($data['hottrip'] as $k => $v) { ?>
                                    <li role="presentation"<?php if($k ==0) { ?> class="active"<?php } ?>><a href="#chuyen<?=$v['id']?>" aria-controls="chuyen<?=$v['id']?>" role="tab" data-toggle="tab"><?=$v['name']?></a></li> 
                                    <?php } } ?>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <?php if(is_array($data['hottrip'])) { foreach($data['hottrip'] as $k => $v) { ?>
                                    <div role="tabpanel" class="tab-pane fade<?php if($k ==0) { ?> in active<?php } ?>" id="chuyen<?=$v['id']?>">
                                        <div class="clearfix">
                                            <div class="col-md-12 pl0 pr0">
                                                <ul class="routes-list">
                                                    <?php if(is_array($v['trip'])) { foreach($v['trip'] as $k1 => $v1) { ?>
                                                    <li class="col-md-6 col-xs-12"
                                                    >
                                                        <a><span class="route fl"><small><?=$v['name']?> →</small> <?=$v1['name']?></span></a>
                                                        <span class="price fl hide">
                                                        <?php echo number_format($v1['price']) ?>
                                                         ₫/vé</span>
                                                        <div class='input-group date datetimepicker-table' 
                                                        data-start-name="<?=$v['name']?>" 
                                                        data-end-name="<?=$v1['name']?>">
                                                            <input type='hidden' class="form-control chonngay"   />
                                                            <span class="button input-group-addon">
                                                                Chọn ngày
                                                            </span>
                                                        </div>
                                                    </li> 
                                                    <?php } } ?>
                                                    
                                                    
                                                    
                                                </ul>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                    <?php } } ?>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

             <div class="content home-box1" style="margin-bottom:20px;margin-top:10px;">
                <div class="container">
                     <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 bannernews">
                                <a target="_blank" href="<?=$data['bannertin']['link']?>">
                                <img src="<?=$_B['home']?>cdn/<?=$data['bannertin']['avatar']?>" class="img-responsive" />
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 boxnew">
                                <h2><a href="/news">Tin tức và sự kiện</a></h2>
                                 <?php if(is_array($data['topnews'])) { foreach($data['topnews'] as $k => $v) { ?>
                                 <div class="row list-news">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <a href="<?=$v['link']?>"><img src="<?=$v['img']?>" class="img-responsive" /></a>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 infonews">
                                        <a href="<?=$v['link']?>"><?=$v['title']?></a> 
                                    </div>
                                 </div>
                                 <?php } } ?>
                            </div>
                            
                         </div>
                </div>
            </div> 
 <div class="skyline hidden-xs hidden-sm">

    <div class="skyline-city"></div>
    <div class="bus-img">
        <img style="    opacity: 1;
    filter: alpha(opacity=30);
    margin-top: 20px;
    width: 224px;
    margin-left: 13px;" src="/themes/1/imgs/banh-xe.gif?v=111">
    </div>
</div>

<footer class="">
                <div class="container">
                    <div class="menubotton col-lg-12 col-sm-12 col-xs-12">
                        <ul>
                            <li>
                                <a href="/">Trang chủ</a>
                            </li>
                            <li>
                                <a href="/gioi-thieu">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="/chinh-sach-bao-mat">Chính sách bảo mật</a>
                            </li>
                            <li>
                                <a href="/chinh-sach-hoat-dong">Chính sách hoạt động</a>
                            </li>
                            <li>
                                <a href="/dieu-khoan-su-dung">Điều khoản sử dụng</a>
                            </li>
                             
                        </ul>
                    </div>
                    <hr>
                    <div class="col-lg-8 col-sm-8 col-xs-12 doitac"> 
                        <h3>Đối tác</h3>
                        <div class="col col-md-4 col-sm-4 col-xs-6">
                            <img src="/logo-dobody-3.png" class="img-responsive">
                        </div> 
                         <div class="col col-md-2 col-sm-2 col-xs-3">
                            <img src="/logo.png" class="img-responsive">
                        </div>
                         <div class="col col-md-2 col-sm-2 col-xs-3">
                            <img src="/logo1.png" class="img-responsive">
                        </div>

                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12 applist">
                        <h3>Tải ứng dụng</h3>
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=vn.dobody.anvuicustomer&hl=en"><img src="/themes/1/imgs/GooglePlay.png" /></a>
                        <a target="_blank" href="https://itunes.apple.com/us/app/anvui-mua-v%C3%A9-xe-kh%C3%A1ch-online/id1263904326?mt=8"><img src="/themes/1/imgs/ios.png" /></a>
                    </div> 
                     
                    <div class="col-lg-8 col-sm-8 col-xs-12 info"> 
                        <h3>Về chúng tôi</h3> 
<?=$data['footer']['content']?>

                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12" style="padding-top:10px">
                        <div class="col col-md-12 col-sm-12 col-xs-12">
                            <img src="/themes/1/imgs/verified-visa-master.png" width="100%">
                        </div>
                        <div class="col col-md-6 col-sm-3 hidden-xs">
                            <a href="http://online.gov.vn/HomePage/WebsiteDisplay.aspx?DocId=38260"><img alt="" title="" src="/RwbFSMZAmxSe8I7cGN3Oaw==.jpgx" /></a>
                        </div>
                        <div class="col col-md-6 col-sm-3 col-xs-4">
                            <a href="#">
                                <!-- <img src="/themes/1/imgs/certificate3.png"> -->
                            </a>
                        </div>
                    </div> 
                </div>
            </footer>
        </div>
        <!--#header-->
    </div>
    </div>
    <!--JS-->
    <script src="<?=$_B['home_theme']?>libs/jquery/1.12.3/jquery-1.12.3.min.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>libs/bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>libs/bootstrap-datetimepicker/js/moment.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="<?=$_B['home_theme']?>plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
   


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <script src="<?=$_B['home_theme']?>js/functions.js" type="text/javascript"></script>
   

 <script src="<?=$_B['home_theme']?>js/anvui.js?v=<?php echo time() ?>" type="text/javascript"></script>

<script type="text/javascript">
 $(document).ready(function() {

    <?php if($data['date']) { ?>
        $( "#datetimepicker" ).val('<?=$data['date']?>');
    <?php } ?> 
});
</script>
</body>

</html>
