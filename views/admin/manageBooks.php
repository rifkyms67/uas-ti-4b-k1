<?php
global $conn;

require_once 'config/db.php';

$queryBook = "SELECT * FROM books";
$books = mysqli_query($conn, $queryBook);
if (!$books) {
    die('Error querying database.');
}

$queryBorrows = "SELECT br.borrow_id, b.title, u.username, br.borrow_date, br.return_date, p.name
          FROM borrows br
          JOIN books b ON br.book_id = b.book_id
          JOIN users u ON br.user_id = u.user_id
          JOIN profiles p ON br.user_id = p.user_id where br.return_date = null";
$borrows = mysqli_query($conn, $queryBorrows);
if (!$borrows) {
    die('Error querying database.');
}
?>

<div class="container mt-5">
  <div class="accordion" id="accordionExample">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Buku
          </button>
        </h2>
      </div>

      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <a href="index.php?action=add_book" class="btn btn-primary mb-3">Tambah Buku</a>
          <table class="table">
              <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Genre</th>
                    <th>Ketersediaan</th>
                    <th class="text-center">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php while ($row = mysqli_fetch_assoc($books)) : ?>
                      <?php
                        $isAvailable = $row['availability'];
                      ?>
                      <tr>
                          <td><?php echo $row['title']; ?></td>
                          <td><?php echo $row['author']; ?></td>
                          <td><?php echo $row['genre']; ?></td>
                          <td>
                            <?php 
                              if($isAvailable){
                                echo '<h5><span class="badge badge-info">TERSEDIA</span></h5>';
                              }else{
                                echo '<h5><span class="badge badge-danger">DIPINJAM</span></h5>';
                              }
                            ?>
                          </td>
                          <td  class="text-center">
                              <a href="index.php?action=edit_book&book_id=<?php echo $row['book_id']; ?>" class="btn btn-sm btn-warning <?php if(!$isAvailable){echo "disabled";} ?>">Edit</a>
                              <a href="index.php?action=delete_book&book_id=<?php echo $row['book_id']; ?>" class="btn btn-sm btn-danger <?php if(!$isAvailable){echo "disabled";} ?>">Delete</a>
                          </td>
                      </tr>
                  <?php endwhile; ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Pengembalian
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
          <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($borrows)): ?>
                    <tr class="text-center">
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['borrow_date']; ?></td>
                        <td>
                          <a href="index.php?action=return_book&borrow_id=<?php echo $row['borrow_id']; ?>" class="btn btn-sm btn-success">Dikembalikan</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
