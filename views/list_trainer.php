<script type="text/javascript">
    function ajaxCall(id){
        $.ajax({

            type: "POST",
            url: '../core/application/create_trainer.php',
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
$page_title = "Menaxho Trajneret";

include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
$user_id = $_SESSION['id'];
include $project_root . 'views/layout/header.php';

$count_rows = mysql_query("SELECT count(*) FROM Trainer");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
echo $pages->display_pages();
echo $pages->display_jump_menu();
echo $pages->display_items_per_page();
echo $pages->next_page;
echo $pages->prev_page;

if ($_GET['trainer_id_filter']) {
    $trainer_id_filter = $_GET['trainer_id_filter'];
    $municipality_filter = " WHERE tr.municipality_id=$trainer_id_filter";
}

if (is_admin($user_id))
{
    $trainers = mysql_query("SELECT tr.trainer_id, tr.name, tr.surname, tr.email, tr.phone FROM Trainer tr ".$municipality_filter." ORDER BY trainer_id desc $pages->limit");
}
else 
{
    $trainers = mysql_query("SELECT tr.trainer_id, tr.name, tr.surname, tr.email, tr.phone FROM Trainer tr
        INNER JOIN User u on tr.municipality_id=u.municipality_id
        WHERE u.user_id=$user_id
        ORDER BY trainer_id desc $pages->limit");
}
$get_municipalities = "SELECT m.municipality_id, m.name FROM Municipality m";
$municipalities = mysql_query($get_municipalities);
?>
<form class="txfform-wrapper cf edit_trainer_view" name="trainer_form" id="url" action="../core/application/create_trainer.php" method="post">
    <div class="form-error-message hide"></div>
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">
        <br><br>
        <?php 
        if (is_admin($user_id)) { 
            $get_municipalities_filter = "SELECT m.municipality_id, m.name, m.coords FROM Municipality m";
            $municipalities = mysql_query($get_municipalities_filter);
        ?>
        <div class="dropdown">
            <label for="select_city"></label>
            <select name="trainer_id_filter" id="select_city" data-validation="required" class="dropdown-select" onchange="location = this.options[this.selectedIndex].value;">
                <option value="">-Zgjidhni Qytetin-</option>
                <?php
                    while($muni = mysql_fetch_object($municipalities)) {
                ?>
                <option value="list_trainer.php?trainer_id_filter=<?=$muni->municipality_id?>"><?=$muni->name?></option>
                <?php } ?>
            </select>
        </div>
        <br>
        <i>Filtro trajneret ne baze te komunes</i>
        <br><br>
        <?php } ?>
        <h3>Trajneret Ekzistues</h3>

        <table border="1" id="editable" class="bordered">
            <tr>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Emaili</th>
                <th>Telefoni</th>
                <th>Modifiko</th>
            </tr>
            <?php

            while ($data_tra = mysql_fetch_assoc($trainers))
            {
                $id=$data_tra['trainer_id'];
                $name=$data_tra['name'];
                $surname=$data_tra['surname'];
                $email=$data_tra['email'];
                $phone=$data_tra['phone'];
                ?>

                <tr id="<?php echo $id; ?>" class="edit_tr">

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $name; ?></span>
                        <input name="name" type="text" data-validation="required" value="<?php echo $name; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $surname; ?></span>
                        <input name="surname" type="text" value="<?php echo $surname; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $email; ?></span>
                        <input name="email" type="text" value="<?php echo $email; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $phone; ?></span>
                        <input name="phone" type="text" value="<?php echo $phone; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <?php
                    if (is_admin($user_id))
                    {
                        ?>
                        <td>
                            <input type="hidden" name="id" class="editbox_<?php echo $id; ?> editbox" value="<?php echo $id;?>">
                            <input type="button" value="Ruaj" class="save_<?php echo $id; ?> save submitSmlBtn" id="<?php echo $id; ?>">
                            <input type="button" value="Ndrysho" class="edit_<?php echo $id; ?> edit submitSmlBtn" id="<?php echo $id; ?>">
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