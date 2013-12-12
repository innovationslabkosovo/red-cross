<?php
/**
 * Created by PhpStorm.
 * User: lulzim
 * Date: 11/23/13
 * Time: 10:25 PM
 */

$page_title = "Shto lokacion";
include '../core/init.php';
protect_page();
$errors = array();
include 'layout/header.php';

$get_municipalities = "SELECT municipality_id, name, coords FROM Municipality ";
$municipalities = mysql_query($get_municipalities);
?>

    <script type="text/javascript" src="http://openlayers.org/dev/OpenLayers.js"></script>
    <meta charset=utf-8/>
    <title>Red Cross - Lokacionet</title>
    <style>
        article, aside, figure, footer, header, hgroup,
        menu, nav, section {
            display: block;
        }
    </style>

    <form name="input" action="<?php echo BASE_URL; ?>/core/application/create_location.php" method="post">
        <h1>Shto nje lokacion te ri</h1>

        <div id="map" class="smallmap" style="width:625px; height:350px"></div>
        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="lon" name="lon">

        <br/>
        <label for="select_city"></label>
        <select name="municipality" id="select_city">
            <option value="">-Zgjidhni Qytetin-</option>
            <?php
            create_options_municipality($municipalities, "municipality_id", "name", "coords");
            ?>
        </select><br/><br/>
        <label for="name"></label>
        <input type="text" name="name" id="name" value="-Lokacioni-" onfocus="if(this.value == '-Lokacioni-') this.value=''"><br/><br/>
        <input type="submit" value="Ruaj!">
    </form>
<?php
if (isset($_GET['message']) && isset($_GET['object'])) {
    echo $display_messages[$_GET['object']][$_GET['message']];
}
?>

    <script type="text/javascript" src="<?php echo BASE_URL; ?>/js/map.js"></script>
    <script type="text/javascript"> $.validate(); </script>

<?php include $project_root . 'views/layout/footer.php'; ?>