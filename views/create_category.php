<?php 
$page_title = "Krijo Kategori te Re";
include '../core/init.php';
protect_page();
$errors = array();
include $project_root . 'views/layout/header.php'; ?>
	<h1>Shto kategori te re</h1>
<form class="txfform-wrapper cf" name="category_form" action="../core/application/create_category.php" method="post">


<table border="0">
<tr>
<td>Emri i kategorise se re:</td><td><input type="text" placeholder="Name" name="category" id="category"></td>
</tr>
<tr>
<td>&nbsp;</td><td><input type="submit" value="Ruaj!"></td>
</tr>
</table>

</form>

<?php
if (isset($_GET['message']) && isset($_GET['object']))
{
    echo $display_messages[$_GET['object']][$_GET['message']];
}
include $project_root . 'views/layout/footer.php';
?>