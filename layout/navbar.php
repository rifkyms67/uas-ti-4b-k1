<?php $base_url = "http://localhost/uas-ti-4b-k1/"; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Perpustakaan Sederhana</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/uas-ti-4b-k1/.">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/book/list.php">Buku</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        aria-expanded="false">
                        Sirkulasi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Peminjaman</a></li>
                        <li><a class="dropdown-item" href="#">Pengembalian</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Laporan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-light" type="submit">logout</button>
            </form>
        </div>
    </div>
</nav>
<div class="button">
  <a href="#beranda"><i class="fas fa-arrow-up"></i></a>
</div>