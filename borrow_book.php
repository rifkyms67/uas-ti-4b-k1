<?php
require_once 'utils/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        header('Location: login.php');
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];

    // Check if the book is available
    $query = "SELECT * FROM books WHERE id = ? AND available = true";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$book_id]);
    $book = $stmt->fetch();

    if ($book) {
        // Update borrowings table
        $query = "INSERT INTO borrowings (user_id, book_id, borrow_date) VALUES (?, ?, NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $book_id]);

        // Update books table
        $query = "UPDATE books SET available = false WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$book_id]);

        echo "Book borrowed successfully.";
    } else {
        echo "Book not available for borrowing.";
    }
}
?>
