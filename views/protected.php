<?php 
include '../core/init.php';
include $project_root.'views/layout/header.php';

if (isset($_GET['403']))
{
    ?>
    <h1>Error 403 Forbidden</h1>
    <p> You don't have permission to view this page</p>
    <?php
}else
{
?>
  <h1>Sorry, you need to be logged in</h1>
  <p>Please, log in.</p>
<?php } ?>

<?php include $project_root.'views/layout/footer.php'; ?>