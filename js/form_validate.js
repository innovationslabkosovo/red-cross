$(document).ready(function () {
    var this_form = $("form");
    var message = $("#message");
    this_form.on("submit", function (e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr('action');
        $.ajax(
            {
                url: formURL,
                type: 'POST',
                data: postData,
                success: function (data) {
                    message.html('<pre><code class=\"prettyprint\">' + data + '</code></pre>');

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    message.html('<pre><code class=\"prettyprint\">AJAX Request Failed<br/> textStatus=' + textStatus + ', errorThrown=' + errorThrown + '</code></pre>');
                }
            });
        e.preventDefault();
    });
});