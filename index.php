<?php
require_once('database.php');

if (!isset($category_id)) {
	$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
	if ($category_id == NULL || $category_id == FALSE) {
		$queryCategory = 'SELECT categoryID FROM categories LIMIT 1';
		$statement1 = $db->prepare($queryCategory);
		$statement1->execute();
		$category = $statement1->fetch();
		$category_id = $category['categoryID'];
	}
}

$queryCategory = 'SELECT * FROM categories
					WHERE categoryID = :category_id';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();

$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

$queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
<title>My Guitar Shop</title>
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="table.css">
</head>

<body>
	<h1 class="title">Product Manager</h1>
		<h1 class="gold">Product List</h1>
		<div class="row">
			<div class="c1">
				<a style="text-decoration:none;" href="category_list.php"><h2 class="gold" id="category">Categories</h2></a>
				<nav>
				<ul class="list">
					<?php foreach ($categories as $category) : ?>
					<li>
						<a href="?category_id=<?php echo$category['categoryID']; 
						?>"><?php echo $category['categoryName']; ?></a>
					</li>
					<?php endforeach; ?>
				</ul>
				</nav>          
			</div>
			<div class="c2">
				<table class="items">
				<caption><h2 class="gold"><?php echo $category_name; ?></h2></caption>
					<tr>
						<th>Code</th>
						<th>Name</th>
						<th class="right">Price</th>
						<th></th>
					</tr>
					<?php foreach ($products as $product) : ?>
					<tr>
						<td><?php echo $product['productCode']; ?></td>
						<td><?php echo $product['productName']; ?></td>
						<td class="right"><?php echo $product['listPrice']; ?></td>
						<td><form action="delete_product.php" method="post">
							<input type="hidden" name="product_id"
								value="<?php echo $product['productID']; ?>">
							<input type="hidden" name="category_id"
								value="<?php echo $product['categoryID']; ?>">
							<input type="submit" value="Delete">
							</form></td>
					</tr>
					<?php endforeach; ?>
				</table>
				<p id="product" class="bold"><a id="product" href="add_product_form.php">Add Product</a></p>
			</div>
		</div>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
	</footer>    
</body>
</html>