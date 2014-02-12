<script type="text/javascript">
    function ajaxCall(id){
        $.ajax({

            type: "POST",
            url: '../core/application/create_topic.php',
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
$page_title = "Menaxho Temat";

include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
$user_id = $_SESSION['id'];
include $project_root . 'views/layout/header.php';

$count_rows = mysql_query("SELECT count(*) FROM Topic");
$num_rows = mysql_result($count_rows, 0);

$status[1]="Aktiv";
$status[0]="Jo-aktiv";

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
echo $pages->display_pages();
echo $pages->display_jump_menu();
echo $pages->display_items_per_page();
echo $pages->next_page;
echo $pages->prev_page;
$topics = mysql_query("SELECT topic_id, description, Topic.active, TopicGroup.name FROM Topic inner join TopicGroup on Topic.topic_group_id = TopicGroup.topic_group_id order by Topic.topic_id $pages->limit");
?>
<form class="txfform-wrapper cf" name="topic_form" action="../core/application/create_topic.php" method="post">
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">

        <h3>Temat Ekzistuese</h3>

        <div id="url" url="<?php echo BASE_URL; ?>/core/application/create_topic.php"></div>
        <form id="url" action="../core/application/create_topic.php">
        <table border="1" id="editable" class="bordered">
            <tr>
                <th>Tema</th>
                <th>Statusi</th>
                <th>Grupi Tematik</th>
                <th>Modifiko</th>
            </tr>
            <?php

            while ($data_tg = mysql_fetch_assoc($topics))
            {
                $id=$data_tg['topic_id'];
                $name=$data_tg['description'];
                $active = $status[$data_tg['active']];
                $topic_group = $data_tg['name'];
                ?>

                <tr id="<?php echo $id; ?>" class="edit_tr">

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $name; ?></span>
                        <input name="topic" data-validation="required" type="text" value="<?php echo $name; ?>" class="editbox_<?php echo $id; ?> editbox" id="" />
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
                        <select name="status" class="editbox_<?php echo $id; ?> editbox" id="" value="<?php echo $active; ?>">
                            <option value="Aktiv" <?php echo $selected; ?>>Aktiv</option>
                            <option value="Jo-aktiv" <?php echo $selected; ?>>Jo-aktiv</option>
                        </select>
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $topic_group; ?></span>
                        <select name="topic_group" class="editbox_<?php echo $id; ?> editbox" id="" value="<?php echo $topic_group; ?>">
                            <option value="">Ndyrsho Grupin Tematik</option>
                            <?php
                            $sql = mysql_query("SELECT topic_group_id, name FROM TopicGroup where active='1'");
                            while ($row = mysql_fetch_array($sql)){
                                ?>
                                <option value=<?php echo $row['topic_group_id']; ?>><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <?php
                    if (is_admin($user_id))
                    {
                    ?>
                    <td>
                        <input type="hidden" name="id" class="editbox_<?php echo $id; ?> editbox" id="" value="<?php echo $id;?>">
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

<script>
    $.validate({
        validateOnBlur: true, // disable validation when input looses focus
        //errorMessagePosition: 'top', // Instead of 'element' which is default
        addValidClassOnAll : true,
    });
</script>