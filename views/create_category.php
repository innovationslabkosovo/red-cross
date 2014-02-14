<?php
$page_title = "Krijo Kategori te Re";
include '../core/init.php';
$user_id = $_SESSION['id'];
protect_page($user_id);
$errors = array();
include $project_root . 'views/layout/header.php'; ?>

    <form class="txfform-wrapper cf" name="category_form" action="../core/application/create_category.php" method="post">
        <div class="row">
            <h3>Shto kategori te re</h3>
            <div class="row">
                <label>Emri i kategorise se re:</label><br><br>
                <input type="text" placeholder="Emri i kategorise se re" name="category" id="category" class="txfform-wrapper input">
            </div>
            <br>
            <input type="submit" value="Ruaj!">
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