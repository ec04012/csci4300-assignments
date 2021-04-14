<?php
// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
// Validate inputs
if ($category_id == null || $category_id == false || $code == null|| $name == null || $price == null || $price == false ) {
	$error = "Invalid product data. Check all fields and try again.";
	include('error.php'); 
} else {
	require_once('database.php');
	//Add the product to the database  
	$query = 'INSERT INTO products(categoryID, productCode, productName, listPrice) VALUES(:category_id, :code, :name, :price)';
	$statement = $db->prepare($query);
	$statement->bindValue(':category_id', $category_id);
	$statement->bindValue(':code', $code);
	$statement->bindValue(':name', $name);
	$statement->bindValue(':price', $price);
	$statement->execute();
	$statement->closeCursor();
	// Display the Product List page	
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Guitar Shop</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<header><h1>Product Manager</h1></header>
	<main>
		<h1>Add Product</h1>
		<form action="add_product.php" method="post" id="add_product_form">
			<label>Category:</label>
			<select name="category_id">
				<?php foreach ($categories as $category) : ?>
					<option value="<?php echo $category['categoryID']; ?>">
						<?php echo $category['categoryName']; ?>
					</option>
				<?php endforeach; ?>
			</select><br>
			<label>Code:</label>
			<input type="text" name="code"><br>
			
			<label>Name:</label>
			<input type="text" name="name"><br>
			
			<label>List Price:</label>
			<input type="text" name="price"><br>
			
			<label>&nbsp;</label>
			<input type="submit" value="Add Product"><br>
		</form>
		<p><a href="index.php">View Product List</a></p>
	</main>
	<footer>
		<p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
	</footer>
</body>
</html>