
<?php
$page_title = "Krijo Grup Tematik";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';


?>
<form class="txfform-wrapper cf" name="topic_group_form" action="../core/application/create_topic_group.php" method="post">
    <div class="row">
        <h3>Shto Grup Tematik te Ri!</h3>
            <div class="row">
                <label>Titulli i Grupit Tematik: </label>
                <input type="text" placeholder="Name" name="topic_group" id="topic_group">
                <label class="myCheckbox">
                <input type="checkbox" name="active" value="active">Ky grup tematik eshte aktiv
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
