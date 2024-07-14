<?php
// Ambil data dari formulir
$selectedBuku = $_POST['selectedBuku'];
$selectedPeminjam = $_POST['selectedPeminjam'];
$tanggalPinjam = $_POST['tanggal_pinjam'];

// Simpan data ke dalam database atau lakukan proses lain sesuai kebutuhan
// Misalnya, Anda dapat menyimpan data ini ke dalam tabel peminjaman di database Anda

// Contoh koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uasdb";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Contoh query untuk menyimpan data ke dalam tabel peminjaman
$sql = "INSERT INTO peminjaman (title, nama, tgl_peminjam) 
        VALUES ('$selectedBuku', '$selectedPeminjam', '$tanggalPinjam')";

if ($conn->query($sql) === TRUE) {
    echo "Peminjaman berhasil dicatat.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
