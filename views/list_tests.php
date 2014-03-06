<?php
	$page_title = "Lista e Testeve";
	include '../core/init.php';
	protect_page();
	include $project_root . 'views/layout/header.php';
	$errors = array();
	$base_url = BASE_URL;
?>

<?php

	$query = mysql_query("SELECT * FROM Test ORDER BY test_id desc");

    $get_class_topics = "SELECT q.question_id, q.description,tq.question_id,tq.test_id q_name
                     FROM Question q, TestQuestion tq
                     WHERE q.question_id = tq.question_id ";
    $class_topics = mysql_query($get_class_topics);

    $i = 0;
    while ($row_class_topics = mysql_fetch_assoc($class_topics)) {

        $class_topic[$row_class_topics['question_id']][$i]['question_id'] = $row_class_topics['question_id'];
        $class_topic[$row_class_topics['description']][$i]['description'] = $row_class_topics['description'];
        $class_topic[$row_class_topics['class_id']][$i]['date'] = $row_class_topics['date'];
        // $class_topic[$row_class_topics['class_id']][$i]['time_from'] = $row_class_topics['time_from'];
        // $class_topic[$row_class_topics['class_id']][$i]['time_to'] = $row_class_topics['time_to'];
        // $class_topic[$row_class_topics['class_id']][$i]['tg_name'] = $row_class_topics['tg_name'];
        $i++;
    }

	echo '<div class="form-error-message hide"></div>';
	echo "<form id='url' class='edit_tests_view' action='{$base_url}/core/application/edit_test.php' >";
	echo "<table  class = 'bordered'>";
	echo "<tr><th>Emri</th><th>Pyetjet</th><th>Edito</th></tr>";
	
	while ($result = mysql_fetch_assoc($query)) {

		echo "<tr id = '{$result["test_id"]}' class=\"edit_tr\"><td>"
		."<span id='results_{$result["test_id"]}' class='text'>{$result["name"]}</span>"
		."<input name='test_description' data-validation='required' type='text' class='editbox_{$result["test_id"]} editbox txfform-wrapper input' value='{$result["name"]}' />"
		."</td>";

		echo " <td class='show_details_parent'> <span class='plus show_details show_details_{$result["test_id"]}' id='{$result["test_id"]}'></span> </td >";

		echo "<td>"."<input type='hidden' name='id' class='editbox_{$result["test_id"]} editbox' value='{$result["test_id"]}' />"
		."<input type='button' value='Ruaj' class='save_{$result["test_id"]} save submitSmlBtn' id='{$result["test_id"]}'>"
        ."<input type='button' value='Perditeso' class='edit_{$result["test_id"]} edit submitSmlBtn' id='{$result["test_id"]}'>"
        ."<input type='button' value='Anulo' class='cancel_{$result["test_id"]} cancel submitSmlBtn' id='{$result["test_id"]}' style='display:none;' >"
		."</td>";
        echo "</tr>";

        echo "<tr  style='display: none' id='details_row_$row_class[class_id]' class='details'>";
            echo "<td colspan='3'>";


            echo "<table class='zebra'>";
            echo "<tr>";

            echo "<td>Numri</td>";
            echo "<td>Temat</td>";


            echo "</tr>";



        foreach ($test_questions as $display_topic)
        {
            echo "<tr>";
            echo "<td> $display_topic[q_name]";
            echo "<input type='hidden' value='$display_topic[topic_group_id]' name='topic[topic_group_id][]' class='editbox_{$row_class["class_id"]}'></td >";

            echo "<td>";
            foreach ((array)$topic_rows as $t_value) {
                if ($t_value['question_id'] == $display_topic['question_id'])
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

	}


	
	 echo "</tr>";
 	echo "</table>";
	echo "</form>";
	echo "</div>";

    

 ?>
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
</script>
<?php include $project_root . 'views/layout/footer.php'; ?>