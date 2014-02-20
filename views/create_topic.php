<?php
$page_title = "Krijo Teme te Re";

include '../core/init.php';
$user_id = $_SESSION['id'];
protect_page($user_id );
include $project_root . 'views/layout/header.php';

$get_topic_groups = "SELECT topic_group_id, name FROM TopicGroup where active='1'";
$topic_groups = mysql_query($get_topic_groups);

?>
<form class="txfform-wrapper cf" name="topic_form" action="../core/application/create_topic.php" method="post">
    <div class="row">
        <h3>Shto Teme te Re!</h3>
        <div class="row">
            <label>Emri i Temes: </label><br>
            <input type="text" placeholder="Emri i Temes" name="topic" id="topic" class="txfform-wrapper input" data-validation="required">
            <label class="myCheckbox"><br><br>
                <input type="checkbox" name="active" value="active">Kjo teme eshte aktive <span style="vertical-align: middle;"></span>
            </label>
            <br><br>
            <div class="dropdown">
            <select name="topic_group" class="dropdown-select" data-validation="required">
                <option value=>Zgjidh Grupin Tematik
                    <?php
                    while($row = mysql_fetch_array($topic_groups))
                    {
                        $name=$row["name"];
                        $select=$row["topic_group_id"];
                        echo "<OPTION VALUE=\"$select\">".$name.'</option>';
                    }
                    ?>
            </select>
            </div>
        </div>
        <br>
        <input type="submit" value="Regjistro">
    </div>
</form>

<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>
