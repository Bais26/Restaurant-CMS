<?php

include 'config/conn.php';

// READ
function query()
{
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM menu");
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
$menus = query();


// CREATE

function addMenu($data)
{
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_menu = $_POST["id_menu"];
        $nama_menu = $_POST["nama_menu"];
        $harga_menu = $_POST["harga_menu"];
        $jenis_pesanan = $_POST["jenis_pesanan"];

        // Inisialisasi koneksi ke database (sesuaikan dengan konfigurasi Anda)
        $conn = new mysqli("localhost", "root", "", "RestaurantKu");

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Persiapkan query
        $tambah = $conn->prepare("INSERT INTO menu (id_menu, nama_menu, harga_menu, jenis_pesanan) VALUES (?, ?, ?, ?)");
        $tambah->bind_param("ssss", $id_menu, $nama_menu, $harga_menu, $jenis_pesanan);

        // Eksekusi query
        if ($tambah->execute()) {
            header("Location: menuMakanan.php"); // Ganti dengan halaman destinasi setelah menambahkan menu
            exit();
        } else {
            // Tampilkan pesan kesalahan
            echo "<script>alert('Woops! Terjadi kesalahan: " . $conn->error . "')</script>";
        }

        // Tutup koneksi
        $conn->close();
    }
}

// Panggil fungsi untuk menambahkan menu
addMenu($_POST);

// UPDATE
function editMenu($data)
{
    global $conn;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {

        $id_menu = $_POST["id_menu"];
        $nama_menu = $_POST["nama_menu"];
        $harga_menu = $_POST["harga_menu"];
        $jenis_pesanan = $_POST["jenis_pesanan"];

        // Persiapkan query untuk mengupdate data menu
        $update = $conn->prepare("UPDATE menu SET nama_menu=?, harga_menu=?, jenis_pesanan=? WHERE id_menu=?");
        $update->bind_param("ssss", $nama_menu, $harga_menu, $jenis_pesanan, $id_menu);

        // Eksekusi query update
        if ($update->execute()) {
            // Redirect kembali ke halaman menuMakanan.php setelah edit
            header("Location: menuMakanan.php");
            exit();
        } else {
            // Tampilkan pesan kesalahan
            echo "<script>alert('Woops! Terjadi kesalahan: " . $conn->error . "')</script>";
        }
    }
}

// Panggil fungsi untuk melakukan edit menu
editMenu($_POST);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard.html">RestaurantKu</a>
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
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
                        <a class="nav-link collapsed" href="CreatePesanan.html">
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
            <button type="button" class="btn btn-primary m-3" style="width: max-content;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Menu
            </button>
            <div style="display: flex; gap:4px; flex-wrap: wrap; justify-content: slengkapace-between;">
                <?php foreach ($menus as $menu) : ?>
                    <div class="card" style="width: 14rem; height: 16rem; margin: 16px;">
                        <img src="https://placehold.jp/150x100.png" class="card-img-top" X>
                        <div class="card-body">
                            <h5 class="card-title"><?= $menu["nama_menu"] ?></h5>
                            <p class="card-text">Rp.<?= $menu["harga_menu"] ?>.00</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!-- add modal : -->
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="makanan">
                            ID :
                            <input type="text" name="id_menu" id="makanan" class="p-2 rounded-5" required>
                        </label>
                        <label for="makanan">
                            Nama Makanan :
                            <input type="text" name="nama_menu" id="makanan" class="p-2 rounded-5" required>
                        </label>
                        <label for="harga">
                            harga :
                            <input type="text" name="harga_menu" id="makanan" class="p-2 rounded-5" required>
                        </label>
                        <label for="jenis_pesanan">
                            jenis_pesanan :
                            <input type="text" name="jenis_pesanan" id="makanan" class="p-2 rounded-5" required>
                        </label>
                        <button type="submit" name="submit" class="btn btn-outline-primary">Add menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- add modal; -->




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>