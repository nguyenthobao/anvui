<?php 
/**
 * @Project BNC v2 -> Adminuser
 * @File /data/www/superweb/anvui/tmp/tpl/1_admin_index.php 
 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
 */
if(!defined('BNC_CODE')) {
    exit('Access Denied');
}
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản trị Anvui</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$_B['home_theme']?>admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=$_B['home_theme']?>admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=$_B['home_theme']?>admin/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$_B['home_theme']?>admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=$_B['home_theme']?>admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$_B['home_theme']?>admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="<?=$_B['home_theme']?>admin/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://tin12.com/admin">Quản trị Anvui</a>
            </div>
            

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu"> 
                        <li>
                            <a href="/admin"><i class="fa fa-dashboard fa-fw"></i> Bảng điều khiển</a>
                        </li> 
                        <li>
                            <a href="/admin/news"><i class="fa fa-newspaper-o fa-fw"></i> Tin tức<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/admin/addnews"><i class="fa fa-angle-double-right fa-fw"></i> Đăng tin tức</a>
                                </li>
                                <li>
                                    <a href="/admin/news"><i class="fa fa-angle-double-right fa-fw"></i> Danh sách tin</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href=""><i class="fa fa-cog fa-fw"></i> Cài đặt<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <?php if(is_array($data['info'])) { foreach($data['info'] as $k => $v) { ?>
                        <li>
                            <a href="/admin/newsadd?id=<?=$v['id']?>"><i class="fa fa-angle-double-right fa-fw"></i> <?=$v['title']?></a> 
                        </li>
                        <?php } } ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                       

                         

                         
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bảng điều khiển</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                 
            </div>
            
        </div>
        <!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="<?=$_B['home_theme']?>admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=$_B['home_theme']?>admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=$_B['home_theme']?>admin/bower_components/raphael/raphael-min.js"></script>
    <script src="<?=$_B['home_theme']?>admin/bower_components/morrisjs/morris.min.js"></script> 

    <!-- Custom Theme JavaScript -->
    <script src="<?=$_B['home_theme']?>admin/dist/js/sb-admin-2.js"></script>


</body>

</html>