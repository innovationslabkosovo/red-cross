<?php
error_reporting(0);
$page_title = "Lista e klasave";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';
$user_id = $_SESSION['id'];

$mun_access = "";
$include_user = "";
if (!is_admin($user_id))
{
    $include_user = ", User u ";
    $mun_access = "and m.municipality_id = u.municipality_id and  u.user_id=$user_id";
}

$get_class_details = "SELECT c.class_id,tr.trainer_id as tr_id,  tr.name as tr_name, tr.surname as tr_surname,l.location_id as l_id, l.name as l_name,m.municipality_id as m_id,  m.name as m_name, test.name as t_name, c.date_from, c.date_to, c.gateway
                      FROM Class c, Trainer tr, Location l, Municipality m, Test test". $include_user."
                      WHERE c.trainer_id = tr.trainer_id
                      and c.location_id = l.location_id
                      and l.municipality_id = m.municipality_id
                      and c.test_id = test.test_id ".$mun_access;
$class_details = mysql_query($get_class_details);


$get_class_topics = "SELECT tc.class_id, tc.topic_group_id, tc.date, tc.time_from, tc.time_to, tg.name as tg_name
                     FROM ClassTopic tc, TopicGroup tg
                     WHERE tc.topic_group_id = tg.topic_group_id
                     ORDER BY tc.class_id, tc.date, tc.time_from";
$class_topics = mysql_query($get_class_topics);

$i = 0;
while ($row_class_topics = mysql_fetch_assoc($class_topics)) {

    $class_topic[$row_class_topics['class_id']][$i]['class_id'] = $row_class_topics['class_id'];
    $class_topic[$row_class_topics['class_id']][$i]['topic_group_id'] = $row_class_topics['topic_group_id'];
    $class_topic[$row_class_topics['class_id']][$i]['date'] = $row_class_topics['date'];
    $class_topic[$row_class_topics['class_id']][$i]['time_from'] = $row_class_topics['time_from'];
    $class_topic[$row_class_topics['class_id']][$i]['time_to'] = $row_class_topics['time_to'];
    $class_topic[$row_class_topics['class_id']][$i]['tg_name'] = $row_class_topics['tg_name'];
    $i++;
}



//print_r($class_topic);

//$visar = echo "visaraa";

$get_topics = "SELECT topic_id, description, topic_group_id  FROM Topic where active = 1";
$topics = mysql_query($get_topics);

$i = 0;
while ($row = mysql_fetch_assoc($topics)) {
    $topic_rows[$i]['topic_id'] = $row['topic_id'];
    $topic_rows[$i]['topic_group_id'] = $row['topic_group_id'];
    $topic_rows[$i]['description'] = $row['description'];
    $i++;


}

?>

<h1>Lista e klasave</h1>
<?php $base_url = BASE_URL; ?>
<?php echo "<div id='url' url='{$base_url}/core/application/edit_class.php' ></div>";?>
<?php

if (isset($_GET['message']))
{
    if ($_GET['message'] == 'success')
    {
        echo $display_messages[$_GET['object']][$_GET['message']];

    }else{
        echo $display_messages[$_GET['object']][$_GET['message']];
    }

}

