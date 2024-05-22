<?php
include 'connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM messages WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: admin_panel.php'); // Redirect back to the admin panel
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header('Location: admin_panel.php');
    exit;
}
?>
