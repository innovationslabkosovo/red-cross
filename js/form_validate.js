$(document).ready(function () {
    var this_form = $("form");
    var message = $("#message");
    this_form.on("submit", function (e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr('action');
        $.ajax({
            url: formURL,
            type: 'POST',
            data: postData,
            success: function (data) {
                message.html('<p>' + data + '</p>');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                message.html('<p>AJAX Request Failed<br/> textStatus=' + textStatus + ', errorThrown=' + errorThrown + '<p>');
            }
        });
        e.preventDefault();
    });
});