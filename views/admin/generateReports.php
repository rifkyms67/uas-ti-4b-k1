<?php
global $conn;

// Include database connection
require_once 'config/db.php';

// Query untuk mendapatkan data peminjaman buku
$query = "SELECT b.title, u.username, br.borrow_date, br.return_date, p.name
          FROM borrows br
          JOIN books b ON br.book_id = b.book_id
          JOIN users u ON br.user_id = u.user_id
          JOIN profiles p ON br.user_id = p.user_id";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-5">
    <h2>Laporan Peminjaman Buku</h2>
    <p>Periode : <span class="dateTime"></span></p>
    <button id="printPageButton" onclick="window.print()" class="btn btn-primary mb-3">Print Laporan</button>
    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr class="text-center">
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['borrow_date']; ?></td>
                    <td><?php echo $row['return_date'] ?? 'Not Returned'; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
  let time = document.getElementsByClassName('dateTime')
  time[0].innerText= new Date().toISOString().slice(0, 10);
</script>