<?php
include 'config/conn.php'; // Pastikan path file koneksi yang benar
session_start();

// Default query untuk menampilkan semua data
$query = "SELECT * FROM detail_pesanan";
$result = mysqli_query($conn, $query);

// Jika form telah disubmit, lakukan pencarian berdasarkan tanggal
if (isset($_POST['submit'])) {
    // Mengambil tanggal dari form input
    $tanggal = $_POST['tanggal'];

    // Melakukan query dengan filter berdasarkan tanggal
    $query = "SELECT * FROM detail_pesanan WHERE tanggal_pesanan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tanggal);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laporan Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">RestaurantKu</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="dashboard.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Pesanan</div>
                        <a class="nav-link collapsed" href="CreatePesanan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                            Buat Pesanan
                        </a>
                        <a class="nav-link" href="detailPesanan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div>
                            Detail Pesanan
                        </a>
                        <a class="nav-link" href="menuMakanan.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-plate-wheat"></i></div>
                            Menu Makanan
                        </a>
                        <a class="nav-link" href="laporan.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-clipboard"></i></div>
                            Laporan Pemesanan
                        </a>
                        <a class="nav-link collapsed" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                            Login
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    RestaurantKu
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <div class="container mt-5">
                <h2>Detail Pesanan</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label>Pilih Tanggal:</label>
                        <input type="date" name="tanggal" class="p-1 gap-1">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-2">Filter</button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status_pesanan</th>
                            <th>Catatan_pesanan</th>
                            <th>Menu_id_menu</th>
                            <th>Nama_Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $row['tanggal_pesanan'] . "</td>";
                                echo "<td>" . $row['status_pesanan'] . "</td>";
                                echo "<td>" . $row['catatan_pesanan'] . "</td>";
                                echo "<td>" . $row['menu_id_menu'] . "</td>";
                                echo "<td>" . $row['nama_pesanan'] . "</td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data ditemukan</td></tr>";
                        }

                        mysqli_close($koneksi);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>