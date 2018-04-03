$(document).ready(function () {
    var idAV = $("base").attr("id");

    $('.datepicker').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    }).datepicker("setDate", "0");

    $.ajax({
        type: "POST", url: "https://anvui.vn/chuyenAV", data: {idAV: idAV}, success: function (result) {
            $.each(result.chuyen, function (e, t) {
                    switch (t.routeId) {
                        case 'R02AaSWQAWl25':
                        case  'R02AaUcVpsShK':
                            break;
                        default:
                            $("#chuyenav").append('<button type="button" class="d-inline btn cus-btn" id="' + t.routeId + '" value="' + t.routeId + '">' + t.routeName + '</button>');
                            break;
                    }
            });
            var t = result.chuyen[0].routeId;
            $("#routeId").val(t);
            setPoint(t);
            $(".cus-select").selectpicker("refresh");
            $(".cus-btn").click(function () {
                var t = $(this).val();
                $("#routeId").val(t);
                setPoint(t);
            });
        }
    });

    $("#chuyendoi").click(function () {
        var temp = $("#startPoint").val();
        $("#startPoint").val($("#endPoint").val());
        $("#startPoint").change();
        $("#endPoint").val(temp);
        $("#endPoint").change();
        return false;
    });



    function setPoint(e) {
        $(".cus-btn").removeClass('btn-active');
        $("#"+ e +"").addClass('btn-active');
        $.ajax({
            type: "POST", url: "https://anvui.vn/pointNX", data: {routeId: e}, success: function (e) {
                $("#startPoint").html(""), $("#endPoint").html(""), $.each(e.a1, function (e, t) {
                    var n = '<option value="' + t.pointId + '">' + t.pointName + "</option>";
                    $("#startPoint").append(n)
                }), $("#startPoint").selectpicker("refresh"), $.each(e.a2, function (e, t) {
                    var n = '<option value="' + t.pointId + '">' + t.pointName + "</option>";
                    $("#endPoint").append(n);
                }), $("#endPoint").selectpicker("refresh");
            }
        })
    }


    //Truyen gia tri cho HN-SP Valentine
    setPointHNSP('R02AaUcVpsShK');

    function setPointHNSP(e) {
        $.ajax({
            type: "POST", url: "https://anvui.vn/pointNX", data: {routeId: e}, success: function (e) {
                $("#startPointHnSp").html(""), $("#endPointHnSp").html(""), $.each(e.a1, function (e, t) {
                    var n = '<option value="' + t.pointId + '">' + t.pointName + "</option>";
                    $("#startPointHnSp").append(n)
                }), $("#startPointHnSp").selectpicker("refresh"), $.each(e.a2, function (e, t) {
                    var n = '<option value="' + t.pointId + '">' + t.pointName + "</option>";
                    $("#endPointHnSp").append(n);
                }), $("#endPointHnSp").selectpicker("refresh");
            }
        })
    }

    $("#chuyendoi2").click(function () {
        var temp = $("#startPointHnSp").val();
        $("#startPointHnSp").val($("#endPointHnSp").val());
        $("#startPointHnSp").change();
        $("#endPointHnSp").val(temp);
        $("#endPointHnSp").change();
        return false;
    });

    //Truyen gia tri cho SP - HN Valentine
    setPointSPHN('R02AaSWQAWl25');

    function setPointSPHN(e) {
        $.ajax({
            type: "POST", url: "https://anvui.vn/pointNX", data: {routeId: e}, success: function (e) {
                $("#startPointSpHn").html(""), $("#endPointSpHn").html(""), $.each(e.a1, function (e, t) {
                    var n = '<option value="' + t.pointId + '">' + t.pointName + "</option>";
                    $("#startPointSpHn").append(n)
                }), $("#startPointSpHn").selectpicker("refresh"), $.each(e.a2, function (e, t) {
                    var n = '<option value="' + t.pointId + '">' + t.pointName + "</option>";
                    $("#endPointSpHn").append(n);
                }), $("#endPointSpHn").selectpicker("refresh");
            }
        })
    }

    $("#chuyendoi3").click(function () {
        var temp = $("#startPointSpHn").val();
        $("#startPointSpHn").val($("#endPointSpHn").val());
        $("#startPointSpHn").change();
        $("#endPointSpHn").val(temp);
        $("#endPointSpHn").change();
        return false;
    });

});