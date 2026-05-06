<?php
include('session_manager.php');
checkRoleAccess([
    'Superadmin','Kabag','Kasie','Kasubsie',
    'Admin QC','Koordinator QC','Mandor Off Farm',
    'Analis Off Farm','Direksi','Pemimpin',
]);

include('header.php');

/**
 * =========================
 * VALIDASI SESSION DATE
 * =========================
 */
if (empty($_SESSION['date_start_retail']) || empty($_SESSION['date_end_retail'])) {
    $_SESSION['flash'] = [
        'type'    => 'warning',
        'title'   => 'Session Berakhir',
        'message' => 'Silakan login ulang'
    ];
    header('Location: login.php');
    exit;
}

$day_start = $_SESSION['date_start_retail'];
$day_end   = $_SESSION['date_end_retail'];

/**
 * =========================
 * QUERY DATA
 * =========================
 */
$sql = "
    SELECT
        created_at,
        HOUR(created_at) AS jam,
        value,
        mesin_aktif,
        berat_a, berat_b, berat_c,
        berat_d, berat_e, berat_f, expired_checked
    FROM retail
    WHERE created_at BETWEEN ? AND ?
    ORDER BY created_at ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $day_start, $day_end);
$stmt->execute();
$result = $stmt->get_result();

/**
 * =========================
 * INIT DATA
 * =========================
 */
$hourly_data = array_fill(0, 24, []);

$summary = [
    'pagi'   => 0,
    'sore'   => 0,
    'malam'  => 0,
    'harian' => 0,
];

/**
 * =========================
 * OLAH DATA
 * =========================
 */
while ($row = $result->fetch_assoc()) {
    $jam = (int)$row['jam'];
    $hourly_data[$jam][] = $row;

    if ($jam >= 7 && $jam <= 14) {
        $summary['pagi'] += (int)$row['value'];
    } elseif ($jam >= 15 && $jam <= 22) {
        $summary['sore'] += (int)$row['value'];
    } else {
        $summary['malam'] += (int)$row['value'];
    }

    $summary['harian'] += (int)$row['value'];
}

/**
 * =========================
 * HELPER WARNA SHIFT
 * =========================
 */
function getShiftClass($jam) {
    if ($jam >= 7 && $jam <= 14) return 'table-primary';
    if ($jam >= 15 && $jam <= 22) return 'table-success';
    return 'table-dark text-light';
}
?>

<div class="container content-container">
<br><br>

<!-- ================= TABLE BERAT PER SHIFT ================= -->
<div class="card mb-4">
    <div class="card-header">
        <strong>REKAP PER SHIFT</strong>
    </div>
    <div class="card-body">
        <div class="row">
            
            <div class="col-md-3">
                <div class="card text-bg-primary text-center">
                    <div class="card-body">
                        <strong>PAGI</strong>
                        <h4><?= number_format($summary['pagi']) ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-success text-center">
                    <div class="card-body">
                        <strong>SORE</strong>
                        <h4><?= number_format($summary['sore']) ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-dark text-center">
                    <div class="card-body">
                        <strong>MALAM</strong>
                        <h4><?= number_format($summary['malam']) ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-warning text-center">
                    <div class="card-body">
                        <strong>HARIAN</strong>
                        <h4><?= number_format($summary['harian']) ?></h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================= TABLE DETAIL PER JAM ================= -->
<div class="card">
    <div class="card-header">
        <strong>PRODUKSI RETAIL (DETAIL PER JAM)</strong>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-sm text-center">
            <thead>
                <tr>
                    <th rowspan="2">Jam</th>
                    <th rowspan="2">Total</th>
                    <th rowspan="2">Mesin Aktif</th>
                    <th colspan="6">Berat</th>
                    <th rowspan="2">Expired</th>
                </tr>
                <tr>
                    <th>A</th><th>B</th><th>C</th>
                    <th>D</th><th>E</th><th>F</th>
                </tr>
            </thead>
            <tbody>
            <?php
            for ($i = 0; $i < 24; $i++) {
                $jam  = (7 + $i) % 24;
                $next = ($jam + 1) % 24;
                $row_class = getShiftClass($jam);

                if (empty($hourly_data[$jam])) {
                    echo "
                    <tr class='$row_class'>
                        <td>".str_pad($jam,2,'0',STR_PAD_LEFT)." - ".str_pad($next,2,'0',STR_PAD_LEFT)."</td>
                        <td colspan='8'>-</td>
                    </tr>";
                    continue;
                }

                foreach ($hourly_data[$jam] as $row) {
                    $mesin = json_decode($row['mesin_aktif'], true);
                    $mesin_text = is_array($mesin) && count($mesin) ? implode(', ', $mesin) : '-';
                    $expired = !empty($row['expired_checked']) ? '✔️' : '-';
                    echo "
                    <tr class='$row_class'>
                        <td>".str_pad($jam,2,'0',STR_PAD_LEFT)." - ".str_pad($next,2,'0',STR_PAD_LEFT)."</td>
                        <td>".number_format($row['value'])."</td>
                        <td>$mesin_text</td>
                        <td>{$row['berat_a']}</td>
                        <td>{$row['berat_b']}</td>
                        <td>{$row['berat_c']}</td>
                        <td>{$row['berat_d']}</td>
                        <td>{$row['berat_e']}</td>
                        <td>{$row['berat_f']}</td>
                        <td>$expired</td>
                    </tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<?php include('footer.php'); ?>