
<?php
$page_title = "Krijo Teme te Re";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$get_topic_groups = "SELECT topic_group_id, name, active FROM TopicGroup";
$topic_groups = mysql_query($get_topic_groups);

?>
<form class="txfform-wrapper cf" name="topic_group_form" action="../core/application/create_topic.php" method="post">
    <div class="row">
        <h3>Shto Teme te Re!</h3>
        <div class="row">
            <label>Emri i Temes: </label>
            <input type="text" placeholder="Name" name="topic" id="topic">
            <label class="myCheckbox">
                <input type="checkbox" name="active" value="active">Kjo teme eshte aktive
                <span></span>
            </label>
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

<script>

    $.validate();

</script>
