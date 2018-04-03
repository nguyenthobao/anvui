Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};


var idAV = $('base').attr('id');
var ghedachon = []; 
var tripId = ''; 
var getInPointId = ''; 
var getOffPointId = ''; 
var scheduleId = ''; 
var getInTime = ''; 
var ticketPrice = 0; 

var can_chon_ghe = true;
function setPoint(routeId){
    $.ajax({
        type: 'POST', 
        url: 'http://anvui.vn/pointNX',
        data: { 
            'routeId': routeId,    
        },
        success: function(data){
             $('#startPoint').html('');
             $('#endPoint').html('');

           $.each( data.a1, function(index,val ) {
                var htm = '<option value="'+val.pointId+'">'+val.pointName+'</option>';
                $('#startPoint').append(htm);
            });
           $('#startPoint').selectpicker('refresh');
           $.each( data.a2, function(index,val ) {
                var htm = '<option value="'+val.pointId+'">'+val.pointName+'</option>';
                $('#endPoint').append(htm);
            });
           $('#endPoint').selectpicker('refresh');

           

        }
    });
}

function chon_chuyen(id){
    var elem = '#chon_chuyen_'+id;
    ghedachon = [];

    tripId = $(elem).attr('data-id'); 
    scheduleId = $(elem).attr('data-scheduleId'); 
    getOffPointId = $(elem).attr('data-getOffPointId'); 
    getInPointId = $(elem).attr('data-getInPointId'); 
    getInTime = $(elem).attr('data-getInTime'); 
    ticketPrice = $(elem).attr('data-ticketPrice'); 
    companyStatus = $(elem).attr('data-companyStatus'); 
    startDate = $(elem).attr('data-startDate'); 

    if( companyStatus == 1 ){
      $('#goidien').show();
      return false;
    }

    $('.chuyendi').removeClass('selected');
    $(this).addClass('selected');
    $('.box-chonghe').html('<center>Loading...</center>');

    $('#chonghe').show();  
  $('#thongtin').show();
   var fflo = true;

   console.log(tripId);
   console.log(scheduleId);

    $.getJSON( "http://demo.nhaxe.vn/dat-ve?tripId=" + tripId +'&scheduleId='+scheduleId, function( data ) {
        $('#loading').show();
      var html = ''; 
        

      for (var floor = 1; floor < data.seatMap.numberOfFloors+1; floor++) {

          html += '<div class="col-md-6 tachtang"><div class="col-md-12 col-sm-12 col-xs-12 tang2">Tầng '+floor+'</div>';

          //theo hang
          for (var row = 1; row < data.seatMap.numberOfRows +1; row++) {
            for (var column = 1; column < data.seatMap.numberOfColumns +1; column++) {
              coghe = false;
              iddd = '';
              

               $.each( data.seatMap.seatList, function(index,val ) {
                  var id = val['seatId'];
                  var id1 = id.replace(',','_');
                  iddd = floor+' '+ row+' '+column;
                  if(

                    val['floor'] != floor
                    || val['row'] != row
                    || val['column'] != column
                    ){
                      // coghe = false;
                  }
                  else{
                    coghe = true;
                    if( val['seatType'] == 2){
                      html += '<div data-id="'+iddd+'" class="col-md-2 ghe_'+data.seatMap.numberOfColumns+'"><div class="chonghe chonghekodcchon" >Tài</div></div>';
                    }

                    else if( val['seatType'] == 1){
                      html += '<div data-id="'+iddd+'" class="col-md-2 ghe_'+data.seatMap.numberOfColumns+'"><div class="chonghe chonghekodcchon" >Door</div></div>';
                    }

                    else if( val['seatType'] == 5){
                      html += '<div data-id="'+iddd+'" class="col-md-2 ghe_'+data.seatMap.numberOfColumns+'"><div class="chonghe chonghekodcchon" >WC</div></div>';
                    }

                    else if( val['seatType'] == 6){
                      html += '<div data-id="'+iddd+'" class="col-md-2 ghe_'+data.seatMap.numberOfColumns+'"><div class="chonghe chonghekodcchon" >Phụ</div></div>';
                    }

                    else if( val['seatStatus'] == 1 ){
                      html += '<div data=id="'+iddd+'" class="col-md-1 ghe_'+data.seatMap.numberOfColumns+' gheloai_'+val['seatType']+'"><div class="chonghe" id="chonghe_' + id1 + '" onclick="chonghe(\'' + id + '\')">' + id + '</div></div>';
                    }
                    else
                    {
                      html += '<div data=id="'+iddd+'"  class="col-md-2 ghe_'+data.seatMap.numberOfColumns+' gheloai_'+val['seatType']+'"><div class="chonghe chonghekodcchon" >' + id + '</div></div>';
                    } 

                  }
                  

                });
                 

                if(!coghe){
                  html += '<div data=id="'+iddd+'"  class="col-md-2 ghe_'+data.seatMap.numberOfColumns+' kocoghe"> </div>';
                }

            };
          };
          html += '</div>';

      };  
    $('.box-chonghe').html(html);
    $('#loading').hide();
});


}

