<!-- edit_book.php -->

<?php
require_once 'utils/config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for updating book details
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Update book details in the database
    $query = "UPDATE books SET title = ?, author = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title, $author, $book_id]);

    // Redirect back to admin dashboard after updating book
    header('Location: admin_dashboard.php');
    exit;
} elseif (isset($_GET['id'])) {
    // Fetch book details based on ID from query parameter
    $book_id = $_GET['id'];
    $query = "SELECT * FROM books WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$book_id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        // Redirect if book with given ID does not exist
        header('Location: admin_dashboard.php');
        exit;
    }
} else {
    // Redirect if no book ID is provided
    header('Location: admin_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/style.css">
</head>
<body>
    <?php
      include 'layout/navbar.php'
    ?>
    <div class="container mt-5" style="margin-top: 100px !important;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Edit Book</h2>
                <form method="POST">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $book['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author" name="author" value="<?php echo $book['author']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
