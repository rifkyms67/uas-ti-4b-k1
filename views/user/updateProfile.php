<?php
global $conn;

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    // Query untuk memperbarui profil
    $query = "UPDATE profiles SET name = '$name', address = '$address', phone_number = '$phone_number' WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman profil setelah berhasil diperbarui
        header("Location: index.php?action=update_profile");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Query untuk mendapatkan data profil
$query = "SELECT * FROM profiles WHERE user_id = '" . $_SESSION['user_id'] . "'";
$result = mysqli_query($conn, $query);
$profile = mysqli_fetch_assoc($result);
?>

<div class="container mt-5">
    <h2>Update Profile</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?action=update_profile"; ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $profile['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" required><?php echo $profile['address']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="phone_number" value="<?php echo $profile['phone_number']; ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
    <button type="button" class="btn btn-warning mt-3" data-toggle="modal" data-target="#updatePasswordModal">Update Password</button>
</div>

<!-- Modal untuk update password -->
<div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?action=update_password"; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>