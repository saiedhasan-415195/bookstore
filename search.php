<?php
include 'components/pdo-connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];

// Check if the search form was submitted
$search_query = '';
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $search_query = filter_var($search_query, FILTER_SANITIZE_STRING);

    // Fetch books based on the search query
    $stmt = $conn->prepare("SELECT * FROM books WHERE name LIKE ?");
    $stmt->execute(['%' . $search_query . '%']);
} else {
    // Fetch all books if no search query is provided
    $stmt = $conn->prepare("SELECT * FROM books");
    $stmt->execute();
}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="path/to/daisyui.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="flex justify-center flex-col w-full items-center m-10">
        <h2>Search Results for "<?= htmlspecialchars($search_query); ?>"</h2>
        <!-- Iterate over each book and render using item card component -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 p-8">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $book): ?>
                    <div class="card w-96 bg-base-100 shadow-xl m-2">
                        <figure><img class="w-full h-96" src="uploaded_img/<?= $book['image_01']; ?>" alt="<?= $book['name']; ?>" /></figure>
                        <div class="card-body">
                            <h2 class="card-title"><?= htmlspecialchars($book['name']); ?></h2>
                            <p>$<?= htmlspecialchars($book['price']); ?></p>
                            <p>Author: <?= htmlspecialchars($book['author_name']); ?></p>
                            <p><?= htmlspecialchars($book['details']); ?></p>
                            <div class="card-actions justify-between">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['id']); ?>">
                                    <input type="number" name="quantity" placeholder="Enter Quantity" class="input input-bordered border-red-100 w-40" required min="1" />
                                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No books found matching your search query.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
