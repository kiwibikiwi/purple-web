<?php
require 'dbconnection.php';

if (isset($_GET['delete_product_id'])) {
    $productId = $_GET['delete_product_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_dashboard.php');
    exit();
}
?>