var dateToday = new Date();
var startPoint ='';
var endPoint ='';
var date ='';
$(function() {
   
    $('#datetimepicker').datetimepicker({
        format: 'DD-MM-YYYY',
        minDate: dateToday
    }); 

}); 




 $.ajax({
    type: 'POST', 
    url: 'http://anvui.vn/chuyenAV',
    data: { 
        'idAV': idAV,    
    },
    success: function(data){ 
        $('#loading').show();
       $.each( data.chuyen, function(index,val ) {
            var htm = '<option value="'+val.routeId+'">'+val.routeName+'</option>';
            $('#chuyenav').append(htm);
        });
       $('.selectpicker').selectpicker('refresh');

       var routeId = data.chuyen[0].routeId;

        setPoint(routeId);
        $('#loading').hide();

    }
});

function chonghe(id){  
  var id1 = id.replace(',','_');
  var key = ghedachon.indexOf(id);
  if( key > -1){
    $('#chonghe_'+id1).removeClass('chonghechon');
    ghedachon.splice(key, 1);; 
  }
  else
  { 
    
    if(ghedachon.length > 10){
    alert('Chỉ được chọn dưới 10 ghế!');
    return false;
  }

    $('#chonghe_'+id1).addClass('chonghechon');
    ghedachon.push(id); 
  } 
  xacnhan();
}


function checknumbaby(value){

   

  if(value > ghedachon.length){
    $('#numberBayby').val(ghedachon.length);
    alert('Số trẻ em phải nhỏ hơn số ghế!');
    return true;
  }

  // {if $_route['childrenTicketRatio'] != 0} 
  // var numberMan = $('#numberMan').val();
  // numberMan = ghedachon.length - value;
  // $('#numberMan').val(numberMan); 
  // {/if}

  return true;
}

function xacnhan(){ 
  console.log(ghedachon);
  
  if(ghedachon.length == 0){
    alert('Hãy chọn ghế!');
    return false;
  }

  if(ghedachon.length > 10){
    alert('Chỉ được chọn dưới 10 ghế!');
    return false;
  }
  var ghedachontext = '';
  
  $.each( ghedachon, function(key,val ) {
    ghedachontext += val+',';
  });

  $('#ghedachonspan').html(ghedachontext);
 
  $('.xacnhanbtn').hide();
  $('#thongtin').show();
  var numbb = $('#numberBayby').val();
  var numman = ghedachon.length-numbb;

  if(numman < 0 ){
    numman = 0; 
    $('#numberBayby').val(ghedachon.length);
  }

  $('#numberMan').val(numman);
  var totalprice = ghedachon.length*ticketPrice;
  console.log(totalprice);
  $('#priceneedpay').text(totalprice.format());

}
function hoanthanh(){
  if(ghedachon.length == 0){
    alert('Hãy chọn ghế!');
    return false;
  }
  if(ghedachon.length > 10){
    alert('Chỉ được chọn dưới 10 ghế!');
    return false;
  }

  var pttt = $('input[name=paymenttype]:checked').val();

  var fullName = $('#fullName').val();
  var phoneNumber = $('#phoneNumber').val();
  if(fullName ==''){
    alert('Hãy nhập tên!');
    $('#fullName').focus();
    return false;
  }
  if(phoneNumber ==''){
    alert('Hãy nhập số điện thoại!');
    $('#phoneNumber').focus();
    return false;
  }
  if(tripId ==''){ alert('Thiếu dữ liệu!'); return false;} 
  if(getInPointId ==''){ alert('Thiếu dữ liệu!'); return false;} 
  if(getOffPointId ==''){ alert('Thiếu dữ liệu!'); return false;} 
  if(scheduleId ==''){ alert('Thiếu dữ liệu!'); return false;} 
  if(getInTime ==''){ alert('Thiếu dữ liệu!'); return false;} 
  if(ticketPrice ==0){ alert('Thiếu dữ liệu!'); return false;} 

  var numberBayby = $('#numberBayby').val();
  var numghe = ghedachon.length;
  var price = ticketPrice * numghe;

  $('#hoanthanhbtn').hide();
  $('#loadingbtn').show();

  $.ajax({
    type: 'POST', 
    url: 'http://demo.nhaxe.vn/dat-ve?sub=order',
    data: { 
            'listSeatId': JSON.stringify(ghedachon),  
            'fullName': fullName,  
            'phoneNumber': phoneNumber,  
            'getInPointId': getInPointId,  
            'startDate': startDate,  
            'getOffPointId': getOffPointId,  
            'scheduleId': scheduleId,  
            'getInTimePlan': getInTime, 

            'originalTicketPrice': price,  
            'paymentTicketPrice': price,  
            'paymentType': pttt,  
            'paidMoney': 0,  

            'tripId': tripId,  
            'numberOfAdults': numghe,  
            'numberOfChildren': numberBayby,  
        },
        success: function(data){
            $('#loading').show();
            console.log(data);
            if( data.code != 200){
              alert('Đã có lỗi xảy ra, hãy đặt lại!');
                $('#hoanthanhbtn').show();
                $('#loadingbtn').hide();
            }
            else{
              if( pttt == 1){
                var url = 'https://dobody-anvui.appspot.com/payment/dopay?vpc_OrderInfo='+data.results.ticket.ticketId+'&vpc_Amount='+price*100+'&phoneNumber='+phoneNumber;
                window.location.href = url;
              }
              else{
                $('#datthanhcong').show();
                  $('#hoanthanhbtn').hide();
                  $('#loadingbtn').hide();
                  $('#gohomebtn').show(); 
                   
              }
            }
            $('#loading').hide();
        }
    });


}








