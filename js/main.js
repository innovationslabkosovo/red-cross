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
        // span = results_
        td.find("#results_" + ID).hide();
        td.find(".editbox_" + ID).show();
        $(".save_"+ID+", .cancel_"+ID+"").attr("style", "display: inline;");
        $(this).addClass("hide");
    });

    $(".save").click(function () {
        var ID = $(this).attr("id");
        var td = $("td");
        var fileUrl = $("#url").attr("url");
        var dataString = td.find(".editbox_" + ID).serializeArray();
        $.ajax({
            type: "POST",
            url: fileUrl,
            data: dataString,
            cache: false,
            dataType: "json",
            success: function (data) {
                $.each(data,function(key, val) {
                    if($.isArray(val)) {
                        $.each(val, function(k, v) {
                            // k = key, v = value
                            $("[name="+key+"\\[\\]][class=editbox_"+ID+"][history="+k+"]").prev("#results_"+ID).html(v);
                            $("[name="+key+"\\[\\]][class=editbox_"+ID+"][history="+k+"]").attr("value", v);
                            //$("[id=results_"+ID+"][history="+k+"]");
                        });
                    }
                    $("[name="+key+"]").prev("#results_"+ID).html(val);
                });

                $(".save_"+ID+", .cancel_"+ID+"").hide();
                $(".editbox, .save").hide();
                $(".hide").removeClass("hide");
                $(".text").show();
                $(".text").attr("style", "display:block");
            }
        });
    });

    $(".editbox").mouseup(function () {
        return false;
    });

    $(".cancel").click(function () {
        var td = $("td");
        var ID = $(this).attr("id");
        td.find("#results_" + ID).show();
        td.find(".editbox_" + ID).hide();
        $(".save_"+ID+"").hide();
        $(".edit_"+ID).removeClass("hide");
        $(this).hide();
    });
    // End General Edit Function

    // Add active class to the menu
    $('#nav li a').each(function (){
        var path = location.pathname.split("/").pop(-1);
        var current_page = $(this).attr("href").split("/").pop(-1);
        if(path == current_page) {
            $(this).addClass('active').siblings().removeClass('active');
        }
    });
});
