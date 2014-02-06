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

<form class="txfform-wrapper cf" name="category_form" action="../core/application/create_supervisor.php" method="post">
    <input type="hidden" name="hidDelete" id="hidDelete" value="" />
    <div class="row">

        <h3>Supervizoret Ekzistuese</h3>

        <div id="url" url="<?php echo BASE_URL; ?>/core/application/create_supervisor.php"></div>
        <table border="1" id="editable" class="bordered">
            <tr>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Telefoni</th>
                <th>Emaili</th>
                <th>Perditeso/Fshije</th>
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
                        <input name="supervisor" type="text" value="<?php echo $first_name; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $last_name; ?></span>
                        <input name="supervisor" type="text" value="<?php echo $last_name; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $email; ?></span>
                        <input name="supervisor" type="text" value="<?php echo $email; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
                    </td>

                    <td>
                        <span id="results_<?php echo $id; ?>" class="text"><?php echo $phone; ?></span>
                        <input name="supervisor" type="text" value="<?php echo $phone; ?>" class="editbox" id="editbox_<?php echo $id; ?>" />
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


<?php
//$page_title = "Lista e supervizoereve";
//include '../core/init.php';
//protect_page();
//include $project_root . 'views/layout/header.php'; ?>
<!--    <h3>Lista e supervizoreve</h3>-->
<!---->
<?php
//$result = mysql_query("SELECT Supervisor.name, Supervisor.surname, Supervisor.email, Supervisor.phone
// FROM Supervisor");
//
//echo "<table border='1' class = 'bordered'>
//<tr>
//<th>Emri</th>
//<th>Mbiemri</th>
//<th>E-maili</th>
//<th>Telefoni</th>
//</tr>";
//
//while($row = mysql_fetch_array($result))
//{
//    echo "<tr>";
//    echo "<td>" . $row[0] . "</td>";
//    echo "<td>" . $row[1] . "</td>";
//    echo "<td>" . $row[2] ."</td>";
//    echo "<td>" . $row[3] ."</td>";
//    echo "</tr>";
//}
//echo "</table>";
//
//?>
<!---->
<!---->
<?php //include $project_root . 'views/layout/footer.php'; ?>