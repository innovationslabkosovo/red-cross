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
            success: function (data) {
                var data = $.parseJSON(data);
                $.each(data,function(index, value) {
                    var this_id = data.id;
                    $("[name="+index+"]").prev("#results_"+this_id).html(value);
                });
            }
        });
    });

    $(".editbox").mouseup(function () {
        return false;
    });

    $(document).mouseup(function () {
        $(".editbox, .save").hide();
        $(".hide").removeClass("hide");
        $(".text").show();
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
