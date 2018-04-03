// JavaScript Document

$('document').ready(function () {

    // Add JS
    $("head").append("<script src='js/bootstrap-datepicker.min.js'></script>");
    $("head").append("<script src='libs/bootstrap-select/js/bootstrap-select.min.js'></script>");
    $("head").append("<script src='js/jquery.validate.min.js'></script>");
    $("head").append("<script src='js/anvui.js'></script>");

    //Add CSS

    $("head").append("<link rel='stylesheet' href='css/font-awesome.min.css'>");
    $("head").append("<link rel='stylesheet' href='css/bootstrap-datepicker3.min.css'>");
    $("head").append("<link rel='stylesheet' href='libs/bootstrap-select/css/bootstrap-select.min.css'>");
    $("head").append("<link rel='stylesheet' href='css/style.css'>");
    $("head").append("<link rel='stylesheet' href='css/sub.css'>");
    $("head").append("<link rel='stylesheet' href='css/common.css'>");


    var button = '';

    var url = window.location.href;

    var lang = '';

    if(url.search('/vi/') !== -1 )
    {
        lang = 'vi';
    } else if (url.search('/en/') !== -1 )
    {
        lang = 'en';
    } else {
        console.log("Không xác định");
    }

    switch (lang) {
        case 'en' :
            button = "Search";
            break;
        case 'vi' :
        default:
            button = "Tìm kiếm";
            break;
    }


    const template = `
        <div class="container-fluid timchuyen">
			<div class="container">
				<div class="row">
					<form action="http://booking.interbuslines.com/">
					<input type="hidden" name="chuyenav" id="chuyenavInput">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-0 cus-logo">
						<div class="row">
							<div>
								<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
									<img src="image/bus-icon.png" class="img-responsive" alt="Bus" style="width: 60%;">
								</div>
							</div>

							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="left: -15px;">
								<select class="form-control cus-select" name="startPoint" value="startPoint" id="startPoint"
										data-live-search="true">

								</select>
							</div>

							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="left: -30px;">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
									<a id="chuyendoi" class="chuyendoi" href="#"><i class="fa fa-exchange"></i></a>
								</div>

								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-center" style="left: -35px;">
									<select class="form-control cus-select" name="endPoint" value="endPoint" id="endPoint"
											data-live-search="true">

									</select>
								</div>


							</div>

							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="left: -80px;">
								<div class="has-feedback has-feedback-left">
									<i class="fa fa-calendar fa-2 form-control-feedback" aria-hidden="true"></i>
									<input type='text' name="date" value="" class="form-control datepicker"
										   id="datetimepicker"/>
								</div>
							</div>

							<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="left: -90px;">
								<div class="form-group has-feedback has-feedback-left">
									<button type="submit" class="btn btn-default" id="TimChuyen">${button}</button>
								</div>
							</div>


						</div>

					<input type="hidden" id="routeId">
					</div>
				</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
    `;

    $('.sppb-addon-content').append(template);

});