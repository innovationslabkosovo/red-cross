<script type="text/javascript">
    function ajaxCall(id){
        $.ajax({

            type: "POST",
            url: '../core/application/create_category.php',
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
$page_title = "Menaxho Kategorite";

include '../core/init.php';
require_once('../core/application/Paginator.php');
protect_page();
include $project_root . 'views/layout/header.php';

$count_rows = mysql_query("SELECT count(*) FROM Category");
$num_rows = mysql_result($count_rows, 0);

$pages = new Paginator;
$pages->items_total = $num_rows;
$pages->paginate();
echo $pages->display_pages();
echo $pages->display_jump_menu();
echo $pages->display_items_per_page();
echo $pages->next_page;
echo $pages->prev_page;
$categories = mysql_query("SELECT category_id, name FROM Category $pages->limit");
?>

<form class="txfform-wrapper cf" name="category_form" action="../core/application/create_category.php" method="post">
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">

        <h3>Kategorite Ekzistuese</h3>

        <div id="url" url="<?php echo BASE_URL; ?>/core/application/create_category.php"></div>
        <table border="1" id="editable" class="bordered">
            <tr>
                <th>Kategoria</th>
                <th>Perditeso/Fshije</th>
            </tr>
            <?php

            while ($data_cat = mysql_fetch_assoc($categories))
            {
                $id=$data_cat['category_id'];
                $name=$data_cat['name'];
                ?>

                <tr id="<?php echo $id; ?>" class="edit_tr">

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $name; ?></span>
                        <input name="category" type="text" value="<?php echo $name; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
                    </td>



                    </td>
                    <td>
                        <input type="hidden" name="id" class="editbox" id="editbox_<?php echo $id; ?>" value="<?php echo $id;?>">
                        <input type="button" value="Ruaj" class="save submitSmlBtn" id="<?php echo $id; ?>">
                        <input type="button" value="Perditeso" class="edit submitSmlBtn" id="<?php echo $id; ?>">
                        <input type="button" value="Fshij" class="submitSmlBtn" onclick="ajaxCall(<?php echo $id; ?>)">
                        <input type="button" value="Anulo" class="cancel submitSmlBtn" id="<?php echo $id; ?>" style="display:none;">
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