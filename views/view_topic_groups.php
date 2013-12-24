<script type="text/javascript">
    function deleteThis(id)
    {
        document.getElementById("hidDelete").value = id;
        document.topic_group_form.submit();
    }
</script>

<?php
$page_title = "Menaxho Grupet Tematike";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$get_topic_groups = "SELECT topic_group_id, name, active FROM TopicGroup";
$topic_groups = mysql_query($get_topic_groups);

$status[1]="Aktiv";
$status[0]="Jo-aktiv";
?>
<form class="txfform-wrapper cf" name="topic_group_form" action="../core/application/create_topic_group.php" method="post">
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">

        <h3>Grupet Tematike Ekzistuese</h3>
        <ul>
            <?php
            while ($data_tg = mysql_fetch_assoc($topic_groups)) {
                echo "<input type='hidden' name='topic_group_id' value='" . $data_tg['topic_group_id'] . "' >";
                echo "<table border='1'><tr>";
                echo "<td>".$data_tg['name']."</td>";
                echo "<td>".$status[$data_tg['active']]."</td>";
                echo "<td><input type=\"button\" value=\"Fshij Grupin Tematik\" onclick=\"deleteThis({$data_tg['topic_group_id']})\" /></td>";
                //echo "<td>".."</td>";
                echo "</tr></table>";
            }
            ?>
        </ul>

    </div>
</form>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>