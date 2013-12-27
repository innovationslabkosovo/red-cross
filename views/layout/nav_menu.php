<nav>
    <ul>
        <li><a href="<?php echo BASE_URL; ?>/views/index.php">Home</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/create_class.php">Class</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/create_location.php">Locations</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/newlecturer.php">New lecturers</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/category.php">Categories</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/lecturer.php">Lecturers</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/krijo_pyetje.php">Test questions</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/listo_pytje.php">Questions listing</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/krijo_test.php">Create test</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/listo_testet.php">Tests listing</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/krijo_participant.php">Participants</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/shto_pergjigjje.php">Add answers</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/create_topic_group.php">Manage Topic Groups</a></li>
        <li><a href="<?php echo BASE_URL; ?>/views/create_topic.php">Manage Topics</a></li>
    </ul>
</nav>
<ul id="menu">
    <!-- Top Menu without children -->
    <li><a href="<?php echo BASE_URL; ?>/views/index.php">Home</a></li>
    <li><a href="<?php echo BASE_URL; ?>/views/create_class.php">Class</a></li>
    <li><a href="<?php echo BASE_URL; ?>/views/create_location.php">Locations</a></li>
    <!-- Top Menu-->
    <li>
        Manage and Create Topics
        <ul id="sub_menu">
            <!-- Child Menu -->
            <li><a href="<?php echo BASE_URL; ?>/views/create_topic_group.php">Manage Topic Groups</a></li>
            <li><a href="<?php echo BASE_URL; ?>/views/create_topic.php">Manage Topics</a></li>
        </ul>
    </li>
</ul>


<style>
    .active {
        color: #767676 !important;
    }
</style>

<?php
$pages = array();
$pages["index.php"] = "Home";
$pages["create_class.php"] = "Class";
$pages["frauensauna.php"] = "Frauensauna";
$pages["custom.php"] = "Beauty Lounge";
$pages["feiertage.php"] = "Feiertage";

$current_page = explode("/", $_SERVER['SCRIPT_NAME']);
$activePage = $current_page[3];
$views = 'views';
?>

<?php foreach($pages as $url=>$title):?>
    <li>
        <a <?php if($url === $activePage):?>class="active"<?php endif;?> href="<?php echo BASE_URL.DIRECTORY_SEPARATOR.$views.DIRECTORY_SEPARATOR.$url;?>">
            <?php echo $title;?>
        </a>
    </li>
<?php endforeach;?>