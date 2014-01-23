/**
 * Created by visar on 11/21/13.
 */

$(function () {
    $(".datefrom, .dateto, .date_topic").datepicker({dateFormat: 'yy-mm-dd' });
    $(".time_topic").timepicker();
});

$(document).ready(function () {
    // Start General Edit Function
    $(".edit").on("click", function () {
        var ID = $(this).attr('id');
        var td = $("td");
        $("tr" + ID).children();
        td.find("#results_" + ID).hide();
        td.find("#editbox_" + ID).attr("style", "display:block");
        td.find("#" + ID).attr("style", "display:inline");
        td.find("#" + ID).next().removeClass("hide");
        $(this).addClass("hide");
    });

    $(".save").click(function () {
        var ID = $(this).attr("id");
        var td = $("td");
        var fileUrl = $("#url").attr("url");
        var dataString = td.find("#editbox_" + ID).serializeArray();
        $.ajax({
            type: "POST",
            url: fileUrl,
            data: dataString,
            cache: false,
            dataType: "json",
            success: function (data) {
                $.each(data,function(key, val) {
                    console.log(data);
                    if($.isArray(val)) {
                        $.each(val, function(k, v) {
                            $("[name="+key+"\\[\\]][id=editbox_"+ID+"][history="+k+"]").prev("#results_"+ID).html(v);
                            $("[name="+key+"\\[\\]][id=editbox_"+ID+"][history="+k+"]").attr("value", v);
                        });
                    }
                    $("[name="+key+"]").prev("#results_"+ID).html(val);
                });

                $(".editbox, .save").hide();
                $(".hide").removeClass("hide");
                $(".text").show();
                $("#cancel_edit").addClass("hide");
            }
        });
    });

    $(".editbox").mouseup(function () {
        return false;
    });

    $("#cancel_edit").click(function () {
        $(".editbox, .save").hide();
        $(".hide").removeClass("hide");
        $(".text").show();
        $("#cancel_edit").addClass("hide");
    });
    // End General Edit Function

    // Add active class to the menu
    $('#menu li a').each(function (){
        var path = location.pathname.split("/").pop(-1);
        var current_page = $(this).attr("href").split("/").pop(-1);
        if(path == current_page) {
            $(this).addClass('active').siblings().removeClass('active');
        }
    });
});
