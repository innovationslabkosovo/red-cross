<?php
$page_title = "Shto klase te re";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$i = 0;

$get_trainers = "SELECT trainer_id, name, surname FROM Trainer ";
$trainers = mysql_query($get_trainers);

$get_tests = "SELECT test_id, name FROM Test ";
$tests = mysql_query($get_tests);

$get_municipalities = "SELECT municipality_id, name FROM Municipality ";
$municipalities = mysql_query($get_municipalities);

$get_locations = "SELECT location_id, name FROM Location ";
$locations = mysql_query($get_locations);

$get_topics = "SELECT topic_id, description, topic_group_id  FROM Topic where active = 1";
$topics = mysql_query($get_topics);

$get_topic_groups = "SELECT topic_group_id, name FROM TopicGroup where active = 1";
$topic_groups = mysql_query($get_topic_groups);

while($row = mysql_fetch_assoc($topics)) {
    $topic_rows[$i]['topic_id'] = $row['topic_id'];
    $topic_rows[$i]['topic_group_id'] = $row['topic_group_id'];
    $topic_rows[$i]['description'] = $row['description'];
    $i++;
}

$i=0;
while($row = mysql_fetch_assoc($topic_groups)) {
    $topic_group_rows[$i]['topic_group_id'] = $row['topic_group_id'];
    $topic_group_rows[$i]['name'] = $row['name'];
    $i++;
}


?>

    <form action="../core/application/create_class.php" method="post">

        <div class="row">
            <label>Komuna : </label>
            <select id="municipality_id" name="municipality">
                <option value="">--Zgjedh Komunen--</option>
                <?php
                create_options($municipalities, "municipality_id", "name");
                ?>
            </select><br>
        </div>

        <div class="row">
            <label>Fshati : </label>
            <select id="location_id" name="location">
                <option value="">--Zgjedh Fshatin--</option>
                <?php
                create_options($locations, "location_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">
            <label>Vendi: </label><input type="text" name="vendi" id="vendi" placeholder="Shtepi Private, Shkolle ..."><br>
        </div>

        <br>
        <div class="row">
            <label>Data prej: </label><input type="text" name="date_from" id="datefrom"><br>
        </div>

        <div class="row">
            <label>Data deri: </label><input type="text" name="date_to" id="dateto"><br>
        </div>

        <div class="row">
            Modeli i testit:
            <select id="test_id" name="test">
                <option value="">--Zgjedh Testin--</option>
                <?php
                create_options($tests, "test_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">
            <label>Ligjeruesi : </label>
            <select id="trainer_id" name="trainer">
                <option value="">--Zgjedh Ligjeruesin--</option>
                <?php
                create_options($trainers, "trainer_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">

            <h4>Temat</h4>

            <table border="1" style="width: 100%">

                <tr>
                    <th>
                        Numri
                    </th>

                    <th>
                        Temat
                    </th>

                    <th>
                        Data
                    </th>

                    <th>
                        Koha Prej
                    </th>

                    <th>
                        Koha Deri
                    </th>

                </tr>

                <?php

                foreach ((array)$topic_group_rows as $tg_value) {
                    echo "<tr>";
                    echo "<input type='hidden' name='topic[topic_group_id][]' value='" . $tg_value['topic_group_id'] . "' >";
                    echo "<td>" . $tg_value['name'] . "</td>";
                    echo "<td><ul>";
                    foreach ((array)$topic_rows as $t_value) {
                        echo $data_topic['topic_group_id'];
                        if ($tg_value['topic_group_id'] == $t_value['topic_group_id'])
                            echo "<li>" . $t_value['description'] . "</li>";
                    }
                    echo "</ul></td>";
                    echo "<td><label>Data: </label><input type='text' size='12' name='topic[date_topic][]' id='date_topic_".$tg_value['topic_group_id']."' class='date_topic'></td>";
                    echo "<td><label>Koha prej: </label><input type='text' size='12' name='topic[time_from_topic][]' id='time_from_topic_".$tg_value['topic_group_id']."' class='time_topic'></td>";
                    echo "<td><label>Koha deri: </label><input type='text' size='12' name='topic[time_to_topic][]' id='time_from_topic_".$tg_value['topic_group_id']."' class='time_topic'></td>";

                    echo "</tr>";

                }

                ?>

            </table>
        </div>

        <br>
        <input type="submit" value="Submit">

    </form>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>