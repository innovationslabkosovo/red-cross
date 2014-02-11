<?php
$page_title = "Krijo klase te re";

include '../core/init.php';
$user_id = $_SESSION['id'];
protect_page($user_id);
include $project_root . 'views/layout/header.php';

$get_trainers = "SELECT trainer_id, CONCAT(name,' ',surname) as name FROM Trainer ";
$trainers = mysql_query($get_trainers);

$get_supervisors = "SELECT supervisor_id, CONCAT(name,' ',surname) as name FROM Supervisor ";
$supervisors = mysql_query($get_supervisors);

$get_categories = "SELECT category_id, name FROM Category ";
$categories = mysql_query($get_categories);

$get_municipalities = "SELECT m.municipality_id, m.name FROM Municipality m";
$municipalities = mysql_query($get_municipalities);

$get_locations = "SELECT location_id, name FROM Location ";
$locations = mysql_query($get_locations);
?>
    <h1>Performanca e Trajnerit për Kurset në Terren</h1>

    <form action="../core/application/create_evaluation.php" method="post">

    <div class="dropdown">

        <select id="municipality_id" data-validation="required" name="municipality" class="dropdown-select">
            <option value="">Zgjedh Komunen</option>
            <?php
            create_options($municipalities, "municipality_id", "name");
            ?>
        </select>
    </div>

    <div class="dropdown">
        <select id="location_id" name="location" data-validation="required" class="dropdown-select">
            <option value="">Zgjedh Fshatin</option>
        </select>
    </div>
    <br>

    <div class="row">
        <label>Vendi: </label>
        <input type="text" name="place" data-validation="required" class="txfform-wrapper input" placeholder="Shtepi Private, Shkolle ...">
    </div>
    <br>
    <div class="row">
        <label>Data</label><input type="text" name="date" id="date" class="date" data-validation='required date'
                                         data-validation-format='yyyy-mm-dd'><br>
    </div>
    <br>
    <td><label>Ora Prej</label><input type='text' size='12' name='time_from' id="time_from" class="time_topic" data-validation='required time'></td>
    <td><label>Ora Deri</label><input type='text' size='12' name='time_to' id="time_to" class="time_topic" data-validation='required time'></td>
    <br>
    <br>
    <div class="row">
        <label>Numri i Pjesëmarrësve</label>
        <input type="text" name="participants" class="txfform-wrapper input">
    </div>
    <br>
    <div class="row">
        <label>Grupmosha</label>
        <input type="text" name="age_group" class="txfform-wrapper input" placeholder="p.sh. 15-45">
    </div>
    <br>
    <div class="row">
        <label>Gjinia</label>
        <input type="text" name="gender" class="txfform-wrapper input" placeholder="M / F / Gr. i përzier">
    </div>
    <br>
    <label>Trajneri</label>
    <div class="dropdown">

        <select id="trainer_id" name="trainer" data-validation="required" class="dropdown-select">
            <option value="">Zgjedh Trajnerin</option>
            <?php
            create_options($trainers, "trainer_id", "name");
            ?>
        </select>
    </div>
    <br>
    <label>Mbikqyrësi</label>
    <div class="dropdown">

        <select id="supervisor_id" name="supervisor" data-validation="required" class="dropdown-select">
            <option value="">Zgjedh Mbikqyrësin</option>
            <?php
            create_options($supervisors, "supervisor_id", "name");
            ?>
        </select>
    </div>
    <br>
    <label>Kategoritë e Vlerësimit</label>
    <br>

                <?php
                while($row = mysql_fetch_array($categories))
                {
                    echo "<input type='checkbox' name='category'";
                    $name=$row["name"];
                    $select=$row["category_id"];
                    echo " VALUE=\"$select\">".$name.'<br>';
                }
                ?>
    <br>
    <label>Vëzhgimet</label>
    <br>
    <textarea id="commentBox" name="notes" placeholder="Vëzhgimet"></textarea>
    <input type="submit" value="Regjistro">
    <script>
        $("#municipality_id").change(function () {

            var parent_value = $(this).val();
            var parent_id_field = "municipality_id";
            var child_table = "Location";
            var child_id_field = "location_id";
            var child_text_field = "name";
            var dataString = 'parent_value=' + parent_value + '&parent_id_field=' + parent_id_field + '&child_table=' + child_table + '&child_id_field=' + child_id_field + '&child_text_field=' + child_text_field;

            console.log(dataString);
            $.ajax
            ({
                type: "POST",
                url: "../core/return_children_dropdown.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    $('#location_id')
                        .find('option:gt(0)')
                        .remove('')
                        .end()
                        .append(html)
                    ;
                }
            });

        });


    </script>


<?php
if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>