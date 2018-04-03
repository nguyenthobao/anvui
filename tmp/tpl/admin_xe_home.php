<?php 
/**
 * @Project BNC v2 -> Adminuser
 * @File /data/www/superweb/anvui/tmp/tpl/admin_xe_home.php 
 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý nhà xe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <!--CSS-->
    <link href="themes/admin/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="themes/admin/plugins/owl-carousel/carousel.css" rel="stylesheet" type="text/css">
    <!-- <link href="css/layouts.css" rel="stylesheet" type="text/css"> -->
    <link href="themes/admin/css/common.css" rel="stylesheet" type="text/css">
    <link href="themes/admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="themes/admin/css/mobile.css" rel="stylesheet" type="text/css">
    <!--JS-->
    <script src="themes/admin/libs/jquery/1.12.3/jquery-1.12.3.min.js" type="text/javascript"></script>
    <script src="themes/admin/libs/bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="themes/admin/libs/bootstrap-datetimepicker/js/moment.js" type="text/javascript"></script>
    <script src="themes/admin/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="themes/admin/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
  <style type="text/css">
  body {
    padding-bottom: 50px;
  }
footer{
    position: fixed;
    bottom: 0px;
    left: 0px;
}
.home-box-left {
    background: #565d6b;
    padding: 0;
    font-family: 'Roboto Light';
    min-height: 800px;
}
.home-box-left-body ul li .active {
    color: #19448a;
    background: #fff;
}
  </style>  

</head>

<body>
    <div class="wrapper">
        <div class="">
            <header id="header">
                <div class="container">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                         
                        <div class="search">
                            <div class="input-group search-basic">
                                <input type="text" class="form-control" placeholder="Tìm kiếm..." name="BNC_txt_search" id="txt_search" value="">
                                <div class="input-group-btn"> <a href="javascript:void(0);" class="btn btn-default" id="btn_search"><span class="glyphicon glyphicon-search" ></span></a> </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="nav">
                            <ul> 
                                <li>
                                    <div class="dropdown">
                                        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle" aria-hidden="true">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <!-- <span>5</span> -->
                                        </a>
                                        <div class="user sub-nav dropdown-menu">
                                            <ul class="row">
                                                <!-- <li><a href="">Tài khoản</a></li> -->
                                                <!-- <li><a href="">Thay đổi mật khẩu</a></li> -->
                                                <!-- <li><a href="">Cài đặt</a></li> -->
                                                <li><a href="/thoat">Đăng xuất</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                 
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content home-box">
                <div class="container">
                    <div class="row">
                        <div class="home-box-left col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="home-box-left-title">
                                <!-- <img class="img-responsive" src="imgs/logo-hl.png"> -->
                            </div>
                            <div class="home-box-left-body">
                                <ul class="home-box-left-tab">
                                    <li>
                                        <a href="/" <?php if(empty($_GET['sub'])) { ?>class="active"<?php } ?>>
                                            <i class="fa fa-train" aria-hidden="true"></i>
                                            <span>Home</span>
                                        </a>
                                    </li>
                                   <!--  <li>
                                        <a href="/banve">
                                            <i class="fa fa-ticket" aria-hidden="true"></i>
                                            <span>Bán vé</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dieuhanhxe">
                                            <i class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></i>
                                            <span>Điều hành xe</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/lich">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <span>Lập lịch làm việc</span>
                                        </a>
                                    </li>
                                -->
                                    <li>
                                        <a href="/laixe" <?php if(isset($_GET['sub']) && $_GET['sub'] == 'laixe') { ?>class="active"<?php } ?>>
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            <span>Hồ sơ tài xế - phụ xe</span>
                                        </a>
                                    </li>  
                                    <li>
                                        <a href="/tuyen" <?php if(isset($_GET['sub']) && $_GET['sub'] == 'tuyen') { ?>class="active"<?php } ?>>
                                            <i class="fa fa-flag" aria-hidden="true"></i>
                                            <span>Khai báo tuyến</span>
                                        </a> 
                                    </li>
                                    <li>
                                        <a href="/xe"  <?php if(isset($_GET['sub']) && $_GET['sub'] == 'xe') { ?>class="active"<?php } ?>>
                                            <i class="fa fa-bus" aria-hidden="true"></i>
                                            <span>Khai báo phương tiện vận tải</span>
                                        </a>
                                    </li>
                                   <!--  <li>
                                        <a href="/baocao">
                                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                                            <span>Báo cáo</span>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>


                         
                        <div class="home-box-right col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="home-box-right-title">
                                <h1>Khai báo phương tiện</h1>
                            </div>
                            <div class="home-box-right-body">
                                <div class="filter">
                                    <div class="filter-title">
                                        <h2>Tìm phương tiện</h2>
                                    </div>
                                    <div class="filter-body">
                                        <form id="car-search" action="" method="get">
                                            <div class="row">
                                                 
                                                <div class="col-md-3 col-sm-6 col-xs-12"> 
                                                    <input type="text" value="" name="numberPlate" placeholder="Biển số" class="form-control form-filter">
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12"> 
                                                    <select class="form-control" name="seatMapId" id="seatMapId">

                                      <option>
                                        Loại xe
                                    </option>
                                    <?php if(is_array($data['map'])) { foreach($data['map'] as $k => $v) { ?>
                                      <option value="<?=$v['seatMapId']?>">
                                        <?php echo count($v['seatList']) ?> ghế
                                      </option> 
                                    <?php } } ?>
                                    </select>
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12"> 
                                                    <input type="text" value="" name="vehicleName" placeholder="Số chỗ" class="form-control form-filter">
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12"> 
                                                    <button class="btn-danger">Tìm kiếm</button> 
                                                </div>
                                                <div class="col-md-2 col-sm-6 col-xs-12">  
                                                    <a href="/themxe"><button type="button" class="btn btn-info">Thêm xe</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="list-car"> 
                                    <div class="list-car-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Biển số</th>
                                                    <th>Loại xe</th>
                                                    <th>Số chỗ</th> 
                                                    <th>Loại xe</th> 
                                                    <th>Tùy chọn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(is_array($data['xe'])) { foreach($data['xe'] as $k => $v) { ?>
                                                <tr>
                                                    <td><?=$v['numberPlate']?></td>
                                                    <td><?=$v['vehicleName']?></td>
                                                    <td><?=$v['numberOfSeats']?></td>  
                                                    <td><?=$data['type'][$v['vehicleTypeId']]['vehicleTypeName']?></td>  
                                                    <td>
                                                        <a href="/suaxe?id=<?=$v['vehicleId']?>">Sửa</a>
                                                        
                                                    </td>
                                                </tr>
                                                 <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="">
                <div class="container">
                    <div class="menubotton col-lg-5 col-sm-5 col-xs-12">
                        <ul>
                            <li>
                                <a href="">Điều khoản dịch vụ</a>
                            </li>
                            <li>
                                <a href="">Chính sách riêng tư</a>
                            </li>
                        </ul>
                    </div>
                    <div class="coppyright col-lg-2 col-sm-2 col-xs-12">
                        <span>© Anvui 2017</span>
                    </div>
                    <div class="version col-lg-5 col-sm-5 col-xs-12">
                        <span>v0.16.9</span>
                    </div>
                </div>
            </footer>
        </div>
        <!--#header-->
    </div>
    </div>
   <script src="themes/admin/js/functions.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
        $('#datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
    });
    </script>
</body>

</html>
