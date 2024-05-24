<?php

include 'pdo-connect.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $author_name = $_POST['author_name'];
    $author_name = filter_var($author_name, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = 'uploaded_img/' . $image_01;

    $select_books = $conn->prepare("SELECT * FROM `books` WHERE name = ?");
    
    $select_books->execute([$name]);

    if ($select_books->rowCount() > 0) {
        $message[] = 'Product name already exists!';
    } else {
        $insert_book = $conn->prepare("INSERT INTO `books` (name, price, details, author_name, image_01) VALUES (?, ?, ?, ?, ?)");
        $insert_book->execute([$name, $price, $details, $author_name, $image_01]);

        if ($insert_book) {
            if ($image_size_01 > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
                $message[] = 'New product added!';
            }
        }
    }
}




?>


<div class="flex justify-center my-10">
    <div class=" p-5 rounded bg-base-100 shadow-xl">
        <form class="max-w-lg  " action="" method="post" enctype="multipart/form-data">
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Book Name</span>

                </div>
                <input type="text" name="name" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            </label>

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Book Price</span>

                </div>
                <input type="number" name="price" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            </label>

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Pick a book photo</span>
                </div>
                <input type="file" name="image_01" class="file-input file-input-primary file-input-bordered w-full max-w-xs" />
            </label>
            </label>

            <!-- <input type="file" class="my-4 file-input file-input-bordered file-input-primary w-full max-w-xs" /> -->
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Book Author</span>
                </div>
                <input type="text" name="author_name" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            </label>

            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Product Details</span>
                </div>
                <input name="details" type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            </label>



            <input name="add_product" type="submit" class="btn btn-primary btn-block mt-2" value="Add"/>


        </form>
    </div>
</div>