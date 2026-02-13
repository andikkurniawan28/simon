<?php
$station_id = intval($_GET['id'] ?? 0);
include('session_manager.php');

// Definisikan allowed berdasarkan station_id
$allowed = [];

switch ($station_id) {
    // Raw Sugar
    case 1: 
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
    
    // Gilingan
    case 2:
        $allowed = [
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
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
    
    // Pemurnian
    case 3:
        $allowed = [
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
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
    
    // Penguapan
    case 4:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
        
    // DRK
    case 5:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
    
    // Masakan
    case 6:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
        
    // Stroop
    case 7:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
    
    // Gula
    case 8:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
      
    // Tangki Tetes
    case 9:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
        
    // Ketel
    case 10:
        $allowed = [
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
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
    
    // Packer
    case 11:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
        
    // Request
    case 12:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            'Direksi',
            'Tamu',
        ];
        break;
       
    // Sogokan
    case 16:
        $allowed = [
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
            // 'Staff Teknik',
            // 'Staff Tanaman',
            // 'Staff TUK',
            // 'Direksi',
            // 'Tamu',
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

            if ($year >= 2026)
            {    
                $dataQ = $conn->prepare("
                    SELECT *
                    FROM analisa_off_farm_new
                    WHERE material_id = ?
                    AND created_at BETWEEN ? AND ?
                    ORDER BY id DESC
                ");
            } 
            else 
            {
                $dataQ = $conn->prepare("
                    SELECT 
                        af.*
                    FROM analisa_off_farms af
                    JOIN samples s ON s.id = af.sample_id
                    WHERE s.material_id = ?
                    AND s.created_at BETWEEN ? AND ?
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

            while ($row = $data->fetch_assoc()) {
                foreach ($stats as $col => $arr) {
                    if (isset($row[$col]) && $row[$col] !== null) {
                        $stats[$col][] = $row[$col];
                    }
                }
            }
            $data->data_seek(0);
            ?>

            <!-- <div class="col-md-4"> -->
            <div class="col-md-<?php if(count($methods) >= 8) echo "12"; else echo "6"; ?>">
                <div class="card mb-4">

                    <div class="card-header text-left">
                        <strong><?= strtoupper($material['name']) ?></strong>
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

                                    <!-- AVG -->
                                    <tr style="background:#ffc107">
                                        <th>Avg</th>
                                        <?php foreach ($methods as $m):
                                            $col = str_replace(' ', '_', $m['indicator_name']);
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
                                            $min = !empty($stats[$col]) ? min($stats[$col]) : null;
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
                                            $max = !empty($stats[$col]) ? max($stats[$col]) : null;
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

                                </thead>

                                <tbody>
                                    <?php while ($row = $data->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= date('H:i', strtotime($row['created_at'])) ?></td>

                                            <?php foreach ($methods as $m):
                                                $col = str_replace(' ', '_', $m['indicator_name']);
                                                $v = $row[$col] ?? null;
                                            ?>
                                                <td>
                                                    <?= $v !== null
                                                        ? in_array($col, ['IU', 'CaO'])
                                                        ? number_format($v)
                                                        : number_format($v, 2)
                                                        : ''
                                                    ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

    </div>
</div>

<?php include('footer.php'); ?>