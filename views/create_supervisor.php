<?php
$page_title = "Krijo Supervizor te Ri";
include '../core/init.php';
$user_id = $_SESSION['id'];
protect_page($user_id);
$errors = array();
include $project_root . 'views/layout/header.php'; ?>

<form class="txfform-wrapper cf" name="trainer_form" action="../core/application/create_supervisor.php" method="post">

    <div class="row">
        <h3>Shto supervizor te ri</h3>
        <div class="row">
            <label>Emri i supervizorit te ri:</label><input type="text" placeholder="Emri" name="name" class="txfform-wrapper input" id="trainer" data-validation="required" >
        </div>
        <br>

        <div class="row">
            <label>Mbiemri i supervizorit te ri:</label><input type="text" placeholder="Mbiemri" name="surname" class="txfform-wrapper input" id="trainer" data-validation="required">
        </div>
        <br>

        <div class="row">
            <label>Emaili i supervizorit te ri:</label><input type="text" placeholder="Email" name="email" class="txfform-wrapper input" id="trainer" >
        </div>
        <br>

        <div class="row">
            <label>Numri i telefonit:</label><input type="text" placeholder="Tel.No" name="phone" class="txfform-wrapper input" id="trainer">
        </div>
        <br>

        <div class="row">
            <input type="submit" value="Ruaj!">
        </div>

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
