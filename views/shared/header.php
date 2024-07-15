<!-- views/shared/header.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="styles/main.css">
</head>
<style>
    @media print {
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        #printPageButton {
          display: none;
        }
    }
</style>
<body style="height: 100vh;">
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <a class="navbar-brand" href="#">Si-Perpus K2</a>
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php?action=welcome">Beranda <span class="sr-only">(current)</span></a>
            </li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=borrow_book">Pinjam Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=update_profile">Perbarui Profile</a>
                </li>
            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=manage_books">Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=manage_members">Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=generate_reports">Laporan</a>
                </li>
            <?php endif; ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Logout</a>
        </form>
        </div>
      </nav>
    </header>
    <main style="height:80vh;">
