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
protect_page();
include $project_root . 'views/layout/header.php';

$get_topics = "SELECT topic_id, description, Topic.active, TopicGroup.name FROM Topic inner join TopicGroup on Topic.topic_group_id = TopicGroup.topic_group_id order by Topic.topic_id";
$topics = mysql_query($get_topics);

$status[1]="Aktiv";
$status[0]="Jo-aktiv";
?>
<form class="txfform-wrapper cf" name="topic_form" action="../core/application/create_topic.php" method="post">
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">

        <h3>Temat Ekzistuese</h3>

        <div id="url" url="<?php echo BASE_URL; ?>/core/application/create_topic.php"></div>
        <table border="1" id="editable">
            <tr>
                <th>Tema</th>
                <th>Statusi</th>
                <th>Grupi Tematik</th>
                <th>Fshije/Perditeso</th>
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
                        <input name="topic" type="text" value="<?php echo $name; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
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
                        <select name="status" class="editbox" id="editbox_<?php echo $id; ?>" value="<?php echo $active; ?>">
                            <option value="1" <?php echo $selected; ?>>Aktiv</option>
                            <option value="0" <?php echo $selected; ?>>Jo-aktiv</option>
                        </select>
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $topic_group; ?></span>
                        <select name="topic_group" class="editbox" id="editbox_<?php echo $id; ?>" value="<?php echo $topic_group; ?>">
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