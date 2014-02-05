<?php
$page_title = "Lista e supervizoereve";
include '../core/init.php';
protect_page();
include $project_root . 'views/layout/header.php'; ?>
    <h3>Lista e supervizoreve</h3>

<?php
$result = mysql_query("SELECT Supervisor.name, Supervisor.surname, Supervisor.email, Supervisor.phone
 FROM Supervisor");

echo "<table border='1' class = 'bordered'>
<tr>
<th>Emri</th>
<th>Mbiemri</th>
<th>E-maili</th>
<th>Telefoni</th>
</tr>";

while($row = mysql_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] ."</td>";
    echo "<td>" . $row[3] ."</td>";
    echo "</tr>";
}
echo "</table>";

?>


<?php include $project_root . 'views/layout/footer.php'; ?>