<?php
$page_title = "Krijo participant te ri";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';



$get_tests = "SELECT test_id, name FROM Test ";
$tests = mysql_query($get_tests);

$get_municipalities = "SELECT municipality_id, name FROM Municipality ";
$municipalities = mysql_query($get_municipalities);


?>

    <h1>Krijo participant te ri</h1>

    <br>
    <form action="../core/application/create_participant.php" method="post">

        <div class="row">
            <label>Emri: </label><input type="text" name="first_name" id="first_name"><br>
        </div>

        <div class="row">
            <label>Mbiemri: </label><input type="text" name="last_name" id="last_name"><br>
        </div>

        <div class="row">
            <label>Mosha: </label><input type="number" name="age" id="age"><br>
        </div>


        <div class="row">
            <label>Komuna : </label>
            <select id="municipality_id" name="municipality" data-validation="required">
                <option value="">--Zgjedh Komunen--</option>
                <?php
                create_options($municipalities, "municipality_id", "name");
                ?>
            </select><br>
        </div>

        <div class="row">
            <label>Fshati : </label>
            <select id="location_id" name="location" data-validation="required">
                <option value="">--Zgjedh Fshatin--</option>
                <?php
                //                create_options($locations, "location_id", "name");
                ?>
            </select>
        </div>
        <br>



        <br>



        <input type="submit" value="Submit">

    </form>

    <script>
        $.validate({
            modules: 'date',
            validateOnBlur: false, // disable validation when input looses focus
            errorMessagePosition: 'top',// Instead of 'element' which is default
//            borderColorOnError : 'red',
            addValidClassOnAll : true
        });

        $("#municipality_id").change(function () {

            var parent_value = $(this).val();
            var parent_id_field = "municipality_id";
            var child_table = "Location";
            var child_id_field = "location_id";
            var child_text_field = "name";
            var dataString = 'parent_value=' + parent_value + '&parent_id_field=' + parent_id_field + '&child_table=' + child_table + '&child_id_field=' + child_id_field + '&child_text_field=' + child_text_field;

            console.log(dataString);
            $.ajax
            ({
                type: "POST",
                url: "../core/return_children_dropdown.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    $('#location_id')
                        .find('option:gt(0)')
                        .remove('')
                        .end()
                        .append(html)
                    ;
                }
            });

        });


    </script>
<?php

include $project_root . 'views/layout/footer.php';
?>