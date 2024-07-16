<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Buku</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* Custom styles */
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
    <div class="container mt-5">
        <h2 class="mb-4">Form Peminjaman Buku</h2>

        <!-- Dropdown for selecting book -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" onclick="toggleDropdown('bukuDropdown')">Pilih Buku</button>
            <div id="bukuDropdown" class="dropdown-content">
                <input type="text" class="form-control mb-2" id="bukuSearch" placeholder="Cari buku.." onkeyup="searchDropdown('bukuDropdown', 'bukuSearch')">
                <?php
                // PHP code to fetch book data from database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "uasdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql_buku = "SELECT id_book, title FROM books";
                $result_buku = $conn->query($sql_buku);

                if ($result_buku->num_rows > 0) {
                    while($row_buku = $result_buku->fetch_assoc()) {
                        echo "<a href='#' class='dropdown-item' onclick='selectItem(\"" . $row_buku["title"] . "\", \"books\")'>" . $row_buku["title"] . "</a>";
                    }
                } else {
                    echo "Tidak ada data buku.";
                }

                $conn->close();
                ?>
            </div>
        </div>
        <div id="selectedBookText"></div> <!-- Container for selected book -->

        <br><br>

        <!-- Dropdown for selecting borrower -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" onclick="toggleDropdown('peminjamDropdown')">Pilih Peminjam</button>
            <div id="peminjamDropdown" class="dropdown-content">
                <input type="text" class="form-control mb-2" id="peminjamSearch" placeholder="Cari peminjam.." onkeyup="searchDropdown('peminjamDropdown', 'peminjamSearch')">
                <?php
                // PHP code to fetch borrower data from database
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql_peminjam = "SELECT id_user, nama FROM users";
                $result_peminjam = $conn->query($sql_peminjam);

                if ($result_peminjam->num_rows > 0) {
                    while($row_peminjam = $result_peminjam->fetch_assoc()) {
                        echo "<a href='#' class='dropdown-item' onclick='selectItem(\"" . $row_peminjam["nama"] . "\", \"users\")'>" . $row_peminjam["nama"] . "</a>";
                    }
                } else {
                    echo "Tidak ada data peminjam.";
                }

                $conn->close();
                ?>
            </div>
        </div>
        <div id="selectedPeminjamText"></div> <!-- Container for selected peminjam -->

        <br><br>

        <!-- Form for borrowing -->
        <form action="proses_peminjaman.php" method="POST">
            <input type="hidden" id="selectedBuku" name="selectedBuku">
            <input type="hidden" id="selectedPeminjam" name="selectedPeminjam">

            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
            </div>

            <button type="submit" class="btn btn-primary">Pinjam Buku</button>
        </form>
    </div>

    <!-- Bootstrap JS and custom script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        // JavaScript functions for dropdown functionality
        function toggleDropdown(id) {
            var dropdown = document.getElementById(id);
            dropdown.classList.toggle("show");
        }

        function searchDropdown(dropdownId, inputId) {
            var filter = document.getElementById(inputId).value.toUpperCase();
            var dropdown = document.getElementById(dropdownId);
            var items = dropdown.getElementsByTagName("a");

            for (var i = 0; i < items.length; i++) {
                var txtValue = items[i].textContent || items[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        function selectItem(value, type) {
            if (type === "books") {
                document.getElementById("selectedBuku").value = value;
                document.getElementById("selectedBookText").innerHTML = "<p>Buku dipilih: " + value + "</p>";
                toggleDropdown('bukuDropdown'); // Close the dropdown after selection
            } else if (type === "users") {
                document.getElementById("selectedPeminjam").value = value;
                document.getElementById("selectedPeminjamText").innerHTML = "<p>Peminjam dipilih: " + value + "</p>";
                toggleDropdown('peminjamDropdown'); // Close the dropdown after selection
            }
        }
    </script>
</body>
</html>
