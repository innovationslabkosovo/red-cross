<?php
$page_title = "Krijo Trajner te Ri";
include '../core/init.php';
$user_id = $_SESSION['id'];
protect_page($user_id);
$errors = array();
include $project_root . 'views/layout/header.php'; 
$get_municipalities = "SELECT m.municipality_id, m.name FROM Municipality m";
$municipalities = mysql_query($get_municipalities);
?>

<form class="txfform-wrapper cf create_trainer_view" name="trainer_form" action="../core/application/create_trainer.php" method="post">

    <div class="row">
            <h3>Shto trajner te ri</h3>
            <div class="row">
                <label>Emri i trajnerit te ri:</label><br><input type="text" placeholder="Emri" name="name" class="txfform-wrapper input" id="trainername" data-validation="required">
            </div>
            <br>

            <div class="row">
                <label>Mbiemri i trajnerit te ri:</label><br><input type="text" placeholder="Mbiemri" name="surname" class="txfform-wrapper input" id="trainersurname" data-validation="required">
            </div>
            <br>

            <div class="row">
                <label>Emaili i trajnerit te ri:</label><br><input type="text" placeholder="Emaili" name="email" id="trainer" class="txfform-wrapper input" id="traineremail">
            </div>
            <br>

            <div class="row">
                <label>Numri i telefonit:</label><br><input type="text" placeholder="Tel.No" name="phone" class="txfform-wrapper input" id="trainerphone">
            </div>
            <br>
            <div class="dropdown">
                <select name="trainer_municipality" id="trainer_municipality" class="dropdown-select">
                    <option value="">Zgjedh Trajnerin</option>
                    <?php create_options($municipalities, 'municipality_id', 'name'); ?>
                </select>
            </div>
            <br><br>
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