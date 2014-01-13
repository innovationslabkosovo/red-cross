<script type="text/javascript">
    function ajaxCall(id){
        $.ajax({

            type: "POST",
            url: '../core/application/create_topic_group.php',
            data:{hidDelete: id},
            dataType: "json",
            success:function( data ) {
                console.log(data);
                $('#'+data.rowID).remove();
                window.location.href = location.pathname+'?'+'message='+data.message+'&object='+data.object;
            }
        });
    };
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
        <?php
        /*            while ($data_tg = mysql_fetch_assoc($topic_groups)) {
                        echo "<input type='hidden' name='topic_group_id' value='" . $data_tg['topic_group_id'] . "' >";
                        echo "<table border='1'><tr>";
                        echo "<td>".$data_tg['name']."</td>";
                        echo "<td>".$status[$data_tg['active']]."</td>";
                        echo "<td><input type=\"button\" value=\"Fshij Grupin Tematik\" onclick=\"deleteThis({$data_tg['topic_group_id']})\" /></td>";
                        //echo "<td>".."</td>";
                        echo "</tr></table>";
                    }*/
        ?>
        <div id="url" url="<?php echo BASE_URL; ?>/core/application/create_topic_group.php"></div>
        <table border="1" id="editable">
            <?php

            while ($data_tg = mysql_fetch_assoc($topic_groups))
            {
                $id=$data_tg['topic_group_id'];
                $name=$data_tg['name'];
                $active = $status[$data_tg['active']];

                ?>

                <tr id="<?php echo $id; ?>" class="edit_tr">

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $name; ?></span>
                        <input name="topic_group" type="text" value="<?php echo $name; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $active; ?></span>
                        <!--<input name="status" type="text" value="<?php /*echo $active; */?>" class="editbox" id="editbox_<?php /*echo $id; */?>" />-->
                        <select name="status" class="editbox" id="editbox_<?php echo $id; ?>" value="<?php echo $active; ?>">
                            <option value="1">Aktiv</option>
                            <option value="0">Jo-aktiv</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" class="editbox" id="editbox_<?php echo $id; ?>" value="<?php echo $id;?>">
                        <input type="button" value="Ruaj" class="save" id="<?php echo $id; ?>">
                        <input type="button" value="Perditeso" class="edit" id="<?php echo $id; ?>">
                        <input type="button" value="Fshij Grupin Tematik" onclick="ajaxCall(<?php echo $id; ?>)">
                    </td>

                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</form>
<p  name="message" id="message"/></p>
<p  name="object" id="object" value="" />
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>