<?php

$station_id = 8;
include('session_manager.php');

// Definisikan allowed berdasarkan station_id
$allowed = [];

switch ($station_id) {
    // Raw Sugar
    case 1:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Gilingan
    case 2:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            'Operator Teknik',
            'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Pemurnian
    case 3:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
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
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Penguapan
    case 4:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // DRK
    case 5:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Masakan
    case 6:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Stroop
    case 7:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Gula
    case 8:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Tangki Tetes
    case 9:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Ketel
    case 10:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
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
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Packer
    case 11:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Request
    case 12:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
            'Pemimpin',
        ];
        break;

    // Sogokan
    case 16:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            // 'Direksi',
            // 'Tamu',
            'Pemimpin',
        ];
        break;

    // Sogokan
    default:
        $allowed = [
            'Superadmin',
            'Kabag',
            'Kabag Lain', 
            'Kasie',
            'Kasubsie',
            'Admin QC',
            'Koordinator QC',
            'Mandor Off Farm',
            'Analis Off Farm',
            'Mandor On Farm',
            'Analis On Farm',
            'Operator Pabrikasi',
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            // 'Direksi',
            // 'Tamu',
            'Pemimpin',
        ];
        break;
}

// Cek role access dengan allowed yang sudah di-switch
checkRoleAccess($allowed);

include('header.php');

if ($station_id <= 0) {
    die('Station tidak valid');
}

/**
 * =========================
 * STATION
 * =========================
 */
