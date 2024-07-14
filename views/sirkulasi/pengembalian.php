<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Pengembalian Buku</h2>

        <div class="card">
            <div class="card-body">
                <?php
                // Koneksi ke database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "uasdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Ambil data peminjaman yang akan dikembalikan
                $idPeminjaman = $_POST['id_peminjaman']; // Anda perlu menentukan bagaimana Anda akan mengirimkan id peminjaman dari halaman sebelumnya

                // Ambil informasi peminjaman dari database
                $sql_peminjaman = "SELECT * FROM peminjaman_buku WHERE id_peminjaman = $idPeminjaman";
                $result_peminjaman = $conn->query($sql_peminjaman);

                if ($result_peminjaman->num_rows > 0) {
                    $row_peminjaman = $result_peminjaman->fetch_assoc();

                    $judulBuku = $row_peminjaman['judul_buku'];
                    $namaPeminjam = $row_peminjaman['nama_peminjam'];
                    $tanggalPinjam = $row_peminjaman['tanggal_pinjam'];

                    // Simpan informasi pengembalian ke dalam tabel pengembalian_buku
                    $tanggalKembali = date("Y-m-d"); // Menggunakan tanggal hari ini sebagai tanggal pengembalian

                    $sql_pengembalian = "INSERT INTO pengembalian_buku (judul_buku, nama_peminjam, tanggal_pinjam, tanggal_kembali) 
                                         VALUES ('$judulBuku', '$namaPeminjam', '$tanggalPinjam', '$tanggalKembali')";

                    if ($conn->query($sql_pengembalian) === TRUE) {
                        // Jika berhasil menyimpan pengembalian, hapus data peminjaman dari tabel peminjaman_buku
                        $sql_hapus_peminjaman = "DELETE FROM peminjaman_buku WHERE id_peminjaman = $idPeminjaman";

                        if ($conn->query($sql_hapus_peminjaman) === TRUE) {
                            echo "<div class='alert alert-success' role='alert'>";
                            echo "Pengembalian berhasil dicatat dan data peminjaman dihapus.";
                            echo "</div>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>";
                            echo "Error menghapus data peminjaman: " . $conn->error;
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>";
                        echo "Error saat menyimpan pengembalian: " . $conn->error;
                        echo "</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning' role='alert'>";
                    echo "Tidak ada data peminjaman dengan ID tersebut.";
                    echo "</div>";
                }

                // Tutup koneksi
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
