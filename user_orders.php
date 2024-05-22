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

// Retrieve orders for the current user
$query = $conn->prepare("SELECT o.id, b.name, o.status, o.order_date
                         FROM orders o
                         JOIN books b ON o.book_id = b.id
                         WHERE o.user_id = ?");
$query->execute([$user_id]);
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" href="path/to/daisyui.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="flex justify-center flex-col w-full items-center m-10">
        <h2>Your Orders</h2>
        <?php if (!empty($orders)): ?>
            <div class="overflow-x-auto flex item-center justify-center max-w-2xl">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr class="m-2">
                                <td><?= htmlspecialchars($order['name']); ?></td>
                                <td><?= htmlspecialchars($order['status']); ?></td>
                                <td><?= htmlspecialchars($order['order_date']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>You have no orders.</p>
        <?php endif; ?>
    </div>
</body>

</html>