?>
<div class="form-error-message hide"></div>
<form id="url" action="../core/application/edit_class.php" class="edit_class_view">
    <table class="bordered style-for-inputs">

    <tr>
        <th >ID</th>
        <th >Komuna</th>
        <th style="width: 15%">Fshati</th>
        <th style="width: 20%">Trajneri</th>
        <th style="width: 10%">Data prej</th>
        <th style="width: 10%">Data deri</th>
        <th style="width: 10%">Detajet e Temave</th>
        <th style="width: 10%">Modifiko</th>
    </tr>
    <?php
    while ($row_class = mysql_fetch_assoc($class_details)) {

        // get locations for each municipality of each class
        $current_municipality = $row_class["m_id"];
        $current_location = $row_class["l_id"];
        $current_trainer = $row_class["tr_id"];


        $get_locations = "SELECT location_id, name FROM Location where municipality_id =".$current_municipality;
        $locations = mysql_query($get_locations);
        $get_municipalities = "SELECT municipality_id, name FROM Municipality ";
        $municipalities = mysql_query($get_municipalities);
        $get_trainers = "SELECT trainer_id, name, surname FROM Trainer ";
        $trainers = mysql_query($get_trainers);


        echo "<tr>";
        echo "<td> $row_class[class_id]</td >";
        echo "<input type='hidden' edit_mode='off' id='edit_mode_{$row_class["class_id"]}'>";
        // municipality span
        echo "<td><span id='results_{$row_class["class_id"]}' class='text'> $row_class[m_name]</span>
              <select size='1' name='municipality' class='editbox_{$row_class["class_id"]} editbox municipality'>
              <option value=''>Zgjedh Komunen</option> "; create_options($municipalities, 'municipality_id', 'name', $current_municipality);
        echo " </select></td>";

        // village span
        echo "<td><span id='results_{$row_class["class_id"]}' class='text'> $row_class[l_name]</span>
              <select name='location' class='editbox_{$row_class["class_id"]} editbox location_{$row_class["class_id"]}'>
              <option value=''>Zgjedh Fshatin</option> "; create_options($locations, 'location_id', 'name',$current_location);
        echo " </select>
              <input type='hidden' edit_mode='off' id='edit_mode_{$row_class["class_id"]}'>
              </td>";

        // trainer span
        echo "<td><span id='results_{$row_class["class_id"]}' class='text'> $row_class[tr_name]</span>
              <select name='trainer' class='editbox_{$row_class["class_id"]} editbox trainer_{$row_class["class_id"]}'>
              <option value=''>Zgjedh Ligjeruesin</option> "; create_options($trainers, "trainer_id", "name", $current_trainer);;
        echo " </select></td>";

        echo " <td><span id='results_{$row_class["class_id"]}' class='text'> $row_class[date_from] </span>
               <input type='text' size='10' name='date_from' value='$row_class[date_from]' class='editbox_{$row_class["class_id"]} editbox datefrom'>
        </td >";

        echo " <td><span id='results_{$row_class["class_id"]}' class='text'> $row_class[date_to] </span>
               <input type='text' size='10' name='date_to' value='$row_class[date_to]' class='editbox_{$row_class["class_id"]} editbox dateto'>
        </td >";
        echo " <td class='show_details_parent'> <span class='plus show_details show_details_{$row_class["class_id"]}' id='$row_class[class_id]'></span> </td >";


        echo " <td><input type='hidden' name='id' class='editbox_{$row_class["class_id"]} editbox' value='{$row_class["class_id"]}' />"
            ."<input type='button' value='Ruaj' class='save_{$row_class["class_id"]} save submitSmlBtn' id='{$row_class["class_id"]}'>"
            ."<input type='button' value='Perditeso' class='edit_{$row_class["class_id"]} edit submitSmlBtn' id='{$row_class["class_id"]}'>"
            ."<input type='button' value='Anulo' class='cancel_{$row_class["class_id"]} cancel submitSmlBtn' id='{$row_class["class_id"]}' style='display:none;'> </td >";

        echo "</tr>";
        echo "<tr  style='display: none' id='details_row_$row_class[class_id]' class='details'>";
        echo "<td colspan='8'>";


        echo "<table class='zebra'>";
        echo "<tr>";

        echo "<td>Numri</td>";
        echo "<td>Temat</td>";
        echo "<td>Data</td>";
        echo "<td>Koha Prej</td>";
        echo "<td>Koha Deri</td>";

        echo "</tr>";
        foreach ($class_topic[$row_class['class_id']] as $display_topic)
        {
            echo "<tr>";
            echo "<td> $display_topic[tg_name]";
            echo "<input type='hidden' value='$display_topic[topic_group_id]' name='topic[topic_group_id][]' class='editbox_{$row_class["class_id"]}'></td >";

            echo "<td>";
            foreach ((array)$topic_rows as $t_value) {
                if ($t_value['topic_group_id'] == $display_topic['topic_group_id'])
                    echo "<li>" . $t_value['description'] . "</li>";
            }
            echo "</td>";

            echo " <td>
                     <span id='results_{$row_class["class_id"]}' class='text'> $display_topic[date] </span>
                     <input type='text' size='10' name='topic[date_topic][]' value='$display_topic[date]' history='{$i}' class='editbox_{$row_class["class_id"]} editbox date_topic'>
                   </td >";

            echo " <td>
                     <span id='results_{$row_class["class_id"]}' class='text'>  $display_topic[time_from]  </span>
                     <input type='text' size='10' name='topic[time_from_topic][]' value=' $display_topic[time_from] ' class='editbox_{$row_class["class_id"]} editbox time_topic'>
                   </td >";

            echo " <td>
                     <span id='results_{$row_class["class_id"]}' class='text'>  $display_topic[time_to]  </span>
                     <input type='text' size='10' name='topic[time_to_topic][]' value=' $display_topic[time_to] ' class='editbox_{$row_class["class_id"]} editbox time_topic'>
                   </td >";


            echo "</tr>";
        }
        echo "</table>";

        echo "</td>";
        echo "</tr>";

    }

    ?>

</table>
</form>

    <script>
        $(".show_details").click(function(){
            var class_id = $(this).attr('id');
            $(".details").hide(100);

            if($(this).hasClass("plus")) {
                $(".show_details").removeClass("minus");
                $(".show_details").addClass("plus");

                $(this).addClass("minus");
                $(this).removeClass("plus");
            } else {
                $(this).removeClass("minus");
                $(this).addClass("plus");
                $(".show_details").addClass("plus");
            }

            if (!$("#details_row_"+class_id).is(":visible") || $("#edit_mode_"+class_id).attr('edit_mode') == "off")
                $("#details_row_"+class_id).show();

        });

        $(".edit").click(function(){
            var c_id = $(this).attr('id');
            $(".show_details_"+c_id).trigger("click");
            $("#edit_mode_"+c_id).attr('edit_mode','on')


        });

        $(".municipality").change(function () {

            var id_split = $(this).attr('id').split("_");
            var class_number = id_split[1];
            console.log(class_number);
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
                    $('.location_'+class_number)
                        .find('option:gt(0)')
                        .remove('')
                        .end()
                        .append(html)
                    ;
                }
            });

        });

    </script>

<?php include $project_root . 'views/layout/footer.php'; ?>