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
    // 'Mandor On Farm', 
    // 'Analis On Farm', 
    'Operator Pabrikasi',
    // 'Staff Teknik',
    // 'Staff Tanaman',
    // 'Staff TUK',
    'Direksi',
    // 'Tamu',
    ]);
include('header.php');

/**
 * =========================
 * VALIDASI SESSION DATE
 * =========================
 */
if (empty($_SESSION['date_start']) || empty($_SESSION['date_end'])) {
    header('Location: login.php');
    exit;
}

$date_start = $_SESSION['date_start'] . ' 00:00:00';
$date_end   = $_SESSION['date_end']   . ' 23:59:59';

/**
 * =========================
 * AMBIL chemicalS
 * =========================
 */
$chemicalsQ = $conn->query("
    SELECT id, name
    FROM chemicals
    ORDER BY id ASC
");
$chemicals = $chemicalsQ->fetch_all(MYSQLI_ASSOC);

/**
 * =========================
 * AMBIL DATA KELILING PROSES
 * =========================
 */
$dataQ = $conn->prepare("
    SELECT *
    FROM penggunaan_bpp
    WHERE created_at BETWEEN ? AND ?
    ORDER BY created_at ASC
");
$dataQ->bind_param("ss", $date_start, $date_end);
$dataQ->execute();
$dataR = $dataQ->get_result();

/**
 * =========================
 * SIMPAN DATA KE ARRAY (BIAR BISA DIPAKAI ULANG)
 * =========================
 */
$rows = [];
while ($r = $dataR->fetch_assoc()) {
    $r['p'] = json_decode($r['p'], true) ?: [];
    $rows[] = $r;
}
?>

<div class="container content-container">
    <br><br>

    <div class="row">

        <?php foreach ($chemicals as $chemical): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card mb-4">

                    <div class="card-header text-center">
                        <strong><?= htmlspecialchars($chemical['name']) ?></strong>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-sm text-center">
                            <thead>
                                <tr>
                                    <th>Jam</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $hasData = false;
                                foreach ($rows as $row):
                                    if (!isset($row['p'][$chemical['id']])) {
                                        continue;
                                    }
                                    $hasData = true;
                                ?>
                                    <tr>
                                        <td><?= date('H:i', strtotime($row['created_at'])) ?></td>
                                        <td><?= number_format($row['p'][$chemical['id']], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                <?php if (!$hasData): ?>
                                    <tr>
                                        <td colspan="2" class="text-muted">
                                            Tidak ada data
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php include('footer.php'); ?>
