<?php
$page_title = "Shto grup tematik te ri";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$get_topic_groups = "SELECT topic_group_id, name FROM TopicGroup where active = 1";
$topic_groups = mysql_query($get_topic_groups);
?>

<h2>Shto grup tematik te ri</h2>

    <form action="../core/application/create_topic_group.php" method="post">

        <div class="row">

            <h4>Grupet Tematike Ekzistuese</h4>
            <ul>
                <?php
                while ($data_tg = mysql_fetch_assoc($topic_groups)) {
                    echo "<input type='hidden' name='topic_group_id' value='" . $data_tg['topic_group_id'] . "' >";
                    echo "<li>" . $data_tg['name'] . "</li>";
                }
                ?>
            </ul>

        </div>

        <br>

        <div class="row">
            <label>Titulli i Grupit Tematik: </label>
            <input type="text" name="topic_group" id="topic_group">
            <br>
            <input type="checkbox" name="active" value="active">Ky grup tematik eshte aktiv<br>
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