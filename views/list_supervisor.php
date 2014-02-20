<script type="text/javascript">
    function ajaxCall(id){
        $.ajax({

            type: "POST",
            url: '../core/application/create_supervisor.php',
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
$page_title = "Menaxho Supervizoret";

include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
$user_id = $_SESSION['id'];
include $project_root . 'views/layout/header.php';

$count_rows = mysql_query("SELECT count(*) FROM Supervisor");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
echo $pages->display_pages();
echo $pages->display_jump_menu();
echo $pages->display_items_per_page();
echo $pages->next_page;
echo $pages->prev_page;
$supervisors = mysql_query("SELECT supervisor_id, name, surname, email, phone FROM Supervisor $pages->limit");
?>
<form class="txfform-wrapper cf" name="supervisor_form" id="url" action="../core/application/create_supervisor.php" method="post">
<div class="form-error-message hide"></div>
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">

        <h3>Supervizoret Ekzistues</h3>

        <table border="1" id="editable" class="bordered">
            <tr>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Emaili</th>
                <th>Telefoni</th>
                <th>Modifiko</th>
            </tr>
            <?php

            while ($data_sup = mysql_fetch_assoc($supervisors))
            {
                $id=$data_sup['supervisor_id'];
                $first_name=$data_sup['name'];
                $last_name=$data_sup['surname'];
                $email=$data_sup['email'];
                $phone=$data_sup['phone'];
                ?>

                <tr id="<?php echo $id; ?>" class="edit_tr">

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $first_name; ?></span>
                        <input name="name" data-validation="required" type="text" value="<?php echo $first_name; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $last_name; ?></span>
                        <input name="surname" data-validation="required" type="text" value="<?php echo $last_name; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php //echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $email; ?></span>
                        <input name="email" type="text" value="<?php echo $email; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php //echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $phone; ?></span>
                        <input name="phone" type="text" value="<?php echo $phone; ?>" class="editbox_<?php echo $id; ?> editbox" id="editbox_<?php //echo $id; ?>" />
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
