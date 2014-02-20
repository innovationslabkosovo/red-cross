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
require_once('../core/application/Paginator.php');
protect_page();
$user_id = $_SESSION['id'];
include $project_root . 'views/layout/header.php';

$count_rows = mysql_query("SELECT count(*) FROM TopicGroup");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
echo $pages->display_pages();
echo $pages->display_jump_menu();
echo $pages->display_items_per_page();
echo $pages->next_page;
echo $pages->prev_page;

$get_topic_groups = "SELECT topic_group_id, name, active FROM TopicGroup $pages->limit";
$topic_groups = mysql_query($get_topic_groups);

$status[1]="Aktiv";
$status[0]="Jo-aktiv";
?>
<form class="txfform-wrapper cf" id="url" name="topic_group_form" action="../core/application/create_topic_group.php" method="post">
    <div class="form-error-message hide"></div>
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
        <table border="1" id="editable" class="bordered">
            <th>Grupi Tematik</th>
            <th>Statusi</th>
            <th>Modifiko</th>
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
                    <input name="topic_group" data-validation="required" type="text" value="<?php echo $name; ?>" class="editbox_<?php echo $id; ?> editbox txfform-wrapper input" />
                </td>
                <?php
                $selected = 'Jo-aktiv';
                if ($selected == $active) {
                    $selected = "selected='selected'";
                } else {
                    $selected = '';
                }
                ?>

                <td>
                    <span id="results_<?php echo $id; ?>" class="text"><?php echo $active; ?></span>
                    <!--<input name="status" type="text" value="<?php /*echo $active; */?>" class="editbox" id="editbox_<?php /*echo $id; */?>" />-->
                    <select name="status" class="editbox_<?php echo $id; ?> editbox" value="<?php echo $active; ?>">
                        <option value="Aktiv" <?php echo $selected; ?>>Aktiv</option>
                        <option value="Jo-aktiv" <?php echo $selected; ?>>Jo-aktiv</option>
                    </select>
                </td>
                <?php
                if (is_admin($user_id))
                {
                ?>
                <td>
                    <input type="hidden" name="id" class="editbox_<?php echo $id; ?> editbox" value="<?php echo $id;?>">
                    <input type="button" value="Ruaj" class="save_<?php echo $id; ?> save submitSmlBtn" id="<?php echo $id; ?>">
                    <input type="button" value="Perditeso" class="edit_<?php echo $id; ?> edit submitSmlBtn" id="<?php echo $id; ?>">
                    <input type="button" value="Fshij" class="submitSmlBtn" onclick="ajaxCall(<?php echo $id; ?>)">
                    <input type="button" value="Anulo" class="cancel_<?php echo $id; ?> cancel submitSmlBtn" id="<?php echo $id; ?>" style="display:none;">
                </td>
                <?php
                }

                else echo "<td></td>";
                ?>
            </tr>
            <?php
            }
            ?>
        </table>
        </form>
    </div>

<p  name="message" id="message"/></p>
<p  name="object" id="object" value="" />
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>