<?php
require 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['product_image'])) {
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productImage = $_FILES['product_image'];

    // Handle image upload
    $imageName = time() . '_' . basename($productImage['name']);
    $targetDir = 'uploads/';
    $targetFile = $targetDir . $imageName;

    if (move_uploaded_file($productImage['tmp_name'], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $productName, $productPrice, $imageName);
        $stmt->execute();
        $stmt->close();
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo "Error uploading image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>
        <label for="product_price">Product Price:</label>
        <input type="text" name="product_price" id="product_price" required>
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" id="product_image" required>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>