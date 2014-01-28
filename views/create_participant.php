<?php
$page_title = "Krijo participant te ri";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';


$get_class = "SELECT class_id, name FROM Class ";
$classes = mysql_query($get_class);

?>
<h1>Krijo participant te ri</h1>

<br>
<form action="../core/application/create_participant.php" method="post">

    <div class="row">
        <label>Emri: </label><input type="text" name="first_name" id="first_name" data-validation="required"><br>
    </div>
    <br>

    <div class="row">
        <label>Mbiemri: </label><input type="text" name="last_name" id="last_name" data-validation="required"><br>
    </div>
    <br>

    <div class="row">
        <label>Mosha: </label><input type="number" name="age" id="age" min="0" data-validation="required"><br>
    </div>
    <br>

    <div class="row">
        <label>Gjinia:</label>
        <label>Mashkull</label><input type="radio" name="gender" value="M" data-validation="required">
        <label>Femer</label><input type="radio" name="gender" value="F" data-validation="required">
    </div>
    <br>
    <div class="row">
        <label>Klasa: </label>

        <select id="class_id" name="class" data-validation="required">
            <option value="">--Zgjedh Klasen--</option>
            <?php
            create_options($classes, "class_id", "name");
            ?>
        </select>
    </div>
    <br>

    <input type="submit" id="Shto Participant" value="Shto Participant">

</form>
<script>
    $.validate({
        modules: 'date',
        validateOnBlur: false, // disable validation when input looses focus
        errorMessagePosition: 'top',// Instead of 'element' which is default
//            borderColorOnError : 'red',
        addValidClassOnAll : true
    });
</script>
<?php include $project_root . 'views/layout/footer.php'; ?>
