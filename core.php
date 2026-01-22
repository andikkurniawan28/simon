<?php
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
        'title'   => 'Tanggal Tidak Valid',
        'message' => 'Silakan login ulang'
    ];
    header('Location: login.php');
    exit;
}

$date_start = $_SESSION['date_start'];
$date_end   = $_SESSION['date_end'];

/**
 * =========================
 * QUERY DATA DETAIL
 * =========================
 */
$dataQ = $conn->prepare("
    SELECT 
        core_at,
        brix_core,
        pol_core,
        rendemen_core,
        nomor_antrian,
        petani,
        register,
        created_at
    FROM analisa_on_farms
    WHERE core_at BETWEEN ? AND ?
    ORDER BY core_at DESC
");
$dataQ->bind_param("ss", $date_start, $date_end);
$dataQ->execute();
$data = $dataQ->get_result();

/**
 * =========================
 * QUERY STATISTIK
 * =========================
 */
$statQ = $conn->prepare("
    SELECT
        AVG(brix_core)      AS avg_brix,
        MIN(brix_core)      AS min_brix,
        MAX(brix_core)      AS max_brix,

        AVG(pol_core)       AS avg_pol,
        MIN(pol_core)       AS min_pol,
        MAX(pol_core)       AS max_pol,

        AVG(rendemen_core)  AS avg_rendemen,
        MIN(rendemen_core)  AS min_rendemen,
        MAX(rendemen_core)  AS max_rendemen
    FROM analisa_on_farms
    WHERE core_at BETWEEN ? AND ?
");
$statQ->bind_param("ss", $date_start, $date_end);
$statQ->execute();
$stat = $statQ->get_result()->fetch_assoc();
?>

<div class="container content-container">
    <br><br>

    <div class="card">
        <div class="card-header text-left">
            <strong>Core Sample</strong>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Brix</th>
                        <th>Pol</th>
                        <th>Rendemen</th>
                        <th>Antrian</th>
                        <th>Register</th>
                        <th>Petani</th>
                    </tr>

                    <!-- AVG -->
                    <tr style="background:#ffc107">
                        <th>Avg</th>
                        <th><?= number_format($stat['avg_brix'], 2) ?></th>
                        <th><?= number_format($stat['avg_pol'], 2) ?></th>
                        <th><?= number_format($stat['avg_rendemen'], 2) ?></th>
                        <th colspan="3"></th>
                    </tr>

                    <!-- MIN -->
                    <tr style="background:#28a745;color:#fff">
                        <th>Min</th>
                        <th><?= number_format($stat['min_brix'], 2) ?></th>
                        <th><?= number_format($stat['min_pol'], 2) ?></th>
                        <th><?= number_format($stat['min_rendemen'], 2) ?></th>
                        <th colspan="3"></th>
                    </tr>

                    <!-- MAX -->
                    <tr style="background:#dc3545;color:#fff">
                        <th>Max</th>
                        <th><?= number_format($stat['max_brix'], 2) ?></th>
                        <th><?= number_format($stat['max_pol'], 2) ?></th>
                        <th><?= number_format($stat['max_rendemen'], 2) ?></th>
                        <th colspan="3"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($data->num_rows === 0): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Tidak ada data
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php while ($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= date('H:i', strtotime($row['core_at'])) ?></td>
                                <td><?= number_format($row['brix_core'], 2) ?></td>
                                <td><?= number_format($row['pol_core'], 2) ?></td>
                                <td><?= number_format($row['rendemen_core'], 2) ?></td>
                                <td><?= htmlspecialchars($row['nomor_antrian']) ?></td>
                                <td><?= htmlspecialchars($row['register']) ?></td>
                                <td><?= htmlspecialchars($row['petani']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>
