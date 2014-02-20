<?php
$page_title = "Krijo participant te ri";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';

$user_id = $_SESSION['id'];
$mun_access = "";
$include_user = "";
if (!is_admin($user_id))
{
    $include_user = ",Location l, Municipality m, User u ";
    $mun_access = "where c.location_id = l.location_id and l.municipality_id = m.municipality_id and m.municipality_id = u.municipality_id and u.user_id=$user_id";
}


$get_class = "SELECT c.class_id, c.name FROM Class c".$include_user.$mun_access;
$classes = mysql_query($get_class);

?>
<h1>Krijo participant te ri</h1>

<br>
<form action="../core/application/create_participant.php" method="post">

    <div class="row">
        <label>Emri: </label><br><input type="text" name="first_name" id="first_name" class="txfform-wrapper input" data-validation="required"> <br>
    </div>
    <br>

    <div class="row">
        <label>Mbiemri: </label><br><input type="text" name="last_name" id="last_name" class="txfform-wrapper input" data-validation="required"> <br>
    </div>
    <br>

    <div class="row">
        <label>Mosha: </label><br><input type="number" name="age" id="age" min="0" class="txfform-wrapper input" data-validation="required" ><br>
    </div>
    <br>

    <div class="row dropdown">
        <select name="gender" id="gender" class="dropdown-select" data-validation="required">
            <option value="">Gjinia</option>
            <option value="M">Mashkull</option>
            <option value="F">Femer</option>
        </select>
    </div>
    <br><br>
    <div class="row dropdown">

        <select id="class_id"  name="class" class="dropdown-select" data-validation="required" >
            <option value="">--Zgjedh Klasen--</option>
            <?php
            create_options($classes, "class_id", "name");
            ?>
        </select>
    </div>
    <br><br>

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
