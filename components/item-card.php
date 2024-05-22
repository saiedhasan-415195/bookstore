<?php
include 'pdo-connect.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM books WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo "<script>alert('Book deleted successfully.'); window.location.href='{$_SERVER['PHP_SELF']}';</script>";
    } else {
        echo "<script>alert('Failed to delete book.');</script>";
    }
}

// Fetch all books from the database
$stmt = $conn->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Iterate over each book and render using item card component -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 p-8">
<?php foreach ($books as $book): ?>
    <div class="card w-96 bg-base-100 shadow-xl m-2">
        <figure><img class="w-full h-96" src="uploaded_img/<?= $book['image_01']; ?>" alt="<?= $book['name']; ?>" /></figure>
        <div class="card-body">
            <h2 class="card-title"><?= $book['name']; ?></h2>
            <p>$<?= $book['price']; ?></p>
            <p>Author: <?= $book['author_name']; ?></p>
            <p><?= $book['details']; ?></p>
            <div class="card-actions justify-between">
                <a href="update_book.php?id=<?= $book['id']; ?>" class="btn btn-primary">Update</a>
                <!-- <a href="products.php?delete=<?= $book['id']; ?>" class="btn btn-primary" onclick="return confirm('Delete this product?');">Delete</a> -->
                <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?delete=' . htmlspecialchars($book['id']); ?>" class="btn btn-primary" onclick="return confirm('Delete this product?');">Delete</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
