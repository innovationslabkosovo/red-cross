/**
 * Created by visar on 11/21/13.
 */

$(function() {
    $("#datefrom, #dateto, .date_topic").datepicker({dateFormat: 'yy-mm-dd' });
    $(".time_topic").timepicker();
});

$(document).ready(function() {

$(".edit_tr").on("click", function () {
    var ID = $(this).attr('id');
    $("td").find("#results_" + ID).hide();
    $("td").find("#editbox_" + ID).attr("style","display:block");
    $("td").find("#" + ID).attr("style","display:block");
});

$(".save").click(function () {
        ID = $(this).attr("id");
        var fileUrl = $("#url").attr("url");
        var first = $("td").find("#editbox_" + ID);
        var dataString = $("td").find("#editbox_" + ID).serialize();
            $.ajax({
                type: "POST",
                url: fileUrl,
                data: dataString,
                cache: false,
                dataType: "html",
                async: false,
                success: function (html) {
                    alert("U editua me sukses!");
                    location.reload();
                }
            });
    });

$(".editbox").mouseup(function () {
    return false;
});

$(document).mouseup(function (){
    $(".editbox, .save").hide();
    $(".text").show();
});
});