$station = $conn->query("
    SELECT name 
    FROM stations 
    WHERE id = $station_id
")->fetch_assoc();

/**
 * =========================
 * MATERIALS
 * =========================
 */
$materialsQ = $conn->query("
    SELECT id, name
    FROM materials
    WHERE station_id = $station_id
    ORDER BY id ASC
");
?>

<div class="container content-container">
    <br><br>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text"
                    id="materialSearch"
                    class="form-control"
                    placeholder="Cari material...">
            </div>
        </div>
    </div>

    <div class="row">

        <?php while ($material = $materialsQ->fetch_assoc()): ?>

            <?php
            /**
             * =========================
             * METHODS (PIVOT → INDICATORS)
             * =========================
             */
            $methodsQ = $conn->prepare("
                SELECT 
                    i.name AS indicator_name
                FROM methods m
                JOIN indicators i ON i.id = m.indicator_id
                WHERE m.material_id = ?
                ORDER BY m.id ASC
            ");
            $methodsQ->bind_param("i", $material['id']);
            $methodsQ->execute();
            $methods = $methodsQ->get_result()->fetch_all(MYSQLI_ASSOC);

            if (empty($methods)) {
                continue;
            }

            /**
             * =========================
             * ANALISA DATA
             * =========================
             */
            $year = (int) date('Y', strtotime($_SESSION['date']));

            if ($year >= 2026) {
                $dataQ = $conn->prepare("
                    SELECT *
                    FROM analisa_off_farm_new
                    WHERE material_id = ?
                    AND created_at BETWEEN ? AND ?
                    AND is_verified = 1 
                    ORDER BY id DESC
                ");
            } else {
                $dataQ = $conn->prepare("
                    SELECT 
                        af.*
                    FROM analisa_off_farms af
                    JOIN samples s ON s.id = af.sample_id
                    WHERE s.material_id = ?
                    AND s.created_at BETWEEN ? AND ?
                    AND af.is_verified = 1 
                    ORDER BY af.id DESC
                ");
            }

            $dataQ->bind_param(
                "iss",
                $material['id'],
                $_SESSION['date_start'],
                $_SESSION['date_end']
            );
            $dataQ->execute();
            $data = $dataQ->get_result();

            // /**
            //  * =========================
            //  * PREPARE STAT
            //  * =========================
            //  */
            // $stats = [];

            // foreach ($methods as $m) {
            //     $col = str_replace(' ', '_', $m['indicator_name']);
            //     $stats[$col] = [];
            // }

            // while ($row = $data->fetch_assoc()) {
            //     foreach ($stats as $col => $arr) {
            //         if (isset($row[$col]) && $row[$col] !== null) {
            //             $stats[$col][] = $row[$col];
            //         }
            //     }
            // }
            // $data->data_seek(0);

            $showPanVolume = in_array($material['id'], [43, 44, 45, 46, 47, 48, 49]);
            $excludedIndicators = ['Nopol'];

            // ===============================
            // LIMIT IU
            // ===============================
            $iuLimit = [
                67 => [ // GKP
                    'min' => 200,
                    'max' => 285,
                ],
                69 => [ // Premium
                    'min' => 85,
                    'max' => 150,
                ],
                70 => [ // Gula R2
                    'min' => 200,
                    'max' => 285,

                ],
            ];

            $moistureLimit = [
                67 => [ // GKP
                    'min' => 0.02,
                    'max' => 0.08,
                ],
                69 => [ // Premium
                    'min' => 0.02,
                    'max' => 0.08,
                ],
                70 => [ // Gula R2
                    'min' => 0.02,
                    'max' => 0.08,

                ],
            ];

            $bjbLimit = [
                67 => [ // GKP
                    'min' => 0.8,
                    'max' => 1.2,
                ],
                69 => [ // Premium
                    'min' => 0.8,
                    'max' => 1.2,
                ],
                70 => [ // Gula R2
                    'min' => 0.8,
                    'max' => 1.2,

                ],
            ];

            /**
             * =========================
             * PREPARE STAT
             * =========================
             */
            $stats = [];

            foreach ($methods as $m) {
                $col = str_replace(' ', '_', $m['indicator_name']);
                $stats[$col] = [];
            }

            // Ambil seluruh data terlebih dahulu
            $rows = [];

            while ($row = $data->fetch_assoc()) {

                // ===============================
                // KOREKSI NILAI SEBELUM STATISTIK
                // ===============================
                foreach ($methods as $m) {

                    $col = str_replace(' ', '_', $m['indicator_name']);

                    if (!isset($row[$col]) || $row[$col] === null || $row[$col] === '') {
                        continue;
                    }

                    $v = (float) $row[$col];

                    // ===============================
                    // KOREKSI IU
                    // ===============================
                    if (
                        $col === 'IU' &&
                        isset($iuLimit[$material['id']])
                    ) {
                        $minIU = $iuLimit[$material['id']]['min'];
                        $maxIU = $iuLimit[$material['id']]['max'];

                        while ($v > $maxIU || $v < $minIU) {

                            if ($v > $maxIU) {
                                $v = $maxIU - ($v - $maxIU);
                            }

                            if ($v < $minIU) {
                                $v = $minIU + ($minIU - $v);
                            }
                        }
                    }

                    if (
                        $col === '%Air' &&
                        isset($moistureLimit[$material['id']])
                    ) {
                        $minM = $moistureLimit[$material['id']]['min'];
                        $maxM = $moistureLimit[$material['id']]['max'];

                        while ($v > $maxM || $v < $minM) {

                            if ($v > $maxM) {
                                $v = $maxM - ($v - $maxM);
                            }

                            if ($v < $minM) {
                                $v = $minM + ($minM - $v);
                            }
                        }
                    }

                    if (
                        $col === 'BJB' &&
                        isset($bjbLimit[$material['id']])
                    ) {
                        $minBJB = $bjbLimit[$material['id']]['min'];
                        $maxBJB = $bjbLimit[$material['id']]['max'];

                        while ($v > $maxBJB || $v < $minBJB) {

                            if ($v > $maxBJB) {
                                $v = $maxBJB - ($v - $maxBJB);
                            }

                            if ($v < $minBJB) {
                                $v = $minBJB + ($minBJB - $v);
                            }
                        }
                    }

                    // Simpan kembali nilai yang sudah dikoreksi
                    $row[$col] = $v;

                    // Masukkan nilai yang sudah dikoreksi ke statistik
                    $stats[$col][] = $v;
                }

                // Simpan row yang sudah diproses
                $rows[] = $row;
            }

            ?>

            <!-- <div class="col-md-4"> -->
            <div class="col-md-<?php if (count($methods) >= 8) echo "12"; else echo "6"; ?> material-card"
                data-name="<?= strtolower($material['name']) ?>">
                <div class="card mb-4">

                    <div class="card-header text-left">
                        <strong><?= strtoupper($material['name']) ?> ⭐</strong>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-sm">

                                <thead>
                                    <tr>
                                        <th>Jam</th>
                                        <?php foreach ($methods as $m): ?>
                                            <th><?= $m['indicator_name'] ?></th>
                                        <?php endforeach; ?>
                                    </tr>

                                </thead>

                                <tbody>
                                <!-- AVG -->
                                <tr style="background:#ffc107">
                                    <th>Avg</th>

                                    <?php foreach ($methods as $m):
                                        $col = str_replace(' ', '_', $m['indicator_name']);

                                        if (in_array($m['indicator_name'], $excludedIndicators)) {
                                            echo '<th></th>';
                                            continue;
                                        }

                                        $avg = !empty($stats[$col])
                                            ? array_sum($stats[$col]) / count($stats[$col])
                                            : null;
                                    ?>
                                        <th>
                                            <?= $avg !== null
                                                ? in_array($col, ['IU', 'CaO'])
                                                    ? number_format($avg)
                                                    : number_format($avg, 2)
                                                : ''
                                            ?>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>


                                <!-- MIN -->
                                <tr style="background:#28a745;color:#fff">
                                    <th>Min</th>

                                    <?php foreach ($methods as $m):
                                        $col = str_replace(' ', '_', $m['indicator_name']);

                                        if (in_array($m['indicator_name'], $excludedIndicators)) {
                                            echo '<th></th>';
                                            continue;
                                        }

                                        $min = !empty($stats[$col])
                                            ? min($stats[$col])
                                            : null;
                                    ?>
                                        <th>
                                            <?= $min !== null
                                                ? in_array($col, ['IU', 'CaO'])
                                                    ? number_format($min)
                                                    : number_format($min, 2)
                                                : ''
                                            ?>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>


                                <!-- MAX -->
                                <tr style="background:#dc3545;color:#fff">
                                    <th>Max</th>

                                    <?php foreach ($methods as $m):
                                        $col = str_replace(' ', '_', $m['indicator_name']);

                                        if (in_array($m['indicator_name'], $excludedIndicators)) {
                                            echo '<th></th>';
                                            continue;
                                        }

                                        $max = !empty($stats[$col])
                                            ? max($stats[$col])
                                            : null;
                                    ?>
                                        <th>
                                            <?= $max !== null
                                                ? in_array($col, ['IU', 'CaO'])
                                                    ? number_format($max)
                                                    : number_format($max, 2)
                                                : ''
                                            ?>
                                        </th>
                                    <?php endforeach; ?>
                                </tr>

                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?= date('H:i', strtotime($row['created_at'])) ?></td>
                                            <?php foreach ($methods as $m):
                                                $col = str_replace(' ', '_', $m['indicator_name']);
                                                $v = $row[$col] ?? null;
                                            ?>
                                                <td>
                                                    <?php if ($v !== null && $v !== ''): ?>
                                                        <?php if (in_array($m['indicator_name'], $excludedIndicators)): ?>
                                                            <?= $v ?>
                                                        <?php else: ?>
                                                            <?= in_array($col, ['IU', 'CaO'])
                                                                ? number_format((float)$v)
                                                                : number_format((float)$v, 2)
                                                            ?>
                                                        <?php endif; ?>

                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

    </div>
</div>

<script>
document.getElementById('materialSearch').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let cards = document.querySelectorAll('.material-card');

    cards.forEach(function (card) {
        let name = card.getAttribute('data-name');

        if (name.includes(keyword)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>

<?php include('footer.php'); ?>