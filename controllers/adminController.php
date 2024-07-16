<?php
function manageBooks() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/manageBooks.php';
    require_once 'views/shared/footer.php';
}

function returnBook() {
    global $conn;
    if (isset($_GET['borrow_id'])) {
      $borrow_id = $_GET['borrow_id'];
      // Query untuk mengupdate tanggal pengembalian buku
      $returnDate = date('Y-m-d'); // Tanggal hari ini sebagai tanggal pengembalian
      $query = "UPDATE borrows SET return_date = '$returnDate' WHERE borrow_id = $borrow_id";

      if (mysqli_query($conn, $query)) {
          // Redirect kembali ke halaman manageBooks atau halaman lain yang sesuai
          header('Location: index.php?action=manage_books');
          exit;
      } else {
          // Handle jika query gagal
          echo "Error updating record: " . mysqli_error($conn);
      }
    }else {
        echo "Invalid request.";
        exit();
    }
}

function addBook() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/addBook.php';
    require_once 'views/shared/footer.php';
}

function editBook() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/editBook.php';
    require_once 'views/shared/footer.php';
}

function deleteBook() {
    global $conn;
    require_once 'config/db.php';

    if (isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];

        // Query untuk menghapus buku dari database
        $query = "DELETE FROM books WHERE book_id = $book_id";

        if (mysqli_query($conn, $query)) {
            // Jika berhasil menghapus, redirect kembali ke halaman manage_books
            header("Location: index.php?action=manage_books");
            exit();
        } else {
            echo "Error deleting book: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
        exit();
    }
}

function manageMembers() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/manageMembers.php';
    require_once 'views/shared/footer.php';
}

function addMember() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/addMember.php';
    require_once 'views/shared/footer.php';
}

function editMember() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/editMember.php';
    require_once 'views/shared/footer.php';
}

function deleteMember() {
    global $conn;

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        // Query untuk menghapus profile dari database
        $query = "DELETE FROM profiles WHERE user_id = $user_id";
        if (mysqli_query($conn, $query)) {
            // Query untuk menghapus user dari database
            $query = "DELETE FROM users WHERE user_id = $user_id";
            if (mysqli_query($conn, $query)) {
                // Jika berhasil menghapus, redirect kembali ke halaman manage_members
                header("Location: index.php?action=manage_members");
                exit();
            } else {
                echo "Error deleting user: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting profile: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request.";
        exit();
    }
}

function generateReports() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/generateReports.php';
    require_once 'views/shared/footer.php';
}

function printReport() {
    require_once 'views/shared/header.php';
    require_once 'views/admin/report.php';
    require_once 'views/shared/footer.php';
}
?>
