<?php
global $conn;
// Include database connection
require_once 'config/db.php';

// Handle submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $name = $_POST['name'];
  $address = $_POST['address'];
  $phone_number = $_POST['phone_number'];

  // Query untuk insert data user
  $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')";
  if (mysqli_query($conn, $query)) {
    $user_id = mysqli_insert_id($conn); // Mendapatkan user_id dari insert terakhir
    // Query untuk insert data profile
    $query = "INSERT INTO profiles (user_id, name, address, phone_number) VALUES ('$user_id', '$name', '$address', '$phone_number')";
    if (mysqli_query($conn, $query)) {
      // Redirect ke halaman manage_members setelah berhasil menambahkan
      header("Location: index.php?action=manage_members");
      exit();
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
  echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
?>

<div class="container mt-5">
    <h2>Add Member</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?action=add_member"; ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" required></textarea>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="phone_number" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>