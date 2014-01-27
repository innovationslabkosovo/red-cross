/**
 * Created by visar on 11/21/13.
 */

$(function () {
    $("#datefrom, #dateto, .date_topic").datepicker({dateFormat: 'yy-mm-dd' });
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
                    if($.isArray(val)) {
                        $.each(val, function(k, v) {
                            // k = key, v = value
                            //$("[name="+key+"\\[\\]][class=editbox_"+ID+"][history="+k+"]").prev("#results_"+ID).html(v);
                            //$("[name="+key+"\\[\\]][class=editbox_"+ID+"][history="+k+"]").attr("value", v);
                            console.log(v);
                            $("[id=results_"+ID+"][history="+k+"]");
                        });
                    }
                    $("[name="+key+"]").prev("#results_"+ID).html(val);
                });

                $(".editbox, .save").hide();
                $(".hide").removeClass("hide");
                $(".text").show();
            }
        });
    });

    $(".editbox").mouseup(function () {
        return false;
    });

    $(".cancel").click(function () {
        var td = $("td");
        var ID = $(this).attr("id");
        console.log(ID);
        td.find("#results_" + ID).show();
        td.find(".editbox_" + ID).hide();
        td.find("#" + ID).hide();
        $(this).hide();
        $(".edit").attr("style","display:inline !important");
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
