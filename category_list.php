<?php
require_once('database.php');
// Get category ID
if (!isset($category_id)) {
	$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
	if ($category_id == NULL || $category_id == FALSE) {
		$category_id = 1;
	}
}

$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="table.css">
    <link rel="stylesheet" type="text/css" href="category.css">
    <title>My Guitar Shop</title>
</head>
<body>
    <h1 class="title">Product Manager</h1>
    <h2 class="gold">Category List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
                <form action="delete_category.php" method="post" id="category_list">
                    <tr>
                        <td>
                            <?php echo $category['categoryName']; ?>
                            <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                            <input type="hidden" name="category_name" value="<?php echo $category['categoryName']; ?>">
                        </td>
                        <td>
                            <input type="submit" value="Delete">
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2 class="gold">Add Category</h2>
    <form action="add_category.php" method="post" id="add_category_form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <input type="submit" value="Add">
    </form>

    <a href="index.php"><h3>List Products</h3></a>

    <footer>
		<p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
	</footer>   
</body>
</html>