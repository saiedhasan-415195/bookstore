<?php 
include 'connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom admin css file link -->
    <link rel="stylesheet" href="admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .btn {
            display: inline-block;
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h2>Order</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Image</th>
                    <th>Product Category</th>
                    <th>Product Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM product";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$row['product_id']."</td>";
                            echo "<td>".$row['product_name']."</td>";
                            echo "<td>".$row['product_price']."</td>";
                            echo "<td>".$row['product_quantity']."</td>";
                            echo "<td><img src='images/".$row['product_image']."' alt='product image'></td>";
                            echo "<td>".$row['product_category']."</td>";
                            echo "<td>".$row['product_description']."</td>";
                            echo "<td>
                                    <a href='edit_product.php?product_id=".$row['product_id']."' class='btn'>Edit</a>
                                    <a href='delete_product.php?product_id=".$row['product_id']."' class='btn'>Delete</a>
                                </td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
