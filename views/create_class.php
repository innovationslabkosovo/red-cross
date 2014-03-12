<?php
$page_title = "Krijo kurs te ri";

include '../core/init.php';
protect_page();

$user_id = $_SESSION['id'];

include $project_root . 'views/layout/header.php';

$i = 0;

// $get_trainers = "SELECT trainer_id, CONCAT(name,' ',surname) as name FROM Trainer ";
$get_trainers = "SELECT tr.trainer_id, CONCAT(tr.name,' ',tr.surname) as name FROM Trainer tr
        INNER JOIN User u on tr.municipality_id=u.municipality_id
        WHERE u.user_id=$user_id";
$trainers = mysql_query($get_trainers);

$get_tests = "SELECT test_id, name FROM Test ";
$tests = mysql_query($get_tests);

if (is_admin($user_id))
    $mun_qs = "SELECT m.municipality_id, m.name FROM Municipality m";
else
    $mun_qs = "SELECT m.municipality_id, m.name FROM Municipality m INNER JOIN User u on m.municipality_id=u.municipality_id where user_id=$user_id";

$get_municipalities = $mun_qs;
$municipalities = mysql_query($get_municipalities);

//$get_locations = "SELECT location_id, name FROM Location ";
//$locations = mysql_query($get_locations);

$get_topics = "SELECT topic_id, description, topic_group_id  FROM Topic where active = 1";
$topics = mysql_query($get_topics);

$get_topic_groups = "SELECT topic_group_id, name FROM TopicGroup where active = 1";
$topic_groups = mysql_query($get_topic_groups);

while ($row = mysql_fetch_assoc($topics)) {
    $topic_rows[$i]['topic_id'] = $row['topic_id'];
    $topic_rows[$i]['topic_group_id'] = $row['topic_group_id'];
    $topic_rows[$i]['description'] = $row['description'];
    $i++;
}

$i = 0;
while ($row = mysql_fetch_assoc($topic_groups)) {
    $topic_group_rows[$i]['topic_group_id'] = $row['topic_group_id'];
    $topic_group_rows[$i]['name'] = $row['name'];
    $i++;
}

?>

    <h1>Krijo kurs te ri</h1>

    <br>
    <form action="../core/application/create_class.php" method="post" class="create_class_view">

        <div class="row dropdown">
            <select id="municipality_id" name="municipality" data-validation="required" class="dropdown-select">
                <option value="">--Zgjedh Komunen--</option>
                <?php

                 create_options($municipalities, "municipality_id", "name");

                ?>
            </select>
        </div>

        <div class="row dropdown">
            <select id="location_id" name="location" data-validation="required" class="dropdown-select">
                <option value="">--Zgjedh Lokacionin--</option>
                <?php
                //                create_options($locations, "location_id", "name");
                ?>
            </select>
        </div>
        <br><br>

        <div class="row">
            <label>Vendi: </label><br><input type="text" name="vendi" id="vendi"
                                         placeholder="Shtepi Private, Shkolle ..." class="txfform-wrapper input"><br>
        </div>

        <br>

        <div class="row">
            <label>Data prej: </label><br><input type="text" name="date_from" id="datefrom1" class="datefrom txfform-wrapper input" data-validation='required date'
                                             data-validation-format='yyyy-mm-dd' ><br><br>
        </div>

        <div class="row">
            <label>Data deri: </label><br><input type="text" name="date_to" id="dateto1" class="dateto txfform-wrapper input" data-validation='required date'
                                             data-validation-format='yyyy-mm-dd'><br><br>
        </div>

        <div class="row dropdown">
            <select id="test_id" name="test" data-validation="required" class="dropdown-select">
                <option value="">--Zgjedh Testin--</option>
                <?php
                create_options($tests, "test_id", "name");
                ?>
            </select>
        </div><br><br>

        <div class="row dropdown">
            <select id="trainer_id" name="trainer" data-validation="required" class="dropdown-select">
                <option value="">--Zgjedh Trajnerin--</option>
                <?php
                create_options($trainers, "trainer_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">

            <h4>Temat</h4>

            <table border="1" style="width: 100%" class="create_class bordered">

                <tr>
                    <th>Numri</th>
                    <th>Temat</th>
                    <th>Data</th>
                    <th>Koha Prej</th>
                    <th>Koha Deri</th>
                </tr>

                <?php

                foreach ((array)$topic_group_rows as $tg_value) {
                    echo "<tr>";
                    echo "<input type='hidden' name='topic[topic_group_id][]' value='" . $tg_value['topic_group_id'] . "' >";
                    echo "<td>" . $tg_value['name'] . "</td>";
                    echo "<td><ul>";
                    foreach ((array)$topic_rows as $t_value) {
                        if ($tg_value['topic_group_id'] == $t_value['topic_group_id'])
                            echo "<li>" . $t_value['description'] . "</li>";
                    }
                    echo "</ul></td>";
                    echo "<td><input type='text' size='12' name='topic[date_topic][]' id='date_topic_" . $tg_value['topic_group_id'] . "' class='date_topic txfform-wrapper input' data-validation='required date' data-validation-format='yyyy-mm-dd'></td>";
                    echo "<td><input type='text' size='12' name='topic[time_from_topic][]' id='time_from_topic_" . $tg_value['topic_group_id'] . "' class='time_topic txfform-wrapper input' data-validation='required time'></td>";
                    echo "<td><input type='text' size='12' name='topic[time_to_topic][]' id='time_from_topic_" . $tg_value['topic_group_id'] . "' class='time_topic txfform-wrapper input' data-validation='required time'></td>";

                    echo "</tr>";

                }

                ?>

            </table>
        </div>

        <br>
        <input type="submit" value="Submit">

    </form>

    <script>
//         $.validate({
//             modules: 'date',
//             validateOnBlur: false, // disable validation when input looses focus
//             errorMessagePosition: 'top',// Instead of 'element' which is default
// //            borderColorOnError : 'red',
//             addValidClassOnAll : true
//         });

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
if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>