$(document).ready(function() {

$('#TimChuyen').click(function(){
    var startPoint = $('#startPoint').val();
    var endPoint = $('#endPoint').val(); 
    var timeStart = $('#datetimepicker').val(); 
    var routeId = $('#chuyenav').val(); 
    if(
        endPoint == ''
        || startPoint == ''
        ){
        alert('Hãy chọn điểm đi và điểm đến');
    }
    $.ajax({
        type: 'POST', 
        url: 'http://anvui.vn/listSchedule',
        data: { 
            'startPoint': startPoint,    
            'endPoint': endPoint,    
            'timeStart': timeStart,    
            'routeId': routeId,    
        },
        success: function(data){
            $('#loading').show();
             $('.listchuyen').html('');
            console.log(data);
            var flag = true;
            $.each( data, function(index,val ) {

                var htm = '<div id="chon_chuyen_'+index+'" onclick="javascript: chon_chuyen('+index+');" class="col-md-3 col-sm-3 col-xs-6 chuyendi" '
                            +'data-id="'+val.tripId +'"'
                            +'data-scheduleId="'+val.scheduleId+'"'
                            +'data-getInPointId="'+val.getInPointId+'"'
                            +'data-getOffPointId="'+val.getOffPointId+'"'
                            +'data-getInTime="'+val.getInTime+'"'
                            +'data-ticketPrice="'+val.ticketPrice+'"'
                            +'data-companyStatus="'+val.companyStatus+'"'
                            +'data-startDate="'+val.startDate+'" >'
                            +'<div class="showchuyen">'
                            +'<img  src="http://anvui.vn/themes/icon/iConAnVuiVang.png"/> ' 
                            +'<h5 class="tipppp">'+val.startTime+'</h5>'
                            +'<h5 class="giave">'+val.ticketPrice1+' VNĐ</h5>'
                            +'</div>'
                            +'</div>';
                
                $('.listchuyen').html(htm);

                $('#chonghe').hide();
                $('#thongtin').hide();  
                flag = false;

            }); 
            // console.log(flag);
            $('#beginmes').hide();

            if( flag){
                $('#chonghe').hide();  
                $('#thongtin').hide();
                $('#emptymes').show(); 
            }
                


            $('#loading').hide();
        }
    }); 
});

$('#chuyenav').on('changed.bs.select', function (e,clickedIndex, newValue, oldValue) {
   setPoint($('#chuyenav').val());
}); 

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; 
var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var today = dd+'-'+mm+'-'+yyyy; 
$( "#datetimepicker" ).val(today);

});