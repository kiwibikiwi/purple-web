<?php
session_start();
require 'dbconnection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch products
$product_query = "SELECT * FROM products";
$product_result = mysqli_query($conn, $product_query);
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

// Fetch users
$user_query = "SELECT * FROM users";
$user_result = mysqli_query($conn, $user_query);
$users = mysqli_fetch_all($user_result, MYSQLI_ASSOC);

// Check for form submission for adding a product
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

// Check for form submission for deleting a user
if (isset($_GET['delete_user_id'])) {
    $userId = $_GET['delete_user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <h2>Products</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50"></td>
            <td>
                <a href="admin_dashboard.php?delete_product_id=<?php echo $product['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>
        <label for="product_price">Product Price:</label>
        <input type="text" name="product_price" id="product_price" required>
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" id="product_image" required>
        <button type="submit">Add Product</button>
    </form>

    <h2>Users</h2>
    <table>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['full_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
                <a href="admin_dashboard.php?delete_user_id=<?php echo $user['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>