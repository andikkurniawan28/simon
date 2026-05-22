<?php 
// session_start(); // Tambahkan session_start() di awal
include 'db.php';

$stations = [];
$query = "SELECT id, name FROM stations WHERE id NOT IN (15) ORDER BY id ASC";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $stations[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMON</title>
    <link rel="icon" type="image/png" href="/Silab-v3/public/admin_template/img/QC.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700&display=swap">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Styling tambahan untuk mobile responsiveness */
        .card {
            margin-bottom: 20px;
        }

        /* Styling untuk tombol floating */
        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        /* CSS untuk konten */
        /* .content-container {
            overflow-y: auto;
            height: calc(100vh - 56px);
            padding-top: 20px;
        } */

        .content-container {
            width: calc(100% - 16px);
            /* Menggunakan calc() untuk menghitung lebar sesuai dengan lebar layar dikurangi margin */
            max-width: none;
            /* Menghilangkan batasan lebar maksimum */
            padding-right: 8px;
            /* Padding kanan untuk mempertahankan tata letak konten */
            padding-left: 8px;
            /* Padding kiri untuk mempertahankan tata letak konten */
            /* Gradient untuk latar belakang */
            /* background: linear-gradient(to right, #ffffff, skyblue); */
        }


        /* CSS untuk navigasi */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1001;
            /* Membuat navigasi di atas konten */
        }

        /* CSS untuk footer */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            /* Warna latar belakang footer */
            padding: 10px 0;
            /* Padding atas dan bawah footer */
            text-align: center;
            /* Teks tengah pada footer */
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0,0,0,.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        body {
            background: url('DJI_0443.jpg') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
        }
        
        /* Style untuk user info */
        .user-info {
            display: flex;
            align-items: center;
            color: black;
            margin-right: 15px;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 8px;
        }
        
        .user-details {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            line-height: 1.2;
        }
        
        .user-role {
            font-size: 11px;
            opacity: 0.9;
            line-height: 1.2;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase" href="index.php"
                style="font-family: 'Montserrat', sans-serif; font-weight: 500; letter-spacing: 1px; color: black; text-decoration: none;">
                SIMON</a>
            <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="dashboard.php">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            On Farm
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="ari.php">ARI</a></li>
                            <li><a class="dropdown-item" href="core.php">Core Sample</a></li>
                            <li><a class="dropdown-item" href="mbs.php">Penilaian MBS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hasil Analisa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <li>
                                <a class="dropdown-item" href="{{ route('monitoring_2024.rendemen_npp') }}">R NPP</a>
                            </li> -->
                            <li>
                                <?php foreach($stations as $s): ?>
                                <a class="dropdown-item" href="hasil_analisa.php?id=<?= $s['id'] ?>">
                                    <?= $s['name'] ?>
                                </a>
                                <?php endforeach ?>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Timbangan Proses
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="timbangan_rs_in.php">
                                    RS In
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="timbangan_reject.php">
                                    Reject
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="timbangan_tetes.php">
                                    Tetes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="timbangan_rs_out.php">
                                    RS Out
                                </a>
                            </li>
                            <!-- <li>
                                <a class="dropdown-item" href="timbangan_conveyor.php">
                                    Conveyor
                                </a>
                            </li> -->
                            <li>
                                <a class="dropdown-item" href="produksi_50.php">
                                    Produksi 50Kg
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="produksi_retail.php">
                                    Produksi Retail
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="keliling_proses.php">
                            Keliling
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="flow.php">
                            Flow
                        </a>
                    </li>               
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="penggunaan_bpp.php">
                            BPP
                        </a>
                    </li>
                </ul>
                
                <!-- Tampilkan informasi user di sebelah kanan navbar -->
                <div class="d-flex align-items-center">
                    <div class="user-info">
                        <div class="user-avatar">
                            <?= strtoupper(substr($_SESSION['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="user-details">
                            <span class="user-name"><?= $_SESSION['name'] ?? 'User' ?></span>
                            <span class="user-role"><?= $_SESSION['role_name'] ?? 'Role' ?></span>
                        </div>
                    </div>
                    <a class="nav-link text-dark" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Tambahkan padding-top untuk konten agar tidak tertutup navbar fixed -->
    <div style="padding-top: 30px;">
        <!-- Konten halaman Anda di sini -->
    </div>