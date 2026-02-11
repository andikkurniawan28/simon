<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

/**
 * =========================
 * AUTH & HEADER
 * =========================
 */
include('header.php');

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

$day_start = $_SESSION['date_start_retail']; // Y-m-d H:i:s
$day_end   = $_SESSION['date_end_retail'];   // Y-m-d H:i:s

/**
 * =========================
 * QUERY CEPAT (SINGLE SCAN)
 * =========================
 */
$sql = "
    SELECT
        HOUR(created_at) AS jam,
        SUM(value) AS total
    FROM retail
    WHERE created_at BETWEEN ? AND ?
    GROUP BY HOUR(created_at)
";

$stmt = $conn->prepare($sql);
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
 * TOTAL HARIAN (07:00 - 07:00)
 * =========================
 */
$daily_hours = [];
for ($i = 7; $i < 24; $i++) {
    $daily_hours[] = $i;
}
// Jam 0-6 dari hari berikutnya termasuk dalam harian
for ($i = 0; $i < 7; $i++) {
    $daily_hours[] = $i;
}

$daily_total = 0;
foreach ($daily_hours as $h) {
    $daily_total += $hours[$h];
}

/**
 * =========================
 * HITUNG SHIFT
 * =========================
 */

/**
 * PAGI: 07:00 - 15:00
 */
$pagi_hours = [7,8,9,10,11,12,13,14];
$pagi_total = 0;
foreach ($pagi_hours as $h) {
    $pagi_total += $hours[$h];
}

/**
 * SORE/SIANG: 15:00 - 23:00
 */
$sore_hours = [15,16,17,18,19,20,21,22];
$sore_total = 0;
foreach ($sore_hours as $h) {
    $sore_total += $hours[$h];
}

/**
 * MALAM: 23:00 - 07:00 (lintas hari)
 */
$malam_hours = [23];
for ($i = 0; $i < 7; $i++) {
    $malam_hours[] = $i;
}
$malam_total = 0;
foreach ($malam_hours as $h) {
    $malam_total += $hours[$h];
}

echo $day_start;
echo $day_end;

?>

<div class="container content-container">
    <br><br>

    <div class="card">
        <div class="card-header">
            <strong>PRODUKSI Retail</strong>
        </div>

        <div class="card-body table-responsive">
            <!-- <p>Catatan: 
                <ul>
                    <li>Harian: 07:00 - 07:00 (lusa)</li>
                    <li>Pagi: 07:00 - 15:00</li>
                    <li>Sore/Siang: 15:00 - 23:00</li>
                    <li>Malam: 23:00 - 07:00 (lusa)</li>
                </ul>
            </p> -->
            <table class="table table-bordered table-sm text-center">
                <thead>
                    <tr class="table-warning">
                        <th>HARIAN (07:00-07:00)</th>
                        <th><?= number_format($daily_total, 0) ?></th>
                    </tr>
                    <tr class="table-primary">
                        <th>PAGI (07:00-15:00)</th>
                        <th><?= number_format($pagi_total, 0) ?></th>
                    </tr>
                    <tr class="table-success">
                        <th>SORE (15:00-23:00)</th>
                        <th><?= number_format($sore_total, 0) ?></th>
                    </tr>
                    <tr class="table-dark text-light">
                        <th>MALAM (23:00-07:00)</th>
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
                     * OUTPUT DARI JAM 07 → 07
                     * =========================
                     */
                    for ($i = 0; $i < 24; $i++) {
                        $jam  = (7 + $i) % 24;
                        $next = ($jam + 1) % 24;
                        // Tentukan warna baris berdasarkan shift
                        $row_class = '';
                        if ($jam >= 7 && $jam < 15) {
                            $row_class = 'table-primary';
                        } elseif ($jam >= 15 && $jam < 23) {
                            $row_class = 'table-success';
                        } else {
                            $row_class = 'table-dark text-light';
                        }
                    ?>
                        <tr class="<?= $row_class ?>">
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