<!-- Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Buku</title>
    <style>
        /* Style untuk tampilan dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            overflow-y: auto; /* Scroll jika dropdown terlalu panjang */
            border: 1px solid #ddd;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .show {display: block;}
    </style>
</head>
<body>
    <h2>Form Peminjaman Buku</h2>
    <div class="dropdown">
        <button onclick="toggleDropdown('bukuDropdown')">Pilih Buku</button>
        <div id="bukuDropdown" class="dropdown-content">
            <input type="text" placeholder="Cari buku.." onkeyup="searchDropdown('bukuDropdown', 'bukuSearch')">
            <?php
            // Kode PHP untuk mengambil data buku dari database
            $servername = "localhost"; // Ganti dengan nama server database Anda
            $username = "root"; // Ganti dengan username database Anda
            $password = ""; // Ganti dengan password database Anda
            $dbname = "uasdb"; // Ganti dengan nama database Anda

            // Membuat koneksi
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Query untuk mengambil data buku
            $sql_buku = "SELECT id, title FROM books";
            $result_buku = $conn->query($sql_buku);

            if ($result_buku->num_rows > 0) {
                while($row_buku = $result_buku->fetch_assoc()) {
                    echo "<a href='#' onclick='selectItem(\"" . $row_buku["title"] . "\", \"books\")'>" . $row_buku["title"] . "</a>";
                }
            } else {
                echo "Tidak ada data buku.";
            }

            // Menutup koneksi database
            $conn->close();
            ?>
        </div>
    </div>
    <br><br>

    <div class="dropdown">
        <button onclick="toggleDropdown('peminjamDropdown')">Pilih Peminjam</button>
        <div id="peminjamDropdown" class="dropdown-content">
            <input type="text" placeholder="Cari peminjam.." onkeyup="searchDropdown('peminjamDropdown', 'peminjamSearch')">
            <?php
            // Kode PHP untuk mengambil data peminjam dari database
            // Anda bisa mengganti koneksi dan query berdasarkan struktur database Anda
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Query untuk mengambil data peminjam
            $sql_peminjam = "SELECT id, nama FROM users";
            $result_peminjam = $conn->query($sql_peminjam);

            if ($result_peminjam->num_rows > 0) {
                while($row_peminjam = $result_peminjam->fetch_assoc()) {
                    echo "<a href='#' onclick='selectItem(\"" . $row_peminjam["nama"] . "\", \"users\")'>" . $row_peminjam["nama"] . "</a>";
                }
            } else {
                echo "Tidak ada data peminjam.";
            }

            // Menutup koneksi database
            $conn->close();
            ?>
        </div>
    </div>
    <br><br>

    <form action="proses_peminjaman.php" method="POST">
        <input type="hidden" id="selectedBuku" name="selectedBuku">
        <input type="hidden" id="selectedPeminjam" name="selectedPeminjam">

        <label for="tanggal_pinjam">Tanggal Pinjam:</label>
        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam"><br><br>

        <input type="submit" value="Pinjam Buku">
    </form>

    <script>
        // Fungsi untuk menampilkan atau menyembunyikan dropdown
        function toggleDropdown(id) {
            document.getElementById(id).classList.toggle("show");
        }

        // Fungsi untuk pencarian dalam dropdown
        function searchDropdown(dropdownId, inputId) {
            var filter, dropdown, items, a, i, txtValue;
            filter = document.getElementById(inputId).value.toUpperCase();
            dropdown = document.getElementById(dropdownId);
            items = dropdown.getElementsByTagName("a");
            for (i = 0; i < items.length; i++) {
                a = items[i];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        // Fungsi untuk memilih item dari dropdown
        function selectItem(value, type) {
            if (type === "books") {
                document.getElementById("selectedBuku").value = value;
                document.getElementById("bukuDropdown").classList.remove("show");
            } else if (type === "users") {
                document.getElementById("selectedPeminjam").value = value;
                document.getElementById("peminjamDropdown").classList.remove("show");
            }
        }
    </script>
</body>
</html>
