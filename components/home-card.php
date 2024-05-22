<?php
include 'pdo-connect.php';



// Fetch all books from the database
$stmt = $conn->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
include 'pdo-connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    $book_id = $_POST['book_id'];
    $quantity = $_POST['quantity'];

    // Sanitize input
    $book_id = filter_var($book_id, FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

    if ($quantity > 0) {
        $add_to_cart = $conn->prepare("INSERT INTO carts (user_id, book_id, quantity) VALUES (?, ?, ?)");
        $add_to_cart->execute([$user_id, $book_id, $quantity]);

        if ($add_to_cart->rowCount() > 0) {
            echo "Book added to cart successfully!";
        } else {
            echo "Failed to add book to cart.";
        }
    } else {
        echo "Please enter a valid quantity.";
    }
}
?>


<!-- Iterate over each book and render using item card component -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 p-8">
    <?php foreach ($books as $book): ?>
        <div class="card w-96 bg-base-100 shadow-xl m-2">
            <figure><img class="w-full h-96" src="uploaded_img/<?= $book['image_01']; ?>" alt="<?= $book['name']; ?>" />
            </figure>
            <div class="card-body">
                <h2 class="card-title"><?= $book['name']; ?></h2>
                <p>$<?= $book['price']; ?></p>
                <p>Author: <?= $book['author_name']; ?></p>
                <p><?= $book['details']; ?></p>
                <div class="card-actions justify-between">
                    <form action="" method="post">
                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($book['id']); ?>">
                        <input type="number" name="quantity" placeholder="Enter Quantity"
                            class="input input-bordered border-red-100 w-40" required min="1" />
                        <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>