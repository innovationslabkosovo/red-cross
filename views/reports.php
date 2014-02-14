<?php
$page_title = "Raportet e Punës së Kryqit të Kuq";

include '../core/init.php';
protect_page();
$user_id = $_SESSION['id'];
include $project_root . 'views/layout/header.php';

$mun_access = "";
$include_user = "";

if (!is_admin($user_id))
{
    $include_user = ", User u ";
    $mun_access = "where m.municipality_id = u.municipality_id and  u.user_id=$user_id";
}


$get_municipalities = "SELECT m.municipality_id, m.name FROM Municipality as m". $include_user.$mun_access;
$municipalities = mysql_query($get_municipalities);

$month = $_GET["month"];
if ($month == ""){
    $currentMonth = date('F');
    $month = Date('F', strtotime($currentMonth . " last month"));
}

$municipality = $_GET["municipality"];

?>
<html>
<head>
    <title>Raportet e Punës së Kryqit të Kuq</title>
</head>
<body>
<br>
<h2>Zgjedhni Vitin për Raportin Vjetor në Kosovë</h2>
<form action="../core/application/annual_report.php" method="POST">
    <div class="dropdown">
        <select name="year" class="dropdown-select">
            <option value="">Zgjedh Vitin</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
        </select>
    </div>
    <input type="submit" name="GO" value="Gjenero" class="align-top"/>
</form>
<hr>
<br>
<h2>Zgjedhni Vitin dhe Muajin për Raportin Mujor në Kosovë</h2>
<form action="../core/application/annual_monthly_report.php" method="POST">
    <div class="row">
    <div class="dropdown" style="vertical-align: bottom">
        <select name="year" class="dropdown-select">
            <option value="">Zgjedh Vitin</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
        </select>
    </div>
        <input type="text" name="date_from" id="date_from" class="date txfform-wrapper input" data-validation='required date'
                                  data-validation-format='yyyy-mm-dd' placeholder="Nga Data">
        <input type="text" name="date_to" id="date_to" class="date txfform-wrapper input" data-validation='required date'
                                  data-validation-format='yyyy-mm-dd' placeholder="Deri">
        <input type="submit" name="GO" value="Gjenero" class="align-top"/><br>
    </div>
</form>
<hr>
<br>
<h2>Raporti Mujor Komunal</h2>

<form action="../core/application/municipal_report.php" method="POST">
    <div class="dropdown">
        <select name="year" class="dropdown-select">
            <option value="">Zgjedh Vitin</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
        </select>
    </div>

    <div class="dropdown">
    <select name="month" class="dropdown-select">
        <option value="">Zgjedh Muajin</option>
        <option value="01">Janar</option>
        <option value="02">Shkurt</option>
        <option value="03">Mars</option>
        <option value="04">Prill</option>
        <option value="05">Maj</option>
        <option value="06">Qershor</option>
        <option value="07">Korrik</option>
        <option value="08">Gusht</option>
        <option value="09">Shtator</option>
        <option value="10">Tetor</option>
        <option value="11">Nentor</option>
        <option value="12">Dhjetor</option>
    </select>
    </div>
    <div class="dropdown">
    <select name="municipality" class="dropdown-select">
        <option value=0>Zgjedh Komunen
            <?php
            while($row = mysql_fetch_array($municipalities))
            {
                $name=$row["name"];
                $select=$row["municipality_id"];
                echo "<OPTION VALUE=\"$select\">".$name.'</option>';
            }
            ?>
    </select>
    </div>
    <input type="submit" name="GO" value="Gjenero" class="align-top"/>
</form>
<hr>
<br>
<h2>Raporti i Suksesit për Pyetje</h2>
<form action="question_class_report.php" method="GET">
<div class="dropdown">
<select name="mun_id" id="municipality_id" class="municipality_id dropdown-select" value="<?php echo $municipality_id; ?>">
    <option value="">Zgjedh Komunen</option>
    <?php
    mysql_data_seek($municipalities, 0);
    while($row = mysql_fetch_array($municipalities))
    {
        $name=$row["name"];
        $select=$row["municipality_id"];
        echo "<OPTION VALUE=\"$select\">".$name.'</option>';
    }
    ?>
</select>
</div>
<div class="dropdown">
<select name="class_id" id="class_id" class="class_id dropdown-select">
    <option value="">Zgjedh Klasen</option>
</select>
</div>
<div class="dropdown">
<select name="question_id" id="questions" class="dropdown-select">
    <option value="">Zgjedh Pytjen</option>
<?php
$get_all_questions = "SELECT * FROM Question";
$questions = mysql_query($get_all_questions);
    while ($question = mysql_fetch_object($questions)) {
        echo "<option value='$question->question_id'>$question->description</option>";
    }
?>
</select>
</div>
<input type="submit" value="Gjenero" class="align-top">
</form>
<hr>
<br>
<h2>Raporti i Suksesit për Pjesëmarrës</h2>
<form action="participant_class_report.php" method="GET">
<div class="dropdown">
<select name="mun_id" id="municipality_id" class="municipality_id dropdown-select" value="<?php echo $municipality_id; ?>">
    <option value="">Zgjedh Komunen</option>
    <?php
    mysql_data_seek($municipalities, 0);
    while($row = mysql_fetch_array($municipalities))
    {
        $name=$row["name"];
        $select=$row["municipality_id"];
        echo "<OPTION VALUE=\"$select\">".$name.'</option>';
    }
    ?>
</select>
</div>
<div class="dropdown">
<select name="class_id" id="class_id" class="class_id dropdown-select">
    <option value="">Zgjedh Klasen</option>
</select>
</div>
<input type="submit" value="Gjenero" class="align-top">
</form>
</body>
<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/class_report.js">
    $.validate();
</script>
</html>