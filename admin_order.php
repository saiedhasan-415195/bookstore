<?php
include 'components/pdo-connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure only admins can access this page
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location: login.php');
    exit;
}

// Handle status update for orders
if (isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
    $action = $_POST['action'];

    $new_status = ($action === 'accept') ? 'Accepted' : 'Rejected';

    $update_order = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $update_order->execute([$new_status, $order_id]);

    if ($update_order->rowCount() > 0) {
        echo "<script>alert('Order status updated to $new_status.');</script>";
    } else {
        echo "<script>alert('Failed to update order status.');</script>";
    }
}

// Retrieve orders for the current user
$query = $conn->prepare("SELECT o.id, b.name, o.status, o.order_date, u.username
                         FROM orders o
                         JOIN books b ON o.book_id = b.id
                         JOIN users u ON o.user_id = u.id");
$query->execute();
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Orders</title>
    <link rel="stylesheet" href="path/to/daisyui.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="flex justify-center flex-col w-full items-center m-10">
        <h2>All Orders</h2>
        <?php if (!empty($orders)): ?>
            <div class="overflow-x-auto flex item-center justify-center max-w-2xl">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr class="m-2">
                                <td><?= htmlspecialchars($order['name']); ?></td>
                                <td><?= htmlspecialchars($order['username']); ?></td>
                                <td><?= htmlspecialchars($order['status']); ?></td>
                                <td><?= htmlspecialchars($order['order_date']); ?></td>
                                <td>
                                    <?php if ($order['status'] === 'Pending'): ?>
                                        <form action="" method="post" class="inline-block">
                                            <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                            <button type="submit" name="action" value="accept" class="btn btn-success"
                                                onclick="return confirm('Accept this order?');">Accept</button>
                                        </form>
                                        <form action="" method="post" class="inline-block">
                                            <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                                            <button type="submit" name="action" value="reject" class="btn btn-error"
                                                onclick="return confirm('Reject this order?');">Reject</button>
                                        </form>
                                    <?php else: ?>
                                        <span><?= htmlspecialchars($order['status']); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </div>
</body>

</html>