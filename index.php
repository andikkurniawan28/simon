<?php
include('session_manager.php');
checkRoleAccess([
    'Superadmin', 
    'Kabag', 
    'Kasie', 
    'Kasubsie', 
    'Admin QC', 
    'Koordinator QC', 
    'Mandor Off Farm', 
    'Analis Off Farm', 
    'Mandor On Farm', 
    'Analis On Farm', 
    'Operator Pabrikasi',
    'Staff Teknik',
    'Staff Tanaman',
    'Staff TUK',
    'Direksi',
    'Tamu',
    ]);
include('header.php');
?>

<div class="container content-container">
    <br><br>

    <div class="row g-4">

        <!-- Dashboard -->
        <div class="col-md-3">
            <a href="dashboard.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>📊</h1>
                        <h5 class="card-title">Dashboard</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- On Farm - ARI -->
        <div class="col-md-3">
            <a href="ari.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🌱</h1>
                        <h5 class="card-title">On Farm - ARI</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- On Farm - Core Sample -->
        <div class="col-md-3">
            <a href="core.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🌱</h1>
                        <h5 class="card-title">On Farm - Core Sample</h5>
                    </div>
                </div>
            </a>
        </div>

        <!-- On Farm - Penilaian MBS -->
        <div class="col-md-3">
            <a href="mbs.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🌱</h1>
                        <h5 class="card-title">On Farm - Penilaian MBS</h5>
                    </div>
                </div>
            </a>
        </div>

        <?php foreach($stations as $s): ?>
        <div class="col-md-3">
            <a href="hasil_analisa.php?id=<?= $s['id'] ?>" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🏭</h1>
                        <h5 class="card-title">Hasil Analisa - <?= $s['name'] ?></h5>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach ?>

        <?php 
            $timbangan = [
                'timbangan_rs_in',
                'timbangan_reject',
                'timbangan_tetes',
                'timbangan_rs_out',
                'timbangan_conveyor',
                'produksi_50',
                'produksi_retail',
            ];
        foreach($timbangan as $t): ?>
        <div class="col-md-3">
            <a href="<?= $t ?>.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>⚖️</h1>
                        <h5 class="card-title"><?= ucwords(str_replace('_', ' ', $t)) ?></h5>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach ?>

        <div class="col-md-3">
            <a href="keliling_proses.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🏭</h1>
                        <h5 class="card-title">Keliling Proses</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="flow.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🌊</h1>
                        <h5 class="card-title">Tebu Tergiling & Flow Dalam Proses</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="penggunaan_bpp.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🧪</h1>
                        <h5 class="card-title">Bahan Pembantu Proses</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="logout.php" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h1>🚪</h1>
                        <h5 class="card-title">Logout</h5>
                    </div>
                </div>
            </a>
        </div>

    </div>

</div>

<?php include('footer.php'); ?>
