<?php
  global $conn;

  // Include database connection
  require_once 'config/db.php';

  // Ambil user_id dari parameter GET
  if (isset($_GET['user_id'])) {
      $user_id = $_GET['user_id'];

      // Query untuk mengambil data user dan profile berdasarkan user_id
      $query = "SELECT users.user_id, users.username, profiles.name, profiles.address, profiles.phone_number 
                FROM users 
                JOIN profiles ON users.user_id = profiles.user_id
                WHERE users.user_id = $user_id";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
          $member = mysqli_fetch_assoc($result);
      } else {
          echo "Member not found.";
          exit();
      }
  } else {
      echo "Invalid request.";
      exit();
  }

  // Handle submit form
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form edit anggota
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    // Query untuk update data user
    $query = "UPDATE users SET username = '$username' WHERE user_id = $user_id";
    if (mysqli_query($conn, $query)) {
        // Query untuk update data profile
        $query = "UPDATE profiles SET name = '$name', address = '$address', phone_number = '$phone_number' WHERE user_id = $user_id";
        if (mysqli_query($conn, $query)) {
            // Redirect ke halaman manage_members setelah berhasil update
            header("Location: index.php?action=manage_members");
            exit();
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
  }
?>

<div class="container mt-5">
    <h2>Edit Member</h2>
    <form method="POST" action="#">
        <input type="hidden" name="user_id" value="<?php echo $member['user_id']; ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $member['username']; ?>" required>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $member['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" required><?php echo $member['address']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="phone_number" value="<?php echo $member['phone_number']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
