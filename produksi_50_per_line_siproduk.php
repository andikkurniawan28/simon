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
    'Operator Pabrikasi',
    'Staff Teknik',
    'Pemimpin',
]);

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

$day_start = $_SESSION['date_start'];
$day_end   = $_SESSION['date_end'];

/**
 * =========================
 * INISIALISASI JAM
 * =========================
 */
$hours = [];

for ($i = 0; $i < 24; $i++) {
    $hours[$i] = [
        'A1' => 0,
        'A2' => 0,
        'B1' => 0,
        'B2' => 0,
        'C1' => 0,
        'C2' => 0,
    ];
}

/**
 * =========================
 * AMBIL DATA
 * =========================
 */
$sql = "
    SELECT
        HOUR(created_at) AS jam,
        line,
        SUM(result) AS total
    FROM weighings
    WHERE created_at BETWEEN ? AND ?
      AND line IN ('A1','A2','B1','B2','C1','C2')
    GROUP BY HOUR(created_at), line
    ORDER BY jam, line
";

$stmt = $conn2->prepare($sql);
$stmt->bind_param('ss', $day_start, $day_end);
$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {

    $jam = (int)$row['jam'];
    $line = $row['line'];

    $hours[$jam][$line] = (float)$row['total'];
}

/**
 * =========================
 * TOTAL HARIAN
 * =========================
 */
$grandA1 = 0;
$grandA2 = 0;
$grandB1 = 0;
$grandB2 = 0;
$grandC1 = 0;
$grandC2 = 0;

for ($i = 0; $i < 24; $i++) {

    $grandA1 += $hours[$i]['A1'];
    $grandA2 += $hours[$i]['A2'];
    $grandB1 += $hours[$i]['B1'];
    $grandB2 += $hours[$i]['B2'];
    $grandC1 += $hours[$i]['C1'];
    $grandC2 += $hours[$i]['C2'];
}

$daily_total =
    $grandA1 +
    $grandA2 +
    $grandB1 +
    $grandB2 +
    $grandC1 +
    $grandC2;

?>

<div class="container content-container">
    <br><br>

    <div class="card">

        <div class="card-header">
            <strong>PRODUKSI 50Kg SiPRODUK</strong>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-sm text-center">

                <thead>

                    <tr class="table-warning">
                        <th colspan="7">TOTAL HARIAN</th>
                        <th><?= number_format($daily_total, 2) ?></th>
                    </tr>

                    <tr>
                        <th>Jam</th>
                        <th>A1</th>
                        <th>A2</th>
                        <th>B1</th>
                        <th>B2</th>
                        <th>C1</th>
                        <th>C2</th>
                        <th>Total<sub>(Kg)</sub></th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    $sumA1 = 0;
                    $sumA2 = 0;
                    $sumB1 = 0;
                    $sumB2 = 0;
                    $sumC1 = 0;
                    $sumC2 = 0;
                    $sumTotal = 0;

                    /**
                     * OUTPUT 06:00 → 06:00
                     */
                    for ($i = 0; $i < 24; $i++) :

                        $jam  = (6 + $i) % 24;
                        $next = ($jam + 1) % 24;

                        $A1 = $hours[$jam]['A1'];
                        $A2 = $hours[$jam]['A2'];
                        $B1 = $hours[$jam]['B1'];
                        $B2 = $hours[$jam]['B2'];
                        $C1 = $hours[$jam]['C1'];
                        $C2 = $hours[$jam]['C2'];

                        $total =
                            $A1 +
                            $A2 +
                            $B1 +
                            $B2 +
                            $C1 +
                            $C2;

                        $sumA1 += $A1;
                        $sumA2 += $A2;
                        $sumB1 += $B1;
                        $sumB2 += $B2;
                        $sumC1 += $C1;
                        $sumC2 += $C2;
                        $sumTotal += $total;

                    ?>

                        <tr>

                            <td>
                                <?= sprintf('%02d', $jam) ?>
                                -
                                <?= sprintf('%02d', $next) ?>
                            </td>

                            <td><?= empty($A1) ? '' : number_format($A1, 2) ?></td>
                            <td><?= empty($A2) ? '' : number_format($A2, 2) ?></td>
                            <td><?= empty($B1) ? '' : number_format($B1, 2) ?></td>
                            <td><?= empty($B2) ? '' : number_format($B2, 2) ?></td>
                            <td><?= empty($C1) ? '' : number_format($C1, 2) ?></td>
                            <td><?= empty($C2) ? '' : number_format($C2, 2) ?></td>

                            <td>
                                <strong>
                                    <?= empty($total) ? '' : number_format($total, 2) ?>
                                </strong>
                            </td>

                        </tr>

                    <?php endfor; ?>

                    <tr class="table-warning">

                        <th>Total</th>

                        <th><?= number_format($sumA1, 2) ?></th>
                        <th><?= number_format($sumA2, 2) ?></th>
                        <th><?= number_format($sumB1, 2) ?></th>
                        <th><?= number_format($sumB2, 2) ?></th>
                        <th><?= number_format($sumC1, 2) ?></th>
                        <th><?= number_format($sumC2, 2) ?></th>

                        <th>
                            <?= number_format($sumTotal, 2) ?>
                        </th>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php include('footer.php'); ?>