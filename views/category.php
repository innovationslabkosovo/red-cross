<?php 
$page_title = "Add category";
include '../core/init.php';
protect_page();
$errors = array();
include $project_root . 'views/layout/header.php'; ?>
	<h1>Add new category</h1>
<form action="../core/application/create_category.php" method="post">


<table border="0">
<tr>
<td>Category name:</td><td><input type="text" name="category"></td>
</tr>
<tr>
<td>&nbsp;</td><td><input type="submit" value="Save!"></td>
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