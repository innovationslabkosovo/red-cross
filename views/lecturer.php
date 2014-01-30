<?php 
$page_title = "Ligjeruesit";
include '../init.php';
protect_page();
include 'inc/overall/header.php'; ?>
  <h1>Lecturers</h1>

<?php
$result = mysql_query("SELECT lecturer.name, lecturer.surname, lecturer.email, category.name , COUNT(class_lecturer.lecturer_id)
			FROM lecturer, category, class_lecturer
			WHERE lecturer.id = class_lecturer.lecturer_id AND category.id = class_lecturer.category_id
			GROUP BY class_lecturer.lecturer_id, class_lecturer.category_id");

echo "<table border='1'>
<tr>
<th>Name</th>
<th>Surname</th>
<th>E-mail</th>
<th>Category</th>
<th>Class</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row[0] . "</td>";
  echo "<td>" . $row[1] . "</td>";
  echo "<td>" . $row[2] ."</td>";
  echo "<td>" . $row[3] ."</td>";
  echo "<td>" . $row[4] . "</td>";
  echo "</tr>";
  }
echo "</table>";

?>

<?php include 'inc/overall/footer.php'; ?>