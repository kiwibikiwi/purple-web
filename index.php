<?php
require 'dbconnection.php';

// Fetch products from the database
$product_query = "SELECT * FROM products";
$product_result = mysqli_query($conn, $product_query);
$products = mysqli_fetch_all($product_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purple Star</title>
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
</head>
<body>
    <!-- Navbar Start -->
    <?php include 'include/navbar.php'; ?>

    <!-- Product Grid -->
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                    <?php foreach ($products as $product): ?>
                    <div class="product-item">
                        <div class="product">
                            <div class="product_image">
                                <img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                            </div>
                            <div class="product_info">
                                <h6 class="product_name"><a href="single.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h6>
                                <div class="product_price">$<?php echo $product['price']; ?></div>
                            </div>
                        </div>
                        <div class="red_button add_to_cart_button"><a href="#" onclick="addToCart('<?php echo $product['name']; ?>', <?php echo $product['price']; ?>)">add to cart</a></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>