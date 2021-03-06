<?php 
/**
 * @Project BNC v2 -> Adminuser
 * @File /data/www/superweb/anvui/tmp/tpl/admin_tuyen_themtuyen.php 
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
                                <h1>Thêm tuyến</h1>
                            </div> 
                            <div class="home-box-right-body">
                                <div class="row" id="step1">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <form action="" method="POST">


                                          <div class="form-group f1">
                                            <label for="routeName">Tên tuyến</label>
                                            <input type="text" class="form-control" name="routeName" id="routeName" placeholder="">
                                          </div>  
                                          <div class="form-group f1">
                                            <label for="mealPrice">Giá bữa ăn</label>
                                            <input type="text" class="form-control" name="mealPrice" id="mealPrice" placeholder="">
                                          </div>   
                                          <div class="form-group f1">
                                            <label for="childrenTicketRatio">Tỷ lệ vé trẻ em</label>
                                            <input type="text" class="form-control" name="childrenTicketRatio" id="childrenTicketRatio" placeholder="">
                                          </div>   
                                           
                                            
                                            <div class="form-group f1">
                                            <label for="pointName">Thêm phương tiện</label>
                                            <input type="text" class="form-control" name="pointName" id="xe" placeholder="Tìm xe và thêm xe">
                                          </div> 

                                          <div>
                                            <table class="table">
                                              <thead>
                                                <tr> 
                                                  <th></th> 
                                                  <th>Phương tiện</th> 
                                                </tr>
                                              </thead>
                                              <tbody id="listxe">
                                                
                                              </tbody>
                                              </table>
                                          </div>

                                         <!--  <div class="form-group f1">
                                            <label for="pointName">Cân nặng hàng hoá</label>
                                            <input type="text" class="form-control" name="pointName" id="pointName" placeholder="">
                                          </div>   -->


                                          <input type="hidden" name="act" value="add">
                                          <button type="button" class="tostep2 btn btn-default">Tiếp theo</button>
                                        </form>

                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" >
                                          <div class="form-group f1">
                                            <label for="point">Thêm bến đỗ</label>
                                           <input type="text" class="form-control" name="pointName" id="point" placeholder="Tìm bến và thêm bến">
                                          </div>  

                                          <div>
                                            <div id="khoangcach"></div>
                                            <table class="table">
                                              <thead>
                                                <tr> 
                                                  <th></th>
                                                  <th>Bến đỗ</th>
                                                  <th>Thời gian dự kiến</th> 
                                                </tr>
                                              </thead>
                                              <tbody id="diemden">
                                                
                                              </tbody>
                                              </table>
                                          </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                        <div id="map"></div>

                                        <div id="right-panel"> 
    <div id="directions-panel"></div>
    </div>


                                    </div>
                                </div>
                                <div class="row" id="step2" style="display:none">

                                  <div class="col-lg-12 col-md-12 col-sm12 col-xs-12" id="step2c" >

                                    <button type="button" class="tostep3 btn btn-default">Tiếp theo</button>
                                  </div>
                                </div>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">


$(document).ready(function() {
  
  $( "#point" ).autocomplete({ 
    source: "http://admin.anvui.vn/listpoint",
    minLength: 0,
    select: function( event, ui ) {  
      chon_diem(ui.item);
      setTimeout(function() { initMap1(); }, 150); 
      setTimeout(function() {$('#point').val(''); }, 100);
    }
  });  
  $( "#xe" ).autocomplete({ 
    source: "http://admin.anvui.vn/listxe",
    minLength: 0,
    select: function( event, ui ) {  
      console.log(ui.item);
      chon_xe(ui.item);
      setTimeout(function() {$('#xe').val(''); }, 100); 
    }
  });

  $('.tostep2').click(function(){
      var listPointId = $("input[name='listPointId[]']").map(function(){return $(this).val();}).get();
      var listTimeIntend = $("input[name='listTimeIntend[]']").map(function(){return $(this).val();}).get();
      var listVehicleType = $("input[name='listVehicleType[]']").map(function(){return $(this).val();}).get();
      var listDistance = $("input[name='listDistance[]']").map(function(){return $(this).val();}).get();
       
      var routeName = $('#routeName').val();
      

      console.log(listPointId);
      console.log(listTimeIntend);
      console.log(listVehicleType);
      console.log(listDistance);


      if(routeName == '' ){
        alert('Hãy thêm tên tuyến!');
        return false;
      }
      if(listPointId.length < 2 ){
        alert('Hãy thêm ít nhất 2 bến!');
        return false;
      }

       if(listVehicleType.length < 1 ){
        alert('Hãy thêm ít nhất 1 loại xe!');
        return false;
      }


      var flag = false;
      $('.listTimeIntend').each(function(i){
        if( $(this).val() == '' ){
          flag = true;
        }
      });

      if(flag){
        alert('Hãy nhập thời gian dự kiến!');
        return false;
      }


      
      var html = '<table class="table"><thead><tr>'
          + '<th></th>';
         
         $('.listVehicleTypeName').each(function(i){
          html += '<th>'+$(this).text()+'</th>'
        });

         html +=' </tr> </thead> <tbody id="listxe">';


      $('.listPointIdName').each(function(i){
         html += '<tr><td>'+$(this).text()+'</td>';

         $('.listVehicleTypeName').each(function(i){
            html += '<td><input type="text" class="listPriceByVehicleType form-control" placeholder="Gía tiền" name="listPriceByVehicleType[]"></td>'
          });

         html += '</td>';
      });
      
       html +='</tbody></table>';

      $('#step2c').prepend(html);
      $('#step2').show();
      $('#step1').hide();
 

  });

$('.tostep3').click(function(){
   var listPointId = $("input[name='listPointId[]']").map(function(){return $(this).val();}).get();
      var listTimeIntend = $("input[name='listTimeIntend[]']").map(function(){return $(this).val();}).get();
      var listVehicleType = $("input[name='listVehicleType[]']").map(function(){return $(this).val();}).get();
      var listPriceByVehicleType = $("input[name='listPriceByVehicleType[]']").map(function(){return $(this).val();}).get();
       
      var routeName = $('#routeName').val();
      var mealPrice = $('#mealPrice').val();
      var childrenTicketRatio = $('#childrenTicketRatio').val();


       var flag = false;
      $('.listPriceByVehicleType').each(function(i){
        if( $(this).val() == '' ){
          flag = true;
        }
      });

      if(flag){
        alert('Hãy nhập giá tiền từng điểm theo các loại xe!');
        return false;
      }


      console.log(listPointId);
      console.log(listTimeIntend);
      console.log(listVehicleType);
      console.log(routeName);
      console.log(mealPrice);
      console.log(childrenTicketRatio);
      console.log(listPriceByVehicleType);

    

      $.post( "http://admin.anvui.vn/themtuyenadd", { 
        listPointId: listPointId,
        listTimeIntend: listTimeIntend,
        listVehicleType: listVehicleType,
        routeName: routeName,
        mealPrice: mealPrice,
        childrenTicketRatio: childrenTicketRatio,
        listPriceByVehicleType: listPriceByVehicleType,
       })
  .done(function( data ) {
    console.log(data);
  });


});
   

});

function remove(id){
  $('#'+id).remove();
  setTimeout(function() { initMap1(); }, 100); 
}
function chon_xe(ui){
  var html= '<tr id="'+ui.id+'"> <td><span onclick="remove(\''+ui.id+'\')" class="glyphicon glyphicon-trash"></span></td> <td class="listVehicleTypeName">'+ui.label+'<input type="hidden" name="listVehicleType[]" class="listVehicleType" value="'+ui.id+'"></td>  </tr>';

  $('#listxe').append(html);
}
function chon_diem(ui){
  console.log(ui);
  var html ='<tr id="'+ui.id+'"><td><span onclick="remove(\''+ui.id+'\')" class="glyphicon glyphicon-trash"></span></td>  <td class="listPointIdName">'+ui.label+'</td><td><input type="hidden" class="listPointId" name="listPointId[]" value="'+ui.id+'"><input type="text" class="listTimeIntend form-control" placeholder="Thời gian" name="listTimeIntend[]"></td></tr>';
  $('#diemden').append(html);
  $('#point').val('');
}

</script>              
                                 
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

     
<script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 20.997403, lng: 105.809732}
        });
        directionsDisplay.setMap(map);

        // document.getElementById('submit').addEventListener('click', function() {
          // calculateAndDisplayRoute(directionsService, directionsDisplay);
        // });
      } 

      function initMap1() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: {lat: 20.997403, lng: 105.809732}
        });
        directionsDisplay.setMap(map);
 
          calculateAndDisplayRoute(directionsService, directionsDisplay); 
      } 

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var waypts1 = [];
        // var checkboxArray = document.getElementById('waypoints');
        // for (var i = 0; i < checkboxArray.length; i++) {
        //   if (checkboxArray.options[i].selected) {
        //     waypts.push({
        //       location: checkboxArray[i].value,
        //       stopover: true
        //     });
        //   }
        // }

        $('.listPointIdName').each(function(i){

            waypts1.push({
              location: $(this).text(),
              stopover: true
            });
        });

  
        


        if( waypts1.length > 1 ){

          var indexe = waypts1.length -1;
          for (var i = 0; i < waypts1.length; i++) {
            if ( i == 0) {
              var startpoint = waypts1[0].location;
            }
            else if ( i == indexe) {
              var endpoint = waypts1[indexe].location;
            }
            else
            {
              waypts.push({
                location: waypts1[i].location,
                stopover: true
              });
            }
          }

          
var html ='<input type="hidden" class="listDistance" name="listDistance[]" value="0">';
$('#khoangcach').html(html); 

          console.log(waypts);
          console.log(startpoint);
          console.log(endpoint);
          

          directionsService.route({
            origin: startpoint,
            destination: endpoint,
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: 'DRIVING'
          }, function(response, status) {
            if (status === 'OK') {
              directionsDisplay.setDirections(response);
              var route = response.routes[0];
              console.log(route);

             
 
              // For each route, display summary information.
              for (var i = 0; i < route.legs.length; i++) {

                 var html ='<input type="hidden" class="listDistance" name="listDistance[]" value="'+route.legs[i].distance.value+'">'; 
              $('#khoangcach').append(html);

 
              }
            } else {
              window.alert('Directions request failed due to ' + status);
            }
          });


        }
        
      }
    </script>
   <style>  
#map {
    height: 444px;
}
      </style>   

     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBaaTWP8Slfbeu07PyYmKYlR7-E1BMSIAA&callback=initMap&language=vi">
    </script>

</body>

</html>
