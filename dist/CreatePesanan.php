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
                <h2>Form Pemesanan Menu</h2>
                <form method="post" action="process_order.php"> <!-- Form untuk membuat pesanan -->
                    <div class="mb-3">
                        <label for="namaCustomer" class="form-label">Nama Customer:</label>
                        <input type="text" class="form-control" id="namaCustomer" name="namaCustomer" placeholder="Masukkan Nama Customer" required>
                    </div>
                    <div class="mb-3">
                        <label for="menuId" class="form-label">Pilih Menu:</label>
                        <select class="form-select" id="menuId" name="menuId" required>
                            <option value="">Pilih Menu</option>
                            <?php
                            // Lakukan koneksi ke database
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "RestaurantKu";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Koneksi gagal: " . $conn->connect_error);
                            }

                            // Query untuk mengambil data menu
                            $sql = "SELECT * FROM menu";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nama_menu'] . " - Rp. " . $row['harga_menu'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Pesanan:</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Pesanan" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Buat Pesanan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>