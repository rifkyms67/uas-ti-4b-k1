<?php
global $conn;
// Handle submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $borrow_date = date('Y-m-d');

    // Query untuk meminjam buku
    $query = "INSERT INTO borrows (user_id, book_id, borrow_date) VALUES ('$user_id', '$book_id', '$borrow_date')";
    if (mysqli_query($conn, $query)) {
        // Update ketersediaan buku
        $update_query = "UPDATE books SET availability = 0 WHERE book_id = '$book_id'";
        mysqli_query($conn, $update_query);
        // Redirect ke halaman daftar buku yang dapat dipinjam
        header("Location: index.php?action=borrow_book");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Query untuk mendapatkan daftar buku yang tersedia
$query = "SELECT * FROM books WHERE availability = 1";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h2>Borrow Book</h2>
    <form method="POST" action="#">
        <div class="form-group">
            <label>Select Book</label>
            <select class="form-control" name="book_id" required>
                <?php while ($book = mysqli_fetch_assoc($result)): ?>
                    <option value="<?php echo $book['book_id']; ?>"><?php echo $book['title']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Pinjam</button>
    </form>
</div>