$(document).ready(function () {
    var change_password = $("form");
    var message = $("#message");
    var loading_gif = '<?php echo BASE_URL."/img/loading.gif"; ?>';
    change_password.on("submit", function (e) {
        message.html("<img src=''/>");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
            {
                url: formURL,
                type: "POST",
                data: postData,
                success: function (data, textStatus, jqXHR) {
                    message.html('<pre><code class="prettyprint">' + data + '</code></pre>');

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    message.html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus=' + textStatus + ', errorThrown=' + errorThrown + '</code></pre>');
                }
            });
        e.preventDefault();
    });
});