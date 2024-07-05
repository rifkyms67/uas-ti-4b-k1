<!-- admin_dashboard.php -->

<?php
require_once 'utils/config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle CRUD operations for books
// Below is a basic example for listing books, adding new book, editing and deleting books

$query = "SELECT * FROM books";
$stmt = $pdo->query($query);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_book_id'])) {
    // Handle delete book operation
    $book_id = $_POST['delete_book_id'];

    // Check if the book is currently borrowed
    $query = "SELECT * FROM borrowings WHERE book_id = ? AND return_date IS NULL";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$book_id]);
    $borrowed_book = $stmt->fetch();

    if ($borrowed_book) {
        echo '<div class="alert alert-danger">Cannot delete the book. It is currently borrowed.</div>';
    } else {
        // Proceed with deletion if the book is not borrowed
        $query = "DELETE FROM books WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$book_id]);

        echo '<div class="alert alert-success">Book deleted successfully.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/style.css">
</head>
<body>
    <?php
      include 'layout/navbar.php'
    ?>
    <div class="container mt-5" style="margin-top: 100px !important;">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2>Admin Dashboard</h2>
                <a href="add_book.php" class="btn btn-primary mb-3">Add New Book</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo $book['id']; ?></td>
                                <td><?php echo $book['title']; ?></td>
                                <td><?php echo $book['author']; ?></td>
                                <td>
                                    <a href="edit_book.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <form method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                        <input type="hidden" name="delete_book_id" value="<?php echo $book['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" <?php if ($book['available'] == false) echo 'disabled'; ?>>Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
