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
include $project_root . 'views/layout/footer.php';
?>