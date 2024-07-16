<?php
global $conn;

require_once 'config/db.php'; 

// Query untuk mengambil semua anggota
$query = "SELECT users.user_id, users.username, profiles.name, profiles.address, profiles.phone_number 
          FROM users 
          JOIN profiles ON users.user_id = profiles.user_id
          WHERE users.role = 'user'";
$result = mysqli_query($conn, $query);
// Include header
require_once 'views/shared/header.php';
?>

<div class="container mt-5">
    <h2>Manage Members</h2>
    <a href="index.php?action=add_member" class="btn btn-primary mb-3">Tambah Anggota</a>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Hp</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td class="text-center">
                        <a href="index.php?action=edit_member&user_id=<?php echo $row['user_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?action=delete_member&user_id=<?php echo $row['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>