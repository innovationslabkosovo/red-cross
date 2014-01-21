<?php
$page_title = "Lista e klasave";

include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php';



$get_class_details = "SELECT c.class_id, tr.name as tr_name, tr.surname as tr_surname, l.name as l_name, m.name as m_name, test.name as t_name, c.date_from, c.date_to, c.gateway
                      FROM Class c, Trainer tr, Location l, Municipality m, Test test
                      WHERE c.trainer_id = tr.trainer_id
                      and c.location_id = l.location_id
                      and l.municipality_id = m.municipality_id
                      and c.test_id = test.test_id";
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

<table class="bordered">

    <tr>
        <th >ID</th>
        <th >Komuna</th>
        <th style="width: 15%">Fshati</th>
        <th style="width: 20%">Traineri</th>
        <th style="width: 10%">Data prej</th>
        <th style="width: 10%">Data deri</th>
        <th style="width: 10%">Detajet e Temave</th>
        <th style="width: 10%">Modifiko</th>
    </tr>
    <?php
    while ($row_class = mysql_fetch_assoc($class_details)) {
        echo "<tr>";
        echo "<td> $row_class[class_id]</td >";
        echo "<td> $row_class[m_name]</td >";
        echo "<td> $row_class[l_name]</td >";
        echo " <td> $row_class[tr_name]  $row_class[tr_surname]</td >";
        echo " <td> $row_class[date_from] </td >";
        echo " <td> $row_class[date_to] </td >";
        echo " <td> <span class='show_details' id='$row_class[class_id]'>+</span> </td >";
        echo " <td> </td >";

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
            echo "<td> $display_topic[tg_name]</td >";

            echo "<td>";
            foreach ((array)$topic_rows as $t_value) {
                if ($t_value['topic_group_id'] == $display_topic['topic_group_id'])
                    echo "<li>" . $t_value['description'] . "</li>";
            }
            echo "</td>";

            echo "<td> $display_topic[date]</td >";
            echo " <td> $display_topic[time_from] </td>";
            echo " <td> $display_topic[time_to] </td >";
            echo "</tr>";
        }
        echo "</table>";

        echo "</td>";
        echo "</tr>";

    }

    ?>

</table>

    <script>
        $(".show_details").click(function(){
            var class_id = $(this).attr('id');
            $(".details").hide(100);
            $("#details_row_"+class_id).show(800);
        });

    </script>

<?php
if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>