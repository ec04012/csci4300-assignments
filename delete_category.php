<?php
require_once('database.php');
$category = $_POST['category_name'];
$query = "DELETE FROM categories WHERE categoryName = '{$category}'";
$statement = $db->prepare($query);
$success = $statement->execute();
$category_id = $_POST['category_id'];
$query = "DELETE FROM products WHERE categoryID = '{$category_id}'";
$statement = $db->prepare($query);
$success = $statement->execute();
$statement->closeCursor();    
include('category_list.php');
?>