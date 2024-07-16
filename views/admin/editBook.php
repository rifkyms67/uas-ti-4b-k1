<?php
global $conn;

// Include database connection
require_once 'config/db.php';

// Ambil id buku yang akan di-edit dari parameter GET
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Query untuk mengambil data buku berdasarkan book_id
    $query = "SELECT * FROM books WHERE book_id = $book_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $author = $row['author'];
        $genre = $row['genre'];
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    // Query untuk update data buku
    $query = "UPDATE books SET title = '$title', author = '$author', genre = '$genre' WHERE book_id = $book_id";

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
    <h2>Edit Book</h2>
    <form method="POST" action="#">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $title; ?>" required>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" class="form-control" name="author" value="<?php echo $author; ?>" required>
        </div>
        <div class="form-group">
            <label>Genre</label>
            <input type="text" class="form-control" name="genre" value="<?php echo $genre; ?>">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>