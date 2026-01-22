<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/**
 * =========================
 * AUTH & HEADER
 * =========================
 */
include('header.php');
include('db_packer.php');

/**
 * =========================
 * VALIDASI SESSION DATE
 * =========================
 */
if (empty($_SESSION['date_start']) || empty($_SESSION['date_end'])) {
    $_SESSION['flash'] = [
        'type'    => 'warning',
        'title'   => 'Session Berakhir',
        'message' => 'Silakan login ulang'
    ];
    header('Location: login.php');
    exit;
}

$day_start = $_SESSION['date_start']; // Y-m-d H:i:s
$day_end   = $_SESSION['date_end'];   // Y-m-d H:i:s

/**
 * =========================
 * QUERY CEPAT (SINGLE SCAN)
 * =========================
 */
$sql = "
    SELECT
        HOUR(created_at) AS jam,
        SUM(netto) AS total
    FROM in_process_weighings
    WHERE created_at BETWEEN ? AND ?
    AND line = 'pringkilan' 
    GROUP BY HOUR(created_at)
";

$stmt = $conn2->prepare($sql);
$stmt->bind_param('ss', $day_start, $day_end);
$stmt->execute();
$result = $stmt->get_result();

/**
 * =========================
 * INIT JAM 0–23 (DEFAULT 0)
 * =========================
 */
$hours = array_fill(0, 24, 0);

/**
 * =========================
 * ISI JAM YANG ADA DATA
 * =========================
 */
while ($row = $result->fetch_assoc()) {
    $jam = (int)$row['jam'];
    $hours[$jam] = (float)$row['total'];
}

/**
 * =========================
 * TOTAL HARIAN
 * =========================
 */
$daily_total = array_sum($hours);

/**
 * =========================
 * HITUNG SHIFT
 * =========================
 */

/**
 * PAGI: 05 - 13
 */
$sql_0506 = "
    SELECT COALESCE(SUM(netto),0) AS total_0506
    FROM in_process_weighings
    WHERE created_at >= DATE_SUB(?, INTERVAL 1 HOUR)
      AND created_at < ?
      AND line = 'pringkilan' 
";

$stmt_0506 = $conn2->prepare($sql_0506);
$stmt_0506->bind_param('ss', $day_start, $day_start);
$stmt_0506->execute();
$jam_0506 = (float) $stmt_0506->get_result()->fetch_assoc()['total_0506'];
$pagi_hours = [6,7,8,9,10,11,12];
$pagi_total = $jam_0506;
foreach ($pagi_hours as $h) {
    $pagi_total += $hours[$h];
}

/**
 * SORE: 13 - 21
 */
$sore_hours = [13,14,15,16,17,18,19,20];
$sore_total = 0;
foreach ($sore_hours as $h) {
    $sore_total += $hours[$h];
}

/**
 * MALAM: 21 - 05 (lintas hari)
 */
$malam_hours = [21,22,23,0,1,2,3,4];
$malam_total = 0;
foreach ($malam_hours as $h) {
    $malam_total += $hours[$h];
}


?>

<div class="container content-container">
    <br><br>

    <div class="card">
        <div class="card-header">
            <strong>TIMBANGAN RS OUT</strong>
        </div>

        <div class="card-body table-responsive">
            <p>Catatan: Total harian dihitung dari 06.00–06.00, sedangkan shift pagi dimulai 05.00. Produksi 05.00–06.00 masuk ke shift pagi tetapi tidak ke total harian, sehingga total harian ≠ total shift.</p>
            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr class="table-warning">
                        <th>HARIAN</th>
                        <th><?= number_format($daily_total, 0) ?></th>
                    </tr>
                    <tr class="table-warning">
                        <th>PAGI</th>
                        <th><?= number_format($pagi_total, 0) ?></th>
                    </tr>
                    <tr class="table-warning">
                        <th>SORE</th>
                        <th><?= number_format($sore_total, 0) ?></th>
                    </tr>
                    <tr class="table-warning">
                        <th>MALAM</th>
                        <th><?= number_format($malam_total, 0) ?></th>
                    </tr>
                    <tr>
                        <th>Jam</th>
                        <th>Total (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    /**
                     * =========================
                     * OUTPUT DARI JAM 06 → 06
                     * =========================
                     */
                    for ($i = 0; $i < 24; $i++) {
                        $jam  = (6 + $i) % 24;
                        $next = ($jam + 1) % 24;
                    ?>
                        <tr>
                            <td>
                                <?= str_pad($jam, 2, '0', STR_PAD_LEFT) ?>
                                -
                                <?= str_pad($next, 2, '0', STR_PAD_LEFT) ?>
                            </td>
                            <td><?= number_format($hours[$jam], 0) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
