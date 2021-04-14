<?php
require_once('database.php');
$category = $_POST['name'];
$query = "INSERT INTO categories (categoryName) VALUES('{$category}')";
$statement = $db->prepare($query);
$success = $statement->execute();
$statement->closeCursor();    
// Display the Product List page
header("Location: category_list.php");
?>