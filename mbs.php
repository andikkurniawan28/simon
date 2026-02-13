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
    // 'Staff TUK',
    // 'Direksi',
    // 'Tamu',
    ]);
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
 * QUERY DATA PENILAIAN MBS
 * =========================
 */
$dataQ = $conn->prepare("
    SELECT
        nomor_antrian,
        register,
        petani,
        mutu_tebu,
        mbs_at
    FROM analisa_on_farms
    WHERE mbs_at BETWEEN ? AND ?
    ORDER BY mbs_at DESC
");
$dataQ->bind_param("ss", $date_start, $date_end);
$dataQ->execute();
$data = $dataQ->get_result();
?>

<div class="container content-container">
    <br><br>

    <div class="card">
        <div class="card-header text-left">
            <strong>Penilaian MBS</strong>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Antrian</th>
                        <th>Register</th>
                        <th>Petani</th>
                        <th>Mutu Tebu</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($data->num_rows === 0): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Tidak ada data
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php while ($row = $data->fetch_assoc()): ?>
                            <tr>
                                <td><?= date('H:i', strtotime($row['mbs_at'])) ?></td>
                                <td><?= htmlspecialchars($row['nomor_antrian']) ?></td>
                                <td><?= htmlspecialchars($row['register']) ?></td>
                                <td><?= htmlspecialchars($row['petani']) ?></td>
                                <td><?= htmlspecialchars($row['mutu_tebu']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>
