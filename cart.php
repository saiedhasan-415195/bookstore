<?php
include 'components/pdo-connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

// Handle item removal from cart
if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_NUMBER_INT);

    $delete_cart_item = $conn->prepare("DELETE FROM carts WHERE id = ? AND user_id = ?");
    $delete_cart_item->execute([$cart_id, $user_id]);

    if ($delete_cart_item->rowCount() > 0) {
        echo "<script>alert('Item removed from cart.');</script>";
    } else {
        echo "<script>alert('Failed to remove item.');</script>";
    }
}

// Handle order placement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    try {
        // Start a transaction
        $conn->beginTransaction();

        // Retrieve cart items for the current user
        $query = $conn->prepare("SELECT book_id, quantity FROM carts WHERE user_id = ?");
        $query->execute([$user_id]);
        $cart_items = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($cart_items)) {
            // Insert each cart item into the orders table
            $insert_order = $conn->prepare("INSERT INTO orders (book_id, user_id, status, order_date) VALUES (?, ?, 'Pending', NOW())");

            foreach ($cart_items as $item) {
                $insert_order->execute([$item['book_id'], $user_id]);
            }

            // Delete cart items after they have been added to the orders table
            $delete_cart_items = $conn->prepare("DELETE FROM carts WHERE user_id = ?");
            $delete_cart_items->execute([$user_id]);

            // Commit the transaction
            $conn->commit();

            echo "<script>alert('Order placed successfully.');</script>";
        } else {
            echo "<script>alert('Your cart is empty.');</script>";
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollBack();
        echo "<script>alert('Failed to place order. Please try again.');</script>";
    }
}

// Retrieve cart items for the current user
$query = $conn->prepare("SELECT c.id, b.name, b.price, c.quantity, b.image_01 
                         FROM carts c 
                         JOIN books b ON c.book_id = b.id 
                         WHERE c.user_id = ?");
$query->execute([$user_id]);
$cart_items = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    <!-- <link rel="stylesheet" href="saied.css"> -->
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="flex justify-center flex-col w-full items-center m-10">
        <!-- <h2>Your Cart</h2> -->
        <?php if (!empty($cart_items)): ?>
            <div class="overflow-x-auto flex item-center justify-center max-w-2xl">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Book Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                            <tr class="m-2">
                                <td><img src="uploaded_img/<?= htmlspecialchars($item['image_01']); ?>" alt="Book Image"
                                        width="100px" class="w-20 h-20" height="100px"></td>
                                <td><?= htmlspecialchars($item['name']); ?></td>
                                <td>$<?= number_format($item['price'], 2); ?></td>
                                <td><?= htmlspecialchars($item['quantity']); ?></td>
                                <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <form action="" method="get">
                                        <input type="hidden" name="cart_id" value="<?= $item['id']; ?>">
                                        <button type="submit" class="btn btn-primary"
                                            onclick="return confirm('Remove this item?');">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

        <form action="" method="post">
            <button type="submit" name="place_order" class="btn btn-secondary btn-block"
                    onclick="return confirm('Are you sure you want to place the order?');">ORDER</button>
        </form>
    </div>
</body>

</html>
