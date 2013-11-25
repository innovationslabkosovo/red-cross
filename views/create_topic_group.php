<?php
$page_title = "Shto klase te re";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';


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


?>

    <form action="../core/application/create_class.php" method="post">

        <div class="row">
            <label>Municipality : </label>
            <select id="municipality_id" name="municipality">
                <option value="">--Select Municipality--</option>
                <?php
                create_options($municipalities, "municipality_id", "name");
                ?>
            </select><br>
        </div>

        <div class="row">
            <label>Location : </label>
            <select id="location_id" name="location">
                <option value="">--Select Location--</option>
                <?php
                create_options($locations, "location_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">
            <label>Date From : </label><input type="text" name="date_from" id="datepicker"><br>
        </div>

        <div class="row">
            <label>Date To: </label><input type="text" name="date_to" id="datepicker"><br>
        </div>

        <div class="row">
            Test model:
            <select id="test_id" name="test">
                <option value="">--Select Test--</option>
                <?php
                create_options($tests, "test_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">
            <label>Trainer : </label>
            <select id="trainer_id" name="trainer">
                <?php
                create_options($trainers, "trainer_id", "name");
                ?>
            </select>
        </div>
        <br>

        <div class="row">

            <h4>Topics</h4>
            <ul>
                <?php
                while ($data_tg = mysql_fetch_assoc($topic_groups)) {
                    echo "<input type='hidden' name='topic_group_id' value='" . $data_tg['topic_group_id'] . "' >";
                    echo "<li>" . $data_tg['name'] . "</li>";
                    echo "<ul>";
                    while ($data_topic = mysql_fetch_assoc($topics)) {
                        if ($data_tg['topic_group_id'] == $data_topic['topic_group_id'])
                            echo "<li>" . $data_topic['description'] . "</li>";
                    }
                    echo "</ul>";
                }


                ?>
            </ul>

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