<?php
global $conn;
// Include database connection
require_once 'config/db.php';

// Handle submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    // Query untuk menyimpan data buku baru
    $query = "INSERT INTO books (title, author, genre) VALUES ('$title', '$author', '$genre')";

    if (mysqli_query($conn, $query)) {
        // Jika query berhasil, redirect ke halaman manage_books.php
        header("Location: index.php?action=manage_books");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <h2>Add New Book</h2>
    <form method="POST" action="#">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" class="form-control" name="author" required>
        </div>
        <div class="form-group">
            <label>Genre</label>
            <input type="text" class="form-control" name="genre">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>