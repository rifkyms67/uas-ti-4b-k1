<?php
global $conn;

// Include database connection
require_once 'config/db.php';

// Query untuk mendapatkan data peminjaman buku
$query = "SELECT b.title, u.username, br.borrow_date, br.return_date
          FROM borrows br
          JOIN books b ON br.book_id = b.book_id
          JOIN users u ON br.user_id = u.user_id";
$result = mysqli_query($conn, $query);

// Query untuk mendapatkan jumlah total buku
$totalBooksQuery = "SELECT COUNT(*) AS total_books FROM books";
$totalBooksResult = mysqli_query($conn, $totalBooksQuery);
$totalBooks = mysqli_fetch_assoc($totalBooksResult)['total_books'];

// Query untuk mendapatkan jumlah buku yang saat ini dipinjam
$borrowedBooksQuery = "SELECT COUNT(*) AS borrowed_books FROM borrows WHERE return_date IS NULL";
$borrowedBooksResult = mysqli_query($conn, $borrowedBooksQuery);
$borrowedBooks = mysqli_fetch_assoc($borrowedBooksResult)['borrowed_books'];

// Query untuk mendapatkan jumlah buku yang sudah dikembalikan
$returnedBooksQuery = "SELECT COUNT(*) AS returned_books FROM borrows WHERE return_date IS NOT NULL";
$returnedBooksResult = mysqli_query($conn, $returnedBooksQuery);
$returnedBooks = mysqli_fetch_assoc($returnedBooksResult)['returned_books'];
?>

<div class="container mt-5">
  <div class="row mb-3">
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Total Buku</h5>
                  <p class="card-text"><?php echo $totalBooks; ?></p>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Buku Dipinjam</h5>
                  <p class="card-text"><?php echo $borrowedBooks; ?></p>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Buku Dikembalikan</h5>
                  <p class="card-text"><?php echo $returnedBooks; ?></p>
              </div>
          </div>
      </div>
  </div>
</div>

