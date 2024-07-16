<?php

function welcome(){
  require_once 'views/shared/header.php';
  require_once 'welcome.php';
  require_once 'views/shared/footer.php';
}

function login() {
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Cari pengguna berdasarkan username
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $hashed_password = $user['password'];

            // Verifikasi password
            if (password_verify($password, $hashed_password)) {
                // Password cocok, set session untuk login
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect ke halaman sesuai role
                if ($_SESSION['role'] == 'user') {
                    header('Location: index.php?action=welcome');
                } elseif ($_SESSION['role'] == 'admin') {
                    header('Location: index.php?action=welcome');
                } else {
                    // Handle role lain jika ada
                    echo "Role tidak valid.";
                }
            } else {
                echo "Login gagal. Password salah.";
            }
        } else {
            echo "Login gagal. Username tidak ditemukan.";
        }
    }
}

function updatePassword() {
    global $conn;

    // Jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Periksa apakah password baru dan konfirmasi password sama
        if ($new_password === $confirm_password) {
            // Hash password baru
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Query untuk memperbarui password
            $query = "UPDATE users SET password = '$hashed_password' WHERE user_id = '$user_id'";
            if (mysqli_query($conn, $query)) {
                // Redirect ke halaman profil setelah berhasil diperbarui
                header("Location: index.php?action=update_profile");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Passwords do not match.";
        }
    }
}
?>
