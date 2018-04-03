<?php 
/**
 * @Project BNC v2 -> Adminuser
 * @File /data/www/superweb/anvui/tmp/tpl/admin_login.php 
 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="">
            <header id="header">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a class="logo" href="#">
                            <img class="img-responsive" src="themes/admin/imgs/logo.png">
                        </a>
                    </div>
                    
                </div>
            </header>
            
            <div class="content login">
                <div class="container">
                    <div class="row">
                        <div class="login-box col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="login-inner">
                                <div class="login-box-title"> 
                                    <h1><span>Đăng nhập</span></h1>
                                </div>
                                <div class="login-box-body">
                                    <?php if(!empty($data['error'])) { ?>
                                    <?=$data['error']?>
                                    <hr>
                                    <?php } ?>
                                    <form method="post">
                                        <ul>
                                            <li>
                                                <input type="text" name="userName" placeholder="Email hoặc số điện thoại">
                                            </li>
                                            <li>
                                                <input class="password" type="password" name="password" placeholder="Mật khẩu">
                                            </li>
                                        </ul>
                                        <input type="hidden" name="act" value="login">
                                        <button>Đăng nhập</button>
                                    </form>
                                    <div class="login-box-body-more">
                                        <!-- <a href="">Quên mật khẩu</a> -->
                                        <p>bạn có tài khoản không? <a href="http://nhaxe.vn">Đăng ký</a></p>
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
    <!--CSS-->
    <link href="themes/admin/plugins/owl-carousel/carousel.css" rel="stylesheet" type="text/css">
    <!-- <link href="css/layouts.css" rel="stylesheet" type="text/css"> -->
    <link href="themes/admin/css/common.css" rel="stylesheet" type="text/css">
    <link href="themes/admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="themes/admin/css/mobile.css" rel="stylesheet" type="text/css">
    <!--JS-->
    <script src="themes/admin/libs/jquery/1.12.3/jquery-1.12.3.min.js" type="text/javascript"></script>
    <script src="themes/admin/libs/bootstrap-3.3.6-dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="themes/admin/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
    <script src="themes/admin/js/functions.js" type="text/javascript"></script>
</body>

</html>
