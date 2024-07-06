<!-- add_book.php -->
<?php
require_once '../../utils/config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// include './layout/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for adding a new book
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Insert new book into database
    $query = "INSERT INTO books (title, author, available) VALUES (?, ?, true)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title, $author]);

    // Redirect back to admin dashboard after adding book
    header('Location: admin_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container mt-5" style="margin-top: 100px !important;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Tambah Buku</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Pengarang</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Ca</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
