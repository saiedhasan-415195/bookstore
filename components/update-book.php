<?php

include 'pdo-connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit; // Terminate script execution after redirection
}

if (isset($_POST['update_product'])) {
    $id = $_POST['id']; // Assuming there's an ID field in the form
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);
    $author_name = $_POST['author_name'];
    $author_name = filter_var($author_name, FILTER_SANITIZE_STRING);

    // You can add similar checks for other fields like image, category, etc.

    $update_book = $conn->prepare("UPDATE `books` SET name=?, price=?, details=?, author_name=? WHERE id=?");
    $update_book->execute([$name, $price, $details, $author_name, $id]);

    if ($update_book) {
        // Handle file upload if needed
        $message[] = 'Book updated successfully!';
    } else {
        $message[] = 'Failed to update book!';
    }
}

// Fetch book details to pre-fill the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_book = $conn->prepare("SELECT * FROM `books` WHERE id = ?");
    $select_book->execute([$id]);
    $book = $select_book->fetch(PDO::FETCH_ASSOC);
}

?>



<body>
    <?php include '../admin_header.php'; ?>
    <div class="flex justify-center my-10">
        <div class=" p-5 rounded bg-base-100 shadow-xl">
            <form class="max-w-lg  " action="" method="post" enctype="multipart/form-data">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Product Name</span>
                    </div>
                    <input type="text" name="name" placeholder="Type here" class="input input-bordered w-full max-w-xs"
                        value="<?php echo $book['name']; ?>" />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Book Price</span>
                    </div>
                    <input type="number" name="price" placeholder="Type here"
                        class="input input-bordered w-full max-w-xs" value="<?php echo $book['price']; ?>" />
                </label>

                <!-- Add fields for other attributes like image, category, etc. -->
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Pick a book photo</span>
                    </div>
                    <input type="file" name="image_01"
                        class="file-input file-input-primary file-input-bordered w-full max-w-xs" />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Book Author</span>
                    </div>
                    <input type="text" name="author_name" placeholder="Type here"
                        class="input input-bordered w-full max-w-xs" value="<?php echo $book['author_name']; ?>" />
                </label>

                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Product Details</span>
                    </div>
                    <input name="details" type="text" placeholder="Type here"
                        class="input input-bordered w-full max-w-xs" value="<?php echo $book['details']; ?>" />
                </label>

                <!-- Hidden field to store book ID -->
                <input type="hidden" name="id" value="<?php echo $book['id']; ?>" />

                <input name="update_product" type="submit" class="btn btn-primary btn-block mt-2" value="Update" />
            </form>
        </div>
    </div>
</body>