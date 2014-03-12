<?php
$page_title = "Shto Participantet";

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
<h1>Shto Participantet</h1>

<br>
<form action="../core/application/create_participant.php" method="post" class="create_participant_view">
<div class="row dropdown">

    <select id="class_id"  name="class" class="dropdown-select" data-validation="required" >
        <option value="">--Zgjedh Kursin--</option>

        <?php

            create_options($classes, "class_id", "name");

        ?>
    </select>

</div>
<br /> <br />
<table class = 'bordered'>

    <tr><th>Nr</th><th>Emri</th><th>Mbiemri</th><th>Mosha</th><th>Gjinia</th></tr>

    <?php 
        $count = 2;
        ?>
            <tr><td>1</td><td><input type="text" name="first_name[]" id="first_name" class="txfform-wrapper input" placeholder = 'Emri' data-validation="required"></td>
             <td><input type="text" name="last_name[]" id="last_name" class="txfform-wrapper input" placeholder = 'Mbiemri' data-validation="required"> </td>
                    <td><input type="number" name="age[]" id="age" min="0" class="txfform-wrapper input" placeholder = 'Mosha' data-validation="required" ></td>
                    <td class="row dropdown">
                        <select name="gender[]" id="gender" class="dropdown-select" data-validation="required">
                        <option value="">Gjinia</option>
                        <option value="M">Mashkull</option>
                        <option value="F">Femer</option>
                    </select></td>
            </tr>
        <?php
        
        while($count <=20){

            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><input type="text" name="first_name[]" id="first_name" class="txfform-wrapper input" placeholder = 'Emri'></td>
                    <td><input type="text" name="last_name[]" id="last_name" class="txfform-wrapper input" placeholder = 'Mbiemri' > </td>
                    <td><input type="number" name="age[]" id="age" min="0" class="txfform-wrapper input" placeholder = 'Mosha'  ></td>
                    <td class="row dropdown">
                        <select name="gender[]" id="gender" class="dropdown-select">
                        <option value="">Gjinia</option>
                        <option value="M">Mashkull</option>
                        <option value="F">Femer</option>
                    </select></td>
               
                </tr>
            <?php
            $count++;

        }

     ?>
  
</table>

    
    <br>
    <input type="submit" id="Shto_Participant" value="Shto Participant">

</form>
<?php 
if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php'; ?>
