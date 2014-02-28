<?php 
include '../core/init.php';
include $project_root.'views/layout/header.php';

if (isset($_GET['403']))
{
    ?>
    <h1> Ju nuk keni qasje ne kete faqe!</h1>
    <?php
}else
{
?>
  <h1>Na vjen keq, ju duhet te kyqeni brenda platformes</h1>
<?php } ?>

<?php include $project_root.'views/layout/footer.php'; ?>